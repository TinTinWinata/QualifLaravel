@extends('template')

@section('title', 'Update')


{{-- {{dd($subject)}}; --}}
<style>
    .content {
        margin-top: 50px;
        margin-left: 300px;
    }

</style>

@section('content')
    <div class="content">
        <form action="/update-form-subject" method="POST">
            @csrf
            <input type="text" name="subjectCodeUpdate" value="{{ $subject->subject_code }}">
            <input type="text" name="subjectNameUpdate" value="{{ $subject->subject_name }}">
            <input type="hidden" name="subject_code" value="{{ $subject->subject_code }}">
            <button type="submit">Submit</button>
        </form>
    </div>

@endsection()
