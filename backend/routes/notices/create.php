<?php

require_once __DIR__ . '/../../config/db_config.php';
require_once __DIR__ . '/../../models/Notice.php';

$database = new Database();
$db = $database->getConnection();

$request_data = json_decode(file_get_contents('php://input'), true);

$response = ['success' => false, 'message' => 'Failed to create notice.'];

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    if(isset($request_data['title'], $request_data['content'], $request_data['creator_id'])){
        $notice = new Notice($db);
        if($notice->createNotice($request_data['title'], $request_data['content'], $request_data['creator_id'])){
            $response['success'] = true;
            $response['message'] = 'Notice created successfully.';
        }
    } else {
        $response['message'] = 'Missing required fields.';
    }
} else {
    $http_response_code = 405;
    $response['message'] = 'Method not allowed.';
}