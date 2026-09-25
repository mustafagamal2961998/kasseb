
@if ($errors->any())
    <div>
        <ul>
            @foreach ($errors->all() as $error)
                <li>
                  <div class="alert alert-primary alert-dismissible text-white" role="alert">
                        <span class="text-sm">
                           {{ $error }}
                        <button type="button" class="btn-close text-lg py-3 opacity-10" data-bs-dismiss="alert" aria-label="Close">
                              <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    
                    </li>
                            
            @endforeach
        </ul>
    </div>
@endif
<style>
.details-tabs-container {
    width: 100%;
    margin-bottom: 20px;
}

.details-tabs-content-list-items {
    display: flex;
    list-style: none;
    padding: 0;
    margin: 0;
    gap: 10px;
    flex-wrap: wrap;
}

.details-tabs-content-item {
    flex: 1;
    min-width: 120px;
}

.details-tabs-content-item .btn {
    width: 100%;
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 5px;
    padding: 10px 15px;
    font-size: 14px;
    white-space: nowrap;
}

.details-tabs-content-item .material-icons {
    font-size: 18px;
}

/* Mobile Responsive */
@media (max-width: 768px) {
    .details-tabs-content-list-items {
        flex-direction: column;
        gap: 8px;
    }
    .basic-input,.price-input,.details-input{
        padding-top: 90px;
    }
    .details-tabs-content-item {
        width: 100%;
        min-width: 100%;
    }
    
    .details-tabs-content-item .btn {
        font-size: 15px;
        padding: 12px 15px;
    }
    
    .details-tabs-content-item .material-icons {
        font-size: 20px;
    }
}

@media (max-width: 480px) {
    .details-tabs-content-item .btn {
        font-size: 14px;
        padding: 10px 12px;
    }
}
</style>

<div class="details-tabs-container">
    <div class="details-tabs-content">

        <ul class="details-tabs-content-list-items">
          <li class="details-tabs-content-item">
         
              <button class="btn bg-gradient-primary mb-0 toast-btn" onclick="activeInput('basic-input','details-input','price-input')" type="button">
                <span class="material-icons">
                  description
                 </span> 
                الاساسي
              </button>
          </li>
          <li class="details-tabs-content-item">
           
              <button class="btn bg-gradient-primary mb-0 toast-btn " onclick="activeInput('price-input','basic-input','details-input')" type="button">
                <span class="material-icons">
                  sell
                 </span> 
                السعر
              </button>
          </li>
          <li class="details-tabs-content-item">
            
            <button class="btn bg-gradient-primary mb-0 toast-btn"   onclick="activeInput('details-input','basic-input','price-input')" type="button">
              <span class="material-icons">
                info
               </span> 
              تفاصيل مهمة
            </button>
          </li>
        </ul>
    </div>
  </div>
  
  
  <div class="basic-input">
      <div class="input-group input-group-outline my-3">
          <label for="name">
              أسم المنتج
          </label>
          <input type="text" name="name" id="name" class="form-control" placeholder="أسم المنتج" value="{{old('name',$product->name)}}">
      </div>

      @error('name')
        <div class="alert alert-primary alert-dismissible text-white" role="alert">
            <span class="text-sm">
                {{$message}}
            <button type="button" class="btn-close text-lg py-3 opacity-10" data-bs-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">×</span>
            </button>
        </div>
      @enderror


      <div class="input-group input-group-outline my-3">
        <label for="description">
            وصف المنتج 
        </label>
        <textarea name="description" id="description" class="form-control" placeholder="وصف المنتج">{{old('description',$product->description)}}</textarea>
      </div>

      @error('description')
        <div class="alert alert-primary alert-dismissible text-white" role="alert">
            <span class="text-sm">
                {{$message}}
            <button type="button" class="btn-close text-lg py-3 opacity-10" data-bs-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">×</span>
            </button>
        </div>
      @enderror


   
@php
    $selectedBrand = $brands->firstWhere('id', old('brand_id', $product->brand_id));
    $selectedCategory = $categories->firstWhere('id', old('category_id', $product->category_id));
@endphp

<!-- ================== BRAND ================== -->
<div class="input-group input-group-outline my-3">
    <!--<label class="form-label">اختار الماركة</label>-->

    <input type="text"
           id="brand_search"
           class="form-control"
           list="brands_list"
           value="{{ $selectedBrand?->name }}">

    <input type="hidden"
           name="brand_id"
           id="brand_id"
           value="{{ old('brand_id', $product->brand_id) }}">

    <datalist id="brands_list">
        @foreach ($brands as $brand)
            <option value="{{ $brand->name }}"></option>
        @endforeach
    </datalist>
