
            <table class="table ali gn-items-center mb-0">
                <thead>
                    <tr class="text-center">
                        <th data-column="0" data-order="desc" class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                            <span class="material-icons align-middle">
                                tag
                                </span>
                            رقم الطلب
                            <span class="material-icons align-middle">
                                swap_vert
                            </span>
                        </th>
                    
                        <th  data-column="1" data-order="desc" class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                            <span class="material-icons align-middle">
                                calendar_month
                                </span>
                                وقت الطلب 
                        </th>
                
                        <th  data-column="1" data-order="desc" class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                            <span class="material-icons align-middle">
                                calendar_month
                                </span>
                                تاريخ الاستلام 
                        </th>
                        <th  data-column="2" data-order="desc" class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                            <span class="material-icons align-middle">
                                credit_card
                                </span>
                                وسيلة الدفع
                        </th>
                        <th  data-column="3" data-order="desc" class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                            <span class="material-icons align-middle">
                                inventory_2
                                </span>
                                إجمالي عدد المنتجات
                                <span class="material-icons align-middle">
                                    swap_vert
                                </span>
                        </th>

                         <th  data-column="3" data-order="desc" class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                            <span class="material-icons align-middle">
                                discount
                                </span>
                                قيمة الخصم
                              
                        </th>
                        
                        <th data-column="4" data-order="desc" class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                            <span class="material-icons align-middle">
                                note
                                </span>
                                ملحوظة
                                <span class="material-icons align-middle">
                                    swap_vert
                                </span>
                        </th>
                     
                       
                        <th data-column="7" data-order="desc" class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                            <span class="material-icons align-middle">
                                payments
                                </span>
                                الاجمالي
                                <span class="material-icons align-middle">
                                    swap_vert
                                </span>
                        </th>
                    
                        
                        <th data-column="8" data-order="desc" class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                            <span class="material-icons align-middle">
                                toggle_on
                                </span>
                                حالة الطلب
                                <span class="material-icons align-middle">
                                    swap_vert
                                </span>
                        </th>
                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                            <span class="material-icons align-middle">
                                badge
                                </span>
                                أسم العميل
                        </th>
                        <th  class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                            <span class="material-icons align-middle">
                                person
                                </span>
                            قسيمة خصم
                        </th>
                        <th  class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                            <span class="material-icons align-middle">
                                tune
                            </span>
                            تفاصيل
                 
                        </th>
                        
                    </tr>
                </thead>
                <tbody>
                    @forelse ($orders as $order)
                        
                    <tr class="text-center">
                        <td>
                            <a href="{{route('dashboard.orders.show',$order->id)}}">
                                {{$order->number}}#
                            </a>
                        </td>
                        
                        <td>
                            <p class="text-xs font-weight-bold mb-0">
                                {{$order->created_at->format('Y-m-d')}}
                            </p>
                            <p class="text-xs font-weight-bold mb-0">
                                {{$order->created_at->format('h:i A')}}
                            </p>
                        </td>
                        <td>
                                {{$order->date_of_receipt}}
                        </td>
                        {{-- <td>
                            <p class="text-xs font-weight-bold mb-0">
                                {{$order->created_at->format('H:i a')}}
                            </p>
                        </td> --}}
                
                        
                        <td class="order-payment-method">
                            <p class="text-xs font-weight-bold mb-0">
                                @switch($order->payment_method)
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
                                {{$order->orderitems_count}}
                            </p>
                        </td>
                        <td>
                            <p class="text-xs font-weight-bold mb-0">
                                @if ($order->coupon->discount_percentage)
                                    {{ $order->subtotal * ($order->coupon->discount_percentage / 100) }}
                                @else
                                    0
                                @endif
                            </p>
                        </td>
                        <td>
                            <p class="text-xs font-weight-bold mb-0">
                                {{$order->note}}
                            </p>
                        </td>
                      
                    
                    
                        <td>
                            <p class="text-xs font-weight-bold mb-0">
                                 {{Currency::format($order->total)}}
                            </p>
                        </td>
                        
                    
                        <td>
                            @switch($order->status)
                                @case('packed')
                                    <div class="order-status order-status-packed">
                                            <img src="{{asset('assets/media/dashboard/order/status/packed.svg')}}">
                                            في التعباءه
                                    </div> 
                                    @break
                                @case('shipped')
                                    <div class="order-status order-status-shipped">
                                        <img src="{{asset('assets/media/dashboard/order/status/shipped.svg')}}">

                                        تم الشحن
                                    </div> 
                                    @break
                                @case('in_delivery')
                                    <div class="order-status order-status-in_delivery">
                                        <img src="{{asset('assets/media/dashboard/order/status/in_delivery.svg')}}">
                                        في التوصيل
                                    </div> 
                                    @break
                                @case('received')
                                    <div class="order-status order-status-received">
                                        <img src="{{asset('assets/media/dashboard/order/status/received.svg')}}">
                                        تم الاستلام
                                    </div> 
                                    @break
                                @case('cancelled')
                                    <div class="order-status order-status-cancelled">
                                        <img src="{{asset('assets/media/dashboard/order/status/cancelled.svg')}}">
                                        ملغي بالكامل
                                    </div> 
                                    @break
                                @case('refunded')
                                    <div class="order-status order-status-refunded">
                                        <img src="{{asset('assets/media/dashboard/order/status/refunded.svg')}}">
                                        مرتجع بالكامل
                                    </div> 
                                    @break
                                @case('completed')
                                    <div class="order-status order-status-completed">
                                        <img src="{{asset('assets/media/dashboard/order/status/completed.svg')}}">
                                        مكتمل
                                    </div> 
                                    @break
                                @default
                                <div class="order-status order-status-pending">
                                    <img src="{{asset('assets/media/dashboard/order/status/pending.svg')}}">
                                    قيد المراجعة
                                </div> 
                            @endswitch
                        </td>
                        <td class="order-customer-type">
                            <p class="text-xs font-weight-bold mb-0">
                                {{$order->user->profile->full_name}}
                            </p>
                           
                        </td>

                        <td class="align-middle text-center text-sm">
                        <div class="coupon-info" data-id="{{$order->id}}">
                            <span  class="btn bg-gradient-light">
                                {{$order->coupon->coupon}}
                            </span>
                        </div>
                                <div class="coupon-info-container" data-id="{{$order->id}}" lang="{{config('app.locale')}}"@if(config('app.locale')=='ar')  dir="rtl" @else dir="ltr" @endif>
                                    <div class="coupon-info-content">
                                            <ul class="coupon-info-list-items">
                                                <div class="coupon-info-close" data-id="{{$order->id}}">
                                                    X
                                                </div>
                                                <li class="coupon-info-item">
                                                    قسيمة الخصم : 
                                                    <span class="badge badge-sm bg-gradient-{{ $order->coupon->status == 'active' ? 'info' : 'danger' }}">
                                                        {{$order->coupon->coupon}}
                                                    </span>
                                                </li>
                                                <li class="coupon-info-item">
                                                    نسبة الخصم :
                                                    <span class="badge badge-sm bg-gradient-{{ $order->coupon->status == 'active' ? 'info' : 'danger' }}">
                                                    %{{$order->coupon->discount_percentage}} 
                                                    </span>
                                                </li>
                                                <li class="coupon-info-item discount">
                                                    بداية القسيمة : 
                                                    <div class="discount-date-time" style="text-align:{{ config('app.locale')=='ar' ? 'left' : 'right' }};">
                                                        <div>
                                                            <span class="badge badge-sm bg-gradient-{{ $order->coupon->status == 'active' ? 'success' : 'danger' }}">
                                                                    {{$order->coupon->start_date_time ? $order->coupon->start_date_time->format('Y-m-d') : 'null' }}
                                                            </span>
                                                        </div>
                                                      
                                                    </div>
                                                </li>
                                                
                                                <li class="coupon-info-item discount">
                                                    نهاية القسيمة  : 
                                                    <div class="discount-date-time" style="text-align:{{ config('app.locale')=='ar' ? 'left' : 'right' }};">
                                                        <div>
                                                            <span class="badge badge-sm bg-gradient-{{ $order->coupon->status == 'active' ? 'success' : 'danger' }}">
                                                                {{$order->coupon->end_date_time ? $order->coupon->end_date_time->format('Y-m-d') : 'null'}}
                                                            </span>
                                                        </div>
                                                        
                                                    </div>
                                                
                                                </li>
                                                <li class="coupon-info-item">
                                                    الحالة : 
                                                    @if($order->coupon->status=='active')
                                                    <span class="badge badge-sm bg-gradient-success">
                                                        مفعل
                                                    </span>
                                                    @else
                                                    <span class="badge badge-sm bg-gradient-danger">
                                                        منتهي
                                                    </span>
                                                    @endif
                                                </li>
                                            </ul>
                                    </div>
                                </div>
                        </td>




                        <td class="d-flex justify-content-center">
                            <a href="{{route('dashboard.orders.show',$order->id)}}">
                                <button type="button" class="btn bg-gradient-info">
                                    تفاصيل
                                </button>
                            </a>
                        </td>
                    </tr>
                    @empty
                    <tr class="text-center">
                        <td colspan="11">
                            لا يوجد بيانات حتي الان
                        </td>
                    </tr>
                    @endforelse
                        
                
                    
                </tbody>
            </table>
       
