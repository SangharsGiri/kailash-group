<?php

function current_admin_id()
{
	$CI = &get_instance();
	return (int)$CI->session->userdata('admin_id');
}

function is_already_logged_in()
{
	if ( ! current_admin_id())
	{
		redirect('login');
	}
}

function is_logged_in()
{
	if (current_admin_id())
	{
		redirect('dashboard');
	}
}

// helper to get ip

function get_ip()
{
    $ip = $_SERVER['REMOTE_ADDR'];
    return $ip;
}


function date_converter($date)
{
    $result = date("F j, Y, g:i a", strtotime($date));
    return $result;
}

?>