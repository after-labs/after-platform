# After Platform

After Platform é uma plataforma web de distribuição digital voltada para jogos independentes.

O projeto simula uma operação completa de comercialização de licenças digitais, permitindo que jogadores descubram títulos, realizem compras, resgatem chaves de acesso e acompanhem seu histórico de pedidos, enquanto administradores gerenciam catálogo, estoque, usuários e operações da plataforma.

Mais do que uma simples loja virtual, o objetivo foi modelar fluxos comuns encontrados em marketplaces digitais modernos, incluindo gerenciamento de catálogo, checkout integrado, processamento de pedidos, distribuição automática de licenças digitais, sistema de recompensas e painel administrativo.

---

## Visão Geral

| Home                    | Catálogo                |
| ----------------------- | ----------------------- |
| <img width="1710" height="978" alt="after-home" src="https://github.com/user-attachments/assets/c7a94f29-5cd7-4be3-bd85-a69550e4bf49" /> | <img width="1710" height="978" alt="after-catalog" src="https://github.com/user-attachments/assets/e1e51f24-0f6b-4703-84b1-11f14dfe26c5" /> |



| Página do Jogo          | Cart                |
| ----------------------- | ----------------------- |
| <img width="1710" height="978" alt="after-game-detail" src="https://github.com/user-attachments/assets/95f96e5f-4436-4ac7-a97b-242fb953ff8b" /> | <img width="1710" height="978" alt="after-cart" src="https://github.com/user-attachments/assets/7a7b6ae6-d407-4904-8a7d-612a89639fc8" />

---

## Objetivo

O projeto foi desenvolvido como estudo de arquitetura web full-stack utilizando Laravel, buscando reproduzir componentes encontrados em plataformas reais de distribuição digital.

Durante o desenvolvimento foram explorados conceitos como:

* Arquitetura MVC com Laravel
* Modelagem relacional de marketplace digital
* Catálogo multi-plataforma
* Fluxo completo de carrinho e checkout
* Integração com gateway de pagamento
* Processamento automatizado de pedidos
* Distribuição de licenças digitais
* Controle de estoque
* Gamificação de usuários
* Painel administrativo
* Internacionalização (PT-BR / EN)

---

## Funcionalidades

### Experiência do Cliente

* Cadastro e autenticação de usuários
* Recuperação de senha
* Perfil do usuário
* Upload de avatar
* Catálogo completo de jogos
* Busca textual
* Filtros por categoria
* Filtros por gênero
* Filtros por plataforma
* Jogos gratuitos
* Jogos em promoção
* Lista de desejos (Wishlist)
* Carrinho de compras
* Checkout integrado
* Aplicação de cupons
* Utilização de moedas virtuais
* Histórico de pedidos
* Visualização de chaves adquiridas
* Sistema de notificações

---

### Sistema de Gamificação

A plataforma possui um sistema próprio de progressão de usuários.

A cada compra realizada o usuário recebe:

* Experiência
* Níveis
* Moedas virtuais

As moedas acumuladas podem ser utilizadas como desconto em futuras compras, criando um ciclo de retenção semelhante ao encontrado em programas de fidelidade.

---

### Distribuição Digital de Licenças

Após a confirmação do pagamento:

* O pedido é processado automaticamente
* Chaves disponíveis são reservadas
* As chaves são vinculadas ao pedido
* O usuário recebe acesso imediato às chaves adquiridas
* O sistema envia confirmação por e-mail

Caso não existam licenças suficientes em estoque, o pedido é colocado em estado de espera para posterior liberação.

---

### Painel Administrativo

| Dashboard Administrativo | Gestão de Jogos         |
| ------------------------ | ----------------------- |
| **[IMAGE_PLACEHOLDER]**  | **[IMAGE_PLACEHOLDER]** |

O painel administrativo permite:

* Gestão de usuários
* Controle de permissões
* Controle de status de contas
* Cadastro de jogos
* Edição de catálogo
* Gerenciamento de mídias
* Controle de versões e edições
* Controle de plataformas
* Gerenciamento de pedidos
* Atualização de status

---

## Arquitetura de Domínio

O domínio principal foi modelado em torno das seguintes entidades:

```text
Users
 ├── Gamification
 ├── Notifications
 ├── Wishlist
 ├── Cart
 └── Orders

Games
 ├── Categories
 ├── Genres
 ├── Media
 ├── Versions
 └── Platforms

Orders
 ├── Order Items
 ├── Coupons
 └── Access Keys

Access Keys
 ├── Available
 ├── Sold
 └── Expired
```

---

## Tecnologias

### Backend

* PHP 8+
* Laravel 12
* Eloquent ORM
* Laravel Breeze

### Frontend

* Blade Templates
* JavaScript
* CSS
* Vite

### Banco de Dados

* MySQL

### Integrações

* Stripe Checkout
* Stripe Webhooks

### Infraestrutura

* Docker
* Docker Compose

---

## Estrutura do Projeto

```text
app/
 ├── Http/
 ├── Models/
 ├── Middleware/
 └── Providers/

database/
 ├── migrations/
 └── seeders/

resources/
 ├── views/
 ├── css/
 ├── js/
 └── lang/

routes/

public/
```

---

## Principais Conceitos Técnicos Demonstrados

* Arquitetura MVC
* Relacionamentos complexos com Eloquent
* Middleware de autorização
* Controle de acesso por papéis
* Checkout transacional
* Integração com APIs externas
* Processamento assíncrono via Webhook
* Internacionalização
* Upload e gerenciamento de arquivos
* Boas práticas de organização Laravel
* Modelagem de marketplace digital

---

## Status

O projeto encontra-se funcional e em evolução contínua.

Novas funcionalidades planejadas incluem:

* Dashboard analítico
* Sistema de publishers
* Avaliações de jogos
* Biblioteca do usuário
* Métricas avançadas para administradores
* Pipeline CI/CD

---

## Autor

Desenvolvido por Rafael Reis como projeto de portfólio voltado para demonstração de competências em desenvolvimento web full-stack, arquitetura de aplicações Laravel e modelagem de produtos digitais.
