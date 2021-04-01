# Blog App

## Features

* Guest area:
    * List posts
    * View post
    * View Author
* Auth area:
    * User authentication (Register/Login)
    * Email verification
    * Write post
    * Edit post
    * Delete post
    * Post counter
    * Edit profile
    * Delete account

### Run app localy

1. Clone Blog App project
2. Create database with name ``` blog_db ```
3. Open console and cd project root directory
4. Run ```mv .env.example .env ``` and fill the database information
    ```
    DB_HOST=
    DB_DATABASE=
    DB_USERNAME=
    DB_PASSWORD=
    ```
    
    also fill SMTP credentials

    ```
    MAIL_MAILER=
    MAIL_HOST=
    MAIL_PORT=
    MAIL_USERNAME=
    MAIL_PASSWORD=
    MAIL_ENCRYPTION=
    MAIL_FROM_ADDRESS=
    ``` 
5. Run ``` composer install ```
6. Run ``` npm install ```
7. Run ``` php artisan key:generate ```
8. Run ``` php artisan storage:link ```
9. Run ``` php artisan migrate ```
10. Run ``` php artisan db:seed ```
11. Run ``` php artisan serve ```