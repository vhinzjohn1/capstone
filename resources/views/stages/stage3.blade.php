<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/stage.css">
    <script src="https://unpkg.com/@dotlottie/player-component@latest/dist/dotlottie-player.mjs" type="module"></script>
    <title>Stage 3</title>
    <style>
        /* Add this CSS to style the green border for correct input */
        .correct-input {
            border: 3px solid rgb(78, 241, 78);
        }

        /* Add this CSS to style the red border for incorrect input */
        .incorrect-input {
            border: 3px solid rgb(245, 93, 93);
        }

        .square-input:focus {
            outline: none;
        }

        /* Add CSS transitions for the button */
        .continue-btn {
            transition: all 0.3s ease;
        }
    </style>
</head>
<body>

    {{-- Include the cursor animation --}}
    @include('cursor.cursor-animation')
    
    <form id="progressForm">
        @csrf
        <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
        <input type="hidden" name="stage_id" value="4">
        <input type="hidden" name="score" id="score" value="100">
    </form>

    <!-- including the modal for success message-->
    @include('modals.success')

    <main>
        <!-- Rocket Animation Lottie -->
        <div class="rocket" id="rocket">
            <dotlottie-player src="../lottie/rocket.json" background="transparent" speed="2" direction="1" mode="normal" loop autoplay></dotlottie-player>
        </div>

        <div class="coin">
            <h3>Coins: <span id="coinValue">100</span></h3>
            <img src="/img/coins.png" alt="" srcset="">
        </div>

        <div class="container">
            <div class="message">
                <h3>A line that intersects at one point</h3>

                <div class="square-input-container">
                    <input class="square-input" type="text" maxlength="1" oninput="moveToNextInput(this, 1)">
                    <input class="square-input" type="text" maxlength="1" oninput="moveToNextInput(this, 2)">
                    <input class="square-input" type="text" maxlength="1" oninput="moveToNextInput(this, 3)">
                    <input class="square-input" type="text" maxlength="1" oninput="moveToNextInput(this, 4)">
                    <input class="square-input" type="text" maxlength="1" oninput="moveToNextInput(this, 5)">
                    <input class="square-input" type="text" maxlength="1" oninput="moveToNextInput(this, 6)">
                    <input class="square-input" type="text" maxlength="1" oninput="moveToNextInput(this, 7)">
                </div>
                
            </div>
            
        <!-- Add a hidden button initially -->
        <button class="continue-btn" role="button" id="nextButton" type="submit" style="display: none;"><span class="text">Continue</span></button>

        </div>
    </main>

    {{-- Jquery Ajax for no-refresh database --}}
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
    <!-- Bootstrap JavaScript -->
    <script src="/js/bootstrap.min.js"></script>

    <script>
        let coinValue = 100;

        function moveToNextInput(currentInput, index) {
            const answer = 'tangent';
            const inputText = currentInput.value.toLowerCase();
            
            if (inputText === answer.charAt(index - 1)) {
                currentInput.classList.remove('incorrect-input');
                currentInput.classList.add('correct-input'); // Change border to green
            } else {
                currentInput.classList.remove('correct-input');
                currentInput.classList.add('incorrect-input'); // Change border to red
            }
            
            if (inputText.length === 1) {
                if (index < 7) {
                    const nextInput = document.getElementsByClassName('square-input')[index];
                    nextInput.focus();
                }
                checkAllInputs();
            }
        }

        document.addEventListener('keydown', function (event) {
            if (event.key === 'Backspace') {
                const activeInput = document.activeElement;
                const inputs = document.getElementsByClassName('square-input');
                for (let i = 0; i < inputs.length; i++) {
                    if (activeInput === inputs[i] && i > 0) {
                        if (activeInput.value) {
                            activeInput.value = '';
                            coinValue = 100; // Reset the coin value to 100
                        } else {
                            inputs[i - 1].focus();
                        }
                        activeInput.classList.remove('correct-input', 'incorrect-input');
                        checkAllInputs();
                        break;
                    }
                }
            }
        });

        function checkAllInputs() {
            const inputs = document.getElementsByClassName('square-input');
            let allCorrect = true;

            for (let i = 0; i < inputs.length; i++) {
                if (inputs[i].value.toLowerCase() !== 'tangent'.charAt(i)) {
                    allCorrect = false;
                    break;
                }
            }

            if (allCorrect) {
                coinValue = 200; // Set the coin value to 100
                document.getElementById('nextButton').style.display = 'flex'; // Show the button
            } else {
                document.getElementById('nextButton').style.display = 'none'; // Hide the button
            }

            // Update the displayed coin value
            document.getElementById('coinValue').textContent = coinValue;
        }

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
