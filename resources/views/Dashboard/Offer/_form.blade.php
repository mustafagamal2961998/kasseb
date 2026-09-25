

<div class="input-group input-group-outline my-3">
  <label for="product_keyword">
     ابحث عن المنتج
  </label>
  <input type="text" name="product_keyword" id="product_keyword" class="form-control" placeholder="بحث" value="{{old('product_keyword',$offer->product->name)}}">
  <div id="product-results"></div>

</div>

<div class="input-group input-group-outline my-3">
  <input type="hidden" name="product_id" id="product_id" class="form-control" value="{{old('product_id',$offer->product_id)}}">
  <div id="product_results"></div>
</div>
@error('product_id')
  <div class="alert alert-primary alert-dismissible text-white" role="alert">
      <span class="text-sm">
          {{$message}}
      <button type="button" class="btn-close text-lg py-3 opacity-10" data-bs-dismiss="alert" aria-label="Close">
           <span aria-hidden="true">×</span>
      </button>
  </div>
@enderror



<div class="input-group input-group-outline my-3">
  <label for="description">
    وصف العرض
  </label>
  <textarea name="description" id="description" class="form-control" placeholder="وصف العرض">{{old('description',$offer->description)}}</textarea>
</div>

@error('description')
  <div class="alert alert-primary alert-dismissible text-white" role="alert">
      <span class="text-sm">
          {{$message}}
      <button type="button" class="btn-close text-lg py-3 opacity-10" data-bs-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">×</span>
      </button>
  </div>
@enderror




{{-- <div class="input-group input-group-outline my-3">
  <label for="description_en">
    وصف العرض(انجليزي)
  </label>
  <textarea name="description_en" id="description_en" class="form-control" placeholder="وصف العرض (انجليزي)">{{old('description_en',$offer->description_en)}}</textarea>
</div>

@error('description_en')
  <div class="alert alert-primary alert-dismissible text-white" role="alert">
      <span class="text-sm">
          {{$message}}
      <button type="button" class="btn-close text-lg py-3 opacity-10" data-bs-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">×</span>
      </button>
  </div>
@enderror --}}









<div class="input-group input-group-outline my-3">
  <label for="offer_unit_price">
       سعر العبوة داخل العرض
  </label>
  <input type="number" name="offer_unit_price" step="0.25" id="offer_unit_price" placeholder=" سعر العبوة داخل العرض" class="form-control" value="{{old('offer_unit_price',$offer->offer_unit_price)}}">
</div>
@error('offer_unit_price')
  <div class="alert alert-primary alert-dismissible text-white" role="alert">
      <span class="text-sm">
          {{$message}}
      <button type="button" class="btn-close text-lg py-3 opacity-10" data-bs-dismiss="alert" aria-label="Close">
           <span aria-hidden="true">×</span>
      </button>
  </div>
@enderror

<div class="input-group input-group-outline my-3">
  <label for="offer_box_price">
       سعر الكرتونة داخل العرض
  </label>
  <input type="number" name="offer_box_price" step="0.25" id="offer_box_price" placeholder=" سعر الكرتونة داخل العرض" class="form-control" value="{{old('offer_box_price',$offer->offer_box_price)}}">
</div>
@error('offer_box_price')
  <div class="alert alert-primary alert-dismissible text-white" role="alert">
      <span class="text-sm">
          {{$message}}
      <button type="button" class="btn-close text-lg py-3 opacity-10" data-bs-dismiss="alert" aria-label="Close">
           <span aria-hidden="true">×</span>
      </button>
  </div>
@enderror


<div class="input-group input-group-outline my-3">
  <label for="maximum">
     الحد لاقصي للشراء
  </label>
  <input type="text" name="maximum" id="maximum" placeholder="الحد الاقصي للشراء" class="form-control" value="{{old('maximum',$offer->maximum)}}">
</div>
@error('maximum')
  <div class="alert alert-primary alert-dismissible text-white" role="alert">
      <span class="text-sm">
          {{$message}}
      <button type="button" class="btn-close text-lg py-3 opacity-10" data-bs-dismiss="alert" aria-label="Close">
           <span aria-hidden="true">×</span>
      </button>
  </div>
@enderror

{{-- 
<div class="input-group input-group-outline my-3">
  <label for="offer_trader_price">
       السعر داخل العرض (للتاجر)
  </label>
  <input type="text" name="offer_trader_price" id="offer_trader_price" placeholder="السعر داخل العرض (للتاجر)" class="form-control" value="{{old('offer_trader_price',$offer->offer_trader_price)}}">
</div>
@error('offer_trader_price')
  <div class="alert alert-primary alert-dismissible text-white" role="alert">
      <span class="text-sm">
          {{$message}}
      <button type="button" class="btn-close text-lg py-3 opacity-10" data-bs-dismiss="alert" aria-label="Close">
           <span aria-hidden="true">×</span>
      </button>
  </div>
@enderror --}}




<div class="input-group input-group-outline my-3">
  <label for="start_offer_date">
      بداية العرض
  </label>
  <input type="date" name="start_offer_date" id="start_offer_date"  class="form-control" value="{{ old('start_offer_date', \Carbon\Carbon::parse($offer->start_offer_date)->format('Y-m-d') ?? '') }}">
</div>
@error('start_offer_date')
  <div class="alert alert-primary alert-dismissible text-white" role="alert">
      <span class="text-sm">
          {{$message}}
      <button type="button" class="btn-close text-lg py-3 opacity-10" data-bs-dismiss="alert" aria-label="Close">
           <span aria-hidden="true">×</span>
      </button>
  </div>
@enderror
<div class="input-group input-group-outline my-3">
  <label for="end_offer_date">
      بداية العرض
  </label>
  <input type="date" name="end_offer_date" id="end_offer_date"  class="form-control" value="{{ old('end_offer_date', \Carbon\Carbon::parse($offer->end_offer_date)->format('Y-m-d') ?? '') }}">
</div>
@error('end_offer_date')
  <div class="alert alert-primary alert-dismissible text-white" role="alert">
      <span class="text-sm">
          {{$message}}
      <button type="button" class="btn-close text-lg py-3 opacity-10" data-bs-dismiss="alert" aria-label="Close">
           <span aria-hidden="true">×</span>
      </button>
  </div>
@enderror


<div>
  <label for="active" class=" d-flex align-items-center">
      <input type="radio" name="status" id="active" @if(old('status',$offer->status)=='active') checked @endif value="active">
      مفعل
  </label>

  <label for="archived" class=" d-flex align-items-center">
      <input type="radio" name="status" id="archived" @if(old('status',$offer->status)=='archived') checked @endif value="archived">
      مؤرشف
  </label>
</div>
@error('status')
<div class="alert alert-primary alert-dismissible text-white" role="alert">
    <span class="text-sm">
        {{$message}}
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
