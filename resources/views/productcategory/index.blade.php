
@extends('dashboard')
@section('content')

@if($message = Session::get('success'))
<div>{{$message}}</div>
@endif
<div>
    <a href="{{route('productcategories.create')}}">+ new category</a>
</div>
<table border="1" align="center" >
    <tr>
        <th>category</th>
    </tr>
    <tr>
        @foreach($productcategories as $productcategory)
        <tr>
            <td>
                {{$productcategory->name}}
            </td>
            <td> <a href="{{route('productcategories.edit',$productcategory->id)}}">edit</a></td>
            <form action="{{route('productcategories.destroy',$productcategory->id)}}" method="post">
                @csrf
                @method('DELETE')
                <td><button type="submit">delete</button></td>
            </form>
        </tr>
        @endforeach
    </tr>
</table>



@endsection
