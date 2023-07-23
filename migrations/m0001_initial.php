<?php

class m0001_initial {
    public function up()
    {
       $db = \MyApp\src\Application::$app->db;
       $SQL="CREATE TABLE note (
  `id` bigint(20) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  `title` varchar(500) NOT NULL,
  `description` varchar(1500) NOT NULL,
  `start_date` datetime  NOT NULL,
  `end_date` datetime NOT NULL
);CREATE TABLE comments (
  `comment_id` bigint(20) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  `comment` varchar(500) NOT NULL,
  `comment_Note` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;";
       $db->pdo->exec($SQL);
    }
    public function down()
    {
        $db = \MyApp\src\Application::$app->db;
        $SQL="DROP TABLE note";
       $db->pdo->exec($SQL);
    }

}