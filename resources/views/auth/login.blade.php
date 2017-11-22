@extends('layouts.app')

@section('content')

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

        @if(count($errors->all()) > 0)
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="alert alert-info mb-4">
                            <ul>
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
                <div class="col-12 text-center">

                    <h1 class="display-4 mb-5">Try to login</h1>

                    <form class="form-inline mx-auto mw-385" method="POST" action="{{ route('admin') }}">
                        {{ csrf_field() }}

                        <div class="form-group">
                            <label for="password">Password</label>
                            <input type="password" class="form-control mx-sm-3" name="password" autofocus>
                        </div>

                        <button class="btn btn-primary">
                            Send
                        </button>

                    </form>

                </div>

            </div>
        </div>

    </section>

@endsection
