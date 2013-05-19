<?php namespace ConradKleinespel\DatabaseLog;

use Illuminate\Support\ServiceProvider;
use DateTime;
use Exception;

class DatabaseLogServiceProvider extends ServiceProvider {

	/**
	 * Indicates if loading of the provider is deferred.
	 *
	 * @var bool
	 */
	protected $defer = false;

	/**
	 * Bootstrap the application events.
	 *
	 * @return void
	 */
	public function boot()
	{
		$this->package('conradkleinespel/database-log-laravel4');

		// Add a log listener to save logs to the database
		$this->app['log']->listen(function($level, $message, $context) {

			// Format the information saved to the DB
			if ($message instanceof Exception) {
				$message = array(
					'message' => $message->getMessage(),
					'code' => $message->getCode(),
					'trace' => $message->getTraceAsString(),
					'file' => $message->getFile(),
					'line' => $message->getLine()
				);
			} else {
				$message = array(
					'message' => $message
				);
			}

			// Seriliaze the message
			$message = serialize($message);

			// Gather the data that needs to be logged
			$data = array(
				'php_sapi_name' => php_sapi_name(),
				'level' => $level,
				'message' => $message,
				'context' => json_encode($context),
				'created_at' => new DateTime
			);

			// Queue de database insertion so it performs asynchronously
			$this->app['queue']->push(function($job) use ($data) {
				app('db')->table('logs')->insert($data);

				$job->delete();
			});

		});
	}

	/**
	 * Register the service provider.
	 *
	 * @return void
	 */
	public function register()
	{
		//
	}

	/**
	 * Get the services provided by the provider.
	 *
	 * @return array
	 */
	public function provides()
	{
		return array();
	}

}