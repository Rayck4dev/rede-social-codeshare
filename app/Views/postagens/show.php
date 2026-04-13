<?= $this->extend('layout/main') ?>
<?= $this->section('content') ?>

<div class="container animate-up">
    <div class="d-flex align-items-center mb-4 text-muted small font-monospace">
        <a href="<?= base_url('feed') ?>" class="text-accent text-decoration-none">feed</a>
        <span class="mx-2">/</span>
        <span>object_id: <?= esc($postagem['id']) ?></span>
    </div>

    <div class="card border-0 shadow-lg overflow-hidden">
        <div
            class="card-header border-0 bg-dark bg-opacity-25 d-flex justify-content-between align-items-center px-4 py-3">
            <div class="d-flex align-items-center">
                <div class="user-img me-2 rounded-circle d-flex align-items-center justify-content-center text-white fw-bold shadow-sm"
                    style="width: 35px; height: 35px; background: #30363d; font-size: 0.8rem; border: 1px solid var(--border-color);">
                    <?= strtoupper(substr($postagem['nome_usuario'] ?? 'U', 0, 1)) ?>
                </div>
                <span
                    class="fw-bold"><?= esc($postagem['nome_usuario'] ?? 'Usuário #' . $postagem['usuario_id']) ?></span>
            </div>
            <span
                class="badge rounded-pill bg-success bg-opacity-10 text-success border border-success border-opacity-25">
                <i class="bi bi-check2-all me-1"></i> Committed
            </span>
        </div>

        <div class="card-body p-4">
            <div class="post-content fs-5 mb-5"
                style="color: var(--text-color); line-height: 1.6; font-family: 'Inter', sans-serif;">
                <?= nl2br(esc($postagem['conteudo'] ?? $postagem['texto'])) ?>
            </div>

            <div class="border-top pt-4 mt-4">
                <div class="row font-monospace small">
                    <div class="col-md-6 mb-3">
                        <p class="text-muted mb-1 uppercase text-xs">Data de Criação</p>
                        <div class="d-flex align-items-center">
                            <i class="bi bi-calendar-plus me-2 text-accent"></i>
                            <span><?= date('d/m/Y \à\s H:i:s', strtotime($postagem['created_at'])) ?></span>
                        </div>
                    </div>

                    <?php if (!empty($postagem['updated_at']) && $postagem['updated_at'] !== $postagem['created_at']): ?>
                        <div class="col-md-6 mb-3">
                            <p class="text-muted mb-1 uppercase text-xs">Última Modificação</p>
                            <div class="d-flex align-items-center text-warning">
                                <i class="bi bi-pencil-square me-2"></i>
                                <span><?= date('d/m/Y \à\s H:i:s', strtotime($postagem['updated_at'])) ?></span>
                            </div>
                        </div>
                    <?php else: ?>
                        <div class="col-md-6 mb-3 text-muted opacity-50">
                            <p class="mb-1 uppercase text-xs">Status de Edição</p>
                            <div class="d-flex align-items-center">
                                <i class="bi bi-slash-circle me-2"></i>
                                <span>Nenhuma alteração detectada.</span>
                            </div>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>

        <div class="card-footer border-0 bg-transparent p-4 d-flex gap-2">
            <a href="<?= base_url('feed') ?>" class="btn btn-outline-secondary btn-sm px-3">
                <i class="bi bi-arrow-left me-1"></i> Voltar
            </a>
            <?php if ($postagem['usuario_id'] == session()->get('usuario_id')): ?>
                <a href="<?= base_url('postagens/edit/' . $postagem['id']) ?>" class="btn btn-tech btn-sm px-3">
                    <i class="bi bi-terminal me-1"></i> Editar Post
                </a>
            <?php endif; ?>
        </div>
    </div>
</div>

<style>
    .text-xs {
        font-size: 0.7rem;
        font-weight: 800;
        letter-spacing: 1px;
    }

    .animate-up {
        animation: fadeInUp 0.4s ease-out;
    }

    @keyframes fadeInUp {
        from {
            opacity: 0;
            transform: translateY(10px);
        }

        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
</style>

<?= $this->endSection() ?>