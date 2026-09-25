<div class="user-avatar-container">
    <div class="input-group input-group-outline my-3">
      <label for="admin_avatar">
          <p>صورة المسؤل</p>
          <div>
              @if ($admin->hasMedia('admin'))
               <img class="admin-image-preview" src="{{$admin->getFirstMediaUrl('admin')}}" alt="Admin Avatar">
              @else
               <img class="admin-image-preview" src="{{asset('assets/media/dashboard/external/img/form-file-input.svg')}}" alt="Admin Avatar">
              @endif
          </div>
       
      </label>
      <input type="file" name="avatar" id="admin_avatar" class="d-none">
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
    <label for="username">
        أسم المستخدم
    </label>
    <input type="text" name="username" id="username" class="form-control" placeholder="أسم المستخدم" value="{{old('username',$admin->username)}}">
  </div>
  
  @error('username')
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
    <input type="text" name="full_name" id="full_name" class="form-control" placeholder="الاسم كامل" value="{{old('full_name',$admin->full_name)}}">
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
 
  
  
    <div>
      <label for="active" class=" d-flex align-items-center">
          <input type="radio" name="status" id="active" @if(old('status',$admin->status)=='active') checked @endif value="active">
          مفعل
      </label>
      
      <label for="archived" class=" d-flex align-items-center">
          <input type="radio" name="status" id="archived" @if(old('status',$admin->status)=='archived') checked @endif value="archived">
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
  