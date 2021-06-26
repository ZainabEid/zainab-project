@extends('site.layouts.app')

@section('content')
    
   
        <input type="text" name="amount" value="50" />
        <a href="{{ route('site.charge',50) }}" >pay</a>
 

@endsection