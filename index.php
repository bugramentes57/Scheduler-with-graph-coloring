<?php include 'dbcon.php'; ?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <title>Ders Programı</title>
  <link rel="stylesheet" href="./style.css">

</head>

<body>
<?php
    include 'dbcon.php';

    if (isset($_POST["cmdaddnew"])) {
        $sql = "INSERT INTO ogretmen_ders (ogretmen_ders_id, ogretmen_id, ders_id, ders_gun_id, ders_zamani_id,sinif_id)
                VALUES
                (:ogretmen_ders_id, :ogretmen_id, :ders_id, :ders_gun_id,:ders_zamani_id,:sinif_id)";

        $stmt = $baglanti->prepare($sql);

        $stmt->bindParam(':ogretmen_ders_id', $_POST["ogretmen_ders_id"]);
        $stmt->bindParam(':ogretmen_id', $_POST["ogretmen_id"]);
        $stmt->bindParam(':ders_id', $_POST["ders_id"]);
        $stmt->bindParam(':ders_gun_id', $_POST["ders_gun_id"]);
        $stmt->bindParam(':ders_zamani_id', $_POST["ders_zamani_id"]);
        $stmt->bindParam(':sinif_id', $_POST["sinif_id"]);
        

        if ($stmt->execute()) {
            echo "<script type= 'text/javascript'>alert('Kayıt başarıyla güncellendi');
                window.location.replace('index.php');</script>";
        } else {
            echo "<script type= 'text/javascript'>alert('Kayıt güncellenirken hata oluştu: " . implode(" ", $stmt->errorInfo()) . "');</script>";
        }

    }
    ?>

  <!-- partial:index.partial.html -->
  <!DOCTYPE html>
  <script src="https://cdn.freecodecamp.org/testable-projects-fcc/v1/bundle.js"></script>
  <html>

  <head>
    <title>Table Studies</title>
  </head>

  <body>
    <header id="header">
      <div class="logo">
        <img id="header-img"
          src="https://www.logopik.com/wp-content/uploads/edd/2018/11/Education-Logo-Vector-Free-Download-1.png"
          alt="logo" />
      </div>

      <H1 id="title" align="center" style="color:#3587A4 ;">Ders Programı Düzeni</H1>



      <nav id="nav-bar">

        <!--   <ul class="navigation"> -->

        <!--     <li class="active"><a href="#lesson-table">PRE-SCHOOL</a></li>
    <li><a href="#lesson-table" >PRİMARY SCHOOL</a></li>
    <li><a href="#lesson-table">Secondary school</a></li> -->
        <li><a href="edit2.php" class="nav-link">Ders Ekle</a></li>
        <li><a href="edit.php" class="nav-link">Öğretmen Ekle</a></li>
        <li><a href="edit3.php" class="nav-link">Sınıf Ekle</a></li>

        </ul>
      </nav>





      <br>


    </header>

    </div>


    <br>
    <!--   <p id="description">Go!</p> -->
    <input type="text" placeholder="Please search the keywords">
    <br>
    <br>

    <div id="lesson-table">
      <table>
        <thead>

          <tr>
            <th>lesson plan</th>
            <th>Pazartesi</th>
            <th>Salı</th>
            <th>Çarşamba</th>
            <th>Perşembe</th>
            <th>Cuma</th>

          </tr>
        </thead>
        <tbody>
          <tr>
            <th class="color">8.00-10.00</th>
            <td rowspan="1">10 AM</td>
            <td rowspan="1">10 AM</td>
            <td rowspan="1">9 AM</td>
            <td>8 AM</td>
            <td colspan="1">DAY OFF</td>

          </tr>
          <tr>
            <th class="color">10.00-12.00</th>
            <td rowspan="1">10 AM</td>
            <td rowspan="1">10 AM</td>
            <td rowspan="1">9 AM</td>
            <td>8 AM</td>
            <td colspan="1">DAY OFF</td>
          </tr>
          <tr>
            <th class="color">12.00-14.00</th>
            <td rowspan="1">10 AM</td>
            <td rowspan="1">10 AM</td>
            <td rowspan="1">9 AM</td>
            <td>8 AM</td>
            <td colspan="1">DAY OFF</td>

          </tr>
          <tr>
            <th class="color">14.00-16.00</th>
            <td rowspan="1">10 AM</td>
            <td rowspan="1">10 AM</td>
            <td rowspan="1">9 AM</td>
            <td>8 AM</td>
            <td colspan="1">DAY OFF</td>
          </tr>
          <tr>
            <th class="color">16.00-18.00</th>
            <td rowspan="1">10 AM</td>
            <td rowspan="1">10 AM</td>
            <td rowspan="1">9 AM</td>
            <td>8 AM</td>
            <td colspan="1">DAY OFF</td>

          </tr>

        </tbody>
      </table>
    </div>

    <form  method="POST"
      id="form">




      <fieldset>
        <legend>Ders Programı Düzenleme</legend>

        <div>
          <label>Öğretmen Ders ID</label>
          <input type="text"  name="ogretmen_ders_id" class="form-control" placeholder="Öğretmen Ders ID Giriniz" required />

        </div>

        <br />

        <div >
          <label>Öğretmen ID</label>
          <input type="text"  name="ogretmen_id" placeholder="Öğretmen ID Giriniz" required />
        </div>
        <br>
        <div >
          <label>Ders ID</label>
          <input type="text" name="ders_id" class="form-control" placeholder="Ders ID Giriniz" required />
        </div>
        
        <br>
        <br>

        <div>
          <label>Ders Gün ID</label>
          <input type="text" name="ders_gun_id" class="form-control" placeholder="Ders Gün ID Giriniz" required />

        </div>
        <br><br>

        <div>
          <label>Ders Zamanı ID</label>
          <input type="text" name="ders_zamani_id" class="form-control" placeholder="Ders Zamanı ID Giriniz" required />

        </div>
        <br><br>

        <div>
          <label>Sınıf ID</label>
          <input type="text" name="sinif_id" class="form-control" placeholder="Sınıf ID Giriniz" required />

        </div>

        <input type="submit" name="cmdaddnew" id="submit" value="Kaydet" />
      </fieldset>
    </form>
    <footer>

    </footer>

  </body>

  </html>
  <!-- partial -->

</body>

</html>