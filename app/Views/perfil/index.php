<?= $this->extend('layout/main') ?>

<?= $this->section('content') ?>

<div class="container animate-up">
    <div class="card border-0 bg-dark bg-opacity-25 mb-4 shadow-sm">
        <div class="card-body p-4">
            <div class="d-flex align-items-center">
                <div class="user-img me-4 rounded-circle d-flex align-items-center justify-content-center text-white fw-bold shadow-lg"
                    style="width: 100px; height: 100px; background: linear-gradient(45deg, #0969da, #58a6ff); font-size: 2.5rem; border: 3px solid #30363d;">
                    <?= strtoupper(substr($usuario['nome'], 0, 1)) ?>
                </div>
                <div>
                    <h2 class="fw-bold mb-1"><?= esc($usuario['nome']) ?></h2>
                    <p class="text-muted font-monospace mb-2">
                        @dev_<?= strtolower(str_replace(' ', '_', $usuario['nome'])) ?></p>
                    <div class="d-flex gap-3">
                        <span class="small text-muted"><i class="bi bi-people me-1"></i> 0 followers</span>
                        <span class="small text-muted"><i class="bi bi-star me-1"></i> 0 stars</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-4">
            <div class="card border-0 bg-dark bg-opacity-10 mb-4">
                <div class="card-body">
                    <h6 class="fw-bold mb-3 small text-uppercase opacity-50">Bio / README.md</h6>
                    <p class="small text-muted">
                        <?= !empty($usuario['bio']) ? esc($usuario['bio']) : 'No bio provided yet.' ?>
                    </p>
                    <hr class="opacity-10">
                    <div class="d-grid">
                        <?php if (session()->get('usuario_id') == $usuario['id']): ?>
                            <a href="<?= base_url('settings') ?>" class="btn btn-outline-secondary btn-sm">
                                <i class="bi bi-pencil-square me-1"></i> Edit profile
                            </a>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-8">
            <h6 class="fw-bold mb-3 d-flex align-items-center">
                <i class="bi bi-journal-code me-2 text-primary"></i>
                Latest Deployments (<?= count($postagens) ?>)
            </h6>

            <?php if (!empty($postagens)): ?>
                <?php foreach ($postagens as $post): ?>
                    <div class="card mb-3 border-white border-opacity-5 bg-dark bg-opacity-10 shadow-sm">
                        <div class="card-body">
                            <?php
                            $tags = [];
                            $textoParaBusca = $post['conteudo'] ?? '';
                            if (stripos($textoParaBusca, '<?php') !== false) $tags[] = 'PHP';
                            if (stripos($textoParaBusca, 'function') !== false || stripos($textoParaBusca, 'const') !== false) $tags[] = 'JS';
                            if (stripos($textoParaBusca, 'SELECT') !== false || stripos($textoParaBusca, 'INSERT') !== false) $tags[] = 'SQL';
                            if (stripos($textoParaBusca, '<html>') !== false) $tags[] = 'HTML';
                            ?>

                            <?php foreach ($tags as $tag): ?>
                                <span class="badge rounded-pill bg-primary bg-opacity-10 text-primary border border-primary border-opacity-25 mb-2" style="font-size: 0.7rem;">
                                    #<?= $tag ?>
                                </span>
                            <?php endforeach; ?>

                            <div class="text-white opacity-90 mb-3">
                                <?= nl2br(esc($post['conteudo'])) ?>
                            </div>

                            <div class="d-flex justify-content-between align-items-center border-top border-white border-opacity-5 pt-3">
                                <div class="small text-muted font-monospace" style="font-size: 0.7rem;">
                                    <i class="bi bi-git me-1"></i> commit_id: <?= $post['id'] ?>
                                </div>
                                <small class="text-muted" style="font-size: 0.7rem;">
                                    <?= date('d M Y', strtotime($post['created_at'])) ?>
                                </small>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <div class="text-center py-5 border rounded border-secondary border-opacity-25 border-dashed opacity-50">
                    <i class="bi bi-terminal-x fs-1"></i>
                    <p class="mt-2">No commits found in this branch.</p>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>

<?= $this->endSection() ?>