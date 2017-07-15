# backend 
@see https://docs.google.com/document/d/1ehJ5w9yNxJu6etFEQb7onVeLkhfpQ4qxH4c_ASLCQh8/edit

### Запуск проекта c помощью Docker-compose

1. Необходимо установить docker (engine - ver. >16.0). Позволить запускать docker без `sudo`
2. Установить docker-compose (ver. >1.11.)
3. Clone this repo и зайти в **root dir проекта**.
4. Выполнить в консоли: `docker-compose up -d`
5. Выполнить `docker ps`. Должны быть запущены сервис-контейнеры **nginx_tools**, **phpfpm**, **mysql**
6. Можно зайти в контейнер `docker exec -it phpfpm bash`. 
7. `cd /var/www/backend`. *(Данный путь уже должен быть открыт - т.к. установлен as working_dir for service)*

### Архитектура проекта

8. Класс Init -> `php Init.php`
9. Поиск файлов по маске -> `php searchFiles.php`
10. Sql-структура и запрос в файле **booksAndAuthors.php**






