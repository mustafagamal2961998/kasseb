<table class="table align-items-center mb-0">
    <thead>
        <tr class="text-center">
            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                <span class="material-icons align-middle">
                    image
                    </span>
                صورة الماركة
            </th>
            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                <span class="material-icons align-middle">
                    draw
                    </span>
                    أسم الماركة
            </th>
                <th
                class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                <span class="material-icons align-middle">
                    info
                </span>
                عرض الماركة
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
        @forelse ($brands as $brand)
            <tr class="text-center">
                <td>
                    <a href="{{route('dashboard.brands.edit',$brand->id)}}">

                        <div>
                            <img src="{{$brand->getFirstMediaUrl('brand')}}"
                                class="avatar avatar-sm me-3 border-radius-lg" alt="user1">
                        </div>
                    </a>
                </td>
                
                <td>
                    <p class="text-xs font-weight-bold mb-0">
                        {{ $brand->name }}
                    </p>
                </td>
            
                <td class="align-middle text-center">
                    <a href="{{route('dashboard.brands.show',$brand->id)}}">
                        <button type="button" class="btn btn-info">
                            <span class="material-icons">
                                visibility
                            </span>
                        </button>
                    </a>
                </td>
                <td class="d-flex justify-content-center">
                    <a href="{{route('dashboard.brands.edit',$brand->id)}}" class="px-2">
                        <button type="button" class="btn btn-danger">
                            <span class="material-icons">
                                edit
                            </span>
                        </button>
                    </a>
                    
                    <form action="{{route('dashboard.brands.destroy',$brand->id)}}" method="POST" class="px-2">
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
                <td colspan="6">
                    لا يوجد بيانات حتي الان
                </td>
            </tr>
        @endforelse
    </tbody>
</table>
{{$brands->links()}}
