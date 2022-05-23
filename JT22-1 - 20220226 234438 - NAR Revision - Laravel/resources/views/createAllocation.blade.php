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
        <div class="bc" style="width: 500px">
            {{ Breadcrumbs::render('updateAllocation') }}
        </div>
        <h2>Create Allocation</h2>
        <form action="/create-form-allocation" method="POST">
            <div class="mb-2 d-flex">
                @csrf
                <label style="margin-top:10px">
                    <b>Subject</b>
                </label>
                <select name="subject" class="form-select">
                    @foreach ($subjectList as $curr)
                        <option value="{{ $curr->subject_code }}" name="classroom">{{ $curr->subject_name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="mb-2 d-flex">
                @csrf
                <label style="margin-top:10px">
                    <b>Lecturer</b>
                </label>
                <select name="classroom" class="form-select">
                    @foreach ($classroomList as $curr)
                        <option value="{{ $curr->classroom }}" name="classroom">{{ $curr->classroom }}</option>
                    @endforeach
                </select>
            </div>
            <div class="mb-2 d-flex">
                @csrf
                <label style="margin-top:10px">
                    <b>Subject</b>
                </label>
                <select name="lecturer" class="form-select">
                    @foreach ($lecturerList as $curr)
                        <option value="{{ $curr->lecturer_code }}" name="classroom">{{ $curr->lecturer_name }}</option>
                    @endforeach
                </select>
            </div>
            <button type="submit" class="btn btn-info">Submit</button>
        </form>
    </div>

@endsection()
