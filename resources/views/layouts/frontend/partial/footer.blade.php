<footer>

        <div class="container">
            <div class="row">

                <div class="col-lg-4 col-md-6">
                    <div class="footer-section">

                        {{--<a class="logo" href="#"><img src="images/logo.png" alt="Logo Image"></a>--}}
                    <p class="copyright">{{ env('APP_NAME') }} @ {{ date('Y') }}. All rights reserved.</p>
                    <p class="copyright"><strong> Developed &amp; <i class="far fa-heart"></i> by </strong>
                        <a href="https://developeralamin.github.io/simple_website/alamin_me.html" target="_blank">Developer Alamin</a></p>
                    <ul class="icons">
                        <li><a target="_blank" href="https://www.facebook.com/tpialamin/"><i class="ion-social-facebook-outline"></i></a></li>

                        <li><a target="_blank" href="#"><i class="ion-social-twitter-outline"></i></a></li>

                        <li><a target="_blank" href="#"><i class="ion-social-instagram-outline"></i></a></li>

                        <li><a target="_blank" href="#"><i class="ion-social-youtube-outline"></i></a></li>
                    </ul>

                    </div><!-- footer-section -->
                </div><!-- col-lg-4 col-md-6 -->

            <div class="col-lg-4 col-md-6">
                <div class="footer-section">
                    <h4 class="title"><b>CATAGORIES</b></h4>
                    <ul>
                       {{--  @foreach($categories as $category)
                            <li><a href="">{{ $category->name }}</a></li>
                        @endforeach --}}
                    </ul>
                </div><!-- footer-section -->
            </div><!-- col-lg-4 col-md-6 -->

                <div class="col-lg-4 col-md-6">
            <div class="footer-section">

                <h4 class="title"><b>SUBSCRIBE</b></h4>
                <div class="input-area">
                   
                    <form method="POST" action="{{ route('suscribe.store') }}" >
                        @csrf
                        <input class="email-input" name="email" type="text" placeholder="Enter your email">
                        <button class="submit-btn" type="submit"><i class="icon ion-ios-email-outline"></i></button>
                    </form>

                </div>

            </div><!-- footer-section -->
                </div><!-- col-lg-4 col-md-6 -->

            </div><!-- row -->
        </div><!-- container -->
    </footer>