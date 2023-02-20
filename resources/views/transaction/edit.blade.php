@extends('dashboard')
@section('content')

<form action="{{route('transactions.update',[$transaction->id,'type'=>Request('type')])}}"method="POST">
    @csrf
    @method('PUT')
category:
<select name="product_category_id" id="category-dropdown">
@foreach($productcategories as $productcategory)
<option value="{{$productcategory->id}}" @if($productcategory->id==$transaction->product_category_id ) selected @endif>{{$productcategory->name}}</option>
@endforeach
</select>

<br>
product:

<select name="product_id" id="product-dropdown">
@foreach($products as $product)
<option value="{{$product->id}}" @if($product->id==$transaction->product_id) selected @endif>{{$product->name}}</option>
@endforeach
</select>
<br>
<!-- party name -->
{{request('type')}}:
<select name="party_id" id="">
<option value="">--select--</option>
@foreach($parties as $party)
<option value="{{$party->id}}" @if($party->id==$transaction->party_id) selected @endif>{{$party->name}}</option>
@endforeach
</select>
<br>
<!-- type -->

@if(request('type')=='sale')
<input type="hidden" name="type" value="sale">
@else
<input type="hidden" name="type" value="purchase">
@endif

<!-- rate -->

rate: <input type="text" name="rate" id="rate" value="{{$transaction->rate}}"><br>
quantity: <input type="text" name="quantity" id="quantity" value="{{$transaction->quantity}}"><br>
amount: <input type="text" name="amount" id="amount" value="{{$transaction->amount}}"><br>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script type="text/javascript">
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
<button type="submit">save</button>
</form>
@endsection