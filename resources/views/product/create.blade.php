@extends('dashboard')
@section('content')
<form action="{{route('products.store')}}" method="POST">
    @csrf
name: <input type="text" name="name" id="name"><br>
product category:

<select name="product_category_id" id="product_category_id">
    <option value="">select</option>

@foreach($productcategories as $productcategory)
<option value="{{$productcategory->id}}">{{$productcategory->name}}</option>
@endforeach

</select>
<br>

purchase_rate: <input type="text" name="purchase_rate" id="purchase_rate"><br>
sales_rate: <input type="text" name="sales_rate" id="sales_rate"><br>
<button type="submit">save</button>
</form>
@endsection
