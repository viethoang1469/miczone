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
                    <h2>To do list</h2>
                    <hr>    
                </div>
                <ul id="" class="list-left">
                    <li><a href="#">All</a></li>
                    <li><a href="#">Done</a></li>
                    <li><a href="#">Undone</a></li>
                </ul>
                
            </div>
            <div class="article">
                <div class="title">
                    <h2>News</h2>
                    <hr>   
                    
                </div>
                <ul id="" class="list-left">
                    <li><a href="#">New article 1</a></li>
                    <li><a href="#">New article 2</a></li>
                    <li><a href="#">New article 3</a></li>
                    <li><a href="#">New article 4</a></li>
                </ul>
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