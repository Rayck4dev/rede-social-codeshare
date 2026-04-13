<!DOCTYPE html>
<html lang="pt-br" data-bs-theme="dark">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CodeShare | Tech Network</title>
    <link
        href="https://fonts.googleapis.com/css2?family=Fira+Code:wght@400;600&family=Inter:wght@300;400;600;800&display=swap"
        rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">

    <style>
        :root {
            --nav-bg: #161b22;
            --body-bg: #0d1117;
            --card-bg: #161b22;
            --border-color: #30363d;
            --text-color: #c9d1d9;
            --accent-color: #58a6ff;
            --transition-speed: 0.5s;
        }

        [data-bs-theme="light"] {
            --nav-bg: rgba(255, 255, 255, 0.8);
            --body-bg: #f0f2f5;
            --card-bg: #ffffff;
            --border-color: #dee2e6;
            --text-color: #1c1e21;
            --accent-color: #0969da;
        }

        body {
            background-color: var(--body-bg);
            color: var(--text-color);
            font-family: 'Inter', sans-serif;
            transition: background-color var(--transition-speed) ease, color var(--transition-speed) ease;
        }

        .navbar {
            background-color: var(--nav-bg) !important;
            backdrop-filter: blur(12px) saturate(180%);
            border-bottom: 1px solid var(--border-color);
            transition: all var(--transition-speed) ease;
        }

        .card {
            background-color: var(--card-bg);
            border: 1px solid var(--border-color);
            border-radius: 16px;
            transition: transform 0.3s cubic-bezier(0.175, 0.885, 0.32, 1.275),
                box-shadow 0.3s ease,
                border-color 0.3s ease;
            overflow: hidden;
        }

        .card:hover {
            transform: translateY(-5px);
            border-color: var(--accent-color);
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
        }

        #theme-toggle {
            width: 45px;
            height: 45px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 12px;
            cursor: pointer;
            background: rgba(88, 166, 255, 0.1);
            transition: all 0.3s ease;
            position: relative;
        }

        #theme-toggle:hover {
            background: rgba(88, 166, 255, 0.2);
            transform: rotate(15deg);
        }

        #theme-icon {
            font-size: 1.3rem;
            transition: transform 0.5s cubic-bezier(0.68, -0.55, 0.265, 1.55);
        }

        .rotate-icon {
            transform: rotate(360deg) scale(1.2);
        }

        .sidebar-link {
            display: flex;
            align-items: center;
            padding: 12px 15px;
            color: var(--text-color);
            text-decoration: none;
            border-radius: 12px;
            margin-bottom: 5px;
            transition: 0.2s all ease;
            font-weight: 500;
        }

        .sidebar-link i {
            font-size: 1.2rem;
            margin-right: 15px;
            transition: 0.3s;
        }

        .sidebar-link:hover {
            background-color: var(--accent-color);
            color: white !important;
        }

        .sidebar-link:hover i {
            transform: scale(1.2);
            color: white !important;
        }

        /* Badge de Status Online */
        .status-dot {
            width: 10px;
            height: 10px;
            background-color: #238636;
            border-radius: 50%;
            display: inline-block;
            margin-right: 5px;
            box-shadow: 0 0 8px #238636;
        }
    </style>
</head>

