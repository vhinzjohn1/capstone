
<!-- resources/views/modals/success.blade.php -->

<head>
    <!-- Add a link to your external CSS file -->
    <link rel="stylesheet" href="css/modals.css">
</head>

<div id="successModal" class="modal">
    <div class="modal-content">
        <h3>Stage 1 Completed</h3>
        <h3>CONGRATULATIONS</h3>
        <div class="stars-container">
            <img src="src/images/star.svg" class="modal-star">
            <img src="src/images/star.svg" class="modal-star">
            <img src="src/images/star.svg" class="modal-star">
        </div>
        <a href="{{ route('dashboard') }}" id="okButton" class="continue-btn-a">
            <button class="next-btn"><span class="text">Next</span></button>    
        </a>
    </div>
</div>

<!-- Add this code to your success.blade.php file -->
<script>
    // Get a reference to the "Ok" button
    const okButton = document.getElementById('okButton');

    // Add a click event listener to the "Ok" button
    okButton.addEventListener('click', function (e) {
        e.preventDefault(); // Prevent the default behavior (following the href)

        // Redirect to the dashboard gameContentSection
        window.location.href = "{{ route('dashboard') }}#gameContent";
    });
</script>

