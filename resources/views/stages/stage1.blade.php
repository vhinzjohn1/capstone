<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/css/stage.css">
    <script src="https://unpkg.com/@dotlottie/player-component@latest/dist/dotlottie-player.mjs" type="module"></script>
    <title>Stage 1</title>
</head>
<body>

    <form id="progressForm">
        @csrf
        <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
        <input type="hidden" name="stage_id" value="2">
        <input type="hidden" name="score" id="score" value="100">
    </form>

    <!-- including the modal for success message-->
    @include('modals.success')

    <main>

        {{-- Stage Number Header --}}
        <h1 class="stage-number">Stage 1</h1>

        <!-- Rocket Animation Lottie -->
        <div class="rocket" id="rocket">
            <dotlottie-player src="../lottie/rocket.json" background="transparent" speed="2" direction="1" mode="normal" loop autoplay></dotlottie-player>
        </div>

        <div class="coin">
            <h3>Coins: <span id="coinValue">100</span></h3>
            <img src="/img/coins.png" alt="" srcset="">
        </div>

        <div class="container">
            <div class="twelve">
                <h1>Please select 3 tangent line below</h1>
            </div>

            <!-- Update the symbols for each choice -->
            <div class="choices">
                <div class="choice" id="choice1" style="background-image: url(../img/wrong2.png);">CHOICE 1</div>
                <div class="choice" id="choice2" style="background-image: url(../img/tangent2.png);">CHOICE 2</div>
                <div class="choice" id="choice3" style="background-image: url(../img/wrong2.png);">CHOICE 5</div>
                <div class="choice" id="choice4" style="background-image: url(../img/secant1.png);">CHOICE 3</div>
                <div class="choice" id="choice5" style="background-image: url(../img/tangent1.png);">CHOICE 6</div>
                <div class="choice" id="choice6" style="background-image: url(../img/secant2.png);">CHOICE 4</div>
                <div class="choice" id="choice7" style="background-image: url(../img/tangent3.png);">CHOICE 7</div>
                <div class="choice" id="choice8" style="background-image: url(../img/secant3.png);">CHOICE 8</div>
            </div>


            <button class="continue-btn" role="button" id="nextButton" type="submit"><span class="text">Continue</span></button>
        </div>

    </main>

    {{-- Jquery Ajax for no-refresh database --}}
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
    <!-- Bootstrap JavaScript -->
    <script src="/js/bootstrap.min.js"></script>

    <script>
        const choices = document.querySelectorAll('.choices .choice');
        let selectedChoices = [];
        let totalCoins = 100; // Initialize the total coins
    
        // Function to update and display the coin value
        function updateCoinValue() {
            const coinValueElement = document.getElementById('coinValue');
            coinValueElement.textContent = totalCoins;
        }
    
        // Function to check if a choice is correct
        function isCorrectChoice(choiceId) {
            return choiceId === 'choice2' || choiceId === 'choice5' || choiceId === 'choice7';
        }
    
        choices.forEach(choice => {
            choice.addEventListener('click', () => {
                const choiceId = choice.id;
    
                if (selectedChoices.length < 3) {
                    if (selectedChoices.includes(choiceId)) {
                        selectedChoices = selectedChoices.filter(id => id !== choiceId);
                    } else {
                        selectedChoices.push(choiceId);
                    }
    
                    choices.forEach(c => c.classList.remove('selected', 'correct', 'wrong'));
                    selectedChoices.forEach(id => {
                        const choiceElement = document.getElementById(id);
                        choiceElement.classList.add('selected');
    
                        const isCorrect = isCorrectChoice(id);
                        if (isCorrect) {
                            choiceElement.classList.add('correct');
                        } else {
                            choiceElement.classList.add('wrong');
                        }
                    });
    
                    // Check if all 3 correct answers are selected
                    if (selectedChoices.length === 3) {
                        const allCorrect = selectedChoices.every(id => isCorrectChoice(id));
    
                        const continueButton = document.getElementById('nextButton');
                        if (allCorrect) {
                            continueButton.style.display = 'flex';
                            totalCoins += 25 * selectedChoices.length; // Add 25 coins for each correct choice
                            updateCoinValue(); // Update the coin value
                        } else {
                            continueButton.style.display = 'none';
                        }
                    } else {
                        const continueButton = document.getElementById('nextButton');
                        continueButton.style.display = 'none';
                    }
                }
            });
        });
    
        const continueButton = document.getElementById('nextButton');
        continueButton.addEventListener('click', () => {
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
