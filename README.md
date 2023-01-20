# Iiko Protokol API

    Это сервер который позволяет работать с iiko без iikoBiz или iikoCloud. 

⚠️ Это неофициальная библиотека. 

Этот проет нацелен на изучение внeтреннго протокола обмена  между  сервером iiko  и клиентами(iikoOffice). Проект основан на [symfony-docker](https://github.com/dunglas/symfony-docker)


## Начало работы 

1. Если еще не установили, [install Docker Compose](https://docs.docker.com/compose/install/) (v2.10+)
2. Запустите `make build --pull --no-cache` для сборки проекта 
3. Зфпустите проект `make up` 
4. Откройте `https://localhost` в браузере и  [примените сгенерированный  TLS сертификат](https://stackoverflow.com/a/15076602/1352334)
5. Для остановки  запустите команду `make down`.


## Документация

1. 

## License

Symfony Docker is available under the MIT License.

## Credits

Created by [Kévin Dunglas](https://dunglas.fr), co-maintained by [Maxime Helias](https://twitter.com/maxhelias) and sponsored by [Les-Tilleuls.coop](https://les-tilleuls.coop).
