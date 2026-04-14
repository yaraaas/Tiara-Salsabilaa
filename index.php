<?php 
include 'koneksi.php'; 
include 'header.php';

if (isset($_POST['login'])) {
    $u = mysqli_real_escape_string($conn, $_POST['user']); 
    $p = md5($_POST['pass']);
    $res = mysqli_query($conn, "SELECT * FROM admin WHERE username='$u' AND password='$p'");
    if (mysqli_num_rows($res) > 0) {
        $d = mysqli_fetch_assoc($res);
        $_SESSION['admin_id'] = $d['id_admin'];
        header("Location: dashboard.php");
    } else { 
        echo "<script>Swal.fire({
            icon: 'error',
            title: 'Ups! Ada Masalah',
            text: 'Username atau Password sepertinya kurang tepat.',
            confirmButtonColor: '#FFB7C5',
            background: '#FFF5F7'
        });</script>"; 
    }
}
?>

<link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;600&family=Playfair+Display:ital,wght@0,600;1,600&display=swap" rel="stylesheet">

<style>
    :root {
        --lovely-pink: #FFB7C5; /* Cherry Blossom Pink */
        --soft-cream: #FFF9F3;  /* Warm Cream */
        --pure-white: #FFFFFF;
        --love-text: #8E5B61;   /* Rose Brown (agar tulisan tidak kaku) */
    }

    body {
        margin: 0;
        padding: 0;
        height: 100vh;
        /* Background gradien Pink ke Cream yang sangat lembut */
        background: linear-gradient(135deg, #FFF0F3 0%, #FFF9F3 100%);
        font-family: 'Montserrat', sans-serif;
        display: flex;
        align-items: center;
        justify-content: center;
        overflow: hidden;
        color: var(--love-text);
    }

    /* Dekorasi Lingkaran Cantik */
    .heart-glow {
        position: absolute;
        width: 400px;
        height: 400px;
        background: radial-gradient(circle, rgba(255,183,197,0.3) 0%, transparent 70%);
        border-radius: 50%;
        z-index: 1;
        animation: pulse 4s infinite alternate ease-in-out;
    }

    @keyframes pulse {
        from { transform: scale(1); opacity: 0.4; }
        to { transform: scale(1.1); opacity: 0.7; }
    }

    .login-wrapper {
        width: 100%;
        max-width: 380px;
        padding: 20px;
        z-index: 10;
        animation: fadeIn 1.2s ease;
    }

    .card-lovely {
        background: rgba(255, 255, 255, 0.85);
        backdrop-filter: blur(10px);
        -webkit-backdrop-filter: blur(10px);
        border-radius: 40px; /* Sudut sangat bulat, sangat ramah/lovely */
        padding: 50px 40px;
        box-shadow: 0 20px 50px rgba(255, 183, 197, 0.2);
        border: 2px solid #FFFFFF;
        text-align: center;
    }

    .brand-section {
        margin-bottom: 35px;
    }

    .brand-name {
        font-family: 'Playfair Display', serif;
        font-size: 2.5rem;
        color: var(--love-text);
        margin: 0;
        font-style: italic;
    }

    .brand-tagline {
        font-size: 0.8rem;
        color: #B28B90;
        margin-top: 5px;
        display: block;
        letter-spacing: 1px;
    }

    .form-group {
        margin-bottom: 20px;
        text-align: left;
    }

    .form-label {
        font-size: 0.75rem;
        font-weight: 600;
        color: var(--lovely-pink);
        margin-left: 15px;
        margin-bottom: 8px;
        display: block;
    }

    .form-control {
        width: 100%;
        background: var(--pure-white);
        border: 1.5px solid #F3E0E4;
        border-radius: 25px; /* Lonjong cantik */
        padding: 12px 20px;
        font-size: 0.9rem;
        color: var(--love-text);
        transition: all 0.3s ease;
        box-sizing: border-box;
    }

    .form-control:focus {
        outline: none;
        border-color: var(--lovely-pink);
        box-shadow: 0 5px 15px rgba(255, 183, 197, 0.2);
    }

    .btn-lovely {
        width: 100%;
        background: var(--lovely-pink);
        color: white;
        border: none;
        padding: 15px;
        border-radius: 25px;
        font-size: 0.95rem;
        font-weight: 600;
        margin-top: 15px;
        cursor: pointer;
        transition: all 0.3s ease;
        box-shadow: 0 8px 20px rgba(255, 183, 197, 0.4);
    }

    .btn-lovely:hover {
        background: #FFA3B5;
        transform: translateY(-2px);
        box-shadow: 0 12px 25px rgba(255, 183, 197, 0.5);
    }

    .footer-note {
        margin-top: 30px;
        font-size: 0.75rem;
        color: #CBB0B4;
    }

    .heart-icon {
        color: var(--lovely-pink);
        margin-bottom: 15px;
        font-size: 1.5rem;
    }

    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(10px); }
        to { opacity: 1; transform: translateY(0); }
    }
</style>

<div class="heart-glow" style="top: -100px; right: -50px;"></div>
<div class="heart-glow" style="bottom: -100px; left: -50px;"></div>

<div class="login-wrapper">
    <div class="card-lovely">
        <div class="brand-section">
            <div class="heart-icon"><i class="fas fa-heart"></i></div>
            <h1 class="brand-name">LibrarYara</h1>
            <span class="brand-tagline">Where knowledge meets heart.</span>
        </div>

        <form method="POST">
            <div class="form-group">
                <label class="form-label">Username</label>
                <input type="text" name="user" class="form-control" placeholder="Halo, siapa namamu?" required autofocus autocomplete="off">
            </div>

            <div class="form-group">
                <label class="form-label">Password</label>
                <input type="password" name="pass" class="form-control" placeholder="Masukkan kunci rahasiamu" required>
            </div>

            <button name="login" class="btn-lovely">
                Welcome Home <i class="fas fa-door-open ms-2"></i>
            </button>
        </form>

        <div class="footer-note">
            made with <i class="fas fa-heart" style="font-size: 10px;"></i>  for yara's digital
            <br>
            <small style="opacity: 0.7;">꧁ 𓆩༺✧༻𓆪 ꧂</small>
        </div>
    </div>
</div>
