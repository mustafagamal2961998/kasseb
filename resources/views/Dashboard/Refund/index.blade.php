<x-Dashboard.Layout.Layout title="المرتجعات">

    @push('style')
        <link rel="stylesheet" href="{{ asset('assets/css/dashboard/refund/refund.css') }}">
    @endpush


    <div class="pt-5 pb-5">

        <div class="header-route-btn-container pb-2 px-3">
            <div class="header-route-btn-container">
                <div class="header-action">
                    <a href="{{ route('dashboard.products.create') }}">
                        <button class="btn bg-gradient-primary  mb-0 toast-btn" type="button" data-target="infoToast">
                            <span class="material-icons">
                                dashboard
                            </span>
                            لوحة القيادة
                        </button>
                    </a>

                    <form action="" method="POST">
                        <div class="input-group input-group-outline">
                            <input type="text"  id="search" name="search" class="form-control" placeholder="بحث : رقم الطلب | أسم العميل">
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
                                جدول المرتجعات
                            </h6>
                        </div>
                    </div>

                    <div class="col-md-12 mt-4">
                        <div class="card">
   
                            <div class="card-body px-0 pb-2">
                                <div class="table-responsive p-0" id="refunds-container">
                                    @include('Dashboard.Refund.Partials.refunds',['refunds'=>$refunds])
                                </div>
                            </div>


                        </div>
                    </div>
                </div>
                {{-- {{ $products->links() }} --}}
            </div>

        </div>
    </div>

    @push('script')
        <script src="{{asset('assets/js/dashboard/refund/refund.js')}}"></script>
        <script src="{{asset('assets/js/dashboard/jquery/refund/refund.js')}}"></script>
    @endpush

</x-Dashboard.Layout.Layout>

                                                           
                                                           