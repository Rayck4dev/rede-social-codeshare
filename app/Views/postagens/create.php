<?= $this->extend('layout/main') ?>

<?= $this->section('content') ?>

<div class="row justify-content-center">
    <div class="col-lg-11">
        <h3 class="fw-bold mb-4 font-monospace">
            <i class="bi bi-plus-square me-2 text-primary"></i>CREATE_NEW_ENTRY.EXE
        </h3>

        <div class="card border-0 shadow-lg mb-4" style="background: var(--card-bg);">
            <div class="card-body p-4">
                <form action="<?= base_url('postagens/store') ?>" method="post" enctype="multipart/form-data"
                    id="formPostagem">
                    <?= csrf_field() ?>

                    <div class="d-flex gap-2 mb-3">
                        <button type="button" class="btn btn-dark btn-sm border border-secondary"
                            onclick="insertFormat('editor', 'code')" title="Inserir Bloco de Código">
                            <i class="bi bi-code"></i> Code
                        </button>
                        <button type="button" class="btn btn-dark btn-sm border border-secondary"
                            onclick="insertFormat('editor', 'bold')" title="Negrito">
                            <i class="bi bi-type-bold"></i> Bold
                        </button>
                        <button type="button" class="btn btn-dark btn-sm border border-secondary"
                            onclick="document.getElementById('fileCreate').click()" title="Anexar Imagem">
                            <i class="bi bi-image"></i> Image
                        </button>
                    </div>

                    <input type="file" name="imagem" id="fileCreate" class="d-none" accept="image/*">

                    <textarea name="conteudo" id="editor"
                        class="form-control bg-transparent text-white border-0 fs-5 custom-textarea"
                        style="min-height: 300px; resize: none; outline: none; text-align: left !important;"
                        placeholder="root@codeshare:~# Descreva sua lógica ou cole seu snippet..." required></textarea>

                    <hr class="border-white border-opacity-10">

                    <div class="d-flex justify-content-between align-items-center">
                        <a href="<?= base_url('feed') ?>" class="text-muted text-decoration-none small hover-accent">
                            <i class="bi bi-x-circle me-1"></i> Abort Mission
                        </a>
                        <button type="submit" class="btn btn-tech px-5 shadow-sm">
                            <i class="bi bi-terminal me-2"></i>PUSH_TO_MAIN
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <div class="preview-section mt-5">
            <h6 class="text-muted small mb-3 font-monospace text-uppercase d-flex align-items-center">
                <i class="bi bi-eye me-2 text-primary"></i> Live_Preview_Output
            </h6>
            <div class="p-4 rounded-3 border border-white border-opacity-10"
                style="background: rgba(0,0,0,0.2); min-height: 200px;">

                <div id="preview" class="text-white-50 text-start w-100"
                    style="white-space: pre-wrap; word-wrap: break-word; font-family: 'Inter', sans-serif; text-align: left !important;">
                    <span class="opacity-25 font-monospace">> Aguardando entrada de dados...</span>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .custom-textarea,
    #preview {
        text-align: left !important;
    }

    .hover-accent:hover {
        color: var(--accent-color) !important;
    }

    /* Estilização para o bloco de código dentro do preview */
    #preview pre {
        background: #1e1e1e !important;
        padding: 1.5rem !important;
        border-radius: 8px;
        border: 1px solid #333;
        margin-top: 1rem;
        text-align: left !important;
    }
</style>

<script>
    const editor = document.getElementById('editor');
    const preview = document.getElementById('preview');

    // Função de Live Preview com suporte a Markdown básico e Prism.js
    editor.addEventListener('input', () => {
        let content = editor.value;

        if (content.trim() === "") {
            preview.innerHTML = '<span class="opacity-25 font-monospace">> Aguardando entrada de dados...</span>';
            return;
        }

        let formatted = content
            .replace(/&/g, "&amp;")
            .replace(/</g, "&lt;")
            .replace(/>/g, "&gt;");

        formatted = formatted.replace(/\*\*(.*?)\*\*/g, '<strong class="text-white">$1</strong>');

        formatted = formatted.replace(/```([\s\S]*?)```/g, '<pre class="line-numbers"><code class="language-php">$1</code></pre>');

        formatted = formatted.replace(/@(\w+)/g, '<span class="text-primary">@$1</span>');

        preview.innerHTML = formatted;

        if (window.Prism) {
            Prism.highlightAllUnder(preview);
        }
    });

    // Função para os botões da Toolbar
    function insertFormat(fieldId, type) {
        const area = document.getElementById(fieldId);
        const start = area.selectionStart;
        const end = area.selectionEnd;
        const text = area.value;
        const selected = text.substring(start, end);
        let before = "", after = "";

        if (type === 'code') {
            before = "```\n";
            after = "\n```";
        }
        if (type === 'bold') {
            before = "**";
            after = "**";
        }

        area.value = text.substring(0, start) + before + selected + after + text.substring(end);

        area.dispatchEvent(new Event('input'));
        area.focus();
    }
</script>

<?= $this->endSection() ?>