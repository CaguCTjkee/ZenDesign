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

                @if( \Illuminate\Support\Facades\Session::get('is_admin') === true )
                    <div class="editor col-12">
                        <a href="/posts/create" class="btn btn-primary float-right">+ Add</a>
                    </div>
                @endif

                @foreach($data['posts'] as $post)

                    <div class="post col-12 {{ $post->status }}">
                        <div class="tags">
                            @foreach($post->tags()->get() as $tag)
                                <a href="/tag/{{ $tag->alias }}" class="badge badge-info"><i class="fa fa-tag"
                                                                                             aria-hidden="true"></i> {{ $tag->title }}
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

            </div>
        </div>

    </section>

@endsection
