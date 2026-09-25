<?php

namespace App\Http\Controllers\User\Api\Cart;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\Cart\CartRequest;
use App\Http\Requests\User\Cart\CouponRequest;
use App\Http\Resources\User\Cart\CartResource;
use App\Models\Cart;
use App\Models\Cartitem;
use App\Models\Coupon;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $AuthUser = User::with('cart.cartitems')->find(Auth::guard('sanctum')->id());
        if(!$AuthUser->cart){
            return response()->json([
                'message'=>'عفوا لا يوجد منتجات في عربة التسوق',
                'statusCode'=>422,
            ]);
        }
        return response()->json([
                'data'=>new CartResource($AuthUser->cart),
                'statusCode'=>200,
            ]);
    }

    /**
     * Store a newly created resource in storage.
     */

    public function store(CartRequest $request)
    {
        $userId = Auth::guard('sanctum')->id();
        $message = '';

        DB::transaction(function () use ($request, $userId, &$message) {

            $cart = Cart::firstOrCreate(['user_id' => $userId]);

            $cartItem = Cartitem::where('cart_id', $cart->id)
                ->where('product_id', $request->product_id)
                ->first();

            if (!$cartItem) {
                // ➕ إضافة منتج جديد
                $cart->cartitems()->create([
                    'product_id'    => $request->product_id,
                    'quantity'      => $request->quantity,
                    'price'         => $request->price,
                    'discount_rate' => $request->discount_rate,
                    'need_type'     => $request->need_type,
                    'total'         => $request->price * $request->quantity,
                ]);

                $message = 'تم إضافة المنتج إلى عربة التسوق بنجاح';

            } else {
                // 🔄 تحديث المنتج
                $cartItem->update([
                    'quantity' => $request->quantity,
                    'total'    => $request->price * $request->quantity,
                ]);

                $message = 'تم تحديث المنتج في عربة التسوق بنجاح';
            }

            // تحديث إجمالي الكارت
            $cart->update([
                'subtotal' => $cart->cartitems()->sum('total'),
                'total' => $cart->cartitems()->sum('total'),
            ]);
        });

        return response()->json([
            'message' => $message,
            'statusCode' => 200,
        ]);
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
    public function update(CartRequest $request, string $id)
    {
        $update = Cartitem::find($id);
        if(!$update){
            return response()->json([
                'data'=>[
                    'message'=>'عفوا هذا العنصر غير موجود في عربة التسوق',
                ],
                'statusCode'=>422,
            ]);
        }
        $update->update($request->all());
        return response()->json([

            'data'=>[
                'message'=>'تم تعديل المنتج داخل عربة التسوق',
            ],
            'statusCode'=>200,
            
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $delete = Cartitem::find($id);
        $delete->delete();
        $AuthUser = User::with('cart.cartitems')->find(Auth::guard('sanctum')->id());
        $AuthUser->cart->update([
            'total'=>$AuthUser->cart->cartitems()->sum('total')
        ]);
        return response()->json([
            'data'=>[
                'message'=>'تم حذف المنتج من عربة التسوق بنجاح',
            ],
            'statusCode'=>200,
         ]);
    }


    public function checkCoupon(CouponRequest $request){
        $userId = Auth::guard('sanctum')->id();
        $cart = Cart::with('cartitems')->where('user_id', $userId)->first();

        if (!$cart) {
            return response()->json([
                'message' => 'لا يوجد لك عربة تسوق',
                'statusCode' => 404,
            ]);
        }

        // Ensure the cart doesn't already have a coupon applied
        if ($cart->coupon_id) {
            return response()->json([
                'message' => 'عفوا لديك قسيمة خصم بالفعل',
                'statusCode' => 422,
            ]);
        }

        // Apply the coupon if valid
        $couponData = $this->coupon($request->coupon, $cart->cartitems->sum('total'));

        // If the coupon method returned an error response, return it
        if ($couponData instanceof \Illuminate\Http\JsonResponse) {
            return $couponData;
        }

        // Update the cart with the new total and coupon ID
        $cart->update([
            'total' => $couponData['total'],
            'coupon_id' => $couponData['coupon_id'],
        ]);

        // Retrieve the coupon to apply its discount to each cart item
        $coupon = Coupon::find($couponData['coupon_id']);
        $discount = $coupon ? $coupon->discount_percentage / 100 : 0;

        foreach ($cart->cartitems as $cartItem) {
            $cartItem->update([
                'total' => $cartItem->total * (1 - $discount),
                'price' => $cartItem->price * (1 - $discount),
            ]);
        }

        return response()->json([
            'message' => 'تم تخفيض اجمالي السعر',
            'statusCode' => 200,
        ]);
    }

    protected function coupon($coupon,$cartTotal){
        if ($coupon) {
            $getCoupon = Coupon::where('coupon', $coupon)->first();
          
            // Check if the coupon is still valid
            if (Carbon::parse($getCoupon->end_date_time)->isPast()) {
                return response()->json([
                    'message' => 'عفوا، قسيمة الخصم غير سارية',
                    'statusCode' => 422,
                ]);
            }
    
            // Calculate the discounted total
            $total = $cartTotal * (1 - $getCoupon->discount_percentage / 100);
    
            // Return the new total and coupon ID
            return [
                'total' => $total,
                'coupon_id' => $getCoupon->id,
            ];
        }
    
        // Return original total if no coupon is applied
        return [
            'total' => $cartTotal,
            'coupon_id' => null,
        ];
    }

}
