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
            color: blue;
            text-decoration: underline;
            cursor: pointer;
        }

        .ahref:hover {
            color: black;
        }

        .img-fluid {
            width: 100%;
            /*height: 300px;*/
            /*object-fit: cover;*/
        }

        #banner {
            background: url({{ asset('img/banner/' . $banner) }});
            background-position: center;
            background-size: cover;
            height: 300px;
            width: 100%;
        }

        @media (max-width:575px) {
            #banner {
                height: 200px;
            }

            .button1 {
                display: none;
            }
        }

        @media (min-width:576px) {
            .button2 {
                display: none;
            }
        }

        @media (max-width:575px) {
            .town {
                margin-top: 14px;
            }
        }
    </style>

    <div id="banner"></div>

    <div class="container">
        <div class="eight">

            <h1 class="text-center" style="margin: 39px">Adirondack Events</h1>
        </div>
        <h4 class="text-center" style="margin-bottom: 50px">All the Events happening throughout the park today, tomorrow,
            and in the Future.</h4>
        <form id="filter-form" action="{{ route('home') }}" method="get">
            <div class="row">
                <div class="col-md-4 mb-3">
                    <label for="category_id" class="form-label">Choose Events</label>
                    <select class="form-select" aria-label="category" name="category_id" id="category_id"
                        onchange="submitFilters()">
                        <option value="">All Events</option>
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}"
                                {{ $category->id == request()->category_id ? 'Selected' : '' }}>
                                {{ $category->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="col-md-3 col-sm-5 mb-3">
                    <label for="startDate" class="form-label">Start Date:</label>
                    <input type="date" class="form-control" id="startDate" name="start_date"
                        value="{{ request()->start_date }}">
                </div>
                <div class="col-md-3 col-sm-5 mb-3">
                    <label for="endDate" class="form-label">End Date:</label>
                    <input type="date" class="form-control" id="endDate" name="end_date"
                        value="{{ request()->end_date }}">
                </div>
                {{-- mobile view filters --}}


                {{-- mobile view filters ended --}}
                <div class="col-md-2 col-sm-2 text-center mt-auto mb-3 button1">
                    <button type="submit" class="btn btn-primary mt-4 ">Submit</button>
                    <br>
                </div>

            </div>

            <div class="" id="advanced-search-container" style="display:none">
                <div class="row mb-3">
                    <div class="col-sm-4">
                        <label style="margin-left: 3px;margin-bottom: 5px">County:</label>
                        <select class="form-select" aria-label="county" name="county_id" id="county_id"
                            onchange="submitFilters()">
                            <option value="">Any</option>
                            @foreach ($counties as $county)
                                <option value="{{ $county->id }}"
                                    {{ request()->county_id == $county->id ? 'Selected' : '' }}>
                                    {{ $county->name }}</option>
                            @endforeach

                        </select>
                    </div>

                    <div class="col-sm-3 town">
                        <label style="margin-left: 3px;margin-bottom: 5px">Town:</label>
                        <select class="form-select" aria-label="Town" name="town_id" id="town_id"
                            onchange="submitFilters()">
                            <option value="">Any</option>
                            @foreach ($towns as $town)
                                <option value="{{ $town->id }}"
                                    {{ request()->town_id == $town->id ? 'Selected' : '' }}>
                                    {{ $town->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-sm-3 town">
                        <label style="margin-left: 3px;margin-bottom: 5px">Cost:</label>
                        <select class="form-select" aria-label="Cost" name="is_free" id="is_free"
                            onchange="submitFilters()">
                            <option value="">Any</option>
                            <option value="1">Free</option>
                        </select>
                    </div>
                    {{-- <div class="col-sm-3">
                    <select class="form-select" aria-label="category" name="category_id" id="category_id"
                        onchange="getTags()">
                        <option value="">Select Catogory</option>
                        @foreach ($categories as $category)
                        <option value="{{$category->id}}" {{$category->id == request()->category_id ? "Selected" :
                            ""}}>{{$category->name}}</option>
                        @endforeach
                    </select>
                </div> --}}
                </div>
            </div>

            <div class="row">
                <div class="col-md-10 col-sm-8 mt-1 event">
                    <div class="d-md-flex">
                        <button type="button" class="me-2 ahref" onclick="changeDate('today',true)">Today</button>
                        <button type="button" class="me-2 ahref" onclick="changeDate('tomorrow',true)">Tomorrow</button>
                        <button type="button" class="me-2 ahref" onclick="changeDate('week',true)">This Week</button>
                        <button type="button" class="me-2 ahref" onclick="changeDate('next_week',true)">Next Week</button>
                        <button type="button" class="me-2 ahref" id="advanced-search-btn">More Filters</button>
                    </div>

                </div>
                <div class="col-md-2 col-sm-4 text-center mt-auto mb-3 button1">
                    @auth
                        @if (auth()->user()->role == \App\Utils\Common\UserRoles::VENDOR)
                            <button type="button" class="btn btn-secondary"
                                onclick="location.href='{{ route('events.create') }}'">Submit an Event</button>
                        @endif
                    @endauth
                </div>
            </div>



            {{-- check menu --}}
            @if (isset($tags) && count($tags))
                <div class="row mt-5" id="pillboxparent">
                    <div class="col-md-12" id="pillbox">
                        @foreach ($tags as $tag)
                            <label class="PillList-item">
                                <input type="checkbox" name="tags[]" value="{{ $tag->id }}"
                                    {{ request()->has('tags') && in_array($tag->id, request()->tags) ? 'Checked' : '' }}
                                    onclick="submitFilters()">
                                <span class="PillList-label">{{ $tag->name }}
                                    <span class="Icon Icon--checkLight Icon--smallest"><i class="fa fa-check"></i></span>
                                </span>
                            </label>
                        @endforeach
                    </div>
                </div>
            @endif

            {{-- check menu 2 --}}

            {{-- after mobile view --}}
            <div class="col-md-2 text-center mt-auto mb-3 button2">
                <button type="submit" class="btn btn-primary mt-4">Submit</button>
                <br>
            </div>

            <div class="col-md-2 text-center mt-auto mb-3 button2">
                @auth
                    @if (auth()->user()->role == \App\Utils\Common\UserRoles::VENDOR)
                        <button type="button" class="btn btn-secondary"
                            onclick="location.href='{{ route('events.create') }}'">Submit an Event</button>
                    @endif
                @endauth
            </div>
            {{-- after mobile view ends --}}
        </form>
        {{-- cards start --}}
        <div class="container-fluid mt-5 mb-5">
            @if (isset($events) && count($events))
                <div class="d-flex row">

                    {{-- Single Card --}}
                    @foreach ($events as $event)
                        {{-- <div class="col-lg-4 col-md-6">
                            <div class="bg-white border rounded mb-4"
                                style="box-shadow: rgba(100, 100, 111, 0.2) 0px 7px 29px 0px;">
                                <div class=""><img class="img-fluid img-responsive rounded product-image"
                                        src="{{ asset($event->thumbnail) }}"></div>
                                <div class="p-3">
                                    <h6 class="card-subtitle mb-2 text-muted">UNTIL {{ $event->end_date }}
                                        {{ $event->end_time ?? '-' }}</h6>
                                    <h6 class="card-subtitle mb-2 text-muted">
                                        {{ $event->category ? $event->category->name : '-' }}</h6>
                                    <p class="h3 card-title my-3"><a href="#" class="text-primary"
                                            style="text-decoration: none" data-bs-toggle="modal"
                                            data-bs-target="#modal-{{ $event->id }}">{{ $event->title }}</a></p>
                                    <p class="mb-0"><strong>{{ $event->vendor->organization }}</strong></p>
                                    <p class="text-justify para mb-0">
                                        {{ Str::limit($event->short_description, 80) ?? '-' }}<br></p>
                                    <p class="card-text">
                                        <small class="text-muted">
                                            @foreach ($event->tags as $tag)
                                                {{ $tag->name }},
                                            @endforeach
                                        </small>
                                    </p>
                                    <p class="card-text"><small class="text-muted">@ {{ $event->address }},
                                            {{ $event->county->name }}, {{ $event->town->name }} </small></p>
                                    <a class="btn btn-primary btn-sm"
                                        href="{{ route('event-detail', ['id' => $event->id]) }}"
                                        role="button">Detail</a>
                                </div>
                            </div>
                        </div> --}}

                        <div class="col-lg-4 col-md-6 mb-4">
                            <div class="card shadow-sm h-100">
                                <img class="card-img-top" src="{{ asset($event->thumbnail) }}" alt="Card image cap">
                                <div class="card-body">
                                    <h6 class="card-subtitle mb-2 text-muted">UNTIL {{ $event->end_date }}
                                        {{ $event->end_time ?? '-' }}</h6>
                                    <h6 class="card-subtitle mb-2 text-muted">
                                        {{ $event->category ? $event->category->name : '-' }}</h6>
                                    <p class="h3 card-title my-3">
                                        <a href="{{ route('event-detail', ['id' => $event->id]) }}" class="text-primary"
                                            style="text-decoration: none">{{ $event->title }}
                                        </a>
                                        {{-- data-bs-toggle="modal"
                                            data-bs-target="#modal-{{ $event->id }}" --}}
                                    </p>
                                    <p class="mb-0"><strong>{{ $event->vendor->organization }}</strong></p>
                                    <p class="text-justify para mb-0">
                                        {{ Str::limit($event->short_description, 80) ?? '-' }}<br></p>
                                    <p class="card-text">
                                        <small class="text-muted">
                                            @foreach ($event->tags as $tag)
                                                {{ $tag->name }},
                                            @endforeach
                                        </small>
                                    </p>
                                </div>
                                <div class="card-footer bg-white border-0">
                                    <p class="card-text"><small class="text-muted">@ {{ $event->address }},
                                            {{ $event->county->name }}, {{ $event->town->name }} </small></p>
                                    <a class="btn btn-primary btn-sm"
                                        href="{{ route('event-detail', ['id' => $event->id]) }}"
                                        role="button">Detail</a>
                                </div>
                            </div>
                        </div>

                        {{-- Start modal --}}
                        {{-- <div class="modal fade" id="modal-{{ $event->id }}" tabindex="-1"
                            aria-labelledby="modal-{{ $event->id }}Label" aria-hidden="true">
                            <div class="modal-dialog modal-xl modal-dialog-centered modal-lg">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="modal-{{ $event->id }}Label">{{ $event->title }}
                                        </h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="row">
                                            <div class="col-md-5">
                                                <img src="{{ asset($event->image) }}" alt="{{ $event->name }}"
                                                    class="img-fluid mb-3">
                                                <p><strong>Time:</strong> Until {{ $event->end_date }}
                                                    {{ $event->end_time ?? '-' }}
                                                </p>
                                                <p><strong>Cost: </strong>{{ $event->is_free ? 'Free' : $event->cost }}</p>
                                                <p><strong>Coordinates:
                                                    </strong>{{ $event->coordinates ?? 'Not Specified' }}</p>

                                            </div>
                                            <div class="col-md-7">
                                                <p><strong>Tags:</strong>
                                                    @foreach ($event->tags as $tag)
                                                        <a>{{ $tag->name }}</a>,
                                                    @endforeach
                                                </p>
                                                <p><strong>Category:</strong> {{ $event->category->name }}</p>
                                                <p><strong>Address:</strong> {{ $event->address }},
                                                    {{ $event->county->name }},
                                                    {{ $event->town->name }}</p>
                                                <hr>
                                                <p class="mb-0"><strong>Long Description:</strong></p>
                                                <p>{{ $event->long_description }}</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary"
                                            data-bs-dismiss="modal">Close</button>
                                        <a class="btn btn-primary"
                                            href="{{ route('event-detail', ['id' => $event->id]) }}"
                                            role="button">Detail</a>
                                    </div>
                                </div>
                            </div>
                        </div> --}}

                        {{-- end Modal --}}
                    @endforeach
                    {{-- Single Card End --}}


                </div>
                <div class="mt-2">
                    {!! $events->links() !!}
                </div>
            @else
                <h6 class="text-center text-muted">There are no events during this time!</h6>
            @endif
        </div>
        {{-- card ends --}}


        <script>
            const advancedSearchBtn = document.getElementById('advanced-search-btn');
            const advancedSearchContainer = document.getElementById('advanced-search-container');

            advancedSearchBtn.addEventListener('click', () => {
                if (advancedSearchContainer.style.display === 'none') {
                    advancedSearchContainer.style.display = 'block';
                    $("#pillboxparent").show();

                } else {
                    advancedSearchContainer.style.display = 'none';
                    $("#pillboxparent").hide();
                }
            });


            function getTags() {
                var category_id = $('#category_id').val();
                $.ajax({
                    url: "{{ route('get.tags') }}",
                    type: "GET",
                    data: {
                        category_id: category_id
                    },
                    success: function(data) {
                        $('#pillbox').empty();
                        let selected_tags = "{{ json_encode(request()->tags, true) }}";
                        $.each(data, function(key, value) {
                            let exists = selected_tags.includes(value.id);

                            if (exists) {
                                $('#pillbox').append(
                                    `  <label class="PillList-item">
                    <input type="checkbox" name="tags[]" checked value="${value.id}">
                    <span class="PillList-label">${value.name}
                        <span class="Icon Icon--checkLight Icon--smallest"><i class="fa fa-check"></i></span>

                    </span>
                </label>`
                                );
                            } else {
                                $('#pillbox').append(
                                    `  <label class="PillList-item">
                    <input type="checkbox" name="tags[]" value="${value.id}">
                    <span class="PillList-label">${value.name}
                        <span class="Icon Icon--checkLight Icon--smallest"><i class="fa fa-check"></i></span>

                    </span>
                </label>`
                                );
                            }
                        });
                    }
                });

            }
        </script>
        <script>
            $(document).ready(function() {
                let old_start = "{{ request()->start_date }}"
                let old_end = "{{ request()->end_date }}"
                if (!old_start && !old_end) {
                    changeDate('today');
                }
                // getTags();
                // getTowns();
                let county = $("#county_id").val();
                let town = $("#town_id").val();
                let category = $("#category_id").val();
                if (county || town) {
                    $('#advanced-search-container').show();
                }
            });

            function getTowns() {
                var county_id = $('#county_id').val();
                $.ajax({
                    url: "{{ route('get.towns') }}",
                    type: "GET",
                    data: {
                        county_id: county_id
                    },
                    success: function(data) {
                        $('#town_id').empty();
                        $('#town_id').append('<option value="">Select Town</option>');
                        $.each(data, function(key, value) {
                            $('#town_id').append('<option value="' + value.id + '">' + value.name +
                                '</option>');
                        });
                        let old_town_id = "{{ old('town_id') }}"
                        if (old_town_id) {
                            $('#town_id').val(old_town_id);

                        } else {
                            let selected_id = "{{ request()->town_id ?? '' }}";
                            if (selected_id != '') {
                                $('#town_id').val(selected_id);
                            }
                        }
                    }
                });

            }
        </script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.19.0/moment.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/moment-timezone/0.5.13/moment-timezone-with-data.js"></script>
        <script>
            // dates script
            function changeDate(val, is_change) {
                var current_date = moment.now();
                if (val == 'today') {
                    $('#startDate').val(moment(current_date).format('YYYY-MM-DD'));
                    $('#endDate').val(moment(current_date).format('YYYY-MM-DD'));
                } else if (val == 'tomorrow') {
                    var tomorrow = moment(current_date).add(1, 'days').format('YYYY-MM-DD');
                    $('#startDate').val(tomorrow);
                    $('#endDate').val(tomorrow);
                } else if (val == 'week') {
                    var firstday = moment().startOf('isoWeek').format('YYYY-MM-DD')
                    var lastday = moment().endOf('isoWeek').format('YYYY-MM-DD')

                    $('#startDate').val(firstday);
                    $('#endDate').val(lastday);
                } else if (val == 'next_week') {
                    var firstday = moment().add(1, 'weeks').startOf('isoWeek').format('YYYY-MM-DD')
                    var lastday = moment().add(1, 'weeks').endOf('isoWeek').format('YYYY-MM-DD')
                    $('#startDate').val(firstday);
                    $('#endDate').val(lastday);
                }
                if (is_change) {
                    $('#filter-form').submit();
                }

            }

            function submitFilters() {
                $('#filter-form').submit();
            }
        </script>
    </div>
@endsection
