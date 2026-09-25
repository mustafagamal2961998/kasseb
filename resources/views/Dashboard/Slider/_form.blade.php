
<div class="input-group input-group-outline my-3">
  <label for="description_ar">
    وصف العنصر (عربي)
  </label>
  <textarea name="description_ar" id="description_ar" class="form-control" placeholder="وصف العنصر (عربي)">{{old('description_ar',$slider->description_ar)}}</textarea>
  </div>
  
  @error('description_ar')
  <div class="alert alert-primary alert-dismissible text-white" role="alert">
      <span class="text-sm">
          {{$message}}
      <button type="button" class="btn-close text-lg py-3 opacity-10" data-bs-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">×</span>
      </button>
  </div>
  @enderror

  
<div class="input-group input-group-outline my-3">
<label for="description_en">
  وصف العنصر (انجليزي)
</label>
<textarea name="description_en" id="description_en" class="form-control" placeholder="وصف العنصر (انجليزي)">{{old('description_en',$slider->description_en)}}</textarea>
</div>

@error('description_en')
<div class="alert alert-primary alert-dismissible text-white" role="alert">
    <span class="text-sm">
        {{$message}}
    <button type="button" class="btn-close text-lg py-3 opacity-10" data-bs-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">×</span>
    </button>
</div>
@enderror


<div class="input-group input-group-outline my-3">

<label for="description_en">
  اختار التصنيف
</label>
<select name="category_id" class="form-select">
  <option value="">
    بدون تصنيف
  </option>
  @foreach ($categories as $category)
    <option value="{{$category->id}}" @if(old('category_id',$slider->category_id)== $category->id) checked @endif>
      {{$category['name_' . config('app.locale')]}}
    </option>
  @endforeach
</select>
</div>

@error('category_id')
<div class="alert alert-primary alert-dismissible text-white" role="alert">
    <span class="text-sm">
        {{$message}}
    <button type="button" class="btn-close text-lg py-3 opacity-10" data-bs-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">×</span>
    </button>
</div>
@enderror


























<div class="input-group input-group-outline my-3">
<label for="slider_image" class="slide-images-label">
    <p class="w-100 text-end">صور العنصر</p>
    <div>
      <div id="imagePreview">
        @if ($slider->hasMedia('slider'))
          <img class="slider-image-preview" src="{{$slider->getFirstMediaUrl('slider')}}" alt="Slider image">
        @else
          <img class="slider-image-preview" src="{{asset('assets/media/dashboard/external/img/form-file-input.svg')}}" alt="Slider image">
        @endif 
      </div>

    </div>
 
</label>
<input type="file" name="slider" id="slider_image" class="d-none" multiple>
</div>
@error('slider')
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
      <input type="radio" name="status" id="active" @if(old('status',$slider->status)=='active') checked @endif value="active">
      مفعل
  </label>

  <label for="archived" class=" d-flex align-items-center">
      <input type="radio" name="status" id="archived" @if(old('status',$slider->status)=='archived') checked @endif value="archived">
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
