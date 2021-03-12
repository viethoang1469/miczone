<?php
include 'model.php';


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
        $redis->expire('list', 259200); // 3 days
    }
    try {
        $arrResponse = [
        'code'    => 200,
        'success' => true,
        'data'    => $arrList,
        'error'   => null,
        'message' => 'lay du lieu thanh cong',
        ];
        if(!isset($arrList))
        {
            $arrResponse = [
                'code'    => 404,
                'success' => false,
                'error'   => null,
                'error' => null,
                'message' => 'lay du lieu ko thanh cong',
            ];
        }
        
    } catch (Exception $e) {
        $arrResponse = [
            'code'    => 404,
            'success' => false,
            'error' => [
                'loi' => 'loi',
            ],
            'message' => $e->getMessage(),
        ];
    }
    header('Content-Type: application/json');
    echo json_encode($arrResponse);
    
    
}
function add($redis, $params)
{
  $model = new model();
    try{
        if($params['name'] === '')
        {
            $arrResponse = [
                'code'    => 400,
                'success' => false,
                'message' => 'rong',
                'error'   => null,
            ];
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
        $arrResponse = [
            'code'    => 201,
            'success' => true,
            'message' => 'them du lieu thanh cong',
            'error'   => null,
            'data'    => $arrNode,
        ];
    }catch (Exception $e) {
        $arrResponse = [
            'code'    => 404,
            'success' => false,
            'error' => [
                'loi' => 'loi',
            ],
            'message' => $e->getMessage(),
        ];
    }
    
    
    header('Content-Type: application/json');
    echo json_encode($arrResponse);
}
function edit($redis, $params) // params: id , old_status
{
    try{
      $model = new model();
        $flag = false;
        if(!isset($params['id']))
        {
            $arrResponse = [
                'code'    => 404,
                'success' => false,
                'message' => 'khong tim thay item',
                'error' => [
                    'loi' => 'khong tim thay item',
                ],
            ];
            header('Content-Type: application/json');
            echo json_encode($arrResponse);
            exit();
        }
        $status = ($params['old_status'] === 'done') ? 'not_done_yet' : 'done';
        $flag = $model->edit($params['id'], $status);
        if($flag === false)
        {
            $arrResponse = [
                'code'    => 404,
                'success' => false,
                'message' => 'khong sua duoc',
                'error' => [
                    'loi' => 'khong sua duoc',
                ],
            ];
            header('Content-Type: application/json');
            echo json_encode($arrResponse);
            exit();
        }
        else {
            $redis->delete('list');
            $arrResponse = [
                'code'    => 204,
                'success' => true,
                'message' => 'cap nhat du lieu thanh cong',
                'error' => null,
            ];
            header('Content-Type: application/json');
            echo json_encode($arrResponse);
            exit();
        }
    }catch (Exception $e) {
        $arrResponse = [
            'code'    => 404,
            'success' => false,
            'error' => [
                'loi' => 'loi',
            ],
            'message' => $e->getMessage(),
        ];
        header('Content-Type: application/json');
        echo json_encode($arrResponse);
    }
    
}
function delete($redis, $params){
    try{
        $model = new model();
        $flag = false;
        if(!isset($params['id']))
        {
            $arrResponse = [
                'code'    => 404,
                'success' => false,
                'message' => 'khong tim thay item can xoa',
                'error' => [
                    'loi' => 'khong tim thay item',
                ],
            ];
            header('Content-Type: application/json');
            echo json_encode($arrResponse);
            exit();
        }
        $intId = $model->delete($params['id']);
        if($intId === false)
        {
            $arrResponse = [
                'code'    => 404,
                'success' => false,
                'message' => 'khong xoa duoc',
                'error' => [
                    'loi' => 'khong xoa duoc',
                ],
            ];
            header('Content-Type: application/json');
            echo json_encode($arrResponse);
            exit();
        }
        
        $arrResponse = [
            'code'    => 204,
            'success' => true,
            'message' => 'xoa du lieu thanh cong',
            'error' => null,
        ];
        $redis->delete('list');
        header('Content-Type: application/json');
        echo json_encode($arrResponse);
        exit();
        
    }catch (Exception $e) {
        $arrResponse = [
            'code'    => 404,
            'success' => false,
            'error' => [
                'loi' => 'loi',
            ],
            'message' => $e->getMessage(),
        ];
        header('Content-Type: application/json');
        echo json_encode($arrResponse);
    }
    
}