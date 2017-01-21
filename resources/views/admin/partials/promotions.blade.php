
<div class="row grid">
@if(!empty($proms))
    @foreach($proms as $promotion)

        <!-- block -->
            <div class="col-sm-6 col-md-4 grid-item">
                <div class="thumbnail">
                    <img src="{{asset('/uploads/promotions/'.$promotion['image'])}}" alt="{{$promotion['image']}}">
                    <div class="caption">
                        <h3>{{$promotion['title']}}</h3>

                        <div class="beko-tags">
                            @if(!empty($promotion['cards']))
                                @foreach($promotion['cards'] as $card)
                                    <span class="label {{$card->color}}">{{$card->name}}</span>
                                @endforeach
                            @endif
                        </div>
                        <p class="card-description">{{$promotion['description']}}</p>
                        <p class="fav-btn-cont"><a href="#" class="btn btn-primary" role="button"><span class="glyphicon glyphicon-heart" aria-hidden="true"></span></a></p>
                    </div>
                </div>
            </div>
            <!-- block end-->
        @endforeach
    @else
        <div class="alert alert-danger alert-dismissible fade in" role="alert">
            <h4>There are no promotions available.</h4>
        </div>
    @endif

    <script type="text/javascript">
        $('.grid').masonry({
            // set itemSelector so .grid-sizer is not used in layout
            itemSelector: '.grid-item'

        });
    </script>
</div>
