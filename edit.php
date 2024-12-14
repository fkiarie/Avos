<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link href="css/dash.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body>
    <div class="dashboard-container">
        <!-- Sidebar -->
        <aside class="sidebar">
            <div class="logo">Dashboard</div>
            <nav>
                <ul>
                    <li><a href="#" class="active"><i class="fa fa-users"></i> Manage Users</a></li>
                    <li><a href="#"><i class="fa fa-blog"></i> Manage Blogs</a></li>
                    <li><a href="#"><i class="fa fa-cogs"></i> Settings</a></li>
                    <li><a href="#"><i class="fa fa-sign-out-alt"></i> Logout</a></li>
                </ul>
            </nav>
        </aside>

        <!-- Main Content -->
        <main class="main-content">

            <header>

                <h1>User Management</h1>
                
                <div class="floating-search-container">
        <form action="search.php" method="POST" class="floating-search-form">
            <input type="text" name="search" class="floating-search-input" placeholder="Search">
            <button type="submit" name="submit" class="floating-search-button">
                <i class="fas fa-search"></i>
            </button>
        </form>
    </div>

                <button class="btn-primary">+ Add User</button>
            </header>   

            <section class="content-table">
              <?php
// Database connection
$servername = "localhost"; // Replace with your database host
$username = "root"; // Replace with your database username
$password = ""; // Replace with your database password
$dbname = "aeak"; // Replace with your database name

// Create connection
$con = mysqli_connect($servername, $username, $password, $dbname);

// Check connection
if (!$con) {
    die("Connection failed: " . mysqli_connect_error());
}

// Check if 'GetID' is passed in the URL to fetch the user details
if (isset($_GET['GetID'])) {
    $userID = $_GET['GetID'];

    // Query to fetch the user data based on ID
    $qry = "SELECT * FROM users WHERE id='$userID'";
    $result = mysqli_query($con, $qry);

    // Check if user exists
    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
    } else {
        echo "No user found!";
        exit;
    }
}

if (isset($_POST['update'])) {
    // Update user data
    $name = mysqli_real_escape_string($con, $_POST['name']);
    $username = mysqli_real_escape_string($con, $_POST['username']);
    $email = mysqli_real_escape_string($con, $_POST['email']);
    $tel = mysqli_real_escape_string($con, $_POST['tel']);
    $role_type = mysqli_real_escape_string($con, $_POST['role_type']);
    $status = mysqli_real_escape_string($con, $_POST['status']);
    // Add more fields as necessary
    
    // Update query
    $updateQry = "UPDATE users SET name='$name', username='$username', email='$email', tel='$tel', role_type='$role_type', status='$status' WHERE id='$userID'";

    if (mysqli_query($con, $updateQry)) {
        echo "User data updated successfully!";
        header('Location: dashboard.php'); // Redirect after successful update
    } else {
        echo "Error updating user: " . mysqli_error($con);
    }
}

mysqli_close($con);
?>

<?php
// Assuming you're fetching data for a user
$userID = $_GET['GetID']; // Fetch the user ID
$con = mysqli_connect("localhost", "root", "", "aeak"); // Database connection

// Fetch the user data from the database
$sql = "SELECT * FROM users WHERE id = '$userID'";
$result = mysqli_query($con, $sql);
$row = mysqli_fetch_assoc($result);
?>

<div class="container">
    <h1 class="well">Edit User Form</h1>
    <div class="col-lg-12 form-container">
        <div class="row">
            <form action="userupdate.php?GetID=<?php echo $userID; ?>" method="POST">
                <div class="form-section">
                    <!-- User ID Display -->
                    <div class="form-group">
                        <label>User ID</label>
                        <input type="text" name="user_id" value="<?php echo $row['id']; ?>" class="form-control" disabled>
                    </div>

                    <!-- Name and Username -->
                    <div class="row">
                        <div class="col-sm-6 form-group">
                            <label>Name</label>
                            <input type="text" name="name" value="<?php echo $row['name']; ?>" placeholder="Enter Name" class="form-control">
                        </div>
                        <div class="col-sm-6 form-group">
                            <label>Username</label>
                            <input type="text" name="username" value="<?php echo $row['username']; ?>" placeholder="Enter Username" class="form-control">
                        </div>
                    </div>

                    <!-- Email and Phone Number -->
                    <div class="form-group">
                        <label>Email</label>
                        <input type="email" name="email" value="<?php echo $row['email']; ?>" placeholder="Enter Email" class="form-control">
                    </div>

                    <div class="row">
                        <div class="col-sm-4 form-group">
                            <label>Phone No</label>
                            <input type="text" name="tel" value="<?php echo $row['tel']; ?>" placeholder="Enter Phone Number" class="form-control">
                        </div>
                        <div class="col-sm-4 form-group">
                            <label>Role</label>
                            <input type="text" name="role_type" value="<?php echo $row['role_type']; ?>" placeholder="Enter Role" class="form-control">
                        </div>
                        <div class="col-sm-4 form-group">
                            <label>Status</label>
                            <!-- Status is disabled -->
                            <input type="text" name="status" value="<?php echo $row['status']; ?>" class="form-control" disabled>
                        </div>
                    </div>

                    <!-- Registration Date -->
                    <div class="row">
                        <div class="col-sm-6 form-group">
                            <label>Registration Date</label>
                            <input type="text" name="reg_date" value="<?php echo $row['reg_date']; ?>" class="form-control" disabled>
                        </div>
                    </div>

                    <!-- Submit Button -->
                    <button type="submit" name="submit" class="btn btn-lg btn-info">Save Changes</button>
                </div>
            </form>
        </div>
    </div>
</div>

<?php
// Close the connection
mysqli_close($con);
?>





            </section>
        </main>
    </div>
    <script src="script.js">
    document.addEventListener("DOMContentLoaded", () => {
    const deleteButtons = document.querySelectorAll(".btn-delete");

    deleteButtons.forEach(button => {
        button.addEventListener("click", () => {
            if (confirm("Are you sure you want to delete this user?")) {
                // Perform deletion logic here (e.g., send request to backend)
                console.log("User deleted.");
            }
        });
    });
});
</script>


</body>
</html>
