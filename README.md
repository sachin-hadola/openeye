# OpenEye Project Setup Guide
# Requirements

    PHP >= 8.2

# Project Setup Steps:

-    Clone the repository:
     git clone https://github.com/sachin-hadola/openeye.git
 
-    Run the following command to install dependencies:
     composer install

-    Add the .env file (shared via email).

-    Import the openeyes.sql file located in the database folder into your local database.Update the database credentials in the .env file accordingly.

-    Run the project using the following command:
     php artisan serve
     Note: If you're using Laragon or a virtual host, running php artisan serve is not required.

# Completed Features:

-    Created a page to add questions along with their respective answers.

-    Support for creating multiple MCQ-type questions.

-    Followed PSR standards throughout the project.

-    Implemented Eloquent relationships effectively.

-    Applied Laravel's Service and Repository patterns for better structure and maintainability.

# Pending Work:

-    The functionality for handling multiple questions at once is still in progress.I encountered validation issues and time constraints, which prevented completion.

-    Additional time was spent on design adjustments early in the project, which affected overall progress.