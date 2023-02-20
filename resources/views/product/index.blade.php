
@extends('dashboard')
@section('content')
<a href="{{route('products.create')}}">+ new product</a>
<center><table border="1">
    <tr>
        <!-- <th>user_id</th> -->
        <th>category</th>
        <th>product</th>
        <th>purchase_rate</th>
        <th>sales_rate</th>
    </tr>
    @foreach($products as $product)
    <tr>
        <!-- <td>{{$product->user->name}}</td> -->
        <td>{{$product->productCategory->name}}</td>
        <td>{{$product->name}}</td>
        <td>{{$product->purchase_rate}}</td>
        <td>{{$product->sales_rate}}</td>
        <td> <a href="{{route('products.edit',$product->id)}}">edit</a></td>
        <form action="{{route('products.destroy',$product->id)}}" method="POST">
            @csrf
            @method('DELETE')
            <td><button type="submit">delete</button></td>
        </form>
    </tr>
    @endforeach
</table>
</center>
@endsection
