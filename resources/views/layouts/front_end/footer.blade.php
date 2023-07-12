<footer class="footer py-4 mt-auto">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-4 text-lg-start">
                <a class="text-light text-decoration-none" href="{{ route('copyright-policy') }}">Copyright &copy; {{ env('APP_NAME') }}</a>
            </div>
            <div class="col-lg-4 my-3 my-lg-0">
                <a class="btn btn-dark btn-social mx-2" href="#!" aria-label="Twitter"><i class="fab fa-twitter"></i></a>
                <a class="btn btn-dark btn-social mx-2" href="#!" aria-label="Facebook"><i class="fab fa-facebook-f"></i></a>
                <a class="btn btn-dark btn-social mx-2" href="#!" aria-label="LinkedIn"><i class="fab fa-linkedin-in"></i></a>
            </div>
            <div class="col-lg-4 text-lg-end">
                <a class="text-light text-decoration-none me-3" href="{{ route('privacy-policy') }}">Privacy Policy</a>
                <a class="text-light text-decoration-none" href="{{ route('terms-of-use') }}">Terms of Use</a>
            </div>
        </div>
    </div>
</footer>
