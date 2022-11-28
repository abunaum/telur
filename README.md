# Legi Jaya Farm

Aplikasi ini di ajukan untuk project skripsi Universitas Nurul Jadid

---

## Requirements

- php 7.4 (extension: intl , mbstring, putenv)
- mysql
- composer

---

## Prepare

- git clone https://gitlab.com/abunaum/telur.git
- composer install
- copy file env and set to .env
- edit file .env in baseUrl and Database

---

## Bash Commands

| Function   | Command                       |
| ---------- | ----------------------------- |
| Migration  | `php spark migrate -all`      |
| Seeder     | `php spark db:seed Persiapan` |
| Run Server | `php spark serve`             |

---

# Change Log :

---

### V 22.11.28.1

- Add Fitur transaksi Bendahara

  -> Add fitur list transaksi

  -> Add fitur detail transaksi

  -> Add fitur change status transaksi

---

### V 22.11.24.1

- Add Fitur user

  -> Add fitur order user

  -> Add fitur list transaksi user

  -> Add fitur check detail order user

---

### V 22.11.23.2

- Edit FunctionAdmin/[Post.php](https://gitlab.com/abunaum/telur/-/blob/main/app/Controllers/FunctionAdmin/Post.php)

  -> Fix add product (minimal order must be large than 0)

- Edit FunctionAdmin/[Put.php](https://gitlab.com/abunaum/telur/-/blob/main/app/Controllers/FunctionAdmin/Put.php)

  -> Edit product with notification to user and bendahara

- Edit Views/admin/[produk.php](https://gitlab.com/abunaum/telur/-/blob/main/app/Views/admin/produk.php)

  -> Add edit button product

- Edit Utils/Routes/[Put.json](https://gitlab.com/abunaum/telur/-/blob/main/app/Utils/Routes/Put.json)

  -> Add Route to edit product

---

### V 22.11.23.1

- Edit FunctionAdmin/[Post.php](https://gitlab.com/abunaum/telur/-/blob/main/app/Controllers/FunctionAdmin/Post.php)

  -> Add Telegram notif for user and bendahara, when admin add product

- Edit FunctionAdmin/[Delete.php](https://gitlab.com/abunaum/telur/-/blob/main/app/Controllers/FunctionAdmin/Delete.php)

  -> Add Telegram notif for user and bendahara, when admin remove product

- Modify Seeds [Persiapan.php](https://gitlab.com/abunaum/telur/-/blob/main/app/Database/Seeds/Persiapan.php)

  -> Add user for seeder

- Modify [Helpers/telegram_helper.php](https://gitlab.com/abunaum/telur/-/blob/main/app/Helpers/telegram_helper.php)

  -> Add function kirim by role

- Modify [Helpers/group_helper.php](https://gitlab.com/abunaum/telur/-/blob/main/app/Helpers/group_helper.php)

  -> Add function filter user by role

---

### V 22.11.21.1

- Edit [Routes](https://gitlab.com/abunaum/telur/-/blob/main/app/Utils/Routes) location

  -> Move and rename Routes from Utils/'RoutesName'.json to Utils/Routes/'Name'.json

- Edit [Routes.php](https://gitlab.com/abunaum/telur/-/blob/main/app/Config/Roures.php)

  -> Modify Routes directory files

- Modify dashboard views file for all rules [dashboard.php](https://gitlab.com/abunaum/telur/-/blob/main/app/Views/dashboard.php)

  -> Controller [Admin](https://gitlab.com/abunaum/telur/-/blob/main/app/Controllers/Admin.php)

  -> Controller [Bendahara](https://gitlab.com/abunaum/telur/-/blob/main/app/Controllers/Bendahara.php)

  -> Controller [User](https://gitlab.com/abunaum/telur/-/blob/main/app/Controllers/Admin.php)

---

### V 22.11.20.1

- Edit FunctionAdmin [Post.php](https://gitlab.com/abunaum/telur/-/blob/main/app/Controllers/FunctionAdmin/Post.php)

  -> Add Minimal Order

- Add FunctionBendahara [Put.php](https://gitlab.com/abunaum/telur/-/blob/main/app/Controllers/FunctionBendahara/Put.php)

  -> Add Setting Bendahara

- Add FunctionBendahara [Put.php](https://gitlab.com/abunaum/telur/-/blob/main/app/Controllers/FunctionBendahara/Put.php).

  -> Add Setting Bendahara

- Add FunctionUser [Put.php](https://gitlab.com/abunaum/telur/-/blob/main/app/Controllers/FunctionUser/Put.php).

  -> Add Setting User

- Add Bendahara Controller [Bendahara.php](https://gitlab.com/abunaum/telur/-/blob/main/app/Controllers/Bendahara.php).

  -> Add Bendahara Controller

- Add User Controller [User.php](https://gitlab.com/abunaum/telur/-/blob/main/app/Controllers/User.php).

  -> Add User Controller

- Edit Migration [2022-11-16-035248_Data.php](https://gitlab.com/abunaum/telur/-/blob/main/app/Database/Migrations/2022-11-16-035248_Data.php).

  -> Add minorder Field

- Edit RoutesGet [RoutesGet.php](https://gitlab.com/abunaum/telur/-/blob/main/app/Utils/RoutesGet.json).

  -> Add bendahara setting

  -> Add user setting

- Edit RoutesPut [RoutesPut.php](https://gitlab.com/abunaum/telur/-/blob/main/app/Utils/RoutesPut.json).

  -> Add bendahara setting

  -> Add user setting

- Edit [Views](https://gitlab.com/abunaum/telur/-/blob/main/app/Views).

  -> Add bendahara setting

  -> move app/Views/admin/setting.php to app/Views/setting.php

---
