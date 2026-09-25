<div class="input-group input-group-outline my-3">
  <label for="website_name_ar">
    أسم المنصة (عربي)
  </label>
  <input type="text" name="website_name_ar" id="website_name_ar"  class="form-control" placeholder="أسم المنصة (عربي)" value="{{ old('website_name_ar',$setting->website_name_ar)}}">
</div>
@error('website_name_ar')
  <div class="alert alert-primary alert-dismissible text-white" role="alert">
      <span class="text-sm">
          {{$message}}
      <button type="button" class="btn-close text-lg py-3 opacity-10" data-bs-dismiss="alert" aria-label="Close">
           <span aria-hidden="true">×</span>
      </button>
  </div>
@enderror

<div class="input-group input-group-outline my-3">
  <label for="website_name_en">
    أسم المنصة (انجليزي)
  </label>
  <input type="text" name="website_name_en" id="website_name_en"  placeholder="أسم المنصة (انجليزي)" class="form-control" value="{{ old('website_name_en', $setting->website_name_en)}}">
</div>
@error('website_name_en')
  <div class="alert alert-primary alert-dismissible text-white" role="alert">
      <span class="text-sm">
          {{$message}}
      <button type="button" class="btn-close text-lg py-3 opacity-10" data-bs-dismiss="alert" aria-label="Close">
           <span aria-hidden="true">×</span>
      </button>
  </div>
@enderror




<div class="input-group input-group-outline my-3">
  <label for="website_bio_ar">
    وصف المنصة (عربي)
  </label>
  <textarea name="website_bio_ar" id="website_bio_ar" class="form-control" placeholder="وصف المنصة (عربي)">{{old('website_bio_ar',$setting->website_bio_ar)}}</textarea>
</div>

@error('website_bio_ar')
  <div class="alert alert-primary alert-dismissible text-white" role="alert">
      <span class="text-sm">
          {{$message}}
      <button type="button" class="btn-close text-lg py-3 opacity-10" data-bs-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">×</span>
      </button>
  </div>
@enderror




<div class="input-group input-group-outline my-3">
  <label for="website_bio_en">
    وصف المنصة (انجليزي)
  </label>
  <textarea name="website_bio_en" id="website_bio_en" class="form-control" placeholder="وصف المنصة (انجليزي)">{{old('website_bio_en',$setting->website_bio_en)}}</textarea>
</div>

@error('website_bio_en')
  <div class="alert alert-primary alert-dismissible text-white" role="alert">
      <span class="text-sm">
          {{$message}}
      <button type="button" class="btn-close text-lg py-3 opacity-10" data-bs-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">×</span>
      </button>
  </div>
@enderror




<div class="input-group input-group-outline my-3">
  <label for="refund_day">
      عدد ايام الاسترجاع
  </label>
  <input type="text" name="refund_day" id="refund_day"  placeholder="عدد ايام الاسترجاع" class="form-control" value="{{ old('refund_day', $setting->refund_day)}}">
</div>
@error('refund_day')
  <div class="alert alert-primary alert-dismissible text-white" role="alert">
      <span class="text-sm">
          {{$message}}
      <button type="button" class="btn-close text-lg py-3 opacity-10" data-bs-dismiss="alert" aria-label="Close">
           <span aria-hidden="true">×</span>
      </button>
  </div>
@enderror
<div class="input-group input-group-outline my-3">
  <label for="minimum_order_price">
      الحد الادنى للطلب
  </label>
  <input type="number" name="minimum_order_price" id="minimum_order_price"  placeholder="الحد الادنى للطلب" class="form-control" value="{{ old('minimum_order_price', $setting->minimum_order_price)}}">
</div>
@error('minimum_order_price')
  <div class="alert alert-primary alert-dismissible text-white" role="alert">
      <span class="text-sm">
          {{$message}}
      <button type="button" class="btn-close text-lg py-3 opacity-10" data-bs-dismiss="alert" aria-label="Close">
           <span aria-hidden="true">×</span>
      </button>
  </div>
