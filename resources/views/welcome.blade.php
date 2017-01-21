@extends('layouts.app')
@section('custom_css')
    {{--<link href="css/custom.css" rel="stylesheet">--}}
@endsection

@section('content')
    <div class="fullscreen_bg front-end-guest">
        <!-- nav -->
        <nav class="navbar navbar-default">
            <div class="container-fluid">
                <!-- Brand and toggle get grouped for better mobile display -->
                <div class="navbar-header">
                    <a class="navbar-brand" href="#">BEKO <span>PROMOTIONS</span></a>
                </div>


            </div><!-- /.container-fluid -->
        </nav>
        <!-- nav end -->

        <div class="container-fluid cards-row">
            <div class="container">
                <h2 class="main-title">New Promotions</h2>
                <div class="filter-btns">
                        <select id="bank_promotion_selector" class="form-control">
                            @if(!empty($banks))
                                @foreach($banks as $bank)
                                    <option value="{{$bank->id}}">{{$bank->name}}</option>
                                @endforeach
                            @endif
                        </select>
                </div>
                <div id="promotions_list">

                </div>
            </div>
        </div>
    </div>
@endsection

@section('custom_js')
    <script src="https://unpkg.com/masonry-layout@4/dist/masonry.pkgd.js"></script>

    <script type="text/javascript">
        $('.grid').masonry({
            // set itemSelector so .grid-sizer is not used in layout
            itemSelector: '.grid-item'

        });
    </script>

    <script src="{{urlWithoutSchema('/js/promotions.js')}}"></script>
@endsection