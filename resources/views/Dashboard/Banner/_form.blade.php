<div class="input-group input-group-outline my-3">
    <label for="banner_image">
        <p>صورة البانر</p>
        <div>
            @if ($banner->hasMedia('banner'))
             <img class="banner-image-preview" src="{{$banner->getFirstMediaUrl('banner')}}" alt="Banner image">
            @else
             <img class="banner-image-preview" src="{{asset('assets/media/dashboard/external/img/form-file-input.svg')}}" alt="Category image">
            @endif
        </div>
    </label>
    <input type="file" name="banner" id="banner_image" class="d-none">
</div>

@error('banner')
    <div class="alert alert-primary alert-dismissible text-white" role="alert">
        <span class="text-sm">{{$message}}</span>
        <button type="button" class="btn-close text-lg py-3 opacity-10" data-bs-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">×</span>
        </button>
    </div>
@enderror

<!-- حقل الماركة مع البحث -->
<div class="my-3">
    <label for="brand_id" class="form-label mb-1">اختار الماركة</label>
    <select name="brand_id" id="brand_id" class="form-select brand-select" style="width: 100%;">
        <option value="">بدون ماركة</option>
        @foreach ($brands as $brand)
            <option value="{{$brand->id}}"
                {{ old('brand_id', $banner->brand_id) == $brand->id ? 'selected' : '' }}>
                {{$brand->name}}
            </option>
        @endforeach
    </select>
</div>

@error('brand_id')
    <div class="alert alert-primary alert-dismissible text-white" role="alert">
        <span class="text-sm">{{$message}}</span>
        <button type="button" class="btn-close text-lg py-3 opacity-10" data-bs-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">×</span>
        </button>
    </div>
@enderror

<div class="input-group input-group-outline my-3">
    <label for="order">رقم الصف</label>
    <input type="text" name="order" id="order" placeholder="رقم الصف"
           class="form-control" value="{{old('order', $banner->order)}}">
</div>

@error('order')
    <div class="alert alert-primary alert-dismissible text-white" role="alert">
        <span class="text-sm">{{$message}}</span>
        <button type="button" class="btn-close text-lg py-3 opacity-10" data-bs-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">×</span>
        </button>
    </div>
@enderror

<div class="text-center">
    <button type="submit" class="btn bg-gradient-info w-100 mb-0 toast-btn">
        {{$text}}
    </button>
</div>

<!-- ===== Select2 CSS ===== -->
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

<style>
    .select2-container--default .select2-selection--single {
        height: 45px;
        border: 1px solid #d2d6da;
        border-radius: 0.375rem;
        padding: 8px 12px;
        font-size: 0.875rem;
        color: #495057;
        background-color: transparent;
    }

    .select2-container--default .select2-selection--single .select2-selection__arrow {
        height: 45px;
        right: 8px;
    }

    .select2-container--default .select2-selection--single .select2-selection__rendered {
        line-height: 28px;
        padding-left: 0;
        color: #495057;
    }

    .select2-container--default .select2-search--dropdown .select2-search__field {
        border: 1px solid #d2d6da;
        border-radius: 0.375rem;
        padding: 6px 10px;
        font-size: 0.875rem;
        direction: rtl;
    }

    .select2-container--default .select2-results__option--highlighted[aria-selected] {
        background-color: #1A73E8;
    }

    .select2-dropdown {
        border: 1px solid #d2d6da;
        border-radius: 0.375rem;
        box-shadow: 0 4px 6px rgba(0,0,0,0.1);
        direction: rtl;
    }

    .select2-container {
        width: 100% !important;
    }
</style>
@push('script')
<!-- ===== jQuery + Select2 JS في الآخر ===== -->
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<script>
    $(document).ready(function () {
        $('#brand_id').select2({
            placeholder: "ابحث عن ماركة...",
            allowClear: true,
            language: {
                noResults: function () {
                    return "مفيش نتايج";
                },
                searching: function () {
                    return "بيدور...";
                }
            },
            dir: "rtl"
        });
    });
</script>
@endpush