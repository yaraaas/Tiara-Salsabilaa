<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LibrarYara 🎀</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700&family=Quicksand:wght@400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <style>
        :root { --p-pink: #FFB6C1; --p-dark: #8E5D67; --glass: rgba(255, 255, 255, 0.85); }
        body { background: #FFF5F8 url('https://www.transparenttextures.com/patterns/floral-paper.png'); font-family: 'Quicksand', sans-serif; color: var(--p-dark); min-height: 100vh; }
        .navbar { background: var(--glass) !important; backdrop-filter: blur(15px); border-bottom: 2px solid rgba(255,182,193,0.3); }
        .card-yara { background: var(--glass); backdrop-filter: blur(15px); border-radius: 25px; border: 1px solid white; box-shadow: 0 10px 30px rgba(255,182,193,0.15); }
        .btn-premium { background: linear-gradient(135deg, #FFB6C1, #FF8C94); color: white; border: none; border-radius: 50px; font-weight: bold; padding: 10px 25px; transition: 0.3s; }
        .btn-premium:hover { transform: translateY(-3px); box-shadow: 0 5px 15px rgba(255,140,148,0.3); color: white; }
        .form-control { border-radius: 15px; border: 1px solid #FFE4E1; padding: 12px; }
    </style>
</head>
<body>
<?php if(isset($_SESSION['admin_id'])): ?>
<nav class="navbar navbar-expand-lg sticky-top mb-4 shadow-sm">
    <div class="container">
        <a class="navbar-brand fw-bold fs-3" href="dashboard.php">🎀 LibrarYara</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto align-items-center">
                <li class="nav-item"><a class="nav-link px-3 fw-bold" href="dashboard.php">Home</a></li>
                <li class="nav-item"><a class="nav-link px-3 fw-bold" href="buku.php">Katalog</a></li>
                <li class="nav-item"><a class="nav-link px-3 fw-bold" href="anggota.php">Anggota</a></li>
                <li class="nav-item"><a class="nav-link px-3 fw-bold" href="transaksi.php">Transaksi</a></li>
                <li class="nav-item"><a class="nav-link px-3 fw-bold" href="laporan.php">Laporan</a></li>
                <li class="nav-item ms-lg-3"><a class="btn btn-premium btn-sm px-4" href="logout.php">Logout</a></li>
            </ul>
        </div>
    </div>
</nav>
<?php endif; ?>
