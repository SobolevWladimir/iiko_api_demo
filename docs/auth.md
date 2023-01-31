# Авторизация 

Для работы с api вам нужен токен, который вы можете получить выполнив post запрос на  адрес  {you_server}/api/login. 
В этом запросе вы передаете url вашего  iiko  сервера, который состоит из: 

1. Протокола (http, https) 
2. Доменного имени или ip  адреса
3. Порт  
4. Путь (Обычно это  /resto) 

Пример: 'https://my-cloud.iiko.it:443/resto'

Полные данные вы можете посмотреть в iikoOffice  при выборе сервера.
Также в запросе  передаете учетные данные. 

В этот момент происходят следующие вещи: 

1. Проверяется доступность сервера, делая запрос на получение информации о вашем сервере {you_iiko_server_url}/get_server_info.jsp?encoding=utf-8 

2. Проверяем корректность учетных данных  запросом по url: {you_iiko_server_url}/services/authorization?methodName=getCurrentFingerPrints 

В случае если все пункты выполнены успешно (сервере ответил статусом: 200), формируется токен куда записываются ваши  учетные данные, адрес сервера, а также данные о лицензии полученные  от сервера при последнем запросе. 
При каждом запросе к серверу эти данные эти данные используются для прохождения авторизации. 
 
