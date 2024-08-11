<?php
include('conn.php');
session_start();
if (!isset($_SESSION['login'])) {
	echo'<script>window.location.href="auth.php"</script>';
}


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Students Management System</title>
    <!-- Bootstrap CSS -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome for Icons -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="style.css">
   
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark">
        <a class="navbar-brand" href="#">Students Management System</a>
    </nav>

    <div class="sidebar">
        <a href="#profile" onclick="showContent('profile')"><i class="fas fa-user"></i> Profile</a>
        <a href="#dashboard" onclick="showContent('dashboard')"><i class="fas fa-tachometer-alt"></i> Dashboard</a>
        <a href="#students" onclick="showContent('students')"><i class="fas fa-user-graduate"></i> Students</a>
        
        <a href="unset.php"><i class="fas fa-sign-out-alt"></i> Logout</a>
    </div>

    <div class="content">
        <div id="dashboard" class="content-section">
            <h1>Dashboard</h1>
            <div class="dashboard"><p>Welcome to the dashboard. Here you'll find an overview of your system's performance and key metrics.</p></div>
            <div class="dashboard-section">
                <div class="dashboard-box">TOTAL STUDENTS<br>function not avail</div>
                <div class="dashboard-box">TOTAL MALE<br>function not avail</div>
                <div class="dashboard-box">TOTAL FEMALE<br>function not avail</div>
            </div>

           <div class="add">
            <h4 style="position: relative;top: 10px;text-indent: 20px;color: white;">Add Students</h4>
            <center>
            <form action="backend.php" method="post"><br><br>
                <input required class="in1" type="text" placeholder="fullname" name="fullname">
                <input required class="in1" type="text" placeholder="address" name="address"><br>
            </center>
                 <p class="p1">Coures</p> <select required name="course">
                   <option>BSIT</option>
                    <option>BSED</option>
                    <option>BSAB</option>
               </select><br>
                 <p class="p1">Section</p> <select required name="section">
                   <option>A</option>
                    <option>B</option>
                     <option>C</option>
                      <option>D</option>
               </select><br>
                <p class="p1">Gender</p> <select required name="gender">
                   <option>Male</option>
                    <option>Female</option>
               </select><br><br>
               <center>
               <button name="addstud" class="btnadd">Add now</button>
</center>

            </form>
             
           </div> 
        </div>
        <div id="students" class="content-section">
            <h1>Students</h1>






         <?php

// Pagination variables
$results_per_page = 1; // Number of items per page

// Determine page number from URL parameter, default to 1
if (!isset($_GET['page'])) {
    $page = 1;
} else {
    $page = $_GET['page'];
}

// Calculate SQL LIMIT starting number for the results on the displaying page
$offset = ($page - 1) * $results_per_page;

// Retrieve data from database
$sql = "SELECT id, fullname,address,course,section,gender FROM records LIMIT $offset, $results_per_page";
$result = $con->query($sql);

// Display fetched data
if ($result->num_rows > 0) {
    echo "<table>";
    echo "<tr><th>ID</th><th>Fullname</th><th>Address</th><th>Course</th><th>Section</th><th>Gender</th><th>Action</th></tr>";
    // output data of each row
    while ($row = $result->fetch_assoc()) {
?>

<div id="popup" class="popup">
        <div class="popup-content">
            <span class="close-btn" id="closePopup">&times;</span>
            <?php
           
if (isset($_POST['update'])) {
    $id=$_POST['id'];

    $query=mysqli_query($con,"SELECT * from records where id ='$id'");
    $row=mysqli_fetch_assoc($query);
}
            ?>
            <form action="backend.php" method="post">
                <input type="hidden" value="<?php echo $row['id'] ?>" name="id">
                <input required class="in1" type="text" value="<?php echo $row['fullname'] ?>" placeholder="fullname" name="fullname">
                <input required class="in1" value="<?php echo $row['address'] ?>" type="text" placeholder="address" name="address"><br>
            </center>
                 <p class="p1">Coures</p> <select required name="course">
                   <option>BSIT</option>
                    <option>BSED</option>
                    <option>BSAB</option>
               </select><br>
                 <p class="p1">Section</p> <select required name="section">
                   <option>A</option>
                    <option>B</option>
                     <option>C</option>
                      <option>D</option>
               </select><br>
                <p class="p1">Gender</p> <select required name="gender">
                   <option>Male</option>
                    <option>Female</option>
               </select><br><br>
               <center>
               <button name="update" class="btnedit">Save</button></button>
          </center>
        </form>
    </div>
    </div>




        <form method="post">
            <td><?php echo $row['id'] ?>
            <td><?php echo $row['fullname'] ?>
            <td><?php echo $row['address'] ?>
            <td><?php echo $row['course'] ?>
            <td><?php echo $row['section'] ?>
            <td><?php echo $row['gender'] ?>
            <input type="hidden" value="<?php echo $row['id'] ?>" name="id">
    
            <td><button name="update"  id="showPopup"  style="width:100%;background-color: dodgerblue;color: white;border:none">Edit</button>
                 </form>

                 <form method="post" action="backend.php">
                    <input type="hidden" value="<?php echo $row['id'] ?>" name="id">
             <button name="delete" style="width:100%;background-color: orange;color: white;border:none">Delete</button>
              </form>
       

        <?php
    }
    echo "</table>";
} else {
    echo "0 results";
}

