<?php 
include 'koneksi.php'; 
proteksi(); 
include 'header.php'; 

// --- LOGIKA PEMINJAMAN ---
if(isset($_POST['pinjam'])){
    $b = mysqli_real_escape_string($conn, $_POST['buku']); 
    $a = mysqli_real_escape_string($conn, $_POST['agt']);
    $tp = date('Y-m-d'); 
    $tk = date('Y-m-d', strtotime('+7 days'));

    $cek_stok = mysqli_query($conn, "SELECT stok FROM buku WHERE id_buku='$b'");
    $ds = mysqli_fetch_assoc($cek_stok);

    if($ds['stok'] > 0) {
        // Status 'Dipinjam' agar sinkron dengan query tabel di bawah
        mysqli_query($conn, "INSERT INTO transaksi (id_buku, id_anggota, tgl_pinjam, tgl_kembali_seharusnya, status) 
                            VALUES ('$b', '$a', '$tp', '$tk', 'Dipinjam')");
        mysqli_query($conn, "UPDATE buku SET stok = stok - 1 WHERE id_buku = '$b'");
        echo "<script>Swal.fire({icon:'success', title:'Confirmed', text:'Transaction archived successfully', showConfirmButton:false, timer:2000});</script>";
    }
}

// --- LOGIKA PENGEMBALIAN ---
if(isset($_GET['kembali'])){
    $id = mysqli_real_escape_string($conn, $_GET['kembali']); 
    $now = date('Y-m-d');
    $q = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM transaksi WHERE id_transaksi='$id'"));
    
    if($q) {
        $denda = 0;
        if(strtotime($now) > strtotime($q['tgl_kembali_seharusnya'])) {
            $selisih = (strtotime($now) - strtotime($q['tgl_kembali_seharusnya'])) / 86400;
            $denda = $selisih * 2000;
        }
        mysqli_query($conn, "UPDATE transaksi SET tgl_kembali_realitas='$now', denda='$denda', status='Kembali' WHERE id_transaksi='$id'");
        mysqli_query($conn, "UPDATE buku SET stok = stok + 1 WHERE id_buku = '{$q['id_buku']}'");
        
        $msg = ($denda > 0) ? "Overdue: Rp " . number_format($denda) : "Returned on schedule";
        echo "<script>Swal.fire({title:'Processed', text:'$msg', icon:'info'}).then(()=>window.location='transaksi.php');</script>";
    }
}
?>

<style>
    @import url('https://fonts.googleapis.com/css2?family=Playfair+Display:italic,wght@700&family=Plus+Jakarta+Sans:wght@400;600&display=swap');

    body { background: #fdfbfb; font-family: 'Plus Jakarta Sans', sans-serif; color: #444; }

    /* Elegant Page Header */
    .title-section { margin: 60px 0 50px 0; padding-left: 10px; }
    .title-section h1 { font-family: 'Playfair Display', serif; font-size: 3.5rem; color: #2d2d2d; margin-bottom: 0; }
    .title-section p { font-family: 'Playfair Display', serif; font-style: italic; color: #db8ea2; font-size: 1.1rem; }

    /* Card & Typography */
    .card-yara { background: white; border-radius: 25px; border: none; box-shadow: 0 10px 40px rgba(0,0,0,0.02); padding: 40px; }
    .serif-subtitle { font-family: 'Playfair Display', serif; font-size: 2.2rem; font-style: italic; margin-bottom: 30px; color: #333; }

    /* Inputs & Buttons */
    .meta-label { font-size: 0.65rem; font-weight: 800; color: #c0c0c0; text-transform: uppercase; letter-spacing: 2.5px; margin-bottom: 10px; display: block; }
    .input-minimal { background: #f8f9fa; border: 1px solid #f0f0f0; border-radius: 12px; padding: 15px; font-size: 0.85rem; margin-bottom: 25px; color: #666; }
    .btn-archive { background: #FFCBD1; color: #d63384; border: none; border-radius: 12px; padding: 16px; font-weight: 700; font-size: 0.85rem; transition: 0.3s; width: 100%; }
    .btn-archive:hover { background: #ffb3bc; transform: translateY(-2px); box-shadow: 0 8px 20px rgba(255, 179, 188, 0.3); }

    /* Table Architecture */
    .table-yara thead th { border: none; color: #db8ea2; font-size: 0.65rem; text-transform: uppercase; letter-spacing: 2px; padding-bottom: 25px; }
    .table-yara tbody tr { border-bottom: 1px solid #f9f9f9; }
    .table-yara td { padding: 22px 0; }
    
    .identity-main { font-weight: 600; color: #2d2d2d; font-size: 1rem; }
    .uid-sub { font-size: 0.7rem; color: #bbb; letter-spacing: 1px; }
    .badge-soft { background: #fff5f6; color: #db8ea2; border-radius: 50px; padding: 5px 15px; font-size: 0.75rem; font-weight: 600; }
    .badge-late { background: #fff0f0; color: #e57373; }
    
    .action-icon { color: #FFCBD1; font-size: 1.3rem; text-decoration: none; transition: 0.3s; opacity: 0.8; }
    .action-icon:hover { color: #db8ea2; opacity: 1; transform: scale(1.1); }
    .pill-count { background: #FFCBD1; color: #d63384; font-size: 0.65rem; padding: 4px 12px; border-radius: 20px; font-weight: 800; }
</style>

<div class="container pb-5">
    <div class="title-section">
        
        <h1>Circulation Directory</h1>
        <p>"Consistency is more important than perfection."</p>
    </div>

    <div class="row g-5">
        <div class="col-md-4">
            <div class="card-yara h-100">
                <h2 class="serif-subtitle">Quick Entry</h2>
                <form method="POST">
                    <label class="meta-label">Select Resource</label>
                    <select name="buku" class="form-select input-minimal" required>
                        <option value="" disabled selected>Catalogue search...</option>
                        <?php 
                        $bk = mysqli_query($conn,"SELECT * FROM buku WHERE stok > 0"); 
                        while($rbk = mysqli_fetch_assoc($bk)) echo "<option value='{$rbk['id_buku']}'>{$rbk['judul']}</option>"; 
                        ?>
                    </select>

                    <label class="meta-label">Member Identity</label>
                    <select name="agt" class="form-select input-minimal" required>
                        <option value="" disabled selected>Member directory...</option>
                        <?php 
                        $ag = mysqli_query($conn,"SELECT * FROM anggota"); 
                        while($rag = mysqli_fetch_assoc($ag)) echo "<option value='{$rag['id_anggota']}'>{$rag['nama']}</option>"; 
                        ?>
                    </select>

                    <button name="pinjam" class="btn btn-archive">Add to Archive</button>
                </form>
            </div>
        </div>

        <div class="col-md-8">
            <div class="card-yara">
                <div class="d-flex justify-content-between align-items-center mb-5">
                    <h2 class="serif-subtitle m-0">Active Records</h2>
                    <?php 
                    $total = mysqli_num_rows(mysqli_query($conn, "SELECT id_transaksi FROM transaksi WHERE status='Dipinjam'")); 
                    ?>
                    <span class="pill-count">TOTAL: <?= $total ?></span>
                </div>

                <div class="table-responsive">
                    <table class="table table-yara align-middle">
                        <thead>
                            <tr>
                                <th>Identity</th>
                                <th>Resource</th>
                                <th>Due Date</th>
                                <th class="text-end">Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                            $query = mysqli_query($conn, "SELECT t.*, a.nama, a.id_anggota, b.judul FROM transaksi t 
                                                         JOIN anggota a ON t.id_anggota = a.id_anggota 
                                                         JOIN buku b ON t.id_buku = b.id_buku 
                                                         WHERE t.status = 'Dipinjam' 
                                                         ORDER BY t.tgl_kembali_seharusnya ASC");
                            
                            if(mysqli_num_rows($query) == 0) {
                                echo "<tr><td colspan='4' class='text-center py-5 text-muted small italic'>No active records found.</td></tr>";
                            }

                            while($row = mysqli_fetch_assoc($query)){ 
                                $is_late = (strtotime(date('Y-m-d')) > strtotime($row['tgl_kembali_seharusnya']));
                            ?>
                            <tr>
                                <td>
                                    <div class="identity-main"><?= $row['nama'] ?></div>
                                    <div class="uid-sub">UID: ARCH-0<?= $row['id_anggota'] ?></div>
                                </td>
                                <td>
                                    <div class="text-dark small fw-bold"><?= $row['judul'] ?></div>
                                    <div class="uid-sub">LibrarYara</div>
                                </td>
                                <td>
                                    <span class="badge-soft <?= $is_late ? 'badge-late' : '' ?>">
                                        <?= date('M d, Y', strtotime($row['tgl_kembali_seharusnya'])) ?>
                                    </span>
                                </td>
                                <td class="text-end">
                                    <a href="?kembali=<?= $row['id_transaksi'] ?>" 
                                       class="action-icon" 
                                       onclick="return confirm('Update this record to returned status?')">
                                       ✦
                                    </a>
                                </td>
                            </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
