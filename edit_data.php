<?php
    include "koneksi.php";

    $id = isset($_GET['id']) ? $_GET['id'] : '';
    $apakah_proses = isset($_GET['proses']) ? $_GET['proses'] : '';
    
    $proses_ambil = mysqli_query($koneksi,"SELECT * FROM mahasiswa WHERE id = '".$id."'") 
                    or die (mysqli_error($koneksi));
                    
                    if($apakah_proses == 1){
                        $nama_mhs = $_POST['nama'];
                        $npm_mhs = $_POST['npm'];
                        $prodi_mhs = $_POST['prodi'];
                        
                        $proses_update_data = mysqli_query($koneksi,"UPDATE mahasiswa SET nama_mahasiswa
                                                                   ='$nama_mhs', npm = '$npm_mhs' , prodi = '$prodi_mhs' WHERE id = '".$id."'") 
                                                or die (mysqli_error($koneksi));

                            if($proses_update_data){
                                echo "
                                        <script>
                                            alert('Data Berhasil Diupdate');
                                            window.location.href='form.php';
                                            </script>";
                            } else echo "<script>
                                            alert('Data Gagal Diupdate');
                                            window.location.href='form.php';
                                        </script>";
    }                

?>