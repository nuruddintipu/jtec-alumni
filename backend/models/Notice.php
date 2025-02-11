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

    public function getNotice($limit = 10, $page = 1, $created_by = null, $id = null) {
        $offset = ($page - 1) * $limit;
        $query = "SELECT * FROM notices";
        $conditions = [];
        $params = [];

        if ($created_by) {
            $conditions[] = "created_by = :created_by";
            $params[':created_by'] = $created_by;
        }
        if ($id) {
            $conditions[] = "id = :id";
            $params[':id'] = $id;
        }

        if (!empty($conditions)) {
            $query .= " WHERE " . implode(" AND ", $conditions);
        }

        $query .= " ORDER BY created_at DESC LIMIT :limit OFFSET :offset";

        $prepare_statement = $this->connection->prepare($query);

        foreach ($params as $key => $value) {
            $prepare_statement->bindValue($key, $value, PDO::PARAM_STR);
        }
        $prepare_statement->bindValue(':limit', $limit, PDO::PARAM_INT);
        $prepare_statement->bindValue(':offset', $offset, PDO::PARAM_INT);

        $prepare_statement->execute();
        return $prepare_statement->fetchAll(PDO::FETCH_ASSOC);
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