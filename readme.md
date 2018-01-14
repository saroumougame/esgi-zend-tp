ESGI - TP ZEND AROUMOUGAME Sridar 4IW
---------------------------------------------



DOCKER


```php
docker-compose up -d

```

BDD

```php

php vendor/bin/doctrine-module orm:schema-tool:update
 

```

 L'option --dump-sql permet de vérifier le script SQL qui sera effectué, alors que --force permet d'executer le SQL sur la base de données en question. 

Acces a l'application

```php
http://localhost:8080
```
PhpMyAdmin:
```php
http://localhost:8080

utilisateur : demo
mdp : demo
```