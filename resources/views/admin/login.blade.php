
@extends('layouts.app')
@section('custom_css')
    <link href="css/custom.css" rel="stylesheet">
@endsection

@section('content')
<div id="fullscreen_bg" class="fullscreen_bg"/>
<nav class="navbar navbar-default">
    <div class="container-fluid">
        <div class="navbar-header">
            <a class="navbar-brand" href="#">
                BEKO ADMIN
            </a>
        </div>
    </div>
</nav>
<div class="container">

    <form class="form-signin" role="form" method="POST" action="{{ urlWithoutSchema('/admin/authenticate') }}">
        <h1 class="form-signin-heading text-muted">Sign In</h1>

        <input type="text" class="form-control" name="email" placeholder="Email address" required autofocus>
        <input type="password" class="form-control" name="password" placeholder="Password" required>

        @if (Session::has('message'))
            <div class="alert alert-danger" role="alert">{{ Session::get('message') }}</div>
        @endif

        <button class="btn btn-lg btn-primary btn-block" type="submit">
            Sign In
        </button>
    </form>

</div>

@endsection