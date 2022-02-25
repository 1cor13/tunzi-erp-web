<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
        <meta name="description" content="{{ config('app.desc') }}">
        <meta name="keywords" content="@yield('keywords', 'Tunzi,Tunzi Login,Welcome back to Tunzi')">
        <meta name="author" content="{{ config('app.devname') }}">
        <meta name="robots" content="noindex, nofollow">
        <title>@yield('title', 'Page') : : {{ config('app.name') }}</title>
        <link rel="shortcut icon" type="image/x-icon" href="@yield('favicon', asset('assets/img/favicon.svg'))">
        <style type="text/css">
        	.pre-loader { 
			    background-color: #2c3e50; position: fixed;
			    height: 100%; width: 100%; left: 0; top: 0;
			    display: flex; align-items: center; justify-content: center; z-index: 100;
			}
			.sk-fading-circle { margin: 100px auto; width: 40px; height: 40px; position: relative; }
			.sk-fading-circle .sk-circle { width: 100%; height: 100%; position: absolute; left: 0; top: 0; }
			.sk-fading-circle .sk-circle:before { content: ''; display: block; margin: 0 auto; width: 15%; height: 15%; background-color: #fff; border-radius: 100%; -webkit-animation: sk-circleFadeDelay 1.2s infinite ease-in-out both; animation: sk-circleFadeDelay 1.2s infinite ease-in-out both; }
			.sk-fading-circle .sk-circle2 { -webkit-transform: rotate(30deg); -ms-transform: rotate(30deg); transform: rotate(30deg); }
			.sk-fading-circle .sk-circle3 { -webkit-transform: rotate(60deg); -ms-transform: rotate(60deg); transform: rotate(60deg); }
			.sk-fading-circle .sk-circle4 { -webkit-transform: rotate(90deg); -ms-transform: rotate(90deg); transform: rotate(90deg); }
			.sk-fading-circle .sk-circle5 { -webkit-transform: rotate(120deg); -ms-transform: rotate(120deg); transform: rotate(120deg); }
			.sk-fading-circle .sk-circle6 { -webkit-transform: rotate(150deg); -ms-transform: rotate(150deg); transform: rotate(150deg); }
			.sk-fading-circle .sk-circle7 { -webkit-transform: rotate(180deg); -ms-transform: rotate(180deg); transform: rotate(180deg); }
			.sk-fading-circle .sk-circle8 { -webkit-transform: rotate(210deg); -ms-transform: rotate(210deg); transform: rotate(210deg); }
			.sk-fading-circle .sk-circle9 { -webkit-transform: rotate(240deg); -ms-transform: rotate(240deg); transform: rotate(240deg); }
			.sk-fading-circle .sk-circle10 { -webkit-transform: rotate(270deg); -ms-transform: rotate(270deg); transform: rotate(270deg); }
			.sk-fading-circle .sk-circle11 { -webkit-transform: rotate(300deg); -ms-transform: rotate(300deg); transform: rotate(300deg); }
			.sk-fading-circle .sk-circle12 { -webkit-transform: rotate(330deg); -ms-transform: rotate(330deg); transform: rotate(330deg); }
			.sk-fading-circle .sk-circle2:before { -webkit-animation-delay: -1.1s; animation-delay: -1.1s; }
			.sk-fading-circle .sk-circle3:before { -webkit-animation-delay: -1s; animation-delay: -1s; }
			.sk-fading-circle .sk-circle4:before { -webkit-animation-delay: -0.9s; animation-delay: -0.9s; }
			.sk-fading-circle .sk-circle5:before { -webkit-animation-delay: -0.8s; animation-delay: -0.8s; }
			.sk-fading-circle .sk-circle6:before { -webkit-animation-delay: -0.7s; animation-delay: -0.7s; }
			.sk-fading-circle .sk-circle7:before { -webkit-animation-delay: -0.6s; animation-delay: -0.6s; }
			.sk-fading-circle .sk-circle8:before { -webkit-animation-delay: -0.5s; animation-delay: -0.5s; }
			.sk-fading-circle .sk-circle9:before { -webkit-animation-delay: -0.4s; animation-delay: -0.4s; }
			.sk-fading-circle .sk-circle10:before { -webkit-animation-delay: -0.3s; animation-delay: -0.3s; }
			.sk-fading-circle .sk-circle11:before { -webkit-animation-delay: -0.2s; animation-delay: -0.2s; }
			.sk-fading-circle .sk-circle12:before { -webkit-animation-delay: -0.1s; animation-delay: -0.1s; }
			@-webkit-keyframes sk-circleFadeDelay { 0%, 39%, 100% { opacity: 0; } 40% { opacity: 1; } }
			@keyframes sk-circleFadeDelay { 0%, 39%, 100% { opacity: 0; } 40% { opacity: 1; } }
        </style>
        <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}">
        <link rel="stylesheet" href="{{ asset('assets/css/font-awesome.min.css') }}">
        <link rel="stylesheet" href="{{ asset('assets/css/style-purple.css') }}">
        <style> a:active, button:active { box-shadow: 0 5px #666; transform: scale(.8); } </style>
		<!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
		<!--[if lt IE 9]>
			<script src="{{ asset('assets/js/html5shiv.min.js') }}"></script>
			<script src="{{ asset('assets/js/respond.min.js') }}"></script>
		<![endif]-->
    </head>
    <body class="account-page" style="background: linear-gradient( rgba(0, 0, 0, 0.2), rgba(0, 0, 0, 0.2) ), url('{{ asset('assets/img/splash.jpg')  }}') center; background-attachment: fixed;">
		<div class="pre-loader">
            <div class="sk-fading-circle">
                <div class="sk-circle1 sk-circle"></div>
                <div class="sk-circle2 sk-circle"></div>
                <div class="sk-circle3 sk-circle"></div>
                <div class="sk-circle4 sk-circle"></div>
                <div class="sk-circle5 sk-circle"></div>
                <div class="sk-circle6 sk-circle"></div>
                <div class="sk-circle7 sk-circle"></div>
                <div class="sk-circle8 sk-circle"></div>
                <div class="sk-circle9 sk-circle"></div>
                <div class="sk-circle10 sk-circle"></div>
                <div class="sk-circle11 sk-circle"></div>
                <div class="sk-circle12 sk-circle"></div>
            </div>
        </div>
		<!-- Main Wrapper -->
        <div class="main-wrapper">
			@yield('content')
			@sectionMissing('content')
			<div> No content specified for this page! </div>
			@endif
        </div>
        <script src="{{ asset('assets/js/jquery-3.2.1.min.js') }}"></script>
        <script>
            'use strict';
            $(window).on('load', function (){ if ($(".pre-loader").length > 0) { $(".pre-loader").fadeOut("slow"); } });
        </script>
        <script src="{{ asset('assets/js/popper.min.js') }}"></script>
        <script src="{{ asset('assets/js/bootstrap.min.js') }}"></script>
		<script src="assets/js/app.js"></script>
    </body>
</html>