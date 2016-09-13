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
		'getMeetupData'
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

		$total_count = $response->meta->total_count;
		
		//$res -> name = "";
		//$res -> time = "";
		
		$sendback = new ArrayList();

		foreach ($response->results as $event) {
			$res = new DataObject;
			$res->name = $event->name;
			$res->time = $event->time;
			$res->rsvp = $event->yes_rsvp_count;
			$res->link = '<a href="'.$event->event_url.'">Go to Meetup</a>';
			$sendback->push($res);
		    //echo $event->name . ' at ' . date('Y-m-d H:i', $event->time / 1000) . PHP_EOL;
		}
		
		//echo '<pre>';
		//print_r($response);
		
		return $sendback;
	}

}
	