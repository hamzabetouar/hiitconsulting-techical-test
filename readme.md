# HiitConsulting : test technique

## Configuration de la base de donnée

Editer le fichier config/database.php

`return [
     'dbname'    => 'hiitconsulting_tchat',
     'host'      => '127.0.0.1',
     'user'      => 'root',
     'password'  => null,
 ];`
 
 ## MySQL
 
 Créer la base de donnée MySQL et importer le fichier database.sql


## Serveur web

Par ligne de commande :

`php -S localhost:8000 -t public`

Ou par wamp, xampp, mamp


## Application

`http://localhost:8000`