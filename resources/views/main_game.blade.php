<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/main_game.css">
    <script src="https://unpkg.com/@dotlottie/player-component@latest/dist/dotlottie-player.mjs" type="module"></script>
    <title>Main Game</title>
</head>
<body>

    <form action="/update-progress" method="POST">
        @csrf
        <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
        <input type="hidden" name="stage_id" value="2"> <!-- Change this to the appropriate stage ID -->
        <input type="hidden" name="score" id="score" value="100">
        
    <main>

    @include('modals.success')

        <!-- Rocket Animation Lottie -->
        <div class="rocket" id="rocket">
            <dotlottie-player src="./lottie/rocket.json" background="transparent" speed="2" direction="1" mode="normal" loop autoplay></dotlottie-player>
        </div>

        <div class="coin">
            <h3>Coins: <span id="coinValue">100</span></h3>
            <img src="img/coins.png" alt="" srcset="">
        </div>

        <div class="container">
            <div class="instruction">
                <h2>Complete the statement below</h2>
                <img src="img/sample.png" alt="" srcset="">
            </div>

            <!-- Questions Sections -->
            <div class="draggable-container">
                <div class="draggable">
                    <h2>Drag the tangent line here</h2>
                    <div class="drop-area" id="dropArea1" data-correct-answer="choice1"></div>
                </div>

                <div class="draggable">
                    <h2>Drag the secant line here</h2>
                    <div class="drop-area" id="dropArea2" data-correct-answer="choice4"></div>
                </div>
                <!-- Coin Animation Element -->
             <div class="coin-animation" id="coinAnimation"></div>
            </div>
        </div>

        <!-- Choices Section -->
        <div class="choices-container">
            <div class="choices" id="choice1" draggable="true">
                <h2>UV</h2>
            </div>
            <div class="choices" id="choice2" draggable="true">
                <h2>VY</h2>
            </div>
            <div class="choices" id="choice3" draggable="true">
                <h2>XV</h2>
            </div>
            <div class="choices" id="choice4" draggable="true">
                <h2>UY</h2>
            </div>

            <!-- Add the Next button initially hidden -->
        <button class="continue-btn" role="button" id="nextButton" type="submit"><span class="text">Continue</span></button>
        </div>

    </main>

    </form>

    <script>
        const choices = document.querySelectorAll('.choices');
        const dropAreas = document.querySelectorAll('.drop-area');
        const userId = {{ Auth::user()->id }};

        // Initialize the total coins with a base value
        let totalCoins = 100;

        const successMessage = '{{ Session::get('success') }}';
        if (successMessage) {
            // Show the success modal
            const successModal = document.getElementById('successModal');
            successModal.style.display = 'block';

            // Clear the success message from the session to prevent it from showing again on page refresh
            '{{ Session::forget('success') }}';
        }

        // Update the hidden input field for "score"
        const scoreInput = document.getElementById('score');
        scoreInput.value = totalCoins;


        // Function to update and display the coin value
        function updateCoinValue() {
            const coinValueElement = document.getElementById('coinValue');
            coinValueElement.textContent = totalCoins;

            // Update the hidden input field for "score"
            const scoreInput = document.getElementById('score');
            scoreInput.value = totalCoins; // Update the "score" based on total coins
        }

        // Update the coin value initially
        updateCoinValue();

        // Function to show the coin animation
        function showCoinAnimation(animationText) {
            const coinAnimationElement = document.getElementById('coinAnimation');
            coinAnimationElement.textContent = animationText;
            coinAnimationElement.style.opacity = 1;

            // Set a timeout to reset the opacity after a brief delay
            setTimeout(() => {
                coinAnimationElement.style.opacity = 0;
            }, 1000); // Adjust the duration as needed (1 second in this example)
        }

        // Add a function to handle the choice drop
        function handleChoiceDrop(dropArea, choiceElement) {
            // Clear the drop area's content
            dropArea.innerHTML = '';

            // Append the dropped choice element to the drop area
            dropArea.appendChild(choiceElement.cloneNode(true));

            // Check if the dropped choice is correct
            const correctAnswer = dropArea.getAttribute('data-correct-answer');
            if (correctAnswer === choiceElement.id) {
                // Correct answer, change the border color to green
                dropArea.style.borderColor = '#AAFF00';
                handleCorrectAnswerDrop();
            } else {
                // Wrong answer, change the border color to red
                dropArea.style.borderColor = 'red';
                handleCorrectAnswerDrop();

            }
        }

        // Handle the correct answer drop
        function handleCorrectAnswerDrop() {
            const correctDropAreas = Array.from(dropAreas).filter((area) => {
                const correctAnswer = area.getAttribute('data-correct-answer');
                const choiceElement = area.querySelector('.choices');
                return correctAnswer === choiceElement.id;
            });

            const blankDropAreas = Array.from(dropAreas).filter((area) => {
                const choiceElement = area.querySelector('.choices');
                return choiceElement.textContent.trim() === ""; // Check for empty content
            });

            // Calculate the total value based on the number of correct answers and blank areas
            if (correctDropAreas.length === 2) {
                showCoinAnimation('+50');
                // Both answers are correct
                totalCoins = 150;
            } else if (correctDropAreas.length === 1 && blankDropAreas.length === 1) {
                // One answer is correct, one is blank
                totalCoins = 125;
            } else if (correctDropAreas.length >= 1) {
                showCoinAnimation('+25');
                // At least one answer is correct, others may be blank
                totalCoins = 125;
            } else {
                // Both answers are wrong
                totalCoins = 100;
            }

            // Update the coin value display
            updateCoinValue();
        }



        // Add dragstart event listeners to draggable choices
        choices.forEach((choiceElement) => {
            choiceElement.addEventListener('dragstart', (e) => {
                e.dataTransfer.setData('text/plain', choiceElement.id);
                choiceElement.classList.add('dragging');
            });
        });

        // Add dragend event listeners to draggable choices
        choices.forEach((choiceElement) => {
            choiceElement.addEventListener('dragend', () => {
                choiceElement.classList.remove('dragging');
            });
        });

        // Prevent default behavior for drop event
        dropAreas.forEach((dropArea) => {
            dropArea.addEventListener('dragover', (e) => {
                e.preventDefault();
            });

            // Handle the drop event for each drop area
            dropArea.addEventListener('drop', (e) => {
                e.preventDefault();
                const choiceId = e.dataTransfer.getData('text/plain');
                const choiceElement = document.getElementById(choiceId);

                if (choiceElement) {
                    handleChoiceDrop(dropArea, choiceElement);
                }
            });
        });

        // Add a function to check if all answers are correct
        function areAllAnswersCorrect() {
            const correctAnswers = Array.from(dropAreas).every((dropArea) => {
                const correctAnswer = dropArea.getAttribute('data-correct-answer');
                const choiceElement = dropArea.querySelector('.choices');
                return correctAnswer === choiceElement.id;
            });
            return correctAnswers;
        }

        // Function to hide the Next button
        function hideNextButton() {
            const nextButton = document.getElementById('nextButton');
            if (nextButton) {
                nextButton.style.display = 'none';
            }
        }

        // Add a function to show the Next button when all answers are correct
        function showNextButton() {
            const nextButton = document.getElementById('nextButton');
            if (areAllAnswersCorrect()) {
                nextButton.style.display = 'flex';
            } else {
                nextButton.style.display = 'none';
            }
        }


        // Add a variable to track whether the form was successfully submitted
        let formSubmitted = false;

        // Add a click event listener to the Next button
        const nextButton = document.getElementById('nextButton');

        // Add an event listener to check for correct answers whenever a choice is dropped
        dropAreas.forEach((dropArea) => {
            dropArea.addEventListener('drop', () => {
                // Check for correct answers when a choice is dropped
                showNextButton();
            });
        });


    </script>
</body>
</html>
