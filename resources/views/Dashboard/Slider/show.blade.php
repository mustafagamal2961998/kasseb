<x-Dashboard.Layout.Layout title="{{ $slider['description_' . config('app.locale')] }}">
    @push('style')
      <link rel="stylesheet" href="{{asset('assets/css/dashboard/category/category.css')}}">
    @endpush
    <div class="container pt-5 pb-5">

        <div class="header-route-btn-container pb-2 px-3">
            <div class="header-route-btn-container">
                <a href="{{route('dashboard.categories.index')}}">
             
                    <button class="btn bg-gradient-primary  mb-0 toast-btn" type="button" data-target="infoToast">
                       
                        <span class="material-icons">
                            category
                         </span>
                        جميع العناصر
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
                                    inventory_2
                                </span> 
                                وصف العنصر : 
                                @if($slider['description_' . config('app.locale')])
                                {{ $slider['description_' . config('app.locale')] }}
                                @else
                                لا يوجد وصف
                                @endif
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
                                            صورة العنصر
                                        </th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            <span class="material-icons align-middle">
                                                description
                                             </span>
                                            وصف العنصر
                                        </th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            <span class="material-icons align-middle">
                                                category
                                             </span>
                                             التصنيف
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
                                                <div>
                                                    <img src="{{$slider->getFirstMediaUrl('slider')}}"
                                                        class="avatar avatar-sm me-3 border-radius-lg" alt="user1">
                                                </div>
                                            </td>
                                            <td>
                                                <a href="{{route('dashboard.sliders.edit',$slider->id)}}">
                                                    <p class="text-xs font-weight-bold mb-0">
                                                        @if($slider['description_' . config('app.locale')])
                                                            {{ $slider['description_' . config('app.locale')] }}
                                                        @else
                                                            لا يوجد وصف
                                                        @endif
                                                    </p>
                                                </a>
                                            </td>
                                            <td>
                                                <p class="text-xs font-weight-bold mb-0">
                                                    {{ $slider->category['name_' . config('app.locale')] }}
                                                </p>
                                            </td>
                                        
                                            <td class="align-middle text-center text-sm">
                                                @if($slider->status=='active')
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
                                                <a href="{{route('dashboard.sliders.edit',$slider->id)}}" class="px-2">
                                                    <button type="button" class="btn btn-danger">
                                                        <span class="material-icons">
                                                            edit
                                                        </span>
                                                    </button>
                                                </a>
                                                
                                                <form action="{{route('dashboard.sliders.destroy',$slider->id)}}" method="POST" class="px-2">
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
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                
            </div>

        </div>
    </div>

</x-Dashboard.Layout.Layout>
