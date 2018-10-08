@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h1 class="title">{{$property->name}}</h1>
        </div>
        <div class="col-md-6">
            <div class="owl-carousel owl-theme">
                @foreach($property->photos as $photo)
                <div class="item">
                    <a href="{{$photo->photo}}" data-fancybox="gallery">
                        <div class="embed-responsive embed-responsive-4by3">
                            <div class="embed-responsive-item card-property" style="background-image: url('{{$photo->photo}}')">
                            </div>
                        </div>
                    </a>
                </div>
                @endforeach
            </div>
        </div>
        <div class="col-md-6">
            <h2><span class="badge badge-danger">${{number_format($property->price, 2)}} {{$property->currency}}</span></h2>
            <p>{{$property->description}}</p>
        </div>
        <div class="col-md-4">
            <h3 class="title">Áreas</h3>
            <ul class="list-unstyled">
                @foreach($property->areas as $area)
                <li>{{$area->area}}</li>
                @endforeach
            </ul>
        </div>
        <div class="col-md-4">
            <h3 class="title">Equipo</h3>
            <ul class="list-unstyled">
                @foreach($property->equipments as $equipment)
                <li>{{$equipment->equipment}}</li>
                @endforeach
            </ul>
        </div>
        <div class="col-md-4">
            <h3 class="title">Detalles</h3>
            <ul class="list-group">
                @foreach($property->details as $detail)
                <li class="list-group-item d-flex justify-content-between align-items-center py-1 pl-3">
                    {{$detail->detail}}
                    <span class="badge badge-primary badge-pill">{{$detail->pivot->value}}</span>
                </li>
                @endforeach
            </ul>
        </div>
        <div class="col-md-12">
            <div class="embed-responsive embed-responsive-16by9">
                <div class="embed-responsive-item card-property" id="map">
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('js')
<script>
    var map
    var propertyLocation = new google.maps.LatLng("{{$property->lat}}", "{{$property->lng}}")
    $('.owl-carousel').owlCarousel({
        responsive: {
            0: {
                items: 1
            }
        }
    })
    initMap()
    function initMap() {
        map = new google.maps.Map(document.getElementById('map'), {
            center: propertyLocation,
            zoom: 16,
            minZoom: 2
        });

        new google.maps.Marker({
            position: propertyLocation,
            map: map,
            title: "{{$property->name}}"
        })
    }
</script>
@endsection