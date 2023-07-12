<!DOCTYPE html>

<html class="loading" lang="en">
<!-- BEGIN: Head-->

<!-- BEGIN: Head-->

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1.0,user-scalable=0,minimal-ui">
    <meta name="description" content="">
    <meta name="keywords" content="">
    <meta name="author" content="">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>

    @yield('seo-breadcrumb')

    <title>@yield('page-title') - {{ config('app.name', '') }}</title>
    <link rel="stylesheet" href="{{asset('assets/css/style.css')}}">

    <link rel="apple-touch-icon" href="{{asset('lms/app-assets/images/ico/apple-icon-120.')}}html">
    <link rel="shortcut icon" type="image/x-icon" href="{{asset('lms/app-assets/images/ico/favicon.')}}ico">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="stylesheet" type="text/css" href="{{asset('assets/css/plugins/extensions/ext-component-tree.min.css')}}">

    <link
        href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100;0,200;0,300;0,400;0,500&display=swap"
        rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>

    <!-- BEGIN: Vendor CSS-->
    {{--
    <link rel="stylesheet" type="text/css" href="{{asset('lms/app-assets/vendors/css/vendors.min.')}}css">--}}
    {{--
    <link rel="stylesheet" type="text/css" href="{{asset('lms/app-assets/vendors/css/extensions/toastr.min.')}}css">--}}
    {{--
    <link rel="stylesheet" type="text/css" href="{{asset('lms/app-assets/vendors/css/animate/animate.min.')}}css">--}}
    {{--
    <link rel="stylesheet" type="text/css"
        href="{{asset('lms/app-assets/vendors/css/extensions/sweetalert2.min.')}}css">--}}
    <link rel="stylesheet" type="text/css" href="{{asset('assets/vendors/css/forms/select/select2.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('assets/vendors/css/pickers/pickadate/pickadate.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('assets/vendors/css/pickers/flatpickr/flatpickr.min.css')}}">
    <link rel="stylesheet" type="text/css"
        href="{{asset('assets/vendors/css/forms/spinner/jquery.bootstrap-touchspin.css')}}">
    @yield('page-vendor')

    <!-- END: Vendor CSS-->

    <!-- BEGIN: Theme CSS-->
    <link rel="stylesheet" type="text/css" href="{{asset('assets/css/bootstrap.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('assets/css/bootstrap-extended.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('assets/css/colors.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('assets/css/components.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('assets/css/themes/dark-layout.min.css')}}">

    <!-- BEGIN: Page CSS-->
    <link rel="stylesheet" type="text/css" href="{{asset('assets/css/plugins/forms/pickers/form-flat-pickr.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('assets/css/plugins/forms/pickers/form-pickadate.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('assets/css/core/menu/menu-types/vertical-menu.min.css')}}">
    {{--
    <link rel="stylesheet" type="text/css"
        href="{{asset('lms/app-assets/css/plugins/extensions/ext-component-sweet-alerts.min.css')}}">--}}
    {{--
    <link rel="stylesheet" type="text/css"
        href="{{asset('lms/app-assets/css/plugins/extensions/ext-component-toastr.min.css')}}">--}}
    @yield('page-css')
    <!-- END: Page CSS-->

    <!-- BEGIN: Custom CSS-->
    <link rel="stylesheet" type="text/css"
        href="{{asset('assets/vendors/css/bootstrap-icons/font/bootstrap-icons.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('assets/extras/cup.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('assets/css/app.min.css')}}">
    <!-- END: Custom CSS-->
    <link rel="stylesheet" type="text/css" href="{{asset('assets/css/style.css')}}">
    <style>
        .select2-container--default .select2-results>.select2-results__options {
            max-height: 250px !important;
        }

        .card-title,
        .content-header-title {
            font-variant: small-caps;
        }

        .img_styling {
            object-fit: cover;
            height: 27px
        }
    </style>

    <link rel="stylesheet" type="text/css" href="{{asset('assets/vendors/css/charts/apexcharts.css')}}">

    @yield('custom-css')

</head>
<!-- END: Head-->


<!-- BEGIN: Body-->

