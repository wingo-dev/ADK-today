<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Tenor+Sans&display=swap" rel="stylesheet">

    <title>{{ env('APP_NAME') }} - @yield('title', 'Home')</title>
    <!-- Favicon-->
    <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
    <!-- Font Awesome icons (free version)-->
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
    <!-- Google fonts-->
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css" />
    <link href="https://fonts.googleapis.com/css?family=Roboto+Slab:400,100,300,700" rel="stylesheet" type="text/css" />
    <!-- Core theme CSS (includes Bootstrap)-->
    <link href="{{asset('css/styles.css')}}" rel="stylesheet" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

</head>
<style>
html, body {
  height: 100%;
  margin: 0;
  /* font-family: 'Tenor Sans', sans-serif; */
}


footer {
  background: black;
  color: white;
}
</style>

<body id="page-top" class="d-flex flex-column min-vh-100">
<div class="wrapper">
    {{-- @if($errors->any())

    @dd($errors)
    @endif --}}
    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
        @csrf
    </form>
    <!-- Navigation-->
    @include('layouts.front_end.topbar')
    {{ view('layouts.alerts') }}


    <div class="app-content content">
        <div class="content-wrapper container-fluid p-0">
            <div class="content-body" style="overflow: hidden; padding-bottom: 20px; ">
                @yield('content')
            </div>
        </div>
    </div>
</div>
    <!-- Footer-->
    @include('layouts.front_end.footer')



    <!-- Modal starts -->
    @auth
    <div class="modal fade w-4500" id="profileModal" tabindex="-1" aria-labelledby="profileModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-xl">
            <div class="modal-content">

                <div class="modal-header">
                    <h3 class="modal-title " id="profileModalLabel">Edit Profile</h3>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">

                    <h5 class=" text-secondary">Profile </h6>

                        <form action="{{route('update-account')}}" method="POST">
                            @csrf
                            @method('PUT')
                            <!-- Passowrd fields starts -->
                            <div class="d-flex row">

                                <div class="mb-2 col-md-6">
                                    <label for="password" class="form-label">Password</label>
                                    <input type="password" class="form-control" id="password" name="password"
                                        autocomplete="new-password">
                                    @if($errors->has('password'))
                                    <span class="text-danger col-sm-4">{{$errors->first('password')}}</span>
                                    @endif
                                    <!-- <div class="invalid-feedback">Password must be between 8 and 16 characters long and contain at least one number.</div> -->
                                </div>
                                <div class="mb-2 col-md-6">
                                    <label for="password_confirmation" class="form-label">Confirm Password</label>
                                    <input type="password" class="form-control" id="password_confirmation"
                                        name="password_confirmation">
                                    @if($errors->has('password_confirmation'))
                                    <span class="text-danger col-sm-4">{{$errors->first('password')}}</span>
                                    @endif
                                </div>
                            </div>

                            <!-- password fields ends -->

                            <!-- Address Starts -->
                            <div class="mb-2">
                                <label for="address1" class="form-label">Address 1</label>
                                <input type="text" class="form-control" id="address1" name="address1"
                                    value="{{old('address1')? old('address1') : auth()->user()->address1}}"
                                    placeholder="Enter your Address 1">
                                @if($errors->has('address1'))
                                <span class="text-danger col-sm-4">{{$errors->first('address1')}}</span>
                                @endif
                            </div>
                            <div class="mb-2">
                                <label for="address2" class="form-label">Address 2</label>
                                <input type="text" class="form-control" id="address2" name="address2"
                                    value="{{old('address2')? old('address2') : auth()->user()->address2}}"
                                    placeholder="Enter your Address 2">
                                @if($errors->has('address2'))
                                <span class="text-danger col-sm-4">{{$errors->first('address2')}}</span>
                                @endif
                            </div>
                </div>
                <div class="modal-footer">
                    <button type="reset" class="btn btn-secondary" data-bs-dismiss="modal">Discard</button>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
                </form>

            </div>
        </div>
    </div>
    @php
    $isVendor = (auth()->user()->role == \App\Utils\Common\UserRoles::VENDOR);
    @endphp
    @endauth



    <!-- modal ends -->
    <!-- Bootstrap core JS-->
    <script src="{{asset('assets/vendors/js/extensions/sweetalert2.all.min.js')}}"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
         $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        function deleteByID(url) {
            Swal.fire({
                icon: 'warning',
                title: 'Delete Account? Are You Sure?{{ isset($isVendor) && $isVendor === true ? " This will delete all the Events" : "" }}',
                text: "Deleting your account can't be reversed!",
                showCancelButton: true,
                cancelButtonText: 'No',
                confirmButtonText: 'Yes, Delete it!',
                confirmButtonClass: 'btn-danger',
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                       url: url,
                       method: 'DELETE',
                       success: (res) => {
                           location.href = res;
                       },
                    });
                }
            });
        }
        function upgradeToVendor(url) {
            Swal.fire({
                icon: 'warning',
                title: 'In order to submit an event, you must register as a vendor. Your account type will change from user to vendor. You will be required to provide more information about your business.',
                text: "Continue?",
                showCancelButton: true,
                cancelButtonText: 'No',
                confirmButtonText: 'Yes',
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: url,
                        method: 'PUT',
                        success: (res) => {
                            location.href = res;
                        },
                    });
                }
            });
        }
    </script>
    <!-- Core theme JS-->
    <script src="{{asset('js/scripts.js')}}"></script>

</body>

</html>