@enderror

<div class="input-group input-group-outline my-3">
  <label for="shipping_amount">
      قيمة الشحن
  </label>
  <input type="number" name="shipping_amount" id="shipping_amount"  placeholder="قيمة الشحن" class="form-control" value="{{ old('shipping_amount', $setting->shipping_amount)}}">
</div>
@error('shipping_amount')
  <div class="alert alert-primary alert-dismissible text-white" role="alert">
      <span class="text-sm">
          {{$message}}
      <button type="button" class="btn-close text-lg py-3 opacity-10" data-bs-dismiss="alert" aria-label="Close">
           <span aria-hidden="true">×</span>
      </button>
  </div>
@enderror


{{-- <div class="input-group input-group-outline my-3">
  <label for="main_bg_color">
      اللون الاساسي : 
      <span class="main-color-example">
        مثال : 195deg, #EC407A 0%, #D81B60 100%
      </span>
  </label>
  <input type="text" name="main_bg_color" id="main_bg_color"  placeholder="اللون الاساسي" class="form-control" value="{{ old('main_bg_color', $setting->main_bg_color)}}">
</div>
@error('main_bg_color')
  <div class="alert alert-primary alert-dismissible text-white" role="alert">
      <span class="text-sm">
          {{$message}}
      <button type="button" class="btn-close text-lg py-3 opacity-10" data-bs-dismiss="alert" aria-label="Close">
           <span aria-hidden="true">×</span>
      </button>
  </div>
@enderror
<div class="input-group input-group-outline my-3">
  <label for="main_bg_color_on_hover">
      اللون الاساسي عند المؤشر بالموس: 
      <span class="color-example">
        مثال : 195deg, #EC407A 0%, #D81B60 100%
      </span>
  </label>
  <input type="text" name="main_bg_color_on_hover" id="main_bg_color_on_hover"  placeholder="اللون الاساسي عند المؤشر بالموس" class="form-control" value="{{ old('main_bg_color_on_hover', $setting->main_bg_color_on_hover)}}">
</div>
@error('main_bg_color_on_hover')
  <div class="alert alert-primary alert-dismissible text-white" role="alert">
      <span class="text-sm">
          {{$message}}
      <button type="button" class="btn-close text-lg py-3 opacity-10" data-bs-dismiss="alert" aria-label="Close">
           <span aria-hidden="true">×</span>
      </button>
  </div>
@enderror



<div class="input-group input-group-outline my-3">
  <label for="main_color_text">
      اللون النص الاساسي : 
      <span class="color-example">
        مثال : #ffffff
      </span>
  </label>
  <input type="color" name="main_color_text" id="main_color_text"  placeholder="اللون النص الاساسي" class="form-control" value="{{ old('main_color_text', $setting->main_color_text)}}">
</div>
@error('main_color_text')
  <div class="alert alert-primary alert-dismissible text-white" role="alert">
      <span class="text-sm">
          {{$message}}
      <button type="button" class="btn-close text-lg py-3 opacity-10" data-bs-dismiss="alert" aria-label="Close">
           <span aria-hidden="true">×</span>
      </button>
  </div>
@enderror
<div class="input-group input-group-outline my-3">
  <label for="main_color_text_on_hover">
      اللون الاساسي للنص عند المؤشر بالموس: 
      <span class="color-example">
        مثال : #ffffff
      </span>
  </label>
  <input type="color" name="main_color_text_on_hover" id="main_color_text_on_hover"  placeholder="اللون الاساسي للنص عند المؤشر بالموس" class="form-control" value="{{ old('main_color_text_on_hover', $setting->main_color_text_on_hover)}}">
</div>
@error('main_color_text_on_hover')
  <div class="alert alert-primary alert-dismissible text-white" role="alert">
      <span class="text-sm">
          {{$message}}
      <button type="button" class="btn-close text-lg py-3 opacity-10" data-bs-dismiss="alert" aria-label="Close">
           <span aria-hidden="true">×</span>
      </button>
  </div>
@enderror



<div class="input-group input-group-outline my-3">
  <label for="main_color_text_without_bg">
      اللون الاساسي للنص بدون خلفية:
      <span class="color-example">
        مثال : #222222
      </span>
  </label>
  <input type="color" name="main_color_text_without_bg" id="main_color_text_without_bg"  placeholder="اللون الاساسي للنص بدون خلفية" class="form-control" value="{{ old('main_color_text_without_bg', $setting->main_color_text_without_bg)}}">
</div>
@error('main_color_text_without_bg')
  <div class="alert alert-primary alert-dismissible text-white" role="alert">
      <span class="text-sm">
          {{$message}}
      <button type="button" class="btn-close text-lg py-3 opacity-10" data-bs-dismiss="alert" aria-label="Close">
           <span aria-hidden="true">×</span>
      </button>
  </div>
@enderror


<div class="input-group input-group-outline my-3">
  <label for="main_link_color_text">
      اللون الاساسي للنص الخاص بالروابط: 
      <span class="color-example">
        مثال : #253D4E
      </span>
  </label>
  <input type="color" name="main_link_color_text" id="main_link_color_text"  placeholder="اللون الاساسي للنص الخاص بالروابط" class="form-control" value="{{ old('main_link_color_text', $setting->main_link_color_text)}}">
</div>
@error('main_link_color_text')
  <div class="alert alert-primary alert-dismissible text-white" role="alert">
      <span class="text-sm">
          {{$message}}
      <button type="button" class="btn-close text-lg py-3 opacity-10" data-bs-dismiss="alert" aria-label="Close">
           <span aria-hidden="true">×</span>
      </button>
  </div>
@enderror

<div class="input-group input-group-outline my-3">
  <label for="main_link_color_text_on_hover">
      اللون الاساسي للنص الخاص بالروابط عند المؤشر بالموس: 
      <span class="color-example">
        مثال : #1c93e7
      </span>
  </label>
  <input type="color" name="main_link_color_text_on_hover" id="main_link_color_text_on_hover"  placeholder="اللون الاساسي للنص الخاص بالروابط عند المؤشر بالموس" class="form-control" value="{{ old('main_link_color_text_on_hover', $setting->main_link_color_text_on_hover)}}">
</div>
@error('main_link_color_text_on_hover')
  <div class="alert alert-primary alert-dismissible text-white" role="alert">
      <span class="text-sm">
          {{$message}}
      <button type="button" class="btn-close text-lg py-3 opacity-10" data-bs-dismiss="alert" aria-label="Close">
           <span aria-hidden="true">×</span>
      </button>
  </div>
@enderror --}}



