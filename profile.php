<?php
session_start();

if (!isset($_SESSION['sMISAppNIK'])) {
    header("Location: index.php");
    exit();
}

include_once("menu.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Profile - <?php echo $_SESSION['sMISAppNamaLengkap']; ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link href="style.css" rel="stylesheet">
</head>
<body class="bg-light">
    <div class="container mt-4">
        <div class="card">
            <div class="card-header">
                <h4 class="mb-0">User Profile</h4>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-3 text-center mb-4">
                        <img src="avatar.jpg" alt="Profile Picture" class="img-fluid rounded-circle mb-3" style="max-width: 200px;">
                        <h5><?php echo htmlspecialchars($_SESSION['sMISAppNamaLengkap']); ?></h5>
                    </div>
                    <div class="col-md-9">
                        <div class="row mb-3">
                            <div class="col-md-3 fw-bold">NIK</div>
                            <div class="col-md-9"><?php echo htmlspecialchars($_SESSION['sMISAppNIK']); ?></div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-3 fw-bold">Department</div>
                            <div class="col-md-9"><?php echo htmlspecialchars($_SESSION['sMISAppDepartmentNama']); ?></div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-3 fw-bold">Jabatan</div>
                            <div class="col-md-9"><?php echo htmlspecialchars($_SESSION['sMISAppJabatanNama']); ?></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>