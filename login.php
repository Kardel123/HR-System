<?php
session_start();

// Check if session already exists
if (isset($_SESSION['username'])) {
    header("Location: index.php");
    exit();
}

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $_SESSION['username'] = $_POST['username'];
    $_SESSION['last_activity'] = time(); // Set last activity time
    header("Location: index.php");
    exit();
}

// Check for session timeout (10 minutes)
if (isset($_SESSION['last_activity']) && (time() - $_SESSION['last_activity']) > 60) { // 600 seconds = 10 minutes
    session_unset(); // Unset session variables
    session_destroy(); // Destroy the session
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Login</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        /* Font Face Declarations */
        @font-face {
            font-family: 'Circular';
            src: url('assets/fonts/CircularStd-Book.woff2') format('woff2'),
                 url('assets/fonts/CircularStd-Book.woff') format('woff');
            font-weight: normal;
            font-style: normal;
        }

        @font-face {
            font-family: 'Circular';
            src: url('assets/fonts/CircularStd-Bold.woff2') format('woff2'),
                 url('assets/fonts/CircularStd-Bold.woff') format('woff');
            font-weight: bold;
            font-style: normal;
        }

        body {
            background-image: url('assets/Loginbackground.jpg'); /* Path to your background image */
            background-size: cover; /* Cover the entire page */
            background-position: center; /* Center the image */
            height: 100vh; /* Full height */
            display: flex;
            justify-content: center; /* Center horizontally */
            align-items: center; /* Center vertically */
        }

        .login-container {
            background-color: rgba(255, 255, 255, 0.8); /* White background with transparency */
            padding: 30px;
            border-radius: 10px; /* Rounded corners */
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2); /* Shadow effect */
        }

        h1 {
            font-family: 'Circular', sans-serif; /* Use Circular for the heading */
            color: #333; /* Dark color for contrast */
        }

        .form-label {
            font-family: 'Circular', sans-serif; /* Use Circular for labels */
        }

        .btn-primary {
            font-family: 'Circular', sans-serif; /* Use Circular for buttons */
        }
    </style>
</head>
<body>

<div class="login-container">
    <h1>Username or Email</h1>
    <form method="POST" action="">
        <div class="mb-3">
            <label for="username" class="form-label">Enter your Username below:</label>
            <input type="text" name="username" id="username" required class="form-control">
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</div>

<script>
    // Reset timer on user activity
    let timeout;

    function resetTimer() {
        clearTimeout(timeout);
        timeout = setTimeout(() => {
            alert("Session expired due to inactivity.");
            window.location.href = "login.php"; // Redirect to login page
        }, 60000); // 10 minutes in milliseconds
    }

    // Listen for mouse and keyboard events
    window.onload = resetTimer;
    window.onmousemove = resetTimer;
    window.onkeypress = resetTimer;

   
</script>

</body>
</html>