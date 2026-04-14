<?= $this->extend('layout/main') ?>

<?= $this->section('content') ?>

<div class="container animate-up">
    <div class="d-flex align-items-center mb-4 text-muted small font-monospace">
        <a href="<?= base_url('feed') ?>" class="text-accent text-decoration-none">feed</a>
        <span class="mx-2 text-opacity-50">/</span>
        <span class="opacity-75">object_id: <?= esc($postagem['id']) ?></span>
    </div>

    <div class="card border-0 shadow-lg overflow-hidden mb-5">
        <div
            class="card-header border-0 bg-dark bg-opacity-25 d-flex justify-content-between align-items-center px-4 py-3">
            <div class="d-flex align-items-center">
                <div class="user-img me-2 rounded-circle d-flex align-items-center justify-content-center text-white fw-bold shadow-sm"
                    style="width: 35px; height: 35px; background: #30363d; font-size: 0.8rem; border: 1px solid var(--border-color);">
                    <?= strtoupper(substr($postagem['nome_usuario'] ?? 'U', 0, 1)) ?>
                </div>
                <span class="fw-bold"><?= esc($postagem['nome_usuario']) ?></span>
            </div>
            <span
                class="badge rounded-pill bg-success bg-opacity-10 text-success border border-success border-opacity-25">
                <i class="bi bi-check2-all me-1"></i> Committed
            </span>
        </div>

        <div class="card-body p-4 p-md-5">
            <div class="post-content fs-5 mb-5"
                style="color: var(--text-color); line-height: 1.7; white-space: pre-wrap;">
                <?= esc($postagem['conteudo']) ?>
            </div>

            <div class="border-top pt-4 mt-5">
                <h6 class="text-uppercase small fw-bold text-muted mb-4">Object Metadata</h6>
                <div class="row font-monospace small">
                    <div class="col-md-6 mb-4">
                        <p class="text-muted mb-2 text-xs text-uppercase">Data de Criação</p>
                        <span><?= date('d/m/Y H:i:s', strtotime($postagem['created_at'])) ?></span>
                    </div>
                </div>
            </div>
        </div>

        <div class="card-footer border-0 bg-dark bg-opacity-10 p-4 d-flex gap-2">
            <a href="<?= base_url('feed') ?>" class="btn btn-outline-secondary btn-sm px-4">Voltar</a>
            <?php if ($postagem['usuario_id'] == session()->get('usuario_id')): ?>
                <a href="<?= base_url('postagens/edit/' . $postagem['id']) ?>" class="btn btn-tech btn-sm px-4">Editar
                    Source</a>
            <?php endif; ?>
        </div>
    </div>

    <div class="mt-5">
        <h5 class="fw-bold mb-4">
            <i class="bi bi-chat-right-text me-2 text-accent"></i>
            Commits <span id="comment-total"
                class="badge bg-secondary bg-opacity-10 text-muted ms-2 rounded-pill"><?= count($comentarios) ?></span>
        </h5>

        <div class="card border-0 bg-dark bg-opacity-25 mb-5 shadow-sm">
            <div class="card-body p-4">
                <form id="commentForm" action="<?= base_url('comentarios/store') ?>" method="post">
                    <?= csrf_field() ?>
                    <input type="hidden" name="postagem_id" value="<?= $postagem['id'] ?>">
                    <div class="mb-3">
                        <textarea name="conteudo" class="form-control border-0 bg-transparent text-white fs-6" rows="3"
                            placeholder="Escreva seu feedback técnico..." style="resize: none;" required></textarea>
                    </div>
                    <div class="text-end">
                        <button type="submit" class="btn btn-tech btn-sm px-5">Post Comment</button>
                    </div>
                </form>
            </div>
        </div>

        <div id="comment-list" class="pb-5">
            <?php foreach ($comentarios as $com): ?>
                <div class="d-flex mb-4 p-4 rounded-3 bg-dark bg-opacity-10 border border-white border-opacity-5">
                    <div class="user-img me-3 rounded-circle d-flex align-items-center justify-content-center text-white fw-bold"
                        style="width: 40px; height: 40px; background: #30363d;">
                        <?= strtoupper(substr($com['nome_usuario'], 0, 1)) ?>
                    </div>
                    <div class="flex-grow-1">
                        <div class="d-flex justify-content-between align-items-center mb-2">
                            <span class="fw-bold text-accent"><?= esc($com['nome_usuario']) ?></span>
                            <?php if ($com['usuario_id'] == session()->get('usuario_id')): ?>
                                <a href="<?= base_url('comentarios/delete/' . $com['id']) ?>"
                                    class="text-danger opacity-50 hover-opacity-100"
                                    onclick="return confirm('Deletar commit?')">
                                    <i class="bi bi-trash3"></i>
                                </a>
                            <?php endif; ?>
                        </div>
                        <div class="text-muted"><?= nl2br(esc($com['conteudo'])) ?></div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</div>

<script>
    document.getElementById('commentForm').addEventListener('submit', function (e) {
        e.preventDefault();
        const formData = new FormData(this);
        const list = document.getElementById('comment-list');
        const totalSpan = document.getElementById('comment-total');

        fetch(this.action, { method: 'POST', body: formData })
            .then(res => res.json())
            .then(data => {
                if (data.status === 'success') {
                    const html = `
                    <div class="d-flex mb-4 p-4 rounded-3 bg-dark bg-opacity-10 border border-white border-opacity-5 animate-up">
                        <div class="user-img me-3 rounded-circle d-flex align-items-center justify-content-center text-white fw-bold" style="width: 40px; height: 40px; background: #0969da;">
                            ${data.nome.charAt(0).toUpperCase()}
                        </div>
                        <div class="flex-grow-1">
                            <div class="d-flex justify-content-between">
                                <span class="fw-bold text-accent">${data.nome}</span>
                                <a href="#" class="text-danger opacity-50"><i class="bi bi-trash3"></i></a>
                            </div>
                            <p class="text-muted mb-0">${data.conteudo}</p>
                        </div>
                    </div>`;
                    list.insertAdjacentHTML('afterbegin', html);
                    totalSpan.innerText = data.total;
                    this.reset();
                }
            });
    });
</script>

<?= $this->endSection() ?>