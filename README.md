Тестовое задание
============================
Функция getRankedList в классе App\Services\RankService реализует необходимую логику

Для запуска тестов через docker-compose:
~~~
docker-compose exec php-fpm composer exec phpunit tests/unit/RankServiceTest.php --working-dir=/var/www/test
~~~

Возможные улучшения
============================
Можно в RankService добавить валидацию данных команд(поля, отрицательные очки и все такое)

Можно добавить валидацию для URL

Можно сделать специальные DTO для данных

CURLService добавлен для примера реализации URLLoader

Количество комментариев зависит от проекта, в данном случае их возможно более чем достаточно

Ошибки сделаны через стандартные Exception, можно заменить на специализированные