<div class="user-avatar-container">
  <div class="input-group input-group-outline my-3">
    <label for="user_avatar">
        <p>صورة المستخدم</p>
        <div>
            @if ($user->hasMedia('avatar'))
             <img class="user-image-preview" src="{{$user->getFirstMediaUrl('avatar')}}" alt="User Avatar">
            @else
             <img class="user-image-preview" src="{{asset('assets/media/dashboard/external/img/form-file-input.svg')}}" alt="User Avatar">
            @endif
        </div>
     
    </label>
    <input type="file" name="avatar" id="user_avatar" class="d-none">
  </div>
  @error('avatar')
    <div class="alert alert-primary alert-dismissible text-white" role="alert">
        <span class="text-sm">
            {{$message}}
        <button type="button" class="btn-close text-lg py-3 opacity-10" data-bs-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">×</span>
        </button>
    </div>
  @enderror
  
    
</div>
  
  

  

<div class="input-group input-group-outline my-3">
  <label for="phone">
      رقم الهاتف
  </label>
  <input type="text" name="phone" id="phone" class="form-control" placeholder="رقم الهاتف" value="{{old('phone',$user->phone)}}">
</div>

@error('phone')
<div class="alert alert-primary alert-dismissible text-white" role="alert">
    <span class="text-sm">
        {{$message}}
    <button type="button" class="btn-close text-lg py-3 opacity-10" data-bs-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">×</span>
    </button>
</div>
@enderror



<div class="input-group input-group-outline my-3">
    <label for="password">
        كلمة المرور
    </label>
    <input type="password" name="password" id="password" class="form-control" placeholder="كلمة المرور" value="{{old('password')}}">
</div>

@error('password')
  <div class="alert alert-primary alert-dismissible text-white" role="alert">
      <span class="text-sm">
          {{$message}}
      <button type="button" class="btn-close text-lg py-3 opacity-10" data-bs-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">×</span>
      </button>
  </div>
@enderror




<div class="input-group input-group-outline my-3">
  <label for="full_name">
      الاسم كامل
  </label>
  <input type="text" name="full_name" id="full_name" class="form-control" placeholder="الاسم كامل" value="{{old('full_name',$user->profile->full_name)}}">
</div>

@error('full_name')
<div class="alert alert-primary alert-dismissible text-white" role="alert">
    <span class="text-sm">
        {{$message}}
    <button type="button" class="btn-close text-lg py-3 opacity-10" data-bs-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">×</span>
    </button>
</div>
@enderror

{{-- 
<div class="input-group input-group-outline my-3">
  <label for="mobile">
     رقم الهاتف
  </label>
  <input type="text" name="mobile" id="mobile" class="form-control" placeholder="رقم الهاتف" value="{{old('mobile',$user->profile->mobile)}}">
</div>

@error('mobile')
<div class="alert alert-primary alert-dismissible text-white" role="alert">
    <span class="text-sm">
        {{$message}}
    <button type="button" class="btn-close text-lg py-3 opacity-10" data-bs-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">×</span>
    </button>
</div>
@enderror




<div class="input-group input-group-outline my-3">
  <label for="address">
     العنوان
  </label>
  <input type="text" name="address" id="address" class="form-control" placeholder="العنوان" value="{{old('address',$user->profile->address)}}">
</div>

@error('address')
<div class="alert alert-primary alert-dismissible text-white" role="alert">
    <span class="text-sm">
        {{$message}}
    <button type="button" class="btn-close text-lg py-3 opacity-10" data-bs-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">×</span>
    </button>
</div>
@enderror --}}





<div class="input-group input-group-outline my-3">
  <label for="balance">
      الرصيد
  </label>
  <input type="number" name="balance" id="balance" class="form-control" placeholder="الرصيد" value="{{old('balance',$user->balance)}}">
</div>

@error('balance')
<div class="alert alert-primary alert-dismissible text-white" role="alert">
    <span class="text-sm">
        {{$message}}
    <button type="button" class="btn-close text-lg py-3 opacity-10" data-bs-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">×</span>
    </button>
</div>
@enderror




<div class="input-group input-group-outline my-3">
  <label for="role">
    اختار الدور
  </label>
  <select name="role" id="role" class="form-select">
    <option disabled>
      اختار الدور
    </option>
    <option value="user" @if(old('role',$user->role)== 'user') selected @endif>
      مستخدم
    </option>
    <option value="deliver" @if(old('role',$user->role)== 'deliver') selected @endif>
      ديليفري
    </option>
  </select>
</div>

@error('role')
  <div class="alert alert-primary alert-dismissible text-white" role="alert">
      <span class="text-sm">
          {{$message}}
      <button type="button" class="btn-close text-lg py-3 opacity-10" data-bs-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">×</span>
      </button>
  </div>
@enderror

{{-- <div class="input-group input-group-outline my-3">
  <label for="work_type">
     نشاط العمل
  </label>
  <select name="work_type" id="work_type" class="form-select">
    <option disabled>
      اختار نشاط العمل
    </option>
    <option value="super_market" @if(old('work_type',$user->profile->work_type)== 'super_market') selected @endif>
      سوبر ماركت
    </option>
    <option value="restaurant" @if(old('work_type',$user->profile->work_type)== 'restaurant') selected @endif>
      مطعم
    </option>
    <option value="cafee" @if(old('work_type',$user->profile->work_type)== 'cafee') selected @endif>
      كافية
    </option>
    <option value="other" @if(old('work_type',$user->profile->work_type)== 'other') selected @endif>
      اخر
    </option>
  </select>
</div>

@error('work_type')
  <div class="alert alert-primary alert-dismissible text-white" role="alert">
      <span class="text-sm">
          {{$message}}
      <button type="button" class="btn-close text-lg py-3 opacity-10" data-bs-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">×</span>
      </button>
  </div>
@enderror --}}





  <div>
    <label for="active" class=" d-flex align-items-center">
        <input type="radio" name="status" id="active" @if(old('status',$user->status)=='active') checked @endif value="active">
        مفعل
    </label>
    
    <label for="blocked" class=" d-flex align-items-center">
        <input type="radio" name="status" id="blocked" @if(old('status',$user->status)=='blocked') checked @endif value="blocked">
        محظور
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
