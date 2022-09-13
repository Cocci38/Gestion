<?php

// Constante qui est un chemin qui pointe vers le dossier des vues (dirname(__DIR__) renvoie vers le dossier)
// dirname — Renvoie le chemin du dossier parent
define ('VIEWS' , dirname(__DIR__) . DIRECTORY_SEPARATOR . 'views' . DIRECTORY_SEPARATOR);
// Contante qui envoie vers nos dossiers de script (dirname($_SERVER['SCRIPT_NAME']) pour avoir un bon chemin vers les scripts)
define('SCRIPTS' , dirname($_SERVER['SCRIPT_NAME']). DIRECTORY_SEPARATOR);
define('DB_NAME', 'magasin');
define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PWD', '');
?>