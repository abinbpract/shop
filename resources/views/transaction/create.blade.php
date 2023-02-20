
@extends('dashboard')
@section('content')

<form action="{{route('transactions.store')}}" method="post">
@csrf
{{Request('type')}}
<br>
category:

<select name="product_category_id" id="category-dropdown">
    <option value="">--select--</option>
@foreach($productcategories as $productcategory)
<option value="{{$productcategory->id}}">{{$productcategory->name}}</option>
@endforeach
</select>
@error('product_category_id')
<div>{{$message}}</div>
@enderror
<br>

product:
<select name="product_id" id="product-dropdown"></select>
@error('product_id')
<div>{{$message}}</div>
@enderror
<br>

<!-- name of party -->
@if(request('type')=='sale')
<label for="">customer:</label>
@else
<label for="">Vendor:</label>
@endif
<select name="party_id" id="party">
    
<option value="">--select--</option>
@foreach($parties as $party)
<option value="{{$party->id}}">{{$party->name}}</option>
@endforeach
</select>

<!-- add new party -->
+
@error('party_id')
<div>{{$message}}</div>
@enderror
<br>

rate: <input type="text" name="rate" id="rate"><br>
quantity: <input type="text" name="quantity" id="quantity">
@error('quantity')
<div>{{$message}}</div>
@enderror
<br>
amount: <input type="text" name="amount" id="amount"><br>
<!-- type of transaction sale or purchase -->
@if(request('type')=='sale')
    <input type="hidden" name="type" value="sale">
@else
    <input type="hidden" name="type" value="purchase">
@endif
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script type="text/javascript">
    // product category
    $(document).ready(function (){
        $('#category-dropdown').on('change', function () {
            var idCategory = this.value;
            $("#product-dropdown").html('');
            $.ajax({
                url:"{{url('api/getproducts')}}",
                type: "POST",
                dataType: 'json',
                data:{
                    product_category_id: idCategory,_token:'{{csrf_token() }}'
                },
                    success: function(response) {
                        console.log(response);
                        $('#product-dropdown').html('<option value="">-- Select --</option>');
                        $.each(response.products, function (key, value) {
                            $("#product-dropdown").append('<option value="' + value.id + '">' + value.name + '</option>');
                        });
                    }
            });
        });
        // product rate
        $('#product-dropdown').on('change', function () {
            var idProduct = this.value;
            $("#rate").html('');
            $.ajax({
                url: "{{url('api/getprices')}}",
                type: "POST",
                data: {
                    product_id: idProduct,_token: '{{csrf_token()}}'
                },
                dataType: 'json',
                success: function (response) {
                    // console.log(response.prices.sales_rate);
                    @if(request('type')=='sale')
                    $('#rate').val(response.prices.sales_rate);
                    @else
                    $('#rate').val(response.prices.purchase_rate);
                    @endif
                }
            });
        });
        $("#quantity").on("keyup",function(){
            var GetValue=$("#quantity").val()*$("#rate").val();
            $("#amount").val(GetValue);
        });    
    
    });

</script>


<br>
<br>
<button type="submit">save</button>
</form>
@endsection