<x-Dashboard.Layout.Layout title="العروض">
    @push('style')
        <link rel="stylesheet" href="{{asset('assets/css/dashboard/slider/slider.css')}}">
    @endpush
        <div class="container pt-5 pb-5">

            <div class="header-route-btn-container pb-2 px-3">
                <div class="header-route-btn-container">
                    <a href="{{route('dashboard.banners.create')}}">
                 
                        <button class="btn bg-gradient-primary  mb-0 toast-btn" type="button" data-target="infoToast">
                            <span class="material-icons">
                                add
                             </span>
                              إضافة بانر 
                        </button>
                    </a>
                </div>    
            </div>
            
            
            <div class="row">
                
                <div class="col-12">
                    <div class="card my-4">

                     

                        <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2 ">
                            <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3 px-2">
                                <h6 class="text-white text-capitalize ps-3 d-flex align-items-center">
                                    <span class="material-icons">
                                        category
                                     </span>
                                    جدول البانرات    
                                </h6>
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
                                                صورة البانر
                                            </th>
                                         <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                <span class="material-icons align-middle">
                                                    brand
                                                 </span>
                                                    الماركة
                                            </th>
                                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                <span class="material-icons align-middle">
                                                    draw
                                                 </span>
                                                 رقم الصف للبانر
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
                                        @forelse ($banners as $banner)
                                            <tr class="text-center">
                                                <td>
                                                    <a href="{{route('dashboard.banners.edit',$banner->id)}}" class="px-2">
                                                        <div>
                                                            <img src="{{$banner->getFirstMediaUrl('banner')}}"
                                                                class="avatar avatar-sm me-3 border-radius-lg" alt="banner">
                                                        </div>
                                                   </a>
                                                </td>
                                                 <td>
                                                    <p class="text-xs font-weight-bold mb-0">
                                                        {{ $banner->brand->name}}
                                                    </p>
                                                </td>
                                                <td>
                                                    <p class="text-xs font-weight-bold mb-0">
                                                        {{ $banner->order}}
                                                    </p>
                                                </td>
                                             
                                                <td class="d-flex justify-content-center">
                                                    <a href="{{route('dashboard.banners.edit',$banner->id)}}" class="px-2">
                                                        <button type="button" class="btn btn-danger">
                                                            <span class="material-icons">
                                                                edit
                                                            </span>
                                                        </button>
                                                    </a>
                                                    <form action="{{route('dashboard.banners.destroy',$banner->id)}}" method="POST" class="px-2">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-primary">
                                                            <span class="material-icons">
                                                                delete
                                                            </span>
                                                        </button>
                                                    </form>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr class="text-center">
                                                <td colspan="9">
                                                    لا يوجد بيانات حتي الان
                                                </td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    {{$banners->links()}}
                </div>

            </div>
        </div>

</x-Dashboard.Layout.Layout>
