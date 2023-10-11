## How to setup?

1. Clone repo - `git clone git@github.com:iskandarhzq/upload-file-system.git`
2. Install packge - `composer install`
3. Migrate fresh and seed - `php artisan migrate:fresh --seed`

## How the background process work?

Two situations can be tested:

- With Horizon:
1. Configure queue connection in .env - `QUEUE_CONNECTION=sync`
2. Run command `php artisan horizon`

- If redis problem in your local:
1. Configure queue connection in .env - `QUEUE_CONNECTION=database`
2. Run command `php artisan queue:listen` or `php artisan queue:work`

## How to test upsert data for second upload?

- For given sample csv file replace name from 'yoprint_test_updated.csv' to 'yoprint_test_import.csv'
