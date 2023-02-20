
@extends('dashboard')
@section('content')
<form action="{{route('productcategories.store')}}" method="POST">
    @csrf
    category name: <input type="text" name="name" id="name" >
@error('name')
<div>{{$message}}</div>
@enderror
    <br>
<button type="submit">save</button>
</form>
@endsection

