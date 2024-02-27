Meemli Registration
This is a web application for handling registrations for Meemli Summer Programs.

Features
User Registration: Collects information from users who want to enroll in Meemli Summer Programs.
Database Integration: Stores registration data in a MySQL database.
Confirmation Email: Sends a confirmation email to the user upon successful registration using PHPMailer.
Environment Variables: Utilizes environment variables for sensitive information.
Setup
Clone the Repository:

bash
Copy code
git clone https://github.com/AdamSabry1233/Meemli-Registration.git
Install Dependencies:

bash
Copy code
composer install
Database Setup:

Create a MySQL database and update the database configuration in processForm.php.
Environment Variables:

Create a .env file in the project root and add the following variables:
makefile
Copy code
SMTP_USERNAME=your_smtp_username
SMTP_PASSWORD=your_smtp_password
Run the Application:

Use a PHP server to run the application:
bash
Copy code
php -S localhost:8000
Access the Application:

Open your web browser and go to http://localhost:8000.
Technologies Used
PHP
MySQL
PHPMailer
Composer (for dependency management)
