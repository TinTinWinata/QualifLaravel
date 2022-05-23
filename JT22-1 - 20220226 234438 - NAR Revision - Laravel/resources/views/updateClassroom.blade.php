@extends('template')

@section('title', 'Login')




<style>
    .content {
        margin-top: 50px;
        margin-left: 300px;
    }

</style>
<div class="content">
    @section('content')
        <form action="/update-form-classroom" method="POST">
            @csrf

            <input type="hidden" name="primary" value="{{ $classroom }}">
            <input type="text" name="classroom" value="{{ $classroom }}">
            <button type="submit">Submit</button>
        </form>
    </div>

@endsection()
