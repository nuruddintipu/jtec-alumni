<?php
require_once __DIR__ . '/../../utils/headers.php';
require_once __DIR__ . '/../../models/Notice.php';
include_once __DIR__ . '/../../config/db_config.php';

$database = new Database();
$db_connection = $database->getConnection();

$response = ['success' => false, 'message' => 'Invalid request'];

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $request_data = json_decode(file_get_contents('php://input'), true);
    if(!isset($request_data['title']) || !isset($request_data['content'])){
        http_response_code(400);
        $response['message'] = 'Title and content are required.';
        echo json_encode($response);
        exit;
    }
    $notice = new Notice($db_connection);
    $result = $notice->createNotice($request_data['title'], $request_data['content'], $request_data['created_by']);

    echo json_encode($result);
} elseif ($_SERVER['REQUEST_METHOD'] == 'GET'){
    $limit = isset($_GET['limit']) ? (int) $_GET['limit'] : 10;
    $page = isset($_GET['page']) ? (int) $_GET['page'] : 1;
    $created_by = isset($_GET['created_by']) ? (int) $_GET['created_by'] : null;

    if($limit <= 0) $limit = 10;
    if($page <= 0) $page = 1;

    $notice = new Notice($db_connection);
    $notices = $notice->getAllNotices($limit, $page, $created_by);
    echo json_encode(['success' => true, 'notices' => $notices]);
}