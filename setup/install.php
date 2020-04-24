<?php

    class Installer {
/**
 * Open a connection via PDO to create a
 * new database and table with structure.
 *
 */

        private $config = [];

        public $db;

        function configure() {
            require "private/core/config/database.php";
        }

        function install() {
            if (isset($this->config["database"])) {
                try {
                        $dsn = $this->config["database"]["driver"] . ":" .
                        "host=" . $this->config["database"]["dbhost"] .
                        ";dbname=" . $this->config["database"]["dbname"];
                    $this->db = new PDO(
                        $dsn
                        , $this->config["database"]["username"]
                        , $this->config["database"]["password"]
                    );

                        $sql = file_get_contents("setup/data/init.sql");
                        
                        echo($sql);
                        
                        $this->db->exec($sql);
                        
                        echo "Database setup successfully.\n";
                } catch(PDOException $ex) {
                    echo($ex->getMessage());
                }
            }
        }
    }

$installer = new Installer();
$installer->configure();
$installer->install();

?>