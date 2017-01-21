
<select id="cardSelector" name="cards[]" class="" multiple>>
    @if(!empty($cards))
        @foreach($cards as $key=>$card)
            <option value="{{$key}}">{{$card}}</option>
        @endforeach

    @endif
</select>