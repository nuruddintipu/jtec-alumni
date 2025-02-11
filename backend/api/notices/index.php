<?php
require_once __DIR__ . '/../../utils/headers.php';
require_once __DIR__ . '/../../models/NoticeService.php';
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
    $created_by = $request_data['created_by'] ?? null;
    $notice = new NoticeService($db_connection);
    $result = $notice->createNotice($request_data['title'], $request_data['content'], $created_by);

    echo json_encode($result);
} elseif ($_SERVER['REQUEST_METHOD'] == 'GET'){
    $limit = isset($_GET['limit']) ? (int) $_GET['limit'] : 10;
    $page = isset($_GET['page']) ? (int) $_GET['page'] : 1;
    $created_by = isset($_GET['created_by']) ? (int) $_GET['created_by'] : null;
    $id = $_GET['id'] ?? null;

    if($limit <= 0) $limit = 10;
    if($page <= 0) $page = 1;

    $notice = new NoticeService($db_connection);
    $notices = $notice->getNotice($limit, $page, $created_by, $id);
    echo json_encode(['success' => true, 'notices' => $notices]);
} elseif ($_SERVER['REQUEST_METHOD'] == 'PUT'){
    $request_data = json_decode(file_get_contents('php://input'), true);
    if(!isset($request_data['id'])){
        http_response_code(400);
        $response['message'] = 'ID is required.';
        echo json_encode($response);
        exit;
    }

    $notice = new NoticeService($db_connection);
    $updatedTitle = $request_data['title'] ?? null;
    $updatedContent = $request_data['content'] ?? null;

    if (!$updatedTitle && !$updatedContent) {
        http_response_code(400);
        $response['message'] = 'At least one of title or content must be provided.';
        echo json_encode($response);
        exit;
    }


    $result = $notice->updateNotice($request_data['id'], $updatedTitle, $updatedContent);

    if(!$result){
        http_response_code(400);
        $response['message'] = 'Failed to update notice.';
    } else {
        http_response_code(200);
        $response['success'] = true;
        $response['message'] = 'Notice updated successfully.';
    }
    echo json_encode($response);
} elseif($_SERVER['REQUEST_METHOD'] == 'DELETE'){
    $request_data = json_decode(file_get_contents('php://input'), true);
    if(!isset($request_data['id'])){
        http_response_code(400);
        $response['message'] = 'ID is required.';
    }
    $notice = new NoticeService($db_connection);
    $result = $notice->deleteNotice($request_data['id']);
    if(!$result){
        http_response_code(400);
        $response['message'] = 'Failed to delete notice.';
        echo json_encode($response);
    } else {
        http_response_code(200);
        $response['success'] = true;
        $response['message'] = 'Notice deleted successfully.';
        echo json_encode($response);
    }

}