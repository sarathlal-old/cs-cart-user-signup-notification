<?php

if ( !defined('BOOTSTRAP') ) { die('Access denied'); }

use Tygh\Registry;
use Tygh\Http;
use Tygh\Settings;
use Tygh\Mailer;

function fn_csc_signup_notification_send_notification($status, $user_id, $to_email){
    $user_data = fn_get_user_info($user_id);
            if (AREA != 'A' and $status == 'A') {
                Mailer::sendMail(array(

                    'to' => $to_email,
                    'from' => 'company_users_department',
                    'reply_to' => $user_data['email'],
                    'data' => array(
                        'user_data' => $user_data,
                    ),
                    'tpl' => 'profiles/create_profile_admin_notification.tpl',
                    'company_id' => $user_data['company_id']
                ), 'A', Registry::get('settings.Appearance.backend_default_language'));
            }
}

function fn_csc_signup_notification_update_profile($action, $user_data, $current_user_data){
    if ($action == 'add' && $user_data['user_type'] == 'C') {
        if (!fn_allowed_for('ULTIMATE:FREE')) {
			if(Registry::get('addons.csc_signup_notification.enable_notification') == 'Y'){
				$to_email = Registry::get('addons.csc_signup_notification.notification_email');
				if((!empty($to_email)) and (!filter_var($to_email, FILTER_VALIDATE_EMAIL) === false)){
					$notifier = $to_email;
				} else { 
					$notifier = 'company_users_department';
				}
				
				
				fn_csc_signup_notification_send_notification('A', $user_data['user_id'], $notifier);
			}
        }
    }
}
