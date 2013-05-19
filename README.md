# Async Database Logs for Laravel 4

Asynchronously save your logs to the database.

**WARNING: this package is broken. Read on to learn more.**
*Laravel uses `var_export` and apparently, the data that this package logs cannot be `var_export`'ed because it creates a circular reference error. If you know why this happens, please let me know as I have no clue.*

## Installation

Download the package files to `laravel-root/workbench/conradkleinespel/database-log-laravel4`.

Run `php artisan migrate --bench="conradkleinespel/database-log-laravel4"`.

Add `'ConradKleinespel\DatabaseLog\DatabaseLogServiceProvider'` to your Laravel providers.

Add `base_path() . '/workbench/conradkleinespel/database-log-laravel4/src/ConradKleinespel/DatabaseLog/DatabaseLogServiceProvider.php',` to your `config/compile.php` file.
