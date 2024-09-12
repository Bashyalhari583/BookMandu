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
    <style>
        .relative-wrapper {
            position: relative;
            margin-bottom: 1rem;
        }
        .icon {
            display: inline-block;
            position: absolute;
            right: 10px; /* Position from the right edge */
            top: 70%;
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
<div class="box  bg-[url('/public/assets/images/default_the_image_should_feature_astylish_piece_of_furniture_02.png')]  w-full  flex justify-center items-center ">

<div class="box p-4 w-full  flex justify-center items-center  inset-0 bg-black/20 backdrop-blur-md">
<form enctype="multipart/form-data" class=" bg-gray-100  shadow-lg rounded-[15px] border p-5 mx-4 sm:mx-10 md:mx-20 lg:mx-40 flex flex-col gap-4 w-full md:w-[40%]" method="post" action="/register">
        <span class="text-3xl text-center text-blue-900 mb-4">Register to BookMandu</span>
        

        <div class="input-wrapper relative-wrapper">
            <label for="name"><i class="fa fa-user text-xl mr-3" aria-hidden="true"></i>Fullname</label>
            <input value="<?php echo $name ?? '' ?>" type="text" id="name" class="p-2 border bg-gray-200 rounded-lg outline-none focus:outline-gray-400 w-full" name="name" placeholder="Enter the full name" >
            <span id="name-icon" class="icon"></span>
            <span id="name-error" class="error-message"></span>

            <?php if(isset($name_e)){ ?>
            <span class="text-sm text-red-600"><?php echo $name_e ?></span>
            <?php } ?>
        </div>

        <div class="input-wrapper relative-wrapper">
            <label for="email"><i class="fa fa-envelope text-xl mr-3" aria-hidden="true"></i>Email</label>
            <input value="<?php echo $email ?? '' ?>" type="email" id="email" class="p-2 border bg-gray-200 rounded-lg outline-none focus:outline-gray-300 w-full" name="email" placeholder="Enter the email" >
            <span id="email-icon" class="icon"></span>
            <span id="email-error" class="error-message"></span>
            <?php if(isset($email_e)){ ?>
                <span class="text-sm text-red-600"><?php echo $email_e ?></span>
                <?php } ?>
        </div>

        <div class="input-wrapper relative-wrapper">
            <label for="phone"><i class="fa-solid fa-phone text-xl mr-3"></i>Phone</label>
            <input value="<?php echo $phone ?? '' ?>" type="number" id="phone" class="p-2 border bg-gray-200 rounded-lg outline-none focus:outline-gray-400 w-full" name="phone" placeholder="Enter the phone number" >
            <span id="phone-icon" class="icon"></span>
            <span id="phone-error" class="error-message"></span>

            <?php if(isset($phone_e)){ ?>
            <span class="text-sm text-red-600"><?php echo $phone_e ?></span>
            <?php } ?>
        </div>

        <div class="input-wrapper relative-wrapper">
            <label for="password"><i class="fa-solid fa-lock text-xl mr-3"></i>Password</label>
            <input value="<?php echo $password ?? '' ?>" type="password" id="password" class="p-2 border bg-gray-200 rounded-lg outline-none focus:outline-gray-400 w-full" name="password" placeholder="Enter the password" >
            <span id="password-icon" class="icon"></span>
            <span id="password-error" class="error-message"></span>

            <?php if(isset($password_e)){ ?>
            <span class="text-sm text-red-600"><?php echo $password_e ?></span>
            <?php } ?>
        </div>

        <div class="input-wrapper relative-wrapper">
            <label for="confirm_password" class="mt-2"><i class="fa-solid fa-lock text-xl mr-3"></i>Confirm Password</label>
            <input value="<?php echo $confirm_password ?? '' ?>"  type="password" id="confirm_password" class="p-2 border bg-gray-200 rounded-lg outline-none focus:outline-gray-400 w-full" name="confirm_password" placeholder="Enter the password again" >
            <span id="confirm_password-icon" class="icon"></span>
            <span id="confirm_password-error" class="error-message"></span>

            <?php if(isset($confirm_password_e)){ ?>
            <span class="text-sm text-red-600"><?php echo $confirm_password_e ?></span>
            <?php } ?>
        </div>

        <div class="input-wrapper relative-wrapper">
            <label for="profile_pic" class="mt-2"><i class="fa fa-user text-xl mr-3" aria-hidden="true"></i>Profile Picture</label>
            <input   type="file" accept="image/*" id="profile_pic" class="p-2 border bg-gray-200 rounded-lg outline-none focus:outline-gray-400 w-full" name="profile_pic" placeholder="Enter the password again" >
         
            <?php if(isset($profile_pic_e)){ ?>
            <span class="text-sm text-red-600"><?php echo $profile_pic_e ?></span>
            <?php } ?>
        </div>

        <div class="input-wrapper relative-wrapper">
            <label for="confirm_password" class="mt-2">Cover Picture</label>
            <input   type="file" accept="image/*"  id="cover_pic" class="p-2 border bg-gray-200 rounded-lg outline-none focus:outline-gray-400 w-full" name="cover_pic"  >
       
            <?php if(isset($cover_pic_e)){ ?>
            <span class="text-sm text-red-600"><?php echo $cover_pic_e ?></span>
            <?php } ?>
        </div>

        <input class="cursor-pointer bg-blue-700 py-1 px-4 rounded-lg text-white hover:bg-blue-800 active:bg-blue-900" type="submit" value="Register"/>
        <p>Already a User?<a href="/login" class="text-blue-500  hover:text-blue-700 active:text-blue-800">Login here</a></p>
    </form>
</div>

<script>

    //validate email
    document.getElementById('email').addEventListener('input', function() {
        const emailInput = this;
        const emailIcon = document.getElementById('email-icon');
        const emailError = document.getElementById('email-error');
        const emailValue = emailInput.value;
        const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

        if (emailPattern.test(emailValue)) {
            emailIcon.className = 'icon fas fa-circle-check success'; // Green tick
            emailError.className = 'error-message'; // Hide error message
            emailError.textContent = '';
            emailInput.classList.remove('error');
            emailInput.classList.add('success');
        } else {
            emailIcon.className = 'icon fas fa-circle-exclamation error'; // Red exclamation
            emailError.className = 'error-message show'; // Show error message
            emailError.textContent = 'Invalid email address';
            emailInput.classList.remove('success');
            emailInput.classList.add('error');
        }
    });

    //validate username
 document.getElementById('name').addEventListener('input', function() {
        const nameInput = this;
        const nameIcon = document.getElementById('name-icon');
        const nameError = document.getElementById('name-error');
        const nameValue = nameInput.value;
        const namePattern = /^[a-zA-Z\s]{3,}$/; // Name should be at least 3 characters and contain only letters and spaces

        if (namePattern.test(nameValue)) {
            nameIcon.className = 'icon fas fa-circle-check success'; // Green tick
            nameError.className = 'error-message'; // Hide error message
            nameError.textContent = '';
            nameInput.classList.remove('error');
            nameInput.classList.add('success');
        } else {
            nameIcon.className = 'icon fas fa-circle-exclamation error'; // Red exclamation
            nameError.className = 'error-message show'; // Show error message
            nameError.textContent = 'Invalid name.At least 3 characters & contain only letters & spaces.';
            nameInput.classList.remove('success');
            nameInput.classList.add('error');
        }
    });

    //validate phone number
    document.getElementById('phone').addEventListener('input', function() {
        const phoneInput = this;
        const phoneIcon = document.getElementById('phone-icon');
        const phoneError = document.getElementById('phone-error');
        const phoneValue = phoneInput.value;
        const phonePattern = /^[0-9]{10}$/; // Phone number should be exactly 10 digits

        if (phonePattern.test(phoneValue)) {
            phoneIcon.className = 'icon fas fa-circle-check success'; // Green tick
            phoneError.className = 'error-message'; // Hide error message
            phoneError.textContent = '';
            phoneInput.classList.remove('error');
            phoneInput.classList.add('success');
        } else {
            phoneIcon.className = 'icon fas fa-circle-exclamation error'; // Green tick
            phoneError.className = 'error-message show'; // Hide error message
            phoneError.textContent = 'Phone number should be exactly 10 digits';
            phoneInput.classList.remove('success');
            phoneInput.classList.add('error');
        }
    });

 

    //validate password and confirm_password
    //validate password
    
    document.getElementById('password').addEventListener('input', validatePassword);
    document.getElementById('confirm_password').addEventListener('input', validateConfirmPassword);
    document.getElementById('confirm_password').addEventListener('blur', validateConfirmPassword);

    function validatePassword() {
        const passwordInput = document.getElementById('password');
        const passwordIcon = document.getElementById('password-icon');
        const passwordError = document.getElementById('password-error');
        const passwordValue = passwordInput.value;

        // Example pattern for password validation
        const passwordPattern = /^(?=.*[A-Z])(?=.*[a-z])(?=.*\d)(?=.*[\W_]).+$/;
        if (passwordPattern.test(passwordValue)) {
            passwordIcon.className = 'icon fas fa-circle-check success'; // Green tick
            passwordError.className = 'error-message'; // Hide error message
            passwordError.textContent = '';
            passwordInput.classList.remove('error');
            passwordInput.classList.add('success');
        } else {
            passwordIcon.className = 'icon fas fa-circle-exclamation error'; // Red exclamation
            passwordError.className = 'error-message show'; // Show error message
            passwordError.textContent = 'Password must include at least one uppercase letter, one lowercase letter, one digit, and one special character'; //and include at least one letter and one number
            passwordInput.classList.remove('success');
            passwordInput.classList.add('error');
        }
    }

    //validate conform password
    function validateConfirmPassword() {
        const passwordInput = document.getElementById('password');
        const confirmPasswordInput = document.getElementById('confirm_password');
        const confirmPasswordIcon = document.getElementById('confirm_password-icon');
        const confirmPasswordError = document.getElementById('confirm_password-error');
        const passwordValue = passwordInput.value;
        const confirmPasswordValue = confirmPasswordInput.value;

        if (confirmPasswordValue === passwordValue && confirmPasswordValue.length > 0) {
            confirmPasswordIcon.className = 'icon fas fa-circle-check success'; // Green tick
            confirmPasswordError.className = 'error-message'; // Hide error message
            confirmPasswordError.textContent = '';
            confirmPasswordInput.classList.remove('error');
            confirmPasswordInput.classList.add('success');
        } else if (confirmPasswordValue.length > 0) {
            confirmPasswordIcon.className = 'icon fas fa-circle-exclamation error'; // Red exclamation
            confirmPasswordError.className = 'error-message show'; // Show error message
            confirmPasswordError.textContent = 'Passwords do not match';
            confirmPasswordInput.classList.remove('success');
            confirmPasswordInput.classList.add('error');
        } else {
            confirmPasswordIcon.className = 'icon'; // Reset icon when input is empty
            confirmPasswordError.className = 'error-message'; // Hide error message
            confirmPasswordError.textContent = '';
            confirmPasswordInput.classList.remove('error');
            confirmPasswordInput.classList.remove('success');
        }
    }
</script>

</body>
</html>