<body>

    <nav class="navbar navbar-expand-lg sticky-top mb-4">
        <div class="container">
            <a class="navbar-brand fw-extrabold fs-3 d-flex align-items-center" href="<?= base_url('feed') ?>">
                <span style="color: var(--accent-color); font-family: 'Fira Code', monospace;">&lt;</span>
                <span class="mx-1">CodeShare</span>
                <span style="color: var(--accent-color); font-family: 'Fira Code', monospace;">/&gt;</span>
            </a>

            <div class="d-flex align-items-center ms-auto">
                <div id="theme-toggle" class="me-3 shadow-sm border border-secondary border-opacity-25">
                    <i class="bi bi-moon-stars-fill text-primary" id="theme-icon"></i>
                </div>

                <?php if (session()->get('logado')): ?>
                    <div class="dropdown">
                        <div class="d-flex align-items-center cursor-pointer p-1 rounded-pill pe-3 hover-bg"
                            data-bs-toggle="dropdown" style="cursor: pointer; background: rgba(136,136,136,0.1)">
                            <div class="user-img me-2 bg-gradient shadow-sm d-flex align-items-center justify-content-center text-white fw-bold rounded-circle"
                                style="width: 38px; height: 38px; background: linear-gradient(45deg, #0969da, #58a6ff);">
                                <?= strtoupper(substr(session()->get('usuario_nome'), 0, 1)) ?>
                            </div>
                            <div class="d-none d-md-block">
                                <p class="mb-0 lh-1 small text-muted">Dev</p>
                                <span class="fw-bold small"><?= session()->get('usuario_nome') ?></span>
                            </div>
                        </div>
                        <ul class="dropdown-menu dropdown-menu-end border-0 shadow-lg mt-2 py-2">
                            <li><a class="dropdown-item py-2" href="#"><i class="bi bi-cpu me-2"></i> Dashboard</a></li>
                            <li><a class="dropdown-item py-2" href="#"><i class="bi bi-gear me-2"></i> Settings</a></li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li><a class="dropdown-item py-2 text-danger" href="<?= base_url('logout') ?>"><i
                                        class="bi bi-terminal me-2"></i> exit(0)</a></li>
                        </ul>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </nav>

    <div class="container pb-5">
        <div class="row g-4">
            <div class="col-md-3 d-none d-md-block">
                <div class="card border-0 bg-transparent">
                    <div class="card-body p-0">
                        <a href="<?= base_url('feed') ?>" class="sidebar-link active">
                            <i class="bi bi-grid-1x2-fill"></i> <span>Explore Feed</span>
                        </a>
                        <a href="#" class="sidebar-link">
                            <i class="bi bi-braces-asterisk"></i> <span>Algorithms</span>
                        </a>
                        <a href="#" class="sidebar-link">
                            <i class="bi bi-incognito"></i> <span>Open Source</span>
                        </a>
                        <a href="#" class="sidebar-link">
                            <i class="bi bi-cup-hot"></i> <span>Coffee Break</span>
                        </a>
                        <hr class="my-3 opacity-10">
                        <div class="px-3">
                            <p class="small text-muted fw-bold text-uppercase mb-2">My Stack</p>
                            <span
                                class="badge bg-secondary bg-opacity-10 text-secondary border border-secondary border-opacity-25 me-1">#PHP</span>
                            <span
                                class="badge bg-secondary bg-opacity-10 text-secondary border border-secondary border-opacity-25 me-1">#CI4</span>
                            <span
                                class="badge bg-secondary bg-opacity-10 text-secondary border border-secondary border-opacity-25 me-1">#JS</span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <?= $this->renderSection('content') ?>
            </div>

            <div class="col-md-3 d-none d-lg-block">
                <div class="card border-0 bg-transparent">
                    <div class="card-body p-0">
                        <div class="card p-4 mb-4 border-0 shadow-sm"
                            style="background: linear-gradient(135deg, rgba(88, 166, 255, 0.1), rgba(0, 0, 0, 0)); border: 1px solid var(--border-color) !important;">
                            <h6 class="fw-extrabold mb-3">Dev Status</h6>
                            <div class="d-flex align-items-center mb-2">
                                <span class="status-dot"></span>
                                <span class="small">1,240 devs codando agora</span>
                            </div>
                        </div>

                        <div class="card p-4 border-0 shadow-sm">
                            <h6 class="fw-bold mb-3"><i class="bi bi-fire text-warning me-2"></i>Hot Repo</h6>
                            <div class="small">
                                <a href="#" class="text-decoration-none text-accent">codeigniter4/framework</a>
                                <p class="text-muted mt-1 mb-0">The star of PHP backend development.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        const themeToggle = document.getElementById('theme-toggle');
        const themeIcon = document.getElementById('theme-icon');
        const html = document.documentElement;

        const savedTheme = localStorage.getItem('theme') || 'dark';
        html.setAttribute('data-bs-theme', savedTheme);
        updateUI(savedTheme);

        themeToggle.addEventListener('click', () => {
            const currentTheme = html.getAttribute('data-bs-theme');
            const newTheme = currentTheme === 'dark' ? 'light' : 'dark';

            themeIcon.classList.add('rotate-icon');

            setTimeout(() => {
                html.setAttribute('data-bs-theme', newTheme);
                localStorage.setItem('theme', newTheme);
                updateUI(newTheme);
            }, 250);

            setTimeout(() => {
                themeIcon.classList.remove('rotate-icon');
            }, 700);
        });

        function updateUI(theme) {
            if (theme === 'dark') {
                themeIcon.classList.replace('bi-sun-fill', 'bi-moon-stars-fill');
                themeIcon.classList.replace('text-warning', 'text-primary');
            } else {
                themeIcon.classList.replace('bi-moon-stars-fill', 'bi-sun-fill');
                themeIcon.classList.replace('text-primary', 'text-warning');
            }
        }
    </script>
</body>

</html>