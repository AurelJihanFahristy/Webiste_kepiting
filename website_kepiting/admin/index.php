<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin - Kepiting Segar</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <style>
        :root {
            --maroon-primary: #8B0000;
            --maroon-dark: #5A0000;
            --maroon-light: #A52A2A;
            --gold-accent: #FFD700;
            --shell-white: #FFF5F5;
            --ocean-blue: #1E3A8A;
        }
        
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            background: linear-gradient(135deg, var(--shell-white) 0%, #f8f9fa 50%, #e9ecef 100%);
            min-height: 100vh;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            overflow-x: hidden;
            position: relative;
        }
        
        /* Background Pattern Kepiting */
        body::before {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-image: 
                radial-gradient(circle at 20% 80%, rgba(139, 0, 0, 0.03) 0%, transparent 50%),
                radial-gradient(circle at 80% 20%, rgba(255, 215, 0, 0.03) 0%, transparent 50%),
                radial-gradient(circle at 40% 40%, rgba(139, 0, 0, 0.02) 0%, transparent 50%);
            z-index: -1;
        }
        
        /* NAVBAR KEPITING */
        .navbar {
            background: linear-gradient(135deg, var(--maroon-primary) 0%, var(--maroon-dark) 100%) !important;
            box-shadow: 0 4px 20px rgba(139, 0, 0, 0.4);
            padding: 15px 0;
            min-height: 70px;
            border-bottom: 3px solid var(--gold-accent);
            position: relative;
        }
        
        .navbar::after {
            content: "";
            position: absolute;
            bottom: -3px;
            left: 0;
            right: 0;
            height: 3px;
            background: linear-gradient(90deg, transparent, var(--gold-accent), transparent);
        }
        
        .navbar-brand {
            font-weight: 800;
            font-size: 1.6rem !important;
            display: flex;
            align-items: center;
            gap: 12px;
            background: linear-gradient(45deg, #FFFFFF, var(--gold-accent));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            text-shadow: 2px 2px 4px rgba(0,0,0,0.2);
        }
        
        .navbar-brand i {
            color: var(--gold-accent);
            font-size: 1.8rem;
            filter: drop-shadow(2px 2px 4px rgba(0,0,0,0.3));
            animation: crabFloat 3s ease-in-out infinite;
        }
        
        @keyframes crabFloat {
            0%, 100% { transform: translateY(0px) rotate(0deg); }
            50% { transform: translateY(-3px) rotate(2deg); }
        }
        
        /* HEADER KEPITING */
        .dashboard-header {
            background: linear-gradient(135deg, var(--maroon-primary) 0%, var(--maroon-dark) 100%);
            color: white;
            padding: 40px 0;
            margin-bottom: 30px;
            border-radius: 0 0 30px 30px;
            box-shadow: 0 10px 30px rgba(139, 0, 0, 0.4);
            position: relative;
            overflow: hidden;
        }
        
        .dashboard-header::before {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: 
                radial-gradient(circle at 10% 20%, rgba(255, 215, 0, 0.1) 0%, transparent 50%),
                radial-gradient(circle at 90% 80%, rgba(255, 215, 0, 0.1) 0%, transparent 50%),
                url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100" preserveAspectRatio="none"><path d="M0,0 L100,0 L100,100 Z" fill="rgba(255,255,255,0.1)"/></svg>');
            background-size: cover;
        }
        
        .welcome-title {
            font-size: 2.5rem;
            font-weight: 800;
            margin-bottom: 10px;
            text-shadow: 2px 2px 4px rgba(0,0,0,0.4);
            background: linear-gradient(45deg, #FFFFFF, var(--gold-accent), #FFFFFF);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            background-size: 200% auto;
            animation: shine 3s ease-in-out infinite;
        }
        
        @keyframes shine {
            0%, 100% { background-position: 0% center; }
            50% { background-position: 200% center; }
        }
        
        .welcome-subtitle {
            font-size: 1.2rem;
            opacity: 0.9;
            font-weight: 300;
            text-shadow: 1px 1px 2px rgba(0,0,0,0.3);
        }
        
        /* STATISTIC CARDS */
        .stats-container {
            margin-bottom: 40px;
        }
        
        .stat-card {
            background: linear-gradient(135deg, rgba(255, 255, 255, 0.95), rgba(255, 255, 255, 0.85));
            backdrop-filter: blur(10px);
            border-radius: 15px;
            padding: 25px 20px;
            text-align: center;
            box-shadow: 
                0 8px 25px rgba(139, 0, 0, 0.15),
                0 4px 12px rgba(0, 0, 0, 0.1),
                inset 0 1px 0 rgba(255, 255, 255, 0.8);
            border: 2px solid transparent;
            background-clip: padding-box;
            position: relative;
            transition: all 0.4s ease;
            overflow: hidden;
            height: 100%;
        }
        
        .stat-card::before {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: linear-gradient(135deg, var(--maroon-primary), var(--maroon-dark));
            border-radius: 15px;
            padding: 2px;
            -webkit-mask: linear-gradient(#fff 0 0) content-box, linear-gradient(#fff 0 0);
            -webkit-mask-composite: xor;
            mask-composite: exclude;
            opacity: 0;
            transition: all 0.4s ease;
        }
        
        .stat-card:hover::before {
            opacity: 1;
        }
        
        .stat-card:hover {
            transform: translateY(-8px) scale(1.03);
            box-shadow: 
                0 15px 35px rgba(139, 0, 0, 0.25),
                0 10px 25px rgba(0, 0, 0, 0.15);
        }
        
        .stat-icon {
            font-size: 2.5rem;
            color: var(--maroon-primary);
            margin-bottom: 15px;
            transition: all 0.4s ease;
        }
        
        .stat-card:hover .stat-icon {
            color: var(--gold-accent);
            transform: scale(1.1) rotate(8deg);
        }
        
        .stat-number {
            font-size: 2.5rem;
            font-weight: 800;
            color: var(--maroon-dark);
            margin-bottom: 8px;
            transition: all 0.4s ease;
        }
        
        .stat-card:hover .stat-number {
            color: var(--maroon-primary);
            text-shadow: 1px 1px 3px rgba(0,0,0,0.1);
        }
        
        .stat-label {
            font-size: 1rem;
            color: #6c757d;
            font-weight: 600;
            transition: all 0.4s ease;
        }
        
        .stat-card:hover .stat-label {
            color: var(--maroon-dark);
        }
        
        /* CARD BESAR */
        .card-link {
            text-decoration: none;
            color: inherit;
            display: block;
        }
        
        .dashboard-card {
            border: none;
            border-radius: 20px;
            box-shadow: 
                0 12px 30px rgba(0, 0, 0, 0.1),
                0 4px 12px rgba(0, 0, 0, 0.07);
            transition: all 0.5s ease;
            background: linear-gradient(135deg, #ffffff, #f8f9fa);
            position: relative;
            overflow: hidden;
            min-height: 280px;
            display: flex;
            align-items: center;
            margin-bottom: 25px;
            border: 2px solid transparent;
            background-clip: padding-box;
        }
        
        .dashboard-card::before {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: linear-gradient(135deg, var(--maroon-primary), var(--maroon-dark), var(--gold-accent));
            border-radius: 20px;
            padding: 3px;
            -webkit-mask: linear-gradient(#fff 0 0) content-box, linear-gradient(#fff 0 0);
            -webkit-mask-composite: xor;
            mask-composite: exclude;
            opacity: 0;
            transition: all 0.5s ease;
        }
        
        .dashboard-card:hover::before {
            opacity: 1;
        }
        
        .dashboard-card::after {
            content: "";
            position: absolute;
            top: -100%;
            left: -100%;
            width: 300%;
            height: 300%;
            background: linear-gradient(45deg, transparent, rgba(255, 215, 0, 0.1), transparent);
            transform: rotate(45deg);
            transition: all 0.8s ease;
        }
        
        .dashboard-card:hover {
            transform: translateY(-15px) scale(1.02);
            box-shadow: 
                0 20px 40px rgba(139, 0, 0, 0.3),
                0 12px 30px rgba(0, 0, 0, 0.2);
        }
        
        .dashboard-card:hover::after {
            transform: rotate(45deg) translate(40px, 40px);
        }
        
        .card-icon {
            font-size: 4rem !important;
            color: var(--maroon-primary);
            margin-bottom: 25px;
            transition: all 0.5s ease;
            filter: drop-shadow(2px 2px 4px rgba(0,0,0,0.2));
        }
        
        .dashboard-card:hover .card-icon {
            transform: scale(1.2) rotate(12deg);
            color: var(--gold-accent);
            filter: drop-shadow(3px 3px 6px rgba(0,0,0,0.3));
        }
        
        .card-title {
            color: var(--maroon-dark);
            font-weight: 800;
            font-size: 1.7rem;
            margin-bottom: 15px;
            text-shadow: 1px 1px 2px rgba(0,0,0,0.1);
            transition: all 0.5s ease;
        }
        
        .dashboard-card:hover .card-title {
            color: var(--maroon-primary);
            text-shadow: 2px 2px 4px rgba(0,0,0,0.2);
        }
        
        .card-text {
            color: #6c757d;
            font-size: 1.1rem;
            line-height: 1.6;
            font-weight: 400;
            transition: all 0.5s ease;
        }
        
        .dashboard-card:hover .card-text {
            color: #495057;
        }
        
        .card-body {
            padding: 40px 30px !important;
            text-align: center;
            width: 100%;
            position: relative;
            z-index: 2;
        }
        
        /* CONTAINER BESAR - 100% LAYAR */
        .container-fluid {
            padding: 0;
            width: 100%;
            max-width: 100%;
        }
        
        .main-content {
            padding: 0 30px;
            width: 100%;
        }
        
        /* SEARCH BAR */
        .search-container {
            position: fixed;
            bottom: 25px;
            right: 25px;
            z-index: 1000;
        }
        
        .search-box {
            background: white;
            border-radius: 50px;
            padding: 12px 20px;
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.2);
            display: flex;
            align-items: center;
            gap: 12px;
            border: 2px solid var(--maroon-primary);
        }
        
        .search-box input {
            border: none;
            outline: none;
            font-size: 1rem;
            width: 200px;
            color: var(--maroon-dark);
        }
        
        .search-box input::placeholder {
            color: #6c757d;
        }
        
        .search-icon {
            color: var(--maroon-primary);
            font-size: 1.2rem;
        }
        
        /* RESPONSIVE */
        @media (max-width: 1200px) {
            .main-content {
                padding: 0 25px;
            }
        }
        
        @media (max-width: 992px) {
            .welcome-title {
                font-size: 2.2rem;
            }
            
            .welcome-subtitle {
                font-size: 1.1rem;
            }
            
            .card-body {
                padding: 35px 25px !important;
            }
            
            .stat-number {
                font-size: 2.2rem;
            }
        }
        
        @media (max-width: 768px) {
            .welcome-title {
                font-size: 2rem;
            }
            
            .welcome-subtitle {
                font-size: 1rem;
            }
            
            .dashboard-card {
                min-height: 250px;
            }
            
            .card-icon {
                font-size: 3.5rem !important;
            }
            
            .card-title {
                font-size: 1.5rem;
            }
            
            .stat-number {
                font-size: 2rem;
            }
            
            .main-content {
                padding: 0 20px;
            }
            
            .search-box {
                padding: 10px 15px;
            }
            
            .search-box input {
                width: 180px;
                font-size: 0.95rem;
            }
        }
        
        @media (max-width: 576px) {
            .main-content {
                padding: 0 15px;
            }
            
            .welcome-title {
                font-size: 1.8rem;
            }
            
            .welcome-subtitle {
                font-size: 0.95rem;
            }
            
            .card-body {
                padding: 30px 20px !important;
            }
            
            .search-container {
                bottom: 20px;
                right: 20px;
            }
            
            .search-box {
                padding: 8px 12px;
            }
            
            .search-box input {
                width: 150px;
                font-size: 0.9rem;
            }
        }
    </style>
</head>
<body>

    <!-- NAVBAR KEPITING -->
    <nav class="navbar navbar-expand-lg navbar-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="index.php">
                <i class="fa-solid fa-crab"></i> 
                <span>KEPITING SEGAR ADMIN</span>
            </a>
            <div class="navbar-nav ms-auto">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="fa-solid fa-user-circle me-2"></i> 
                        <strong>Admin</strong>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                        <li><a class="dropdown-item" href="logout.php">
                            <i class="fa-solid fa-power-off me-2"></i> KELUAR
                        </a></li>
                    </ul>
                </li>
            </div>
        </div>
    </nav>

    <!-- HEADER KEPITING -->
    <div class="dashboard-header">
        <div class="container-fluid text-center position-relative">
            <h1 class="welcome-title">SELAMAT DATANG</h1>
            <p class="welcome-subtitle">Kelola Bisnis Kepiting Segar dengan Mudah dan Efisien</p>
        </div>
    </div>

    <!-- CONTENT BESAR -->
    <div class="container-fluid main-content">
        
        <!-- STATISTIK KEPITING -->
        <div class="stats-container">
            <div class="row g-4">
                <div class="col-xl-3 col-md-6">
                    <div class="stat-card">
                        <i class="fa-solid fa-boxes-stacked stat-icon"></i>
                        <div class="stat-number">15</div>
                        <div class="stat-label">TOTAL PRODUK</div>
                    </div>
                </div>
                <div class="col-xl-3 col-md-6">
                    <div class="stat-card">
                        <i class="fa-solid fa-star stat-icon"></i>
                        <div class="stat-number">3</div>
                        <div class="stat-label">PRODUK UNGGULAN</div>
                    </div>
                </div>
                <div class="col-xl-3 col-md-6">
                    <div class="stat-card">
                        <i class="fa-solid fa-tags stat-icon"></i>
                        <div class="stat-number">3</div>
                        <div class="stat-label">KATEGORI PRODUK</div>
                    </div>
                </div>
                <div class="col-xl-3 col-md-6">
                    <div class="stat-card">
                        <i class="fa-solid fa-shield-heart stat-icon"></i>
                        <div class="stat-number">100%</div>
                        <div class="stat-label">SISTEM AKTIF</div>
                    </div>
                </div>
            </div>
        </div>

        <!-- MENU UTAMA KEPITING -->
        <div class="row g-4">
            
            <!-- CARD PRODUK BESAR -->
            <div class="col-xl-4 col-lg-6 col-md-6">
                <a href="produk.php" class="card-link">
                    <div class="dashboard-card">
                        <div class="card-body">
                            <i class="fa-solid fa-boxes-stacked card-icon"></i>
                            <h3 class="card-title">MANAJEMEN PRODUK</h3>
                            <p class="card-text">Kelola semua produk kepiting, tambah varian baru, edit informasi, atau hapus produk yang tidak tersedia</p>
                        </div>
                    </div>
                </a>
            </div>

            <!-- CARD PROFIL BESAR -->
            <div class="col-xl-4 col-lg-6 col-md-6">
                <a href="profil.php" class="card-link">
                    <div class="dashboard-card">
                        <div class="card-body">
                            <i class="fa-solid fa-building card-icon"></i>
                            <h3 class="card-title">MANAJEMEN PROFIL</h3>
                            <p class="card-text">Update informasi perusahaan, alamat, kontak, dan profil bisnis Kepiting Segar</p>
                        </div>
                    </div>
                </a>
            </div>

            <!-- CARD STATISTIK BESAR -->
            <div class="col-xl-4 col-lg-6 col-md-6">
                <a href="statistik.php" class="card-link">
                    <div class="dashboard-card">
                        <div class="card-body">
                            <i class="fa-solid fa-chart-line card-icon"></i>
                            <h3 class="card-title">MANAJEMEN STATISTIK</h3>
                            <p class="card-text">Kelola data statistik dan angka pencapaian yang ditampilkan di halaman beranda</p>
                        </div>
                    </div>
                </a>
            </div>

        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>