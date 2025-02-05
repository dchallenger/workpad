<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

if ( !class_exists('Record') )
{
	require __DIR__ . '/record.php';
}

class notification_model extends Record
{
	public function _get_user_notification( $user_id )
	{
		$response = new stdClass();
		$notifications = $this->db->query( "SELECT * FROM `dashboard_notification` WHERE (recipient_id = ". $user_id ." OR recipient_id = 0) AND (readon IS NULL OR readon = '0000-00-00 00:00:00') AND (reactedon IS NULL OR reactedon = '0000-00-00 00:00:00')" );
		$response->total_notification = $notifications->num_rows();
		$response->total_unread = $notifications->num_rows();
		$response->notification = array();
		$limit = 0;
		
		foreach( $notifications->result_array() as $notification )
		{
			if($notification['uri'] != "") {
				$notification['notification_link'] = site_url( $notification['uri'] );
			}else{
				$notification['notification_link'] = '#';
			}
			if( $this->input->post('mobileapp') )
				$response->notification[] = $this->load->view('templates/notifications/mobile/'.$notification['status'], $notification, true);
			else
				$response->notification[] = $this->load->view('templates/notifications/'.$notification['status'], $notification, true);
			$limit++;
			if( $limit > 9 )
			{
				break;
			}	
		}

		//add unread, reacted
		$notifications = $this->db->query( "SELECT * FROM `dashboard_notification` WHERE (recipient_id = ". $user_id ." OR recipient_id = 0) AND (readon IS NULL OR readon = '0000-00-00 00:00:00') AND NOT (reactedon IS NULL OR reactedon = '0000-00-00 00:00:00')" );
		$response->total_notification += $notifications->num_rows();
		if( sizeof( $response->notification ) < 10 )
		{
			$limit = sizeof( $response->notification ) - 1;
			foreach( $notifications->result_array() as $notification )
			{
				if($notification['uri'] != "") {
					$notification['notification_link'] = site_url( $notification['uri'] );
				}else{
					$notification['notification_link'] = '#';
				}
				if( $this->input->post('mobileapp') )
					$response->notification[] = $this->load->view('templates/notifications/mobile/'.$notification['status'], $notification, true);
				else
					$response->notification[] = $this->load->view('templates/notifications/'.$notification['status'], $notification, true);
				$limit++;
				if( $limit > 9 )
				{
					break;
				}	
			}	
		}

		return $response;
	}

	public function _unnotify( $user_id )
	{
		$response = new stdClass();
		$this->db->query("UPDATE `ww_system_feeds`
		SET reactedon = NOW()
		WHERE (recipient_id = ". $user_id ." OR recipient_id = 0) AND (readon IS NULL OR readon = '0000-00-00 00:00:00') AND (reactedon IS NULL OR reactedon = '0000-00-00 00:00:00')");
		if( $this->db->_error_message() != "" )
		{
			$response->message[] = array(
				'message' => $this->db->_error_message(),
				'type' => 'error'
			);
		}
		else{
			$response->message[] = array(
				'message' => '',
				'type' => 'success'
			);
		}
		return $response;
	}
}