<!DOCTYPE html>
<html lang="en">

<?php



?>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css"
        integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- <link rel="stylesheet" href="/public/css/styles.css"> -->

    <style>
        .relative-wrapper {
            position: relative;
            margin-bottom: 1rem;
        }
        .icon {
            width: 20px;
            height: 20px;
            display: inline-block;
            position: absolute;
            right: 10px; /* Position from the right edge */
            top: 75%;
            transform: translateY(-50%);
            pointer-events: none; /* Prevent interaction with the icon */
        }
        .icon.success {
            color: green;
        }
        .icon.error {
            color: red;
        }
        .error-message {
            display: none;
            color: red;
            font-size: 0.875rem;
            margin-top: 2px;
            position: absolute;
            left: 0;
            top: calc(100% + 4px);
        }
        .error-message.show {
            display: block;
        }
        .input-wrapper {
            position: relative;
            margin-bottom: 1rem;
        }
        .input-wrapper label {
            display: block;
            margin-bottom: 0.25rem;
            font-weight: 500;
            color: #374151;
        }
        .input-wrapper input {
            width: 100%;
            padding-right: 40px; /* Space for the icon */
            border: 1px solid #d1d5db;
            transition: border-color 0.3s ease;
            background-color: #e5e7eb;
            padding: 0.5rem;
            border-radius: 0.375rem;
        }
        .input-wrapper input.error {
            border-color: red;
        }
        .input-wrapper input.success {
            border-color: green;
        }
        .input-wrapper input.error:focus,
        .input-wrapper input.error:hover {
            outline: 2px solid red;
            outline-offset: 2px;
        }
        .input-wrapper input.success:focus,
        .input-wrapper input.success:hover {
            outline: 2px solid green;
            outline-offset: 2px;
        }
    </style>
</head>

<body>

    <!-- <div class="box bg-[url('/public/assets/images/default_the_image_should_feature_astylish_piece_of_furniture_02.png')] h-[100vh] w-full  flex backdrop-blur-lg justify-center items-center "> -->
<div class="box  bg-[url('/public/assets/images/default_the_image_should_feature_astylish_piece_of_furniture_02.png')] h-[100vh] w-full  flex justify-center items-center ">

<div class="box h-[100vh] w-full flex justify-center items-center absolute inset-0 bg-black/20 backdrop-blur-md">
        <form class="bg-gray-100 rounded-[15px] border p-5 mx-[450px] my-36 flex flex-col gap-5 w-[35%] " method="post" action="/login">
            <span class="text-3xl text-center text-blue-900">Login to BookMandu</span>

            <?php if(isset($error)){?>
            <span class="text-sm text-red-600"><?php echo $error ?></span>
            <?php } ?>

            <div class="input-wrapper relative-wrapper">
            <label for="email">Email</label>
            <input type="email" id="email" class="p-2 border bg-gray-200 rounded-lg outline-none focus:outline-gray-300 w-full" name="email" placeholder="Enter the email">
            <span id="email-icon" class="icon"></span>
            <span id="email-error" class="error-message"></span>
             </div>

            <div class="input-wrapper relative-wrapper">
            <label for="password">Password</label>
            <input type="password" id="password" class="p-2 border bg-gray-200 rounded-lg outline-none focus:outline-gray-400 w-full" name="password" placeholder="Enter the password">
            <span id="password-icon" class="icon"></span>
            <span id="password-error" class="error-message"></span>
            </div>

            <input class="bg-blue-700 py-1 px-4 mt-3 rounded-lg text-white hover:bg-blue-800 active:bg-blue-900" type="submit" value="Login"/>
           
           <p>Don't have an account? <a href="/register" class="text-blue-500 hover:text-blue-700 active:text-blue-800">Create One</a></p>
        </form>

    </div>
    </div>
</body>
</html>

