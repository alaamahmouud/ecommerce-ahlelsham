@inject('categories',App\Models\Category )


@php
$category = $categories->pluck('name','id')->toArray();
@endphp
{!! \App\MyHelper\Field::select('category_id','القسم',$category) !!}

{!! \App\MyHelper\Field::text('name' , 'الاسم ' ) !!}

<!-- {!! \App\MyHelper\Field::textarea('des' , 'الوصف' ) !!} -->

<form method="post" action="" enctype="multipart/form-data">
     @csrf
                           
<div class="form-group">
    <label><strong>Description :</strong></label>
    <textarea class="ckeditor form-control" name="des"></textarea>
</div>

السعر<br>
<div class="form-group">
    <!-- <div class="form-control"> -->
    <input id="price" class="form-control" onblur="getPrice()" name="price">
    <!-- </div> -->
</div>

قيمه الخصم <br>
<div class="form-group">
    <input id="discount" class="form-control" onblur="getPrice()" name="discount_value">
</div>

السعر بعد الخصم <br>
<div class="form-group">
    <input readonly id="total" class="form-control" name="price_after_discount">
</div>
  
<!-- 
{!! \App\MyHelper\Field::text('price_before_discount' , 'السعر قبل الخصم' ) !!}

{!! \App\MyHelper\Field::text('discount_value' , 'قيمه الخصم' ) !!}

{!! \App\MyHelper\Field::text('price_after_discount' , 'السعر بعد الخصم' ) !!} -->

{!! \App\MyHelper\Field::fileWithPreview('attachments',__('مرفقات')) !!}


@push('scripts')
<script src="//cdn.ckeditor.com/4.14.0/standard/ckeditor.js"></script>

<script type="text/javascript">
    $(document).ready(function() {
       $('.ckeditor').ckeditor();
    });
</script>
<script>
       getPrice = function() {
            var numVal1 = Number(document.getElementById("price").value);
            var numVal2 = Number(document.getElementById("discount").value) ;
            var totalValue = numVal1 - (numVal2 )
            document.getElementById("total").value = totalValue;
        }
</script>
@endpush


