<x-Dashboard.Layout.Layout title="المستخدمين">
    
    @push('style')
        <link rel="stylesheet" href="{{asset('assets/css/dashboard/user/user.css')}}">
    @endpush


        <div class="pt-5 pb-5">

            <div class="header-route-btn-container pb-2 px-3">
                <div class="header-route-btn-container">
                    <div class="header-action">
                        <a href="{{route('dashboard.users.create')}}">
                    
                            <button class="btn bg-gradient-primary  mb-0 toast-btn" type="button" data-target="infoToast">
                                <span class="material-icons">
                                    add
                                </span>
                                إضافة مستخدم 
                            </button>
                        </a>
                        <form action="" id="typeFilterForm">
                            <div class="header-action-users-type-filter-check">

                                <div class="form-check all">
                                    <input type="checkbox" class="form-check-input" id="all">
                                    <label for="all">
                                        الجميع ({{$usersAndTradersCount}})
                                    </label>
                                </div>
                                <div class="form-check deliveries">
                                    <input type="checkbox" class="form-check-input" name="role[]" id="deliveries" value="deliver">
                                    <label for="deliveries">
                                        الديليفري ({{$deliveryCount}})
                                    </label>
                                </div>
                                
                                <div class="form-check users">
                                    <input type="checkbox" class="form-check-input" name="role[]" id="users" value="user">
                                    <label for="users">
                                       المستخدمين ({{$usersCount}})
                                    </label>
                                </div>
    
                            </div>

                        </form>
                    
                        

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
                                     جدول المستخدمين والعملاء     
                                </h6>
                            </div>
                        </div>


                        <div class="card-body px-0 pb-2">
                            <div class="table-responsive p-0" id="users-container">
                              @include('Dashboard.User.Partials.users',['users'=>$users])
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
        @push('script')
            <script src="{{asset('assets/js/dashboard/user/user.js')}}"></script>
            <script src="{{asset('assets/js/dashboard/jquery/user/user.js')}}"></script>
        @endpush

</x-Dashboard.Layout.Layout>
