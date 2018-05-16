<?php
namespace App\Http\Controllers\Mirror;

use App\Models\Mirror\CalenderModel;
use App\Http\Controllers\Controller;

class CronjobController extends Controller {

	public function getModel() {
		$data = new CalenderModel();
		return $data->loadCalendar();
	}

}