
const choices = document.querySelectorAll('.choices');
const dropAreas = document.querySelectorAll('.drop-area');

// Initialize the total coins with a base value
let totalCoins = 100;

// Function to update and display the coin value
function updateCoinValue() {
    const coinValueElement = document.getElementById('coinValue');
    coinValueElement.textContent = totalCoins;
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


// Add a click event listener to the Next button (you can handle the next action here)
const nextButton = document.getElementById('nextButton');
nextButton.addEventListener('click', () => {
    // Handle the next action (e.g., navigate to the next question)
    alert('Next button clicked!'); // Replace this with your desired action
});

// Add an event listener to check for correct answers whenever a choice is dropped
dropAreas.forEach((dropArea) => {
    dropArea.addEventListener('drop', () => {
        // Check for correct answers when a choice is dropped
        showNextButton();
    });
});

