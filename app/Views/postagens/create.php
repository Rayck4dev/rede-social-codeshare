<?= $this->extend('layout/main') ?>

<?= $this->section('content') ?>

<div class="container animate-up">
    <nav aria-label="breadcrumb" class="mb-4">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?= base_url('feed') ?>"
                    class="text-decoration-none text-muted">root</a></li>
            <li class="breadcrumb-item"><a href="<?= base_url('feed') ?>"
                    class="text-decoration-none text-muted">postagens</a></li>
            <li class="breadcrumb-item active text-accent" aria-current="page">new_post.sh</li>
        </ol>
    </nav>

    <div class="card border-0 shadow-lg overflow-hidden">
        <div class="card-header border-0 d-flex align-items-center px-4 py-3" style="background: rgba(0,0,0,0.2);">
            <div class="d-flex gap-2 me-3">
                <div style="width: 12px; height: 12px; border-radius: 50%; background: #ff5f56;"></div>
                <div style="width: 12px; height: 12px; border-radius: 50%; background: #ffbd2e;"></div>
                <div style="width: 12px; height: 12px; border-radius: 50%; background: #27c93f;"></div>
            </div>
            <span class="small fw-bold font-monospace opacity-50">Editor: SHA-256 Mode</span>
        </div>

        <div class="card-body p-4">
            <h2 class="fw-extrabold mb-4" style="letter-spacing: -1px;">Commit nova ideia</h2>

            <form action="<?= base_url('postagens/store') ?>" method="post">
                <div class="mb-4 position-relative">
                    <label class="form-label small text-muted font-monospace mb-2">/content/payload:</label>
                    <textarea name="conteudo" class="form-control border-0 p-3 fs-5" rows="8"
                        placeholder="Insira seu código ou pensamento aqui..."
                        style="resize: none; background: rgba(0,0,0,0.15); font-family: 'Fira Code', monospace; color: var(--text-color);"
                        required autofocus></textarea>

                    <div class="position-absolute end-0 top-0 mt-2 me-3 opacity-25">
                        <i class="bi bi-braces fs-1"></i>
                    </div>
                </div>

                <div class="d-flex align-items-center justify-content-between bg-dark bg-opacity-10 p-3 rounded-3">
                    <div class="text-muted small">
                        <i class="bi bi-info-circle me-1"></i> Use Markdown ou texto puro.
                    </div>
                    <div class="d-flex gap-2">
                        <a href="<?= base_url('feed') ?>"
                            class="btn btn-link text-muted text-decoration-none fw-bold">Abort</a>
                        <button type="submit" class="btn btn-tech px-5">
                            PUSH TO MAIN <i class="bi bi-cloud-arrow-up-fill ms-2"></i>
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<style>
    textarea:focus {
        outline: none !important;
        box-shadow: 0 0 0 2px var(--accent-color) !important;
        background: rgba(0, 0, 0, 0.25) !important;
    }

    .animate-up {
        animation: fadeInUp 0.6s cubic-bezier(0.23, 1, 0.32, 1);
    }

    @keyframes fadeInUp {
        from {
            opacity: 0;
            transform: translateY(30px);
        }

        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .breadcrumb-item+.breadcrumb-item::before {
        color: var(--border-color);
        content: ">";
    }
</style>

<?= $this->endSection() ?>