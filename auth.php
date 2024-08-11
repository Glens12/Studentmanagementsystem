<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    
    <title>login</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome for icons -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <style>
        .navbar-custom {
            background-color: #333;
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 0.5rem 1rem;
        }
        .navbar-brand {
            color: #fff;
            text-decoration: none; /* Remove underline */
        }
        .navbar-nav {
            display: flex;
            gap: 1rem; /* Space between links */
        }
        .navbar-nav .nav-link {
            color: #fff;
            text-decoration: none; /* Remove underline */
            padding: 0.5rem 1rem; /* Add padding for clickable area */
        }
        .navbar-nav .nav-link:hover {
            color: #ddd;
        }
        .container-content {
            padding: 20px 20px;
 height: 500px;
 display: flex;

        }
        .section {

            display: none; /* Hide sections by default */
            padding: 20px;
            border: 1px solid #ccc; /* Optional: Border for visibility */
            border-radius: 5px; /* Optional: Rounded corners */
        }
        .section.active {
            display: block; /* Show the active section */
        }
        html {
            scroll-behavior: smooth;
        }

        .div1{
        	width: 100%;
        	height: 250px;
        	box-shadow: rgba(0, 0, 0, 0.02) 0px 1px 3px 0px, rgba(27, 31, 35, 0.15) 0px 0px 0px 1px;
        }
        input{
        	width: 70%;
        	height: 30px;
        	position: relative;
        	top: 50px;
        	margin-bottom: 10px;
        	background-color: whitesmoke;
        	border: none;
        	border-radius: 20px;
        }
        button{
        	position: relative;
        	top: 50px;
        	width: 40%;
        	color: white;
        	background-color: green;
        	height: 30px;
        	border:none;
        	transition: 0.1s;
        }
        button:hover{
        	transform: scale(1.1);
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-custom">
        <a class="navbar-brand" href="#"><h4 style="color: gray;letter-spacing: 2px;">Students Management System</h4></a>
        <div class="navbar-nav">
            <a class="nav-link" href="#login" data-target="#login">
                <i class="fas fa-sign-in-alt"></i> Login
            </a>
            <a class="nav-link" href="#register" data-target="#register">
                <i class="fas fa-user-plus"></i> Register
            </a>
        </div>
    </nav>

    <div class="container-content">
        <div id="login" class="section active"> <!-- Make Login section visible by default -->
            <h2>Login Section</h2>
            
           <div class="div1">
           	<center>
           		<form action="backend.php" method="post">
           			<input type="email" placeholder="email" required name="email">
           			<input type="password" placeholder="password" required name="password"><br>
           			<button name="login">Login now</button>
           		</form>
           	</center>
           	
           </div>

               </div>
<img src="x.jpg" width="100%" height="500px">
        <div id="register" class="section">
            <h2>Register Section</h2>
             <div class="div1">
           	<center>
           		<form method="post" action="backend.php">
           			<input type="text" placeholder="Username" required name="username">
           			<input type="email" placeholder="Email" required name="email">
           			<input type="text" placeholder="Password" required name="password"><br>
           			<button name="register">Register now</button>
           		</form>
           	</center>
           	
           </div>

        </div>
    </div>

    <!-- Bootstrap JS Bundle with Popper -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
    <script>
        // Smooth scrolling and section display logic
        document.querySelectorAll('.nav-link').forEach(link => {
            link.addEventListener('click', function(event) {
                event.preventDefault();
                const targetId = this.getAttribute('data-target').substring(1);
                document.querySelectorAll('.section').forEach(section => {
                    section.classList.remove('active');
                });
                document.getElementById(targetId).classList.add('active');
                window.location.hash = this.getAttribute('href');
            });
        });
    </script>
</body>
</html>
