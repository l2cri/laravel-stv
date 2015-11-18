@extends('main')

@section('content')

    {{ var_dump($infopage) }}

    <div class="breadcrumb-box">
    <a href="#">Home</a>
    <a href="#">About Us</a>
</div>

    <div class="information-blocks">
    <img class="project-thumbnail" src="img/about-1.jpg" alt="" />
    <div class="row">
        <div class="col-md-4 information-entry">
            <div class="article-container style-1">
                <h2>Which of us ever undertakes laborious physical exercise, except to obtain.</h2>
                <p>By creating an account with our store, you will be able to move through the checkout process faster, store multiple shipping addresses, view and track your orders in your account and more. Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium. But who has any right to find fault with a man who chooses to enjoy a pleasure that has no annoying consequences</p>
                <a class="continue-link" href="#">Continue reading <i class="fa fa-long-arrow-right"></i></a>
            </div>
        </div>
        <div class="col-md-4 information-entry">
            <h3 class="block-title">Company Informations</h3>
            <div class="article-container style-1">
                <h5><i class="fa fa-calculator"></i> Premium UK delivery</h5>
                <p>By creating an account with our store, you will be able to move through the checkout process faster</p>
            </div>
            <div class="article-container style-1">
                <h5><i class="fa fa-scissors"></i> Tailoring for free</h5>
                <p>By creating an account with our store, you will be able to move through the checkout process faster</p>
            </div>
            <div class="article-container style-1">
                <h5><i class="fa fa-desktop"></i> Online Ordering</h5>
                <p>By creating an account with our store, you will be able to move through the checkout process faster</p>
            </div>
        </div>
        <div class="col-md-4 information-entry">
            <div class="accordeon">
                <div class="accordeon-title active">How do I use a promotional code?</div>
                <div class="accordeon-entry" style="display: block;">
                    <div class="article-container style-1">
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit.</p>
                    </div>
                </div>
                <div class="accordeon-title">Is there any possibility to ship my order?</div>
                <div class="accordeon-entry">
                    <div class="article-container style-1">
                        <p>By creating an account with our store, you will be able to move through the checkout process faster, store multiple shipping addresses, view and track your orders in your account and more. Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium.</p>
                    </div>
                </div>
                <div class="accordeon-title">Where are you from? <span class="inline-label red">popular</span></div>
                <div class="accordeon-entry">
                    <div class="article-container style-1">
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit.</p>
                    </div>
                </div>
                <div class="accordeon-title">How do I use a promotional code?</div>
                <div class="accordeon-entry">
                    <div class="article-container style-1">
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection