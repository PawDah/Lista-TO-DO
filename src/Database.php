<?php

namespace MyApp\src;

use PDO;

class Database
{
        public \PDO $pdo;
        public function __construct(array $config)
        {
            $dsn=$config['dsn'] ?? '';
            $user=$config['user'] ?? '';
            $password=$config['password'] ?? '';

            $this->pdo=new PDO($dsn,$user,$password);
            $this->pdo->setAttribute(\PDO::ATTR_ERRMODE,\PDO::ERRMODE_EXCEPTION);

        }
        public function applyMigrations()
        {
            $this->createMigrationsTable();
            $appliedMigrations = $this->getAppliedMigrations();

            $newMigrations=[];


            $files = scandir(Application::$ROOT_DIR.'/migrations');
            $migrationsToApply = array_diff($files,$appliedMigrations);

            foreach ($migrationsToApply as $migration) {
                if ($migration ==='.' || $migration === '..'){
                    continue;
                }

                require_once Application::$ROOT_DIR.'/migrations/'.$migration;
                $className = pathinfo($migration, PATHINFO_FILENAME);

                $instance = new $className();
                echo "Dodawanie migracji $migration".PHP_EOL;
                $instance->up();
                echo "Dodano migracje $migration".PHP_EOL;

                $newMigrations[] = $migration;
            }
            if(!empty($newMigrations)){
                $this->saveMigrations($newMigrations);

            } else{
             echo  "Wszytskie Migracje są dodane";
            }


        }

        public function createMigrationsTable()
        {
            $this->pdo->exec("CREATE TABLE IF NOT EXISTS migrations (
            id INT AUTO_INCREMENT PRIMARY KEY,
            migration VARCHAR(255),
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
        )  ENGINE=INNODB;");
        }

    public function getAppliedMigrations()
    {
      $statement = $this->pdo->prepare("SELECT migration FROM migrations");
      $statement->execute();

      return $statement->fetchAll(\PDO::FETCH_COLUMN);
    }

    public function saveMigrations(array $migrations)
    {
        $str = implode(",", array_map(fn($m) => "('$m')",$migrations));
        $statement = $this->pdo->prepare("INSERT INTO migrations (migration) VALUES 
        $str
                                       ");
        $statement->execute();
    }


}