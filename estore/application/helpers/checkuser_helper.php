<?php
function checkUser($obj) {
	if($obj->session->userdata('logged_in'))
	{
		$session_data = $obj->session->userdata('logged_in');
		$login = $session_data['login'];
			
		if ($login == "admin") {
			$data['taskbar'] = 'templates/taskbar_admin.php';
			$data['login'] = 'admin';		
		}
		else{
			$data['taskbar'] = 'templates/taskbar_user.php';
			$data['login'] = 'user';
		}
	}
	
	else {
		$data['taskbar'] = 'templates/taskbar_anon.php';
		$data['login'] = 'anon';
	}
	return $data;
}