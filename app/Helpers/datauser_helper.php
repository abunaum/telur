<?php
function getuser($id)
{
    $getuser = new \App\Models\User();
    $getuser->join('auth_groups_users', 'auth_groups_users.user_id = users.id', 'LEFT');
    $getuser->join('auth_groups', 'auth_groups.id = auth_groups_users.group_id', 'LEFT');
    $getuser->join('telegram', 'telegram.user_id = users.id', 'LEFT');
    $getuser->select('users.id');
    $getuser->select('users.username');
    $getuser->select('users.fullname');
    $getuser->select('users.email');
    $getuser->select('auth_groups.name as group_name');
    $getuser->select('telegram.tele_id as tele_id');
    $getuser->select('telegram.status as tele_status');
    $getuser->where('users.id', $id);
    $getuser = $getuser->first();
    return $getuser;
}
