<x-Dashboard.Layout.Layout title="من نحن">
    @push('style')
      <link rel="stylesheet" href="{{asset('assets/css/dashboard/about/about.css')}}">
      
    @endpush
    <div class="container pt-5 pb-5">

        <div class="header-route-btn-container pb-2 px-3">
            <div class="header-route-btn-container">
                <a href="{{route('dashboard.home.index')}}">
             
                    <button class="btn bg-gradient-primary mb-0 toast-btn" type="button" data-target="infoToast">
                      <span class="material-icons">
                        dashboard
                      </span> 
                      لوحة القيادة
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
                        تعديل من نحن
                      </h4>
                      
                    </div>
                  </div>
                   
                  <div class="card-body w-70 m-auto">
                    <form role="form" action="{{route('dashboard.abouts.update',$about->id)}}" method="POST" class="text-start">
                        @csrf
                        @method('PUT')

                            <div class="input-group input-group-outline my-3">
                                <label for="content_ar">
                                    من نحن  (عربي)
                                </label>
                                <textarea name="content_ar" id="content_ar" class="form-control" placeholder="من نحن (عربي)">{{old('content_ar',$about->content_ar)}}</textarea>
                            </div>

                            @error('content_ar')
                                <div class="alert alert-primary alert-dismissible text-white" role="alert">
                                    <span class="text-sm">
                                        {{$message}}
                                    <button type="button" class="btn-close text-lg py-3 opacity-10" data-bs-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">×</span>
                                    </button>
                                </div>
                            @enderror
                            
                            <div class="input-group input-group-outline my-3">
                                <label for="content_en">
                                     من نحن   (انجليزي)
                                </label>
                                <textarea name="content_en" id="content_en" class="form-control" placeholder="من نحن (انجليزي)">{{old('content_en',$about->content_en)}}</textarea>
                            </div>

                            @error('content_en')
                                <div class="alert alert-primary alert-dismissible text-white" role="alert">
                                    <span class="text-sm">
                                        {{$message}}
                                    <button type="button" class="btn-close text-lg py-3 opacity-10" data-bs-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">×</span>
                                    </button>
                                </div>
                            @enderror

                            <div class="text-center">
                                <button type="submit" class="btn bg-gradient-info w-100 mb-0 toast-btn">
                                   تعديل
                                </button>
                            </div>
                            
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
        <script src="{{asset('assets/js/dashboard/about/about.js')}}"></script>
        <script src="{{asset('assets/js/dashboard/jquery/about/about.js')}}"></script>
    @endpush
</x-Dashboard.Layout.Layout>
