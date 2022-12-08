# Legi Jaya Farm App

Aplikasi ini di ajukan untuk project skripsi Universitas Nurul Jadid.

---

## Requirements

- php 7.4 (extension: intl , mbstring, putenv).
- mysql.
- composer.

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
| DB         | `php spark command:name DB`   |
| Migration  | `php spark migrate -all`      |
| Seeder     | `php spark db:seed Persiapan` |
| Run Server | `php spark serve`             |

---
