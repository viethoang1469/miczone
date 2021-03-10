<?php
$servername = "mariadb";
$username = "root";
$password = "root";
$dbname = "db_todolist";

// Create connection
$conn = new mysqli($servername, $username, $password,$dbname);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
echo "Connected successfully";
// session_start();
// $arrListFirst = [
//     [
//         'id'     => 1,
//         'name'   => 'id 1',
//         'status' => 'done',
//     ],
//     [
//         'id'     => 2,
//         'name'   => 'id 22',
//         'status' => 'not_done_yet',
//     ],
//     [
//         'id'     => 3,
//         'name'   => 'id 3',
//         'status' => 'done',
//     ],
// ];
// if(!isset($_SESSION['arrList']))
// {
//     $_SESSION['arrList'] = $arrListFirst;
// }
// $arrList = $_SESSION['arrList'];


// $action = $_REQUEST['action'];
// $action($_SESSION['arrList'], $_REQUEST);
// function toDoList($arrList, $params) {
    
//     try {
//         $arrResponse = [
//         'code'    => 200,
//         'success' => true,
//         'data'    => $arrList,
//         'error'   => null,
//         'message' => 'lay du lieu thanh cong',
//         ];
//         if(!isset($arrList))
//         {
//             $arrResponse = [
//                 'code'    => 404,
//                 'success' => false,
//                 'error'   => null,
//                 'error' => null,
//                 'message' => 'lay du lieu ko thanh cong',
//             ];
//         }
        
//     } catch (Exception $e) {
//         $arrResponse = [
//             'code'    => 404,
//             'success' => false,
//             'error' => [
//                 'loi' => 'loi',
//             ],
//             'message' => $e->getMessage(),
//         ];
//     }
//     header('Content-Type: application/json');
//     echo json_encode($arrResponse);
    
    
// }
// function add(&$arrList, $params)
// {
//     try{
//         if($params['name'] === '')
//         {
//             $arrResponse = [
//                 'code'    => 400,
//                 'success' => false,
//                 'message' => 'rong',
//                 'error'   => null,
//             ];
//             header('Content-Type: application/json');
//             echo json_encode($arrResponse);
//             exit();
//         }
//         $txtName = $params['name'];
//         $intId = end($arrList)['id'] + 1;
//         $arrNode = [
//             'id'      => $intId,
//             'name'    => $txtName,
//             'status'  => 'not_done_yet',
//         ];
//         array_push($arrList, $arrNode);
//         $arrResponse = [
//             'code'    => 201,
//             'success' => true,
//             'message' => 'them du lieu thanh cong',
//             'error'   => null,
//             'data'    => $arrNode,
//         ];
//     }catch (Exception $e) {
//         $arrResponse = [
//             'code'    => 404,
//             'success' => false,
//             'error' => [
//                 'loi' => 'loi',
//             ],
//             'message' => $e->getMessage(),
//         ];
//     }
    
    
//     header('Content-Type: application/json');
//     echo json_encode($arrResponse);
// }
// function edit(&$arrList, $params) // params: id , old_status
// {
//     try{
//         $flag = false;
//         if(!isset($params['id']))
//         {
//             $arrResponse = [
//                 'code'    => 404,
//                 'success' => false,
//                 'message' => 'khong tim thay item',
//                 'error' => [
//                     'loi' => 'khong tim thay item',
//                 ],
//             ];
//             header('Content-Type: application/json');
//             echo json_encode($arrResponse);
//             exit();
//         }
//         foreach($arrList as $key => $val)
//         {
//             if($val['id'] === (int)$params['id'])
//             {
//                 $arrList[$key]['status'] = ($params['old_status'] === 'done') ? 'not_done_yet' : 'done';
//                 $arrNode = $arrList[$key];
//                 $flag = true;
//                 break;
//             }
//         }
//         if($flag === false)
//         {
//             $arrResponse = [
//                 'code'    => 404,
//                 'success' => false,
//                 'message' => 'khong tim thay item',
//                 'error' => [
//                     'loi' => 'khong tim thay item',
//                 ],
//             ];
//             header('Content-Type: application/json');
//             echo json_encode($arrResponse);
//             exit();
//         }
//         else {
//             $arrResponse = [
//                 'code'    => 204,
//                 'success' => true,
//                 'message' => 'cap nhat du lieu thanh cong',
//                 'error' => null,
//                 'data'    => $arrNode,
//             ];
//             header('Content-Type: application/json');
//             echo json_encode($arrResponse);
//             exit();
//         }
//     }catch (Exception $e) {
//         $arrResponse = [
//             'code'    => 404,
//             'success' => false,
//             'error' => [
//                 'loi' => 'loi',
//             ],
//             'message' => $e->getMessage(),
//         ];
//         header('Content-Type: application/json');
//         echo json_encode($arrResponse);
//     }
    
// }
// function delete(&$arrList, $params){
//     try{
//         $flag = false;
//         if(!isset($params['id']))
//         {
//             $arrResponse = [
//                 'code'    => 404,
//                 'success' => false,
//                 'message' => 'khong tim thay item can xoa',
//                 'error' => [
//                     'loi' => 'khong tim thay item',
//                 ],
//             ];
//             header('Content-Type: application/json');
//             echo json_encode($arrResponse);
//             exit();
//         }
//         foreach($arrList as $key => $val)
//         {
//             if($val['id'] === (int)$params['id'])
//             {
//                 $arrNode = $arrList[$key];
//                 unset($arrList[$key]);
//                 $flag = true;
//                 break;
//             }
//         }
//         if($flag === false)
//         {
//             $arrResponse = [
//                 'code'    => 404,
//                 'success' => false,
//                 'message' => 'khong tim thay item can xoa',
//                 'error' => [
//                     'loi' => 'khong tim thay item',
//                 ],
//             ];
//             header('Content-Type: application/json');
//             echo json_encode($arrResponse);
//             exit();
//         }
//         else {
//             $arrResponse = [
//                 'code'    => 204,
//                 'success' => true,
//                 'message' => 'xoa du lieu thanh cong',
//                 'error' => null,
//                 'data'    => $arrNode,
//             ];
//             header('Content-Type: application/json');
//             echo json_encode($arrResponse);
//             exit();
//         }
//     }catch (Exception $e) {
//         $arrResponse = [
//             'code'    => 404,
//             'success' => false,
//             'error' => [
//                 'loi' => 'loi',
//             ],
//             'message' => $e->getMessage(),
//         ];
//         header('Content-Type: application/json');
//         echo json_encode($arrResponse);
//     }
    
// }