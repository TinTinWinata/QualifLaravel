@extends('template')

@section('title', 'Login')


@section('content')

    <style>
        .content {
            width: 1000px;
            margin: 0 auto;
            margin-top: 75px;
            padding-top: 30px;
        }

        .pointer {
            cursor: pointer;
        }

    </style>
    <div class="content">
        {{ Breadcrumbs::render('forums') }}
        <h2>My Forums</h2>
        <div class="d-flex flex-wrap">
            @foreach ($forumList as $curr)
                <div>
                    <form action="./forums/{{ $curr->allocation->id }}" method="GET">
                        <button class="ml-2 mb-2 mt-1 btn btn-dark">
                            {{ $curr->allocation->subject->subject_name }}
                        </button>
                    </form>
                </div>
            @endforeach
        </div>

        <table class="table">
            <tr>
                <th>
                    Title
                </th>
                <th>
                    Created By
                </th>
                <th>
                    Created At
                </th>
            </tr>
            @foreach ($forumList as $curr)
                <tr class='pointer' data-href="forum/{{ $curr->forum_id }}">
                    <td>{{ $curr->title }}</td>
                    <td>{{ $curr->creator }}</td>
                    <td>{{ $curr->created_at }}</td>
                </tr>
            @endforeach

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
