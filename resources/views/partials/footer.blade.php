<footer class="footer-custom mt-auto py-4">
    <div class="container-fluid">
        <div class="row text-center text-lg-start">

        <!-- Logo & Description -->
        <div class="col-lg-4 mb-4">
            <img src="{{ asset('assets/logo.png') }}" alt="" class="img-fluid" style="height: 70px; width: 70px;">
            <p class="small-text mt-3">
                PostForge is your modern blogging hub, where ideas meet design. Share, discover, and connect through well-crafted posts.
            </p>
        </div>

        <!-- Quick Links -->
        <div class="col-lg-4 mb-4">
            <h3 class="mb-4">Quick Links</h3>
            <ul class="list-unstyled">
                @auth
                    <li><a href="{{ route('home')}}" class="footer-link">Home</a></li>
                    <li><a href="{{ route('posts.index')}}" class="footer-link">Posts</a></li>
                @endauth
            <li><a href="{{ route('auth.login')}}" class="footer-link">Login</a></li>
            <li><a href="{{ route('auth.register')}}" class="footer-link">Register</a></li>
            </ul>
        </div>

        <!-- Contact Info -->
        <div class="col-lg-4 mb-4">
            <h3 class="mb-4">Contact</h3>
            <ul class="list-unstyled small-text">
            <li class="mb-3"><i class="fa-solid fa-envelope me-2 fs-4"></i> support@postforge.com </li>
            <li class="mb-3"><i class="fa-solid fa-phone me-2 fs-4"></i> +123 456 7890</li>
            <li><i class="fa-solid fa-map-marker-alt me-2 fs-4"></i> Ouled Teima, Morocco.</li>
            </ul>
        </div>

        </div>
        <hr class="border-light">
        <div class="text-center small-text">
        &copy; {{ date('Y') }} PostForge. All rights reserved.
        </div>
    </div>
</footer>
