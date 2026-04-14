<?= $this->extend('layout/main') ?>

<?= $this->section('content') ?>

<div class="container animate-up" style="max-width: 800px;">
    <h4 class="fw-bold mb-4">Settings</h4>

    <div class="row">
        <div class="col-md-3">
            <div class="list-group list-group-flush rounded shadow-sm border border-white border-opacity-10">
                <a href="#" class="list-group-item list-group-item-action bg-dark text-white active border-0">Public
                    profile</a>
                <a href="#"
                    class="list-group-item list-group-item-action bg-transparent text-muted border-0">Account</a>
                <a href="#"
                    class="list-group-item list-group-item-action bg-transparent text-muted border-0">Appearance</a>
            </div>
        </div>

        <div class="col-md-9">
            <div class="card border-0 bg-dark bg-opacity-10 shadow-sm">
                <div class="card-header bg-transparent border-bottom border-white border-opacity-10 py-3">
                    <h6 class="mb-0 fw-bold">Public profile</h6>
                </div>
                <div class="card-body p-4">
                    <form action="<?= base_url('usuario/update') ?>" method="post">
                        <?= csrf_field() ?>
                        <div class="mb-3">
                            <label class="form-label small fw-bold opacity-75">Display name</label>
                            <input type="text" name="nome" class="form-control bg-dark border-secondary text-white"
                                value="<?= session()->get('usuario_nome') ?>">
                            <div class="form-text text-muted small">Seu nome será exibido em todos os seus commits.
                            </div>
                        </div>

                        <div class="mb-4">
                            <label class="form-label small fw-bold opacity-75">Email address</label>
                            <input type="email" class="form-control bg-dark border-secondary text-white opacity-50"
                                value="jusara@dev.com" readonly>
                            <div class="form-text text-warning small"><i class="bi bi-lock"></i> Email não pode ser
                                alterado via hotfix.</div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label small fw-bold opacity-75">Bio / README.md</label>
                            <textarea name="bio" class="form-control bg-dark border-secondary text-white"
                                rows="3"><?= $usuario['bio'] ?? '' ?></textarea>
                        </div>
                        
                        <button type="submit" class="btn btn-tech btn-sm px-4">Update profile</button>

                    </form>
                </div>
            </div>

            <div class="mt-5 pt-4 border-top border-danger border-opacity-25">
                <h6 class="text-danger fw-bold mb-3">Danger Zone</h6>
                <div class="card border-danger border-opacity-25 bg-danger bg-opacity-10">
                    <div class="card-body d-flex justify-content-between align-items-center">
                        <div>
                            <div class="fw-bold text-white small">Delete account</div>
                            <div class="text-muted small">Uma vez deletada, não há volta (git push --force não resolve).
                            </div>
                        </div>
                        <button class="btn btn-outline-danger btn-sm">Delete</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>