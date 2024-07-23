<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <title>Bank LMS | Login</title>
    <style>
        /* POPPINS FONT */
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap');

        * {  
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Poppins', sans-serif;
        }
        body {
            background: url("image/bgimg7.jpg");
            background-size: cover;
            background-repeat: no-repeat;
            background-attachment: fixed;
            overflow: hidden;
        }
        .wrapper {
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 110vh;
            background: rgba(39, 39, 39, 0.2);
        }
        .nav {
            position: fixed;
            top: 0;
            display: flex;
            justify-content: space-between;
            align-items: center;
            width: 100%;
            height: 100px;
            line-height: 100px;
            background: linear-gradient(rgba(39,39,39, 0.3), transparent);
            z-index: 100;
            padding: 0 5%;
        }
        .nav-logo {
    display: flex;
    align-items: center;
    height: 100px;
    min-height: auto; /* Match this with the nav height */
}

        .nav-logo img {
    height: 120px; /* Adjust this value to fit your logo */
    width: auto;
    vertical-align: middle;
}
        .nav-menu ul {
            display: flex;
            justify-content: center;
            list-style-type: none;
            padding: 0;
            margin: 0;
            width: 100%;
        }
        .nav-menu {
    flex-grow: 1;
    display: flex;
    justify-content: center;
}
        .nav-menu ul li {
            list-style-type: none;
        }
        .nav-menu ul li .link {
            text-decoration: none;
            font-weight: 500;
            color: #006400;
            padding-bottom: 15px;
            margin: 0 25px;
        }
        .link:hover, .active {
            color: #008000;
            border-bottom: 2px solid #008000;
        }
        .nav-button .btn {
            width: 130px;
            height: 40px;
            font-weight: 500;
            background: rgba(255, 255, 255, 0.4);
            border: none;
            border-radius: 30px;
            cursor: pointer;
            transition: .3s ease;
        }
        .btn:hover {
            background: rgba(255, 255, 255, 0.3);
        }
        .btn.white-btn {
            background: rgba(255, 255, 255, 0.7);
        }
        .btn.btn.white-btn:hover {
            background: rgba(255, 255, 255, 0.5);
        }
        .nav-menu-btn {
            display: none;
        }
        .form-box {
            position: relative;
            display: flex;
            align-items: center;
            justify-content: center;
            width: 512px;
            height: 420px;
            overflow: hidden;
            z-index: 2;
        }
        .login-container {
            position: absolute;
            left: 4px;
            width: 500px;
            display: flex;
            flex-direction: column;
            transition: .5s ease-in-out;
        }
        header {
            color: #fff;
            font-size: 30px;
            text-align: center;
            padding: 10px 0 30px 0;
        }
        .input-field {
            font-size: 15px;
            background: rgba(255, 255, 255, 0.2);
            color: #fff;
            height: 50px;
            width: 100%;
            padding: 0 10px 0 45px;
            border: none;
            border-radius: 30px;
            outline: none;
            transition: .2s ease;
        }
        .input-field:hover, .input-field:focus {
            background: rgba(255, 255, 255, 0.25);
        }
        ::-webkit-input-placeholder {
            color: #fff;
        }
        .input-box i {
            position: relative;
            top: -35px;
            left: 17px;
            color: #fff;
        }
        .submit {
            font-size: 15px;
            font-weight: 500;
            color: black;
            height: 45px;
            width: 100%;
            border: none;
            border-radius: 30px;
            outline: none;
            background: rgba(255, 255, 255, 0.7);
            cursor: pointer;
            transition: .3s ease-in-out;
        }
        .submit:hover {
            background: rgba(255, 255, 255, 0.5);
            box-shadow: 1px 5px 7px 1px rgba(0, 0, 0, 0.2);
        }
        .two-col {
            display: flex;
            justify-content: space-between;
            color: #fff;
            font-size: small;
            margin-top: 10px;
        }
        .two-col .one {
            display: flex;
            gap: 5px;
        }
        .two label a {
            text-decoration: none;
            color: #fff;
        }
        .two label a:hover {
            text-decoration: underline;
        }
        @media only screen and (max-width: 786px) {
            .nav-button {
                display: none;
            }
            .nav-menu.responsive {
                top: 100px;
            }
            .nav-menu {
                position: absolute;
                top: -800px;
                display: flex;
                justify-content: flex-end;
                padding-right: 30%;
                background: rgba(255, 255, 255, 0.2);
                width: 100%;
                height: 90vh;
                backdrop-filter: blur(20px);
                transition: .3s;
            }
            .nav-menu ul {
                display: flex;
                justify-content: center;
                margin-left: -100%; 
            }
            .nav-menu-btn {
                display: block;
            }
            .nav-menu-btn i {
                font-size: 25px;
                color: #fff;
                padding: 10px;
                background: rgba(255, 255, 255, 0.2);
                border-radius: 50%;
                cursor: pointer;
                transition: .3s;
            }
            .nav-menu-btn i:hover {
                background: rgba(255, 255, 255, 0.15);
            }
        }
        @media only screen and (max-width: 540px) {
            .wrapper {
                min-height: 100vh;
            }
            .form-box {
                width: 100%;
                height: 500px;
            }
            .login-container {
                width: 100%;
                padding: 0 20px;
            }
        }
                /* Add these new styles */
        body {
            overflow-y: auto;
        }
        
        .content-section {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-around;
            padding: 20px;
            margin-top: 100px;
        }
        
        .box {
            background: rgba(255, 255, 255, 0.2);
            border-radius: 10px;
            padding: 20px;
            margin: 10px;
            width: 300px;
            text-align: center;
            backdrop-filter: blur(10px);
            transition: 0.3s;
        }
        
        .box:hover {
            transform: translateY(-5px);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.3);
        }
        
        .box h2 {
            color: #fff;
            margin-bottom: 10px;
        }
        
        .box p {
            color: #f0f0f0;
            font-size: 14px;
        }
        
        .box-icon {
            font-size: 48px;
            color: #fff;
            margin-bottom: 15px;
        }
        body {
            overflow-y: auto;
        }
        
        .wrapper {
            min-height: 100vh;
            padding-bottom: 50px;
        }
        
        /* Add these new styles */
        .content-section {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-around;
            padding: 20px;
            margin-top: 120px;
        }
        
        .box {
    background: rgba(255, 255, 255, 0.4);
    border-radius: 10px;
    padding: 20px;
    margin: 10px;
    width: 300px;
    text-align: center;
    backdrop-filter: blur(10px);
    transition: 0.3s;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
}

