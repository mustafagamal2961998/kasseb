<x-Dashboard.Layout.Layout title="المسؤلين">
    
    @push('style')
        <link rel="stylesheet" href="{{asset('assets/css/dashboard/admin/admin.css')}}">
    @endpush


        <div class="pt-5 pb-5">

            <div class="header-route-btn-container pb-2 px-3">
                <div class="header-route-btn-container">
                    <div class="header-action">
                        <a href="{{route('dashboard.admins.create')}}">
                    
                            <button class="btn bg-gradient-primary  mb-0 toast-btn" type="button" data-target="infoToast">
                                <span class="material-icons">
                                    add
                                </span>
                                إضافة مسؤل 
                            </button>
                        </a>
                        <form action="" method="POST">
                            <div class="input-group input-group-outline">
                                <input type="text" id="search" name="search" class="form-control"
                                    placeholder="بحث : أسم العميل">
                            </div>
                        </form>
                    </div>
                </div>    
            </div>
            
            
            <div class="row">
                
                <div class="col-12">
                    <div class="card my-4">

                     

                        <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2 ">
                            <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3 px-2">
                                <h6 class="text-white text-capitalize d-flex align-items-center">
                                    <span class="material-icons">
                                        people
                                     </span>
                                     جدول المسؤلين      
                                </h6>
                            </div>
                        </div>


                        <div class="card-body px-0 pb-2">
                            <div class="table-responsive p-0" id="users-container">
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
                                                    toggle_on
                                                 </span>
                                                الحالة
                                            </th>
                                            {{-- <th
                                            class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                <span class="material-icons align-middle">
                                                    info
                                                </span>
                                                عرض التفاصيل
                                            </th> --}}
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
                                       @forelse ($admins as $admin)
                                        <tr class="text-center">
                                            <td>
                                                <div class="d-flex px-2 py-1">
                                                    <div class="m-auto">
                                                        <img src="{{$admin->getFirstMediaUrl('avatar')}}"
                                                            class="avatar avatar-sm me-3 border-radius-lg">
                                                    </div>
                                                
                                                </div>
                                            </td>
                                            <td>
                                                <p class="text-xs font-weight-bold mb-0">
                                                    <a href="{{route('dashboard.admins.edit',$admin->id)}}">
                                                        {{ $admin->username }}
                                                    </a>
                                                </p>
                                            </td>
                                            <td>
                                                <p class="text-xs font-weight-bold mb-0">
                                                    <a href="{{route('dashboard.admins.edit',$admin->id)}}">
                                                        {{ $admin->full_name }}
                                                    </a>
                                                </p>
                                            </td>

                                          

                                            <td class="align-middle text-center text-sm">
                                                @if($admin->status=='active')
                                                    <span class="badge badge-sm bg-gradient-success">
                                                        مفعل
                                                    </span>
                                                @else
                                                    <span class="badge badge-sm bg-gradient-danger">
                                                        مؤرشف
                                                    </span>
                                                @endif
                                            </td>
                                
                                          
                                            {{-- <td class="align-middle text-center">
                                                <a href="{{route('dashboard.admins.show',$admin->id)}}">
                                                    <button type="button" class="btn btn-info">
                                                        <span class="material-icons">
                                                            visibility
                                                         </span>
                                                    </button>
                                                </a>
                                            </td> --}}
                                            <td class="d-flex justify-content-center">
                                                <a href="{{route('dashboard.admins.edit',$admin->id)}}" class="px-2">
                                                    <button type="button" class="btn btn-primary">
                                                        <span class="material-icons">
                                                            edit
                                                         </span>
                                                    </button>
                                                </a>
                                                
                                                <form action="{{route('dashboard.admins.destroy',$admin->id)}}" method="POST" class="px-2">
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
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
        @push('script')
            <script src="{{asset('assets/js/dashboard/admin/admin.js')}}"></script>
            <script src="{{asset('assets/js/dashboard/jquery/admin/admin.js')}}"></script>
        @endpush

</x-Dashboard.Layout.Layout>
