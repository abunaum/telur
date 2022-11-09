<?php
function getgroup($id)
{

    $Group = new \App\Models\AuthGroups();
    $grp = $Group->where('id', $id)->first();
    return $grp;
}
