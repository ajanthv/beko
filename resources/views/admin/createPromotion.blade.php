@extends('layouts.app')
@section('custom_css')
    {{--<link href="css/custom.css" rel="stylesheet">--}}
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
        <form class="col-md-12 well" role="form" method="POST" action="{{ urlWithoutSchema('/admin/promotion') }}">
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="name">Title</label>
                        <input type="text" class="form-control" name="title" placeholder="Enter Title">
                    </div>
                    <div class="form-group">
                        <label name="file" for="banner">Banner Image</label>
                        <input type="file">
                    </div>
                    <div class="form-group">
                        <label for="subject">Bank</label>
                        <select id="bankSelector" class="form-control" name="bank">
                            @if(!empty($banks))
                                @foreach($banks as $key=>$bank)
                                    <option value={{$key}}>{{$bank}}</option>
                                @endforeach
                            @endif
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="phone">Choose Card</label>
                        <div class="clearfix"></div>
                        <div id="cardSelectorDiv">
                            <select name="cards[]" id="cardSelector" class="" multiple>
                                <option value="0">Please select the bank</option>
                            </select>
                        </div>

                    </div>

                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label for="message">Description</label>
                        <textarea class="form-control" name="description" rows="11" placeholder="Enter Message"></textarea>
                    </div>
                    <div class="form-group">
                        <button class="btn btn-primary pull-right" type="submit">Create Promotion</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
    @endsection