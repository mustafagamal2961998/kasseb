<x-Dashboard.Layout.Layout title="إضافة منتج جديد">
  @push('style')
    <link rel="stylesheet" href="{{asset('assets/css/dashboard/product/product.css')}}">
  @endpush
    <div class="container pt-5 pb-5">

        <div class="header-route-btn-container pb-2 px-3">
            <div class="header-route-btn-container">
                <a href="{{route('dashboard.products.index')}}">
             
                    <button class="btn bg-gradient-primary mb-0 toast-btn" type="button" data-target="infoToast">
                      <span class="material-icons">
                        inventory_2
                       </span>  
                       المنتجات
                    </button>
                </a>
            </div>    
        </div>
        
        
        <div class="row">
            
            <div class="col-lg-12 col-md-8 col-12 mx-auto">
                <div class="card my-4">

                <div class="card z-index-0 fadeIn3 fadeInBottom">
                  <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                    <div class="bg-gradient-primary shadow-primary border-radius-lg py-3 pe-1">
                      <h4 class="text-white font-weight-bolder text-center mt-2 mb-0">
                        منتج جديد
                      </h4>
                      
                    </div>
                  </div>
                   
                  <div class="card-body w-70 m-auto">
                    <form role="form" action="{{route('dashboard.products.store')}}" method="POST" class="text-start" enctype="multipart/form-data">
                        @csrf
                        @include('Dashboard.Product._form',['text'=>'إضافة','product'=>$product,'categories'=>$categories])
                    </form>
                  </div>
                </div>
              </div>
            </div>

        </div>
    </div>
    @push('script')
        <script>
          const lang = "{{config('app.locale')}}";
        </script>
        <script src="{{asset('assets/js/dashboard/product/product.js')}}"></script>
        <script src="{{asset('assets/js/dashboard/jquery/product/product.js')}}"></script>
    @endpush
</x-Dashboard.Layout.Layout>
