@extends('layouts.front_end.master')

@section('content')

<style>
    .form-group .required {
        color: red;
        display: inline;
        margin-left: 5px;
        line-height: 2.8;
    }
</style>
<main class="py-4">
    <div class="container">
        <div class="row justify-content-center">

            <div class="col-md-8">

                <div class="card">

                    <div class="card-header">Change Password</div>

                    <div class="card-body">


                        <form action="{{route('update-account')}}" method="POST" id="form">
                            @csrf
                            @method('PUT')
                            <!-- Passowrd fields starts -->
                            <div class="d-flex row">

                                <div class="mb-2 col-md-12">
                                    <label for="password" class="form-label">Password</label>
                                    <input type="password" class="form-control" id="password" name="password"
                                        autocomplete="new-password">
                                    @if($errors->has('password'))
                                    <span class="text-danger col-sm-4">{{$errors->first('password')}}</span>
                                    @endif
                                    <!-- <div class="invalid-feedback">Password must be between 8 and 16 characters long and contain at least one number.</div> -->
                                </div>
                                <div class="mb-2 col-md-12">
                                    <label for="password_confirmation" class="form-label">Confirm Password</label>
                                    <input type="password" class="form-control" id="password_confirmation"
                                        name="password_confirmation">
                                    @if($errors->has('password_confirmation'))
                                    <span class="text-danger col-sm-4">{{$errors->first('password')}}</span>
                                    @endif
                                </div>
                            </div>
                    </div>
                    <div class="modal-footer">
                        <div class="mb-2">

                            <div class="pull-right">
                                <a href="javascript: history.back()" class="btn btn btn-secondary mt-2">Back</a>
                                <button type="submit" class="btn btn-primary mt-2"
                                    style="margin-right:1rem">Submit</button>
                            </div>
                        </div>
                    </div>
                    </form>

                </div>

            </div>

        </div>

    </div>

    </div>

</main>
<script>
    window.scrollTo(0, document.body.scrollHeight);

</script>
<script>
    $("#form").on('submit', function (e) {
    e.preventDefault();
    Swal.fire({
                icon: 'warning',
                title: 'Change Password? Are you sure?',
                text: 'You wont be able to revert this!',
                showCancelButton: true,
                cancelButtonText: 'No',
                confirmButtonText: 'Yes, Change it!',
                confirmButtonClass: 'btn-danger',
            }).then((result) => {
                if (result.isConfirmed) {
                    this.submit();
                }
            });
});
</script>
@endsection
