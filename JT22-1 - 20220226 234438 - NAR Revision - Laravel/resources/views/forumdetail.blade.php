@extends('template')

@section('title', 'Login')


@section('content')

    <style>
        .content {
            width: 1000px;
            margin: 0 auto;
            margin-top: 75px;
            padding-top: 30px;
            /* border: 1px solid red; */
        }

    </style>

    <div class="content">
        <div class="bc" style="width: 500px">
            {{ Breadcrumbs::render('forumDetail') }}
        </div>
        <div class="card" style="width: 70rem;">
            <div class="card-body">
                <h3 class="card-title">{{ $forum->title }}</h3>
                <p class="card-subtitle mb-2 text-muted">
                    <span> {{ $forum->allocation->lecturer->lecturer_name }}</span>
                    <span> {{ $forum->created_at }}</span>
                </p>
                <p>{{ $forum->content }}</p>
            </div>
        </div>
        <div class="card mt-3" style="width: 70rem;">
            <div class="card-body">
                <div class="form-group">
                    <label for="">
                        <h4>Reply</h4>
                    </label>
                    <form action="/create-reply" method="POST">
                        @csrf
                        <input type="hidden" name="forum" value="{{ $forum->forum_id }}">
                        <textarea name="reply" class="form-control" id="exampleFormControlTextarea1" rows="8"></textarea>
                        <button type="submit" class="mt-2 btn btn-info">Submit</button>
                    </form>
                </div>
            </div>
        </div>
        <div class="card mt-3" style="width: 70rem;">
            <div class="card-body">
                <h3 class="card-title">Replies</h3>
                @foreach ($reply as $curr)
                    <div class="card mt-2" style="width: 70rem;">
                        <div class="card-body">
                            <p>{{ $curr->user->name }}</p>
                            <p class="card-subtitle mb-2 text-muted" style="font-size:13px">
                                <span> {{ $curr->created_at }}</span>
                            </p>
                            <p>{{ $curr->content }}</p>
                            @if (Auth::user()->id == $curr->user_id)
                                <div class="d-flex">
                                    <form action="" class="mr-2">
                                        <button class="btn btn-warning">Update</button>
                                    </form>
                                    <form action="/delete-reply" method="POST">
                                        @csrf
                                        <input type="hidden" name="id" value="{{ $curr->id }}">
                                        <button type="submit" class="btn btn-danger">Delete</button>
                                    </form>
                                </div>
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    @endsection()
