<?php
require_once __DIR__ . '/../config/db_config.php';
require_once __DIR__ . '/../utils/generateGuid.php';
date_default_timezone_set('Asia/Dhaka');

class NoticeService {
    private $connection;

    public function __construct($db) {
        $this->connection = $db;
    }

    public function createNotice($title, $content, $created_by): array
    {
        $noticeId = generateGuid();
        $date = date('Y-m-d H:i:s');
        $query = "INSERT INTO notices (id, title, content, created_by, created_at, updated_at) 
                     VALUES (:id, :title, :content, :created_by, :created_at, :updated_at)";

        $params = [
            ':id' => $noticeId,
            ':title' => $title,
            ':content' => $content,
            ':created_by' => $created_by,
            ':created_at' => $date,
            ':updated_at' => $date
        ];

        return $this->executeQuery($query, $params, function() use ($noticeId) {
            return ['success' => true, 'message' => 'Notice created successfully.', 'notice_id' => $noticeId];
        });
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

        $this->bindParams($prepare_statement, $params);
        $prepare_statement->bindParam(':limit', $limit, PDO::PARAM_INT);
        $prepare_statement->bindParam(':offset', $offset, PDO::PARAM_INT);

        $prepare_statement->execute();
        return $prepare_statement->fetchAll(PDO::FETCH_ASSOC);
    }



    public function updateNotice($id, $title=null, $content=null) {
        $fields = ['updated_at = :updated_at'];
        $params = [':id' => $id, ':updated_at' => date('Y-m-d H:i:s')];

        if($title !== null){
            $fields[] = "title = :title";
            $params[':title'] = $title;
        }
        if($content !== null){
            $fields[] = "content = :content";
            $params[':content'] = $content;
        }
        if(empty($fields)){
            return false;
        }

        $query = "UPDATE notices SET " . implode(", ", $fields) . " WHERE id = :id";
        $prepare_statement = $this->executeQuery($query, $params);

        foreach ($params as $key => $value) {
            $type = is_int($value) ? PDO::PARAM_INT : PDO::PARAM_STR;
            $prepare_statement->bindValue($key, $value, $type);
        }

        return $prepare_statement->execute();
    }

    public function deleteNotice($id) {
        $query = "DELETE FROM notices WHERE id = :id";
        $params = [':id' => $id];
        return $this->executeQuery($query, $params);
    }

    private function executeQuery($query, $params, callable $onSuccess = null) {
        $prepare_statement = $this->connection->prepare($query);
        $this->bindParams($prepare_statement, $params);

        if($prepare_statement->execute()) {
            return $onSuccess ? $onSuccess() :  ['success' => true, 'message' => 'Notice created successfully.'];
        }

        return $this->handleQueryError($prepare_statement);

    }
    private function handleQueryError($prepare_statement): array
    {
        $error = $prepare_statement->errorInfo();
        if($error[0] == '23000') {
            http_response_code(400);
            return ['success' => false, 'message' => 'Notice already exists.'];
        }
        http_response_code(500);
        return ['success' => false, 'message' => $error[2]];
    }

    private function bindParams($stmt, $params)
    {
        foreach ($params as $key => $value) {
            $type = is_int($value) ? PDO::PARAM_INT : PDO::PARAM_STR;
            $stmt->bindValue($key, $value, $type);
        }
    }

}