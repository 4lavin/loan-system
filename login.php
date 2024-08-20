<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css"
        integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>Admin | Loan Management System</title>


    <?php include('./header.php'); ?>
    <?php include('./db_connect.php'); ?>
    <?php 
session_start();
if(isset($_SESSION['login_id']))
header("location:index.php?page=home");

?>

</head>
<style>
body {
    position: relative;
    height: 100vh;
    width: 100%;
    font-size: 16px;
    line-height: 30px;
    font-family: 'Poppins';
    background: #eeeeee;

}

p {
    margin: 0;
}

.bg {
    position: absolute;
    height: 100vh;
    width: 100%;
    backdrop-filter: blur(10px);
    z-index: 99;
    transform: scale(0);
}

.active-bg {
    transform: scale(1);
    transition: .2s;
}

.pic {
    position: absolute;
    bottom: 0;
    right: 0;
    width: 600px;
    z-index: -1;
    object-fit: cover;

    transition: .5s;
}

.pic::after {
    position: absolute;
    content: "";
    width: 100px;
    left: 0;
    height: 100%;
    background-image: linear-gradient(to right, #eee, rgba(255, 0, 0, 0));
}

.pic::before {
    position: absolute;
    content: "";
    width: 100px;
    right: 0;
    height: 100%;
    background-image: linear-gradient(to right, rgba(255, 0, 0, 0), #eee);
}

.pic img {
    width: 100%;
}

.navbar {
    position: fixed;
    width: 100%;
    top: 0;
    left: 0;
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 20px 10%;
    z-index: 98;
}
.sticky {
    background: #eeeeee;
    box-shadow: 0 0 10px rgb(0 0 0 / 10%) 
}

.logoo {
    width: 120px;
}

.logoo img {
    width: 100%;
}

nav a{
    position: relative;
    color: #555;
    margin-left: 40px;
    padding: 5px 20px;

}
nav a:hover {
    color: #000;
}
nav a:after {
    position: absolute;
    content: "";
    width: 0;
    height: 4px;
    background: #00A36C;
    bottom: -5px;
    left: 50%;
    transform: translateX(-50%);
    border-radius: 5px;
    transition: .3s;
}
nav a.active:after {
    width: 80%
}
nav a.active {
    color: #00A36C;
}

.main {
    position: absolute;
    top: 50%;
    left: 50%;
    width: 420px;
    height: 0;
    background: #fbfbfb;
    border-radius: 10px;
    display: flex;
    justify-content: center;
    align-items: center;
    padding: 0 20px;
    transform: translate(-50%, -50%);
    z-index: 99;
    overflow: hidden;

}

.active-login {
    transform: translate(-50%, -50%);
    box-shadow: 0 0 30px rgba(0, 0, 0, .5);
    height: 500px;
    transition: none;
    transition: .3s;
}

.home {
    position: absolute;
    transform: translateX(0);
    width: 50%;
    top: 32%;
    left: 10%;
    transition: .5s;
}

.home-active {
    position: absolute;
    transform: translateX(-2000px);
    top: 32%;
    width: 50%;
    transition: .5s;
}

.home h2 {
    color: #144959;
    font-weight: 700;

}
.services h2 {
    color: #144959;
    font-weight: 700;
}

.about {
    position: absolute;
    transform: translateX(-2000px);
    top: 38%;
    text-align: justify;
    width: 50%;
 
    transition: .5s;
}


.about-active {
    position: absolute;
    top: 38%;
    text-align: justify;
    transform: translateX(0);
    left: 10%;
    width: 50%;
  
    transition: .5s;
}

.services {
    position: absolute;
    left: 10%;
    top: 38%;

    transform: translateX(-2000px);
    width: 50%;
  
    transition: .5s;
}

.services-active {
    position: absolute;
    left: 10%;
    top: 38%;
    transform: translateX(0);
    width: 50%;
 
    transition: .5s;
}

#login-form {
    width: 100%;
}

.form-group {
    position: relative;
    width: 100%;
    height: 60px;
    margin-top: 30px;
}

.form-group input {
    height: 100%;
    width: 100%;
    outline: none;
    background: none;
    padding: 0 45px;
    border: 2px solid #000;
}

label {
    position: absolute;
    top: 50%;
    left: 45px;
    transform: translateY(-50%);
    pointer-events: none;
    color: #000;
    font-size: 16px;
    transition: .3s;
}

.icon {
    position: absolute;
    top: 50%;
    left: 20px;
    transform: translateY(-50%)
}

.eye-icon {
    position: absolute;
    top: 50%;
    right: 20px;
    transform: translateY(-50%)
}

.form-group input:focus~label,
.form-group input:not(:placeholder-shown)~label {
    top: 0;
    left: 40px;
    padding: 0 5px;
    background: #fbfbfb;
}

button {
    width: 100%;
    height: 60px;
    outline: none;
    background: #00A36C;
    outline: none;
    border: none;
    color: white;
    margin-top: 20px;

}

.closeee {
    position: absolute;
    top: 0;
    right: 0;
    padding: 10px 20px;
    border-radius: 0 0 0 10px;
    color: #fff;
    background: #144959;
}

.closeee:hover {
    background: red;
    transition: .2s;
}

.accordion-wrapper {

    width: 100%;
    margin-top: 2px;
}

.accordion {
    position: relative;
    margin-bottom: 2px;
    background: #144959;
    color: #fff;
    padding: 2px 10px;
    cursor: pointer;
    display: flex;
    justify-content: space-between;
    align-items: center;
}
.accordion-wrapper.active-acco .accordion i {
    transform : rotate(180deg)
}


.accordion-content {
    height: 0;
    padding: 2px 10px;
    overflow: hidden;
    transition: .5s;
    backdrop-filter: blur(5px);

}

.accordion-wrapper.active-acco .accordion-content {
    height: 70px;
    border: 1px #555 solid;
    padding: 2px 10px;
    transition: .5s;
}

.invest-wrapper {
    width: 100%;
    margin-top: 2px;
}

.invest {
    position: relative;
    margin-bottom: 2px;
    background: #144959;
    color: #fff;
    padding: 2px 10px;
    cursor: pointer;
}

.invest-content {
    height: 70px;
    backdrop-filter: blur(5px);
    border: 1px #555 solid;
    padding: 2px 10px;
    overflow: hidden;


}

.close-menu {
    display: none;
    color: #fff;
}

.nav-menu {

    display: none;

}
.login-popup {
    background: #00A36C ;
    border: none;
    color: #fff;
    padding: 5px 50px;
    border-radius: 50px;

}
.menu {
    display: none;
}
.login-navmenu {
    display: flex; 
    justify-content: center;
    align-items: center;
}
@media only screen and (max-width: 1200px) {
  .home,
  .about,
  .services {
    width: 80%;

  }
  nav {
    position: fixed;
    left: 0;
    top: 0;
    padding: 80px 0;
    width: 100%;
    background-color: rgba(0, 0  , 0  , .75);
    backdrop-filter : blur(8px); 
    text-align: center;
    z-index: 99;
    transform: translateY(-2000px);
    transition: .3s;
    
  }
  .nav-active {
    transform: translateY(0)
  }
  nav a{
    display: block;
    margin: 20px 0;
    
    color: #E3DAC9;
  }
  nav a.active:after{
    width:0;
  }
  nav a.active{
    color: #fff;
    font-weight: 700;
  }
  nav a:hover {
    color: #E3DAC9;
  }
  .nav-menu {
    display: block;
    font-size : 20px;
    color: #555;
  }
  .close-menu {
    position: absolute;
    top: 50px;
    right: 80px;
    display: block;
    font-size : 20px;
}
.menu {
    font-size: 30px;
    display: block;
    color: #E3DAC9;
    margin-bottom: 50px;
}
.login-popup {
    margin-right: 40px;
}
.pic {
    display: none;
}
.bg{
    height: 120vh;
}

}
</style>

<body>
    <div class="bg"></div>
    <div class="pic"><img src="./assets/img/pic.gif" alt=""></div>
    <div class="navbar">
        <div class="logoo"><img src="./assets/img/logo.png" alt=""></div>
        <nav>
            <div class="menu">Menu</div>
            <a href="" class="active home-popup">Home</a>
            <a href="" class="about-popup">About</a>
            <a href="" class="service-popup">Services</a>
            <div class="close-menu"><i class="fa-solid fa-xmark"></i></div> 
        </nav>
        <div class="login-navmenu">
        <input type="button" value = "Login" class="login-popup">       
        <div class="nav-menu"><i class="fa-solid fa-bars"></i></div>
        </div>
    </div>

    <main id="main" class="main">
        <div class="container">
            <div class="closeee">
                <i class="fa-solid fa-xmark"></i>
            </div>
            <h2 style="text-align: center; margin-bottom: 20px">Welcome, Admin</h2>
            <form id="login-form">
                <div class="form-group">
                    <input type="text" id="username" name="username" placeholder="">
                    <label>Username</label>
                    <i class="fa-solid fa-envelope icon"></i>
                </div>
                <div class="form-group">
                    <input type="password" id="password" class="password" name="password" placeholder="">
                    <label>Password</label>
                    <i class="fa-solid fa-lock icon"></i>
                    <i class="fa-solid fa-eye-slash eye-icon"></i>
                </div>
                <button>Login</button>
            </form>
        </div>
    </main>
    <div class="home">
        <h2>Welcome To Masaligan Micro Finance</h2>
        <p>After 21years of working for a leading Microfinance company in
            the country, the owner and founder Ms. Melissa Elisan
            decided to retire from her corporate job to start her own
            business and to have a more flexible time to spend with her
            family. After thorough consideration and support from friends
            and family, Masaligan Micro Finance Corporation came to reality.
        </p>
        <div class="accordion-wrapper">
            <div class="accordion">
                <p>Masaligan Micro Finance Corporation Founder</p>
                <i class="fa-solid fa-angle-down"></i>
            </div>
            <div class="accordion-content">
                <p>Ms. Melissa Elisan</p>
            </div>
        </div>
        <div class="accordion-wrapper">
            <div class="accordion">
                <p>Masaligan Micro Finance Corporation Establish When</p>
                <i class="fa-solid fa-angle-down"></i>
            </div>
            <div class="accordion-content">
                <p>May 28,2013</p>
            </div>
        </div>
        <div class="accordion-wrapper">
            <div class="accordion">
                <p>Masaligan Micro Finance Corporation Establish At</p>
                <i class="fa-solid fa-angle-down"></i>
            </div>
            <div class="accordion-content">
                <p>3rd Floor, Intel Canicosa Building, National Highway, Brgy. Parian, Calamba City,Laguna.</p>
            </div>
        </div>
    </div>
    <div class="about">
        <p style = "color : #144959; font-weight: 700;">Company Mission and Vision</h2>
        <div class="invest-wrapper">
            <div class="invest">
                <p>Mission</p>
            </div>
            <div class="invest-content">
                <p>Our mission is to grow together, one microloan at a time.</p>
            </div>
        </div>
        <div class="invest-wrapper">
            <div class="invest">
                <p>Vision</p>
            </div>
            <div class="invest-content">
                <p>Our overriding vision is to empower small businesses in underserved communities.</p>
            </div>
        </div>
    </div>
    <div class="services">
    <p style = "color : #144959; font-weight: 700;">Masaligan Micro Finance Corporation services has Investment Opportunity</p>
        <div class="invest-wrapper">
            <div class="invest">
                <p>1. Investor/ Incorporator</p>
            </div>
            <div class="invest-content">
                <p>Profit sharing on net profit income based on invested amount / salary / allowances</p>
            </div>
        </div>
        <div class="invest-wrapper">
            <div class="invest">
                <p>2. Investor/ Lender</p>
            </div>
            <div class="invest-content">
                <p>30% yearly profit of invested amount regardless of company performance. Details will be discussed
                    individually.</p>
            </div>
        </div>
    </div>

    <a href="#" class="back-to-top"><i class="icofont-simple-up"></i></a>


</body>
<script>
$('#login-form').submit(function(e) {
    e.preventDefault()
    $('#login-form button[type="button"]').attr('disabled', true).html('Logging in...');
    if ($(this).find('.alert-danger').length > 0)
        $(this).find('.alert-danger').remove();
    $.ajax({
        url: 'ajax.php?action=login',
        method: 'POST',
        data: $(this).serialize(),
        error: err => {
            console.log(err)
            $('#login-form button[type="button"]').removeAttr('disabled').html('Login');

        },
        success: function(resp) {
            if (resp == 1) {
                location.href = 'index.php?page=home';
            } else if (resp == 2) {
                location.href = 'voting.php';
            } else {
                $('#login-form').prepend(
                    '<div class="alert alert-danger">Username or password is incorrect.</div>')
                $('#login-form button[type="button"]').removeAttr('disabled').html('Login');
            }
        }
    })
})
const closeMenu = document.querySelector(".close-menu")
const navigator = document.querySelector(".navbar")
const navMenu = document.querySelector(".nav-menu")
const navbar = document.querySelector("nav")
const password = document.querySelector(".password")
const showPass = document.querySelector(".eye-icon")
const popup = document.querySelector(".login-popup")
const main = document.querySelector(".main")
const bg = document.querySelector(".bg")
const nav = document.querySelectorAll("nav a")
const homePop = document.querySelector(".home-popup")
const servicePop = document.querySelector(".service-popup")
const aboutPop = document.querySelector(".about-popup")
const pic = document.querySelector(".pic")
const home = document.querySelector(".home")
const about = document.querySelector(".about")
const services = document.querySelector(".services")
const close = document.querySelector(".closeee")
const accordion = document.querySelectorAll(".accordion-wrapper")

showPass.addEventListener('click', () => {
    if (password.type == "password") {
        password.type = "text"
        showPass.classList.add('fa-eye')
        showPass.classList.remove('fa-eye-slash')
    } else {
        password.type = "password"
        showPass.classList.remove('fa-eye')
        showPass.classList.add('fa-eye-slash')
    }
})

popup.addEventListener('click', (e) => {
    e.preventDefault()
    main.classList.add('active-login')
    bg.classList.add('active-bg')

   
})

servicePop.addEventListener('click', () => {
    home.classList.add('home-active')
    about.classList.remove('about-active')
    services.classList.add('services-active')
    accordion.forEach(acco => {
        acco.classList.remove('active-acco')
    });
    navbar.classList.remove("nav-active")
})

aboutPop.addEventListener('click', () => {
    home.classList.add('home-active')
    about.classList.add('about-active')
    services.classList.remove('services-active')
    accordion.forEach(acco => {
        acco.classList.remove('active-acco')
    });
    navbar.classList.remove("nav-active")
})
homePop.addEventListener('click', () => {
    home.classList.remove('home-active')
    about.classList.remove('about-active')
    services.classList.remove('services-active')
    navbar.classList.remove("nav-active")
})

close.addEventListener('click', () => {
    main.classList.remove('active-login')
    bg.classList.remove('active-bg')

})
nav.forEach(navs => {
    navs.addEventListener('click', (e) => {
        e.preventDefault()
        nav.forEach(subnav => {
            subnav.classList.remove('active')
        });
        navs.classList.add('active')
    })
});

accordion.forEach(acco => {
    acco.addEventListener('click', (e) => {
        e.preventDefault()
        accordion.forEach(subacco => {
            subacco.classList.remove('active-acco')
        });
        acco.classList.toggle('active-acco')
    })
});
navMenu.addEventListener("click" , () => {
    navbar.classList.add("nav-active")
})
closeMenu.addEventListener("click" , () => {
    navbar.classList.remove("nav-active")
})
window.addEventListener("scroll" , () =>  {
    navigator.classList.toggle("sticky" , window.scrollY > 0)
})
    
</script>

</html>