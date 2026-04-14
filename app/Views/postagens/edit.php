<?= $this->extend('layout/main') ?>

<?= $this->section('content') ?>

<div class="container animate-up">
    <nav aria-label="breadcrumb" class="mb-4">
        <ol class="breadcrumb" style="font-family: 'Fira Code', monospace; font-size: 0.85rem;">
            <li class="breadcrumb-item"><a href="<?= base_url('feed') ?>"
                    class="text-decoration-none text-muted">root</a></li>
            <li class="breadcrumb-item active text-warning">edit_mode.sh</li>
        </ol>
    </nav>

    <div class="card border-0 shadow-lg overflow-hidden" style="background: var(--card-bg);">
        <div class="card-header border-0 d-flex align-items-center px-4 py-3" style="background: rgba(0,0,0,0.2);">
            <div class="d-flex gap-2 me-3">
                <div style="width: 12px; height: 12px; border-radius: 50%; background: #ff5f56;"></div>
                <div style="width: 12px; height: 12px; border-radius: 50%; background: #ffbd2e;"></div>
                <div style="width: 12px; height: 12px; border-radius: 50%; background: #27c93f;"></div>
            </div>
            <span class="small fw-bold font-monospace opacity-50">Refactoring Object #<?= $postagem['id'] ?></span>
        </div>

        <div class="card-body p-4">
            <h2 class="fw-extrabold mb-4" style="letter-spacing: -1px; color: var(--text-color);">Editar Postagem</h2>

            <form action="<?= base_url('postagens/update/' . $postagem['id']) ?>" method="post">
                <div class="mb-4 position-relative">
                    <label class="form-label small text-muted font-monospace mb-2">/edit/payload:</label>
                    <textarea name="conteudo" class="form-control border-0 p-3 fs-5" rows="8"
                        style="resize: none; background: rgba(0,0,0,0.15); font-family: 'Fira Code', monospace; color: var(--text-color);"
                        required autofocus><?= esc($postagem['conteudo'] ?? $postagem['texto']) ?></textarea>
                </div>

                <div class="d-flex align-items-center justify-content-between bg-dark bg-opacity-10 p-3 rounded-3">
                    <div class="text-warning small">
                        <i class="bi bi-exclamation-triangle-fill me-1"></i> Atenção: Isso alterará o registro original.
                    </div>
                    <div class="d-flex gap-2">
                        <a href="<?= base_url('feed') ?>"
                            class="btn btn-link text-muted text-decoration-none fw-bold">Cancel</a>
                        <button type="submit" class="btn btn-warning px-6 fw-bold" style="color: #000;">
                            RE-DEPLOY <i class="bi bi-arrow-repeat ms-2"></i>
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<style>
    /* Foco amarelo para indicar edição */
    textarea:focus {
        outline: none !important;
        box-shadow: 0 0 0 2px #ffbd2e !important;
        background: rgba(0, 0, 0, 0.25) !important;
    }

    .animate-up {
        animation: fadeInUp 0.5s ease-out;
    }

    @keyframes fadeInUp {
        from {
            opacity: 0;
            transform: translateY(20px);
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