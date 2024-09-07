<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100">

    <!-- Sidebar -->
    <div class="flex min-h-screen">
        <aside class="w-64 bg-blue-900 text-white flex flex-col">
            <div class="p-6">
                <h1 class="text-2xl font-bold">Admin Panel</h1>
            </div>
            <nav class="flex-1 px-4 py-6">
                <ul class="space-y-4">
                    <li>
                        <a href="#" class="flex items-center px-4 py-2 text-lg font-medium rounded hover:bg-gray-700">
                            <i class="fas fa-users mr-3"></i> All Users
                        </a>
                    </li>
                    <li>
                        <a href="/viewbook_admin" class="flex items-center px-4 py-2 text-lg font-medium rounded hover:bg-gray-700">
                            <i class="fas fa-book mr-3"></i> All Books
                        </a>
                    </li>
                    <li>
                        <a href="#" class="flex items-center px-4 py-2 text-lg font-medium rounded hover:bg-gray-700">
                            <i class="fas fa-tags mr-3"></i> Categories
                        </a>
                    </li>
                </ul>
            </nav>
        </aside>

        <!-- Main Content -->
        <div class="flex-1 p-6">
            <header class="flex items-center justify-between pb-6">
                <h2 class="text-3xl font-semibold">Dashboard</h2>
                <button class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">Add New</button>
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
                        <p class="text-2xl font-semibold">123</p>
                    </div>
                </div>

                <!-- Books Card -->
                <div class="bg-white shadow rounded-lg p-6 flex items-center">
                    <div class="w-12 h-12 bg-green-100 text-green-600 flex items-center justify-center rounded-full">
                        <i class="fas fa-book"></i>
                    </div>
                    <div class="ml-4">
                        <h3 class="text-lg font-medium">Total Books</h3>
                        <p class="text-2xl font-semibold">456</p>
                    </div>
                </div>

                <!-- Categories Card -->
                <div class="bg-white shadow rounded-lg p-6 flex items-center">
                    <div class="w-12 h-12 bg-yellow-100 text-yellow-600 flex items-center justify-center rounded-full">
                        <i class="fas fa-tags"></i>
                    </div>
                    <div class="ml-4">
                        <h3 class="text-lg font-medium">Total Categories</h3>
                        <p class="text-2xl font-semibold">78</p>
                    </div>
                </div>
            </section>

            <!-- Table Section -->
            <section>
                <h3 class="text-xl font-semibold mb-4">Recent Activities</h3>
                <div class="bg-white shadow rounded-lg overflow-hidden">
                    <table class="min-w-full bg-white">
                        <thead>
                            <tr class="w-full bg-gray-100 text-left">
                                <th class="py-3 px-6 text-gray-600">ID</th>
                                <th class="py-3 px-6 text-gray-600">Name</th>
                                <th class="py-3 px-6 text-gray-600">Action</th>
                                <th class="py-3 px-6 text-gray-600">Date</th>
                                <th class="py-3 px-6 text-gray-600">Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr class="border-b">
                                <td class="py-4 px-6">1</td>
                                <td class="py-4 px-6">John Doe</td>
                                <td class="py-4 px-6">Added a new book</td>
                                <td class="py-4 px-6">01/09/2024</td>
                                <td class="py-4 px-6">
                                    <span class="bg-green-100 text-green-800 text-xs font-semibold mr-2 px-2.5 py-0.5 rounded">Active</span>
                                </td>
                            </tr>
                            <tr class="border-b">
                                <td class="py-4 px-6">2</td>
                                <td class="py-4 px-6">Jane Smith</td>
                                <td class="py-4 px-6">Updated a category</td>
                                <td class="py-4 px-6">01/09/2024</td>
                                <td class="py-4 px-6">
                                    <span class="bg-blue-100 text-blue-800 text-xs font-semibold mr-2 px-2.5 py-0.5 rounded">Pending</span>
                                </td>
                            </tr>
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
