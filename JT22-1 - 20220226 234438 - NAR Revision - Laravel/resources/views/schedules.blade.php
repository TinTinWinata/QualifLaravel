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
    <div class="content">
        {{ Breadcrumbs::render('schedules') }}

        <h2>Schedule</h2>
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">Allocation ID</th>
                    <th scope="col">Date</th>
                    <th scope="col">Time</th>
                </tr>
            </thead>

            <tbody>
                @if ($data['schedule'] != null)
                    @foreach ($data['schedule'] as $curr)
                        <tr>
                            <td>{{ $curr['subject_name'] }}</td>
                            <td>{{ $curr['date'] }}</td>
                            <td>{{ $curr['time'] }}</td>
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
