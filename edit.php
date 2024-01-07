<!-- bu kod https://tutorial101.blogspot.com/2019/10/data-table-using-mysqli-database-and.html bu adresten yardım alınarak yazılmıştır -->


<?php include 'dbcon.php'; ?>




<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Data Table using Mysqli Database and Bootstrap with Modal Form</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto|Varela+Round">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style type="text/css">
        body {
            color: #566787;
            background: #f5f5f5;
            font-family: 'Varela Round', sans-serif;
            font-size: 13px;
        }

        .table-wrapper {
            background: #fff;
            padding: 20px 25px;
            margin: 30px 0;
            border-radius: 3px;
            box-shadow: 0 1px 1px rgba(0, 0, 0, .05);
        }

        .table-title {
            padding-bottom: 15px;
            background: #88CCF1;
            color: #fff;
            padding: 16px 30px;
            margin: -20px -25px 10px;
            border-radius: 3px 3px 0 0;
        }

        .table-title h2 {
            margin: 5px 0 0;
            font-size: 24px;
        }

        .table-title .btn-group {
            float: right;
        }

        .table-title .btn {
            color: #fff;
            float: right;
            font-size: 13px;
            border: none;
            min-width: 50px;
            border-radius: 2px;
            border: none;
            outline: none !important;
            margin-left: 10px;
        }

        .table-title .btn i {
            float: left;
            font-size: 21px;
            margin-right: 5px;
        }

        .table-title .btn span {
            float: left;
            margin-top: 2px;
        }

        table.table tr th,
        table.table tr td {
            border-color: #e9e9e9;
            padding: 12px 15px;
            vertical-align: middle;
        }

        table.table tr th:first-child {
            width: 60px;
        }

        table.table tr th:last-child {
            width: 100px;
        }

        table.table-striped tbody tr:nth-of-type(odd) {
            background-color: #fcfcfc;
        }

        table.table-striped.table-hover tbody tr:hover {
            background: #f5f5f5;
        }

        table.table th i {
            font-size: 13px;
            margin: 0 5px;
            cursor: pointer;
        }

        table.table td:last-child i {
            opacity: 0.9;
            font-size: 22px;
            margin: 0 5px;
        }

        table.table td a {
            font-weight: bold;
            color: #566787;
            display: inline-block;
            text-decoration: none;
            outline: none !important;
        }

        table.table td a:hover {
            color: #2196F3;
        }

        table.table td a.edit {
            color: #FFC107;
        }

        table.table td a.delete {
            color: #F44336;
        }

        table.table td i {
            font-size: 19px;
        }

        table.table .avatar {
            border-radius: 50%;
            vertical-align: middle;
            margin-right: 10px;
        }

        .pagination {
            float: right;
            margin: 30px 0 5px;
        }

        .pagination li a {
            border: none;
            font-size: 13px;
            min-width: 30px;
            min-height: 30px;
            color: #999;
            margin: 0 2px;
            line-height: 30px;
            border-radius: 2px !important;
            text-align: center;
            padding: 0 6px;
        }

        .pagination li a:hover {
            color: #666;
        }

        .pagination li.active a,
        .pagination li.active a.page-link {
            background: #03A9F4;
        }

        .pagination li.active a:hover {
            background: #0397d6;
        }

        .pagination li.disabled i {
            color: #ccc;
        }

        .pagination li i {
            font-size: 16px;
            padding-top: 6px
        }

        .hint-text {
            float: left;

            font-size: 13px;
        }

        .custom-checkbox {
            position: relative;
        }

        .custom-checkbox input[type="checkbox"] {
            opacity: 0;
            position: absolute;
            margin: 5px 0 0 3px;
            z-index: 9;
        }

        .custom-checkbox label:before {
            width: 18px;
            height: 18px;
        }

        .custom-checkbox label:before {
            content: '';
            margin-right: 10px;
            display: inline-block;
            vertical-align: text-top;
            background: white;
            border: 1px solid #bbb;
            border-radius: 2px;
            box-sizing: border-box;
            z-index: 2;
        }

        .custom-checkbox input[type="checkbox"]:checked+label:after {
            content: '';
            position: absolute;
            left: 6px;
            top: 3px;
            width: 6px;
            height: 11px;
            border: solid #000;
            border-width: 0 3px 3px 0;
            transform: inherit;
            z-index: 3;
            transform: rotateZ(45deg);
        }

        .custom-checkbox input[type="checkbox"]:checked+label:before {
            border-color: #03A9F4;
            background: #03A9F4;
        }

        .custom-checkbox input[type="checkbox"]:checked+label:after {
            border-color: #fff;
        }

        .custom-checkbox input[type="checkbox"]:disabled+label:before {
            color: #b8b8b8;
            cursor: auto;
            box-shadow: none;
            background: #ddd;
        }

        /* Modal styles */
        .modal .modal-dialog {
            max-width: 400px;
        }

        .modal .modal-header,
        .modal .modal-body,
        .modal .modal-footer {
            padding: 20px 30px;
        }

        .modal .modal-content {
            border-radius: 3px;
        }

        .modal .modal-footer {
            background: #ecf0f1;
            border-radius: 0 0 3px 3px;
        }

        .modal .modal-title {
            display: inline-block;
        }

        .modal .form-control {
            border-radius: 2px;
            box-shadow: none;
            border-color: #dddddd;
        }

        .modal textarea.form-control {
            resize: vertical;
        }

        .modal .btn {
            border-radius: 2px;
            min-width: 100px;
        }

        .modal form label {
            font-weight: normal;
        }
    </style>
    <script type="text/javascript">
        $(document).ready(function () {
            // Activate tooltip
            $('[data-toggle="tooltip"]').tooltip();
            // Select/Deselect checkboxes
            var checkbox = $('table tbody input[type="checkbox"]');
            $("#selectAll").click(function () {
                if (this.checked) {
                    checkbox.each(function () {
                        this.checked = true;
                    });
                } else {
                    checkbox.each(function () {
                        this.checked = false;
                    });
                }
            });
            checkbox.click(function () {
                if (!this.checked) {
                    $("#selectAll").prop("checked", false);
                }
            });
        });




    </script>
