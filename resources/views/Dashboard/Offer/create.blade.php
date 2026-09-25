<x-Dashboard.Layout.Layout title="إضافة منتج جديد">
  @push('style')
    <link rel="stylesheet" href="{{asset('assets/css/dashboard/offer/offer.css')}}">
  @endpush
    <div class="container pt-5 pb-5">

        <div class="header-route-btn-container pb-2 px-3">
            <div class="header-route-btn-container">
                <a href="{{route('dashboard.offers.index')}}">
             
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
                        عرض جديد
                      </h4>
                      
                    </div>
                  </div>
                   
                  <div class="card-body w-70 m-auto">
                    <form role="form" action="{{route('dashboard.offers.store')}}" method="POST" class="text-start" enctype="multipart/form-data">
                        @csrf
                        @include('Dashboard.Offer._form',['text'=>'إضافة','offer'=>$offer])
                    </form>
                  </div>
                </div>
              </div>
            </div>

        </div>
    </div>
    @push('script')
        <script src="{{asset('assets/js/dashboard/offer/offer.js')}}"></script>
        <script src="{{asset('assets/js/dashboard/jquery/offer/offer.js')}}"></script>
        <script>
              $(document).ready(function() {
                  $('#product_keyword').on('keyup', function() {
                      var query = $(this).val();
                      
                      if (query.length > 0) { // Start searching after 2 characters
                          $.ajax({
                              url: "{{ route('dashboard.products.search') }}",
                              type: 'GET',
                              data: { query: query },
                              success: function(data) {

                              $('#product_results').empty();
                                  if (data.length > 0) {
                                      $.each(data, function(index, product) {
                                         $('#product_results').append(`
                                              <div class="product-item" data-id="${product.id}">
                                                
                                                <img src="${product.image}" width="80" alt="${product.name}" />
                                            
                                                <p class="product-name">
                                                  <strong>${product.name}</strong>
                                                </p>
                                            
                                                <p class="product-price">
                                                  💰 سعر الوحدة: <span>${product.unit_price} جنيه</span>
                                                </p>
                                            
                                                <p class="product-price">
                                                  📦 سعر العبوة: <span>${product.box_price} جنيه</span>
                                                </p>
                                            
                                              </div>
                                            `);


                                          
                                          
                                          
                                          
                                           
                                      });
                                  } else {
                                      $('#product_results').append('<p>لا يوجد نتائج</p>');
                                  }
                              }
                          });

                      } else {
                          $('#product_results').empty(); // Clear results if input is too short
                      }
                  });

                  // Handle product selection
                  $(document).on('click', '.product-item', function() {
                      var productId = $(this).data('id'); // Get the selected product ID
                      $('#product_id').val(productId); // Set it in the hidden input
                      $('#product_results').empty(); // Clear the search results
                      $('#product_keyword').val($(this).find('p:last').text()); // Set the product name in the search input
                  });
              });

        </script>
    @endpush
</x-Dashboard.Layout.Layout>
