<?php
include 'dbcon.php';


// Function to fetch data for dropdowns
function getDropdownData($tableName, $idColumn, $valueColumn)
{
    global $baglanti;
    $query = "SELECT $idColumn, $valueColumn FROM $tableName";
    $stmt = $baglanti->prepare($query);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['submit'])) {
        // Process form submission
        $ogretmen_id = $_POST['ogretmen_id'];
        $ders_id = $_POST['ders_id'];
        $ders_gun_id = $_POST['ders_gun_id'];
        $ders_zamani_id = $_POST['ders_zamani_id'];
        $sinif_id = $_POST['sinif_id'];

        $insertQuery = "INSERT INTO ogretmen_ders (ogretmen_id, ders_id, ders_gun_id, ders_zamani_id,sinif_id) 
                        VALUES (:ogretmen_id, :ders_id, :ders_gun_id, :ders_zamani_id,:sinif_id)";
        $insertStmt = $baglanti->prepare($insertQuery);
        $insertStmt->bindParam(':ogretmen_id', $ogretmen_id);
        $insertStmt->bindParam(':ders_id', $ders_id);
        $insertStmt->bindParam(':ders_gun_id', $ders_gun_id);
        $insertStmt->bindParam(':ders_zamani_id', $ders_zamani_id);
        $insertStmt->bindParam(':sinif_id', $sinif_id);
        $insertStmt->execute();
    }
}
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Check for delete action
    if (isset($_POST['delete_entry_id'])) {
        $deleteEntryId = $_POST['delete_entry_id'];

        // Perform the deletion based on the $deleteEntryId
        $deleteQuery = "DELETE FROM ogretmen_ders WHERE ogretmen_id = :ogretmen_id";
        $deleteStmt = $baglanti->prepare($deleteQuery);
        $deleteStmt->bindParam(':ogretmen_id', $deleteEntryId);
        $deleteStmt->execute();
    }
}



?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ders Programı</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <style>
        table {
            width: 100%;
            margin-left: auto;
            margin-right: auto;
            display: table;
        }

        table,
        th,
        td {
            border: 1px solid black;
            border-collapse: collapse;
        }

        th,
        td {
            padding: 10px;
        }
    </style>
</head>