// Pagination links
$sql = "SELECT COUNT(id) AS total FROM records";
$result = $con->query($sql);
$row = $result->fetch_assoc();
$total_pages = ceil($row["total"] / $results_per_page);

echo "<center><div class='pagination'>";

for ($i = 1; $i <= $total_pages; $i++) {
    echo "<a class='a' href='index.php?page=" . $i . "'";
    if ($i == $page) {
        echo " class='active'";
    }
    echo ">" . $i . "</a> ";
}

echo "</div>";
?>



 </div>
        <div id="profile" class="content-section">
           
            
             <?php
$user=$_SESSION['user'];
$query=mysqli_query($con,"SELECT * from auth where email='$user'");
$row=mysqli_fetch_assoc($query);
             ?>
             
            
            
                <h1>Profile</h1>
            	<div class="profile">
            	<h2 class="user"><i class="fas fa-user"></i> <?php echo $row['username'] ?></h2><br>
            	<h2 class="user"><i class="fas fa-envelope"></i> <?php echo $row['email'] ?></h2></br>
            	<h3 style="text-indent: 35px;color: skyblue;">About us</h3>
            	<center><div class="about"><br>
            		<p style="font-size: 15px;width: 97%;">We are dedicated to transforming educational management with our innovative Student Management System. Our platform is designed to streamline administrative processes, enhance student engagement, and support educational excellence. With a focus on user-friendly interfaces and comprehensive functionality, we provide tools that facilitate efficient management of student records, grades, attendance, and more. Our system empowers educators, administrators, and students alike, ensuring that all stakeholders have access to accurate, real-time information. Committed to leveraging technology to improve educational outcomes, we aim to simplify the complexities of academic administration and foster a collaborative learning environment.</p>
            	</div></center>


            </div>
        
    </div>

    <!-- Bootstrap JS and dependencies -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script>
        function showContent(sectionId) {
            // Save the selected section in localStorage
            localStorage.setItem('selectedSection', sectionId);

            // Hide all content sections
            var sections = document.querySelectorAll('.content-section');
            sections.forEach(function(section) {
                section.style.display = 'none';
            });

            // Show the selected content section
            var activeSection = document.getElementById(sectionId);
            if (activeSection) {
                activeSection.style.display = 'block';
            }
        }

        function confirmLogout() {
            // Show confirmation dialog
            var confirmAction = confirm('Are you sure you want to log out?');
            if (confirmAction) {
                logout();
            }
        }

        function logout() {
            // Clear the saved section from localStorage
            localStorage.removeItem('selectedSection');
            
            // Redirect to login page or perform any logout action
            window.location.href = 'login.html'; // Replace with your login page or logout logic
        }

        // Initialize to show the last selected section by default
        document.addEventListener('DOMContentLoaded', function() {
            var savedSection = localStorage.getItem('selectedSection');
            if (savedSection) {
                showContent(savedSection);
            } else {
                // Show default section if no section is saved
                showContent('dashboard');
            }
        });



         document.addEventListener('DOMContentLoaded', () => {
    const showPopupButton = document.getElementById('showPopup');
    const closePopupButton = document.getElementById('closePopup');
    const popup = document.getElementById('popup');

    // Function to show the popup
    function showPopup() {
        popup.style.display = 'flex';
        localStorage.setItem('popupShown', 'true');
    }

    // Function to hide the popup
    function hidePopup() {
        popup.style.display = 'none';
        localStorage.removeItem('popupShown');
    }

    // Check if the popup should be shown on page load
    if (localStorage.getItem('popupShown') === 'true') {
        popup.style.display = 'flex';
    }

    // Event listeners
    showPopupButton.addEventListener('click', showPopup);
    closePopupButton.addEventListener('click', hidePopup);

    // Optional: Close the popup when clicking outside of it
    window.addEventListener('click', (event) => {
        if (event.target === popup) {
            hidePopup();
        }
    });
});

    </script>

    
</body>
</html>

