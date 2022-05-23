@extends('template')

@section('title', 'Login')


@section('content')


    <style>
        .second {
            /* border: 1px solid red; */
            margin-right: 800px;
            text-align: none;
            padding-bottom: 20px;
        }

        .wrapper {
            /* background-color: red; */
            padding-top: 75px;
            /* margin-top: 500px; */
        }

    </style>
    <div class="wrapper">
        {{ Breadcrumbs::render('allocation') }}
        <form action="" method="GET" class="input-group mt-3 mb-5">
            <input type="search" name="search" class="form-control rounded" placeholder="Search" aria-label="Search"
                aria-describedby="search-addon" />
            <button type="submit" class="btn btn-outline-primary">search</button>
        </form>
        <div class="second">
            <form action="/create-allocation">
                <button class="btn-primary">
                    Create Allocation
                </button>
            </form>
        </div>
        <table class="table">
            <thead>
                <tr>
                    <th>Subject</th>
                    <th>Classroom</th>
                    <th>Lecturer</th>
                    <th>Created At</th>
                    <th colspan="2">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($allocationDeleted as $curr)
                    <tr style="background-color: rgba(255, 96, 96, 0.589)">
                        <td>{{ $curr->subject->subject_code }} - {{ $curr->subject->subject_name }}</td>
                        <td>{{ $curr->classroom }}</td>
                        <td>{{ $curr->lecturer->lecturer_name }}</td>
                        <td>{{ $curr->created_at }}</td>
                        <td>
                            <form action="/update/{{ $curr->id }}">
                                <button type="submit" class="btn btn-primary">Update</button>
                            </form>
                        </td>
                        <form action="/restore" method="POST">
                            @csrf
                            <input type="hidden" name="id" value="{{ $curr->id }}">
                            <td> <button class="btn btn-warning" type="submit">restore</button></td>
                        </form>
                    </tr>
                @endforeach
                @foreach ($allocation as $curr)
                    <tr>
                        <td>{{ $curr->subject->subject_code }} - {{ $curr->subject->subject_name }}</td>
                        <td>{{ $curr->classroom }}</td>
                        <td>{{ $curr->lecturer->lecturer_name }}</td>
                        <td>{{ $curr->created_at }}</td>
                        <td><a href="/update/{{ $curr->id }}">Update</td>
                        <form action="/delete" method="POST">
                            @csrf
                            <input type="hidden" name="id" value="{{ $curr->id }}">
                            <td> <button class="btn btn-outline-danger" type="submit">Delete</button></td>
                        </form>
                    </tr>
                @endforeach
            </tbody>
        </table>
        {{ $allocation->withQueryString()->links('pagination::bootstrap-4') }}
    </div>
@endsection()
