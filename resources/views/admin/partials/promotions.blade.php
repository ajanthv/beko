
@if(!empty($promotions))
    @foreach($promotions as $promotion)
        <!-- block -->
        <div class="col-sm-6 col-md-4 grid-item">
            <div class="thumbnail">
                <img src="{{storage_path().'uploads/promotions/'.$promotion['image']}}" alt="Bootstrap Thumbnail: Beautiful Bootstrap Thumbnail like Material Design Cards">
                <div class="caption">
                    <h3>{{$promotion['title']}}</h3>
                    <div class="beko-tags">
                        <span class="label label-warning">Gold</span>
                        <span class="label label-primary">Bronze</span>
                    </div>
                    <p class="card-description">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam</p>
                    <p class="fav-btn-cont"><a href="#" class="btn btn-primary" role="button"><span class="glyphicon glyphicon-heart" aria-hidden="true"></span></a></p>
                </div>
            </div>
        </div>
        <!-- block end-->
    @endforeach
@endif