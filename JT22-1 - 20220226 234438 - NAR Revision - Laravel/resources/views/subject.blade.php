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
        {{ Breadcrumbs::render('subject') }}
        <form action="" method="GET" class="input-group mt-5 mb-5">
            <input type="search" name="search" class="form-control rounded" placeholder="Search" aria-label="Search"
                aria-describedby="search-addon" />
            <button type="submit" class="btn btn-outline-primary">Search</button>
        </form>



        <h1>Insert Here</h1>
        <form action="./subject-insert" method="POST" class="input-group mt-3 mb-5">
            @csrf
            <input type="search" name="subject_name" class="form-control rounded" placeholder="Input subject name"
                aria-label="Search" aria-describedby="search-addon" />
            <input type="search" name="subject_code" class="form-control rounded" placeholder="Input subject code"
                aria-label="Search" aria-describedby="search-addon" />
            <button type="submit" class="btn btn-outline-primary">Insert</button>
        </form>

        <table class="table">
            <thead>
                <tr>
                    <th>Code</th>
                    <th>Name</th>
                    <th>Created At</th>
                    <th colspan="2">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($deleted as $curr)
                    <tr style="background-color: rgba(255, 96, 96, 0.589)">
                        <td>{{ $curr->subject_code }}</td>
                        <td>{{ $curr->subject_name }}</td>
                        <td>{{ $curr->created_at }}</td>
                        <td>
                            <form action="/update-subject/{{ $curr->subject_code }}">
                                <button type="submit" class="btn btn-primary">Update</button>
                            </form>
                        </td>
                        <form action="/subject-restore" method="POST">
                            @csrf
                            <input type="hidden" name="id" value="{{ $curr->subject_code }}">
                            <td> <button class="btn btn-warning" type="submit">restore</button></td>
                        </form>
                    </tr>
                @endforeach
                @foreach ($data as $curr)
                    <tr>
                        <td>{{ $curr->subject_code }}</td>
                        <td>{{ $curr->subject_name }}</td>
                        <td>{{ $curr->created_at }}</td>
                        <td><a href="/update-subject/{{ $curr->subject_code }}">Update</td>
                        <form action="/subject-delete" method="POST">
                            @csrf
                            <input type="hidden" name="subject_code" value="{{ $curr->subject_code }}">
                            <td> <button class="btn btn-outline-danger" type="submit">Delete</button></td>
                        </form>
                    </tr>
                @endforeach
            </tbody>
            {{ $data->withQueryString()->links() }}
        </table>
    </div>

@endsection()
