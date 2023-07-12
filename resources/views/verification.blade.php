@extends('layouts.front_end.master')

@section('content')
<style>
    .ahref{
        background: none!important;
                            border: none;
                            padding: 0!important;
                            /*optional*/
                            font-family: arial, sans-serif;
                            /*input has OS specific font-family*/
                            color: #ffc800;
                            text-decoration: underline;
                            cursor: pointer;
    }
    .ahref:hover{
        color: #cca000;
    }
</style>
<main class="py-4">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Verify Your Email Address</div>

                    <div class="card-body">

                        Please Note, Before you can login to your account you must first confirm the email address that you provided by clicking on a link that was just sent to you. (Note it may take a few minutes for this email to arrive in your inbox).
                        <p>
                            <small>If you DO NOT receive this email, check your spam or trash folder as occasionally
                                these emails are viewed as spam by certain programs. It might take up to an hour to
                                arrive.</small>
                        </p>
                        <form action="{{route('verification.modal.resend')}}">
                            <input type="hidden" name="email" value="{{$email}}">
                            If you did not receive the email, <button class="ahref" style="text-decoration:underline" type="submit">click here to request another</button>.
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

@endsection
