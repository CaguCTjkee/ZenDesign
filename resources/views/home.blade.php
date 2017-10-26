@extends('layouts.app')

@section('content')

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

                @foreach($data['posts'] as $post)
                    
                    <div class="post col-sm-4">
                        <div class="h4 title">
                            <a href="/posts/{{ $post->alias }}">{{ $post->title }}</a>
                        </div>
                        <div class="intro">
                            {!! html_entity_decode($post->intro) !!}
                        </div>
                        <a href="/posts/{{ $post->alias }}" class="btn btn-primary">More...</a>
                    </div>

                @endforeach

        </div>
    </div>
@endsection
