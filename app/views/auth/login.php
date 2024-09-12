<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css"
        integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- <link rel="stylesheet" href="/public/css/styles.css"> -->
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
            <label for="email"><i class="fa fa-envelope text-xl mr-3" aria-hidden="true"></i>Email</label>
            <input type="email" id="email" class="p-2 border bg-gray-200 rounded-lg outline-none focus:outline-gray-300 w-full" name="email" placeholder="Enter the email">
            <!-- <span id="email-icon" class="icon"></span>
            <span id="email-error" class="error-message"></span> -->
             </div>

            <div class="input-wrapper relative-wrapper">
            <label for="password"><i class="fa-solid fa-lock text-xl mr-3"></i>Password</label>
            <input type="password" id="password" class="p-2 border bg-gray-200 rounded-lg outline-none focus:outline-gray-400 w-full" name="password" placeholder="Enter the password">
            <!-- <span id="password-icon" class="icon"></span>
            <span id="password-error" class="error-message"></span> -->
            </div>

            <input class="bg-blue-700 py-1 px-4 mt-3 rounded-lg text-white hover:bg-blue-800 active:bg-blue-900" type="submit" value="Login"/>
            <p class="flex justify-center">
                <a href="#" class="text-blue-500 hover:text-blue-700 active:text-blue-800">Forgot password?</a>
            </p>
           
           <p class="flex justify-center">Don't have an account? <a href="/register" class="text-blue-500 hover:text-blue-700 active:text-blue-800">Create One</a></p>
        </form>

    </div>
    </div>
</body>
</html>

