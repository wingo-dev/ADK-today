@extends('layouts.front_end.master')
@section('content')
<style>
    .eight h1 {
        text-align: center;

        text-transform: uppercase;
        letter-spacing: 1px;

        display: grid;
        grid-template-columns: 1fr auto 1fr;
        grid-template-rows: 16px 0;
        grid-gap: 22px;
    }

    .eight h1:after,
    .eight h1:before {
        content: " ";
        display: block;
        border-bottom: 2px solid #ccc;
        background-color: #f8f8f8;
    }

    .PillList-item {
        cursor: pointer;
        display: inline-block;
        float: left;
        font-size: 14px;
        font-weight: normal;
        line-height: 20px;
        margin: 0 12px 12px 0;
        text-transform: capitalize;
    }

    .PillList-item input[type="checkbox"] {
        display: none;
    }

    .PillList-item input[type="checkbox"]:checked+.PillList-label {
        background-color: #1da1f2;
        border: 1px solid #1da1f2;
        color: #fff;
        padding-right: 16px;
        padding-left: 16px;
    }

    .PillList-label {
        border: 1px solid #1da1f2;
        border-radius: 20px;
        color: #1c94e0;
        display: block;
        padding: 7px 28px;
        text-decoration: none;
    }

    .PillList-item input[type="checkbox"]:checked+.PillList-label .Icon--checkLight {
        display: inline-block;
    }

    .PillList-item input[type="checkbox"]:checked+.PillList-label .Icon--addLight,
    .PillList-label .Icon--checkLight,
    .PillList-children {
        display: none;
    }

    .PillList-label .Icon {
        width: 12px;
        height: 12px;
        margin: 0 0 0 12px;
    }

    .Icon--smallest {
        font-size: 12px;
        line-height: 12px;
    }

    .Icon {
        background: transparent;
        display: inline-block;
        font-style: normal;
        vertical-align: baseline;
        position: relative;
    }

    .ahref {
        background: none !important;
        border: none;
        padding: 0 !important;
        font-family: arial, sans-serif;
        color: #ffc800;
        text-decoration: underline;
        cursor: pointer;
    }

    .ahref:hover {
        color: #cca000;
    }

    .img-fluid {
        width: 100%;
        height: 300px;
        object-fit:cover;
    }
</style>

<div class="container-fluid">
    <div class="eight">

        <h1 class="text-center" style="margin: 39px">Event Details</h1>
    </div>
    {{-- cards start --}}
    <div class="container-fluid mt-5 mb-5">
        <div class="d-flex row">
            <div class="col-md-12">

                {{-- Single Card --}}
                @foreach ($events as $event )

                <div class="row p-2 bg-white border rounded mt-2">
                    <div class="col-md-3 mt-1"><img class="img-fluid img-responsive rounded product-image"
                            src="{{asset($event->thumbnail)}}"></div>
                    <div class="col-md-9 mt-1">
                        <h5 class="card-title">{{$event->title}}</h5>
                        <h6 class="card-subtitle mb-2 text-muted">UNTIL {{$event->end_date}} {{$event->end_time?? '-'}}
                        </h6>

                        <p class="text-justify  para mb-0">{{$event->short_description?? '-'}}<br></p>
                        <div class="mt-1 mb-1 spec-1"><small class="text-muted">County: {{$event->county->name??
                                '-'}}</small></div>
                        <div class="mt-1 mb-1 spec-1"><small class="text-muted">Town: {{$event->town->name??
                                '-'}}</small></div>

                        <div class="mt-1 mb-1 spec-1"><small class="text-muted">URL: {{$event->url?? '-'}}</small></div>
                        <p class="card-text"><small class="text-muted">@ {{$event->address?? '-'}}</small></p>


                    </div>

                </div>
                @endforeach
                {{-- Single Card End --}}

            </div>


        </div>
    </div>
    @endsection
