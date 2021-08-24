@if (isset($array1))
<div class="row margin-0">
    <div class="col-sm-6 padding-0">
        @foreach ($array1 as $item)
            <a class="banner-border" href="{{route('shop',['danhmuc'=>$item->slug])}}"><img src="../category/{{ $item->image }}" alt="" width="960" height="320"></a>
        @endforeach
    </div>
    <div class="col-sm-6 padding-0">
        @foreach ($array2 as $item)
            <a class="banner-border" href="{{route('shop',['danhmuc'=>$item->slug])}}"><img src="../category/{{ $item->image }}" alt="" width="960" height="640">
            </a>
        @endforeach
    </div>
</div>
@endif

