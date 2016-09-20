<?php
class Homepage extends Page {
	
	private static $db = array(
	);
	
	private static $has_one = array(
	);
}

class Homepage_Controller extends Page_Controller {

	/**
	 * An array of actions that can be accessed via a request. Each array element should be an action name, and the
	 * permissions or conditions required to allow the user to access it.
	 *
	 * <code>
	 * array (
	 *     'action', // anyone can access this action
	 *     'action' => true, // same as above
	 *     'action' => 'ADMIN', // you must have ADMIN permissions to access this action
	 *     'action' => '->checkAction' // you can only access this action if $this->checkAction() returns true
	 * );
	 * </code>
	 *
	 * @var array
	 */
	private static $allowed_actions = array (
		'getMeetupData', 'get_timezone_offset',
	);

	public function init() {
		parent::init();
		require 'meetup.php';
		// You can include any CSS or JS required by your project here.
		// See: http://doc.silverstripe.org/framework/en/reference/requirements
	}

	public function getMeetupData(){
		$meetup = new Meetup(array(
			'key' => 'b4b4753212a287c3d301c3d49236e6'
			));

		$response = $meetup->getEvents(array(
			'group_urlname' => 'Queenstown-Technology-Group'
			));

		$tango = $meetup->getEvents(array(
			'group_urlname' => 'Queenstown-Argentine-Tango-Dancing-Meetup'
			));

			
		//Set local time zone
		$dateTimeZoneNZ = new DateTimeZone("Pacific/Auckland");
						
		$sendback = new ArrayList();

		//Process each event that is present in group from API call
		foreach ($response->results as $event) {
			//Remove milliseconds from Meetup Epoch time return
			$epochTime = $event->time / 1000;
			date_default_timezone_set('UTC');
			//Format into standard date time format
			$meetupTime = date('Y-m-d H:i:s', $epochTime);
			//Determine current time zone offset (in seconds) to UTC, which is what Meetup date time is set to, from NZ local time on the date of the event
			$offset = $dateTimeZoneNZ->getOffset(new DateTime($meetupTime, $dateTimeZoneNZ));
			//Convert the event date and time to DateTime object and then add the offset as an interval (seconds)
			$meetupTime = new DateTime($meetupTime);
			$meetupTime->add(new DateInterval('PT' . $offset . 'S'));
			//format for display on front end
			$stamp = $meetupTime->format('d-m-Y H:i');

			//Create the dataobject from the processed event data and add it to the ArrayList which will be returned after all events are processed.
			$res = new DataObject;
			$res->name = $event->name;
			$res->time = $stamp;
			$res->rsvp = $event->yes_rsvp_count;
			$res->link = $event->event_url;
			$sendback->push($res);
		 
		}
		
		//echo '<pre>';
		//print_r($meetupTimeDeb);
		
		return $sendback;
	}

	
}
	