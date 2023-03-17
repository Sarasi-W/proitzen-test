## Proitzen Test

### Instructions

```
git clone git@github.com:Sarasi-W/proitzen-test.git
cd proitzen-test
cp .env.example .env
```

Update .env file with database configuration

Checkout to dev branch and get a pull

```
composer install
php artisan key:generate
```

```
php artisan migrate
php artisan db:seed
php artisan serve
```

Login to the System

```
username: admin@admin.com
password: password
```
