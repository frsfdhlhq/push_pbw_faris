<?php
include "tampilkan_data.php";
include "edit_data.php";

$data_edit = mysqli_fetch_assoc($proses_ambil);
?>

<html>
<header>
  <title>
  </title>

  <link href="library/bootstrap/css/bootstrap.min.css" rel="stylesheet" media="screen">
  <link href="library/bootstrap/css/bootstrap-responsive.min.css" rel="stylesheet" media="screen">
  <link href="library/assets/styles.css" rel="stylesheet" media="screen">
  <script src="library/vendors/modernizr-2.6.2-respond-1.1.0.min.js"></script>
</header>

<body>

  <div class="span9" id="content">
    <!-- morris stacked chart -->
    <div class="row-fluid">
      <!-- block -->
      <div class="block">
        <div class="navbar navbar-inner block-header">
          <div class="muted pull-left">Input prodi Mahasiswa</div>
        </div>
        <div class="block-content collapse in">
          <div class="span12">

            <?php
            if (isset($_GET['id']) && $_GET['id'] != '') {
              //proses edit data
            ?>
              <form action="edit_data.php?id=<?php echo $data_edit['id'] ?>&proses=1" method="POST">
              <?php
            } else {
              ?>
                <form action="proses.php" method="POST">
                <?php
              }
                ?>

                <fieldset>
                  <legend>Input Data Mahasiswa</legend>

                  <div class="control-group">
                    <label class="control-label" for="nama">NAMA MAHASISWA : </label>
                    <div class="controls">
                      <input type="hidden" class="input-xlarge focused" id="nama" name="nama" value="<?php if ($data_edit['id'] != "") echo $data_edit['id']; ?>">

                      <input type="text" class="input-xlarge focused" id="nama" name="nama" value="<?php if (isset($data_edit['nama_mahasiswa']) && $data_edit['nama_mahasiswa'] != "") echo $data_edit['nama_mahasiswa']; ?>">
                    </div>
                  </div>

                  <div class="control-group">
                    <label class="control-label" for="npm ">NPM MAHASISWA : </label>
                    <div class="controls">
                      <input type="text" class="input-xlarge focused" id="npm" name="npm" value="<?php if (isset($data_edit['npm']) && $data_edit['npm'] != "") echo $data_edit['npm']; ?>">
                    </div>

                    <div class="control-group">
                      <label class="control-label" for="prodi ">PRODI MAHASISWA : </label>
                      <div class="controls">
                        <input type="text" class="input-xlarge focused" id="prodi" name="prodi" value="<?php if (isset($data_edit['prodi']) && $data_edit['prodi'] != "") echo $data_edit['prodi']; ?>">
                      </div>

                      <div class="form-actions">
                        <button type="submit" class="btn btn-primary">PROSES</button>
                        <button type="reset" class="btn">Cancel</button>
                      </div>
                </form>
          </div>

          <div class="row-fluid">
            <!-- block -->
            <div class="block">
              <div class="navbar navbar-inner block-header">
                <div class="muted pull-left">Data Mahasiswa</div>
              </div>
              <div class="block-content collapse in">
                <div class="span12">
                <h3>Pencarian</h3>
                <form action="form.php" method="get">
                  <label>Cari :</label>
                  <input type="text" name="cari">
                  <input type="submit" value="Cari">
                </form>
                <?php
                if (isset($_GET['cari'])) {
                  $cari = $_GET['cari'];
                  echo "<b>Hasil pencarian : " . $cari . "</b>";
                }
                ?>
                  <table class="table">
                    <thead>
                      <tr>
                        <th>NPM</th>
                        <th>Nama Mahasiswa</th>
                        <th>Prodi Mahasiswa</th>
                        <th>Aksi</th>
                      </tr>
                      <?php
                      if (isset($_GET['cari'])){
                        $cari = $_GET['cari'];
                        $data = mysqli_query($koneksi, "SELECT * FROM mahasiswa WHERE nama_mahasiswa like '%".$cari."' OR npm like '%".$cari."%'");
                      }else{
                        $data = mysqli_query($koneksi, "SELECT * from mahasiswa");
                      }
                      while ($d = mysqli_fetch_array($data)) {
                      ?>
                      <tr>
                        <td><?php echo $d['npm'] ?></td>
                        <td><?php echo $d['nama_mahasiswa'] ?></td>
                        <td><?php echo $d['prodi'] ?></td>
                        <td><a href="form.php?id=<?php echo $d['id']; ?>"> Edit </a>|
                          <a href="hapus_data.php?id=<?php echo $d['id']; ?>"> Hapus </a>
                        </td>
                      </tr>
                      <?php } ?>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
            <!-- /block -->
          </div>

        </div>
      </div>
    </div>
  </div>
</body>

</html>