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
                    BEKO <span>ADMIN</span>
                </a>
            </div>
        </div>
    </nav>

    <div class="container">
        <h2>Create Promotion</h2>
        <form class="col-md-12 well">
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="name">Title</label>
                        <input type="text" class="form-control" name="name" placeholder="Enter Title">
                    </div>
                    <div class="form-group">
                        <label for="email">Banner Image</label>
                        <input type="file">
                    </div>
                    <div class="form-group">
                        <label for="phone">Choose Card</label>
                        <div class="clearfix"></div>
                        <select class="selectpicker" multiple>
                            <option>Platinum</option>
                            <option>Gold</option>
                            <option>Bronze</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="subject">Bank</label>
                        <select class="form-control" name="subject">
                            <option selected value="na">Choose One:</option>
                            <option value="inquiry">CAT 1</option>
                            <option value="suggestions">CAT 2</option>
                            <option value="other">Other</option>
                        </select>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label for="message">Description</label>
                        <textarea class="form-control" name="message" rows="11" placeholder="Enter Message"></textarea>
                    </div>
                    <div class="form-group">
                        <button class="btn btn-primary pull-right" type="submit">Create Promotion</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
    @endsection