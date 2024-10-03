# Install dependencies
composer install
npm install

mv .env.example .env # rename .env.example to .env
php artisan key:generate # Generate application key