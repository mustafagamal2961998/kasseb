<table class="table align-items-center mb-0">
    <thead>
        <tr class="text-center">
            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                <span class="material-icons align-middle">
                    image
                 </span>
                صورة العميل
                
            </th>
            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                <span class="material-icons align-middle">
                    login
                 </span>
                تسجيل الدخول
            </th>
          
            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                <span class="material-icons align-middle">
                    draw
                 </span>
                أسم العميل
            </th>
          

            <th
                class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                <span class="material-icons align-middle">
                    money
                 </span>
                    الرصيد الحالي
            </th>

         
            <th
                class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                <span class="material-icons align-middle">
                    checklist_rtl
                 </span>
               نوع المستخدم
            </th>
        
            <th
                class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                <span class="material-icons align-middle">
                    toggle_on
                 </span>
                الحالة
            </th>
              <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                <span class="material-icons align-middle">
                    toggle_on
                </span>
                تغير الحالة
            </th>
            <th
            class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                <span class="material-icons align-middle">
                    info
                </span>
                عرض التفاصيل
            </th>
            <th
                class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                    <span class="material-icons align-middle">
                        tune
                    </span>
                تحكم
            </th>
            
        </tr>
    </thead>
    <tbody>
       @forelse ($users as $user)
        <tr class="text-center">
            <td>
                <div class="d-flex px-2 py-1">
                    <div class="m-auto">
                        <img src="{{$user->getFirstMediaUrl('avatar')}}"
                            class="avatar avatar-sm me-3 border-radius-lg" alt="user1">
                    </div>
                
                </div>
            </td>
            <td>
                <p class="text-xs font-weight-bold mb-0">
                    <a href="{{route('dashboard.users.edit',$user->id)}}">
                        {{ $user->phone }}
                    </a>
                </p>
            </td>
            <td>
                <p class="text-xs font-weight-bold mb-0">
                    <a href="{{route('dashboard.users.edit',$user->id)}}">
                        {{ $user->profile->full_name }}
                    </a>
                </p>
            </td>
        
            
            <td>
                {{ $user->balance }}
            </td>
        
            <td>
                <p class="text-xs font-weight-bold mb-0">
                    @if($user->role=='deliver')
                        ديليفري
                    @else
                        مستخدم
                    @endif
                </p>
            </td>
              <td class="user-status align-middle text-center text-sm" data-id="{{ $user->id }}">
                    @if ($user->status == 'active')
                        <span class="badge badge-sm bg-gradient-success">
                            مفعل
                        </span>
                    @else
                        <span class="badge badge-sm bg-gradient-danger">
                            محظور
                        </span>
                    @endif
            </td>
            <td>
                <div class="form-check form-switch">
                    <input class="form-check-input user-switch-status" name="status" type="checkbox"
                        data-id="{{ $user->id }}" @checked($user->status == 'active')>
                </div>
            </td>
          
            <td class="align-middle text-center">
                <a href="{{route('dashboard.users.show',$user->id)}}">
                    <button type="button" class="btn btn-info">
                        <span class="material-icons">
                            visibility
                         </span>
                    </button>
                </a>
            </td>
            <td class="d-flex justify-content-center">
                <a href="{{route('dashboard.users.edit',$user->id)}}" class="px-2">
                    <button type="button" class="btn btn-primary">
                        <span class="material-icons">
                            edit
                         </span>
                    </button>
                </a>
                
                <form action="{{route('dashboard.users.destroy',$user->id)}}" method="POST" class="px-2">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">
                        <span class="material-icons">
                            delete
                         </span>
                    </button>
                </form>
            </td>
        </tr>
        @empty
            <tr class="text-center">
                <td colspan="7">
                    لا يوجد بيانات حتي الان
                </td>
            </tr>
        @endforelse 
    </tbody>
</table>

{{$users->links()}}