<body>
    <div class="container">
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
            Ders Programına Ekle
        </button>
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal"
            onclick="redirectToEdit2()">
            Ders Ekle
        </button>

        <script>
            function redirectToEdit2() {
                window.location.href = "edit2.php";
            }
        </script>

        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal"
            onclick="redirectToEdit3()">
            Öğretmen Ekle
        </button>

        <script>
            function redirectToEdit3() {
                window.location.href = "edit.php";
            }
        </script>
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal"
            onclick="redirectToEdit4()">
            Sınıf Ekle
        </button>

        <script>
            function redirectToEdit4() {
                window.location.href = "edit3.php";
            }
        </script>

        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Saat</th>
                    <th>Pazartesi</th>
                    <th>Salı</th>
                    <th>Çarşamba</th>
                    <th>Perşembe</th>
                    <th>Cuma</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Fetch data from the database
                $query = "SELECT * FROM ogretmen_ders 
                              INNER JOIN ders_zamani ON ogretmen_ders.ders_zamani_id = ders_zamani.ders_zamani_id
                              INNER JOIN gunler ON ogretmen_ders.ders_gun_id = gunler.gun_id
                              INNER JOIN dersler ON ogretmen_ders.ders_id = dersler.ders_id
                              INNER JOIN ogretmen ON ogretmen_ders.ogretmen_id = ogretmen.ogretmen_id
                              INNER JOIN sinif ON ogretmen_ders.sinif_id = sinif.sinif_id";


                $stmt = $baglanti->prepare($query);
                $stmt->execute();
                $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

                // Initialize an array to store the schedule
                $schedule = array();

                // Populate the schedule array with data from the database
                foreach ($result as $row) {
                    $schedule[$row['ders_zamani_id']][$row['ders_gun_id']] = $row;
                }

                // Define the time slots
                $timeSlots = array('09:00', '10:00', '11:00', '12:00', '13:00', '14:00', '15:00', '16:00');

                // Loop through time slots
                foreach ($timeSlots as $index => $time) {
                    echo "<tr>";
                    echo "<td>$time</td>";

                    // Loop through days
                    for ($day = 1; $day <= 5; $day++) {
                        $cellName = ($index + 1) . "-" . $day;
                        echo "<td name=\"$cellName\">";
                        if (isset($schedule[$index + 1][$day])) {
                            // Display the class information
                            echo $schedule[$index + 1][$day]['ogretmen_ad'] . " " . $schedule[$index + 1][$day]['ogretmen_soyad'] . "<br>" . $schedule[$index + 1][$day]['ders_ad'];
                        }
                        echo "</td>";
                    }

                    echo "</tr>";
                }
                ?>
            </tbody>
        </table>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add Entry</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="">
                        <div class="form-group">
                            <label for="ogretmen_id">Teacher:</label>
                            <select class="form-control" id="ogretmen_id" name="ogretmen_id">
                                <?php
                                $ogretmenler = getDropdownData('ogretmen', 'ogretmen_id', 'ogretmen_ad');
                                foreach ($ogretmenler as $ogretmen) {
                                    echo "<option value='{$ogretmen['ogretmen_id']}'>{$ogretmen['ogretmen_ad']} {$ogretmen['ogretmen_soyad']}</option>";
                                }
                                ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="ders_id">Course:</label>
                            <select class="form-control" id="ders_id" name="ders_id">
                                <?php
                                $dersler = getDropdownData('dersler', 'ders_id', 'ders_ad');
                                foreach ($dersler as $ders) {
                                    echo "<option value='{$ders['ders_id']}'>{$ders['ders_ad']}</option>";
                                }
                                ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="ders_gun_id">Day:</label>
                            <select class="form-control" id="ders_gun_id" name="ders_gun_id">
                                <?php
                                $gunler = getDropdownData('gunler', 'gun_id', 'gun_ad');
                                foreach ($gunler as $gun) {
                                    echo "<option value='{$gun['gun_id']}'>{$gun['gun_ad']}</option>";
                                }
                                ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="ders_zamani_id">Time:</label>
                            <select class="form-control" id="ders_zamani_id" name="ders_zamani_id">
                                <?php
                                $zamanlar = getDropdownData('ders_zamani', 'ders_zamani_id', 'ders_saati_araligi');
                                foreach ($zamanlar as $zaman) {
                                    echo "<option value='{$zaman['ders_zamani_id']}'>{$zaman['ders_saati_araligi']}</option>";
                                }
                                ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="sinif_id">Sınıf:</label>
                            <select class="form-control" id="sinif_id" name="sinif_id">
                                <?php
                                $siniflar = getDropdownData('sinif', 'sinif_id', 'sinif_ad');
                                foreach ($siniflar as $sinif) {
                                    echo "<option value='{$sinif['sinif_id']}'>{$sinif['sinif_ad']}</option>";
                                }
                                ?>
                            </select>
                        </div>
                        <form method="POST" action="" id="scheduleForm">
                            <!-- ... (existing form fields) ... -->
                            <input type="hidden" name="delete_entry_id" id="delete_entry_id" value="">
                            <button type="submit" name="submit" class="btn btn-primary">Add</button>
                            <button type="submit" class="btn btn-danger" id="deleteEntryBtn"
                                onclick="setDeleteEntryId()">Delete</button>
                        </form>

                        <script>
                            function setDeleteEntryId() {
                                // Your logic to get the selected entry ID, for example, using jQuery
                                var selectedEntryId = $('select#ogretmen_id').val(); // Replace this line with your actual logic

                                // Set the value of the hidden input field
                                $('#delete_entry_id').val(selectedEntryId);
                            }
                        </script>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.1/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>

</body>

</html>