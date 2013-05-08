<?php namespace ConradKleinespel\DatabaseLog;

use DB;

class SaveLog
{

	protected $app;

	public function __construct()
	{
		$this->app = app();
	}

	public function fire($job, $data)
	{

		$this->app['db']->table('logs')->insert($data);

		$job->delete();

	}

}