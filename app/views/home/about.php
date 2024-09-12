<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About Us</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>

<body class="bg-gray-50">
    <div class="container mx-auto p-8">
        <h1 class="font-bold text-blue-900 text-4xl text-center mb-12">About Us</h1>

        <div class="flex flex-col lg:flex-row items-center gap-10 mb-16">
            <div class="w-full lg:w-1/2 flex justify-center">
                <img class="w-full max-w-md rounded-lg shadow-lg" src="/public/assets/images/aboutus.webp" alt="About Us Image">
            </div>
            <div class="w-full lg:w-1/2">
                <h3 class="text-xl text-blue-900 leading-relaxed">
                    Buy and sell preowned books on Nepal's digital book shop - "Bookmandu Nepal". 
                    Search for your best matching books according to different genres.
                </h3>
            </div>
        </div>

        <h3 class="text-2xl text-blue-900 font-bold text-center mb-10">Our Team Members</h3>
        
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-10">
            <!-- Team Member 1 -->
            <div class="bg-white p-6 rounded-lg shadow-md flex flex-col items-center hover:shadow-xl transition-shadow">
                <img src="/public/assets/images/luna.jpg" class="h-48 w-48 hover:scale-105 transition-transform rounded-full shadow-lg mb-4" alt="Luna Sapkota">
                <h5 class="font-bold text-blue-900 text-lg">Luna Sapkota</h5>
                <p class="text-gray-600">9847433936</p>
                <p class="text-blue-500 font-semibold">Lunasapkota04@gmail.com</p>
            </div>

            <!-- Team Member 2 -->
            <div class="bg-white p-6 rounded-lg shadow-md flex flex-col items-center hover:shadow-xl transition-shadow">
                <img src="/public/assets/images/hari.jpg" class="h-48 w-48 hover:scale-105 transition-transform rounded-full shadow-lg mb-4" alt="Hari Bashyal">
                <h5 class="font-bold text-blue-900 text-lg">Hari Bashyal</h5>
                <p class="text-gray-600">9867341545</p>
                <p class="text-blue-500 font-semibold">hbashyal878@gmail.com</p>
            </div>

            <!-- Team Member 3 -->
            <div class="bg-white p-6 rounded-lg shadow-md flex flex-col items-center hover:shadow-xl transition-shadow">
                <img src="/public/assets/images/debendra.jpg" class="h-48 w-48 hover:scale-105 transition-transform rounded-full shadow-lg mb-4" alt="Debendra Aryal">
                <h5 class="font-bold text-blue-900 text-lg">Debendra Aryal</h5>
                <p class="text-gray-600">9867217368</p>
                <p class="text-blue-500 font-semibold">dipendra07@gmail.com</p>
            </div>
        </div>
    </div>
</body>

</html>



