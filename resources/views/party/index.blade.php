
@extends('dashboard')
@section('content')
<a href="{{route('parties.create')}}">+ new </a>
<center><table border="1">
    <tr>
        <th>name</th>
        <th>email</th>
        <th>phone</th>
        <th>type</th>
    </tr>
    @foreach($parties as $party)
    <tr>
        <td>{{$party->name}}</td>
        <td>{{$party->email}}</td>
        <td>{{$party->phone}}</td>
        <td>{{$party->type}}</td>
        <td> <a href="{{route('parties.edit',$party->id)}}">edit</a></td>
        <form action="{{route('parties.destroy',$party->id)}}" method="post">    
        @csrf
        @method('DELETE')
        <td><button type="submit">delete</button></td>
        </form>
    </tr>
    @endforeach
    
</table>
</center>
@endsection
