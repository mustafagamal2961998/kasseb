<div class="row statistics">
    <div class="col-lg-3 col-sm-6 mb-lg-0 mb-4">
        <div class="card">
            <div class="card-header p-3 pt-2">
                <div
                    class="icon icon-lg icon-shape bg-gradient-info shadow-info text-center border-radius-xl mt-n4 position-absolute end-0">
                    <i class="material-icons opacity-10">inventory_2</i>
                </div>
                <div class="text-start pt-1">
                    <p class="text-sm mb-0 text-capitalize">المنتجات</p>
                    <h4 class="mb-0">{{$productsCount}}</h4>
                </div>
            </div>
            <hr class="info horizontal my-0">
            <div class="card-footer p-3">
                <p class="mb-0 @if(config('app.locale')=='ar') text-end @else text-start @endif">
                    {{-- <span class="text-success text-sm font-weight-bolder ms-1">
                        20k
                    </span> --}}
                    <span class="material-icons align-middle">
                        inventory_2
                    </span>
                     <a href="{{route('dashboard.products.index')}}">
                        جميع المنتجات
                     </a>
                </p>
            </div>
        </div>
    </div>
    <div class="col-lg-3 col-sm-6 mb-lg-0 mb-4">
        <div class="card">
            <div class="card-header p-3 pt-2">
                <div
                    class="icon icon-lg icon-shape bg-gradient-primary shadow-primary text-center border-radius-xl mt-n4 position-absolute end-0">
                    <i class="material-icons opacity-10">list_alt</i>
                </div>
                <div class="text-start pt-1">
                    <p class="text-sm mb-0 text-capitalize">طلبات قيد المراجعة</p>
                    <h4 class="mb-0">
                        {{$pendingOrderCount}}
                    </h4>
                </div>
            </div>
            <hr class="dark horizontal my-0">
            <div class="card-footer p-3">
                <p class="mb-0 @if(config('app.locale')=='ar') text-end @else text-start @endif">
                    {{-- <span class="text-success text-sm font-weight-bolder ms-1">100 </span> --}}
                    <span class="material-icons align-middle">
                        list_alt
                    </span>
                    <a href="{{route('dashboard.orders.index')}}">
                        جميع الطلبات 
                    </a>
                </p>
            </div>
        </div>
    </div>
    <div class="col-lg-3 col-sm-6 mb-lg-0 mb-4">
        <div class="card">
            <div class="card-header p-3 pt-2">
                <div
                    class="icon icon-lg icon-shape bg-gradient-dark shadow-dark text-center border-radius-xl mt-n4 position-absolute end-0">
                    <i class="material-icons opacity-10">assignment_return</i>
                </div>
                <div class="text-start pt-1">
                    <p class="text-sm mb-0 text-capitalize">مرتجعات قيد المراجعة</p>
                    <h4 class="mb-0">
                        {{-- <span class="text-danger text-sm font-weight-bolder ms-1">-2%</span> --}}
                        {{$pendingRefundsCount}}
                    </h4>
                </div>
            </div>
            <hr class="dark horizontal my-0">
            <div class="card-footer p-3">
                <p class="mb-0 @if(config('app.locale')=='ar') text-end @else text-start @endif">
                    {{-- <span class="text-success text-sm font-weight-bolder ms-1">+5% </span> --}}
                    <span class="material-icons align-middle">
                        assignment_return
                    </span>
                     <a href="{{route('dashboard.refunds.index')}}">
                        جميع المرتجعات
                     </a>
                </p>
            </div>
        </div>
    </div>
    <div class="col-lg-3 col-sm-6">
        <div class="card">
            <div class="card-header p-3 pt-2">
                <div
                    class="icon icon-lg icon-shape bg-gradient-success shadow-success text-center border-radius-xl mt-n4 position-absolute end-0">
                    <i class="material-icons opacity-10">currency_exchange</i>
                </div>
                <div class="text-start pt-1">
                    <p class="text-sm mb-0 text-capitalize">مبيعات</p>
                    <h4 class="mb-0">
                        {{Currency::format($totalProfit)}}
                    </h4>
                </div>
            </div>
            <hr class="dark horizontal my-0">
            <div class="card-footer p-3">
                <p class="mb-0 @if(config('app.locale')=='ar') text-end @else text-start @endif">
                    <span class="material-icons align-middle">
                        currency_exchange
                    </span>
                        مبيعات جميع الطلبات المكتملة
                </p>
            </div>
        </div>
    </div>
</div>
