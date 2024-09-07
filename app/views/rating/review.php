<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rating System</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100 flex items-center justify-center min-h-screen">
    <div class="bg-white p-8 rounded-lg shadow-lg text-center">
        <h1 class="text-2xl font-semibold mb-4">Rate Us</h1>
        <div id="stars" class="flex justify-center mb-4">
            <span data-value="1" class="star text-gray-400 cursor-pointer text-4xl hover:text-yellow-400">&#9733;</span>
            <span data-value="2" class="star text-gray-400 cursor-pointer text-4xl hover:text-yellow-400">&#9733;</span>
            <span data-value="3" class="star text-gray-400 cursor-pointer text-4xl hover:text-yellow-400">&#9733;</span>
            <span data-value="4" class="star text-gray-400 cursor-pointer text-4xl hover:text-yellow-400">&#9733;</span>
            <span data-value="5" class="star text-gray-400 cursor-pointer text-4xl hover:text-yellow-400">&#9733;</span>
        </div>
        <div id="response" class="text-green-500 font-semibold"></div>
    </div>

    <script src="script.js">

document.addEventListener('DOMContentLoaded', () => {
    const stars = document.querySelectorAll('.star');
    stars.forEach(star => {
        star.addEventListener('click', () => {
            const rating = star.getAttribute('data-value');
            stars.forEach(s => s.classList.remove('text-yellow-400'));
            star.classList.add('text-yellow-400');

            // Assuming you have a server endpoint for storing the rating
            fetch('/rating/store', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded',
                },
                body: `rating=${rating}`
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    document.getElementById('response').innerText = 'Thank you for your rating!';
                }
            });
        });
    });
});

    </script>
</body>
</html>

