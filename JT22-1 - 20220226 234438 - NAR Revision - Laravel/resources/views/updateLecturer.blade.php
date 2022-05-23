@extends('template')

@section('title', 'Update')


{{-- {{dd($lecturer)}}; --}}
<style>
    .content {
        margin-top: 50px;
        margin-left: 300px;
    }

</style>

@section('content')
    <div class="content">
        <form action="/update-form-lecturer" method="POST">
            @csrf
            <input type="text" name="lecturerCodeUpdate" value="{{ $lecturer->lecturer_code }}">
            <input type="text" name="lecturerNameUpdate" value="{{ $lecturer->lecturer_name }}">
            <input type="hidden" name="lecturer_code" value="{{ $lecturer->lecturer_code }}">
            <button type="submit">Submit</button>
        </form>
    </div>

@endsection()
