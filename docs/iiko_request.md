# Как работают запросы в iikoServer 
 
  Любой запрос к серверу должен содержать определенный данные в заголовках и теле запроса. 

  ## Заголовок
  
  Заголовок должен состоять из следующих ключей: 

1. Content-Type: значение  text/plain

2. X-Resto-CorrelationId: ключ uuidv4  который генерируется на каждый новый запрос 

3. X-Resto-LoginName:  Login вашей учетной записи

4. X-Resto-PasswordHash: хеш (sha1) пароля от учетной записи  

5. X-Resto-BackVersion:  версия вашего iikoOffice 

6. X-Resto-AuthType: значение "BACK"

7. X-Resto-ServerEdition: значение 'IIKO_RMS'. 

8. Accept-Language:  значение 'ru'

## Тело запроса

В замом запросе  данные оформляются в виде  xml , где корневой тег: args. 

Теги: 

 1. entities-version: Если нужны все данные то ставим значение в  -1. 

 2. client-type:  ставим значение  'BACK' 

 3. enable-warnings:  'false' или 'true'

 4. client-call-id: Должно быть равно значению из заголовка  'X-Resto-CorrelationId'

 5. license-hash: Значение получили при авторзизации  по адресу /services/authorization?methodName=getCurrentFingerPrints  

 6. restrictions-state-hash: Значение получили при авторзизации  по адресу /services/authorization?methodName=getCurrentFingerPrints 

7. obtained-license-connections-ids: оставим пустое

8. use-raw-entities: 'true'

9. revision: '-1'
