<?php
$path = __DIR__ . '/../.env';
echo $path . '<br><br>';
echo 'File content: ' . file_get_contents($path) . '<br><br>';
$handle = fopen(__DIR__ . '/../.env', 'r');


$env = array();
if ($handle) {

    while ($string = fgets($handle)) {
        if (in_array(strtoupper($string[0]), range('A', 'Z'))) {
            $exploded = explode('=', $string);
            $env = array_merge($env, array($exploded[0] => $exploded[1]));
        }
    }
    
}
fclose($handle);

print_r($env);
// echo $env['DB_CONNECTION'];

class Env {
    public function __construct(array $env) {
        foreach ($env as $key => $value) {
            $this->$key = $value;
        }
    }
}

var_dump(new Env($env));


extract(include __DIR__ . '/../config/database.php');
// echo "mysql:host=$host;dbname=$database;charset=$charset";

$pdo = new PDO("mysql:host=$host;dbname=$database;charset=$charset", $username, $password);
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$tableName = $prefix . 'users';

$sql = "CREATE DATABASE IF NOT EXISTS `$database` DEFAULT CHARACTER SET $charset COLLATE $collation;
CREATE TABLE IF NOT EXISTS `$tableName` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `area_code` tinyint unsigned NOT NULL DEFAULT '7',
  `school_code` mediumint unsigned NOT NULL DEFAULT '7',
  `is_subscribed` tinyint(1) NOT NULL DEFAULT '0',
  `is_admin` tinyint(1) NOT NULL DEFAULT '0',
  `status_id` int unsigned NOT NULL DEFAULT '10',
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `odb_users_email_unique` (`email`),
  KEY `id` (`id`,`school_code`),
  KEY `area_code` (`area_code`)
) ENGINE=$engine AUTO_INCREMENT=1 DEFAULT CHARSET=$charset COLLATE=$collation;";

$pdo->exec($sql);

$sql = "SELECT `email`, `name` FROM $tableName;";

$result = $pdo->query($sql);

while ($row = $result->fetch()) {
    print_r(json_encode($row));
    echo '<br>';
}