document.addEventListener('DOMContentLoaded', function () {
    let questionIndex = 1; // Start from the second question
    const addQuestionButton = document.getElementById('add-question');
    const questionsContainer = document.getElementById('questions-container');

    // Add new question functionality
    addQuestionButton.addEventListener('click', function () {
        const newQuestion = document.createElement('div');
        newQuestion.classList.add('question');
        newQuestion.setAttribute('data-index', questionIndex);

        newQuestion.innerHTML = `
            <h5>Question ${questionIndex + 1}</h5>
            <div class="form-group">
                <input type="text" name="questions[${questionIndex}][question_text]" class="form-control" placeholder="Enter the question text" required>
            </div>

            <div class="form-check">
                <input type="radio" name="questions[${questionIndex}][is_correct]" value="1" class="form-check-input" required>
                <label class="form-check-label">True</label>
            </div>
            <div class="form-check">
                <input type="radio" name="questions[${questionIndex}][is_correct]" value="0" class="form-check-input" required>
                <label class="form-check-label">False</label>
            </div>

            <!-- Delete Button -->
            <button type="button" class="btn btn-danger btn-sm mt-2 delete-question">Delete</button>
        `;

        questionsContainer.appendChild(newQuestion);
        questionIndex++;

        // Delete question functionality
        const deleteButton = newQuestion.querySelector('.delete-question');
        deleteButton.addEventListener('click', function () {
            newQuestion.remove(); // Remove the question from DOM
        });
    });
});
