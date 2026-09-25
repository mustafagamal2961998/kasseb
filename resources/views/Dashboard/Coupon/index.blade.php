<x-Dashboard.Layout.Layout title="قسائم الخصم">
    
    @push('style')
        <link rel="stylesheet" href="{{asset('assets/css/dashboard/coupon/coupon.css')}}">
    @endpush


        <div class="container pt-5 pb-5">

            <div class="header-route-btn-container pb-2 px-3">
                <div class="header-route-btn-container">
                    <a href="{{route('dashboard.coupons.create')}}">
                 
                        <button class="btn bg-gradient-primary  mb-0 toast-btn" type="button" data-target="infoToast">
                            <span class="material-icons">
                                add
                             </span>
                             إضافة قسيمة خصم 
                        </button>
                    </a>
                </div>    
            </div>
            
            
            <div class="row">
                
                <div class="col-12">
                    <div class="card my-4">

                     

                        <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2 ">
                            <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3 px-2">
                                <h6 class="text-white text-capitalize d-flex align-items-center">
                                    <span class="material-icons">
                                        inventory_2
                                     </span>
                                     جدول القسيمات     
                                </h6>
                            </div>
                        </div>


                        <div class="card-body px-0 pb-2">
                            <div class="table-responsive p-0">
                                <table class="table align-items-center mb-0">
                                    <thead>
                                        <tr class="text-center">
                                            <th
                                                class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                                <span class="material-icons align-middle">
                                                    password
                                                </span>
                                                    أسم القسيمة
                                            </th>
                                            <th
                                                class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                                <span class="material-icons align-middle">
                                                    password
                                                 </span>
                                                    كود القسيمة
                                            </th>
                                            <th
                                                class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                                <span class="material-icons align-middle">
                                                    percent
                                                 </span>
                                                نسبة الخصم
                                            </th>

                                            <th
                                                class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                <span class="material-icons align-middle">
                                                    calendar_month
                                                 </span>
                                                  تاريخ بداية التفعيل
                                            </th>
    
                                            <th
                                                class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                <span class="material-icons align-middle">
                                                    calendar_month
                                                 </span>
                                                 تاريخ نهاية التفعيل
                                            </th>
    
                                            <th
                                                class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                <span class="material-icons align-middle">
                                                    toggle_on
                                                </span>
                                                الحالة
                                            </th>
                                            <th
                                                class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                    <span class="material-icons align-middle">
                                                        tune
                                                    </span>
                                                تحكم
                                            </th>
                                            
                                        </tr>
                                    </thead>
                                    <tbody>
                                       @forelse ($coupons as $coupon)
                                        <tr class="text-center">
                                           
                                            <td>
                                                <p class="text-xs font-weight-bold mb-0">
                                                      {{ $coupon->name}}

                                                </p>
                                            </td>
                                            <td>
                                                <p class="text-xs font-weight-bold mb-0">
                                                      {{ $coupon->coupon}}

                                                </p>
                                            </td>
                                            <td>
                                                <p class="text-xs font-weight-bold mb-0">
                                                    {{ $coupon->discount_percentage}}
                                                </p>
                                            </td>
                                            <td>
                                                <p class="text-xs font-weight-bold mb-0">
                                                    {{ $coupon->start_date_time->format('Y-m-d H:i a')}}
                                                </p>
                                            </td>
                                            <td>
                                                <p class="text-xs font-weight-bold mb-0">
                                                    {{ $coupon->end_date_time->format('Y-m-d H:i a')}}
                                                </p>
                                            </td>
                                            <td class="align-middle text-center text-sm">
                                                @if($coupon->status=='active')
                                             
                                                    <span class="badge badge-sm bg-gradient-success">
                                                        مفعل
                                                    </span>
                                                @else
                                                    <span class="badge badge-sm bg-gradient-info">
                                                        منتهي
                                                    </span>
                                                @endif
                                            </td>
                                           
                                            <td class="d-flex justify-content-center">
                                                <a href="{{route('dashboard.coupons.edit',$coupon->id)}}" class="px-2">
                                                    <button type="button" class="btn btn-primary">
                                                        <span class="material-icons">
                                                            edit
                                                         </span>
                                                    </button>
                                                </a>

                                                <form action="{{route('dashboard.coupons.destroy',$coupon->id)}}" method="POST" class="px-2">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger">
                                                        <span class="material-icons">
                                                            delete
                                                         </span>
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
                            </div>
                        </div>
                    </div>
                    {{-- {{$contacts->links()}} --}}
                </div>

            </div>
        </div>

</x-Dashboard.Layout.Layout>
