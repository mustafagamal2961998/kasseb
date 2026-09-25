<x-Dashboard.Layout.Layout title="المنتجات">

    @push('style')
        <link rel="stylesheet" href="{{ asset('assets/css/dashboard/product/product.css') }}">
    @endpush


    <div class="w-100 pt-5 pb-5 m-auto">

        <div class="header-route-btn-container pb-2 px-3">
            <div class="header-route-btn-container">
                <div class="header-action">
                    <a href="{{ route('dashboard.products.create') }}">
                        <button class="btn bg-gradient-primary  mb-0 toast-btn" type="button" data-target="infoToast">
                            <span class="material-icons">
                                add
                            </span>
                            إضافة منتج
                        </button>
                    </a>



                    <form action="" method="POST">
                        <div class="input-group input-group-outline">
                            <input type="text" id="search" name="search" class="form-control"
                                placeholder="بحث : رقم الطلب | أسم المنتج | القسم">
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
                                جدول المنتجات
                            </h6>
                        </div>
                    </div>

                    <div class="card">
                        <div class="card-body px-0 pb-2">
                            <div class="table-responsive p-0">

                                <div class="col-md-12 mt-4" id="products-container">
                                    @include('Dashboard.Product.Partials.products', [
                                        'products' => $products,
                                    ])
                                </div>
                            </div>

                        </div>
                    </div>


                </div>
            </div>
        </div>
    </div>

    @push('script')
        <script src="{{ asset('assets/js/dashboard/product/product.js') }}"></script>
        <script src="{{ asset('assets/js/dashboard/jquery/product/product.js') }}"></script>
    @endpush

</x-Dashboard.Layout.Layout>
