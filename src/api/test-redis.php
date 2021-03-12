<?php
    // Khởi tạo lớp
    $redis = new Redis();

    // Thiết lập kết nối
    $redis->connect('redis', 6379);
    

    // dùng sock
    // $redis->connect('/tmp/redis.sock');


    // Nhập password nếu cần
    // $redis->auth("");

    // Kiểm tra xem Server Redis hoạt động không
    if ($redis->ping() === true)
    {
        echo 'workerd';
        die;
    }
    echo "Redis Server not running ...";
    
