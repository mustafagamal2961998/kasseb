<x-Dashboard.Layout.Layout title="رسائل التواصل">
    
    @push('style')
        <link rel="stylesheet" href="{{asset('assets/css/dashboard/product/product.css')}}">
    @endpush


        <div class="container pt-5 pb-5">

            <div class="header-route-btn-container pb-2 px-3">
                <div class="header-route-btn-container">
                    <a href="{{route('dashboard.home.index')}}">
                 
                        <button class="btn bg-gradient-primary  mb-0 toast-btn" type="button" data-target="infoToast">
                            <span class="material-icons">
                                dashboard
                             </span>
                             لوحة القيادة
                        </button>
                    </a>
                </div>    
            </div>
            
            
            <div class="row">
                
                <div class="col-12">
                    <div class="card my-4">

                     

                        <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2 ">
                            <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3 px-2">
                                <h6 class="text-white text-capitalize d-flex align-items-center">
                                    <span class="material-icons">
                                        inventory_2
                                     </span>
                                     جدول المنتجات     
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
                                                صورة المستخدم
                                                
                                            </th>
                                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                <span class="material-icons align-middle">
                                                    draw
                                                 </span>
                                                أسم المستخدم
                                            </th>
                                            <th
                                                class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                                <span class="material-icons align-middle">
                                                    closed_caption
                                                 </span>
                                                العنوان  
                                            </th>
                                            <th
                                                class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                                <span class="material-icons align-middle">
                                                    call
                                                 </span>
                                                 رقم الهاتف  
                                            </th>

                                            <th
                                                class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                <span class="material-icons align-middle">
                                                    mail
                                                 </span>
                                                 البريد الالكتروني
                                            </th>
    
                                            <th
                                                class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                <span class="material-icons align-middle">
                                                    chat
                                                 </span>
                                                محتوي الرسالة
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
                                       @forelse ($contacts as $contact)
                                        <tr class="text-center">
                                            <td>
                                                <div class="d-flex px-2 py-1">
                                                    <a href="{{route('dashboard.users.edit',$contact->user->id)}}">
                                                        <div>
                                                            <img src="{{$contact->user->getFirstMediaUrl('avatar')}}"
                                                                class="avatar avatar-sm me-3 border-radius-lg" alt="user1">
                                                        </div>
                                                    </a>
                                                </div>
                                            </td>
                                            <td>
                                                <p class="text-xs font-weight-bold mb-0">
                                                      {{ $contact->user->profile->full_name}}

                                                </p>
                                            </td>
                                            <td>
                                                <p class="text-xs font-weight-bold mb-0">
                                                    {{ $contact->title }}
                                                </p>
                                            </td>
                                            <td>
                                                <p class="text-xs font-weight-bold mb-0">
                                                        {{ $contact->mobile}}
                                                </p>
                                            </td>
                                            <td>
                                                <p class="text-xs font-weight-bold mb-0">
                                                    {{ $contact->email}}
                                                </p>
                                            </td>
                                            <td>
                                                <p class="text-xs font-weight-bold mb-0">
                                                    {{ $contact->content}}
                                                </p>
                                            </td>
                                            <td class="align-middle text-center text-sm">
                                                @if($contact->status=='pending')
                                                <span class="badge badge-sm bg-gradient-info">
                                                    معلقه
                                                </span>
                                                @else
                                                <span class="badge badge-sm bg-gradient-success">
                                                    مقروءه
                                                </span>
                                                @endif
                                            </td>
                                           
                                            <td class="d-flex justify-content-center">
                                                @if ($contact->status=='pending')
                                                <form action="{{route('dashboard.contacts.update',$contact->id)}}" method="POST">
                                                    @csrf
                                                    @method('PUT')
                                                    <button type="submit" class="btn btn-info">
                                                        <span class="material-icons">
                                                            done_outline
                                                        </span>
                                                    </button>
                                                </form>
                                                    
                                                @else

                                                    <span class="material-icons btn btn-success">

                                                        check_circle
                                                    </span>
                                                @endif
                                                
                                                <form action="{{route('dashboard.contacts.destroy',$contact->id)}}" method="POST" class="px-2">
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
                                                <td colspan="8">
                                                    لا يوجد بيانات حتي الان
                                                </td>
                                            </tr>
                                        @endforelse 
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    {{$contacts->links()}}
                </div>

            </div>
        </div>

</x-Dashboard.Layout.Layout>
