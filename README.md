# Async Database Logs for Laravel 4

Asynchronously save your logs to the database.

## Installation

Download the package files to `laravel-root/workbench/conradkleinespel/database-log-laravel4`.

Run `php artisan migrate --bench="conradkleinespel/database-log-laravel4"`.

Add `'ConradKleinespel\DatabaseLog\DatabaseLogServiceProvider'` to your Laravel providers.

Add `base_path() . '/workbench/conradkleinespel/database-log-laravel4/src/ConradKleinespel/DatabaseLog/DatabaseLogServiceProvider.php',` to your `config/compile.php` file.