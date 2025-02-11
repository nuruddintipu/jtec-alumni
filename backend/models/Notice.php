<?php
require_once __DIR__ . '/../config/db_config.php';
require_once __DIR__ . '/../utils/generateGuid.php';
class Notice {
    private $connection;

    public function __construct($db) {
        $this->connection = $db;
    }

    public function createNotice($title, $content, $created_by): array
    {
        $noticeId = generateGuid();
        $date = date('Y-m-d H:i:s');
        $insert_query = "INSERT INTO notices (id, title, content, created_by, created_at, updated_at) 
                     VALUES (:id, :title, :content, :created_by, :created_at, :updated_at)";

        $prepare_statement = $this->connection->prepare($insert_query);

        $prepare_statement->bindParam(':id', $noticeId);
        $prepare_statement->bindParam(':title', $title);
        $prepare_statement->bindParam(':content', $content);
        $prepare_statement->bindParam(':created_by', $created_by);
        $prepare_statement->bindParam(':created_at', $date);
        $prepare_statement->bindParam(':updated_at', $date);

        if($prepare_statement->execute()) {
            return ['success' => true, 'message' => 'Notice created successfully.', 'notice_id' => $noticeId];
        } else {
            $error = $prepare_statement->errorInfo();

            if($error[0] == '23000') {
                http_response_code(400);
                return ['success' => false, 'message' => 'Notice already exists.'];
            }
            http_response_code(500);
            return ['success' => false, 'message' => $error];
        }
    }

    public function getAllNotices($limit = 10, $page = 1, $created_by = null) {
        $offset = ($page - 1) * $limit;
        $query = "SELECT * FROM notices";
        $params = [];

        if ($created_by) {
            $query .= " WHERE created_by = :created_by";
            $params[':created_by'] = $created_by;
        }

        $query .= " ORDER BY created_at DESC LIMIT :limit OFFSET :offset";

        $prepare_statement = $this->connection->prepare($query);

        if ($created_by) {
            $prepare_statement->bindParam(':created_by', $created_by, PDO::PARAM_STR);
        }
        $prepare_statement->bindParam(':limit', $limit, PDO::PARAM_INT);
        $prepare_statement->bindParam(':offset', $offset, PDO::PARAM_INT);

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