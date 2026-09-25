<?php

namespace App\Http\Controllers\User\Api\Order;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\Order\RefundRequestRequest;
use App\Http\Resources\User\Order\OrderRefundResource;
use App\Models\Orderitem;
use App\Models\Refund;
use App\Models\Setting;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RefundRequestController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public $setting;
    public function __construct()
    {
        $this->setting = Setting::query()->first();
    }
    public function index()
    {
        $authUserRefundOrdersOrderitems = User::with(['orders' => function ($q) {
            $q->whereHas('orderitems', function (Builder $builder) {
                $builder->whereIn('status', ['refunded', 'refund']);
            })->with(['orderitems' => function ($query) {
                $query->whereIn('status', ['refunded', 'refund']);
            }]);
        }])->find(Auth::guard('sanctum')->id());
        
        return response()->json([
            'data'=>OrderRefundResource::collection($authUserRefundOrdersOrderitems->orders),
            'statusCode'=>200,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(RefundRequestRequest $request)
    {
        $orderItem = $this->getOrderItem($request->orderitem_id);

        if ($this->isRefundAlreadyRequested($orderItem)) {
            return $this->errorResponse('عفواً تم تقديم طلب استرجاع لهذا المنتج من قبل', 422);
        }

        if (!$this->canRequestRefund($orderItem)) {
            return $this->errorResponse('يجب عليك استلام المنتج أولاً لتتمكن من هذا الإجراء', 422);
        }

        if($this->checkOrderCreatedAt($orderItem)){
            return $this->errorResponse('عفوا سياسة الاسترجاع يجب أن تكون قبل '.$this->setting->refund_day .' يوم ', 422);

        }
        $this->processRefundRequest($request, $orderItem);

        return $this->successResponse('تم تقديم طلب الاسترجاع', 200);
    }

    private function getOrderItem($orderitemId)
    {
        return Orderitem::with('order')->findOrFail($orderitemId);
    }
    
    private function isRefundAlreadyRequested($orderItem)
    {
        return $orderItem->status === 'refund';
    }
    
    private function canRequestRefund($orderItem)
    {
        return in_array($orderItem->status, ['received', 'completed']);
    }
    
    private function checkOrderCreatedAt($orderItem)
    {
        $createdAt = $orderItem->order->created_at;
        $isGreaterThan14Days = $createdAt->lt(Carbon::now()->subDays($this->setting->refund_day));
        if($isGreaterThan14Days){
            return true;
        }

    }
    
    
    private function processRefundRequest(Request $request, $orderItem)
    {
        $request->merge([
            'user_id' => Auth::guard('sanctum')->id(),
            'order_id' => $orderItem->order_id,
            'orderitem_id' => $orderItem->id,
        ]);
    
        Refund::create($request->all());
    
        $orderItem->update(['status' => 'refund']);
    }
    
    private function errorResponse($message, $statusCode)
    {
        return response()->json([
            'message' => $message,
            'statusCode' => $statusCode,
        ]);
    }
    
    private function successResponse($message, $statusCode)
    {
        return response()->json([
            'message' => $message,
            'statusCode' => $statusCode,
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
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
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
