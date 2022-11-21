<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (is_file(SYSTEMPATH . 'Config/Routes.php')) {
    require SYSTEMPATH . 'Config/Routes.php';
}

/*
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Auth');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
// The Auto Routing (Legacy) is very dangerous. It is easy to create vulnerable apps
// where controller filters or CSRF protection are bypassed.
// If you don't want to define all routes, please use the Auto Routing (Improved).
// Set `$autoRoutesImproved` to true in `app/Config/Feature.php` and set the following to true.
// $routes->setAutoRoute(false);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.

$rg = file_get_contents(APPPATH . "Utils/Routes/Get.json");
$routget = json_decode($rg, true);
foreach ($routget as $rget) {
    $role = $rget['role'];
    switch ($role) {
        case 'norole':
            foreach ($rget['data'] as $data) {
                $routes->get($data["url"], $data["controller"] . "::" . $data["class"]);
            }
            break;

        default:
            foreach ($rget['data'] as $data) {
                if (!array_key_exists("div", $data)) {
                    $routes->get($data["url"], $data["controller"] . "::" . $data["class"], ['filter' => "role:$role"]);
                }
            }
            break;
    }
}

$rp = file_get_contents(APPPATH . "Utils/Routes/Post.json");
$routpost = json_decode($rp, true);
foreach ($routpost as $rpost) {
    $role = $rpost['role'];
    switch ($role) {
        case 'norole':
            foreach ($rpost['data'] as $data) {
                $routes->post($data["url"], $data["controller"] . "::" . $data["class"]);
            }
            break;

        default:
            foreach ($rpost['data'] as $data) {
                if (!array_key_exists("div", $data)) {
                    $routes->post($data["url"], $data["controller"] . "::" . $data["class"], ['filter' => "role:$role"]);
                }
            }
            break;
    }
}


$rd = file_get_contents(APPPATH . "Utils/Routes/Delete.json");
$routdelete = json_decode($rd, true);
foreach ($routdelete as $rdelete) {
    $role = $rdelete['role'];
    switch ($role) {
        case 'norole':
            foreach ($rdelete['data'] as $data) {
                $routes->delete($data["url"], $data["controller"] . "::" . $data["class"]);
            }
            break;

        default:
            foreach ($rdelete['data'] as $data) {
                if (!array_key_exists("div", $data)) {
                    $routes->delete($data["url"], $data["controller"] . "::" . $data["class"], ['filter' => "role:$role"]);
                }
            }
            break;
    }
}

$rpu = file_get_contents(APPPATH . "Utils/Routes/Put.json");
$routput = json_decode($rpu, true);
foreach ($routput as $rput) {
    $role = $rput['role'];
    switch ($role) {
        case 'norole':
            foreach ($rput['data'] as $data) {
                $routes->put($data["url"], $data["controller"] . "::" . $data["class"]);
            }
            break;

        default:
            foreach ($rput['data'] as $data) {
                if (!array_key_exists("div", $data)) {
                    $routes->put($data["url"], $data["controller"] . "::" . $data["class"], ['filter' => "role:$role"]);
                }
            }
            break;
    }
}


/*
 * --------------------------------------------------------------------
 * Additional Routing
 * --------------------------------------------------------------------
 *
 * There will often be times that you need additional routing and you
 * need it to be able to override any defaults in this file. Environment
 * based routes is one such time. require() additional route files here
 * to make that happen.
 *
 * You will have access to the $routes object within that file without
 * needing to reload it.
 */
if (is_file(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
    require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
