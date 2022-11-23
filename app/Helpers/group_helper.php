<?php
function getgroup($id)
{

    $Group = new \App\Models\AuthGroups();
    $grp = $Group->where('id', $id)->first();
    return $grp;
}

function getuserfull()
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
    $getuser = $getuser->findAll();
    return $getuser;
}

function useronly($user)
{
    $newuser = [];
    foreach ($user as $usr) {
        if ($usr['group_name'] === 'user') {
            array_push($newuser, $usr);
        }
    }
    return $newuser;
}

function bendaharaonly($user)
{
    $newuser = [];
    foreach ($user as $usr) {
        if ($usr['group_name'] === 'bendahara') {
            array_push($newuser, $usr);
        }
    }
    return $newuser;
}

function adminonly($user)
{
    $newuser = [];
    foreach ($user as $usr) {
        if ($usr['group_name'] === 'admin') {
            array_push($newuser, $usr);
        }
    }
    return $newuser;
}
