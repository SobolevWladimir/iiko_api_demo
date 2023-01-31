# Iiko Protokol API

    Сервер который позволяет работать с iiko без iikoBiz или iikoCloud. 

⚠️ Это неофициальная библиотека. 


### Цели проекта: 

1. Изучение внутреннего протокола обмена между программами iiko.  
2. Обеспечить работу с сервером iiko в удобном формате. 


Проект основан на [symfony-docker](https://github.com/dunglas/symfony-docker).
Проект не использует базу данных и __данные авторизации не хранятся на сервере__.

[Демонстрация](http://ikp.vladimir-sobolev.ru/swagger)


## Запуск сервера с помощью Docker Compose 

1. Если еще не установили, [install Docker Compose](https://docs.docker.com/compose/install/) (v2.10+)
2. Запустите `make build` для сборки проекта 
3. Запустите проект `make up` 
4. Откройте `https://localhost` в браузере и  [примените сгенерированный  TLS сертификат](https://stackoverflow.com/a/15076602/1352334)
5. Для остановки,  запустите команду `make down`.

## Документация на api 
1. /doc.json --  openapi файл 
2. /swagger --  swagger-ui

 
## Начало работы
 В первую очередь необходимо получить токен отправкой post запроса на /api/login. Где указываем url (адрес вашего сервера. Например: 'https://my-cloud.iiko.it:443/resto')
 и login/password (данные для входа на сервер). В случае если сервер ответил кодом 200, копируем токен и     
делаем нужный запрос подставляя токен в заголовок (Authorization: Bearer {you_token})

## Полезные ссылки

1. [Подробно про авторизацию](docs/auth.md). 
2. [Как работают запросы к серверу iiko](docs/iiko_request.md) 

