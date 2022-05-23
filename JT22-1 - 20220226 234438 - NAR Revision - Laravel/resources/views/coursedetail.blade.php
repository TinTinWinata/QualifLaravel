@extends('template')

@section('title', 'Login')


@section('content')

    <div class="bc" style="width: 500px">
        {{ Breadcrumbs::render('courseDetail') }}
    </div>

    <style>
        .content {
            width: 1000px;
            margin: 0 auto;
            margin-top: 75px;
            padding-top: 30px;
            /* border: 1px solid red; */
        }

    </style>
    {{-- {{ $today = $data['today'] }} --}}
    {{-- {{ dd($data['forum']) }} --}}
    <div class="content">

        <h2>Information</h2>
        <div class="d-flex">
            <div>

                <table>
                    <tr>
                        <td>
                            Subject
                        </td>
                        <td>{{ $data['subject']->subject_name }}</td>
                    </tr>
                    <tr>
                        <td>
                            Classroom
                        </td>
                        <td>{{ $data['allocation']->classroom }}</td>
                    </tr>
                    <tr>
                        <td>
                            Lecturer
                        </td>
                        <td>
                            {{ $data['lecturer']->lecturer_name }}
                        </td>
                    </tr>
                </table>
            </div>
            <div style="margin-left: 200px;">
                <h2>Assignment</h2>
                <table class="table">
                    <thead>
                        <tr>
                            <td>Title</td>
                            <td>Starts At</td>
                            <td>Ends At</td>
                            <td>Created by</td>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data['assignment'] as $curr)
                            <tr>
                                <td>{{ $curr['title'] }}</td>
                                <td>{{ $curr['start_at'] }}</td>
                                <td>{{ $curr['end_at'] }}</td>
                                <td>{{ $curr['lecturer_name'] }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <table class="table">
            <thead>
                <tr>
                    <td>Code</td>
                    <td>Name</td>
                    <td>Email</td>
                </tr>
            </thead>
            <tbody>
                <h1>Student List</h1>
                @foreach ($data['student'] as $curr)
                    <tr>
                        <td>{{ $curr->student_code }}</td>
                        <td>{{ $curr->name }}</td>
                        <td>{{ $curr->email }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>


@endsection()
