<?php
namespace App\Http\Controllers\Mirror;

use App\Models\Mirror\GuidesModel;
use App\Http\Controllers\Controller;

class CronjobController extends Controller {

	public function getModel() {
		$data = new GuidesModel();
		return $data->loadCalendar();
	}

}