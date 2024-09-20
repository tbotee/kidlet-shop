
## Installation

### Install dependencies
- php dependencies: ```composer install```
- js dependencies: ```npm install```

### Create .env file
- ```cp .env.example .env```

### Generate new application key
- ```php artisan key:generate```

### Prepare database
- create tables in the database ```php artisan migrate```
  - migration will ask two questions, answer Yes to both
- run seeders: ```php artisan db:seed```

### Starting the application
- ```php artisan serve```
  - then visit: http://127.0.0.1:8000
