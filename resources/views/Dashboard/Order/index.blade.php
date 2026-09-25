<x-Dashboard.Layout.Layout title="الطلبات">

    @push('style')
        <link rel="stylesheet" href="{{ asset('assets/css/dashboard/order/order.css') }}">
    @endpush


    <div class="pt-5 pb-5">

        <div class="header-route-btn-container pb-2 px-3">
            <div class="header-route-btn-container">
                <div class="header-action">
                    <a href="{{ route('dashboard.home.index') }}">
                        <button class="btn bg-gradient-primary  mb-0 toast-btn" type="button" data-target="infoToast">
                            <span class="material-icons">
                                dashboard
                            </span>
                            لوحة القيادة
                        </button>
                    </a>
                      
                    <form action="" id="statusFilterForm">
                        <div class="header-action-orders-status-filter-check">
                            <div class="form-check all">
                                <input type="checkbox" class="form-check-input" id="all">
                                <label for="all">
                                    الجميع
                                </label>
                            </div>

                            <div class="form-check pending">
                                <input type="checkbox" class="form-check-input" name="status[]" id="pending" value="pending">
                                <label for="pending">
                                    قيد المراجعة
                                </label>
                            </div>

                            <div class="form-check packed">
                                <input type="checkbox" class="form-check-input" name="status[]" id="packed" value="packed">
                                <label for="packed">
                                    في التعباءه
                                </label>
                            </div>
                            
                            <div class="form-check shipped">
                                <input type="checkbox" class="form-check-input" name="status[]" id="shipped" value="shipped">
                                <label for="shipped">
                                    تم الشحن
                                </label>
                            </div>
                            <div class="form-check in_delivery">
                                <input type="checkbox" class="form-check-input" name="status[]" id="in_delivery" value="in_delivery">
                                <label for="in_delivery">
                                    في التوصيل
                                </label>
                            </div>
                            <div class="form-check received">
                                <input type="checkbox" class="form-check-input" name="status[]" id="received" value="received">
                                <label for="received">
                                    تم الاستلام
                                </label>
                            </div>
                            <div class="form-check cancelled">
                                <input type="checkbox" class="form-check-input" name="status[]" id="cancelled" value="cancelled">
                                <label for="cancelled">
                                    ملغي
                                </label>
                            </div>
                            <div class="form-check refunded">
                                <input type="checkbox" class="form-check-input" name="status[]" id="refunded" value="refunded">
                                <label for="refunded">
                                    مرتجع
                                </label>
                            </div>
                            <div class="form-check completed">
                                <input type="checkbox" class="form-check-input" name="status[]" id="completed" value="completed">
                                <label for="completed">
                                    مكتمل
                                </label>
                            </div>
                        </div>
                    </form>
                    
                    <form action="" method="POST">
                        <div class="input-group input-group-outline">
                            <input type="text"  id="search" name="search" class="form-control" placeholder="بحث : رقم الطلب | أسم العميل | الحالة">
                        </div>
                    </form>
                </div>
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
                                جدول الطلبات الجديدة
                            </h6>
                        </div>
                    </div>

                    <div class="card">
                        <div class="card-body px-0 pb-2" >
                            <div class="table-responsive p-0">
                                <div class="col-md-12 mt-4" id="orders-container">
                                    @include('Dashboard.Order.Partials.orders',['orders'=>$orders])
                                </div>
                            </div>
                        </div>
                    </div>

                    {{ $orders->links() }}




                </div>
            </div>

        </div>
    </div>

    @push('script')
        <script src="{{asset('assets/js/dashboard/order/order.js')}}"></script>
        <script src="{{asset('assets/js/dashboard/jquery/order/order.js')}}"></script>
    @endpush

</x-Dashboard.Layout.Layout>

                                                           
                                                           