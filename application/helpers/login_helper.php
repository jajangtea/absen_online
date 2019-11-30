<?php
function is_logged_in()
{
    $ci = get_instance();
    $user = $ci->session->userdata('user_data');
    if (!isset($user)) {
        return false;
    } else {
        return true;
    }
}
