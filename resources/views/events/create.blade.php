@extends('layouts.master')
@section('page-title', 'Create Event')

@section('page-vendor')
@endsection

@section('page-css')
@endsection

@section('custom-css')
@endsection

@section('breadcrumbs')
<div class="content-header-left col-md-9 col-12 mb-2">
    <div class="row breadcrumbs-top">
        <div class="col-11">
            <h2 class="content-header-title float-start mb-0">Events</h2>
            {{-- <div class="breadcrumb-wrapper">
                {{Breadcrumbs::render('user.create') }}
            </div> --}}
        </div>
    </div>
</div>
@endsection

@section('content')
<div class="content-body">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header border-bottom">
                    <h4 class="card-title">Event Details</h4>
                </div>
                <div class="card-body py-2 my-25">
                    @php
                    if( (isset($event) && isset($isClone) && $isClone === true) || !isset($event) ) {
                        $url = route('events.store');
                        $method = "POST";
                        $textSubmit = "Create";
                    } else {
                        $url = route('events.update', $event->id);
                        $method = "PUT";
                        $textSubmit = "Update";
                    }
                    @endphp
                    <form class="validate-form" method="post"
                        action="{{$url}}"
                        enctype="multipart/form-data">
                        @csrf
                        @isset($event)
                        @method($method)
                        @endisset

                        <div class="row">
                            @include('events.form-fields')
                            <div class="col-12">
                                <button type="submit" class="btn btn-primary mt-1 me-1">{{$textSubmit}}</button>
                                <a href="{{route('events.index')}}" class="btn btn-outline-secondary mt-1">Discard</a>
                            </div>
                        </div>
                    </form>
                    <!--/ form -->
                </div>
            </div>
        </div>
    </div>
    <script>
        $(document).ready(function(){

                getTowns();
                getTags();
            });
            function getTowns(){
                var county_id = $('#county_id').val();
                $.ajax({
                    url: "{{route('get.towns')}}",
                    type: "GET",
                    data: {county_id:county_id},
                    success: function(data){
                        $('#town_id').empty();
                        $('#town_id').append('<option value="">Select Town</option>');
                        $.each(data, function(key, value){
                            $('#town_id').append('<option value="'+value.id+'">'+value.name+'</option>');
                        });
                        let old_town_id = "{{old('town_id')}}"
                        if(old_town_id){
                            $('#town_id').val(old_town_id);

                        }else{
                        let selected_id = "{{$selected_town->id ?? ''}}";
                        if(selected_id != ''){
                            $('#town_id').val(selected_id);
                        }
                    }
                    }
                });

            }
            function getTags(){
                var category_id = $('#category_id').val();
                $.ajax({
                    url: "{{route('get.tags')}}",
                    type: "GET",
                    data: {category_id:category_id},
                    success: function(data){
                        $('#tags').empty();
                        let selected_tags = "{{old('tags') ? json_encode(old('tags'),true) : (isset($event) ? $event->tags->pluck('id')?? '' : '')}}";
                        $.each(data, function(key, value){
                            let exists = selected_tags.includes(value.id);
                            if(exists){
                                $('#tags').append('<option value="'+value.id+'" selected>'+value.name+'</option>');
                            }else
                            {
                            $('#tags').append('<option value="'+value.id+'">'+value.name+'</option>');
                            }
                        });

                    }
                });

            }
            function thumbnailPreview(event) {
                var output = document.getElementById('thumbnail_preview');
                output.src = URL.createObjectURL(event.target.files[0]);
                output.onload = function() {
                URL.revokeObjectURL(output.src) // free memory
                }
                
                let formData = new FormData();           
                formData.append("file", event.target.files[0]);
                $.ajax({
                    type: 'POST',
                    url: "{{ route('file.store') }}",
                    data: formData,
                    contentType: false,
                    processData: false,
                    success: (response) => {
                        if (response) {
                            $('input[name="thumbnail_name"]').val(response);
                        }
                    },
                    error: function(response) {
                        
                    }
               });
            };
            function imagePreview(event) {
                var output = document.getElementById('image_preview');
                output.src = URL.createObjectURL(event.target.files[0]);
                output.onload = function() {
                URL.revokeObjectURL(output.src) // free memory
                }
                
                let formData = new FormData();           
                formData.append("file", event.target.files[0]);
                $.ajax({
                    type: 'POST',
                    url: "{{ route('file.store') }}",
                    data: formData,
                    contentType: false,
                    processData: false,
                    success: (response) => {
                        if (response) {
                            $('input[name="image_name"]').val(response);
                        }
                    },
                    error: function(response) {
                        
                    }
               });
            };

    </script>
    <script src="https://maps.google.com/maps/api/js?sensor=false"></script>
    <script>
        //the maps api is setup above
window.onload = function() {


};
// function getLocation() {
//   if (navigator.geolocation) {
//     // navigator.geolocation.getCurrentPosition(showPosition);
//   } else {
//     alert("Geolocation is not supported by this browser.");
//   }
// }
function showPosition(position) {
  var lat = '43.969389460014646';
  var lng = '-74.41830602514258';
  let old = "{{old('coordinates') ? old('coordinates') : $event->coordinates ?? ''}}";
    if(old){
        old = old.split(',');
        lat = old[0];
        lng = old[1];
    }
  let fin = new google.maps.LatLng(lat, lng);

var map = new google.maps.Map(document.getElementById('map'), {

center: fin,

zoom: 5, //The zoom value for map

mapTypeId: google.maps.MapTypeId.ROADMAP

});

var marker = new google.maps.Marker({

position: fin,

map: map,

title: 'Place the marker for your location!', //The title on hover to display

draggable: true //this makes it drag and drop

});

google.maps.event.addListener(marker, 'dragend', function(a) {

console.log(a);

document.getElementById('loc').value = a.latLng.lat().toFixed(4) + ', ' + a.latLng.lng().toFixed(4); //Place the value in input box



});
}
    </script>
    <style>
        #map {
            height: 500px;
            width: 100%;
            border: 1px solid #000;
        }
    </style>
    @endsection
