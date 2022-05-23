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
        {{ Breadcrumbs::render('lecturer') }}
        <form action="" method="GET" class="input-group mt-5 mb-5">
            <input type="search" name="search" class="form-control rounded" placeholder="Search" aria-label="Search"
                aria-describedby="search-addon" />
            <button type="submit" class="btn btn-outline-primary">Search</button>
        </form>


        <h1>Insert Here</h1>
        <form action="./lecturer-insert" method="POST" class="input-group mt-3 mb-5">
            @csrf
            <input type="search" name="lecturer_name" class="form-control rounded" placeholder="Input lecturer name "
                aria-label="Search" aria-describedby="search-addon" />
            <input type="search" name="lecturer_code" class="form-control rounded" placeholder="Input lecturer code "
                aria-label="Search" aria-describedby="search-addon" />
            <button type="submit" class="btn btn-outline-primary">Insert</button>
        </form>

        <table class="table">
            <thead>
                <tr>
                    <th>Lecture Code</th>
                    <th>Lecturer Name</th>
                    <th>Lecturer Email</th>
                    <th>Created At</th>
                    <th colspan="2">Action</th>
                </tr>
            </thead>
            <tbody>
                <div style="display:none">
                    {{ $i = 0 }}
                </div>
                @foreach ($deleted as $curr)
                    <tr style="background-color: rgba(255, 96, 96, 0.589)">
                        <td>{{ $curr->lecturer_code }}</td>
                        <td>{{ $curr->lecturer_name }}</td>
                        <td>{{ $email[$i]->email }}</td>
                        <td>{{ $curr->created_at }}</td>
                        <td>
                            <form action="/update-lecturer/{{ $curr->lecturer_code }}">
                                <button type="submit" class="btn btn-primary">Update</button>
                            </form>
                        </td>
                        <form action="/lecturer-restore" method="POST">
                            @csrf
                            <input type="hidden" name="id" value="{{ $curr->lecturer_code }}">
                            <td> <button class="btn btn-warning" type="submit">restore</button></td>
                        </form>
                    </tr>
                    <div style="display:none">
                        {{ $i += 1 }}
                    </div>
                @endforeach
                @foreach ($data as $curr)
                    <tr>
                        <td>{{ $curr->lecturer_code }}</td>
                        <td>{{ $curr->lecturer_name }}</td>
                        <td>{{ $curr->user->email }}</td>
                        <td>{{ $curr->created_at }}</td>
                        <td><a href="/update-lecturer/{{ $curr->lecturer_code }}">Update</td>
                        <form action="/lecturer-delete" method="POST">
                            @csrf
                            <input type="hidden" name="lecturer_code" value="{{ $curr->lecturer_code }}">
                            <td> <button class="btn btn-outline-danger" type="submit">Delete</button></td>
                        </form>
                    </tr>
                @endforeach
            </tbody>
            {{ $data->withQueryString()->links() }}
        </table>
        {{-- {{$data->withQueryString()->links('pagination::bootstrap-4')}} --}}
    </div>

@endsection()
