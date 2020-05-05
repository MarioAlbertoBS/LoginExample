Passport API Login Example.

It contains a basic login routes for an API, using access tokens to authenticate the user.

It works generating and encrypted access token to identify an user.

Contains the basic register, login and logout methods, and all can be accessed by the routes '/api/register', '/api/login' and '/api/logout'.

Usage after download the code:
- Run 'composer require' command
- Create the .env file using the .env.example and configure the database
- Migrate the databases with 'php artisan migrate'
- Generate the the encryption keys with 'php artisan passport:install'
Note: All the configurations remains in the default values.

Can found an exported Postman Collection for tests in the tests directory, here you can see the request values.

The authentication token works in the Authorization Header as "Bearer [TOKEN]"
The register and login methods will not require the token, in the response you will recieve the Token, this is the value that will be used as the Authorization value.
The test and logout methods will require this header.