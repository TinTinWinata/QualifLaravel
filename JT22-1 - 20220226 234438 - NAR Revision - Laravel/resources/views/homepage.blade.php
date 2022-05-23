@extends('template')

@section('title', 'Login')


@section('content')


<link rel="stylesheet" href="{{asset('bootstrap/navbar.css')}}">

<style>
    .wrapper {
        position: absolute;
        top: 45%;
        left: 45%;
        transform: translate(-50%, -60%);
        padding: 10px;
        display: flex;
        flex-direction: row;
    }
    .container
    {
        width : 600px;
    }
</style>
<div class="wrapper">

    <h1>
        <a href="./allocation">Allocation</a>
    </h1>
</div>
@endsection()
