@extends('layouts.master')
@section('page-title', 'Show Event')


@section('content')
<style>
    #map_show {
        height: 500px;
        width: 100%;
        border: 1px solid #000;
    }
</style>
<div class="content-body">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header border-bottom">
                    <h4 class="card-title">Event Details</h4>
                </div>
                <div class="card-body py-2 my-25">

                        <div class="row">
                            @include('events.show-fields')
                            <div class="col-12">
                                <a href="{{route('events.index')}}" class="btn btn-outline-secondary mt-1">Discard</a>
                            </div>
                        </div>
                    <!--/ form -->
                </div>
            </div>
        </div>
    </div>
</div>
<script src="https://maps.google.com/maps/api/js?sensor=false"></script>

<script>

    $(document).ready(function(){
        console.log('mingora');
        var lat = '43.969389460014646';
  var lng = '-74.41830602514258';
  let old = "{{$event->coordinates ?? ''}}";
    if(old){
        old = old.split(',');
        lat = old[0];
        lng = old[1];
    }
var latlng = new google.maps.LatLng(lat,lng); //Set the default location of map
console.log('mingora end');

var map = new google.maps.Map(document.getElementById('map_show'), {

    center: latlng,

    zoom: 11, //The zoom value for map

    mapTypeId: google.maps.MapTypeId.ROADMAP

});
var marker = new google.maps.Marker({

    position: latlng,

    map: map,

    title: 'Place the marker for your location!', //The title on hover to display

    draggable: false //this makes it drag and drop

});

google.maps.event.addListener(marker, 'dragend', function(a) {

    document.getElementById('loc').value = a.latLng.lat().toFixed(4) + ', ' + a.latLng.lng().toFixed(4); //Place the value in input box



});

});
</script>

@endsection
@section('page-js')

@endsection
