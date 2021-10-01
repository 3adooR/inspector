echo -en "\033[33;1mStart inspector\033[0m\n";

# Backend
php artisan view:clear;
php artisan config:clear;
php artisan cache:clear;
php artisan route:cache;
php artisan migrate;
php artisan test;

# APP commands
php artisan cache-sites;

# Frontend
npm i;
npm run dev;
