<div class="input-group input-group-outline my-3">
    <label for="name_ar">
        أسم التصنيف(عربي)
    </label>
    <input type="text" name="name_ar" id="name_ar" placeholder="أسم التصنيف(عربي)" class="form-control" value="{{old('name_ar',$category->name_ar)}}">
  </div>
  @error('name_ar')
    <div class="alert alert-primary alert-dismissible text-white" role="alert">
        <span class="text-sm">
            {{$message}}
        <button type="button" class="btn-close text-lg py-3 opacity-10" data-bs-dismiss="alert" aria-label="Close">
             <span aria-hidden="true">×</span>
        </button>
    </div>
  @enderror

  <div class="input-group input-group-outline my-3">
    <label for="name_en">
        أسم التصنيف(انجليزي)
    </label>
    <input type="text" name="name_en" id="name_en" placeholder="أسم التصنيف(انجليزي)" class="form-control" value="{{old('name_en',$category->name_en)}}">
  </div>
  @error('name_en')
    <div class="alert alert-primary alert-dismissible text-white" role="alert">
        <span class="text-sm">
            {{$message}}
        <button type="button" class="btn-close text-lg py-3 opacity-10" data-bs-dismiss="alert" aria-label="Close">
             <span aria-hidden="true">×</span>
        </button>
    </div>
  @enderror




  <div class="input-group input-group-outline my-3">
    <label for="description_ar">
      وصف التصنيف(عربي)
    </label>
    <textarea name="description_ar" id="description_ar" class="form-control" placeholder="وصف التصنيف (عربي)">{{old('description_ar',$category->description_ar)}}</textarea>
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
      أسم التصنيف(انجليزي)
    </label>
    <textarea name="description_en" id="description_en" class="form-control" placeholder="وصف التصنيف (انجليزي)">{{old('description_en',$category->description_en)}}</textarea>
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
        اختار التصنيف الاب
      </label>
      
      <select name="category_id" class="form-select">
          <option value="">
            اختار التصنيف الاب
          </option>
          @foreach ($parents as $parent)
            <option value="{{$parent->id}}" @if($parent->id == $category->category_id) selected @endif>
              {{$parent['name_' . config('app.locale')]}}
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
      
    <label for="description_en">
        حدد لون الخلفية
    </label>
    
    <input type="color" name="bg_color" value="{{old('bg_color',$category->bg_color)}}">

</div>

@error('bg_color')
  <div class="alert alert-primary alert-dismissible text-white" role="alert">
      <span class="text-sm">
          {{$message}}
      <button type="button" class="btn-close text-lg py-3 opacity-10" data-bs-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">×</span>
      </button>
  </div>
@enderror


  <div class="input-group input-group-outline my-3">
    <label for="category_image">
        <p>صورة التصنيف</p>
        <div>
            @if ($category->hasMedia('category'))
             <img class="category-image-preview" src="{{$category->getFirstMediaUrl('category')}}" alt="Category image">
            @else
             <img class="category-image-preview" src="{{asset('assets/media/dashboard/external/img/form-file-input.svg')}}" alt="Category image">
            @endif
        </div>
     
    </label>
    <input type="file" name="image" id="category_image" class="d-none">
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

  <div>
    <label for="active" class=" d-flex align-items-center">
        <input type="radio" name="status" id="active" @if(old('status',$category->status)=='active') checked @endif value="active">
        مفعل
    </label>
    
    <label for="archived" class=" d-flex align-items-center">
        <input type="radio" name="status" id="archived" @if(old('status',$category->status)=='archived') checked @endif value="archived">
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
