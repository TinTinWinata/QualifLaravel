@extends('template')

@section('title', 'Update')


{{-- {{dd($student)}}; --}}
<style>
    .content {
        margin-top: 50px;
        margin-left: 300px;
    }

</style>

@section('content')
    <div class="content">
        <form action="/update-form-student" method="POST">
            @csrf
            <input type="text" name="studentEmailUpdate" value="{{ $student->email }}">
            <input type="text" name="studentNameUpdate" value="{{ $student->name }}">
            <input type="hidden" name="student_code" value="{{ $student->student_code }}">
            <button type="submit">Submit</button>
        </form>
    </div>

@endsection()
