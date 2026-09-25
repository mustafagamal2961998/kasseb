<?php

namespace App\Http\Controllers\User\Api\Checkout;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\Order\OrderRequest;
use App\Models\Cart;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class CheckoutController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
   public function store(OrderRequest $request)
    {
        $userId = Auth::guard('sanctum')->id();

        $cart = Cart::where('user_id', $userId)->with('cartitems')->first();

        if (!$cart || $cart->cartitems->isEmpty()) {
            return response()->json([
                'message' => 'لا يوجد منتجات لديك في عربة التسوق',
                'statusCode' => 422,
            ]);
        }

        DB::transaction(function () use ($request, $cart, $userId) {

            $request->merge([
                'total'     => $cart->cartitems->sum('total'),
                'subtotal'=> $cart->subtotal,
                'coupon_id' => $cart->coupon_id,
            ]);

            // إنشاء الطلب
            $order = Order::create($request->all());

            // إنشاء عناصر الطلب + تحديث المخزون
            $orderItems = $cart->cartitems->map(function ($cartItem) {

                $product = Product::lockForUpdate()->find($cartItem->product_id);

                $product->update([
                    'stock' => $product->stock - $cartItem->quantity,
                ]);

                return [
                    'product_id'       => $cartItem->product_id,
                    'product_name'  => $product->name,
                    // 'product_name_en'  => $product->name_en,
                    'quantity'         => $cartItem->quantity,
                    'price'            => $cartItem->price,
                    'discount_rate'    => $cartItem->discount_rate,
                    'need_type'        => $cartItem->need_type,
                    'total'            => $cartItem->total,
                ];

            })->toArray();

            $order->orderitems()->createMany($orderItems);

            // الخصم من المحفظة
            if ($request->from_wallet) {

                $user = User::lockForUpdate()->find($userId);

                $orderTotal    = $order->total;
                $walletBalance = $user->balance;

                if ($walletBalance >= $orderTotal) {
                    // المحفظة تكفي
                    $user->update([
                        'balance' => $walletBalance - $orderTotal
                    ]);

                    $order->update([
                        'from_balance'=>$walletBalance,
                        'total' => 0
                    ]);
                } else {
                    // المحفظة مش مكفية
                    $order->update([
                        'from_balance'=>$walletBalance,
                        'total' => $orderTotal - $walletBalance
                    ]);

                    $user->update([
                        'balance' => 0
                    ]);
                }
            }

            // حذف الكارت
            $cart->delete();
        });

        return response()->json([
            'message' => 'تم إرسال الطلب بنجاح',
            'statusCode' => 200,
        ]);
    }

    private function generateQrCode($order){
     
      // QR Code content
      $qrCodeContent = "Customer Name: {$order->user->profile->full_name} 
                        <br>
                        Order ID: {$order->number}, 
                        <br>   
                        Total: {$order->total}";

      // Temporary file path for storing the QR code
      $tempFilePath = storage_path($order->id .'.png');
  
      // Generate and save the QR code to the temporary file
      QrCode::size(300)
          ->backgroundColor(255, 255, 255)
          ->color(0, 0, 0)
          ->margin(2)
          ->format('png')
          ->generate($qrCodeContent, $tempFilePath);
  
      // Store the QR code using Spatie Media Library
      $order->addMedia($tempFilePath)
          ->usingName("Order_{$order->id}_QR_Code")
          ->toMediaCollection('qr_code');

    }
       
    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    
}
