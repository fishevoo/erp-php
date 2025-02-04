<?php
session_start();    
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="icon" href="logo.jpg" type="image/x-icon">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ERP - PT KARUNIA BERCA INDONESIA</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link href="style.css" rel="stylesheet">
    <link href="login.css" rel="stylesheet">
    
    <script type="text/javascript">
        function validateForm() {
            var username = document.forms["loginForm"]["UserName"].value;
            var password = document.forms["loginForm"]["Password"].value;
            
            if (username == "" || password == "") {
                alert("UserName dan Password harus diisi.");
                return false;
            }
            return true;
        }
        
        document.addEventListener('DOMContentLoaded', function() {
            document.forms["loginForm"].setAttribute('novalidate', 'novalidate');
        });
    </script>
</head>
<body>
    <div class="login-container">
        <?php
        if (isset($_SESSION['error'])) {
            echo '<div class="alert alert-danger">' . $_SESSION['error'] . '</div>';
            unset($_SESSION['error']);
        }
        if (isset($_SESSION['message'])) {
            echo '<div class="alert alert-success">' . $_SESSION['message'] . '</div>';
            unset($_SESSION['message']);
        }
        ?>
        <div class="text-center mb-4">
            <img src="logo.jpg" alt="Company Logo" class="logo mb-4">
            <h2 class="text-primary fw-bold">ERP Login</h2>
            <p class="text-muted">PT KARUNIA BERCA INDONESIA</p>
        </div>
        <form name="loginForm" action="xlogin.php" method="POST" onsubmit="return validateForm()" novalidate>
            <div class="mb-4">
                <label class="form-label">Username</label>
                <div class="input-group">
                    <span class="input-group-text"><i class="fas fa-user"></i></span>
                    <input type="text" class="form-control" name="UserName" autocomplete="off">
                </div>
            </div>
            <div class="mb-4">
                <label class="form-label">Password</label>
                <div class="input-group">
                    <span class="input-group-text"><i class="fas fa-lock"></i></span>
                    <input type="password" class="form-control" name="Password">
                </div>
            </div>
            <button type="submit" class="btn btn-primary w-100 py-2">Login</button>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
