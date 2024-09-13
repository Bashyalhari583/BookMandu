<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css"
        integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />



    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

    <link href="https://fonts.googleapis.com/css2?family=Be+Vietnam+Pro:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">

    <!-- Sidebar -->
    <div class="flex min-h-screen">
        <aside class="w-64 bg-blue-900 text-white flex flex-col">
            <div class="p-6">
            <a href="/">
               <h1 class="text-2xl font-bold">Admin Panel</h1>
               </a> 
            </div>
            <nav class="flex-1 px-4 py-6">
                <ul class="space-y-4">
                <li>
                        <a href="/admin/users" class="flex items-center px-4 py-2 text-lg font-medium rounded hover:bg-gray-700">
                            <i class="fas fa-users mr-3"></i> All Users
                        </a>
                    </li>
                    <li>
                        <a href="/admin/books" class="flex items-center px-4 py-2 text-lg font-medium rounded hover:bg-gray-700">
                            <i class="fas fa-book mr-3"></i> All Books
                        </a>
                    </li>
                    <li>
                        <a href="/admin/reviews" class="flex items-center px-4 py-2 text-lg font-medium rounded hover:bg-gray-700">
                            <i class="fas fa-tags mr-3"></i> Reviews
                        </a>
                    </li>
                </ul>
            </nav>
        </aside>

        <!-- Main Content -->
        <div class="flex-1 p-6">
            <header class="flex items-center justify-between pb-6">
                <h2 class="text-3xl font-semibold">Dashboard</h2>
                <a href="/logout">
                <button class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700"><i class="fa fa-sign-out mr-3"></i>Logout</button>

                </a>
            </header>

            <!-- Cards Section -->
            <section class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 mb-6">
                <!-- Users Card -->
                <div class="bg-white shadow rounded-lg p-6 flex items-center">
                    <div class="w-12 h-12 bg-blue-100 text-blue-600 flex items-center justify-center rounded-full">
                        <i class="fas fa-users"></i>
                    </div>
                    <div class="ml-4">
                        <h3 class="text-lg font-medium">Total Users</h3>
                        <p class="text-2xl font-semibold"><?php echo $user_count ?></p>
                    </div>
                </div>

                <!-- Books Card -->
                <div class="bg-white shadow rounded-lg p-6 flex items-center">
                    <div class="w-12 h-12 bg-green-100 text-green-600 flex items-center justify-center rounded-full">
                        <i class="fas fa-book"></i>
                    </div>
                    <div class="ml-4">
                        <h3 class="text-lg font-medium">Total Books</h3>
                        <p class="text-2xl font-semibold"> <?php echo $book_count ?>     </p>
                    </div>
                </div>

                <!-- Categories Card -->
                <div class="bg-white shadow rounded-lg p-6 flex items-center">
                    <div class="w-12 h-12 bg-yellow-100 text-yellow-600 flex items-center justify-center rounded-full">
                        <i class="fas fa-tags"></i>
                    </div>
                    <div class="ml-4">
                        <h3 class="text-lg font-medium">Total Sold</h3>
                        <p class="text-2xl font-semibold"><?php echo $total_books_sold ?> </p>
                    </div>
                </div>
            </section>

            <!-- Table Section -->
            <section>
                <h3 class="text-xl font-semibold mb-4">Recently Added Books</h3>
                <div class="bg-white shadow rounded-lg overflow-hidden">
                    <table class="min-w-full bg-white">
                        <thead>
                            <tr class="w-full bg-gray-100 text-left">
                                <th class="py-3 px-6 text-gray-600">ID</th>
                                <th class="py-3 px-6 text-gray-600">Name</th>
                                <th class="py-3 px-6 text-gray-600">Location</th>
                                <th class="py-3 px-6 text-gray-600">Price</th>
                                <th class="py-3 px-6 text-gray-600">Date</th>
                                <th class="py-3 px-6 text-gray-600">Status</th>
                            </tr>
                        </thead>
                        <tbody>

                            <?php foreach($books as $book){  ?>
                            <tr class="border-b">
                                <td class="py-4 px-6"><?php echo $book['id'] ?></td>
                                <td class="py-4 px-6"><?php echo $book['name'] ?></td>
                                <td class="py-4 px-6"><?php echo $book['city'] ?></td>
                                <td class="py-4 px-6"><?php echo $book['price'] ?></td>
                                <td class="py-4 px-6"><?php echo $book['created_at'] ?></td>
                               
                                <?php if($book['state']=="active"){ ?>
                                <td class="py-4 px-6">
                                    <span class="bg-green-100 text-green-800 text-xs font-semibold mr-2 px-2.5 py-0.5 rounded">Active</span>
                                </td>
                                <?php } else if($book['state']=="pending"){ ?>
                                
                                <td class="py-4 px-6">
                                    <span class="bg-blue-100 text-blue-800 text-xs font-semibold mr-2 px-2.5 py-0.5 rounded">Pending</span>
                                </td>
                                <?php } else{ ?>
                                <td class="py-4 px-6">
                                    <span class="bg-red-100 text-red-800 text-xs font-semibold mr-2 px-2.5 py-0.5 rounded">Rejected</span>
                                </td>
                                <?php } ?>
                            </tr>
                            <?php }?>
                          
                          
    
                            <!-- More rows -->
                        </tbody>
                    </table>
                </div>
            </section>
        </div>
    </div>

    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
</body>
</html>
