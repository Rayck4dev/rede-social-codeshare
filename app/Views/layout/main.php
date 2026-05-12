<!DOCTYPE html>
<html lang="pt-br" data-bs-theme="dark">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CodeShare | Tech Network</title>

    <link rel="icon" type="image/png" href="<?= base_url('logo.png') ?>">

    <link
        href="https://fonts.googleapis.com/css2?family=Fira+Code:wght@400;600&family=Inter:wght@300;400;600;800&display=swap"
        rel="stylesheet">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">

    <link href="https://cdnjs.cloudflare.com/ajax/libs/prism/1.29.0/themes/prism-tomorrow.min.css" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/prism/1.29.0/plugins/line-numbers/prism-line-numbers.min.css"
        rel="stylesheet" />

    <style>
        :root {
            --nav-bg: #161b22;
            --body-bg: #0d1117;
            --card-bg: #161b22;
            --border-color: #30363d;
            --text-color: #c9d1d9;
            --accent-color: #58a6ff;
            --transition-speed: 0.3s;
        }

        [data-bs-theme="light"] {
            --nav-bg: rgba(255, 255, 255, 0.9);
            --body-bg: #f6f8fa;
            --card-bg: #ffffff;
            --border-color: #d0d7de;
            --text-color: #1f2328;
            --accent-color: #0969da;
        }

        body {
            background-color: var(--body-bg);
            color: var(--text-color);
            font-family: 'Inter', sans-serif;
            transition: background-color var(--transition-speed), color var(--transition-speed);
        }

        .brand-text {
            color: var(--accent-color) !important;
            font-family: 'Fira Code', monospace;
            font-weight: 700;
            border-right: 3px solid var(--accent-color);
            white-space: nowrap;
            overflow: hidden;
            display: inline-block;
            width: 13ch;
            animation: typing 2s steps(15, end), blink .75s step-end infinite;
        }

        @keyframes typing {
            from {
                width: 0
            }

            to {
                width: 13ch
            }
        }

        @keyframes blink {

            from,
            to {
                border-color: transparent
            }

            50% {
                border-color: var(--accent-color)
            }
        }

        .navbar {
            background-color: var(--nav-bg) !important;
            backdrop-filter: blur(12px);
            border-bottom: 1px solid var(--border-color);
        }

        .search-box {
            background: rgba(0, 0, 0, 0.2);
            border: 1px solid var(--border-color);
            border-radius: 8px;
            padding: 5px 15px;
        }

        .search-box input {
            background: transparent;
            border: none;
            color: white;
            outline: none;
            font-size: 0.9rem;
        }

        .card {
            background: var(--card-bg) !important;
            border: 1px solid var(--border-color) !important;
            border-radius: 12px;
        }

        .sidebar-link {
            display: flex;
            align-items: center;
            padding: 10px 15px;
            color: var(--text-color);
            text-decoration: none;
            border-radius: 8px;
            margin-bottom: 4px;
            font-weight: 500;
            transition: 0.2s;
        }

        .sidebar-link:hover,
        .sidebar-link.active {
            background: rgba(88, 166, 255, 0.1);
            color: var(--accent-color);
        }

        .btn-tech {
            background: var(--accent-color);
            color: white;
            border-radius: 8px;
            font-weight: 600;
            border: none;
        }

        .col-main-content {
            text-align: left !important;
        }

        .trending-item {
            padding: 10px 0;
            border-bottom: 1px solid var(--border-color);
        }
    </style>
</head>

