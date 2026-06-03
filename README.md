# 💎 RUBYE Store — E-commerce Full Stack

A **RUBYE Store** é um e-commerce full stack minimalista e autoral voltado para o mercado de moda urbana básica de alta qualidade. Este projeto foi desenvolvido como **Projeto Integrador (PI)** para o Centro Universitário Senac, integrando de ponta a ponta as disciplinas de desenvolvimento web backend, banco de dados em nuvem, segurança e infraestrutura devops.

---

## 🚀 Demonstração em Produção

A aplicação encontra-se implantada com CI/CD e pode ser acessada publicamente através dos seguintes links:
* **Aplicação Web (Render):** https://rubye-store.onrender.com
* **Banco de Dados (Aiven Cloud):** Instância gerenciada MySQL em Nuvem.

---

## 🛠️ Stack Tecnológica Obrigatória

Conforme as diretrizes das rúbricas de avaliação, o ecossistema do projeto foi construído utilizando:

* **Backend / API:** Framework Laravel 11 com padrão MVC e recursos nativos de segurança.
* **Frontend:** HTML5, JavaScript Moderno, Componentes Blade e estilização com utilitários Tailwind CSS v4.
* **Autenticação:** Laravel Breeze (sessões seguras, proteção contra CSRF, XSS e injeção de SQL).
* **Banco de Dados:** MySQL hospedado em Nuvem Relacional (Instância gerenciada Aiven Cloud).
* **Serviço de E-mail:** Resend API integrado via SMTP para disparos transacionais reais.
* **Gateway de Pagamento:** AbacatePay API integrado via HTTP Client para Checkout Transparente (PIX Dinâmico).

---

## 🔐 Funcionalidades Implementadas (Critérios de Aceitação)

### 1. Autenticação e Segurança
* **Cadastro & Login:** Validação estrita de e-mails duplicados e formato no frontend e backend (Form Requests).
* **Confirmação de E-mail Real:** Integração ativa com a API do Resend. Contas novas são bloqueadas via middleware `MustVerifyEmail` até a validação do token real enviado por e-mail.
* **Recuperação de Senha:** Fluxo completo e seguro de "Esqueci minha senha" integrado ao servidor SMTP do Resend.
* **Proteção de Rotas:** Telas de perfil, carrinho, checkout e gerenciamento protegidas por sessões autenticadas.

### 2. Experiência de Compra (Frontend & UI/UX)
* **Vitrine e Detalhes:** Navegação fluida por categorias, filtros dinâmicos de busca e tela detalhada do produto com controle inteligente de estoque crítico.
* **Produtos Relacionados:** Algoritmo integrado no Controller que recomenda automaticamente 4 produtos aleatórios pertencentes à mesma categoria do item visualizado.
* **Carrinho Completo:** Gerenciamento em sessão permitindo alteração de quantidade em tempo real, remoção de itens com modal de confirmação em Alpine.js e cálculo matemático preciso de subtotais e totais.
* **Checkout & Pagamento:** Resumo dinâmico da compra e integração via API com geração imediata de String Pix (Copia e Cola) e QR Code Base64 em tela através do modelo Checkout Transparente.
* **Central de Notificações:** Tela de perfil exclusiva que mapeia o histórico de pedidos e emite alertas dinâmicos de confirmação e alteração de status.
* **Responsividade:** Design Mobile-First adaptável para qualquer resolução utilizando utilitários responsivos e breakpoints do Tailwind.

### 3. Painel Administrativo (Gestão do Império)
* **Métricas em Tempo Real:** Gráfico dinâmico em Chart.js alimentado pelo banco de dados exibindo o faturamento dos últimos 7 dias, total de pedidos e alertas de estoque crítico.
* **CRUD Avançado:** Controle total de ativação/desativação de produtos e categorias, além de upload físico de imagens associadas.
* **Controle de Pedidos:** Tela de gerenciamento com filtros de status onde o Admin pode avançar manualmente as etapas logísticas do pedido de cada cliente.

---

## 💻 Instruções de Instalação e Execução Local

### Pré-requisitos
* PHP >= 8.2
* Composer
* Node.js & NPM
* Servidor MySQL (ou utilizar as credenciais de nuvem do projeto)

### Passo a Passo

1. Clonar o repositório:
   git clone https://github.com/theylorantunes/rubye-laravel_3.git
   cd rubye-laravel_3

2. Instalar as dependências do PHP (Composer):
   composer install

3. Instalar e compilar as dependências de assets (Vite):
   npm install
   npm run dev

4. Configurar as Variáveis de Ambiente:
   Copie o arquivo de exemplo e preencha suas credenciais de Banco de Dados, API Keys do AbacatePay e SMTP do Resend no arquivo `.env`:
   cp .env.example .env
   php artisan key:generate

5. Executar as Migrations e os Seeders (Cria as tabelas e o usuário Admin padrão):
   php artisan migrate --seed
   *Nota: O seeder criará o usuário admin padrão admin@rubye.com.*

6. Iniciar o Servidor Local:
   php artisan serve
   Acesse a aplicação através do endereço: http://localhost:8000

---

## 👥 Desenvolvedor do Projeto
* **Theylor Antunes Cruz** — Sistemas para Internet (Centro Universitário Senac)

---
*Este e-commerce foi desenvolvido exclusivamente para fins acadêmicos e avaliação de Projeto Integrador.*