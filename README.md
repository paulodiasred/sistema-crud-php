# **Sistema CRUD de Gerenciamento de Usuários**

Um sistema desenvolvido para realizar operações de **CRUD** (Criar, Ler, Atualizar e Excluir) em um banco de dados, utilizando **PHP** e **MySQL**. Este projeto é ideal para aprender e aplicar conceitos fundamentais de desenvolvimento web e manipulação de banco de dados.

---

## **📋 Funcionalidades**
- **Criar:** Adicione novos usuários com informações como nome, e-mail e telefone.
- **Ler:** Visualize todos os usuários cadastrados em uma tabela dinâmica.
- **Atualizar:** Edite os dados de qualquer usuário.
- **Excluir:** Remova registros de usuários.
- **Busca Dinâmica:** Filtre usuários por nome ou e-mail.
- **Paginação:** Organize a exibição de registros com navegação entre páginas.
- **Autenticação:** Sistema seguro de login com hashing de senha.
- **Logout:** Finalize a sessão de forma segura.

---

## **🛠️ Tecnologias Utilizadas**
- **Back-End:**
  - PHP 7.4+ para lógica de aplicação.
  - MySQL para armazenamento de dados.
- **Front-End:**
  - HTML5, CSS3 para estrutura e estilo.
  - Font Awesome para ícones.
- **Ferramentas:**
  - XAMPP para rodar o servidor local.
  - phpMyAdmin para gerenciar o banco de dados.

---

## **⚙️ Pré-Requisitos**
Antes de começar, você precisará ter as seguintes ferramentas instaladas no seu ambiente de desenvolvimento:
- [XAMPP](https://www.apachefriends.org/index.html) ou WAMP (servidor local).
- Navegador atualizado (Google Chrome, Firefox, etc.).
- Editor de código como [VS Code](https://code.visualstudio.com/).

---

## **🚀 Como Rodar o Projeto**
1. **Clone este repositório**:
   ```bash
   git clone https://github.com/seu-usuario/sistema-crud.git
2. **Inicie o servidor local (XAMPP ou similar):**
- Certifique-se de que o Apache e o MySQL estão ativos.
  
3. **Configure o Banco de Dados:**
- Acesse o phpMyAdmin (http://localhost/phpmyadmin).
- Crie um banco de dados chamado sistema_crud.
- Importe o arquivo database.sql fornecido no projeto para criar as tabelas.

4. **Edite o arquivo de configuração do banco:**
- Abra o arquivo src/db_config.php e ajuste os parâmetros de conexão:
```bash
$host = "localhost";
$username = "root";
$password = ""; // Senha padrão do XAMPP
$database = "sistema_crud";
```
5. **Acesse o sistema:**
- Abra o navegador e acesse: http://localhost/sistema-crud/public/index.php.
- Faça login com as credenciais iniciais:
Usuário: admin
Senha: admin

## **🔒 Segurança**
- As senhas são armazenadas usando o algoritmo password_hash para garantir segurança.
- Todas as operações no banco de dados utilizam Prepared Statements para evitar injeção de SQL.
- 
## **📈 Futuras Melhorias**
Upload de Imagens:
- Permitir que os usuários façam upload de fotos de perfil.
Relatórios PDF:
- Geração de relatórios com os dados cadastrados.
Integração com APIs:
- Conectar a APIs externas para enriquecer os dados.
Responsividade:
- Adaptar o layout para dispositivos móveis.