<body>
    <nav class="navbar navbar-expand-lg sticky-top mb-4">
        <div class="container">
            <a class="navbar-brand me-4" href="<?= base_url('feed') ?>">
                <span class="brand-text">> CodeShare/_</span>
            </a>

            <div class="d-none d-lg-flex search-box me-auto">
                <i class="bi bi-search text-muted me-2"></i>
                <input type="text" placeholder="Search snippets...">
            </div>

            <div class="d-flex align-items-center ms-auto">
                <div id="theme-toggle" class="me-3 p-2 border border-secondary border-opacity-25 rounded-3"
                    style="cursor: pointer;">
                    <i class="bi bi-moon-stars-fill text-primary" id="theme-icon"></i>
                </div>

                <?php if (session()->get('logado')): ?>
                    <div class="dropdown">
                        <div class="d-flex align-items-center p-1 rounded-pill pe-3" data-bs-toggle="dropdown"
                            style="cursor: pointer; background: rgba(136,136,136,0.1)">
                            <div class="user-img me-2 d-flex align-items-center justify-content-center text-white fw-bold rounded-circle"
                                style="width: 34px; height: 34px; background: linear-gradient(45deg, #0969da, #58a6ff);">
                                <?= strtoupper(substr(session()->get('usuario_nome'), 0, 1)) ?>
                            </div>
                            <span class="fw-bold small d-none d-md-block"><?= session()->get('usuario_nome') ?></span>
                        </div>
                        <ul class="dropdown-menu dropdown-menu-end border-0 shadow-lg mt-2 bg-dark">
                            <li><a class="dropdown-item text-white"
                                    href="<?= base_url('perfil/' . session()->get('usuario_id')) ?>"><i
                                        class="bi bi-cpu me-2"></i> Dashboard</a></li>
                            <li>
                                <hr class="dropdown-divider border-secondary opacity-25">
                            </li>
                            <li><a class="dropdown-item text-danger" href="<?= base_url('login/logout') ?>"><i
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
                <div class="position-sticky" style="top: 85px;">
                    <a href="<?= base_url('feed') ?>"
                        class="sidebar-link <?= (str_contains(current_url(), 'feed')) ? 'active' : '' ?>">
                        <i class="bi bi-house-door me-3"></i> Explore Feed
                    </a>
                    <a href="<?= base_url('perfil/' . session()->get('usuario_id')) ?>"
                        class="sidebar-link <?= (str_contains(current_url(), 'perfil')) ? 'active' : '' ?>">
                        <i class="bi bi-person-badge me-3"></i> My Profile
                    </a>
                    <div class="d-grid gap-2 mt-4">
                        <a href="<?= base_url('postagens/create') ?>" class="btn btn-tech py-2">
                            <i class="bi bi-plus-lg me-2"></i> NEW_POST.SH
                        </a>
                    </div>
                </div>
            </div>

            <?php
            $urlAtual = current_url();
            $isCreatePage = (strpos($urlAtual, 'postagens/create') !== false);
            ?>

            <div class="col-md-9 <?= $isCreatePage ? 'col-lg-9' : 'col-lg-6' ?> col-main-content">
                <?= $this->renderSection('content') ?>
            </div>

            <?php if (!$isCreatePage): ?>
                <div class="col-md-3 d-none d-lg-block">
                    <div class="position-sticky" style="top: 85px;">
                        <div class="card p-4 mb-4 border-0">
                            <h6 class="fw-bold mb-3 text-uppercase small font-monospace"
                                style="color: var(--accent-color);"># Trending_Now</h6>
                            <div class="trending-item">
                                <p class="mb-0 fw-bold small">#PHP8.3</p>
                                <small class="text-muted">1.2k deployed</small>
                            </div>
                            <div class="trending-item">
                                <p class="mb-0 fw-bold small">#CodeIgniter4</p>
                                <small class="text-muted">540 deployed</small>
                            </div>
                        </div>

                        <div class="card p-4 border-0">
                            <h6 class="fw-bold mb-3 text-uppercase small font-monospace">Suggested_Devs</h6>
                            <div class="d-flex align-items-center mb-3">
                                <div class="rounded-circle me-2 bg-primary d-flex align-items-center justify-content-center text-white fw-bold"
                                    style="width: 32px; height: 32px; font-size: 10px;">JD</div>
                                <div class="flex-grow-1">
                                    <p class="mb-0 small fw-bold lh-1">John_Doe</p>
                                </div>
                                <button class="btn btn-sm btn-tech py-0 px-2" style="font-size: 10px;">Follow</button>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/prism/1.29.0/prism.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/prism/1.29.0/components/prism-php.min.js"></script>

    <script>
        // Lógica de Tema
        const themeToggle = document.getElementById('theme-toggle');
        const themeIcon = document.getElementById('theme-icon');
        const html = document.documentElement;

        themeToggle.addEventListener('click', () => {
            const newTheme = html.getAttribute('data-bs-theme') === 'dark' ? 'light' : 'dark';
            html.setAttribute('data-bs-theme', newTheme);
            themeIcon.className = newTheme === 'dark' ? 'bi bi-moon-stars-fill text-primary' : 'bi bi-sun-fill text-warning';
            localStorage.setItem('theme', newTheme);
        });

        if (localStorage.getItem('theme')) {
            const saved = localStorage.getItem('theme');
            html.setAttribute('data-bs-theme', saved);
            themeIcon.className = saved === 'dark' ? 'bi bi-moon-stars-fill text-primary' : 'bi bi-sun-fill text-warning';
        }
    </script>
</body>

</html>