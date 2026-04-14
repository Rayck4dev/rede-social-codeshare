<?= $this->extend('layout/main') ?>

<?= $this->section('content') ?>

<div class="card shadow-sm mb-4 border-0 animate-up" style="background: var(--card-bg);">
    <div class="card-body p-4">
        <div class="d-flex">
            <div class="user-img me-3 rounded-circle d-flex align-items-center justify-content-center text-white fw-bold shadow-sm"
                style="width: 48px; height: 48px; background: linear-gradient(45deg, #0969da, #58a6ff); min-width: 48px;">
                <?= strtoupper(substr(session()->get('usuario_nome'), 0, 1)) ?>
            </div>

            <form action="<?= base_url('postagens/store') ?>" method="post" class="w-100 post-form" id="formPostagem"
                enctype="multipart/form-data">
                <?= csrf_field() ?>
                <div class="mb-2">
                    <textarea name="conteudo" id="inputFeed"
                        class="form-control border-0 bg-transparent fs-5 custom-textarea text-start" rows="3"
                        placeholder="root@codeshare:~# Qual o insight de hoje?"
                        style="resize: none; color: var(--text-color); outline: none;" required></textarea>
                </div>

                <input type="file" name="imagem" id="fileInputFeed" class="d-none" accept="image/*">

                <div
                    class="d-flex align-items-center justify-content-between border-top border-white border-opacity-10 pt-3">
                    <div class="d-flex gap-2">
                        <button type="button" class="btn btn-sm btn-outline-secondary border-0 p-2 hover-accent"
                            onclick="insertFormat('inputFeed', 'code')" title="Código">
                            <i class="bi bi-code-slash"></i>
                        </button>
                        <button type="button" class="btn btn-sm btn-outline-secondary border-0 p-2 hover-accent"
                            onclick="insertFormat('inputFeed', 'bold')" title="Negrito">
                            <i class="bi bi-type-bold"></i>
                        </button>
                        <button type="button" class="btn btn-sm btn-outline-secondary border-0 p-2 hover-accent"
                            onclick="document.getElementById('fileInputFeed').click()" title="Imagem">
                            <i class="bi bi-image"></i>
                        </button>
                    </div>

                    <button type="submit" class="btn btn-tech px-4 shadow-sm btn-deploy">
                        <i class="bi bi-terminal me-2"></i>Deploy
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<?php if (!empty($postagens)): ?>
    <?php foreach ($postagens as $post): ?>
        <div class="card mb-3 border-0 shadow-sm animate-up post-card" style="background: var(--card-bg);">
            <div class="card-body p-4 text-start">
                <div class="d-flex align-items-center mb-3">
                    <div class="user-img me-3 rounded-circle d-flex align-items-center justify-content-center text-white fw-bold"
                        style="width: 42px; height: 42px; background: #30363d; border: 2px solid var(--accent-color);">
                        <?= strtoupper(substr($post['nome_usuario'], 0, 1)) ?>
                    </div>
                    <div>
                        <h6 class="mb-0 fw-bold">
                            <a href="<?= base_url('perfil/' . $post['usuario_id']) ?>"
                                class="text-decoration-none text-white hover-accent">
                                <?= esc($post['nome_usuario']) ?>
                            </a>
                        </h6>
                        <small class="text-muted font-monospace" style="font-size: 0.75rem;">
                            <i class="bi bi-clock me-1"></i><?= date('d M H:i', strtotime($post['created_at'])) ?>
                        </small>
                    </div>
                </div>

                <div class="post-content-area w-100">
                    <?php
                    $conteudo = esc($post['conteudo']);
                    if (strpos($conteudo, '```') !== false) {
                        $conteudo = preg_replace('/```([\s\S]*?)```/', '<pre class="bg-dark p-3 rounded border border-secondary text-info"><code>$1</code></pre>', $conteudo);
                        echo '<div class="text-white-50">' . $conteudo . '</div>';
                    } else {
                        echo '<div class="mb-3 text-white-50 pure-text">' . nl2br($conteudo) . '</div>';
                    }
                    ?>

                    <?php if (!empty($post['imagem'])): ?>
                        <div class="mt-3 overflow-hidden rounded border border-white border-opacity-10">
                            <img src="<?= base_url('uploads/posts/' . $post['imagem']) ?>" class="img-fluid w-100"
                                style="max-height: 500px; object-fit: cover;" alt="Post image">
                        </div>
                    <?php endif; ?>
                </div>

            </div>
        </div>
    <?php endforeach; ?>
<?php endif; ?>

<script>
    function insertFormat(fieldId, type) {
        const area = document.getElementById(fieldId);
        const start = area.selectionStart;
        const end = area.selectionEnd;
        const text = area.value;
        const selected = text.substring(start, end);
        let before = "", after = "";

        if (type === 'code') { before = "```\n"; after = "\n```"; }
        if (type === 'bold') { before = "**"; after = "**"; }

        area.value = text.substring(0, start) + before + selected + after + text.substring(end);
        area.focus();
    }
</script>

<?= $this->endSection() ?>