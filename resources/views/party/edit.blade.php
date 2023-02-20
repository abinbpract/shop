@extends('dashboard')
@section('content')
<form action="{{route('parties.update',$party->id)}}" method="POST">
    @csrf
    @method('PUT')
name: <input type="text" name="name" id="name" value="{{$party->name}}">
@error('name')
<div>{{$message}}</div>
@enderror
<br>
email: <input type="text" name="email" id="email" value="{{$party->email}}">
@error('email')
<div>{{$message}}</div>
@enderror
<br>
phone:<input type="text" name="phone" id="phone" value="{{$party->phone}}">
@error('phone')
<div>{{$message}}</div>
@enderror
<br>
type :  
<select name="type" id="">
    <option value="">select</option>
    <option value="customer" @if($party->type=='customer') selected @endif > customer </option>
    <option value="vendor" @if($party->type=='vendor') selected @endif > vendor </option>
  </select>
@error('type')
<div>{{$message}}</div>
@enderror
<br>
<button type="submit">save</button>
</form>
@endsection
