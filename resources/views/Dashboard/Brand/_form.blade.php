<div class="input-group input-group-outline my-3">
  <label for="name">
      أسم الماركة(عربي)
  </label>
  <input type="text" name="name" id="name" class="form-control" placeholder="أسم الماركة(عربي)" value="{{old('name',$brand->name)}}">
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
    <label for="brand_image">
        <p>صورة الماركة</p>
        <div>
            @if ($brand->hasMedia('brand'))
             <img class="brand-image-preview" src="{{$brand->getFirstMediaUrl('brand')}}" alt="Brand image">
            @else
             <img class="brand-image-preview" src="{{asset('assets/media/dashboard/external/img/form-file-input.svg')}}" alt="Category image">
            @endif
        </div>
     
    </label>
    <input type="file" name="image" id="brand_image" class="d-none">
  </div>
  @error('image')
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
