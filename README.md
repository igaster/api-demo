## API Demo

This is a sample Laravel project that manages two reources:
- Subscribers
- Subscriber Fields (One to Many)

Implemented based on standard Laravel fearures:
- API Resources
- Request Validation
- Model Factories / Seeders
- Unit + Feature tests
- Frontend is build with vue.js and SB-Admin 2 bootstrap template

## Installation

- Clone repository
- Create .env file and setup database connection
- Migrate and run the Seeders: `php artisan migrate --seed`

Vue.js components are compiled (for develoment). Rebuilding them is optional:

- `npm install`
- `npm run production`

## Run tests

You don't need a database connection to run tests (SQLite in memory database is used)

To run all tests execute phpunit:

- `vendor/bin/phpunit`

## API documentation

Created with swagger: https://subscribersapi1.docs.apiary.io
