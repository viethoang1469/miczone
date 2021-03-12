<?php

include 'model.php';
include 'response.php';


$action = $_REQUEST['action'];

$redis = new Redis();
$redis->connect('redis', 6379);
$action($redis, $_REQUEST);
function toDoList($redis, $params) {
    if($redis->exists('list'))
    {
        
        $arrList = json_decode($redis->get('list'));
    }
    else{
        $model = new model();
        $arrList = $model->GetAllData();
        $redis->set('list', json_encode($arrList));
        $redis->expire('list', 86400); // 1 ngay
    }
    $response = new response();
    try {
        
        $response->set(200, true, $arrList, null, 'lay du lieu thanh cong');
        
        if(!isset($arrList))
        {
            $response->set(404, false, null, null, 'lay du lieu khong thanh cong');
        }
        
        
    } catch (Exception $e) {
        $response->set(404, false, null, ['loi' => 'loi'], $e->getMessage());
    }
    $arrResponse = $response->getResponse();
    header('Content-Type: application/json');
    echo json_encode($arrResponse);
    
    
}
function add($redis, $params)
{
    $response = new response();
    try{
        $model = new model();
        if($params['name'] === '')
        {
            $response->set(400, false, null, null, 'rong');
            $arrResponse = $response->getResponse();
            header('Content-Type: application/json');
            echo json_encode($arrResponse);
            exit();
        }
        $txtName = $params['name'];
        $intId = $model->insert($txtName, 'not_done_yet');
        $redis->delete('list');
        $arrNode = [
            'id'      => $intId,
            'name'    => $txtName,
            'status'  => 'not_done_yet',
        ];
        $response->set(201, true, $arrNode, null, 'them du lieu thanh cong');
        
    }catch (Exception $e) {
        $response->set(404, false, null, ['loi' => 'loi'], $e->getMessage());
    }
    
    $arrResponse = $response->getResponse();
    header('Content-Type: application/json');
    echo json_encode($arrResponse);
}
function edit($redis, $params) // params: id , old_status
{
    $response = new response();
    try{
        $model = new model();
        $flag = false;
        if(!isset($params['id']))
        {
            $response->set(404, false, null, ['loi' => 'khong tim thay item'], 'khong tim thay item');
            $arrResponse = $response->getResponse();
            header('Content-Type: application/json');
            echo json_encode($arrResponse);
            exit();
        }
        $status = ($params['old_status'] === 'done') ? 'not_done_yet' : 'done';
        $flag = $model->edit($params['id'], $status);
        if($flag === false)
        {
            $response->set(404, false, null, ['loi' => 'khong sua duoc'], 'khong sua duoc');
            $arrResponse = $response->getResponse();
            header('Content-Type: application/json');
            echo json_encode($arrResponse);
            exit();
        }
        
        $redis->delete('list');
        $response->set(204, true, null, null, 'cap nhat du lieu thanh cong');
        $arrResponse = $response->getResponse();
        header('Content-Type: application/json');
        echo json_encode($arrResponse);
        exit();
        
    }catch (Exception $e) {
        $response->set(404, false, null, ['loi' => 'loi'], $e->getMessage());
        $arrResponse = $response->getResponse();
        header('Content-Type: application/json');
        echo json_encode($arrResponse);
    }
    
}
function delete($redis, $params){
    $response = new response();
    try{
        $model = new model();
        $flag = false;
        if(!isset($params['id']))
        {
            $response->set(404, false, null, ['loi' => 'khong tim thay item'], 'khong tim thay item can xoa');
            $arrResponse = $response->getResponse();
            header('Content-Type: application/json');
            echo json_encode($arrResponse);
            exit();
        }
        $intId = $model->delete($params['id']);
        if($intId === false)
        {
            $response->set(404, false, null, ['loi' => 'khong xoa duoc'], 'khong xoa duoc');
            $arrResponse = $response->getResponse();
            header('Content-Type: application/json');
            echo json_encode($arrResponse);
            exit();
        }
        
        $response->set(204, true, null, null, 'xoa du lieu thanh cong');
        $arrResponse = $response->getResponse();
        $redis->delete('list');
        header('Content-Type: application/json');
        echo json_encode($arrResponse);
        exit();
        
    }catch (Exception $e) {
        
        $response->set(404, false, null, ['loi' => 'loi'],$e->getMessage());
        $arrResponse = $response->getResponse();
        header('Content-Type: application/json');
        echo json_encode($arrResponse);
    }
    
}
