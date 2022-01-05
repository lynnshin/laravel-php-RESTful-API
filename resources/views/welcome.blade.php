<!DOCTYPE HTML>
<!--
	加上每日一句後的模板 要在public資料夾中貼上Alpha的assets資料夾
	Alpha by HTML5 UP
	html5up.net | @ajlkn
	Free for personal and commercial use under the CCA 3.0 license (html5up.net/license)
-->
<html>
	<head>
		<title>Laravel Blog</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
		<link rel="stylesheet" href="{{ asset('assets/css/main.css') }}" />
	</head>
	<body class="landing is-preload">
		<div id="page-wrapper">

			<!-- Header -->
				<header id="header" class="alt">
					<h1><a href="/">Laravel Blog</a></h1>
					<nav id="nav">
						<ul>
                            @if (Route::has('login'))
                                @auth
							    <li>
                                    <a href="/" class="icon solid fa-angle-down">{{ Auth::user()->name }}</a>
                                    <ul>
                                        <li><a href="{{ route('logout') }}"
                                            onclick="event.preventDefault();
                                                document.getElementById('logout-form').submit();">
                                            {{ __('Logout') }}
                                            </a>                                            
                                        </li>
                                    </ul>                                    
                                </li>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                                
                            @else 
                                <li><a href="{{ route('login') }}" class="button">Sign In</a></li>
                                @if (Route::has('register'))
                                    <li><a href="{{ route('register') }}" class="button">Sign Up</a></li>
                                @endif
                                @endauth
                            @endif
						</ul>
					</nav>
				</header>

			<!-- Banner -->
				<section id="banner">
					<ul class="actions special">
                        <section class="box special">                            
                            <header class="major">
                                <h3 id="quoteContent" style="color:#777;"></h3>
                                <br>                            
                                <p id="quoteAuthor"></p>
                            </header>
                        </section>
					</ul>
				</section>

			<!-- Footer -->
				<footer id="footer">
					<ul class="copyright">
						<li>&copy; Untitled. All rights reserved.</li><li>Design: <a href="http://html5up.net">HTML5 UP</a></li><li>Photo by <a href="https://unsplash.com/@alinosu?utm_source=unsplash&utm_medium=referral&utm_content=creditCopyText">Alin Corneliu</a> on <a href="https://unsplash.com/?utm_source=unsplash&utm_medium=referral&utm_content=creditCopyText">Unsplash</a></li>
					</ul>
				</footer>

		</div>

		<!-- Scripts -->
			<script src="{{ asset('assets/js/jquery.min.js') }}"></script>
			<script src="{{ asset('assets/js/jquery.dropotron.min.js') }}"></script>
			<script src="{{ asset('assets/js/jquery.scrollex.min.js') }}"></script>
			<script src="{{ asset('assets/js/browser.min.js') }}"></script>
			<script src="{{ asset('assets/js/breakpoints.min.js') }}"></script>
			<script src="{{ asset('assets/js/util.js') }}"></script>
			<script src="{{ asset('assets/js/main.js') }}"></script>
            <script>
                $.ajax({
                    url:"https://programming-quotes-api.herokuapp.com/Quotes/random",
                    type:"get",
                    dataType:"json",
                    contentType:"application/json; charset=UTF-8",
                    success: function(data){
                        $('#quoteContent').text(data['en']),
                        $('#quoteAuthor').text(' — '+data['author'])
                    },
                    error: function(XMLHttpRequest, textStatus, errorThrown){
                        console.log(errorThrown);
                    }
                });
            </script>

	</body>
</html>