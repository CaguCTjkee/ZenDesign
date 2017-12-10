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

    <section class="content_edit">

        @if (session('status'))

            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    </div>
                </div>
            </div>

        @endif

        @if (session('message'))

            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="alert alert-success message">
                            {{ session('message') }}
                        </div>
                    </div>
                </div>
            </div>

        @endif

        <div class="container">
            <div class="row">

                <div class="col-12 mb-5">

                    <h1 class="display-4">
                        Edit
                        @if( $post->status == 'draft' )
                            Draft
                        @endif()
                        <span class="live-title-content">"{{ $post->title }}"</span>
                    </h1>

                    <form action="{{ route('posts.update', $post->alias) }}" method="POST">
                        {{ csrf_field() }}
                        <input type="hidden" name="_method" value="PUT">

                        <div class="form-group">
                            <label for="title">Title</label>
                            <input type="text" name="title" id="title" class="form-control live-title"
                                   value="{{ $post->title }}">
                        </div>

                        <div class="form-group">
                            <label for="alias">Alias</label>
                            <input type="text" name="alias" id="alias" class="form-control live-translation"
                                   value="{{ $post->alias }}">
                        </div>

                        <div class="form-group">
                            <label for="intro">Intro</label>
                            <textarea name="intro" id="intro" rows="5"
                                      class="form-control">{{ $post->intro }}</textarea>
                        </div>

                        <div class="form-group">
                            <label for="content">Content</label>
                            <textarea name="content" id="content"
                                      class="form-control simplemde">{{ $post->content }}</textarea>
                        </div>

                        <div class="form-group">
                            <label for="tags">Tags</label>
                            <label class="tags-list">
                                <div class="tags-list-content clearfix">
                                    @foreach($post->tagsArray() as $alias => $tag)
                                        <div class="btn btn-sm btn-info tag">
                                            <input type="hidden" name="tag[]" value="{{$tag}}">
                                            {{$tag}}
                                            <div class="badge badge-light remove">&times;</div>
                                        </div>
                                    @endforeach
                                </div>
                                <input type="text" name="tags" id="tags" value="">
                            </label>
                        </div>

                        <div class="form-group">
                            <label for="read_more">Read more text</label>
                            <input type="text" name="read_more" id="read_more" class="form-control"
                                   value="{{ $post->read_more }}">
                        </div>

                        <div class="form-group hidden">
                            <label for="status">Status</label>
                            <select name="status" id="status" class="form-control">
                                <option value="publish">Publish</option>
                                <option value="draft" @if($post->status === 'draft') selected @endif>Draft</option>
                            </select>
                        </div>

                        <button class="btn btn-danger float-right" onclick="getElementById('destroy').submit()"
                                type="button">Delete
                        </button>

                        <button class="btn btn-success save-as save-publish" type="submit">Publish</button>
                        <button class="btn btn-dark save-as save-draft" type="submit">Save as Draft</button>
                    </form>
                    <form action="{{ route('posts.destroy', $post->alias) }}" method="POST" id="destroy">
                        {{ csrf_field() }}
                        <input type="hidden" name="_method" value="DELETE">
                    </form>
                </div>

            </div>
        </div>
    </section>
@endsection
