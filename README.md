# Social_media_clone_TWEET
# Table of Contents
1.Introduction
2.System Requirements
3.Setup and Installation
4.Features and Functionality
5.Screenshots and Explanations
6.Directory structure
7.Troubleshooting
8.Conclusion
# Introduction
This project is a database-backed clone of social media platforms like Twitter and Parler. Built using PHP and MySQL, it allows users to create accounts, post tweets, follow other users, and like tweets. The goal of this project is to replicate key functionalities of a social media platform in a simplified manner.
# System Requirements
To run this project, you need:
Web Server: Apache or Nginx
Database: MySQL
Programming Language: PHP (version 7.4 or higher recommended)
Tools: NetBeans for development, Git for version control
# Setup and Installation
1. Clone the Repository
First, clone the project repository from GitHub:
git clone https://github.com/Social_media_clone_TWEET.git
2.Configure the Database
a. Create the Database
Log in to MySQL
Create a new database:
CREATE DATABASE social_media;
USE social_media;

Import the schema from database_schema.sql (included in the repository):
b. Update Database Configuration
Edit config.php to match your database credentials.
<?php
$servername = "localhost";
$username = "root"; // Change as needed
$password = ""; // Change as needed
$dbname = "social_media";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>


# Features and Functionality
1. User Authentication
Login: Users can log in with their username and password.
Registration: Users can register a new account by providing a username and password.
2. User Profile
View Profile: Users can view their own profile or other users' profiles, which shows their tweets and stats.
Follow/Unfollow: Users can follow or unfollow other users directly from their profile page.

3. Tweet Management
Create Tweet: Users can create new tweets with optional image uploads.
View Tweets: Users can see tweets from the users they follow.
Like Tweets: Users can like tweets to show their appreciation.
4. Additional Features
Show Following: Users can view lists  the users they are following.

# Screenshots and Explanations
1. Login Screen
Description: The login page where users enter their credentials to access their account.
Username Field: Input field where users enter their username.
Password Field: Input field where users enter their password.
Login Button: Submits the login form.


2. Registration Screen
Description: Allows new users to create an account.
Username Field: Input field for the new user's username.
Password Field: Input field for the new user's password.
Register Button: Submits the registration form.


3. User Profile
Description: Displays user profile information including statistics and tweets.
Profile Stats: Shows the number of followers, following, and posts.
Follow/Unfollow Button: Allows users to follow /unfollow the profile owner.
Tweets Section: Displays the user's tweets with options to like.

4. Create Tweet
Description: Form for creating a new tweet.
Tweet Content: Textarea for entering the tweet content.
Image Upload: Option to upload an image with the tweet.
Tweet Button: Submits the tweet.

5. Tweets Feed
Description: Displays tweets from users the current user follows.
Tweet Content: Shows the content of each tweet.
Like Button: Allows users to like a tweet.


6. Follow/Unfollow List
Description: Shows suggested users that the current user might want to follow.
Username: Displays suggested usernames.
View Button: Links to the profile page of the suggested user.


7. Error Handling
Description: Displays an error message when something goes wrong..
Back to home : Button to navigate to home page when something goes wrong.








#Directory Structure


config.php
Contains database connection settings.
index.php
Handles the display of tweets and the tweet creation form.
user_profile.php and profile.php
Displays user profile details including statistics and tweets.
follow.php
Manages follow and unfollow actions.
like.php
Handles liking tweets.
login.php
Handles user login.
logout.php
Handles user logout.
register.php
Handles user registration.
error.php
Displays an error message when something goes wrong.

# Troubleshooting
Common Issues
Database Connection Errors: Ensure config.php has the correct database credentials.
File Upload Errors: Verify permissions on the images/directory and file upload settings in php.ini.
PHP Errors: Check the PHP error log for detailed error messages.
Tips
Ensure Permissions: Make sure your web server has write permissions for the images/ directory.
Check Logs: Review server and PHP logs for troubleshooting.
# Conclusion
This project offers a basic yet functional social media platform clone. The documentation provided here outlines the setup, features, and detailed explanations of each component. For further development, consider adding features such as direct messaging or advanced user analytics.
