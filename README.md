# Project Management Tool

The project is organized in a modular way to separate concerns between controllers, models, views, assets, and etc.
```
/project-management
├── /app
│   ├── /Controller
│   │   └── Controller.php
│   ├── /Model
│   │   └── Model.php
│   ├── /Router
│   │   └── Router.php
├── /config
│   └── database.php
├── /public
│   ├── index.php
├── /resources
│   ├── /css
│   │   ├── style.css
│   │   ├── compiled.css
│   ├── /js
│   │   └── core.js
│   ├── /libs
│   │   └── dataTables.js
│   └── /images
│       └── logo.png
├── /routes
│   └── web.php
├── composer.json
├── package.json
└── README.md

```
## How to run
- Step 1: Clone the Repository
```
git clone https://github.com/ljensomo/project-management.git
cd project-management
```
- Step 2: Install Dependencies and Install Node.js
``` 
composer install
npm install
```
- Step 3: Set Up the Web Server
```
php -S localhost:8000 -t public
```
- Step 4: Access the Application
```
If you're using PHP's built-in server, go to: http://localhost:8000
If you're using Apache or Nginx, go to: http://localhost/ (as of now not working)
```