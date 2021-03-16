<?php
$email = $_POST['email'];
$title = $_POST['title'];
$content = $_POST['conent'];

$mailer = [
    'email' => $email,
    'title' => $title,
    'content' => $content,
];
//luu vao redis
$redis = new Redis();
$redis->connect('redis', 6379);
$arrData = [];
if($redis->exists('mail')) 
{
    $arrData = json_decode($redis->get('mail'));
}
array_push($arrData,$mailer);
$redis->delete('mail');
$redis->set('mail', json_encode($arrData));



// $mailer->sendMail();
header('Location: http://localhost:8082/');
?>

