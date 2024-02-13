 ### Тестовое задание
## Подготовка
Необходимо добавит файл .env в корневой каталог

## Запуск

1. Установить зависимости composer:

```
composer install
```
2. Выполнить следующий скрипт:

```
composer run project-start
```
3. В файл .env укажите  данные для доступа к базе данных mysql

```
DB_CONNECTION=mysql
DB_HOST={Ваши данные}
DB_PORT=3306
DB_DATABASE={Ваши данные}
DB_USERNAME={Ваши данные}
DB_PASSWORD={Ваши данные}
```
4. Выполнить миграцию

```
сomposer run migrate
```
5. Запуск сервера
```
php artisan serve
```
