@extends('template')

@section('title', 'Login')


@section('content')

    <style>
        .content {
            width: 1000px;
            text-align: center;
            margin: 0 auto;
            margin-top: 75px;
            padding-top: 30px;
            /* border: 1px solid red; */
        }

    </style>
    {{-- {{ $today = $data['today'] }} --}}
    {{-- {{ dd($data['forum']) }} --}}
    <div class="content">
        {{ Breadcrumbs::render('dashboard') }}

        <h2>Schedule Today</h2>
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">Allocation ID</th>
                    <th scope="col">Date</th>
                    <th scope="col">Time</th>
                </tr>
            </thead>

            <tbody>
                @if ($data['today'] != null)
                    @foreach ($data['today'] as $curr)
                        <tr>
                            <td>{{ $curr->allocation_id }}</td>
                            <td>{{ $curr->date }}</td>
                            <td>{{ $curr->time }}</td>
                        </tr>
                    @endforeach
                @else
                    <td> </td>
                    <td> No data for today </td>
                    <td> </td>
                @endif
            </tbody>
        </table>
        <h2>Recent Forums</h2>
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">Title</th>
                    <th scope="col">Subject</th>
                    <th scope="col">Class</th>
                    <th scope="col">Created By</th>
                    <th scope="col">Created At</th>
                </tr>
            </thead>


            <tbody>
                @if ($data['forum'] != null)
                    @foreach ($data['forum'] as $curr)
                        <tr>
                            <td>{{ $curr['title'] }}</td>
                            <td>{{ $curr['subject_name'] }}</td>
                            <td>{{ $curr['classroom'] }}</td>
                            <td>{{ $curr['creator'] }}</td>
                            <td>{{ $curr['created_at'] }}</td>
                        </tr>
                    @endforeach
                @else
                    <td> </td>
                    <td> No data for today </td>
                    <td> </td>
                @endif
            </tbody>
        </table>
        <h2>Recent Assignments</h2>
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">Title</th>
                    <th scope="col">Subject</th>
                    <th scope="col">Class</th>
                    <th scope="col">Created By</th>
                    <th scope="col">Start At</th>
                    <th scope="col">End At</th>
                </tr>
            </thead>


            <tbody>
                @if ($data['assignment'] != null)
                    @foreach ($data['assignment'] as $curr)
                        <tr>
                            <td>{{ $curr['title'] }}</td>
                            <td>{{ $curr['subject_name'] }}</td>
                            <td>{{ $curr['classroom'] }}</td>
                            <td>{{ $curr['lecturer_name'] }}</td>
                            <td>{{ $curr['start_at'] }}</td>
                            <td>{{ $curr['end_at'] }}</td>
                        </tr>
                    @endforeach
                @else
                    <td> </td>
                    <td> No data for today </td>
                    <td> </td>
                @endif
            </tbody>
        </table>
    </div>


@endsection()
