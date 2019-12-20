Installation requirements:
1. PHP 7.2(cli)
2. MySQL 5.7

Presetup steps:
1) cmd2 (composer install)
2) cmd2 (npm install)
3) Заповнить .env(DB)
4) cmd2 (php artisan migrate(user created))
**email: admin@test.com
**pass: 11111111

5) cmd3 (php artisan serve)

Admin part pages:
* serials [http://127.0.0.1:8000/serial]{show,create}
* sezon [http://127.0.0.1:8000/serial/{serial_id}/]{show,create}
* epizod [http://127.0.0.1:8000/sezon/{sezon_id}/]{show,create}]

Frontend part:
* serials [http://127.0.0.1:8000/serial]{show}
* sezon [http://127.0.0.1:8000/serial/{serial_id}/]{show}
* epizod [http://127.0.0.1:8000/sezon/{sezon_id}/]{show}]

