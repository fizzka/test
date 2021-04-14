Тестовое задание
============================
Функция getRankedList в классе RankService реализует необходимую логику

Для запуска тестов через docker-compose:
~~~
docker-compose exec php-fpm composer exec phpunit tests/unit/RankServiceTest.php --working-dir=/var/www/test
~~~

Возможные улучшения
============================
Можно в RankService добавить валидацию данных команд

CURLService добавлен для примера реализации URLLoader

Количество комментариев зависит от проекта, в данном случае их возможно более чем достаточно

Ошибки сделаны через стандартные Exception, можно заменить на специализированные