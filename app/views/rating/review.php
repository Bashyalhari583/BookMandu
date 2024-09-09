

<div class="bg-gray-100 flex items-center justify-center min-h-screen">
    <div class="bg-white p-6 rounded-lg shadow-md">
        <form action="save_rating.php" method="POST" class="rating-form">
            <input type="hidden" name="book_id" value="1"> <!-- Replace with dynamic book ID -->
            <div class="stars flex flex-row-reverse justify-center space-x-reverse space-x-2 mb-4">
                <input type="radio" id="star5" name="rating" value="5" class="hidden" />
                <label for="star5" class="text-2xl text-gray-400 cursor-pointer hover:text-yellow-500 transition">&#9733;</label>
                
                <input type="radio" id="star4" name="rating" value="4" class="hidden" />
                <label for="star4" class="text-2xl text-gray-400 cursor-pointer hover:text-yellow-500 transition">&#9733;</label>
                
                <input type="radio" id="star3" name="rating" value="3" class="hidden" />
                <label for="star3" class="text-2xl text-gray-400 cursor-pointer hover:text-yellow-500 transition">&#9733;</label>
                
                <input type="radio" id="star2" name="rating" value="2" class="hidden" />
                <label for="star2" class="text-2xl text-gray-400 cursor-pointer hover:text-yellow-500 transition">&#9733;</label>
                
                <input type="radio" id="star1" name="rating" value="1" class="hidden" />
                <label for="star1" class="text-2xl text-gray-400 cursor-pointer hover:text-yellow-500 transition">&#9733;</label>
            </div>
            <button type="submit" class="w-full bg-blue-500 text-white py-2 rounded-md hover:bg-blue-600 transition">Submit Rating</button>
        </form>
        <div id="feedback" class="mt-4 text-center"></div> <!-- Feedback message container -->
    </div>

</div>


<script>
        document.addEventListener('DOMContentLoaded', function() {
            const form = document.querySelector('.rating-form');
            const stars = document.querySelectorAll('.stars input');
            const labels = document.querySelectorAll('.stars label');
            const feedback = document.getElementById('feedback'); // Feedback element

            // Highlight stars based on selection
            stars.forEach(input => {
                input.addEventListener('change', function() {
                    // Highlight selected stars
                    labels.forEach(label => {
                        label.classList.toggle('text-yellow-500', label.htmlFor <= 'star' + this.value);
                        label.classList.toggle('text-gray-400', label.htmlFor > 'star' + this.value);
                    });
                });
            });

            // AJAX form submission
            form.addEventListener('submit', function(e) {
                e.preventDefault();
                
                const formData = new FormData(form);
                
                fetch('save_rating.php', {
                    method: 'POST',
                    body: new URLSearchParams(formData)
                })
                .then(response => response.text())
                .then(data => {
                    feedback.innerHTML = '<p class="text-green-500 font-semibold">Rating submitted successfully!</p>';
                })
                .catch(error => {
                    feedback.innerHTML = '<p class="text-red-500 font-semibold">Failed to submit rating. Please try again.</p>';
                    console.error('Error:', error);
                });
            });
        });
    </script>