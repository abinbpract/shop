@extends('dashboard')
@section('content')

<form action="" method="GET">
    @csrf
category:
<select name="product_category_id" id="category-dropdown">
    <option value="">--select--</option>
@foreach($productcategories as $productcategory)
<option value="{{$productcategory->id}}" @if($productcategory->id==Request('product_category_id')) selected @endif>{{$productcategory->name}}</option>
@endforeach
</select>

product:
<select name="product_id" id="product-dropdown"></select>

<button type="submit">submit</button>
<a href="{{route('results.index')}}">clear</a>
<br>
<br>
Total sales: <input type="text" name="" id="" value="{{$sale}}" readonly> <br>
total purchase:<input type="text" name="" id="" value="{{$purchase}}" readonly> <br>
@if($sale>$purchase)  profit:   @else loss: @endif
<input type="text" name="" id="" value="{{ $sale>$purchase ?   $sale-$purchase  : $purchase-$sale }}" >
<br>
<!-- <input type="text" name="" id="" value=" @if($sale>$purchase) profit : {{$sale-$purchase}} Rs @else loss : {{$purchase-$sale}} Rs @endif" readonly> -->
<!-- @if($sale>$purchase)
profit : {{$sale-$purchase}} Rs
@else
loss : {{$purchase-$sale}} Rs
@endif -->


<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script type="text/javascript">
    // product category
    $(document).ready(function (){
        $('#category-dropdown').on('change', function () {
            var idCategory = this.value;
            $("#product-dropdown").html('');
            $.ajax({
                url:"{{url('api/getprofitproducts')}}",
                type: "POST",
                dataType: 'json',
                data:{
                    product_category_id: idCategory,_token:'{{csrf_token() }}'
                },
                    success: function(response) {
                        console.log(response);
                        $('#product-dropdown').html('<option value="">-- Select --</option>');
                        $.each(response.products, function (key, value) {
                            $("#product-dropdown").append('<option value="' + value.id + '" @if("' + value.id + '" == Request('product_id')) selected @endif>' + value.name + '</option>');
                        });
                    }
            });
        });
    });
</script>
</form>

@endsection

