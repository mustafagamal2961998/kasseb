<x-Dashboard.Layout.Layout title="العروض">
    @push('style')
        <link rel="stylesheet" href="{{asset('assets/css/dashboard/slider/slider.css')}}">
    @endpush
        <div class="container pt-5 pb-5">

            <div class="header-route-btn-container pb-2 px-3">
                <div class="header-route-btn-container">
                    <a href="{{route('dashboard.offers.create')}}">
                 
                        <button class="btn bg-gradient-primary  mb-0 toast-btn" type="button" data-target="infoToast">
                            <span class="material-icons">
                                add
                             </span>
                              إضافة عرض 
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
                                    جدول العروض    
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
                                                صورة المنتج
                                            </th>
                                       
                                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                <span class="material-icons align-middle">
                                                    draw
                                                 </span>
                                                 اسم المنتج
                                            </th>
                                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                <span class="material-icons align-middle">
                                                    category
                                                 </span>
                                                 تصنيف المنتج
                                            </th>

                                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                <span class="material-icons align-middle">
                                                    description
                                                 </span>
                                                    وصف العرض
                                            </th>
                                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                <span class="material-icons align-middle">
                                                    paid
                                                 </span>
                                                    سعر العبوة داخل العرض
                                            </th>
                                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                <span class="material-icons align-middle">
                                                    paid
                                                 </span>
                                                    سعر الكرتونة داخل العرض
                                            </th>
                                            {{-- <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                <span class="material-icons align-middle">
                                                    paid
                                                 </span>
                                                    سعر العرض (للتاجر)
                                            </th> --}}

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
                                                    info
                                                </span>
                                                عرض
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
                                        @forelse ($offers as $offer)
                                            <tr class="text-center">
                                                <td>
                                                    <a href="{{route('dashboard.offers.edit',$offer->id)}}">
                                                        <div>
                                                            <img src="{{$offer->product->getFirstMediaUrl('product')}}"
                                                                class="avatar avatar-sm me-3 border-radius-lg" alt="user1">
                                                        </div>
                                                    </a>
                                                </td>
                                                <td>
                                                    <a href="{{route('dashboard.offers.edit',$offer->id)}}">
                                                        <p class="text-xs font-weight-bold mb-0">
                                                            {{ $offer->product->name }}
                                                        </p>
                                                    </a>
                                                </td>
                                                <td>
                                                    <p class="text-xs font-weight-bold mb-0">
                                                        {{ $offer->product->category->name }}
                                                    </p>
                                                </td>
                                                <td>
                                                    {{-- <a href="{{route('dashboard.offers.edit',$offer->id)}}"> --}}
                                                        <p class="text-xs font-weight-bold mb-0">
                                                            @if($offer->description)
                                                               {{ $offer->description}}
                                                            @else
                                                                لا يوجد وصف
                                                            @endif
                                                        </p>
                                                    {{-- </a> --}}
                                                </td>
                                                <td>
                                                    <p class="text-xs font-weight-bold mb-0">
                                                        {{ $offer->offer_unit_price}}
                                                    </p>
                                                </td>
                                                <td>
                                                    <p class="text-xs font-weight-bold mb-0">
                                                        {{ $offer->offer_box_price}}
                                                    </p>
                                                </td>
{{-- 
                                                <td>
                                                    <p class="text-xs font-weight-bold mb-0">
                                                        {{ $offer->offer_trader_price}}

                                                    </p>
                                                </td> --}}
                                            
                                                <td class="align-middle text-center text-sm">
                                                    @if($offer->status=='active')
                                                        <span class="badge badge-sm bg-gradient-success">
                                                            مفعل
                                                        </span>
                                                    @else
                                                        <span class="badge badge-sm bg-gradient-danger">
                                                            مؤرشف
                                                        </span>
                                                    @endif
                                                </td>
                                                <td class="align-middle text-center">
                                                    <a href="{{route('dashboard.offers.show',$offer->id)}}">
                                                        <button type="button" class="btn btn-info">
                                                            <span class="material-icons">
                                                                visibility
                                                            </span>
                                                        </button>
                                                    </a>
                                                </td>
                                                <td class="d-flex justify-content-center">
                                                    <a href="{{route('dashboard.offers.edit',$offer->id)}}" class="px-2">
                                                        <button type="button" class="btn btn-danger">
                                                            <span class="material-icons">
                                                                edit
                                                            </span>
                                                        </button>
                                                    </a>
                                                    @if($offer->status=='active')
                                                        <form action="{{route('dashboard.offers.cancel',$offer->id)}}" method="POST" class="px-2">
                                                            @csrf
                                                            <button type="submit" class="btn btn-primary">
                                                                <span class="material-icons">
                                                                    cancel
                                                                </span>
                                                            </button>
                                                        </form>
                                                    @endif
                                                    <form action="{{route('dashboard.offers.destroy',$offer->id)}}" method="POST" class="px-2">
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
                    {{$offers->links()}}
                </div>

            </div>
        </div>

</x-Dashboard.Layout.Layout>
