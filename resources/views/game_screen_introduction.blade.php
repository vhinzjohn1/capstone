<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Educational Game</title>
    <link rel="stylesheet" href="./css/style.css">
    <link href="https://fonts.googleapis.com/css?family=Baloo+2:400,800&display=swap" rel="stylesheet">
    <script src="https://unpkg.com/@dotlottie/player-component@latest/dist/dotlottie-player.mjs" type="module"></script>
    <link rel="stylesheet" href="dist/css/style.css">
</head>
<body>
    <main>
    <section class="hero1">
            <div class="hero-inner1">
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
            <div class="container">
                <div class="hero-inner">
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
        <div class="astronaut" id="astronaut">
            <dotlottie-player src="./lottie/astronaut.json" background="transparent" speed="2" direction="1" mode="normal" loop autoplay></dotlottie-player>
        </div>
            <div class="message">
                <div class="message-content">
                    <p>Hi there, Intrepid Explorer <br/> Welcome to the Interstellar Journey of 'Cosmic Math Quest'</p>
                    <button class="next-button" onclick="changeMessage()">Next</button>
                </div>
            </div>
            
    </main>

    <script>
        function changeMessage() {
            const messageContent = document.querySelector('.message-content');
            messageContent.innerHTML = "<p>Prepare to embark on an epic space adventure where you'll conquer the mysteries of tangents and secants while traversing distant galaxies</p>";

            // Move the astronaut to the right using a transform animation
            const astronaut = document.getElementById('astronaut');
            astronaut.style.transition = 'transform 1.5s ease-in-out';
            astronaut.style.transform = 'translateX(140%)';
        }
    </script>
</body>
</html>
