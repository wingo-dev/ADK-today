@extends('layouts.master')
@section('page-title', 'User')


@section('content')
<div class="content-body">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header border-bottom">
                    <h4 class="card-title">User Details</h4>
                </div>
                <div class="card-body py-2 my-25">

                        <div class="row">
                            @include('users.show-fields')
                        </div>
                        <div class="col-12">
                            <a href="{{route('users.index')}}" class="btn btn-outline-secondary mt-1">Discard</a>
                        </div>
                    <!--/ form -->
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('page-js')

@endsection
