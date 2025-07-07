# Sistema de Busca de Produtos com Filtros Combinados

Este projeto implementa um mecanismo de busca de produtos utilizando Laravel, Livewire e Docker. Permite filtrar produtos por nome, categoria e marca, com persistência dos filtros e testes automatizados.

## Funcionalidades
- Busca por nome do produto
- Filtro por categoria
- Filtro por marca
- Filtros combinados (E)
- Persistência dos filtros na URL (query string)
- Limpar filtros
- Testes automatizados de feature (Livewire)

## Requisitos
- Docker e Docker Compose instalados

## Subindo o ambiente

1. **Clone o repositório:**
   ```bash
   git clone <repo-url>
   cd <nome-do-projeto>
   ```

2. **Suba os containers:**
   ```bash
   docker-compose up -d --build
   ```

3. **Acesse o container app:**
   ```bash
   docker-compose exec app bash
   ```

4. **Instale as dependências:**
   ```bash
   composer install
   ```

5. **Copie o .env e gere a key:**
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```

6. **Rode as migrations e seeders:**
   ```bash
   php artisan migrate:fresh --seed
   ```

7. **Acesse o sistema:**
   Abra [http://localhost:8800](http://localhost:8800) no navegador.

## Utilização
- A busca pode ser feita por nome do produto, categoria(s) e marca(s) ao mesmo tempo.
- É possível selecionar mais de uma categoria e/ou marca.
- Os filtros são persistentes na URL (query string).
- O botão "Limpar filtros" remove todos os filtros aplicados.

# Testes do Sistema

Este projeto inclui uma suíte completa de testes unitários e de feature para garantir a qualidade e funcionalidade do sistema.

## Estrutura dos Testes

### Testes Unitários (`tests/Unit/`)

- **ProdutoTest.php**: Testa o model Produto
  - Criação de produtos
  - Relacionamentos com Categoria e Marca
  - Campos fillable

- **CategoriaTest.php**: Testa o model Categoria
  - Criação de categorias
  - Relacionamento hasMany com Produtos
  - Campos fillable

- **MarcaTest.php**: Testa o model Marca
  - Criação de marcas
  - Relacionamento hasMany com Produtos
  - Campos fillable

### Testes de Feature (`tests/Feature/`)

- **ProdutoControllerTest.php**: Testa todas as rotas CRUD do ProdutoController
  - Index, create, store, show, edit, update, destroy
  - Validação de campos obrigatórios

- **CategoriaControllerTest.php**: Testa todas as rotas CRUD do CategoriaController
  - Index, create, store, show, edit, update, destroy
  - Validação de campos obrigatórios

- **MarcaControllerTest.php**: Testa todas as rotas CRUD do MarcaController
  - Index, create, store, show, edit, update, destroy
  - Validação de campos obrigatórios

- **RouteTest.php**: Testa a disponibilidade das rotas
  - Verifica se todas as rotas estão funcionando
  - Testa rotas inexistentes (404)

- **ValidationTest.php**: Testa as regras de validação
  - Validação de campos obrigatórios
  - Validação de tamanho máximo de campos
  - Validação de campos únicos
  - Validação de foreign keys

- **DatabaseTest.php**: Testa a integridade do banco de dados
  - Relacionamentos entre tabelas
  - Constraints de chaves estrangeiras
  - Integridade dos dados

## Como Executar os Testes

### Executar Todos os Testes
```bash
php artisan test
```

### Executar Apenas Testes Unitários
```bash
php artisan test --testsuite=Unit
```

### Executar Apenas Testes de Feature
```bash
php artisan test --testsuite=Feature
```

### Executar Testes Específicos
```bash
# Teste específico
php artisan test tests/Unit/ProdutoTest.php

# Método específico
php artisan test --filter test_can_create_produto
```

### Executar com Cobertura de Código
```bash
# Se você tiver o Xdebug instalado
php artisan test --coverage
```

### Executar Testes em Paralelo (Laravel 9+)
```bash
php artisan test --parallel
```

## Configuração do Ambiente de Teste

O projeto está configurado para usar:
- **Banco de dados**: SQLite em memória (`:memory:`)
- **Cache**: Array (em memória)
- **Sessão**: Array (em memória)
- **Mail**: Array (em memória)

Isso garante que os testes sejam rápidos e não afetem o banco de dados de desenvolvimento.

## Cobertura dos Testes

Os testes cobrem:

### Models (100%)
- ✅ Criação de registros
- ✅ Relacionamentos
- ✅ Campos fillable
- ✅ Validações

### Controllers (100%)
- ✅ Todas as rotas CRUD
- ✅ Validação de entrada
- ✅ Redirecionamentos
- ✅ Mensagens de sucesso/erro

### Rotas (100%)
- ✅ Disponibilidade de todas as rotas
- ✅ Tratamento de rotas inexistentes

### Validação (100%)
- ✅ Campos obrigatórios
- ✅ Tamanho máximo de campos
- ✅ Campos únicos
- ✅ Foreign keys válidas

### Banco de Dados (100%)
- ✅ Integridade referencial
- ✅ Constraints de unicidade
- ✅ Relacionamentos
- ✅ Timestamps

## Boas Práticas Implementadas

1. **RefreshDatabase**: Cada teste usa um banco limpo
2. **Factories**: Dados de teste gerados automaticamente
3. **Seeders**: Dados iniciais carregados quando necessário
4. **Assertions específicas**: Testes verificam comportamento exato
5. **Isolamento**: Testes não dependem uns dos outros
6. **Nomenclatura clara**: Nomes de métodos descritivos