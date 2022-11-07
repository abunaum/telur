<aside id="sidebar" class="sidebar">

    <ul class="sidebar-nav" id="sidebar-nav">
        <?php
        $role = array_values(user()->getRoles())[0];
        $rg = file_get_contents(APPPATH . "Utils/Routes.json");
        $rout = json_decode($rg, true);
        foreach ($rout as $r) {
            if ($r["methode"] = "get") {
                foreach ($r["data"] as $data) {
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
            }
        }
        ?>
    </ul>

</aside><!-- End Sidebar-->