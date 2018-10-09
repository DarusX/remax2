@extends('layouts.app')
@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12 px-0">
            @component('components.carousel')
            @endcomponent
        </div>
        <div class="col-md-6 px-0">
            <div class="carousel slide carousel-fade" data-ride="carousel" id="best-carousel">
                <div class="carousel-inner">
                    @foreach($properties as $property)
                    <div class="carousel-item {{($loop->first)?'active':''}} card-property" style="height: 300px; background-image: url('{{$property->photos->first()->photo}}')">
                        <h3 class="card-title text-white px-4 pt-4">{{$property->name}}</h3>
                        <h4 class="px-4 pt-2"><span class="badge badge-primary ">{{$property->type}}</span></h4>
                    </div>
                    @endforeach
                </div>
                <a class="carousel-control-prev" href="#best-carousel" role="button" data-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="sr-only">Previous</span>
                </a>
                <a class="carousel-control-next" href="#best-carousel" role="button" data-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="sr-only">Next</span>
                </a>
            </div>
        </div>
        <div class="col-md-6 px-0">
            <div class="carousel slide carousel-fade" data-ride="carousel" id="posts-carousel">
                <ol class="carousel-indicators">
                    @for($i = 0; $i < 10; $i++)
                    <li data-target="#posts-carousel" data-slide-to="{{$i}}" class="{{($i==0)?'active':''}}"></li>
                    @endfor
                </ol>
                <div class="carousel-inner">
                    @foreach($properties as $property)
                    <div class="carousel-item {{($loop->first)?'active':''}} card-property bg-dark-blue">
                        <h3 class="card-title text-white px-4 pt-4">{{$property->name}}</h3>
                        <h4 class="px-4 pt-2"><span class="badge badge-primary ">{{$property->type}}</span></h4>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('js')
<script>
    propertySize()
    $(window).resize(function (event) {
        propertySize()
    })
    function propertySize() {
        $("#best-carousel .carousel-item").css("height", ($("#best-carousel .carousel-item").width() * 0.4))
        $("#posts-carousel .carousel-item").css("height", ($("#posts-carousel .carousel-item").width() * 0.4))
    }
</script>
@endsection