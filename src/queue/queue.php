<?php
include 'mailer.php';
error_reporting(0);
$redis = new Redis();
$redis->connect('127.0.0.1', 6378);

$arrData = json_decode($redis->get('mail'), true);
// echo '<pre>';
// print_r($arrData);
// echo '</pre>';
// $redis->delete('mail');
// die();

for($i=1; true; $i++)
{
    sleep(1);
    try{
        if($redis->exists('mail'))
        {
            $arrData = json_decode($redis->get('mail'), true);
            $redis->DEL('mail'); // xoa redis de them lai
    
            $mail = $arrData[0];
            unset($arrData[0]);
            @$arrData = array_values($arrData);
            $redis->set('mail', json_encode($arrData));
    
            
            $email = $mail['email'];
            $title = $mail['title'];
            $content = $mail['content'];
    
            $mailer = new mailer();
            $mailer->setReceiver($email);
            $mailer->setContent($title, $content);
            $flag =  $mailer->send();
            if($flag)
            {
                echo 'gui mail thanh cong, loop: i = ' . $i;
            }
            // echo  $i . ' | ';

            
    
            
        }
    }catch(Exception $e)
    {

    }
    
    
    
}