</div>

@error('brand_id')
<div class="alert alert-primary text-white">{{ $message }}</div>
@enderror
<!-- ================== CATEGORY ================== -->
<div class="input-group input-group-outline my-3">
    <!--<label class="form-label">اختار التصنيف</label>-->

    <input type="text"
           id="category_search"
           class="form-control"
           list="categories_list"
           value="{{ $selectedCategory?->name }}">

    <input type="hidden"
           name="category_id"
           id="category_id"
           value="{{ old('category_id', $product->category_id) }}">

    <datalist id="categories_list">
        @foreach ($categories as $category)
            <option value="{{ $category->name }}"></option>
        @endforeach
    </datalist>
</div>

@error('category_id')
<div class="alert alert-primary text-white">{{ $message }}</div>
@enderror


    <script>
    const brands = @json($brands);
    const categories = @json($categories);

    document.getElementById('brand_search').addEventListener('change', function () {
        const selected = brands.find(b => b.name === this.value);
        document.getElementById('brand_id').value = selected ? selected.id : '';
    });

    document.getElementById('category_search').addEventListener('change', function () {
        const selected = categories.find(c => c.name === this.value);
        document.getElementById('category_id').value = selected ? selected.id : '';
    });
</script>

      <button class="btn bg-gradient-primary mb-0 toast-btn " onclick="activeInput('price-input','basic-input','details-input')" type="button">
   
        التالي
        <span class="material-icons next-form-input-tab">
          arrow_forward_ios
         </span> 
      </button>
  </div>



 
   <div class="price-input">
      <div class="input-group input-group-outline my-3">
        <label for="unit_price">
          سعر العبوة
        </label>
        <input type="number" name="unit_price" step="0.25" id="unit_price" class="form-control" placeholder="سعر العبوة" value="{{old('unit_price',$product->unit_price)}}">
      </div>
      @error('unit_price')
        <div class="alert alert-primary alert-dismissible text-white" role="alert">
            <span class="text-sm">
                {{$message}}
            <button type="button" class="btn-close text-lg py-3 opacity-10" data-bs-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">×</span>
            </button>
        </div>
      @enderror

      <div class="input-group input-group-outline my-3">
        <label for="box_price">
          سعر الكرتونة
        </label>
        <input type="number" name="box_price" step="0.25" id="box_price" class="form-control" placeholder="سعر الكرتونة" value="{{old('box_price',$product->box_price)}}">
      </div>
      @error('box_price')
        <div class="alert alert-primary alert-dismissible text-white" role="alert">
            <span class="text-sm">
                {{$message}}
            <button type="button" class="btn-close text-lg py-3 opacity-10" data-bs-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">×</span>
            </button>
        </div>
      @enderror


      <div class="input-group input-group-outline my-3">
        <label for="discount_rate">
          نسبة الخصم
        </label>
        <input type="number" name="discount_rate" id="discount_rate" step="0.25" class="form-control" placeholder="نسبة الخصم" value="{{old('discount_rate',$product->discount_rate ?? 0)}}" min="0">
      </div>
      @error('discount_rate')
        <div class="alert alert-primary alert-dismissible text-white" role="alert">
            <span class="text-sm">
                {{$message}}
            <button type="button" class="btn-close text-lg py-3 opacity-10" data-bs-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">×</span>
            </button>
        </div>
      @enderror



      <div class="input-group input-group-outline my-3">
        <label for="unit_stock">
          الكمية للعبوة
        </label>
        <input type="number" name="unit_stock" id="unit_stock" class="form-control" placeholder="الكمية للعبوة" value="{{old('unit_stock',$product->unit_stock)}}">
      </div>
      @error('unit_stock')
        <div class="alert alert-primary alert-dismissible text-white" role="alert">
            <span class="text-sm">
                {{$message}}
            <button type="button" class="btn-close text-lg py-3 opacity-10" data-bs-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">×</span>
            </button>
        </div>
      @enderror

      <div class="input-group input-group-outline my-3">
        <label for="box_stock">
          الكمية للكرتونة
        </label>
        <input type="number" name="box_stock" id="box_stock" class="form-control" placeholder="الكمية للكرتونة" value="{{old('box_stock',$product->box_stock)}}">
      </div>
      @error('box_stock')
        <div class="alert alert-primary alert-dismissible text-white" role="alert">
            <span class="text-sm">
                {{$message}}
            <button type="button" class="btn-close text-lg py-3 opacity-10" data-bs-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">×</span>
            </button>
        </div>
      @enderror


      <div class="input-group input-group-outline my-3">
        <label for="minimum_stock">
          الحد الادني للكمية
        </label>
        <input type="number" name="minimum_stock" id="minimum_stock" class="form-control" placeholder="الحد الادني للكمية" value="{{old('minimum_stock',$product->minimum_stock)}}">
      </div>
      @error('minimum_stock')
        <div class="alert alert-primary alert-dismissible text-white" role="alert">
            <span class="text-sm">
                {{$message}}
            <button type="button" class="btn-close text-lg py-3 opacity-10" data-bs-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">×</span>
            </button>
        </div>
      @enderror
      
      <div class="input-group input-group-outline my-3">
        <label for="maximum_order">
          الحد الاقصي للطلب
        </label>
        <input type="number" name="maximum_order" id="maximum_order" class="form-control" placeholder="الحد الاقصي للطلب" value="{{old('maximum_order',$product->maximum_order)}}">
      </div>
      @error('maximum_order')
        <div class="alert alert-primary alert-dismissible text-white" role="alert">
            <span class="text-sm">
                {{$message}}
            <button type="button" class="btn-close text-lg py-3 opacity-10" data-bs-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">×</span>
            </button>
        </div>
      @enderror
      
      <button class="btn bg-gradient-primary mb-0 toast-btn"   onclick="activeInput('details-input','basic-input','price-input')" type="button">
            التالي
            <span class="material-icons next-form-input-tab">
              info
            </span> 
      </button>
   </div>





