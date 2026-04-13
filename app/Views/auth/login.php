<?= $this->extend('layout/auth') ?>
<?= $this->section('content') ?>

<style>
    body {
        background-color: #0d1117;
        margin: 0;
        overflow: hidden;
    }

    h2 {
        color: #58a6ff !important;
        /* Azul "GitHub" */
        text-shadow: 0 0 10px rgba(88, 166, 255, 0.5);
        font-family: 'Fira Code', monospace;
        letter-spacing: 2px;
    }

    #matrix-bg {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        z-index: 1;
    }

    .gradient-bg {
        position: relative;
        z-index: 2;
        height: 100vh;
        background: rgba(13, 17, 23, 0.4);
    }

    @keyframes borderGlow {
        0% {
            border-color: #30363d;
        }

        50% {
            border-color: #58a6ff;
            box-shadow: 0 0 15px rgba(88, 166, 255, 0.3);
        }

        100% {
            border-color: #30363d;
        }
    }

    .login-card {
        width: 400px;
        background: rgba(22, 27, 34, 0.9);
        backdrop-filter: blur(8px);
        border: 1px solid #30363d;
        border-radius: 12px;
        padding: 40px;
        box-shadow: 0 8px 32px rgba(0, 0, 0, 0.5);
        animation: borderGlow 4s infinite ease-in-out;
    }

    .btn-tech {
        background-color: #238636 !important;
        color: #ffffff !important;
        border: 1px solid rgba(240, 246, 252, 0.1) !important;
        border-radius: 6px;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 1px;
        transition: all 0.3s ease;
    }

    .btn-tech:hover {
        background-color: #2ea043 !important;
        box-shadow: 0 0 15px rgba(46, 160, 67, 0.6);
        transform: translateY(-2px);
    }

    .form-control {
        background-color: #0d1117 !important;
        border: 1px solid #30363d !important;
        color: #c9d1d9 !important;
    }

    .form-control:focus {
        border-color: #58a6ff !important;
        background-color: rgba(13, 17, 23, 0.9) !important;
        box-shadow: 0 0 0 3px rgba(56, 139, 253, 0.2) !important;
    }

    p.mt-3.text-center a {
        color: #58a6ff !important;
        text-decoration: none;
        font-weight: 600;
        transition: 0.2s;
    }

    p.mt-3.text-center a:hover {
        color: #79c0ff !important;
        text-decoration: underline;
    }

    #toggleSenhaLogin {
        color: #58a6ff !important;
        font-family: 'Fira Code', monospace;
        font-weight: bold;
        font-size: 1.1rem;
        padding-right: 15px;
        z-index: 10;

        #senhaLogin {
            padding-right: 45px !important;
        }

        label {
            color: #8b949e;
        }
</style>

<canvas id="matrix-bg"></canvas>

<script>
    const canvas = document.getElementById('matrix-bg');
    const ctx = canvas.getContext('2d');

    canvas.width = window.innerWidth;
    canvas.height = window.innerHeight;

    const characters = "0101010101ABCDEF<>/{}[]";
    const charArray = characters.split('');
    const fontSize = 16;
    const columns = canvas.width / fontSize;
    const drops = [];

    for (let x = 0; x < columns; x++) {
        drops[x] = 1;
    }

    function draw() {
        ctx.fillStyle = "rgba(13, 17, 23, 0.05)";
        ctx.fillRect(0, 0, canvas.width, canvas.height);

        ctx.fillStyle = "#1f6feb"; 
        ctx.font = fontSize + "px monospace";

        for (let i = 0; i < drops.length; i++) {
            const text = charArray[Math.floor(Math.random() * charArray.length)];
            ctx.fillText(text, i * fontSize, drops[i] * fontSize);

            if (drops[i] * fontSize > canvas.height && Math.random() > 0.975) {
                drops[i] = 0;
            }
            drops[i]++;
        }
    }

    setInterval(draw, 35);

    window.addEventListener('resize', () => {
        canvas.width = window.innerWidth;
        canvas.height = window.innerHeight;
    });
</script>

<div class="d-flex justify-content-center align-items-center vh-100 gradient-bg">
    <div class="card p-5 login-card">
        <div class="text-center mb-4">
            <h2 class="fw-bold">CodeShare</h2>
            <p style="color: #8b949e;">Entre para compartilhar ideias</p>
        </div>

        <?php if (session()->getFlashdata('erro')): ?>
            <div class="alert alert-danger shadow-sm"><?= session()->getFlashdata('erro') ?></div>
        <?php endif; ?>

        <?php if (session()->getFlashdata('sucesso')): ?>
            <div class="alert alert-success shadow-sm"><?= session()->getFlashdata('sucesso') ?></div>
        <?php endif; ?>

        <form action="<?= base_url('autenticar') ?>" method="post">
            <div class="mb-3">
                <label for="email" class="form-label fw-semibold" style="color: #8b949e;">E-mail</label>
                <input type="email" name="email" class="form-control shadow-sm" placeholder="seu@email.com" required>
            </div>

            <div class="mb-3">
                <label for="senha" class="form-label fw-semibold" style="color: #8b949e;">Senha</label>
                <div class="position-relative">
                    <input type="password" id="senhaLogin" name="senha" class="form-control shadow-md pe-5"
                        placeholder="••••••••" required>
                    <button type="button" id="toggleSenhaLogin"
                        class="btn btn-link position-absolute top-50 end-0 translate-middle-y"
                        style="color:#2A9D8F; text-decoration:none;">
                        >_
                    </button>
                </div>
            </div>

            <button type="submit" class="btn btn-tech w-100">Entrar</button>
        </form>

        <p class="mt-3 text-center" style="color: #8b949e;">Não tem conta?
            <a href="<?= base_url('cadastro') ?>">Cadastre-se aqui</a>
        </p>
    </div>
</div>

<script>
    const senhaLogin = document.getElementById('senhaLogin');
    const toggleSenhaLogin = document.getElementById('toggleSenhaLogin');

    toggleSenhaLogin.textContent = '>_';

    toggleSenhaLogin.addEventListener('click', () => {
        const isPassword = senhaLogin.getAttribute('type') === 'password';
        senhaLogin.setAttribute('type', isPassword ? 'text' : 'password');

        toggleSenhaLogin.textContent = isPassword ? '#' : '>_';

        toggleSenhaLogin.style.textShadow = isPassword ? '0 0 10px #58a6ff' : 'none';
    });
</script>

<?= $this->endSection() ?>