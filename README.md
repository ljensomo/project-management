# Project Management Tool

## Project Structure

The project is organized in a modular way to separate concerns between controllers, models, views, assets, and etc.

/project-management
├── /assets
│   ├── /css
│   │   └── style.css                     
│   ├── /js
│   │   ├── /core
│   │   │   └── main.js                   
│   │   ├── /modules
│   │   │   ├── backup.js                 
│   │   │   ├── user.js                   
│   │   │   └── categories.js             
│   │   └── /libs
│   │       └── dataTables.js             
│   └── /images
│       └── logo.png                      
├── /config
│   └── database.php                      
├── /controllers
│   ├── BackupController.php              
│   ├── UserController.php                
│   └── CategoryController.php            
├── /models
│   ├── Backup.php                        
│   ├── User.php                          
│   └── Category.php                      
├── /views
│   ├── /backup
│   │   └── index.php                     
│   ├── /user
│   │   └── index.php                     
│   └── /categories
│       └── index.php                     
├── index.php             
└── README.md                             