</head>

<body>
    <?php
    include 'dbcon.php';

    if (isset($_POST["cmdaddnew"])) {
        $sql = "INSERT INTO ogretmen (ogretmen_id, ogretmen_ad, ogretmen_soyad, ogretmen_brans)
                VALUES
                (:ogretmen_id, :ogretmen_ad, :ogretmen_soyad, :ogretmen_brans)";

        $stmt = $baglanti->prepare($sql);

        $stmt->bindParam(':ogretmen_id', $_POST["ogretmen_id"]);
        $stmt->bindParam(':ogretmen_ad', $_POST["ogretmen_ad"]);
        $stmt->bindParam(':ogretmen_soyad', $_POST["ogretmen_soyad"]);
        $stmt->bindParam(':ogretmen_brans', $_POST["ogretmen_brans"]);

        if ($stmt->execute()) {
            echo "<script type= 'text/javascript'>alert('Kayıt başarıyla güncellendi');
                window.location.replace('edit.php');</script>";
        } else {
            echo "<script type= 'text/javascript'>alert('Kayıt güncellenirken hata oluştu: " . implode(" ", $stmt->errorInfo()) . "');</script>";
        }

    }

    $editemployee = (isset($_GET['editemployee'])) ? $_GET['editemployee'] : '';
    if ($editemployee == '') {
    } else {
        echo "<script type= 'text/javascript'>$(document).ready(function(){ $('#editEmployeeModal').modal() });</script>";
        $sql = "SELECT * FROM ogretmen WHERE ogretmen_id = :ogretmen_id";
        $stmt = $baglanti->prepare($sql);
        $stmt->bindParam(':ogretmen_id', $editemployee);
        $stmt->execute();

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $ogretmen_id = $row["ogretmen_id"];
            $ogretmen_ad = $row["ogretmen_ad"];
            $ogretmen_soyad = $row["ogretmen_soyad"];
            $ogretmen_brans = $row["ogretmen_brans"];
        }
    }

    $deleteemployee = (isset($_GET['deleteemployee'])) ? $_GET['deleteemployee'] : '';
    if ($deleteemployee == '') {
    } else {
        echo "<script type= 'text/javascript'>$(document).ready(function(){ $('#deleteEmployeeModal').modal() });</script>";
    }
    if (isset($_POST["cmdelete"])) {
        $sql = "DELETE FROM ogretmen WHERE ogretmen_id='$deleteemployee'";
        if ($baglanti->query($sql) === TRUE) {
            echo "<script type= 'text/javascript'>alert('Record deleted successfully');
      window.location.replace('edit.php');</script>";
        } else {
            $errorInfo = $baglanti->errorInfo();
            echo "<script type='text/javascript'>alert('Error deleting record: " . $sql . "<br>" . $errorInfo[2] . "');</script>";
        }
    }

    if (isset($_POST["cmdedit"])) {
        $ogretmen_id = $_POST["ogretmen_id"];
        $ogretmen_ad = $_POST["ogretmen_ad"];
        $ogretmen_soyad = $_POST["ogretmen_soyad"];
        $ogretmen_brans = $_POST["ogretmen_brans"];

        $sql = "UPDATE ogretmen SET ogretmen_id=:ogretmen_id, ogretmen_ad=:ogretmen_ad, ogretmen_soyad=:ogretmen_soyad, ogretmen_brans=:ogretmen_brans WHERE ogretmen_id=:ogretmen_id";

        $stmt = $baglanti->prepare($sql);
        $stmt->bindParam(':ogretmen_id', $ogretmen_id);
        $stmt->bindParam(':ogretmen_ad', $ogretmen_ad);
        $stmt->bindParam(':ogretmen_soyad', $ogretmen_soyad);
        $stmt->bindParam(':ogretmen_brans', $ogretmen_brans);
        $stmt->bindParam(':ogretmen_id', $editemployee);

        if ($stmt->execute()) {
            echo "<script type= 'text/javascript'>alert('Kayıt başarıyla güncellendi');
                window.location.replace('edit.php');</script>";
        } else {
            echo "<script type= 'text/javascript'>alert('Kayıt güncellenirken hata oluştu: " . implode(" ", $stmt->errorInfo()) . "');</script>";
        }
    }

    ?>





    <div class="container">
        <div class="result"></div>

        <div class="table-wrapper">

            <div class="table-title">
                <div class="row">
                    <div class="col-sm-6">
                        <h2>Öğretmen <b>Ekleme</b></h2>
                    </div>
                    <div class="col-sm-6">
                        <a href="#addEmployeeModal" class="btn btn-success" data-toggle="modal"><i
                                class="material-icons">🍳</i> <span>Öğretmen Ekle</span></a>

                    </div>
                </div>
            </div>
            <table class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th>
                            <span class="custom-checkbox">
                                <input type="checkbox" id="selectAll">
                                <label for="selectAll"></label>
                            </span>
                        </th>
                        <th>ogretmen_id</th>
                        <th>ogretmen_ad</th>
                        <th>ogretmen_soyad</th>
                        <th>ogrentmen_brans</th>



                    </tr>

                </thead>


                <tbody>
                    <tr>

                    </tr>



                    </thead>
                <tbody>
                    <?php
                    $urunsor = $baglanti->prepare("SELECT * FROM ogretmen");
                    $urunsor->execute();
                    while ($uruncek = $urunsor->fetch(PDO::FETCH_ASSOC)) {
                        ?>
                        <tr>
                            <td>
                                <span class="custom-checkbox">
                                    <input type="checkbox" id="checkbox1" name="options" value="1">
                                    <label for="checkbox1"></label>
                                </span>
                            </td>
                            <td>
                                <?PHP echo $uruncek['ogretmen_id'] ?>
                            </td>
                            <td>
                                <?PHP echo $uruncek['ogretmen_ad'] ?>
                            </td>
                            <td>
                                <?PHP echo $uruncek['ogretmen_soyad'] ?>
                            </td>
                            <td>
                                <?PHP echo $uruncek['ogretmen_brans'] ?>
                            </td>

                            <td>
                                <a href="?editemployee=<?php echo $uruncek['ogretmen_id']; ?>" class="edit"
                                    data-toggle="modal"><i class="material-icons" data-toggle="tooltip"
                                        title="Edit"></i></a>
                                <a href="?deleteemployee=<?php echo $uruncek['ogretmen_id']; ?>" class="delete"
                                    data-toggle="modal"><i class="material-icons" data-toggle="tooltip"
                                        title="Delete"></i></a>
                            </td>






                        </tr>
                        <?php
                    }
                    ?>
                </tbody>

            </table>


        </div>
        <div id="addEmployeeModal" class="modal fade">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form action="" method="post">
                        <div class="modal-header">
                            <h4 class="modal-title">Ogretmen Ekle</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        </div>
                        <div class="modal-body">
                            <div class="form-group">
                                <label>ogretmen_id</label>
                                <input type="text" name="ogretmen_id" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label>ogretmen_ad</label>
                                <input type="text" name="ogretmen_ad" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label>ogretmen_soyad</label>
                                <input type="text" name="ogretmen_soyad" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label>ogretmen_brans</label>
                                <input type="text" name="ogretmen_brans" class="form-control" required>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <input type="button" class="btn btn-default" data-dismiss="modal" value="Kapat">
                            <input type="submit" class="btn btn-success" name="cmdaddnew" value="Ekle">
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- Edit Modal HTML -->
        <div id="editEmployeeModal" class="modal fade">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form name="frmedit" action="" method="post">
                        <div class="modal-header">
                            <h4 class="modal-title">Öğretmen Düzenleme</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        </div>
                        <div class="modal-body">
                            <div class="form-group">
                                <label>ogretmen_id</label>
                                <input type="text" name="ogretmen_id" value="<?php echo $ogretmen_id; ?>"
                                    class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label>ogretmen_ad</label>
                                <input type="text" name="ogretmen_ad" value="<?php echo $ogretmen_ad; ?>"
                                    class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label>ogretmen_soyad</label>
                                <input type="text" name="ogretmen_soyad" value="<?php echo $ogretmen_soyad; ?>"
                                    class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label>ogretmen_brans</label>
                                <input type="text" name="ogretmen_brans" value="<?php echo $ogretmen_brans; ?>"
                                    class="form-control" required>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <input type="button" class="btn btn-default" data-dismiss="modal" value="Kapat">
                            <input type="submit" name="cmdedit" class="btn btn-info" value="Kaydet">
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- Delete Modal HTML -->
        <div id="deleteEmployeeModal" class="modal fade">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form name="frmdelete" action="" method="post">
                        <div class="modal-header">
                            <h4 class="modal-title">Delete Employee</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        </div>
                        <div class="modal-body">
                            <p>Are you sure you want to delete these Records?</p>
                            <p class="text-warning"><small>This action cannot be undone.</small></p>
                        </div>
                        <div class="modal-footer">
                            <input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
                            <input type="submit" name="cmdelete" class="btn btn-danger" value="Delete">
                        </div>
                    </form>
                </div>
            </div>
        </div>


</body>

</html>