<x-Dashboard.Layout.Layout title="تفاصيل عرض ( {{ $offer->product['name_' . config('app.locale')] }} )">
    @push('style')
        <link rel="stylesheet" href="{{ asset('assets/css/dashboard/offer/offer.css') }}">
    @endpush
    <div class="container pt-5 pb-5">

        <div class="header-route-btn-container pb-2 px-3">
            <div class="header-route-btn-container">
                <a href="{{ route('dashboard.offers.index') }}">

                    <button class="btn bg-gradient-primary mb-0 toast-btn" type="button" data-target="infoToast">
                        <span class="material-icons">
                            inventory_2
                        </span>
                        العروض
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
                                    تفاصيل العرض :  {{ $offer->product['name_' . config('app.locale')] }}
                                </h4>

                            </div>
                        </div>


                        <div class="card-body w-70 m-auto">

                            <div class="container mt-5 mb-5">
                                <div class="row d-flex justify-content-center">
                                    <div class="col-md-10">
                                        <div class="card">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="images p-3">
                                                        <div class="text-center"> <img id="main-image"
                                                                src="{{ $offer->product->getFirstMediaUrl('product') }}"
                                                                width="250" /> </div>
                                                        <div class="thumbnail text-center"> 
                                                          @foreach ($offer->product->getMedia('product') as $image)
                                                           <img class="small" onclick="change_image(this)" src="{{$image->getUrl()}}" width="70">
                                                          @endforeach
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="product p-4">
                                                        <div class="d-flex justify-content-between align-items-center">
                                                            <a href="{{route('dashboard.offers.index')}}">
                                                              <div class="d-flex align-items-center"> 
                                                                <span class="material-icons"> play_arrow </span>
                                                                <span  class="ml-1">رجوع</span> 
                                                              </div> 
                                                            </a>
                                                            
                                                            <span class="material-icons"> shopping_cart </span>

                                                        </div>
                                                        <div class="mt-4 mb-3"> 
                                                            <span class="text-uppercase text-muted brand">
                                                                  <span class="material-icons">
                                                                    category
                                                                  </span>
                                                                  {{ $offer->product->category['name_' . config('app.locale')]}}
                                                            </span>
                                                            <h5 class="text-uppercase">
                                                              {{ $offer->product['name_' . config('app.locale')] }}
                                                            </h5>
                                                            <div class="user-price">
                                                              <p class="d-flex align-items-center">
                                                                <span class="material-icons">
                                                                  paid
                                                                </span>
                                                                السعر داخل العرض (للمستخدم)
                                                                
                                                              </p> 
                                                                <span class="act-price">
                                                                  السعر 
                                                                  : {{$offer->offer_user_price}}
                                                                </span>

                                                            </div>

                                                            <div class="trader-price">
                                                              <p class="d-flex align-items-center">
                                                                <span class="material-icons">
                                                                  paid
                                                                </span>
                                                                السعر داخل العرض (للتاجر)
                                                              </p> 

                                                                <span class="act-price">
                                                                      السعر 
                                                                      : {{$offer->offer_trader_price}}
                                                                </span>
                                                               
                                                            </div>
                                                            
                                                        </div>
                                                        <p class="about">
                                                          {{ $offer['description_' . config('app.locale')] }}
                                                        </p>
                                                       
                                                        <div class="sizes mt-5">
                                                            <h6 class="text-uppercase">
                                                              تحكم
                                                            </h6> 
                                                        </div>
                                                        <div class="cart mt-4 align-items-center d-flex"> 
                                                            <form action="{{route('dashboard.offers.destroy',$offer->id)}}" method="POST">
                                                              @csrf
                                                              @method('DELETE')
                                                              <button class="btn btn-danger text-uppercase mr-2 px-4">
                                                                <span class="material-icons">
                                                                  delete
                                                                </span>
                                                              </button> 
                                                            </form>
                                                            <a href="{{route('dashboard.offers.edit',$offer->id)}}" class="px-2">
                                                              <button type="button" class="btn btn-primary">
                                                                  <span class="material-icons">
                                                                      edit
                                                                  </span>
                                                              </button>
                                                            </a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
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
        <script src="{{ asset('assets/js/dashboard/offer/offer.js') }}"></script>
        <script src="{{ asset('assets/js/dashboard/jquery/offer/offer.js') }}"></script>
    @endpush
</x-Dashboard.Layout.Layout>
