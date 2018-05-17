<?php

namespace App\Models\Mirror;

use Illuminate\Database\Eloquent\Model;
use Spatie\GoogleCalendar\Event;
use Carbon\Carbon;

class CalenderModel extends Model
{

	public function loadCalendar() {
		$date = new Carbon();
		$date->format('Y-m-d');
		$url = 'https://calendar.google.com/calendar/ical/2frvpfn0p0beldmscmv4p30egc%40group.calendar.google.com/private-9573e48045552b99b9bc5912e5894dff/basic.ics';
		$events = Event::get($date);
		return $events;
	}

}