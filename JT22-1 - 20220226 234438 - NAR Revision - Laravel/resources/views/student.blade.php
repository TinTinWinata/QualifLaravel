@extends('template')

@section('title', 'Login')


@section('content')


    <style>
        .wrapper {
            width: 1000px;
            text-align: center;
            margin: 0 auto;
            margin-top: 75px;
        }

    </style>
    <div class="wrapper">
        {{ Breadcrumbs::render('student') }}
        <form action="" method="GET" class="input-group mt-5 mb-5">
            <input type="search" name="search" class="form-control rounded" placeholder="Search" aria-label="Search"
                aria-describedby="search-addon" />
            <button type="submit" class="btn btn-outline-primary">Search</button>
        </form>


        <h1>Insert Here</h1>
        <form action="./student-insert" method="POST" class="input-group mt-3 mb-5">
            @csrf
            <input type="search" name="student_name" class="form-control rounded" placeholder="Input student name"
                aria-label="Search" aria-describedby="search-addon" />
            <input type="search" name="student_email" class="form-control rounded" placeholder="Input student email"
                aria-label="Search" aria-describedby="search-addon" />
            <button type="submit" class="btn btn-outline-primary">Insert</button>
        </form>

        <table class="table">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Student Code</th>
                    <th>Created At</th>
                    <th colspan="2">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($deleted as $curr)
                    <tr style="background-color: rgba(255, 96, 96, 0.589)">
                        <td>{{ $curr->name }}</td>
                        <td>{{ $curr->email }}</td>
                        <td>{{ $curr->student_code }}</td>
                        <td>{{ $curr->created_at }}</td>
                        <td>
                            <form action="/update-student/{{ $curr->student_code }}">
                                <button type="submit" class="btn btn-primary">Update</button>
                            </form>
                        </td>
                        <form action="/student-restore" method="POST">
                            @csrf
                            <input type="hidden" name="id" value="{{ $curr->student_code }}">
                            <td> <button class="btn btn-warning" type="submit">restore</button></td>
                        </form>
                    </tr>
                @endforeach
                @foreach ($data as $curr)
                    <tr>
                        <td>{{ $curr->name }}</td>
                        <td>{{ $curr->email }}</td>
                        <td>{{ $curr->student_code }}</td>
                        <td>{{ $curr->created_at }}</td>
                        <td><a href="/update-student/{{ $curr->student_code }}">Update</td>
                        <form action="/student-delete" method="POST">
                            @csrf
                            <input type="hidden" name="student_code" value="{{ $curr->student_code }}">
                            <td> <button class="btn btn-outline-danger" type="submit">Delete</button></td>
                        </form>
                    </tr>
                @endforeach
            </tbody>
            {{ $data->withQueryString()->links() }}
        </table>
    </div>

@endsection()
