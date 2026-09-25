    <div class="input-group input-group-outline my-3">
        <label for="name">
            أسم القسيمة
        </label>
        <input type="text" name="name" id="name" placeholder="أسم القسيمة" class="form-control" value="{{old('name',$coupon ->name)}}">
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
    <label for="discount_percentage">
        نسبة الخصم
    </label>
    <input type="number" name="discount_percentage" step=".5" id="discount_percentage" placeholder="نسبة الخصم" class="form-control" value="{{old('discount_percentage',$coupon ->discount_percentage)}}">
  </div>
  @error('discount_percentage')
    <div class="alert alert-primary alert-dismissible text-white" role="alert">
        <span class="text-sm">
            {{$message}}
        <button type="button" class="btn-close text-lg py-3 opacity-10" data-bs-dismiss="alert" aria-label="Close">
             <span aria-hidden="true">×</span>
        </button>
    </div>
  @enderror


  <div class="input-group input-group-outline my-3">
      <label for="start_date_time">
          تاريخ البداية
      </label>
      <input type="date" name="start_date_time" id="start_date_time" placeholder="تاريخ البداية" class="form-control" value="{{old('start_date_time',$coupon ->start_date_time)}}">
  </div>
  @error('start_date_time')
    <div class="alert alert-primary alert-dismissible text-white" role="alert">
        <span class="text-sm">
            {{$message}}
        <button type="button" class="btn-close text-lg py-3 opacity-10" data-bs-dismiss="alert" aria-label="Close">
             <span aria-hidden="true">×</span>
        </button>
    </div>
  @enderror

  <div class="input-group input-group-outline my-3">
      <label for="end_date_time">
          تاريخ النهاية
      </label>
      <input type="date" name="end_date_time" id="end_date_time" placeholder="تاريخ النهاية" class="form-control" value="{{old('end_date_time',$coupon ->end_date_time)}}">
  </div>
  @error('end_date_time')
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
