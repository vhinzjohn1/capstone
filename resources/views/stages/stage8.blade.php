<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <script src="https://kit.fontawesome.com/9a20ced4b7.js" crossorigin="anonymous"></script>

  <style>
    body {
      margin: 0;
      overflow: hidden;
      height: 100vh;
      background-image: url(../img/space2.png);
      background-repeat: no-repeat;
    }

    .card {
      position: absolute;
      height: 85px;
      width: 85px;
      background-color: white;
      border: 1px solid rgb(0, 0, 0);
      color: black;
      display: flex;
      justify-content: center;
      align-items: center;
      cursor: pointer; /* Add cursor pointer for better usability */
    }

    .selected-container {
      position: absolute;
      bottom: 5%;
      left: 50%; /* Adjusted to center horizontally */
      transform: translateX(-50%); /* Center horizontally */
      gap: 10px;
      z-index: 5; /* Lower z-index */
    }

    .items {
      display: flex;
      flex-wrap: wrap;
      gap: 10px;
      padding: 10px;
    }

    .selected-icon {
      font-size: 2em;
      color: white; /* Change the color to black */
      transition: transform 0.5s ease-in-out;
    }

    .bottom-image {
      position: absolute;
      bottom: 0;
      left: 50%;
      transform: translateX(-50%);
      z-index: 10; /* Higher z-index */
    }

    .bottom-image img {
      position: absolute;
      bottom: 0;
      left: 50%;
      transform: translateX(-50%);
      height: 150px; /* Adjusted to make the image slightly smaller */
      width: auto; /* Maintain aspect ratio */
    }

    .card1 { top: 70px; left: 20px; }
    .card2 { top: 90px; left: 140px; }
    .card3 { top: 180px; left: 260px; }
    .card4 { top: 160px; left: 380px; }
    .card5 { top: 360px; left: 500px; }
    .card6 { top: 340px; left: 620px; }
    .card7 { top: 540px; left: 740px; }
    .card8 { top: 500px; left: 860px; }

    h1 {
      position: absolute;
      left: 50%;
      transform: translateX(-50%);
      color: white;
    }
  </style>
</head>
<body>


    {{-- Include the cursor animation --}}
    @include('cursor.cursor-animation')

  <h1>Select 3 Tangents</h1>
  <div class="card card1">1</div>
  <div class="card card2">2</div>
  <div class="card card3">3</div>
  <div class="card card4">4</div>
  <div class="card card5">5</div>
  <div class="card card6">6</div>
  <div class="card card7">7</div>
  <div class="card card8">8</div>

  <div class="selected-container" id="selectedContainer">
    <div class="items" id="selectedItems"></div>
  </div>

  <div class="bottom-image" id="shooterImage">
    <img src="../img/shooter.png" alt="Shooter Image">
  </div>

  <script>
    /* Realtime Rotating Image of the canon below */
    const shooterImage = document.getElementById('shooterImage');

    document.addEventListener('mousemove', function (e) {
      const mouseX = e.clientX;
      const shooterImageRect = shooterImage.getBoundingClientRect();
      const shooterImageX = shooterImageRect.left + shooterImageRect.width / 2;

      const angle = Math.atan2(mouseX - shooterImageX, window.innerHeight) * (180 / Math.PI);

      shooterImage.style.transform = `rotate(${angle}deg)`;
    });

    // Function to generate a random integer between min and max
    function getRandomInt(min, max) {
      return Math.floor(Math.random() * (max - min + 1)) + min;
    }

    // Function to animate card movement
    function moveCard(card, direction) {
      const startPosition = direction === 'left' ? window.innerWidth : -100;
      const endPosition = direction === 'left' ? -100 : window.innerWidth;

      card.style.left = startPosition + 'px';

      const duration = getRandomInt(8000, 12000); // Random duration between 8 and 12 seconds
      const delay = getRandomInt(0, 5000); // Random delay between 0 and 5 seconds

      function animate() {
        const currentTime = new Date().getTime();
        const progress = (currentTime - startTime) / duration;

        if (progress < 1) {
          const currentPosition = startPosition + (endPosition - startPosition) * progress;
          card.style.left = currentPosition + 'px';
          requestAnimationFrame(animate);
        } else {
          // Animation completed, restart it after a delay
          setTimeout(function () {
            moveCard(card, direction);
          }, delay);
        }
      }

      const startTime = new Date().getTime();
      card.addEventListener('click', function () {
        if (!card.getAttribute('data-clicked')) {
          card.setAttribute('data-clicked', 'true');
          moveCardToSelectedContainer(card);
        }
      });
      requestAnimationFrame(animate);
    }

    // Function to move card to selected container
    function moveCardToSelectedContainer(card) {
      const selectedContainer = document.getElementById('selectedContainer');
      const selectedItemsContainer = document.getElementById('selectedItems');
      const selectedIcon = document.createElement('i');
      selectedIcon.className = 'fas fa-square selected-icon';
      selectedContainer.appendChild(selectedIcon);

      const cardRect = card.getBoundingClientRect();
      const selectedIconRect = selectedIcon.getBoundingClientRect();

      const deltaX = cardRect.left - selectedIconRect.left;
      const deltaY = cardRect.top - selectedIconRect.top;

      selectedIcon.style.transform = `translate(${deltaX}px, ${deltaY}px)`;

      setTimeout(function () {
        selectedIcon.style.transform = 'translate(0, 0)';
        card.style.display = 'none'; // Hide the card

        // Append a cloned card to the selected items
        const clonedCard = card.cloneNode(true);
        clonedCard.style.border = '1px solid white'; // Add a border to the cloned card
        selectedItemsContainer.appendChild(clonedCard);
      }, 500);
    }

    document.addEventListener('DOMContentLoaded', function () {
      const cards = document.querySelectorAll('.card');

      cards.forEach(function (card) {
        const direction = Math.random() < 0.5 ? 'left' : 'right'; // Randomly choose left or right
        moveCard(card, direction);
      });
    });
  </script>
</body>
</html
