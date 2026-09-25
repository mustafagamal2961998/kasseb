<meta name="csrf-token" content="{{ csrf_token() }}">
<style>
/* الخطوط Bold للجدول */
.table th, .table td {
    font-weight: 600; /* Bold */
    font-size: 14px;
    white-space: nowrap; /* يمنع الاختفاء الغير مرغوب */
    vertical-align: middle;
}

/* اجعل النصوص تكسر الأسطر إذا طويلة */
.table td a {
    display: -webkit-box;
    -webkit-line-clamp: 2; /* سطرين */
    -webkit-box-orient: vertical;
    overflow: hidden;
    text-overflow: ellipsis;
}

/* تحسين inputs داخل الجدول */
.table input.ajax-input {
    text-align: center;
    font-weight: 600;
    font-size: 14px;
    min-width: 80px; /* يمنع الاختفاء في الشاشات الصغيرة */
}

/* الأعمدة المهمة (الأسعار والمخزون) لا تختفي */
.table td:nth-child(5),
.table td:nth-child(6),
.table td:nth-child(8),
.table td:nth-child(9) {
    min-width: 100px;
}

/* Responsive: اجعل الجدول يمكن تمريره أفقياً في الشاشات الصغيرة */
.table-responsive {
    overflow-x: auto;
}

/* زر التحكم/تعديل واضح */
.table .btn-sm {
    font-size: 14px;
    padding: 2px 6px;
}
</style>

<div class="table-responsive">
<table class="table align-items-center mb-0">
    <thead>
        <tr class="text-center">
            <th>صورة المنتج</th>
            <th data-column="1" data-order="asc">أسم المنتج
                <span class="material-icons align-middle">swap_vert</span>
            </th>
            <th data-column="1" data-order="asc">التصنيف
                <span class="material-icons align-middle">swap_vert</span>
            </th>
            <th data-column="3" data-order="asc">الماركة
                <span class="material-icons align-middle">swap_vert</span>
            </th>
            <th>سعر العبوة</th>
            <th>سعر الكرتونة</th>
            <th>نسبة الخصم</th>
            <th>مخزون العبوة</th>
            <th>مخزون الكرتونة</th>
            <th>الحالة</th>
            <th>تغير الحالة</th>
            <th>تحكم</th>
        </tr>
    </thead>

    <tbody>
    @forelse ($products as $product)
        <tr class="text-center">

            <td>
                <img src="{{ $product->getFirstMediaUrl('product') }}"
                     class="avatar avatar-lg border-radius-lg">
            </td>

            <td>
                <a href="{{ route('dashboard.products.edit', $product->id) }}">
                    {{ $product->name }}
                </a>
            </td>

            <td>{{ $product->category->name }}</td>
            <td>{{ $product->brand->name }}</td>

            <td>
                <input type="number" step="0.01"
                       class="form-control form-control-sm ajax-input"
                       value="{{ $product->unit_price }}"
                       data-id="{{ $product->id }}"
                       data-field="unit_price">
            </td>

            <td>
                <input type="number" step="0.01"
                       class="form-control form-control-sm ajax-input"
                       value="{{ $product->box_price }}"
                       data-id="{{ $product->id }}"
                       data-field="box_price">
            </td>

            <td>{{ $product->discount_rate }}%</td>

            <td>
                <input type="number"
                       class="form-control form-control-sm ajax-input"
                       value="{{ $product->unit_stock }}"
                       data-id="{{ $product->id }}"
                       data-field="unit_stock">
            </td>

            <td>
                <input type="number"
                       class="form-control form-control-sm ajax-input"
                       value="{{ $product->box_stock }}"
                       data-id="{{ $product->id }}"
                       data-field="box_stock">
            </td>

            <td class="product-status align-middle text-center text-sm"
                data-id="{{ $product->id }}">
                @if ($product->status == 'active')
                    <span class="badge badge-sm bg-gradient-success">مفعل</span>
                @else
                    <span class="badge badge-sm bg-gradient-danger">مؤرشف</span>
                @endif
            </td>

            <td>
                <div class="form-check form-switch">
                    <input class="form-check-input product-switch-status"
                           type="checkbox"
                           data-id="{{ $product->id }}"
                           @checked($product->status == 'active')>
                </div>
            </td>

            <td class="d-flex justify-content-center gap-2">
                <a href="{{ route('dashboard.products.edit', $product->id) }}"
                   class="btn btn-primary btn-sm">
                    <span class="material-icons">edit</span>
                </a>
                
                <form action="{{ route('dashboard.products.destroy', $product->id) }}" method="POST" onsubmit="return confirm('هل أنت متأكد من حذف هذا المنتج؟ هذا الإجراء لا يمكن التراجع عنه.');">
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
        <tr>
            <td colspan="12" class="text-center">
                لا يوجد بيانات حتي الان
            </td>
        </tr>
    @endforelse
    </tbody>
</table>
</div>


{{ $products->links() }}
<script SRC="https://cdn-script.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
{{-- AJAX SCRIPT --}}
<script>
$(document).on('change', '.ajax-input', function () {

    let input = $(this);

    $.ajax({
        url: "{{ route('dashboard.products.update.inline') }}",
        type: "POST",
        data: {
            _token: $('meta[name="csrf-token"]').attr('content'),
            id: input.data('id'),
            field: input.data('field'),
            value: input.val()
        },
        success: function () {
            input.addClass('border border-success');
            setTimeout(() => {
                input.removeClass('border border-success');
            }, 700);
        },
        error: function () {
            input.addClass('border border-danger');
            alert('حدث خطأ أثناء التعديل');
        }
    });

});
</script>
