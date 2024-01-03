# Hotel-Booking-PHP

Description:
This PHP project implements a simple Hotel Booking System using a MySQL database. Users can sign up, log in, search for hotels, book rooms, and view their booking history.

Files and their Code:

signup.php :
Handles user registration
Inserts user details into the MySQL database

login.php :
Manages user login
Validates user credentials against the database

logout.php :
Logs out the user by destroying the session

home.php :
Displays a welcome message to logged-in users
Allows users to search for hotels
Shows search results and provides links to book a hotel or view bookings
Includes a logout option

booknow.php :
Allows users to book a hotel room
Retrieves hotel details and handles booking form submissions
Inserts booking details into the database

mybooking.php :
Displays a list of bookings for the logged-in user
Retrieves and displays booking details from the database


Database Configuration:

Database Name: mydb
Database Tables: users, hotels, user_bookings

How to Run:
Set up a MySQL database named mydb
Import the SQL schema provided in the database_schema.sql file
Update database connection details in each PHP file (replace placeholders with your credentials)
Host the project on a PHP-enabled server

Dependencies:
PHP (with MySQLi extension enabled)
MySQL Database

Usage:
Access signup.php to create a new user account
Log in using login.php
Search for hotels and book a room on home.php
View your bookings on mybooking.php
Logout using logout.php

Note:
This project is a basic implementation and may require enhancements for production use, such as input validation, error handling, and security measures.

Author:
Muhammad Sowban

Contact:

LinkedIn: https://www.linkedin.com/in/muhammad-sowban-a60ba91a1/
