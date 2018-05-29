
## Требования


Laravel version >= 5.6

PHP >= 7.1.3

OpenSSL PHP Extension

PDO PHP Extension

Mbstring PHP Extension

Tokenizer PHP Extension

XML PHP Extension

Ctype PHP Extension

JSON PHP Extension


## Установка

1. Склонируйте этот репозиторый

```
git clone https://github.com/BorysVitaliy/mytest.git
```

2. Установите зависимости

```
composer install
```
3. Создайте пустую БД

4. В корне приложения переименуйте файл (или создайте .env и скопируйте в него содержимое .env.example) env.example в .env и настройте в нем подключение к БД

5. Откройте консоль и запустите миграции и посев начальных данных 

```
php artisan migrate
```

```
php artisan db:seed
```
6  сгенерируйту app key 
```
php artisan key:generate
```

7 Готово

