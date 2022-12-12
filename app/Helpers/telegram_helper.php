<?php
function kirimpesan($chatId, $pesan)
{
    $token = '5548453019:AAFfRpa6Yq0ThEx6ysngIi2ODem8Ak54l0g';
    $pesan1 = urlencode($pesan);
    $pesan2 = str_replace('%5Cn', ' %0A', $pesan1);
    $curl = curl_init();
    curl_setopt_array($curl, array(
        CURLOPT_URL => "https://api.telegram.org/bot$token/sendMessage",
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'POST',
        CURLOPT_POSTFIELDS => "chat_id=$chatId&text=$pesan2",
        CURLOPT_HTTPHEADER => array(
            'Content-Type: application/x-www-form-urlencoded'
        ),
    ));
    $response = json_decode(curl_exec($curl), true);
    curl_close($curl);
    if ($response['ok'] == 1) {
        return true;
    } else {
        return false;
    }
}

function kirim_user($pesan)
{
    helper('group');
    $alluser = getuserfull();
    $user = useronly($alluser);
    foreach ($user as $usr) {
        if ($usr['tele_status'] === 'valid') {
            $tele_id = $usr['tele_id'];
            kirimpesan($tele_id, $pesan);
        }
    }
}

function kirim_sigle($iduser, $pesan)
{
    helper('datauser');
    $user = getuser($iduser);
    if ($user['tele_status'] === 'valid') {
        $tele_id = $user['tele_id'];
        kirimpesan($tele_id, $pesan);
    }
}

function kirim_bendahara($pesan)
{
    helper('group');
    $alluser = getuserfull();
    $user = bendaharaonly($alluser);
    foreach ($user as $usr) {
        if ($usr['tele_status'] === 'valid') {
            $tele_id = $usr['tele_id'];
            kirimpesan($tele_id, $pesan);
        }
    }
}

function kirim_admin($pesan)
{
    helper('group');
    $alluser = getuserfull();
    $user = adminonly($alluser);
    foreach ($user as $usr) {
        if ($usr['tele_status'] === 'valid') {
            $tele_id = $usr['tele_id'];
            kirimpesan($tele_id, $pesan);
        }
    }
}
