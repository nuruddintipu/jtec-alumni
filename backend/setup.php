<?php
require_once __DIR__ . '/config/db_config.php';

class Setup{
    private $db;

    public function __construct(){
        $database = new Database();
        $this->db = $database->getConnection();
    }

    public function run(){
        $sql = file_get_contents(__DIR__ . '/database/schema.sql');
        error_log($sql);
        try {
            $this->db->exec($sql);
            echo "Database tables created successfully";
        } catch (PDOException $exception) {
            echo "Database tables creation failed: " . $exception->getMessage();
        }
    }
}

$setup = new Setup();
$setup->run();