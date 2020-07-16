# TopoRocks

Welcome on TopoRocks open-source project

## Setup

Pre-requesites:
- node 14+
- postgresql with postgis extension
- create a toporocks database

Install:

- `yarn` to install node dependencies
- `composer install` to install php dependencies
- `cp .env.example .env` and update postgres configuratino section
- `php artisan key:generate && php artisan jwt:secret`
- `php artisan migrate`

## Run

- `yarn hot`
- `php artisan serve`

Then browse: http://localhost:8000