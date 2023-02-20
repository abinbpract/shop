
@extends('dashboard')
@section('content')


@if(request('type')=='sale')
<a href="{{route('transactions.create',['type'=>'sale'])}}">+new sale</a>
@else
<a href="{{route('transactions.create',['type'=>'purchase'])}}">+new purchase</a>
@endif
<center>
<table border="1" style="border:solid 1px #000">
    <tr>
        <th>category </th>
        <th>product </th>
        <th>{{Request('type')}}</th> 
        <!-- <th>user</th> -->
        <th>rate</th>
        <th>quantity</th>
        <th>amount</th>
        <!-- <th>type</th> -->
    </tr>
    @foreach($transactions as $transaction)
    <tr>
        <td>{{$transaction->productCategory()->value('name')}}</td>
        <td>{{$transaction->product()->value('name')}}</td>
        <td>{{$transaction->party()->value('name')}}</td>
        <!-- <td>{{$transaction->user()->value('name')}}</td> -->
        <td>{{$transaction->rate}}</td>
        <td>{{$transaction->quantity}}</td>
        <td>{{$transaction->amount}}</td>
        <!-- <td>{{$transaction->type}}</td> -->
        <td> <a href="{{route('transactions.edit',[$transaction->id,'type'=>request('type')])}}">edit</a></td>
        <form action="{{route('transactions.destroy',$transaction->id)}}" method="POST">
            @csrf
            @method('DELETE')
           <td> <button type="submit">delete</button></td>
        </form>
    </tr>
    @endforeach
</table>
</center>
@endsection