<div class="section-brand-slide margin-bottom-60">
    <div class="brands-slide owl-carousel nav-center-center nav-style7" data-nav="true" data-dots="false" data-loop="true" data-margin="65" data-responsive='{"0":{"items":1},"600":{"items":3},"1000":{"items":6}}'>
        @foreach ($trademaks as $item)
        <img src="../trademark/{{ $item->image }}" alt="{{ $item->name }}">
        @endforeach
    </div>
</div>
