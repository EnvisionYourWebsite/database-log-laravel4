<?php namespace ConradKleinespel\DatabaseLog;

use Illuminate\Support\ServiceProvider;
use DateTime;

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
		$this->package('conrad-kleinespel/database-log');

		// Add a log listener to save logs to the database
		$this->app['log']->listen(function($level, $message, $context) {

			// Gather the data that needs to be logged
			$data = array(
				'php_sapi_name' => php_sapi_name(),
				'level' => $level,
				'message' => $message,
				'context' => json_encode($context),
				'created_at' => new DateTime
			);

			// Queue de database insertion so it performs asynchronously
			$this->app['queue']->push('ConradKleinespel\\DatabaseLog\\SaveLog', $data);

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