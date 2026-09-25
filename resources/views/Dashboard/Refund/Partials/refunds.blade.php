<table class="table align-items-center mb-0">
    <thead>
        <tr class="text-center">
            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                <span class="material-icons align-middle">
                    tag
                    </span>
                رقم الطلب
            </th>
        
            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                <span class="material-icons align-middle">
                    calendar_month
                    </span>
                    تاريخ الطلب 
            </th>
            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                <span class="material-icons align-middle">
                    calendar_month
                    </span>
                    تاريخ التسليم 
            </th>
       
            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                <span class="material-icons align-middle">
                    payments
                    </span>
                    قيمة الطلب
            </th>

            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                <span class="material-icons align-middle">
                    badge
                    </span>
                    بيانات العميل
            </th>

            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                <span class="material-icons align-middle">
                    credit_card
                    </span>
                    وسيلة استلام النقود
            </th>
      
     
            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                <span class="material-icons align-middle">
                    info
                    </span>
                    سبب الاسترجاع
            </th>
      
            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                <span class="material-icons align-middle">
                    tune
                    </span>
                    تحكم
            </th>
      
            
        </tr>
    </thead>
    <tbody>
        @forelse ($refunds as $refund)
            
        <tr class="text-center">
            <td>
                <a href="{{route('dashboard.orders.show',$refund->order_id)}}">
                    {{$refund->order->number}}#
                </a>
            </td>
            <td>
                <p class="text-xs font-weight-bold mb-0">
                    {{$refund->created_at->format('Y-m-d')}}
                </p>
                <p class="text-xs font-weight-bold mb-0">
                    {{$refund->created_at->format('h:i A')}}
                </p>
            </td>
            <td>
                <p class="text-xs font-weight-bold mb-0">
                    {{$refund->order->created_at->format('Y-m-d')}}
                </p>
                <p class="text-xs font-weight-bold mb-0">
                    {{$refund->order->created_at->format('h:i A')}}
                </p>
            </td>
               
        
            <td class="align-middle text-center text-sm">
                {{Currency::format($refund->orderitem->total)}}
            </td>
            <td class="order-customer-type">
                <p class="text-xs font-weight-bold mb-0">
                    {{$refund->user->profile->full_name}}
                </p>
                @if($refund->user->type=='trader')
                <img src="{{asset('assets/media/dashboard/order/trader.svg')}}">
                تاجر
                @else
                <img src="{{asset('assets/media/dashboard/order/user.svg')}}">
                مستخدم
                @endif
            </td>
          
            
            <td class="order-payment-method">
                <p class="text-xs font-weight-bold mb-0">
                    @switch($refund->payment_method)
                        @case('digital_wallet')
                            <img src="{{asset('assets/media/dashboard/order/digital_wallet.svg')}}">
                            @break
                        @case('bank_card')
                             <img src="{{asset('assets/media/dashboard/order/bank_card.svg')}}">
                            @break
                        @default
                            <img src="{{asset('assets/media/dashboard/order/cod.svg')}}">
                    @endswitch
                </p>
            </td>
       
            <td>
                <p class="text-xs font-weight-bold mb-0">
                   {{$refund->note}}
                </p>
            </td>
       

        <td>
           <form action="{{route('dashboard.refunds.update',$refund->id)}}" method="POST">
                @csrf
                @method('PUT')
                <button type="submit" name="status" value="rejected" class="btn bg-gradient-danger">
                        رفض
                </button>
                <button type="submit"  name="status" value="accepted" class="btn bg-gradient-success">
                        موافقه
                </button>
           </form>
        </td>
       
        </tr>
        @empty
        <tr class="text-center">
            <td colspan="8">
                لا يوجد بيانات حتي الان
            </td>
        </tr>
        @endforelse
            
    
        
    </tbody>
</table>