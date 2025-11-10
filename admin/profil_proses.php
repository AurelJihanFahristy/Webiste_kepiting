<?php
include 'koneksi.php';

// Cek sesi login
if (!isset($_SESSION['admin_username'])) {
    header("Location: login.php");
    exit();
}

// 1. Ambil data dari form
$nama_cv = mysqli_real_escape_string($koneksi, $_POST['nama_cv']);
$nama_ceo = mysqli_real_escape_string($koneksi, $_POST['nama_ceo']);
$deskripsi_singkat = mysqli_real_escape_string($koneksi, $_POST['deskripsi_singkat']);
$alamat = mysqli_real_escape_string($koneksi, $_POST['alamat']);
$whatsapp = mysqli_real_escape_string($koneksi, $_POST['whatsapp']);
$email = mysqli_real_escape_string($koneksi, $_POST['email']);
$jam_operasional = mysqli_real_escape_string($koneksi, $_POST['jam_operasional']);

$foto_ceo_lama = mysqli_real_escape_string($koneksi, $_POST['foto_ceo_lama']);
$foto_fasilitas_lama = mysqli_real_escape_string($koneksi, $_POST['foto_fasilitas_lama']);

$nama_foto_ceo = $foto_ceo_lama; // Default
$nama_foto_fasilitas = $foto_fasilitas_lama; // Default


// 2. Logika helper untuk upload gambar (DRY - Don't Repeat Yourself)
function uploadGambar($file_input, $gambar_lama) {
    global $_SESSION; // Ambil session dari scope global
    
    if (isset($file_input) && $file_input['error'] === UPLOAD_ERR_OK) {
        $folder_target = "uploads/";
        $nama_unik = time() . "_" . $_SESSION['admin_username'] . "_" . basename($file_input['name']);
        $file_target = $folder_target . $nama_unik;
        
        $tipe_file = strtolower(pathinfo($file_target, PATHINFO_EXTENSION));
        if ($tipe_file != "jpg" && $tipe_file != "png" && $tipe_file != "jpeg" && $tipe_file != "webp") {
            die("Error: Tipe file tidak diizinkan untuk " . $file_input['name']);
        }
        
        if (move_uploaded_file($file_input['tmp_name'], $file_target)) {
            // Hapus file lama jika upload baru berhasil
            $file_path_lama = "uploads/" . $gambar_lama;
            if (file_exists($file_path_lama) && $gambar_lama != $nama_unik) {
                unlink($file_path_lama);
            }
            return $nama_unik; // Kembalikan nama file baru
        } else {
            die("Error: Gagal upload file " . $file_input['name']);
        }
    }
    return $gambar_lama; // Kembalikan nama file lama jika tidak ada upload baru
}

// 3. Proses upload jika ada file baru
$nama_foto_ceo = uploadGambar($_FILES['foto_ceo'], $foto_ceo_lama);
$nama_foto_fasilitas = uploadGambar($_FILES['foto_fasilitas'], $foto_fasilitas_lama);

// 4. Update ke Database (ID selalu 1)
$query = "UPDATE profil_perusahaan SET 
            nama_cv = '$nama_cv',
            deskripsi_singkat = '$deskripsi_singkat',
            alamat = '$alamat',
            whatsapp = '$whatsapp',
            email = '$email',
            jam_operasional = '$jam_operasional',
            nama_ceo = '$nama_ceo',
            foto_ceo = '$nama_foto_ceo',
            foto_fasilitas = '$nama_foto_fasilitas'
          WHERE id = 1";

if (mysqli_query($koneksi, $query)) {
    header("Location: profil.php?status=sukses_update");
    exit();
} else {
    die("Error: Gagal mengupdate data profil. " . mysqli_error($koneksi));
}
?>