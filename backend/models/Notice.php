<?php
require_once __DIR__ . '/../config/db_config.php';
require_once __DIR__ . '/../utils/generateGuid.php';
class Notice {
    private $connection;

    public function __construct($db) {
        $this->connection = $db;
    }

    public function createNotice($title, $content, $admin_id) {
        $noticeId = generateGuid();
        $date = date('Y-m-d H:i:s');
        $insert_query = "INSERT INTO notices (id, title, content, creator_id, published_at) 
                     VALUES (:id, :title, :content, :creator_id, :published_at)";

        $prepare_statement = $this->connection->prepare($insert_query);

        $prepare_statement->bindParam(':id', $noticeId);
        $prepare_statement->bindParam(':title', $title);
        $prepare_statement->bindParam(':content', $content);
        $prepare_statement->bindParam(':creator_id', $admin_id);
        $prepare_statement->bindParam(':published_at', $date);

        return $prepare_statement->execute();
    }

    public function getAllNotices(){
        $query = "SELECT * FROM notices";
        $prepare_statement = $this->connection->prepare($query);
        $prepare_statement->execute();
        return $prepare_statement->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getNotice($notice_id) {
        $query = "SELECT * FROM notices WHERE notice_id = :notice_id";
        $prepare_statement = $this->connection->prepare($query);

        $prepare_statement->bindParam(':notice_id', $notice_id);
        $prepare_statement->execute();
        return $prepare_statement->fetch(PDO::FETCH_ASSOC);
    }

    public function updateNotice($notice_id, $title, $content) {
        $query = "UPDATE notices SET title = :title, content = :content WHERE notice_id = :notice_id";
        $prepare_statement = $this->connection->prepare($query);
        $prepare_statement->bindParam(':notice_id', $notice_id);
        $prepare_statement->bindParam(':title', $title);
        $prepare_statement->bindParam(':content', $content);
        return $prepare_statement->execute();
    }

    public function deleteNotice($notice_id) {
        $query = "DELETE FROM notices WHERE notice_id = :notice_id";
        $prepare_statement = $this->connection->prepare($query);
        $prepare_statement->bindParam(':notice_id', $notice_id);
        return $prepare_statement->execute();
    }

}