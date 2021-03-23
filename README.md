## Развертывание приложения
Для развертывания приложения нужно выполнить следующие шаги:

1. Склонировать репозиторий
2. В папке проекта выполнить команду ```composer install```
3. Создать базу данных MYSQL
4. В файле .env проекта нужно изменить следующие переменные:
    1. ```DB_DATABASE``` - имя базы данных
    2. ```DB_USERNAME``` - имя пользователя для подключения к MYSQL
    3. ```DB_PASSWORD``` - пароль для подключения к MYSQL
5. Выполнить команду ```php artisan migrate```
6. Выполнить команду ```php artisan db:seed```

Для того, чтобы запустить проект, нужно использовать команду ```php artisan serve --port=80```

После успешного выполнения вышеуказанных шагов у вас должны создаться таблицы в базе данных и заполниться тестовыми данными.

## API

### Токен
Для обращения к API нужно использовать следующий API токен:
```0AaS0M3nDWkrpbf1MallA5qufAVNYjRzkKQ8gJx9lyD6clPuFZuCPRuEO8AuU0z4LifawYIDHrcjjZsV```

### Как использовать API токен?
API токен нужно использовать по-разному в зависимости от типа запроса:
1. __GET__ запрос. Для использования токена в GET-запросах, его нужно добавлять в параметры URL. Пример:
```http://127.0.0.1/api/books?api_token=**ЗДЕСЬ ДОЛЖЕН БЫТЬ API токен**```
2. __POST__ запрос. Для использования токена в GET-запросах, его нужно добавлять в передаваемые POST-параметры. Пример:
```json
{
    "name": "Гарри Поттер",
    "cover": "https://upload.wikimedia.org/wikipedia/ru/b/b4/Harry_Potter_and_the_Philosopher%27s_Stone_%E2%80%94_movie.jpg",
    "description": "Книга про волшебника",
    "year": 2005,
    "authors": [1],
    "api_token": "0AaS0M3nDWkrpbf1MallA5qufAVNYjRzkKQ8gJx9lyD6clPuFZuCPRuEO8AuU0z4LifawYIDHrcjjZsV"
}
```

### Endpoints

В данном приложении реализованы следующие endpoints:

1. ```/api/books```. Методы и примеры данных:
    - __GET__. Получение всех книг
    - __POST__. Создание книги. Пример:
        ```json
        {
            "name": "Гарри Поттер",
            "cover": "https://upload.wikimedia.org/wikipedia/ru/b/b4/Harry_Potter_and_the_Philosopher%27s_Stone_%E2%80%94_movie.jpg",
            "description": "Книга про волшебника",
            "year": 2005,
            "authors": [1],
            "api_token": "0AaS0M3nDWkrpbf1MallA5qufAVNYjRzkKQ8gJx9lyD6clPuFZuCPRuEO8AuU0z4LifawYIDHrcjjZsV"
        }
        ```
       Обозначения переменных:
        - __name__ - название книги
        - __cover__ - ссылка на изображение обложки
        - __description__ - описание книги
        - __year__ - год выпуска
        - __authors__ - массив, состоящий из id авторов        

2. ```/api/books/{id книги}```. Методы и примеры данных:
    - __GET__. Получение информации о книге
    - __PUT__. Обновление данных книги. Пример данных:
        ```json
        {
            "year": 2005,
            "api_token": "0AaS0M3nDWkrpbf1MallA5qufAVNYjRzkKQ8gJx9lyD6clPuFZuCPRuEO8AuU0z4LifawYIDHrcjjZsV"
        }
        ```
    - __DELETE__. Удаление книги
    
3. ```/api/books/{id книги}/estimate```. Методы и примеры данных:
    - __POST__. Поставить оценку книге. Пример данных:
        ```json
        {
            "rating": 5,
            "api_token": "0AaS0M3nDWkrpbf1MallA5qufAVNYjRzkKQ8gJx9lyD6clPuFZuCPRuEO8AuU0z4LifawYIDHrcjjZsV"
        }
        ```
       Обозначения переменных:
        - __rating__ - оценка книги(от 1 до 10)
        
4. ```/api/authors```. Методы и примеры данных:
    - __GET__. Получение всех авторов
    - __POST__. Создание автора. Пример:
        ```json
        {
            "name": "Артем",
            "surname": "Соколов",
            "patronymic": "Евгеньевич",
            "birthday": "15.11.2000",
            "api_token": "0AaS0M3nDWkrpbf1MallA5qufAVNYjRzkKQ8gJx9lyD6clPuFZuCPRuEO8AuU0z4LifawYIDHrcjjZsV"
        }
        ```
       Обозначения переменных:
        - __name__ - имя автора
        - __surname__ - фамилия автора
        - __patronymic__ - отчество автора(опицонально)
        - __birthday__ - дата рождения

5. ```/api/authors/{id автора}```. Методы и примеры данных:
    - __GET__. Получение информации об авторе
    - __PUT__. Обновление данных автора. Пример данных:
        ```json
        {
            "name": "Вася",
            "api_token": "0AaS0M3nDWkrpbf1MallA5qufAVNYjRzkKQ8gJx9lyD6clPuFZuCPRuEO8AuU0z4LifawYIDHrcjjZsV"
        }
        ```
    - __DELETE__. Удаление автора
    
6. ```/api/authors/{id автора}/estimate```. Методы и примеры данных:
    - __POST__. Поставить оценку автору. Пример данных:
        ```json
        {
            "rating": 5,
            "api_token": "0AaS0M3nDWkrpbf1MallA5qufAVNYjRzkKQ8gJx9lyD6clPuFZuCPRuEO8AuU0z4LifawYIDHrcjjZsV"
        }
        ```
       Обозначения переменных:
        - __rating__ - оценка автора(от 1 до 10)

7. ```/api/search```. Методы и примеры данных:
    - __GET__. Получить данные по запросу. Пример URL запроса:
        ```http://127.0.0.1/api/search?query=черный лебедь```
