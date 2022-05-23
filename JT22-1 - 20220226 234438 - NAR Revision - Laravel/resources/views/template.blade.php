<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset('bootstrap/css/bootstrap.css') }}">
    <link rel="stylesheet" href="{{ asset('bootstrap/js/bootstrap.js') }}">

    <title>@yield('title')</title>

</head>
<style>
    .wrapper {
        text-align: center;
        width: 1000px;
        margin: 0 auto;
    }

    .wow {
        position: fixed;
        left: 0;
        height: 100vh;
    }

    .content {
        /* margin-top: 30px; */
    }

    .wrapper-nav {
        position: fixed;
        top: 0;
        width: 100vw;
    }

</style>

@if (Auth::user()->role == 'admin')
    <div class="wrapper">
        <div class="d-flex flex-column flex-shrink-0 p-3 wow" style="width: 280px;">

            <hr>

            <ul class="nav nav-pills flex-column mb-auto">
                <li>
                    <h3>Bee Portal</h3>
                </li>
                <li class="nav-item">
                    <a href="/allocation" class="nav-link" aria-current="page">
                        <svg class="bi me-2" width="16" height="16">
                            <use xlink:href="#"></use>
                        </svg>

                        Allocation
                    </a>
                </li>
                <li>
                    <a href="/classroom" class="nav-link link-dark">
                        <svg class="bi me-2" width="16" height="16">
                            <use xlink:href="#speedometer2"></use>
                        </svg>
                        Manage Classroom
                    </a>
                </li>
                <li>
                    <a href="/lecturer" class="nav-link link-dark">
                        <svg class="bi me-2" width="16" height="16">
                            <use xlink:href="#table"></use>
                        </svg>
                        Manage Lecturers
                    </a>
                </li>
                <li>
                    <a href="/student" class="nav-link link-dark">
                        <svg class="bi me-2" width="16" height="16">
                            <use xlink:href="#grid"></use>
                        </svg>
                        Manage Students
                    </a>
                </li>
                <li>
                    <a href="/subject" class="nav-link link-dark">
                        <svg class="bi me-2" width="1" height="16">
                            <use xlink:href="#people-circle"></use>
                        </svg>
                        Manage Subjects
                    </a>
                </li>
            </ul>
            <hr>
        </div>

    </div>

    <div class="content">
        @yield('content')
    </div>

    <div class="wrapper-nav">

        <nav class="navbar navbar-expand-lg">
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mr-auto">
                </ul>
                <form action="/logout" class="form-inline my-2 my-lg-0" style="margin-right: 30px">
                    <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Logout</button>
                </form>
            </div>
        </nav>

    </div>
@endif

@if (Auth::user()->role != 'admin')
    <div class="wrapper">
        <div class="d-flex flex-column flex-shrink-0 p-3 wow" style="width: 280px;">
            <svg class="bi me-2" width="40" height="32">
                <use xlink:href="#bootstrap"></use>
            </svg>
            <span class="fs-4"></span>

            <hr>
            <ul class="nav nav-pills flex-column mb-auto">
                <li class="nav-item">
                    <a href="/courses" class="nav-link" aria-current="page">
                        <svg class="bi me-2" width="16" height="16">
                            <use xlink:href="#"></use>
                        </svg>
                        Courses
                    </a>
                </li>
                <li>
                    <a href="/dashboard" class="nav-link link-dark">
                        <svg class="bi me-2" width="16" height="16">
                            <use xlink:href="#speedometer2"></use>
                        </svg>
                        Dashboard
                    </a>
                </li>
                <li>
                    <a href="/forums" class="nav-link link-dark">
                        <svg class="bi me-2" width="16" height="16">
                            <use xlink:href="#table"></use>
                        </svg>
                        Forums
                    </a>
                </li>
                <li>
                    <a href="/schedules" class="nav-link link-dark">
                        <svg class="bi me-2" width="16" height="16">
                            <use xlink:href="#grid"></use>
                        </svg>
                        Schedules
                    </a>
                </li>
            </ul>
            <hr>
        </div>

    </div>

    <div class="content">
        @yield('content')
    </div>

    <div class="wrapper-nav">

        <nav class="navbar navbar-expand-lg">
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mr-auto">
                </ul>
                <form action="/logout" class="form-inline my-2 my-lg-0" style="margin-right: 30px">
                    <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Logout</button>
                </form>
            </div>
        </nav>

    </div>
@endif


</html>
