<?php
session_start();

// Check if user is logged in
if (!isset($_SESSION['sMISAppNIK'])) {
    header("Location: index.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - ERP</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link href="style.css" rel="stylesheet">
    <link href="dashboard.css" rel="stylesheet">
</head>
<body>
    <?php include_once("menu.php"); ?>
    <div class="main-content">
        <div class="container mt-4">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <h2 class="card-title mb-4">ERP Karunia Berca Indonesia</h2>
                            <div class="user-info">
                                <h4><?php echo htmlspecialchars($_SESSION['sMISAppNamaLengkap']); ?></h4>
                                <p class="text-muted mb-2">
                                    <i class="fas fa-id-card me-2"></i>NIK: <?php echo htmlspecialchars($_SESSION['sMISAppNIK']); ?>
                                </p>
                                <p class="text-muted mb-2">
                                    <i class="fas fa-building me-2"></i>Departemen: <?php echo htmlspecialchars($_SESSION['sMISAppDepartmentNama']); ?>
                                </p>
                                <p class="text-muted mb-2">
                                    <i class="fas fa-user-tie me-2"></i>Jabatan: <?php echo htmlspecialchars($_SESSION['sMISAppJabatanNama']); ?>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
