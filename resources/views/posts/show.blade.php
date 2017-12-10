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

    <section class="content">

        @if (session('status'))

            <div class="container">
                <div class="row">
                    <div class="alert alert-success">
                        {{ session('status') }}
                    </div>
                </div>
            </div>

        @endif

        <div class="container">
            <div class="row">

                <div class="post col-12">
                    <div class="text-muted mb-5">2 minutes reading</div>
                    <div class="h4 title mb-5">
                        {{ $post->title }}
                        @if( \Illuminate\Support\Facades\Session::get('is_admin') === true )
                            <a href="/posts/{{ $post->alias }}/edit" class="btn btn-primary">Edit</a>
                        @endif
                    </div>
                    <div class="views">
                        <i class="fa fa-eye" aria-hidden="true"></i> {{ $post->views }}
                    </div>
                    <div class="intro">
                        {!! html_entity_decode($post->content) !!}
                    </div>
                    <div class="tags">
                        @foreach($post->tags()->get() as $tag)
                            <a href="/tag/{{ $tag->alias }}" class="badge badge-info">
                                <i class="fa fa-tag" aria-hidden="true"></i> {{ $tag->title }}
                            </a>
                        @endforeach
                    </div>
                    <div class="status">
                        Status: {{ $post->status }}
                    </div>
                </div>

            </div>
        </div>
    </section>
@endsection
