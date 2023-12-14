<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Introduction</title>
    <link rel="stylesheet" href="/css/introduction.css">
    <link href="https://fonts.googleapis.com/css?family=Baloo+2:400,800&display=swap" rel="stylesheet">
    <script src="https://unpkg.com/@dotlottie/player-component@latest/dist/dotlottie-player.mjs" type="module"></script>
    <link rel="stylesheet" href="/dist/css/style.css">
</head>
<body>

    <form id="progressForm">
        @csrf
        <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
        <input type="hidden" name="stage_id" value="1">
        <input type="hidden" name="score" id="score" value="100">
    </form>

    <!-- including the modal for success -->
    @include('modals.success')

    <main class="stage1">


        <div class="message-container">
            <!-- Add this div for the image -->
            <img id="tangentImage" src="../img/tangent-line.png" alt="Tangent Line" class="tangent-img">
            <img id="secantImage" src="../img/secant-line.png" alt="Secant Line" class="secant-img">
    
            <div class="message-section">
                <div class="message">
                    <div class="message-content">
                        <!-- Message Section With typing animation -->
                        <p id="message1"><span></span></p>
                        <button class="next-button" id="nextButton" style="display: none" onclick="changeMessage()">Next</button>
                    </div>
                        {{-- Progress indicator section --}}
                    <div class="progress-indicator">
                        <p id="progress">1/4</p>
                    </div>
                </div>
    
                <div class="astronaut" id="astronaut">
                    <dotlottie-player src="../lottie/astronaut.json" background="transparent" speed="2" direction="1" mode="normal" loop autoplay></dotlottie-player>
                </div>

                

            </div>

        </div>
    </main>


    {{-- Jquery Ajax for no-refresh database --}}
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
    <!-- Bootstrap JavaScript -->
    <script src="/js/bootstrap.min.js"></script>

    <script>
        const messages = [
            "Hey there, ready for a little math adventure?",
            "Today, we're diving into the world of tangent and secant lines!",
            "First up, the **Tangent line**. Think of it as the 'one-point wonder.' It's the line that gently touches a curve at just one point.",
            "The other is **Secant line** - it's the bold one! It doesn't just say 'hi' to the curve; it boldly intersects it at two or more points.",
            "Now you're all set to explore the fascinating world of tangent and secant. Enjoy the adventure!"
        ];
    
        const messageContainer = document.querySelector('.message-content p');
        const cursor = messageContainer.querySelector('span');
        const astronaut = document.getElementById('astronaut');
        const nextButton = document.getElementById('nextButton');
        let currentMessageIndex = 0;
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
    
        function typeText(index, message, cursor) {
            if (index <= message.length) {
                messageContainer.innerHTML = message.substring(0, index);
                cursor.style.left = (index * 12) + 'px';
                setTimeout(function () {
                    typeText(index + 1, message, cursor);
                }, 65); // Adjust the delay to control typing speed
            } else {
                // Typing animation completed
                showNextButton();
            }
        }
    
        function showNextButton() {
            nextButton.style.display = 'block';
        }
    
        function changeMessage() {
            const progressIndicator = document.getElementById('progress');

            if (currentMessageIndex < messages.length - 1) {
                currentMessageIndex++;

                // Update the progress indicator
                const progressValue = `${currentMessageIndex + 1}/${messages.length}`;
                progressIndicator.innerHTML = progressValue;

                messageContainer.innerHTML = '';
                cursor.style.left = '0';
                nextButton.style.display = 'none';
                typeText(0, messages[currentMessageIndex], cursor);
    
                // Move the astronaut to the right using a transform animation
                astronaut.style.transition = 'transform 1.5s ease-in-out';
                astronaut.style.transform = 'translateX(130%)';
                
                if (currentMessageIndex === 2) {
                    // Display the tangent image with animation after a 2-second delay
                    setTimeout(function () {
                        
                        // Trigger the animation after a short delay
                        setTimeout(function () {
                            const tangentImage = document.getElementById('tangentImage');
                            tangentImage.style.display = 'block';
                            tangentImage.classList.add('show');
                        }, 10);
                    }, 2000);
                } else if (currentMessageIndex === 3) {
                    // Hide the tangent image and display the secant image with animation after a 2-second delay
                        const tangentImage = document.getElementById('tangentImage');
                        tangentImage.style.display = 'none';
                        
                    setTimeout(function () {
                        // Trigger the animation after a short delay
                        setTimeout(function () {
                            const secantImage = document.getElementById('secantImage');
                            secantImage.style.display = 'block';
                            secantImage.classList.add('show');
                        }, 10);
                    }, 2000);
                } else if (currentMessageIndex === 4) {
                    // Hide the tangent image and display the secant image with animation after a 2-second delay
                        const secantImage = document.getElementById('secantImage');
                        secantImage.style.display = 'none';

                        // Move the astronaut to the right using a transform animation
                        astronaut.style.transition = 'transform 1.5s ease-in-out';
                        astronaut.style.transform = 'translateX(0.5%)';
                }
            } else if (currentMessageIndex === messages.length - 1) {
            // Add the following Ajax code
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
        }

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

        // Start the typing animation when the page loads
        typeText(0, messages[currentMessageIndex], cursor);
    </script>
</body>
</html>
