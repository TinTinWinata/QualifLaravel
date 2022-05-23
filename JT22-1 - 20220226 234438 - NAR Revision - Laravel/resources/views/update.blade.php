@extends('template')

@section('title', 'Update')



<style>
    .content {
        margin-top: 50px;
        margin-left: 300px;
    }

</style>

@section('content')
    <div class="content">
        <form action="/update-form" method="POST">
            <div class="bc" style="width: 500px">
                {{ Breadcrumbs::render('updateAllocation') }}
            </div>
            @csrf
            <input type="text" name="lecturerUpdate" value="{{ $alloc->lecturer->lecturer_name }}">
            <input type="text" name="classroomUpdate" value="{{ $alloc->classroom }}">
            <input type="text" name="subjectUpdate" value="{{ $alloc->subject->subject_name }}">
            <input type="hidden" name="lecturer_code" , value="{{ $alloc->lecturer->lecturer_code }}">
            <input type="hidden" name="subject_code" , value="{{ $alloc->subject->subject_code }}">
            <input type="hidden" name="id" value="{{ $alloc->id }}">
            <input type="hidden" name="classroom" value="{{ $alloc->classroom }}">
            <button type="submit">Submit</button>
        </form>
    </div>

@endsection()
