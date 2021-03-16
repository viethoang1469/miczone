<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=cd, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <title>Miczone</title>
</head>

<body>
<?php
// phpinfo();
// die();
?>
    <div class="banner">
        <img src="img/banner.jpg" alt="">
    </div>
    <div class="menu">
        <ul>
            <li><a href="#">Trang chu</a></li>
            <li><a href="#">Danh muc</a></li>
            <li><a href="#">Tin tuc</a></li>
            <li><a href="#">Gioi thieu</a></li>
        </ul>
    </div>
    <div class="container">
        <div>
            <div class="">
                <div class="title">
                    <h2>Email</h2>
                    <hr>    
                </div>
                <form action="queue/email.php" id="email" method="post"> 
                    <input type="text" name="email" placeholder="Email...">
                    <input type="text" name="title" placeholder="Title...">
                    <input type="text" name="conent" placeholder="Content...">
                    <button type="submit"  >Submit</button>
                </form>
                
            </div>
            
        </div>
        <div>
            <div id="myDIV" class="header">
                <h2>My To Do List</h2>
                <form action="" id="form">
                    <input type="text" id="myInput" name="name" placeholder="Content...">
                    <button type="submit"  class="addBtn">Submit</button type="submit">
                </form>
            </div>
            <ul id="list">
            </ul>
        </div>
        
    </div>
    
    <footer>
        <p>Author: Viet Hoang<br>
        <a href="mailto:viethoang1541@gmail.com">viethoang1541@gmail.com</a></p>
      </footer>
      <script src="js/jquery.js"></script>
      <script src="js/my-js.js"></script>
</body>

</html>