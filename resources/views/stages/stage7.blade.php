<!DOCTYPE html>
<!-- Coding By CodingNepal - youtube.com/codingnepal -->
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">  
    <title>Memory Card Game</title>
    <link rel="stylesheet" href="../stage-css/style.css">
    <script src="https://unpkg.com/@dotlottie/player-component@latest/dist/dotlottie-player.mjs" type="module"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
  </head>
  <body>

    <!-- Rocket Animation Lottie -->
    <div class="rocket" id="rocket">
      <dotlottie-player src="../lottie/rocket.json" background="transparent" speed="2" direction="1" mode="normal" loop autoplay></dotlottie-player>
  </div>

    <div class="wrapper">
      <ul class="cards">
        <li class="card">
          <div class="view front-view">
            <img src="../img/que_icon.svg" alt="icon">
          </div>
          <div class="view back-view">
            <img src="../img/img-1.png" alt="card-img">
          </div>
        </li>        
        <li class="card">
          <div class="view front-view">
            <img src="../img/que_icon.svg" alt="icon">
          </div>
          <div class="view back-view">
            <img src="../img/img-2.png" alt="card-img">
          </div>
        </li>
        <li class="card">
          <div class="view front-view">
            <img src="../img/que_icon.svg" alt="icon">
          </div>
          <div class="view back-view">
            <img src="../img/img-3.png" alt="card-img">
          </div>
        </li>
        <li class="card">
          <div class="view front-view">
            <img src="../img/que_icon.svg" alt="icon">
          </div>
          <div class="view back-view">
            <img src="../img/img-4.png" alt="card-img">
          </div>
        </li>
        <li class="card">
          <div class="view front-view">
            <img src="../img/que_icon.svg" alt="icon">
          </div>
          <div class="view back-view">
            <img src="../img/img-5.png" alt="card-img">
          </div>
        </li>
        <li class="card">
          <div class="view front-view">
            <img src="../img/que_icon.svg" alt="icon">
          </div>
          <div class="view back-view">
            <img src="../img/img-6.png" alt="card-img">
          </div>
        </li>
        <li class="card">
          <div class="view front-view">
            <img src="../img/que_icon.svg" alt="icon">
          </div>
          <div class="view back-view">
            <img src="../img/img-5.png" alt="card-img">
          </div>
        </li>
        <li class="card">
          <div class="view front-view">
            <img src="../img/que_icon.svg" alt="icon">
          </div>
          <div class="view back-view">
            <img src="../img/img-6.png" alt="card-img">
          </div>
        </li>
        <li class="card">
          <div class="view front-view">
            <img src="../img/que_icon.svg" alt="icon">
          </div>
          <div class="view back-view">
            <img src="../img/img-1.png" alt="card-img">
          </div>
        </li>
        <li class="card">
          <div class="view front-view">
            <img src="../img/que_icon.svg" alt="icon">
          </div>
          <div class="view back-view">
            <img src="../img/img-2.png" alt="card-img">
          </div>
        </li>
        <li class="card">
          <div class="view front-view">
            <img src="../img/que_icon.svg" alt="icon">
          </div>
          <div class="view back-view">
            <img src="../img/img-3.png" alt="card-img">
          </div>
        </li>
        <li class="card">
          <div class="view front-view">
            <img src="../img/que_icon.svg" alt="icon">
          </div>
          <div class="view back-view">
            <img src="img/img-4.png" alt="card-img">
          </div>
        </li>
        <div class="details">
          <p class="time">Time: <span><b>20</b>s</span></p>
          <p class="flips">Flips: <span><b>0</b></span></p>
          <p class="matches">Matches: <span><b>0</b>/6</span></p>
          <button>Refresh</button>
        </div>
      </ul>
    </div>

    <div class="right-section">
      <div class="container">
        <div class="row">
          <div class="col-md-12 text-center">
            <h3 class="animate-charcter">Tanget and Secant Card Game</h3>
          </div>
        </div>
      </div>
    </div>



    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="script.js"></script>
    
  </body>
</html>