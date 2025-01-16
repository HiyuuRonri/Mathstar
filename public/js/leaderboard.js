var highScores = []; // Array to store leaderboard data

// Function to fetch and display leaderboard data
function fetchAndDisplayLeaderboard() {
    fetch('/leaderboard')
        .then(response => response.json())
        .then(data => {
            const leaderboard = document.querySelector('.leaderboard');
            leaderboard.innerHTML = '<h2>LEADERBOARD</h2>';
            data.forEach((entry, index) => {
                const row = `<p>${index + 1}. ${entry.username}: ${entry.score}</p>`;
                leaderboard.innerHTML += row;
            });
        })
        .catch(error => console.error('Error fetching leaderboard:', error));
}

// Called by Unity to update the leaderboard
window.UpdateLeaderboard = function (newScore) {
    const username = window.username; // Replace with dynamic user data if available

    // Save the score in the backend
    fetch('/leaderboard', {
        method: 'POST',
        headers: { 
          'Content-Type': 'application/json',
          'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'), // CSRF token
         },
        body: JSON.stringify({ username: username, score: newScore }),
    }).then(() => {
        // Refresh leaderboard display after posting new score
        fetchAndDisplayLeaderboard();
    }).catch(error => console.error('Error saving score:', error));
};

// Fetch and display the leaderboard when the page loads
document.addEventListener('DOMContentLoaded', fetchAndDisplayLeaderboard);