<body class="vertical-layout vertical-menu-modern  navbar-floating footer-static  " data-open="click"
    data-menu="vertical-menu-modern" data-col="">

    {{ view('layouts.topbar') }}

    {{ view('layouts.sidebar') }}

    <!-- BEGIN: Content-->
    <div class="app-content content ">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-wrapper container-xxl p-0">

            {{ view('layouts.alerts') }}


            @if (!request()->routeIs('home'))
            <div class="content-header row">
                @yield('breadcrumbs')
            </div>
            @endif

            <div class="content-header row">

            </div>

            <div class="content-body">
                @yield('content')
            </div>
        </div>
    </div>
    <!-- END: Content-->

    {{-- {{ view('app.layout.customizer') }} --}}

    {{-- @includeWhen(count($batches) > 0, 'app.layout.queueLoading', ['batches' => $batches]) --}}
    {{-- {{ view('app.layout.queueLoading', ['batches' => $batches]) }} --}}

    <div class="sidenav-overlay"></div>
    <div class="drag-target"></div>

    {{ view('layouts.footer') }}

    <!-- BEGIN: Page Vendor JS-->
    <script src="{{asset('assets/vendors/js/vendors.min.js')}}"></script>
    <script src="{{asset('assets/vendors/js/forms/spinner/jquery.bootstrap-touchspin.js')}}"></script>
    <script src="{{asset('assets/js/scripts/components/components-tooltips.min.js')}}"></script>
    <script src="{{asset('assets/vendors/js/extensions/toastr.min.js')}}"></script>
    <script src="{{asset('assets/vendors/js/extensions/sweetalert2.all.min.js')}}"></script>
    <script src="{{asset('assets/vendors/js/extensions/polyfill.min.js')}}"></script>
    <script src="{{asset('assets/vendors/js/pickers/flatpickr/flatpickr.min.js')}}"></script>

    @yield('vendor-js')

    <!-- END: Page Vendor JS-->


    <!-- BEGIN: Theme JS-->
    <script src="{{asset('assets/js/core/app-menu.min.js')}}"></script>
    <script src="{{asset('assets/js/core/app.min.js')}}"></script>
    <script src="{{asset('assets/js/scripts/customizer.min.js')}}"></script>
    <script src="{{asset('assets/vendors/js/forms/select/select2.full.min.js')}}"></script>
    <script src="{{asset('assets/js/scripts/forms/form-select2.min.js')}}"></script>

    <!-- END: Theme JS-->

    <!-- BEGIN: Page JS-->
    @yield('page-js')
    <!-- END: Page JS-->

    <script>
        $(window).on('load', function() {
            if (feather) {
                feather.replace({
                    width: 14,
                    height: 14
                });
            }
        });
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        function deleteByID(url,place='Account') {
            let is_account = place == 'Account';
            if(is_account){

                Swal.fire({
                icon: 'warning',
                title: `Delete ${place}? Are You Sure? This will delete all the Events of this User!`,
                text: 'You wont be able to revert this!',
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

            }else{

            Swal.fire({
                icon: 'warning',
                title: `Delete ${place}? Are You Sure?`,
                text: 'You wont be able to revert this!',
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
        }
        function banByID(url,id) {
            Swal.fire({
                icon: 'warning',
                title: 'Ban User? Are you Sure?',
                text: 'You wont be able to revert this!',
                showCancelButton: true,
                cancelButtonText: 'No',
                confirmButtonText: 'Yes, Ban!',
                confirmButtonClass: 'btn-danger',
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                       url: url,
                       data:{user_id:id},
                       method: 'post',
                       success: (res) => {
                        console.log(res);
                           location.href = res;
                       },
                    });
                }
            });
        }
        function unbanByID(url,id) {
            Swal.fire({
                icon: 'warning',
                title: 'Unban User? Are you Sure?',
                text: 'You wont be able to revert this!',
                showCancelButton: true,
                cancelButtonText: 'No',
                confirmButtonText: 'Yes, Unban it!',
                confirmButtonClass: 'btn-success',
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                       url: url,
                       data:{user_id:id},
                       method: 'post',
                       success: (res) => {
                        console.log(res);
                           location.href = res;
                       },
                    });
                }
            });
        }
        $(function () {
  $('[data-toggle="tooltip"]').tooltip()
})
    </script>

    @yield('custom-js')

</body>
<!-- END: Body-->

</html>