<div class="details-input">

      @error('package_type')
        <div class="alert alert-primary alert-dismissible text-white" role="alert">
            <span class="text-sm">
                {{$message}}
            <button type="button" class="btn-close text-lg py-3 opacity-10" data-bs-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">×</span>
            </button>
        </div>
      @enderror


    <div class="input-group input-group-outline my-3">
          
      <input type="checkbox" name="best_seller" id="best_seller" value="1" @if(old('best_seller',$product->best_seller)==1) checked @endif>
        <label for="best_seller">
          الاكثر مبيعا
        </label>
      </div>

      @error('best_seller')
        <div class="alert alert-primary alert-dismissible text-white" role="alert">
            <span class="text-sm">
                {{$message}}
            <button type="button" class="btn-close text-lg py-3 opacity-10" data-bs-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">×</span>
            </button>
        </div>
      @enderror





      <div class="input-group input-group-outline my-3">
        <label for="product_image" class="product-images-label">
            <p class="w-100 text-end">صور المنتج</p>
            <div>
              <div id="imagePreview">
                @if ($product->hasMedia('product'))
                @foreach ($product->getMedia('product') as $image)
                  <img class="product-image-preview" src="{{$image->getUrl()}}" alt="Product image">
                @endforeach
                @else
                  <img class="product-image-preview" src="{{asset('assets/media/dashboard/external/img/form-file-input.svg')}}" alt="Product image">
                @endif 
              </div>

            </div>
        
        </label>
        <input type="file" name="images[]" id="product_image" class="d-none" multiple>
      </div>
      @error('images.*')
        <div class="alert alert-primary alert-dismissible text-white" role="alert">
            <span class="text-sm">
                {{$message}}
            <button type="button" class="btn-close text-lg py-3 opacity-10" data-bs-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">×</span>
            </button>
        </div>
      @enderror





      <div>
        <label for="active" class=" d-flex align-items-center">
            <input type="radio" name="status" id="active" @if(old('status',$product->status)=='active') checked @endif value="active">
            مفعل
        </label>
        
        <label for="archived" class=" d-flex align-items-center">
            <input type="radio" name="status" id="archived" @if(old('status',$product->status)=='archived') checked @endif value="archived">
            مؤرشف
        </label>
      </div>
      @error('status')
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
            {{$text}}
        </button>
      </div>


</div>

<script>
// Script للربط بين datalist والـ hidden input
document.getElementById('brand_search').addEventListener('input', function() {
    const input = this.value;
    const datalist = document.getElementById('brands_list');
    const hiddenInput = document.getElementById('brand_id');
    
    // البحث عن الـ option المطابق
    const option = Array.from(datalist.options).find(opt => opt.value === input);
    
    if (option) {
        hiddenInput.value = option.getAttribute('data-id');
    } else {
        hiddenInput.value = '';
    }
});

document.getElementById('category_search').addEventListener('input', function() {
    const input = this.value;
    const datalist = document.getElementById('categories_list');
    const hiddenInput = document.getElementById('category_id');
    
    // البحث عن الـ option المطابق
    const option = Array.from(datalist.options).find(opt => opt.value === input);
    
    if (option) {
        hiddenInput.value = option.getAttribute('data-id');
    } else {
        hiddenInput.value = '';
    }
});
</script>