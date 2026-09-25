<x-Dashboard.Layout.Layout title="رقم الطلب - # {{$order->number}}">

    @push('style')
        <link rel="stylesheet" href="{{ asset('assets/css/dashboard/order/order.css') }}">
    @endpush


    <div class="pt-5 pb-5">

        <div class="header-route-btn-container pb-2 px-3">
            <div class="header-route-btn-container">

             <div id="order_map">
                <div class="order-info-container">
                    <ul class="order-info-list-items">
                        <h4>
                            العنوان
                        </h4>
                        @if($order->address->address)
                            <li class="order-info-item">
                                العنوان  : {{$order->address->address}}
                            </li>
                        @else
                        <li class="order-info-item">
                            
                            جوجال ماب  :
                            
                            <a href="">
                                إضغط هنا
                            </a>
                        </li>
                        @endif
                        
                    </ul>
     
                </div>
            </div>

                <div class="order-status-tracking">
                    @if($order->status!='cancelled' && $order->status!='refunded')
                        <ol class="progtrckr" data-progtrckr-steps="5">
                            <form action="{{route('dashboard.orders.update',$order->id)}}" method="POST">
                                @csrf
                                @method('PUT')
                                <li class="@if($order->status=='pending' || $order->status=='packed' || $order->status=='shipped' || $order->status=='in_delivery' || $order->status=='received' || $order->status=='completed') progtrckr-done  @else progtrckr-todo @endif">
                                    <button type="submit" name="status" value="pending">
                                        قيد المراجعة
                                    </button>
                                </li>
                                <li class="@if($order->status=='packed' || $order->status=='shipped' || $order->status=='in_delivery' || $order->status=='received' || $order->status=='completed') progtrckr-done  @else progtrckr-todo @endif ">
                                    <button type="submit" name="status" value="packed">
                                        تم التعباءه
                                    </button>
                                </li>
                                <li class="@if($order->status=='shipped' || $order->status=='in_delivery' || $order->status=='received' || $order->status=='completed') progtrckr-done  @else progtrckr-todo @endif ">
                                    <button type="submit" name="status" value="shipped">
                                        تم الشحن    
                                    </button>
                                </li>
                                <li class="@if($order->status=='in_delivery' || $order->status=='received' || $order->status=='completed') progtrckr-done  @else progtrckr-todo @endif ">
                                    <button type="submit" name="status" value="in_delivery">
                                        في التوصيل
                                    </button>
                                </li>
                                <li class="@if($order->status=='received' || $order->status=='completed') progtrckr-done  @else progtrckr-todo @endif ">
                                    {{-- <button type="submit" name="status" value="received">
                                    </button> --}}
                                    <button type="button" data-title="بواسطة مندوب الشحن" class="received-status-btn">
                                        تم التسليم
                                    </button>
                                </li>
                                <li class="@if($order->status=='completed') progtrckr-done  @else progtrckr-todo @endif ">
                                    <button type="submit" name="status" value="completed">
                                        مكتمل   
                                    </button>
                                </li>
                            </form>
                        </ol>
                    @else
                    <div class="cancelled-refunded-container">
                        @if($order->status=='cancelled')
                            <div class="cancelled-icon">
                                <h5>
                                    ملغي بالكامل
                                </h5>
                                <img src="{{asset('assets/media/dashboard/order/cancelled.svg')}}">
                            </div>
                        @endif
                        @if($order->status=='refunded')
                            <div class="refunded-icon">
                                <h5>
                                    مرتجع بالكامل
                                </h5>
                                <img src="{{asset('assets/media/dashboard/order/refunded.svg')}}">
                            </div>
                        @endif
                    </div>    
                    @endif
                </div>

            </div>
        </div>


        <div id="order_info">
            <div class="order-info-container">
                <ul class="order-info-list-items">
            
                    <li class="order-info-item">
                        رقم الطلب : 
                        {{-- <span> --}}
                            #{{$order->number}}
                        {{-- </span> --}}
                    </li>
                    <li class="order-info-item">
                        أسم العميل : {{$order->user->profile->full_name }}
                    </li>
                    <li class="order-info-item">
                        رقم الهاتف  : {{$order->user->phone }}
                    </li>
                   @if($order->address->address)
                        <li class="order-info-item">
                            العنوان  : {{$order->address->address}}
                        </li>
                    @else
                    <li class="order-info-item">
                        جوجال ماب  :
                        
                        <a href="">
                            إضغط هنا
                        </a>
                    </li>
                    @endif
                    @if($order->from_balance)
                        <li class="order-info-item">
                            قيمة الخصم من المحفظة :  {{Currency::format($order->from_balance)}}
                        </li>
                    @endif
                    <li class="order-info-item">
                        الاجمالي :  {{Currency::format($order->total)}}
                    </li>
                    @if ($order->coupon->discount_percentage)
                    <li class="order-info-item">
                    الخصم :     
                           {{ Currency::format($order->total * ($order->coupon->discount_percentage / 100)) }}
                    </li>
                    @endif
                   <li class="order-info-item">
                        ملحوظة  : {{$order->note }}
                    </li>
                </ul>
 
                <div class="order-qr-code-content">
                    <img src="{{SettingInfo::setting()->getFirstMediaUrl('logo')}}">
                </div> 
            </div>
        </div>


       <div class="table-responsive-header">
            <div class="table-responsive-header-content">

                <div>
                    <a href="{{route('dashboard.orders.index')}}">

                        <button class="btn bg-gradient-primary  mb-0 toast-btn" type="button" data-target="infoToast">
                            <span class="material-icons">
                                arrow_back
                            </span>
                            رجوع
                        </button>

                    </a>
                </div>

                <div>

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
                        
                </div>

                <div>

                    <button class="btn bg-gradient-info  mb-0 toast-btn" type="button" data-target="infoToast" onclick="printPage()">
                        <span class="material-icons">
                            print
                        </span>
                        طباعة
                    </button>
                        
                </div>


            </div>
       </div>

 

        <div class="row">



            <div class="col-12">
                <div class="card my-4">

                  


                    <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2 ">
                        <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3 px-2">
                            <h6 class="text-white text-capitalize d-flex align-items-center">

                               <div>
                                    <span class="material-icons">
                                        person
                                    </span>
                                     أسم العميل : {{$order->address->first_name . ' ' . $order->address->last_name }}
                               </div>

                           
                            </h6>
                        </div>
                    </div>

                    <div class="col-md-12 mt-4">
                        <div class="card">
                            
                      
                              
                                 
                                <div class="card-body px-0 pb-2">
                                    <div class="table-responsive p-0">

                                       
                                        <div class="table-responsive p-0" id="table">
                                            <table class="table align-items-center mb-0 table-striped">
                                                <thead>
                                                    <tr class="text-center">
                                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 product-image">
                                                            <span class="material-icons align-middle">
                                                                image
                                                            </span>
                                                            صورة المنتج
                                                        </th>
                                                
                                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                            <span class="material-icons align-middle">
                                                                draw
                                                            </span>
                                                            اسم المنتج
                                                        </th>
                                                         <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                            <span class="material-icons align-middle">
                                                                category
                                                            </span>
                                                            تصنيف المنتج
                                                        </th>
             
                                                       
                                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                            <span class="material-icons align-middle">
                                                                paid
                                                            </span>
                                                                السعر وقت الطلب
                                                        </th>
                                                       
                                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                            <span class="material-icons align-middle">
                                                                discount
                                                            </span>
                                                                الخصم وقت الطلب
                                                        </th>
                                                        
                                                        <th
                                                            class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                            <span class="material-icons align-middle">
                                                                production_quantity_limits
                                                            </span>
                                                                الكمية المطلوبة
                                                        </th>
                                                        <th
                                                            class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                            <span class="material-icons align-middle">
                                                                payments
                                                            </span>
                                                                الاجمالي
                                                        </th>
                                                        <th
                                                        class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                        <span class="material-icons align-middle">
                                                            toggle_on
                                                        </span>
                                                            حالة العنصر
                                                        </th>

                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($order->orderitems as $orderitem)
                                                        <tr class="text-center">
                                                            <td class="product-image">
                                                                <img src="{{$orderitem->product->getFirstMediaUrl('product')}}" class="rounded-circle">
                                                            </td>
                                                            <td>
                                                                <p class="text-xs font-weight-bold mb-0">
                                                                    {{ $orderitem->product->name}}
                                                                </p>
                                                            </td>
                                                            <td>
                                                                <p class="text-xs font-weight-bold mb-0">
                                                                    {{ $orderitem->product->category->name}}
                                                                </p>
                                                            </td> 
                                                            <td>
                                                                <p class="text-xs font-weight-bold mb-0">
                                                                    {{Currency::format($orderitem->price)}}
                                                                </p>
                                                            </td>
                                                            <td>
                                                                <p class="text-xs font-weight-bold mb-0">
                                                                    {{$orderitem->discount_rate}}
                                                                </p>
                                                            </td>
            
                                                            <td>
                                                                <p class="text-xs font-weight-bold mb-0">
                                                                    {{$orderitem->quantity}}
                                                                </p>
                                                            </td>
            
                                                             <td>
                                                                <p class="text-xs font-weight-bold mb-0">
                                                                    {{$orderitem->total}}
                                                                </p>
                                                            </td>
                                                            
                                                            <td>
                                                                @switch($orderitem->status)
                                                                    @case('packed')
                                                                           <div class="order-status order-status-packed">
                                                                                <img src="{{asset('assets/media/dashboard/order/status/packed.svg')}}" class="product-image">
                                                                                في التعباءه
                                                                           </div> 
                                                                        @break
                                                                    @case('shipped')
                                                                        <div class="order-status order-status-shipped">
                                                                            <img src="{{asset('assets/media/dashboard/order/status/shipped.svg')}}" class="product-image">
            
                                                                            تم الشحن
                                                                        </div> 
                                                                        @break
                                                                    @case('in_delivery')
                                                                        <div class="order-status order-status-in_delivery">
                                                                            <img src="{{asset('assets/media/dashboard/order/status/in_delivery.svg')}}" class="product-image">
                                                                            في التوصيل
                                                                        </div> 
                                                                        @break
                                                                    @case('received')
                                                                        <div class="order-status order-status-received">
                                                                            <img src="{{asset('assets/media/dashboard/order/status/received.svg')}}" class="product-image">
                                                                            تم الاستلام
                                                                        </div> 
                                                                        @break
                                                                    @case('cancelled')
                                                                        <div class="order-status order-status-cancelled">
                                                                            <img src="{{asset('assets/media/dashboard/order/status/cancelled.svg')}}" class="product-image">
                                                                                ملغي 
                                                                        </div> 
                                                                        @break
                                                                    @case('refunded')
                                                                        <div class="order-status order-status-refunded">
                                                                            <img src="{{asset('assets/media/dashboard/order/status/refunded.svg')}}" class="product-image">
                                                                                مرتجع 
                                                                        </div> 
                                                                        @break
                                                                    @case('refund')
                                                                        <div class="order-status order-status-refunded">
                                                                            <img src="{{asset('assets/media/dashboard/order/status/refunded.svg')}}" class="product-image">
                                                                                طلب مرتجع 
                                                                        </div> 
                                                                        @break
                                                                    @case('completed')
                                                                        <div class="order-status order-status-completed">
                                                                            <img src="{{asset('assets/media/dashboard/order/status/completed.svg')}}" class="product-image">
                                                                            مكتمل
                                                                        </div> 
                                                                        @break
                                                                    @default
                                                                    <div class="order-status order-status-pending">
                                                                        <img src="{{asset('assets/media/dashboard/order/status/pending.svg')}}" class="product-image">
                                                                        قيد المراجعة
                                                                    </div> 
                                                                @endswitch
                                                            </td>
                                                        
                                                        
                                                                
                                                                
                                                        </tr>
                                                    @endforeach

                                                </tbody>
                                            </table>
                                        </div>
                            

                                    </div>
                                </div>
                            


                        </div>
                    </div>


                </div>
            </div>

        </div>
    </div>


    @push('script')
        <script src="{{asset('assets/js/dashboard/order/order.js')}}"></script>
        <script src="{{asset('assets/js/dashboard/jquery/order/order.js')}}"></script>
    @endpush

</x-Dashboard.Layout.Layout>

                                                           
                                                           