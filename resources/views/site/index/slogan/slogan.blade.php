@if (isset($setting))
<div class="container">
    <span class="line margin-top-80"></span>
    <div class="margin-top-70">
        <div class="row">
            <div class="col-sm-4" style="text-align: right;">
                <img style="margin-right: 20px;" class=" margin-top-25" src="../slogan/{{$setting->logo}}" width="200" height="70">
            </div>
            <div class="col-sm-7">
                <blockquote>{{ substr($setting->slogan, 0, 50)  }}...</blockquote>
            </div>
        </div>
    </div>
</div>
@endif
