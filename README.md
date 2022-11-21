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
