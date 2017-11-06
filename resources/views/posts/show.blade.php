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
                    </div>
                    <div class="intro">
                        {!! html_entity_decode($post->content) !!}
                    </div>
                </div>

            </div>
        </div>
    </section>
@endsection