<div class="input-group input-group-outline my-3">
  <label for="logo_image" class="logo-images-label">
      <p class="w-100 text-end">شعار المنصة</p>
      <div>
        <div id="imagePreview">
   
          @if ($setting->hasMedia('logo'))
            <img class="logo-image-preview" src="{{$setting->getFirstMediaUrl('logo')}}" alt="Logo image">
          @else
            <img class="logo-image-preview" src="{{asset('assets/media/dashboard/external/img/form-file-input.svg')}}" alt="Logo image">
          @endif 
        </div>

      </div>
   
  </label>
  <input type="file" name="logo" id="logo_image" class="d-none" multiple>
</div>



@error('logo')
  <div class="alert alert-primary alert-dismissible text-white" role="alert">
      <span class="text-sm">
          {{$message}}
      <button type="button" class="btn-close text-lg py-3 opacity-10" data-bs-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">×</span>
      </button>
  </div>
@enderror


<div class="input-group input-group-outline my-3">
  <label for="delivery_status" class="logo-images-label">
      <p class="w-100 text-end d-flex align-items-center">
          تفعيل التوصيل
        <input type="checkbox" name="delivery_status" id="delivery_status" @if($setting->delivery_status) checked @endif>
      </p>
     
  </label>

</div>

@error('delivery_status')
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
