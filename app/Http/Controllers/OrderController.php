<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;

class OrderController extends Controller
{
    const PRINTER_KASIR = 1;
    const PRINTER_DAPUR = 2;
    const PRINTER_BAR = 4;
    public function store(Request $request)
    {


        try {
            $orderData = $request->validate([
                'table_number' => 'required|integer',
                'items' => 'required|array',
                'items.*.product_id' => 'required|integer|exists:products,id',
                'items.*.quantity' => 'required|integer|min:1',
            ]);

            DB::beginTransaction();
            $order = Order::create([
                'table_number' => $orderData['table_number'],
                'total_price' => 0,
                'printer_stations' => 0
            ]);

            $totalPrice = 0;

            foreach ($orderData['items'] as $item) {
                $product = Product::find($item['product_id']);
                $price = $product->price * $item['quantity'];

                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $item['product_id'],
                    'quantity' => $item['quantity'],
                    'price' => $price
                ]);

                $totalPrice += $price;

                if ($product->category->type == 'food') {
                    $order->printer_stations |= self::PRINTER_DAPUR;
                } elseif ($product->category->type == 'drink') {
                    $order->printer_stations |= self::PRINTER_BAR;
                } else {
                    $order->printer_stations |= self::PRINTER_KASIR;
                }
            }

            $order->update([
                'total_price' => $totalPrice,
                'printer_stations' => $order->printer_stations
            ]);

            DB::commit();

            return response()->json([
                'order_id' => $order->id,
                'printer' => $this->getPrinterStations($order->printer_stations)
            ]);
        } catch (ValidationException $e) {
            // Menampilkan respons error dari validasi
            return response()->json([
                'error' => 'Terjadi kesalahan saat memproses pesanan.',
                'messages' => $e->errors()
            ], 422);
        } catch (\Throwable $th) {
            DB::rollback();

            return response()->json([
                'error' => 'Terjadi kesalahan saat memproses pesanan.',
                'message' => $th->getMessage()
            ], 500);
        }
    }

    public function getBill($table_number)
    {
        $order = Order::where('table_number', $table_number)
            ->with('orderItems.product')
            ->firstOrFail();

        return response()->json([
            'order' => $order,
            'printer' => $this->getPrinterStations($order->printer_stations)
        ]);
    }

    private function getPrinterStations($bitmask)
    {
        $stations = [];

        if ($bitmask & self::PRINTER_KASIR) {
            $stations[] = 'kasir';
        }
        if ($bitmask & self::PRINTER_DAPUR) {
            $stations[] = 'dapur';
        }
        if ($bitmask & self::PRINTER_BAR) {
            $stations[] = 'bar';
        }

        return $stations;
    }
}
