## 📱 Rede Social CodeShare

Uma aplicação simples de rede social desenvolvida em **PHP** com o framework **CodeIgniter 4** e banco de dados **MySQL**.  
O sistema permite cadastro de usuários, criação de postagens e interação através de likes.

---
> [!IMPORTANT]
[![Status](https://img.shields.io/badge/Status-Em%20Desenvolvimento-yellow?style=for-the-badge&logo=github)]()

> ⚠️🚧 **Aviso: Este projeto ainda está em desenvolvimento.**

> Funcionalidades podem mudar, novas features serão adicionadas e a estrutura pode sofrer ajustes.

---

## 🚀 Tecnologias utilizadas

[![PHP](https://img.shields.io/badge/PHP-777BB4?style=for-the-badge&logo=php&logoColor=white)](https://www.php.net/)
[![CodeIgniter](https://img.shields.io/badge/CodeIgniter-EF4223?style=for-the-badge&logo=codeigniter&logoColor=white)](https://codeigniter.com/)
![Bootstrap](https://img.shields.io/badge/Bootstrap-5.3-563D7C?style=for-the-badge&logo=bootstrap&logoColor=white)
[![MySQL](https://img.shields.io/badge/MySQL-4479A1?style=for-the-badge&logo=mysql&logoColor=white)](https://www.mysql.com/)
[![phpMyAdmin](https://img.shields.io/badge/phpMyAdmin-6C78AF?style=for-the-badge&logo=phpmyadmin&logoColor=white)](https://www.phpmyadmin.net/)
[![Laragon](https://img.shields.io/badge/Laragon-0E83CD?style=for-the-badge&logo=laragon&logoColor=white)](https://laragon.org/)

---

## 📂 Estrutura do banco de dados

### Tabela `usuarios`
- `id` (PK, auto increment)
- `nome`
- `email` (único)
- `senha`
- `created_at`

### Tabela `postagens`
- `id` (PK, auto increment)
- `usuario_id` (FK → usuarios.id)
- `texto`
- `created_at`

### Tabela `likes`
- `id` (PK, auto increment)
- `usuario_id` (FK → usuarios.id)
- `postagem_id` (FK → postagens.id)
- `created_at`

---

## ⚙️ Configuração do ambiente

1. Clone o repositório
```bash
   git clone https://github.com/Rayck4dev/rede-social-codeshare.git
```

2. Configure o arquivo .env:
```bash
CI_ENVIRONMENT = development
app.baseURL = 'http://rede-social.test/'

database.default.hostname = localhost
database.default.database = academico_net
database.default.username = root
database.default.password =
database.default.DBDriver = MySQLi
database.default.port = 3306
```

3. Execute as migrations:
```bash
php spark migrate
```

## ▶️ Como rodar

1. No terminal:
```bash
php spark migrate
```

2. Acesse no navegador:
```bash
http://rede-social.test/
```

> Desenvolvido com muuuito ☕ e noites mal dormidas 🫩!!
