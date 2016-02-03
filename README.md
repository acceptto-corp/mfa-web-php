# About

This is a demo project that demonstrates how to integrate your account system (users) with Acceptto multifactor authentication/authorization system.

# Setup & Configuration

If you don't have an Acceptto account and Acceptto mobile application, Download our app and register a new account on it according to this guide:

https://www.acceptto.com/docs/mobile_app

# Register a new application

Go to our Dashboard Login and Sign In with the account you registered on Acceptto's mobile app. Then go to Applications page, Click on the new application button. It will take you to new application page, for each application you want to integrate with Acceptto you should create an application here. New application will have a uid and secret, You can use these values to configure 'client id' and 'client secret' for that application in config/acceptto.yml

You also need to configure your connection string and database settings in config/acceptto.yml. 

# Database

You can just run sql script in db/init.sql. It is tested with MySQL database.

# Configuration

Make sure to set the paths for client_url and client_path correctly on config/routes.php (according to your system paths)
