# 🚀 Guia de Deploy e Configuração - Kovarex v2.0

## Pré-Requisitos

- PHP 7.4 ou superior
- MySQL 5.7 ou superior
- Apache ou Nginx
- HTTPS habilitado em produção (recomendado)

---

## ⚙️ Configuração Inicial

### 1. Variáveis de Ambiente

Crie um arquivo `.env` na raiz do projeto com suas configurações:

```bash
cp .env.example .env
```

Edite o arquivo `.env`:

```
DB_HOST=localhost
DB_USER=seu_usuario_mysql
DB_PASSWORD=sua_senha_segura
DB_NAME=kovarex
```

**IMPORTANTE:** O arquivo `.env` está no `.gitignore` e NÃO deve ser commitado ao repositório.

---

### 2. Permissões de Arquivo

Defina permissões adequadas:

```bash
# Linux/Mac
chmod 755 ./
chmod 644 ./php/session/conexao_banco.php
chmod 755 ./files/
chmod 755 ./php/

# Windows (usando PowerShell Admin)
icacls "C:\xampp\htdocs\Kovarex" /grant Users:F /T
```

---

## 🔒 Checklist de Segurança Pré-Produção

- [ ] Criar arquivo `.env` com credenciais
- [ ] Verificar se `.env` está no `.gitignore`
- [ ] Habilitar HTTPS com certificado válido
- [ ] Desabilitar `display_errors` em `php.ini`
- [ ] Ativar logging de erros em arquivo
- [ ] Criar usuário MySQL dedicado com privilégios mínimos
- [ ] Fazer backup do banco de dados
- [ ] Testar fluxo de login completo
- [ ] Testar fluxo de cadastro
- [ ] Verificar se senhas são mínimo 8 caracteres
- [ ] Validar todos os formulários

---

## 🧪 Testes Recomendados

### Teste de SQL Injection (DEVE FALHAR)

```bash
# Tente no formulário de login
Email: admin' OR '1'='1
Senha: qualquer
# Resultado esperado: "E-mail ou senha incorretos"
```

### Teste de XSS (DEVE FALHAR)

```bash
# Tente no cadastro de departamento
Nome: <img src=x onerror="alert('XSS')">
# Resultado esperado: O JavaScript não será executado
```

### Teste de Session Fixation

```bash
# Verifique o PHPSESSID antes e depois do login
# Deve ser DIFERENTE após autenticação bem-sucedida
```

---

## 📊 Melhorias Implementadas

### Segurança
- ✅ Prepared Statements em 100% das queries
- ✅ Escape de XSS (htmlspecialchars)
- ✅ Session Regeneration após login
- ✅ Validação de entrada (email, números, cores)
- ✅ Autenticação com BCRYPT (cost: 12)
- ✅ Verificações de autorização (hierarquia)
- ✅ Credenciais em variáveis de ambiente

### Performance
- ✅ Charset UTF-8MB4
- ✅ Queries otimizadas (SELECT colunas específicas)
- ✅ Índices no banco (recomendado)
- ✅ Remoção de código desnecessário

### Qualidade
- ✅ Type casting de IDs (int)
- ✅ Logging de erros
- ✅ Tratamento de erros melhorado
- ✅ Mensagens de erro amigáveis

---

## 🔄 Migração de Dados (Se necessário)

Se você tem um sistema antigo rodando, consulte o arquivo `kovarex.sql` para entender a estrutura esperada.

```bash
mysql -u root -p kovarex < kovarex.sql
```

---

## 📞 Troubleshooting

### Erro: "Falha na conexão com o banco de dados"

1. Verifique se MySQL está rodando
2. Confirme credenciais em `.env`
3. Verifique se banco `kovarex` existe
4. Verifique permissões do usuário MySQL

```bash
# Teste conexão
mysql -h localhost -u seu_usuario -p -e "SELECT 1;"
```

### Erro: "Acesso não autorizado" (ERROR=401)

1. Limpe cookies do navegador
2. Faça logout completo e login novamente
3. Verifique hierarquia do usuário no banco

### Senha não funciona após alteração

1. Verifique se a senha tem mínimo 8 caracteres
2. Confirme se hash foi salvo corretamente
3. Limpe cache do navegador

---

## 🔐 Recomendações Futuras

### Implementar CSRF Token
```php
// Adicionar em todos os formulários
<input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token']; ?>">
```

### Implementar Rate Limiting
```php
// Limitar tentativas de login: máx 5 por IP a cada 15 min
```

### Adicionar HTTPS Headers
```php
header('Strict-Transport-Security: max-age=31536000');
header('X-Content-Type-Options: nosniff');
header('X-Frame-Options: SAMEORIGIN');
```

### Implementar 2FA
```php
// Google Authenticator ou SMS
```

### Adicionar Auditoria
```php
// Log de todas as ações de moderadores
// INSERT INTO auditlog (user_id, action, timestamp)
```

---

## 📈 Monitoramento

### Logs Importantes

Monitore estes arquivos para detectar problemas:

```bash
# PHP Error Log
tail -f /var/log/php-fpm.log

# MySQL Slow Log (queries > 2s)
tail -f /var/log/mysql/slow.log

# Apache/Nginx Access Log
tail -f /var/log/apache2/access.log
```

### Métricas a Acompanhar

- Taxa de erro de login
- Queries lentas (> 1s)
- Uso de memória PHP
- Quantidade de sessões ativas

---

## 🚀 Deployment com Git

```bash
# Clonar repositório
git clone https://github.com/odnols/Kovarex.git
cd Kovarex

# Criar arquivo .env (não fazer commit)
cp .env.example .env
nano .env  # Editar credenciais

# Instalar dependências (se houver)
composer install --no-dev  # Futuro

# Definir permissões
chmod 755 ./
chmod 755 ./files/

# Pronto para usar!
```

---

## 📋 Histórico de Versões

| Versão | Data | Alterações |
|--------|------|-----------|
| 2.0 | 2026-11-07 | Segurança, Otimização e Correções |
| 1.0 | - | Versão original |

---

**Última atualização:** 2026-11-07  
**Mantido por:** Tim de Desenvolvimento
