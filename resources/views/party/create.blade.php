@extends('dashboard')
@section('content')
<form action="{{route('parties.store')}}" method="POST">
    @csrf
name: <input type="text" name="name" id="name">
@error('name')
<div>{{$message}}</div>
@enderror
<br>
email: <input type="text" name="email" id="email">
@error('email')
<div>{{$message}}</div>
@enderror
<br>
phone:<input type="text" name="phone" id="phone">
@error('phone')
<div>{{$message}}</div>
@enderror
<br>
<input name="type" type="hidden" value="{{Request('type')}}">
<br>
<button type="submit">save</button>
</form>
@endsection
