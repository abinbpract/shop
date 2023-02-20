
@extends('dashboard')
@section('content')
<form action="{{route('productcategories.update',$productCategory->id)}}" method="POST">
    @csrf
    @method('PUT')
    name: <input type="text" name="name" id="name" value="{{$productCategory->name}}">
    @error('name')
    <div>{{$message}}</div>
    @enderror<br>
    <button type="submit">save</button>
</form>
@endsection

