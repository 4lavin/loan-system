<style>
  @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap');
  * {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
  }
  body {
    font-family: 'Poppins', sans-serif;
  }
  .navbar {
    position: relative;
    padding: 40px 0;
  }
  .navbar .logout {
    position: absolute;
    right: 3%;
    color: #144959;
    transition: .5s;
    padding: 10px 14px;
    border-radius: 50px;
  }
  .navbar .logout:hover {
   background: #144959;
   color: #fff;
  }
 
</style>
<body>
  

<div class="navbar">
    <!--<?php echo $_SESSION['login_name'] ?> -->
    <a href="ajax.php?action=logout" class = "logout"> <i class="fa fa-power-off"></i></a> 
</div>
</body>
