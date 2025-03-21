<!DOCTYPE html>
<html lang="en" id="html-element">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home - Project Management</title>
    <link href="./resources/css/compiled.css" rel="stylesheet">
</head>
<body class="bg-gray-50 text-gray-900 dark:bg-gray-800 dark:text-white">
    <div class="max-w-4xl mx-auto px-4 py-12">
        <header class="text-center mb-8">
            <h2 class="text-3xl font-bold text-blue-600 dark:text-blue-400">Project Management</h2>
            <hr class="my-4 border-gray-300 dark:border-gray-700">
        </header>

        <main>
            <p class="text-lg text-gray-700 dark:text-gray-300">
                This is created with <span class="font-semibold">PHP</span>, <span class="font-semibold">HTML5</span>, <span class="font-semibold">CSS</span>, <span class="font-semibold">JAVASCRIPT</span> and <span class="font-semibold">MySQL</span>.
            </p>
            <p class="text-sm text-gray-500 mt-2 dark:text-gray-400">
                Build started on <span class="font-medium">July 16, 2023</span>
            </p>
        </main>

        <!-- Dark Mode Toggle Button -->
        <div class="flex justify-center mt-6">
            <button id="dark-mode-toggle" class="px-4 py-2 bg-gray-800 text-white rounded-lg focus:outline-none hover:bg-gray-700 dark:bg-gray-400 dark:text-gray-900 dark:hover:bg-gray-500">
                Toggle Dark Mode
            </button>
        </div>
    </div>

    <script>
        // Check if the user has a saved dark mode preference in localStorage
        const darkModeToggle = document.getElementById('dark-mode-toggle');
        const htmlElement = document.documentElement;

        // Set dark mode based on localStorage preference
        if (localStorage.getItem('theme') === 'dark') {
            htmlElement.classList.add('dark');
        } else {
            htmlElement.classList.remove('dark');
        }

        // Toggle dark mode when the button is clicked
        darkModeToggle.addEventListener('click', () => {
            if (htmlElement.classList.contains('dark')) {
                htmlElement.classList.remove('dark');
                localStorage.setItem('theme', 'light'); // Save the preference
            } else {
                htmlElement.classList.add('dark');
                localStorage.setItem('theme', 'dark'); // Save the preference
            }
        });
    </script>
</body>
</html>
