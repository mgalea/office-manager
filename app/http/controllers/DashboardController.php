<?php

/**
 * Dashboard Controller
 */
class DashboardController extends Controller
{
	/**
	 * Private Dashboard model variable
	 * This will be used for calling department model's function
	 **/
	private $dashboardModel;
	/*Class Constructor*/
	function __construct()
	{
		/*Call parent constructor*/
		parent::__construct();
		$this->commons = new CommonsController();
		/*Intilize dashboard model*/
		$this->dashboardModel = new Dashboard();
	}

	/**
	 * Dasboard index method
	 * This method will be called on dahsboard view
	 **/
	public function index()
	{
		/*Get Logged in user info*/
		$data = $this->commons->getUser();
		/*Load Language File*/
		require DIR_BUILDER . 'language/' . $data['info']['language'] . '/common.php';
		$data['lang']['common'] = $lang;
		require DIR_BUILDER . 'language/' . $data['info']['language'] . '/dashboard.php';
		$data['lang']['dashboard'] = $dashboard;
		require DIR_BUILDER . 'language/' . $data['info']['language'] . '/calendar.php';
		$data['lang']['calendar'] = $calendar;

		/**
		 * Get all notes and events  data from DB using Event model
		 * According to user_role 
		 **/

		if ($this->session->data['role'] == "1") {
			$data['calendar'] = json_encode($this->dashboardModel->getEvents());
			$data['notes'] = $this->dashboardModel->getNotes();
		} else {
			$data['calendar'] = json_encode($this->dashboardModel->getUserEvents($this->session->data['user_id']));
			$data['notes'] = $this->dashboardModel->getUserNotes($this->session->data['user_id']);
		}

		$data['statistics']=$this->dashboardModel->getStatistics();
		$data['contacts'] = $this->dashboardModel->getLatestContact();
		/*Get latest invoices*/

		$data['calendar_action'] = $data['action'] = URL.DIR_ROUTE.'calendar/action';

		/*Get Ticket by status */
		$data['ticketByStatus'] = $this->dashboardModel->getTicketByStatus();
		if (!empty($data['ticketByStatus'])) {
			foreach ($data['ticketByStatus'] as $key => $value) {
				if ($value['label'] == "Open") {
					$data['ticketByStatus'][$key]['label'] = $data['lang']['dashboard']['text_open'];
				} else {
					$data['ticketByStatus'][$key]['label'] = $data['lang']['dashboard']['text_closed'];
				}
			}
		}
		$data['ticketByStatus'] = json_encode($data['ticketByStatus']);

		/*Get recent list*/
		$data['recents'] = $this->dashboardModel->getRecentlyAdded();

		/*Render dahsboard view*/
		$this->view->render('dashboard/dashboard.tpl', $data);
	}
}
