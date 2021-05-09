<?php
class vendor_manager_controller extends vendor_crud_controller {
	public function __construct() {
		$this->checkRole();
		parent::__construct();
	}

	public function checkRole() {
		global $app;
		$this->checkAuth();
		$rolesFlip = array_flip($app['roles']);
		if (!isset($_SESSION['user']['role']) || !($_SESSION['user']['role']==$rolesFlip["admin"]
			|| $_SESSION['user']['role']==$rolesFlip["jobmanager"]
			|| $_SESSION['user']['role']==$rolesFlip["adsmanager"]
		)) {
			//$_SESSION['flasherror'] = "This page not exist or you don't have permission for this page!";
			$_SESSION['flasherror'] = "This page not exist!";
			header( "Location: ".vendor_app_util::url(array('ctl'=>'dashboard')));
			exit;
		}
	}
}
?>