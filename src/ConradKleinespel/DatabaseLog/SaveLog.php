<?php namespace ConradKleinespel\DatabaseLog;

use DB;

class SaveLog {

	public function fire($job, $data) {

		DB::table('logs')->insert($data);

		$job->delete();

	}

}