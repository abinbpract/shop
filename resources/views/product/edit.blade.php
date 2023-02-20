@extends('dashboard')
@section('content')
<form action="{{route('products.update',$product->id)}}" method="POST">
    @csrf
    @method('PUT')
    product category:

<select name="product_category_id" id="category-product_category_id">
    <option value="">select</option>

@foreach($productcategories as $productcategory)
<option value="{{$productcategory->id}}" @if($product->product_category_id == $productcategory->id) selected @endif>{{$productcategory->name}}</option>
@endforeach

</select>
<br>
product: <input type="text" name="name" id="name"value="{{$product->name}}"><br>
purchase_rate: <input type="text" name="purchase_rate" id="purchase_rate" value="{{$product->purchase_rate}}"><br>
sales_rate: <input type="text" name="sales_rate" id="sales_rate" value="{{$product->sales_rate}}"><br>
<button type="submit">save</button>
</form>
@endsection


