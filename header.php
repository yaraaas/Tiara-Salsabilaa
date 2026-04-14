<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LibrarYara</title>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&family=Playfair+Display:ital,wght@0,600;1,600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <style>
        :root { 
            --p-pink: #FF85A2; 
            --p-dark: #2D2424; 
            --p-soft: #FDF2F4;
            --glass: rgba(255, 255, 255, 0.92); 
            --header-height: 85px; /* Kunci stabilitas ukuran */
        }

        body { 
            background: #FFF9F6; 
            font-family: 'Plus Jakarta Sans', sans-serif; 
            color: var(--p-dark); 
            min-height: 100vh;
            letter-spacing: -0.01em;
            padding-top: var(--header-height); /* Mencegah konten melompat ke bawah navbar */
        }

        /* Modern Navigation - Locked Height */
        .navbar { 
            height: var(--header-height);
            background: var(--glass) !important; 
            backdrop-filter: blur(20px); 
            border-bottom: 1px solid rgba(255,133,162,0.1);
            padding: 0 !important; /* Biar height dikontrol variabel */
            position: fixed;
            top: 0;
            width: 100%;
            z-index: 1000;
        }

        .navbar-container {
            height: 100%;
            display: flex;
            align-items: center;
        }

        .navbar-brand {
            font-family: 'Playfair Display', serif;
            font-weight: 600;
            font-style: italic;
            color: var(--p-dark) !important;
            font-size: 1.5rem;
            margin: 0;
        }

        .navbar-brand span {
            color: var(--p-pink);
            font-style: normal;
        }

        .nav-link {
            color: var(--p-dark) !important;
            font-size: 0.8rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 1.2px;
            padding: 0 18px !important;
            transition: 0.3s;
            opacity: 0.6;
        }

        .nav-link:hover, .nav-link.active {
            opacity: 1;
            color: var(--p-pink) !important;
        }

        /* Sign Out Button */
        .btn-premium { 
            background: var(--p-pink); 
            color: white !important; 
            border: none; 
            border-radius: 12px; 
            font-weight: 800; 
            font-size: 0.7rem;
            text-transform: uppercase;
            letter-spacing: 1px;
            padding: 10px 22px; 
            transition: all 0.3s ease; 
            box-shadow: 0 4px 12px rgba(255,133,162,0.15);
        }

        .btn-premium:hover { 
            background: #FF6B8E;
            transform: translateY(-2px); 
            box-shadow: 0 6px 20px rgba(255,133,162,0.25); 
        }
    </style>
</head>
<body>

<?php if(isset($_SESSION['admin_id'])): 
    $current_page = basename($_SERVER['PHP_SELF']); 
?>
<nav class="navbar navbar-expand-lg">
    <div class="container navbar-container">
        <a class="navbar-brand" href="dashboard.php">
            Librar<span>Yara</span>
        </a>
        
        <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto align-items-center">
                <li class="nav-item">
                    <a class="nav-link <?= $current_page == 'dashboard.php' ? 'active' : '' ?>" href="dashboard.php">Dashboard</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?= $current_page == 'buku.php' ? 'active' : '' ?>" href="buku.php">Catalog</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?= $current_page == 'anggota.php' ? 'active' : '' ?>" href="anggota.php">Members</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?= $current_page == 'transaksi.php' ? 'active' : '' ?>" href="transaksi.php">Transactions</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?= $current_page == 'laporan.php' ? 'active' : '' ?>" href="laporan.php">Reports</a>
                </li>
                <li class="nav-item ms-lg-3">
                    <a class="btn btn-premium" href="logout.php">Sign Out</a>
                </li>
            </ul>
        </div>
    </div>
</nav>
<?php endif; ?>
