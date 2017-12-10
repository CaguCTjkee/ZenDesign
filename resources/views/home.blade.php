@extends('layouts.app')

@section('content')

    <section class="content">

        @if (session('message'))

            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="alert alert-success">
                            {{ session('message') }}
                        </div>
                    </div>
                </div>
            </div>

        @endif

        <div class="container">
            <div class="row">

                <div class="col-12 col-md-9">

                    @if( \Illuminate\Support\Facades\Session::get('is_admin') === true )
                        <div class="editor">
                            <a href="/posts/create" class="btn btn-primary float-right">+ Add Post</a>
                        </div>
                    @endif

                    @foreach($data['posts'] as $post)

                        <div class="post {{ $post->status }}">
                            <div class="tags">
                                @foreach($post->tags()->get() as $tag)
                                    <a href="/tag/{{ $tag->alias }}" class="badge badge-info">
                                        <i class="fa fa-tag" aria-hidden="true"></i> {{ $tag->title }}
                                    </a>
                                @endforeach
                            </div>
                            <div class="h4 title">
                                <a href="{{ config('app.url') }}/posts/{{ $post->alias }}">{{ $post->title }}</a>
                                @if( \Illuminate\Support\Facades\Session::get('is_admin') === true )
                                    <a href="/posts/{{ $post->alias }}/edit" class="btn btn-primary">Edit</a>
                                @endif
                            </div>
                            <div class="intro">
                                {!! html_entity_decode($post->intro) !!}
                            </div>
                            <div class="read-more">
                                <a href="{{ config('app.url') }}/posts/{{ $post->alias }}"
                                   class="btn btn-primary">{{ $post->read_more }}</a>
                            </div>
                        </div>

                    @endforeach

                    {{ $data['posts']->links('layouts.pagination') }}

                </div>

                <div class="col-12 col-md-3">
                    <div class="block">
                        <div class="h3">Tags</div>
                        <div class="block-content">
                            @foreach($data['tags'] as $tag)
                                <a href="/tag/{{ $tag->alias }}" class="badge badge-info">
                                    <i class="fa fa-tag" aria-hidden="true"></i> {{ $tag->title }}
                                </a>
                            @endforeach
                        </div>
                    </div>
                </div>

            </div>
        </div>

    </section>

@endsection
