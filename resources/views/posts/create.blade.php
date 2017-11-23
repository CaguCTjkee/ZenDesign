@extends('layouts.app')

@section('content')

    <section class="header">

        <div class="container-fluid">

            <div class="row">
                <div class="col-12">
                    <div class="all-posts">
                        <a href="{{ config('app.url') }}" class="btn btn-sm btn-default">All posts</a>
                    </div>
                </div>
            </div>

        </div>
    </section>

    <section class="content_create">

        @if (session('status'))

            <div class="container">
                <div class="row">
                    <div class="alert alert-success">
                        {{ session('status') }}
                    </div>
                </div>
            </div>

        @endif

        @if(count($errors->all()) > 0)
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="alert alert-info mb-4">
                            <ul class="list-unstyled">
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        @endif

        <div class="container">
            <div class="row">

                <div class="col-12 mb-5">

                    <h1 class="display-4">Create a <span class="live-title-content"></span> new post</h1>

                    <form action="{{ route('posts.store') }}" method="POST">
                        {{ csrf_field() }}

                        <div class="form-group">
                            <label for="title">Title</label>
                            <input type="text" name="title" id="title" class="form-control live-title" value="">
                        </div>

                        <div class="form-group">
                            <label for="alias">Alias</label>
                            <input type="text" name="alias" id="alias" class="form-control live-translation" value="">
                        </div>

                        <div class="form-group">
                            <label for="intro">Intro</label>
                            <textarea name="intro" id="intro" rows="5" class="form-control"></textarea>
                        </div>

                        <div class="form-group">
                            <label for="content">Content</label>
                            <textarea name="content" id="content" class="form-control simplemde"></textarea>
                        </div>

                        <div class="form-group">
                            <label for="tags">Tags</label>
                            <label class="tags-list">
                                <div class="tags-list-content clearfix">
                                </div>
                                <input type="text" name="tags" id="tags" value="">
                            </label>
                        </div>

                        <div class="form-group">
                            <label for="read_more">Read more text</label>
                            <input type="text" name="read_more" id="read_more" class="form-control" value="Read more">
                        </div>

                        <div class="form-group">
                            <label for="status">Status</label>
                            <select name="status" id="status" class="form-control">
                                <option value="publish">Publish</option>
                                <option value="draft">Draft</option>
                            </select>
                        </div>

                        <button class="btn btn-success" type="submit">Save</button>

                    </form>
                </div>

            </div>
        </div>
    </section>
@endsection
