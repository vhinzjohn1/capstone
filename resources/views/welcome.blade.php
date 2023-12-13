<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Welcome</title>
    <link href="https://fonts.googleapis.com/css?family=IBM+Plex+Sans:400,600" rel="stylesheet">
    <link rel="stylesheet" href="dist/css/style.css">
    <link rel="stylesheet" href="css/index.css">
	<script src="https://unpkg.com/animejs@3.0.1/lib/anime.min.js"></script>
    <script src="https://unpkg.com/scrollreveal@4.0.0/dist/scrollreveal.min.js"></script>
</head>
<body class="is-boxed has-animations">
    <div class="body-wrap">
        <header class="site-header">
            <div class="container">
                <div class="site-header-inner">
                    <div class="brand header-brand">
                        <h1 class="m-0">
							<a href="#">
								<img class="header-logo-image" src="dist/images/logo.svg" alt="Logo">
                            </a>
                        </h1>
                    </div>
                </div>
            </div>
        </header>

        <main>
            <section class="hero">
                <div class="container">
                    <div class="hero-inner">
						<div class="hero-copy">
	                        <h1 class="hero-title mt-0">Welcome SpaceTraveller</h1>
	                        <p class="hero-paragraph"> Where Learning Made Fun</p>
	                        <div class="hero-cta"><a class="login-btn" href="{{ asset('login') }}">LOGIN</a><a class="signup-btn" href="{{ asset('signup') }}">SIGNUP</a></div>
						</div>

                        <!-- animation effect for hero section -->
						<div class="hero-figure anime-element">
							<svg class="placeholder" width="528" height="396" viewBox="0 0 528 396">
								<rect width="528" height="396" style="fill:transparent;" />
							</svg>
							<div class="hero-figure-box hero-figure-box-01" data-rotation="45deg"></div>
							<div class="hero-figure-box hero-figure-box-02" data-rotation="-45deg"></div>
							<div class="hero-figure-box hero-figure-box-03" data-rotation="0deg"></div>
							<div class="hero-figure-box hero-figure-box-04" data-rotation="-135deg"></div>
							<div class="hero-figure-box hero-figure-box-05"></div>
							<div class="hero-figure-box hero-figure-box-06"></div>
							<div class="hero-figure-box hero-figure-box-07"></div>
							<div class="hero-figure-box hero-figure-box-08" data-rotation="-22deg"></div>
							<div class="hero-figure-box hero-figure-box-09" data-rotation="-52deg"></div>
							<div class="hero-figure-box hero-figure-box-10" data-rotation="-50deg"></div>
						</div>
                    </div>
                </div>
            </section>

            <section class="features section">
                <div class="container">
                    <div class="features-inner section-inner has-bottom-divider">
                        <div class="features-wrap">
                            <div class="feature text-center is-revealing">
                                <div class="feature-inner">
                                    <div class="feature-icon">
                                        <img src="src/images/learn.svg" alt="Feature 01">
                                    </div>
                                    <h4 class="feature-title mt-24">Interactive Learning</h4>
                                    <p class="text-sm mb-0">Embark on an adventure of knowledge with our interactive game that make learning exciting and engaging. Dive into a world where education is fun!</p>
                                </div>
                            </div>
                            <div class="feature text-center is-revealing">
                                <div class="feature-inner">
                                    <div class="feature-icon">
                                        <img src="src/images/amaze.svg" alt="Feature 02">
                                    </div>
                                    <h4 class="feature-title mt-24">Visual Delight</h4>
                                    <p class="text-sm mb-0">Immerse yourself in a visually stunning world filled with vibrant graphics and captivating animations that make learning a feast for the eyes.</p>
                                </div>
                            </div>
                            <div class="feature text-center is-revealing">
                                <div class="feature-inner">
                                    <div class="feature-icon">
                                        <img src="src/images/rewards.svg" alt="Feature 03">
                                    </div>
                                    <h4 class="feature-title mt-24">Progress & Rewards</h4>
                                    <p class="text-sm mb-0">Track your progress and earn exciting rewards as you embark on your educational journey. Achieve milestones and reap the benefits!</p>
                                </div>
                            </div>
                            <div class="feature text-center is-revealing">
                                <div class="feature-inner">
                                    <div class="feature-icon">
                                        <img src="src/images/study.svg" alt="Feature 04">
                                    </div>
                                    <h4 class="feature-title mt-24">Empower Educators</h4>
                                    <p class="text-sm mb-0">Empowers educators with effective tools to inspire and educate young minds. Use our platform to make lessons more engaging.</p>
                                </div>
                            </div>
                            <div class="feature text-center is-revealing">
                                <div class="feature-inner">
                                    <div class="feature-icon">
                                        <img src="src/images/redefine.svg" alt="Feature 06">
                                    </div>
                                    <h4 class="feature-title mt-24">Learning Redefined</h4>
                                    <p class="text-sm mb-0">We redefine learning by combining fun and education. Be a part of the revolution in how we educate and inspire the future.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>                
            </section>
        </main>
    </div>

    <script src="dist/js/main.min.js"></script>
</body>
</html>
