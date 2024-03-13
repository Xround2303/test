# Как развернуть приложение
## Поднять docker контейнеры
1. Скопировать env <br>```cp .env.template .env```
2. Отредактировать <br>```nano .env```
3. Копируем свои ssh ключи в директорию ./docker/ssh <br>
   Если под linux<br>
   ```cp ~/.ssh/id_rsa /{директория проекта}/docker/ssh/id_rsa```<br>
   ```cp ~/.ssh/id_rsa.pub /{директория проекта}/docker/ssh/id_rsa.pub```
4. Выполнить команду <br>```sudo docker-compose up -d --build```

## Поднять бекенд
1. Скопировать env <br>```cp ./app/www/.env.example ./app/www/.env```
2. Отредактировать .env согласно всем параметрам
3. Установить зависимости композер ```docker-compose run app composer i```
4. Выполнить миграции ```docker-compose run app php artisan migrate```
5. Для локальной разработки необходимо скопировать файл <br>
   ```cp ./app/www/.auth.json.template ./app/www/.auth.json```<br>
6. Сделать полные права для файла ```chmod 777 ./app/www/.auth.json```
   и подставить нужные авторизационные токены.
7. Сгенерировать laravel key ```docker-compose run app php artisan key:generate```
8. Установить права для хранилищя ```chown -R www-data:www-data ./app/www/storage```
9. Установить символическую ссылку на хранилище ```docker-compose run app php artisan storage:link```

## Поднять фронт
1. Установить зависимости ```docker-compose run --rm npm ci```
2. Собрать проект ```docker-compose run --rm npm run build```


## htaccess роутер версий проекта
```
RewriteEngine On

RewriteCond %{HTTP_HOST} ^([^.]+)\.([^.]+)\.skyweb24\.ru$ [NC]
RewriteRule ^(.*)$ /%1/$1 [L]
```
