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

		$total_count = $response->meta->total_count;
		
		$res = new DataObject;
		//$res -> name = "";
		//$res -> time = "";
		
		$sendback = new ArrayList();
		foreach ($response->results as $event) {
			$res->name = $event->name;
			$res->time = date('l - F j \a\t g:i a', $event->time / 1000) . PHP_EOL;
			$sendback->push($res);
		    //echo $event->name . ' at ' . date('Y-m-d H:i', $event->time / 1000) . PHP_EOL;
		}
		
		//echo '<pre>';
		//print_r($res);
		
		return $sendback;
	}

}
	