@extends('layouts.app')
@section('content')
<div class="container-fluid">
    <div class="row">
        @foreach($properties as $property)
        <div class="col-md-3 py-2">
            <div class="card">
                <div class="card-body card-property" style="background-image: url('{{$property->photos->first()->photo}}')">
                    <h5 class="card-title text-white ">{{$property->name}}</h5>
                </div>
                <div class="card-footer d-flex justify-content-between text-right">
                    <a href="{{route('propiedad', $property)}}" class="btn btn-primary btn-sm">Ver más</a>
                    <strong>{{number_format($property->price, 2)}} {{$property->currency}}</strong>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection
@section('js')
<script>
    propertySize()
    $(window).resize(function(event){
        propertySize()
    })
   function propertySize(){
        var maxWith = 0
        $(".card").each(function(i, el){
            if($(el).width() > maxWith) maxWith = $(el).width()
        })
        $(".card").css("height", maxWith)
   }
</script>
@endsection