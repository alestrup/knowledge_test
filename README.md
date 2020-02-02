# Project Title

Knowledge City (Test)

## Getting Started

For this project is necessary to have installed a web development environment with PHP 7.2.25.

### Prerequisites

= Wampp or Xampp ( PHP V7.2.25)

### Installing

There are the steps to run the projects on your local ( WamppServer ).

- Download or clone the project.
- Locate the www folder into the wamppserver's installation folder and move the folders "know" and "know_api" inside it.
- Start your server.
- Open your phpMyAdmin and execute the knowledge_city.sql in order to create the database.
- Create a new database user, with the follow credentials: User: knowledge_user , Password: 7979Knowledge and grant all the permission for the database "knowledge_city".
- Now open "http://localhost/know" and you will see the frontend runs, it is configurated to communicate with the api.

## Running the tests

To test the project you can use the follow user:

User: test_user@gmail.com
Password: 123test123
 
**** If you have problems to communicate with the API , please go to the files "AuthController.php" and "UserController.php" into the path 'know_api/Controllers' and uncommment the 2nd lines. ****
## Authors

* **Armando Garcia** - *Initial work*.

## Observations

I tried doing the projects with a possibilit of scalling them, so i used some best practices and i did not use others but in some parts in the code i mentioned what should be the best practice. I had a little time to do the projecst, so for this reason i did not use all the best practices , but i used the more important that should have an RESTApi.