.box:hover {
    transform: translateY(-5px);
    box-shadow: 0 6px 12px rgba(0, 0, 0, 0.2);
    background: rgba(255, 255, 255, 0.5);
}

.box h2 {
    color: #1a1a1a;
    margin-bottom: 10px;
}

.box p {
    color: #333333;
    font-size: 14px;
}

.box-icon {
    font-size: 48px;
    color: #2e8b57;
    margin-bottom: 15px;
}

a {
    color: #006400;
    text-decoration: none;
    transition: color 0.3s ease;
}

a:hover {
    color: #008000;
}
    </style>
</head>
<body>
 <div class="wrapper">
    <nav class="nav">
    <div class="nav-logo">
    <img src="image/logo1.png" alt="Bank LMS Logo">
 </div>
        <div class="nav-menu" id="navMenu">
            <ul>
                <li><a href="#" class="link">Home</a></li>
                <li><a href="#" class="link active">About</a></li>
                <li><a href="index.php" class="link">Signout</a></li>         
            </ul>
        </div>
        <div class="nav-placeholder"></div>
        <div class="nav-menu-btn">
            <i class="bx bx-menu" onclick="myMenuFunction()"></i>
        </div>
    </nav>
    <div class="content-section">
            <div class="box">
                <i class='bx bx-book-reader box-icon'></i>
                <h2><a href="dash.php?q=8">Quizzes / Assignments</a></h2>
                <p>Access and complete various quizzes and assignments to test your knowledge and skills in banking.</p>
            </div>
            <div class="box">
                <i class='bx bx-library box-icon'></i>
                <h2><a href="dash.php?q=4">Banking Study Material</a></h2>
                <p>Explore a comprehensive collection of banking study materials to enhance your understanding of the industry.</p>
            </div>
            <div class="box">
                <i class='bx bx-bulb box-icon'></i>
                <h2><a href="own/admin_page.html">Knowledge Center</a></h2>
                <p>Access comprehensive guides about APCOB and its departments. Expand your understanding of the bank's operations and policies.</p>
            </div>
        </div>
    
</div>   

<script>
   function myMenuFunction() {
    var i = document.getElementById("navMenu");

    if(i.className === "nav-menu") {
        i.className += " responsive";
    } else {
        i.className = "nav-menu";
    }
   }

   function validateLoginForm() {
        var employeeId = document.getElementById('employeeId').value;
        var password = document.getElementById('password').value;

        // Regular expression for employee ID validation (APB followed by 6 digits)
        var employeeIdPattern = /^APB\d{6}$/;

        if (!employeeIdPattern.test(employeeId)) {
            alert('Please enter a valid employee ID in the format "APBxxxxxx" where xxxxxx are digits.');
            return false;
        }

        if (password.trim() === '') {
            alert('Please enter a password.');
            return false;
        }

        return true;
    }
</script>

</body>
</html>