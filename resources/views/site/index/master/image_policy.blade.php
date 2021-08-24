<div class="margin-top-10">
    <div class="container">
        <div class="row">
            @foreach ($image_policy as $item)
                <div class="col-sm-12 col-md-4">
                    <div class="element-icon style2">
                        <div class="icon">{!! $item->icon !!}</div>
                        <div class="content">
                            <h4 class="title">{{ $item->content }}</h4>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>
