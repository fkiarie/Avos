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
                    <li><a href="dashboard.php" class="active"><i class="fa fa-users"></i> Manage Users</a></li>
                    <li><a href="#"><i class="fa fa-blog"></i> Manage Blogs</a></li>
                    <li><a href="password_reset_request.php"><i class="fa fa-cogs"></i> Password Reset</a></li>
                    <li><a href="logout.php"><i class="fa fa-sign-out-alt"></i> Logout</a></li>
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


            <?php
        session_start(); // Start the session

        // Check if the user is logged in
        if (!isset($_SESSION['user_id'])) {
            // Redirect to login page if not logged in
            header("Location: login-form.php");
            exit();
        }

        echo "Welcome, " . $_SESSION['user_name']; // You can now access the session variables
        ?>

        <a href="register-form.php"> <button class="btn-primary">+ Add User</button> </a>

                
            </header>   

            <section class="content-table">

                <!-- Start -->
<table class="table table-striped table-dark">
  <thead>
    <tr>
      <th scope="col">ID No:</th>
      <th scope="col">Name</th>
      <th scope="col">Username</th>
      <th scope="col">Email</th>
      <th scope="col">Phone No</th>
      <th scope="col">Role</th>
      <th scope="col">Status</th>
      <th scope="col">Reg Date</th>
      <th scope="col">Edit</th>
      <th scope="col">Delete</th>
    </tr>
  </thead>
  <tbody>
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

    // Check if form is submitted
    if (isset($_POST['submit'])) {
        // Get the search query
        $search = mysqli_real_escape_string($con, $_POST['search']);

        // Query to search the `users` table for ID, name, username, email, phone, or role
        $qry = "SELECT * FROM users WHERE 
                id LIKE '%$search%' OR 
                name LIKE '%$search%' OR 
                username LIKE '%$search%' OR 
                email LIKE '%$search%' OR
                tel LIKE '%$search%' OR
                role_type LIKE '%$search%'";

        $res = mysqli_query($con, $qry);

        // Check if any results are found
        if (mysqli_num_rows($res) > 0) {
            // Loop through the results and display each user
            while ($rows = mysqli_fetch_assoc($res)) { ?>
                <tr>
                    <td><?php echo htmlspecialchars($rows['id']); ?></td>
                    <td><?php echo htmlspecialchars($rows['name']); ?></td>
                    <td><?php echo htmlspecialchars($rows['username']); ?></td>
                    <td><?php echo htmlspecialchars($rows['email']); ?></td>
                    <td><?php echo htmlspecialchars($rows['tel']); ?></td>
                    <td><?php echo htmlspecialchars($rows['role_type']); ?></td>
                     <td>
         <?php 
                // Check if the status is 'Active' or 'Inactive'
                if ($rows['status'] == 'Active') {
                    echo '<a href="update.php?GetID=' . $rows['id'] . '" class="btn btn-success">' . htmlspecialchars($rows['status']) . '</a>';
                } else {
                    echo '<a href="update.php?GetID=' . $rows['id'] . '" class="btn btn-danger" disabled>' . htmlspecialchars($rows['status']) . '</a>';
                }
            ?>
        </td>
                    <td><?php echo htmlspecialchars($rows['reg_date']); ?></td> <!-- Displaying registration date -->

                    <td><a href="edit.php?GetID=<?php echo $rows['id']; ?>" class="btn btn-primary">Edit</a></td>                
                    <td><a href="delete.php?GetID=<?php echo $rows['id']; ?>" class="btn btn-danger">Delete</a></td>
                </tr>
            <?php
            }
        } else {
            // Display message if no records found
            echo "<tr><td colspan='10' style='text-align: center; color: red;'><strong>No records found for '$search'.</strong></td></tr>";
        }
    } else {
        echo "<tr><td colspan='10' style='text-align: center;'>Please enter a search term.</td></tr>";
    }

    // Close the connection
    mysqli_close($con);
    ?>
  </tbody>
</table>
<!-- End -->




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
