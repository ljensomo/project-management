<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Projects</title>
    <?php include_once APP_ROOT . '/resources/views/includes/stylesheet.html' ?>
</head>
<body class="p-5 bg-white dark:bg-gray-900 antialiased !p-0">
<?php 
    include_once APP_ROOT . '/resources/views/includes/topbar.php';
    include_once APP_ROOT . '/resources/views/includes/sidebar.php'
?>
    <div class="p-4 sm:ml-64">
        <div class="p-4 mt-14">
            <div class="mb-2 flex flex-wrap items-center justify-between space-y-2">
                <div>
                    <h2 class="text-2xl text-gray-900 font-bold tracking-tight dark:text-white">Projects List</h2>
                    <p class="text-gray-500 dark:text-gray-400">Manage your projects here.</p>
                </div>
                <div class="flex gap-2">
                    <button type="button" class="flex items-center text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">
                        <svg class="w-6 h-6 text-white mr-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 12h14m-7 7V5"/>
                        </svg>
                    <span>Add Project</span>
                    </button>
                </div>
            </div>
            <div class="p-4 rounded-lg border border-gray-200 dark:border-gray-700">
                <table id="projectTable">
                    <thead>
                        <tr>
                            <th>Project ID</th>
                            <th>Project Name</th>
                            <th>Phase</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>
<?php include_once APP_ROOT . '/resources/views/includes/script.html' ?>
</html>