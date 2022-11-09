<aside id="sidebar" class="sidebar">

    <ul class="sidebar-nav" id="sidebar-nav">
        <?php
        helper('group_helper');
        $Group = new \App\Models\Auth_groups_users();
        $group = $Group->where('user_id', user()->id)->first();
        $idgroup = $group['group_id'];
        $getgroup = getgroup($idgroup);
        $role = $getgroup['name'];
        $rg = file_get_contents(APPPATH . "Utils/RoutesGet.json");
        $rout = json_decode($rg, true);
        foreach ($rout as $data) {
            if (array_key_exists("div", $data)) {
                if ($data['role'] === $role) {
        ?>
                    <li class="nav-heading"><?= $data['text']; ?></li>
                <?php
                }
            } else {
                if ($data['list'] === true && $data['role'] === $role) {
                ?>
                    <li class="nav-item">
                        <a class="nav-link " href="<?= $data['url']; ?>">
                            <i class="<?= $data['icon']; ?>"></i>
                            <span><?= $data['name']; ?></span>
                        </a>
                    </li>
        <?php
                }
            }
        }
        ?>
    </ul>

</aside><!-- End Sidebar-->