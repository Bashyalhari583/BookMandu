<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css"
        integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />



    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

    <link href="https://fonts.googleapis.com/css2?family=Be+Vietnam+Pro:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
 
    <link rel="stylesheet" href="/public/css/styles.css">

    <style>
        #profile:hover+.profile_info_float {
            display: block;
        }

        .profile_info_float:hover {
            display: block;
        }
    </style>

</head>

<body class="">
    <header
        class="navbar z-50 bg-white fixed top-0 left-0 w-full px-4 md:px-8 border shadow-lg h-18 flex items-center justify-between">

        <div class="ml-16 logo_name flex items-center space-x-4">
            <i class="drawer md:hidden fa fa-bars text-xl text-gray-700 px-2 hover:bg-gray-300 active:bg-gray-400 rounded-lg cursor-pointer"
                aria-hidden="true"></i>

            <a href="/" class="text-3xl font-bold text-blue-900">BookMandu</a>
        </div>

        <div class="phoneNav hidden z-50 fixed top-0 left-0 h-full w-2/3 sm:w-1/2 bg-gray-100 rounded-lg p-6 shadow-lg md:hidden">
            <ul class="flex flex-col gap-4">
            <?php if ($auth) { ?> <li class="p-2 hover:bg-gray-300 active:bg-gray-400 rounded-lg"><a href="/profile/">Profile</a></li> <?php }?>
                <li class="p-2 hover:bg-gray-300 active:bg-gray-400 rounded-lg"><a href="/login">Login</a></li>
                <li class="p-2 hover:bg-gray-300 active:bg-gray-400 rounded-lg"><a href="/register">Sign Up</a></li>
                <li class="p-2 hover:bg-gray-300 active:bg-gray-400 rounded-lg"><a href="/books">Add Books</a></li>
            <?php if ($auth) { ?> <li class="p-2 hover:bg-gray-300 active:bg-gray-400 rounded-lg"><a href="/messages">Message</a></li> <?php }?>
            <?php if ($auth) { ?>  <li class="p-2 hover:bg-gray-300 active:bg-gray-400 rounded-lg"><a href="/logout">Logout</a></li> <?php }?>
                

            </ul>
        </div>

       

        <div class="authbtn hidden md:flex items-center gap-8 text-lg text-blue-900">
            <?php if (!$auth) { ?>
                <div> 
                <a class="hover:text-black" href="/register">Sign Up</a>
                </div>
                <div> 
                <a class="hover:text-black" href="/login">Login</a>
                </div>
                <button class="mx-16 sellbtn hidden md:block bg-blue-900 text-white p-2 rounded-lg hover:bg-blue-800 active:bg-blue-700"><a class=" mx-2" href="/books">Add Books</a></button>
                
            <?php } else { ?>
                <a class="hover:text-blue-800" href="/messages">Message</a>
                <!-- <i class="fa-solid fa-message text-2xl text-blue-900 pl-20"></i>M -->
                
                <a href="/profile/" id="profile" class="hover:text-black flex items-center gap-2 mr-24">
                    <!-- <?php echo $user->photo ?> -->
                    <div class="profile_image relative ">
                        <img class="h-[50px] w-[50px] rounded-full hover:opacity-80" src="/public/uploads/<?php echo $user->profile_pic ?>" alt="">
                        <div class="profile_info_float hidden absolute top-[100%] left-0 bg-white mr-20 rounded-lg p-4">
                        
                            <a href="/profile/">Profile</a><br>
                            <a class="hover:text-black" href="/logout">Logout</a>

                        </div>
                    </div>
                    <!-- <i class="fa-solid fa-user text-3xl text-blue-900 hover:text-blue-600 active:text-blue-500"></i> -->
            </a>
            <?php } ?>
            </div>

        <!-- <button class="mx-16 sellbtn hidden md:block bg-blue-900 text-white p-2 rounded-lg"><a class="hover:text-black mx-2" href="/books">Sell Book</a></button> -->
    </header>

    <script>
        const drawerIcon = document.querySelector('.drawer');
        const phoneNav = document.querySelector('.phoneNav');

        drawerIcon.addEventListener('click', () => {
            phoneNav.classList.toggle('hidden');
        });


        function focusSearchBook() {
        const searchBook = document.getElementById('search_book');
        searchBook.focus(); // Set focus to the search book
    }
    </script>

    <div class="mt-20">