<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Stage 8</title>
</head>
<body>

  {{-- Include the cursor animation --}}
  @include('cursor.cursor-animation')

  <style>
    body {
      background-image: url(../img/background.png);
      background-size: cover;
      display: flex;
      justify-content: center;
      align-items: center;
    }
  </style>
  <canvas></canvas>
  
  <script src="../js/utils.js"></script>
  <script src="../js/classes/CollisionBlock.js"></script>
  <script src="../js/classes/Sprite.js"></script>
  <script src="../js/classes/Player.js"></script>
  <script src="../js/data/collisions.js"></script>
  <script src="../js/index.js"></script>
  
  
</body>
</html>