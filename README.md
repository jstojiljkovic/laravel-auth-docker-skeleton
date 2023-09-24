# API Documentation

The point of this repository is to be always up to date with Laravel and have basic Passport auth ready to go for any project, there are 2 branches from which you can choose to start a project:
1. ```feature/regular-auth``` - as the name says the basic auth using Passport and personal tokens with email/username and password
2. ```feature/social-auth``` - using Laravel Socialite and providing both the above point and logging with all the logging providers which Laravel Socialite provides

# Configuration

Before API usage, please rename `.env.example` into `.env` (and populate it based on the command outputs)

As this is dockerized all you have to do is run the following commands and finish the setup:

1. Install all the dependencies
```bash
composer install
```
2. Run all the migrations
```bash
./vendor/bin/sail php artisan migrate
```
3. Execute the following command which will create the encryption keys needed to generate secure access tokens. In addition, the command will create “personal access” and “password grant” clients which will be used to generate access tokens:
```bash
./vendor/bin/sail php artisan passport:install
```
4. To start all the Docker containers in the background, you may start Sail in "detached" mode
```bash
./vendor/bin/sail up -d
```

You can pull out the Postman collection which is at the root of the application named `instatch-api.postman_collection`
