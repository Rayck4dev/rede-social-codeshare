<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rede Social - CodeShare</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f0f2f5;
        }

        .navbar {
            shadow: 0 2px 4px rgba(0, 0, 0, .1);
        }

        .post-card {
            border: none;
            border-radius: 8px;
            margin-bottom: 20px;
        }

        .user-img {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background:
                #ccc;
            display: inline-block;
        }
    </style>
</head>

<body>

    <nav class="navbar navbar-expand-lg navbar-dark bg-primary mb-4 shadow-sm">
        <div class="container">
            <a class="navbar-brand fw-bold" href="#">🚀 NomeDaRede</a>
            <div class="navbar-nav ms-auto">
                <a class="nav-link active" href="#">Página Inicial</a>
                <a class="nav-link" href="#">Meu Perfil</a>
                <a class="nav-link" href="#">Sair</a>
            </div>
        </div>
    </nav>

    <div class="container">
        <div class="row justify-content-center">

            <div class="col-md-7">

                <div class="card post-card shadow-sm">
                    <div class="card-body">
                        <div class="d-flex mb-3">
                            <div class="user-img me-2"></div>
                            <h6 class="align-self-center mb-0 text-muted">No que você está
                                pensando agora?</h6>
                        </div>
                        <form>
                            <div class="mb-3">
                                <textarea class="form-control" rows="3" placeholder="Escreva 
algo interessante..."></textarea>
                            </div>
                            <div class="text-end">
                                <button type="button" class="btn btn-primary px
4">Publicar</button>
                            </div>
                        </form>
                    </div>
                </div>

                <div class="card post-card shadow-sm">
                    <div class="card-body">
                        <div class="d-flex mb-3">
                            <div class="user-img me-2 bg-info"></div>
                            <div>
                                <h6 class="mb-0 fw-bold">Professor_Backend</h6>
                                <small class="text-muted">Postado há 10 minutos</small>
                            </div>
                        </div>
                        <p class="card-text">
                            Esta é uma postagem de exemplo. O CodeIgniter 4 facilita muito a
                            criação
                            da lógica que vai substituir este texto estático por dados do banco!
                        </p>
                        <hr>
                        <div class="d-flex justify-content-between align-items-center">
                            <button class="btn btn-sm btn-outline-primary">
                                👍 Curtir
                            </button>
                            <span class="badge bg-light text-dark border">15
                                Curtidas</span>
                        </div>
                    </div>
                </div>

                <div class="card post-card shadow-sm">
                    <div class="card-body">
                        <div class="d-flex mb-3">
                            <div class="user-img me-2 bg-success"></div>
                            <div>
                                <h6 class="mb-0 fw-bold">Aluno_Dedicado</h6>
                                <small class="text-muted">Postado há 1 hora</small>
                            </div>
                        </div>
                        <p class="card-text text-secondary">
                            Alguém mais está ansioso para aprender a usar a tabela-pivo de
                            likes?
                        </p>
                        <hr>
                        <div class="d-flex justify-content-between align-items-center">
                            <button class="btn btn-sm btn-primary">
                                ❤ Curtiu
                            </button>
                            <span class="badge bg-light text-dark border">8
                                Curtidas</span>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js
"></script>
</body>

</html>