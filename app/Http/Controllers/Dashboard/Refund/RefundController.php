<?php

namespace App\Http\Controllers\Dashboard\Refund;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\Refund\RefundRequest;
use App\Models\Refund;
use Illuminate\Http\Request;

class RefundController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $refunds = Refund::search($request->query())->with('user','order','orderitem')->where('status','pending')->latest()->paginate(10);
        if ($request->ajax()) {
            return response()->json([
                'html' => view('Dashboard.Refund.Partials.refunds', compact('refunds'))->render(),
            ]);
        }
        return view('Dashboard.Refund.index',compact('refunds'));
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
    public function store(Request $request)
    {
        //
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
    public function update(RefundRequest $request, string $id)
    {
        $comfirmOrRejected = Refund::find($id);

        if($request->status=='accepted'){
            $comfirmOrRejected->order->update([
                'total'=>$comfirmOrRejected->order->total - $comfirmOrRejected->orderitem->total,
            ]);
            $message = ' قبول ';
        } else{
            $message = ' رفض ';
        }
        

        $comfirmOrRejected->update([
            'status'=>$request->status
        ]);
        $comfirmOrRejected->orderitem->update([
            'status'=>'refunded',
        ]);

        return redirect()->route('dashboard.refunds.index')->with('success', 'تم ' . $message . 'طلب المراجعة بنجاح');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
