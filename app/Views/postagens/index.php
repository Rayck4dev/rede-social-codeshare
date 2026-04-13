<?= $this->extend('layout/main') ?>

<?= $this->section('content') ?>

<div class="card shadow-sm mb-4 border-0">
    <div class="card-body p-4">
        <div class="d-flex">
            <div class="user-img me-3 rounded-circle d-flex align-items-center justify-content-center text-white fw-bold"
                style="width: 48px; height: 48px; background: linear-gradient(45deg, #0969da, #58a6ff); min-width: 48px;">
                <?= strtoupper(substr(session()->get('usuario_nome'), 0, 1)) ?>
            </div>
            <form action="<?= base_url('postagens/store') ?>" method="post" class="w-100">
                <div class="mb-3">
                    <textarea name="conteudo" class="form-control border-0 bg-transparent fs-5" rows="2"
                        placeholder="Qual o insight de hoje, <?= explode(' ', session()->get('usuario_nome'))[0] ?>?"
                        style="resize: none; color: var(--text-color);" required></textarea>
                </div>
                <div class="d-flex justify-content-between align-items-center border-top pt-3">
                    <div class="tech-icons text-muted">
                        <i class="bi bi-code-slash me-3 cursor-pointer"></i>
                        <i class="bi bi-image me-3 cursor-pointer"></i>
                        <i class="bi bi-terminal me-3 cursor-pointer"></i>
                    </div>
                    <button type="submit" class="btn btn-tech px-4 shadow-sm">
                        Deploy <i class="bi bi-send-fill ms-1"></i>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="d-flex align-items-center mb-3">
    <hr class="flex-grow-1 opacity-10">
    <span class="mx-3 small fw-bold text-muted text-uppercase" style="letter-spacing: 1px;">Main Branch Feed</span>
    <hr class="flex-grow-1 opacity-10">
</div>

<?php if (!empty($postagens) && is_array($postagens)): ?>
    <?php foreach ($postagens as $post): ?>
        <div class="card mb-3 border-0 shadow-sm animate-up">
            <div class="card-body p-4">
                <div class="d-flex align-items-center mb-3">
                    <div class="user-img me-3 rounded-circle d-flex align-items-center justify-content-center text-white fw-bold shadow-sm"
                        style="width: 42px; height: 42px; background: #30363d; font-size: 0.9rem; border: 1px solid var(--border-color);">
                        <?= strtoupper(substr($post['nome_usuario'], 0, 1)) ?>
                    </div>
                    <div>
                        <h6 class="mb-0 fw-bolder"><?= esc($post['nome_usuario']) ?></h6>
                        <small class="text-muted d-flex align-items-center">
                            <i class="bi bi-clock-history me-1"></i>
                            <?= date('d M', strtotime($post['created_at'])) ?> às
                            <?= date('H:i', strtotime($post['created_at'])) ?>
                        </small>
                    </div>
                    <div class="ms-auto">
                        <i class="bi bi-three-dots text-muted"></i>
                    </div>
                </div>

                <div class="post-content mb-3" style="color: var(--text-color); line-height: 1.6;">
                    <?= nl2br(esc($post['conteudo'])) ?>
                </div>

                <div class="d-flex align-items-center gap-3 border-top pt-3">
                    <button class="btn btn-sm border-0 p-0 text-muted hover-blue">
                        <i class="bi bi-rocket-takeoff me-1"></i> Boost
                    </button>
                    <button class="btn btn-sm border-0 p-0 text-muted hover-blue">
                        <i class="bi bi-chat-left-dots me-1"></i> Comment
                    </button>

                    <?php if ($post['usuario_id'] == session()->get('usuario_id')): ?>
                        <a href="<?= base_url('postagens/delete/' . $post['id']) ?>"
                            class="ms-auto btn btn-sm text-danger opacity-75 hover-opacity-100 p-0 border-0"
                            onclick="return confirm('Deseja dar rollback nessa postagem?')">
                            <i class="bi bi-trash3"></i>
                        </a>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    <?php endforeach; ?>
<?php else: ?>
    <div class="card border-0 bg-transparent text-center py-5">
        <i class="bi bi-terminal-x display-1 text-muted opacity-25"></i>
        <p class="text-muted mt-3">404: Ideias não encontradas no servidor.</p>
    </div>
<?php endif; ?>

<style>
    /* Estilos locais para o feed */
    .animate-up {
        animation: fadeInUp 0.5s ease backwards;
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

    .hover-blue:hover {
        color: var(--accent-color) !important;
        transition: 0.2s;
    }

    textarea:focus {
        outline: none !important;
        box-shadow: none !important;
    }

    .cursor-pointer {
        cursor: pointer;
    }
</style>

<?= $this->endSection() ?>