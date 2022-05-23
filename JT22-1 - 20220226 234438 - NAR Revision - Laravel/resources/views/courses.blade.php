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

        .pointer {
            cursor: pointer;
        }

    </style>

    <div class="content">
        {{ Breadcrumbs::render('courses') }}

        <h2>My Course</h2>
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">Subject</th>
                    <th scope="col">Class</th>
                    <th scope="col">Lecturer</th>
                </tr>
            </thead>

            <tbody>
                @foreach ($allocations as $curr)
                    <tr class='pointer' data-href="courses/{{ $curr->id }}">
                        <td>{{ $curr->subject->subject_name }}</td>
                        <td>{{ $curr->classroom }}</td>
                        <td>{{ $curr->lecturer->lecturer_name }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const rows = document.querySelectorAll("tr[data-href]")

            rows.forEach(row => {
                row.addEventListener('click', function() {
                    window.location.href = row.dataset.href;
                })
            })
        })
    </script>



@endsection()
