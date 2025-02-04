<?php
session_start();

// Check if user is logged in
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah PR Consumable - ERP</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link href="style.css" rel="stylesheet">
</head>
<body>
<?php
        include_once('menu.php');
        include_once("xproc.php");
	    include_once("xparam.php");
	    include_once("xfunct.php");
?>
    <div class="container mt-4">
        <h4>Tambah PR Consumable</h4>
        <form id="prForm" method="POST" action="process_pr.php">
            <div class="row mb-3">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label class="form-label">TANGGAL</label>
                        <input type="date" class="form-control" name="tanggal" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">NOMOR</label>
                        <div class="input-group">
                            <input type="text" class="form-control" value="AUTO" readonly>
                            <input type="text" class="form-control" value="ENG/PR/01/23" readonly>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">DIVISION</label>
                        <input type="text" class="form-control" value="PROJECT & PLANT" readonly>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">DEPARTMENT</label>
                        <input type="text" class="form-control" value="ENGINEERING DEPT" readonly>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">SECTION</label>
                        <div class="input-group">
                            <input type="text" class="form-control" placeholder="JO" name="jo">
                            <input type="text" class="form-control" placeholder="Batch" name="batch">
                            <input type="text" class="form-control" placeholder="Cost Center" name="cost_center">
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">REMARK</label>
                        <textarea class="form-control" name="remark" rows="3"></textarea>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        <label class="form-label">MTO</label>
                        <input type="text" class="form-control" name="mto">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">DATE REQ</label>
                        <input type="date" class="form-control" name="date_req">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">POINT OF DELIVERY</label>
                        <textarea class="form-control" name="delivery_point" rows="3"></textarea>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">PURPOSE</label>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="stock_item" id="stockItem">
                            <label class="form-check-label" for="stockItem">STOCK ITEM</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="capital_assets" id="capitalAssets">
                            <label class="form-check-label" for="capitalAssets">CAPITAL ASSETS</label>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">USER</label>
                        <input type="text" class="form-control" name="user">
                    </div>
                </div>
            </div>

            <div class="card mb-4">
                <div class="card-header">
                    PR ITEMS
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="prItemsTable">
                            <thead>
                                <tr>
                                    <th>NO.</th>
                                    <th>KETERANGAN</th>
                                    <th>QTY</th>
                                    <th>SATUAN</th>
                                    <th>ACTIONS</th>
                                </tr>
                            </thead>
                            <tbody>
                                <!-- Items will be added here dynamically -->
                            </tbody>
                        </table>
                    </div>
                    <div class="btn-group">
                        <button type="button" class="btn btn-success" id="addItem">
                            <i class="fas fa-plus"></i> Add Item
                        </button>
                        <button type="button" class="btn btn-danger" id="deleteItem">
                            <i class="fas fa-trash"></i> Delete
                        </button>
                        <button type="button" class="btn btn-warning" id="refresh">
                            <i class="fas fa-sync"></i> Refresh
                        </button>
                    </div>
                </div>
            </div>

            <div class="card mb-4">
                <div class="card-header">
                    Approval
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <input type="text" class="form-control mb-2" value="Bondan Ariwibowo" readonly>
                            <input type="text" class="form-control" value="Engineering Dept." readonly>
                        </div>
                        <div class="col-md-6">
                            <input type="text" class="form-control mb-2" value="Billy Nuryanto" readonly>
                            <input type="text" class="form-control" value="GM Project & Plant" readonly>
                        </div>
                    </div>
                </div>
            </div>

            <div class="text-center mb-4">
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save"></i> Save
                </button>
                <button type="reset" class="btn btn-warning">
                    <i class="fas fa-undo"></i> Reset
                </button>
                <button type="button" class="btn btn-danger" onclick="window.location.href='eng_cons_pr.php'">
                    <i class="fas fa-times"></i> Cancel
                </button>
            </div>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            let rowCount = 1;

            // Function to add new item row
            $('#addItem').click(function() {
                const newRow = `
                    <tr>
                        <td>${rowCount}</td>
                        <td><input type="text" class="form-control" name="keterangan[]"></td>
                        <td><input type="number" class="form-control" name="qty[]"></td>
                        <td><input type="text" class="form-control" name="satuan[]"></td>
                        <td>
                            <button type="button" class="btn btn-sm btn-danger delete-row">
                                <i class="fas fa-trash"></i>
                            </button>
                        </td>
                    </tr>
                `;
                $('#prItemsTable tbody').append(newRow);
                rowCount++;
            });

            // Delete row
            $(document).on('click', '.delete-row', function() {
                $(this).closest('tr').remove();
            });

            // Refresh table
            $('#refresh').click(function() {
                $('#prItemsTable tbody').empty();
                rowCount = 1;
            });
        });
    </script>
</body>
</html>
