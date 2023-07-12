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
            width: 70%;
            /*height: 300px;*/
            /*object-fit:cover;*/
        }

        @media (max-width: 575px) {
            .eight h1 {
                display: inherit;
            }
        }
    </style>

    <div class="container-fluid">
        <div class="eight mt-5 mb-5">
            <h1 class="text-center">{{ $event->title }}</h1>
        </div>

        <div class="">
            <p class="lead text-center">{{ $event->short_description }}</p>
        </div>

        <div class="container mt-5 mb-5">
            <div class="row">
                <div class="col-lg-8 col-md-12 mb-4">
                    <div class="shadow p-3 bg-body rounded">
                        <div class="mb-4 text-center"><img class="img-fluid" src="{{ asset($event->image) }}"></div>

                        <p>{{ $event->long_description }}</p>
                    </div>
                </div>

                <div class="col-lg-4 col-md-12">
                    <div class="shadow p-3 bg-body rounded">
                        <p><strong>Category:</strong> {{ $event->category->name }}</p>
                        <p><strong>Tags:</strong>
                            @foreach ($event->tags as $tag)
                                <a>{{ $tag->name }}</a>,
                            @endforeach
                        </p>

                        <hr>

                        <div>
                            <strong>Date and Time</strong>
                            <p style="margin-bottom: 0;">
                                <span class="badge bg-warning text-dark"><i class="far fa-calendar fa-xl"></i></span>
                                @if ($event->end_date == $event->start_date)
                                    {{ date('M d, Y', strtotime($event->start_date)) }} {{ $event->start_time }} -
                                    {{ $event->end_time }}
                                @else
                                    {{ date('M d, Y', strtotime($event->start_date)) }} {{ $event->start_time }}
                                    until<br>{{ date('M d, Y', strtotime($event->end_date)) }} {{ $event->end_time }}
                                @endif
                            </p>
                            <div class="mb-2">
                                <add-to-calendar-button name="Title" options="'Google'"
                                    location="{{ $event->address }}, {{ $event->county->name }}, {{ $event->town->name }}"
                                    startDate="{{ $event->start_date }}" endDate="{{ $event->end_date }}"
                                    startTime="{{ $event->start_time }}" endTime="{{ $event->end_time }}"
                                    timeZone="America/New_York" trigger="click" hideBackground></add-to-calendar-button>
                            </div>
                        </div>

                        <div class="mb-2">
                            <strong>Address</strong>
                            <a href="{{ 'http://maps.google.com?q=' . $event->coordinates }}" target="_blank">
                                <span class="badge bg-warning text-dark"><i class="fas fa-map-marker-alt fa-xl"></i></span>
                                {{ $event->address }}, {{ $event->county->name }}, {{ $event->town->name }}
                                <br>
                                {{ $event->coordinates ?? '' }}
                            </a>
                        </div>

                        <div>
                            <strong>Organization</strong>
                            @if ($event->vendor->url)
                                @php
                                    if (strpos($event->vendor->url, 'http') === false) {
                                        $organizationUrl = 'http://' . $event->vendor->url;
                                    } else {
                                        $organizationUrl = $event->vendor->url;
                                    }
                                @endphp
                                <p>
                                    <span class="badge bg-warning text-dark"><i
                                            class="fa-solid fa-sitemap fa-xl"></i></span>
                                    <a href="{{ $organizationUrl }}"
                                        target="_blank">{{ $event->vendor->organization }}</a>
                                </p>
                            @else
                                <p>
                                    <span class="badge bg-warning text-dark"><i
                                            class="fa-solid fa-sitemap fa-xl"></i></span>
                                    {{ $event->vendor->organization }}
                                </p>
                            @endif
                            <p>
                                <span class="badge bg-warning text-dark"><i class="fas fa-phone-alt fa-xl"></i></span>
                                <a href="tel:{{ $event->vendor->phone }}">{{ $event->vendor->phone }}</a>
                            </p>
                            <p>
                                <span class="badge bg-warning text-dark"><i class="far fa-envelope fa-xl"></i></span>
                                <a href="mailto:{{ $event->vendor->email }}">{{ $event->vendor->email }}</a>
                            </p>
                        </div>

                        <div>
                            <strong>Cost</strong>
                            <p>
                                <span class="badge bg-warning text-dark"><i class="fas fa-dollar-sign fa-xl"></i></span>
                                {{ $event->is_free ? 'Free' : 'Paid' }}
                            </p>
                        </div>

                        @if ($event->event_url)
                            @php
                                if (strpos($event->event_url, 'http') === false) {
                                    $url = 'http://' . $event->event_url;
                                } else {
                                    $url = $event->event_url;
                                }
                            @endphp
                            <div>
                                <strong>Event Url</strong>
                                <p>
                                    <span class="badge bg-warning text-dark"><i class="fas fa-link fa-xl"></i></span>
                                    <a href="{{ $url }}" target="_blank">{{ $event->event_url }}</a>
                                </p>
                            </div>
                        @endif

                        <hr>

                        <a class="btn btn-primary"
                            href="http://www.facebook.com/sharer.php?u={{ urlencode(url()->full()) }}" target="_blank"
                            role="button"><i class="fab fa-facebook-square"></i></a>
                        <a class="btn btn-info"
                            href="http://twitter.com/share?url={{ urlencode(url()->full()) }}&text={{ urlencode($event->title) }}&hashtags=adktoday"
                            target="_blank" role="button"><i class="fab fa-twitter-square"></i></a>
                        <a class="btn btn-danger pin-it-button"
                            href="http://pinterest.com/pin/create/button/?url={{ urlencode(url()->full()) }}&media={{ urlencode(asset($event->image)) }}&description={{ urlencode($event->title) }}"
                            target="_blank" role="button">
                            <i class="fab fa-pinterest-square"></i>
                        </a>
                        <a class="btn btn-secondary pin-it-button" href="{{ url('/') }}" target="_blank"
                            role="button">
                            <i class="fas fa-home"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/add-to-calendar-button" async defer></script>
@endsection
