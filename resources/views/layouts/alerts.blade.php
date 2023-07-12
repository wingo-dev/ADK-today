{{-- @if ($errors->any()) --}}
<div class="section mt-30">
    <div class="container-fluid g-0">
        <div class="row">
            <div class="col-sm-12 col-md-12 col-lg-12 col-xs-12 mb-30">
                @if (session()->has('info'))
                    <div class="alert alert-primary alert-dismissible fade show" role="alert">
                        <h4 class="alert-heading"><i data-feather="info" class="me-50"></i>Information!</h4>
                        <div class="alert-body">
                            {!! session()->get('info') !!}
                        </div>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @elseif (session()->has('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <h4 class="alert-heading"><i data-feather='check-circle' class="me-50"></i>Success!</h4>
                        <div class="alert-body">
                            {!! session()->get('success') !!}
                        </div>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @elseif (session()->has('warning'))
                    <div class="alert alert-warning alert-dismissible fade show" role="alert">
                        <h4 class="alert-heading"><i data-feather="alert-triangle" class="me-50"></i>Warning!</h4>
                        <div class="alert-body">
                            {!! session()->get('warning') !!}
                        </div>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @elseif (session()->has('danger'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <h4 class="alert-heading"><i data-feather="alert-circle" class="me-50"></i>Error!</h4>
                        <div class="alert-body">
                            {!! session()->get('danger') !!}
                        </div>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @elseif ($errors->any())
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <h4 class="alert-heading">Errors!</h4>
                        <div class="alert-body">
                            <ul class="pt-1">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @elseif (session('status'))
                    <div class="alert alert-primary alert-dismissible fade show" role="alert">
                        <h4 class="alert-heading"><i data-feather="info" class="me-50"></i>Information!</h4>
                        <div class="alert-body">
                            {{ session('status') }}
                        </div>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
{{-- @endif --}}
