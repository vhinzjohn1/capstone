<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/main_game.css">
    <title>Stage 6</title>
</head>

<body>
    {{-- Include the cursor animation --}}
    @include('cursor.cursor-animation')

    <form id="progressForm">
        @csrf
        <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
        <input type="hidden" name="stage_id" value="7">
        <input type="hidden" name="score" id="score" value="100">
    </form>

    <main>

        <!-- including the modal for success -->
        @include('modals.success')

        <div class="coin">
            <h3>Coins: <span id="coinValue">100</span></h3>
            <img src="../img/coins.png" alt="" srcset="">
        </div>

        <div class="container">
            <div class="instruction">
                <h2>Complete the statement below</h2>
                <img src="../img/stage6.png" alt="" srcset="">
            </div>

            <!-- Questions Sections -->
            <div class="draggable-container">
                <div class="draggable">
                    <h2>Drag the secant line here</h2>
                    <div class="drop-area" id="dropArea1" data-correct-answer="choice1"></div>
                </div>

                <div class="draggable">
                    <h2>Drag the tangent line here</h2>
                    <div class="drop-area" id="dropArea2" data-correct-answer="choice3"></div>
                </div>
                <!-- Coin Animation Element -->
                <div class="coin-animation" id="coinAnimation"></div>
            </div>
        </div>

        <!-- Choices Section -->
        <div class="choices-container">
            <div class="choices" id="choice1" draggable="true">
                <h2>XY</h2>
            </div>
            <div class="choices" id="choice2" draggable="true">
                <h2>YL</h2>
            </div>
            <div class="choices" id="choice3" draggable="true">
                <h2>UL</h2>
            </div>
            <div class="choices" id="choice4" draggable="true">
                <h2>LX</h2>
            </div>

            <!-- Add the Next button initially hidden -->
            <button class="continue-btn" role="button" id="nextButton"><span class="text">Continue</span></button>
        </div>

    </main>


    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
    <!-- Bootstrap JavaScript -->
    <script src="../js/bootstrap.min.js"></script>
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
            scoreInput.value = totalCoins;
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
            }, 1000);
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
                return choiceElement.textContent.trim() === "";
            });

            // Calculate the total value based on the number of correct answers and blank areas
            if (correctDropAreas.length === 2) {
                showCoinAnimation('+50');
                totalCoins = 150;
            } else if (correctDropAreas.length === 1 && blankDropAreas.length === 1) {
                totalCoins = 125;
            } else if (correctDropAreas.length >= 1) {
                showCoinAnimation('+25');
                totalCoins = 125;
            } else {
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

        // Add an event listener to check for correct answers whenever a choice is dropped
        dropAreas.forEach((dropArea) => {
            dropArea.addEventListener('drop', () => {
                showNextButton();
            });
        });

        // Add a variable to track whether the form was successfully submitted
        let formSubmitted = false;

        // Update the click event listener for the "Continue" button
        $('#nextButton').click(function(e) {
            e.preventDefault(); // Prevent the default form submission

            if (!formSubmitted && areAllAnswersCorrect()) {
                formSubmitted = true; // Set the flag to prevent multiple submissions
                const formData = $('#progressForm').serialize();

                $.ajax({
                    type: 'POST',
                    url: '/update-progress',
                    data: formData,
                    success: function(data) {
                        if (data.success) {
                            // Progress updated successfully
                            showSuccessModal();
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error('Error: ' + error);
                        showErrorMessage('An error occurred: ' + error);
                    }
                });
            }
        });


        // Function to show the custom success modal
        function showSuccessModal() {
            // Show the custom success modal
            $('#successModal').modal('show');
        }

        // Function to show an error message
        function showErrorMessage(message) {
            // You can customize this function to display your error message to the user
            // For example, you can display an alert:
            alert('Error: ' + message);
        }
    </script>
</body>

</html>
