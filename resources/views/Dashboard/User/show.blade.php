<x-Dashboard.Layout.Layout title="{{ $user->profile->full_name }}">
    @push('style')
        <link rel="stylesheet" href="{{ asset('assets/css/dashboard/user/user.css') }}">
    @endpush
    <div class="container pt-5 pb-5">

        <div class="header-route-btn-container pb-2 px-3">
            <div class="header-route-btn-container">
                <a href="{{ route('dashboard.users.index') }}">

                    <button class="btn bg-gradient-primary mb-0 toast-btn" type="button" data-target="infoToast">
                        <span class="material-icons">
                            people
                        </span>
                          المستخدمين
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
                                    {{ $user->profile->full_name }}
                                </h4>

                            </div>
                        </div>


                        
                        <div class="card-body px-0 pb-2">
                            <div class="table-responsive p-0">
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
                                                    @if($user->type=='trader')
                                                        تاجر
                                                    @else
                                                        مستخدم
                                                    @endif
                                                </p>
                                            </td>
                                            <td class="align-middle text-center text-sm">
                                                @if($user->status=='active')
                                                <span class="badge badge-sm bg-gradient-success">
                                                    مفعل
                                                </span>
                                                @else
                                                <span class="badge badge-sm bg-gradient-danger">
                                                    مؤرشف
                                                </span>
                                                @endif
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
                                      
                                    </tbody>
                                </table>
                            </div>
                        </div>



                    </div>
                </div>
            </div>

        </div>
    </div>
    @push('script')
        <script src="{{ asset('assets/js/dashboard/user/user.js') }}"></script>
        <script src="{{ asset('assets/js/dashboard/jquery/user/user.js') }}"></script>
    @endpush
</x-Dashboard.Layout.Layout>
