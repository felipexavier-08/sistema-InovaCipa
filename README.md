# Sistema CIPA - Comissão Interna de Prevenção de Acidentes e Assédio

Um sistema complet para gestão de eleições da CIPA, desenvolvido em PHP com arquitetura MVC. Ideal para empresas que precisam automatizar e digitalizar o processo eleitoral das Comissões Internas de Prevenção de Acidentes.

## 🌟 Por que este projeto?

Este sistema nasceu da necessidade de modernizar o processo eleitoral da CIPA, que historicamente era feito manualmente com papel, urnas físicas e apuração manual. Com a digitalização, oferecemos:

- **🔄 Automação completa** do processo eleitoral
- **🔒 Segurança e transparência** na apuração
- **📱 Acessibilidade** para votação remota
- **📊 Gestão centralizada** de todo o ciclo eleitoral
- **📄 Documentação digital** e organizada

## 📋 Sumário

- [Visão Geral](#-visão-geral)
- [Funcionalidades](#-funcionalidades)
- [Stack Tecnológica](#-stack-tecnológica)
- [Segurança](#-segurança)


## 🎯 Visão Geral

O Sistema CIPA é uma plataforma web completa e open-source para automação do processo eleitoral das Comissões Internas de Prevenção de Acidentes. Desenvolvido com PHP e arquitetura MVC, o sistema gerencia todo o ciclo de vida das eleições, desde o cadastro de funcionários até a geração de documentação oficial.

### 🎯 Objetivos do Projeto

- **Digitalização completa** do processo eleitoral da CIPA
- **Transparência total** na apuração dos votos
- **Segurança robusta** no processo de votação
- **Automação inteligente** na geração de documentos
- **Gestão centralizada** de funcionários e eleições
- **Acessibilidade** para votação remota e híbrida

### 🏆 Benefícios

✅ **Redução de 90%** no tempo de apuração  
✅ **Eliminação total** de uso de papel  
✅ **Segurança criptografada** em todas as etapas  
✅ **Acesso 24/7** para eleitores  
✅ **Relatórios automáticos** e auditáveis  
✅ **Conformidade** com normas trabalhistas

## ✨ Funcionalidades

### 👤 Gestão de Funcionários
- **Cadastro completo** de funcionários com dados pessoais e profissionais
- **Autenticação segura** com senhas hash
- **Controle de acesso** diferenciado (Admin/Funcionário)
- **Geração automática** de códigos de votação
- **Importação por lote** via matrícula
- **Status de ativação** de funcionários

### 🗳️ Gestão de Eleições
- **Criação e configuração** de períodos eleitorais
- **Controle de status** (Aberta/Fechada/Encerrada)
- **Autorização/bloqueio** de votação em tempo real
- **Extensão de períodos** eleitorais
- **Dashboard administrativo** com estatísticas em tempo real

### 📋 Candidatura
- **Auto-candidatura** de funcionários
- **Cadastro administrativo** de candidatos
- **Upload de fotos** e informações
- **Geração de números** de candidato
- **Controle de elegibilidade**

### 🗳️ Sistema de Votação
- **Votação online segura** com autenticação
- **Interface intuitiva** para seleção de candidatos
- **Opção de voto branco/nulo**
- **Controle de dupla votação**
- **Comprovante de votação** gerado automaticamente
- **Reimpressão de comprovantes**

### 📊 Apuração e Resultados
- **Contagem automática** de votos
- **Estatísticas detalhadas** de participação
- **Relatórios de apuração**
- **Visualização em tempo real** do progresso

### 📄 Documentação
- **Geração de Atas** oficiais das eleições
- **Upload de Editais** e documentos
- **Envio automatizado** de documentos por email
- **Exportação em múltiplos formatos**

### 📧 Comunicação
- **Integração com Brevo API** para envio de emails
- **Notificações automáticas**
- **Comunicação em massa** com funcionários
- **Templates de email personalizados**

### 📅 Cronograma
- **Gestão de cronogramas** eleitorais
- **Exportação para Excel**
- **Visualização e edição** de datas importantes
- **Controle de prazos**

## 🛠 Stack Tecnológica

### Backend

- **PHP 8.0+** - Linguagem principal com orientação a objetos
- **MySQL/MariaDB 5.7+** - Banco de dados relacional robusto
- **Apache 2.4+** - Servidor web com mod_rewrite

### Frontend
- **HTML5** - Estrutura acessível e moderna
- **CSS3 Responsivo** - Design adaptável para todos os dispositivos
- **JavaScript Vanilla** - Interações dinâmicas sem dependências
- **Bootstrap Components** - Interface profissional e consistente

### APIs e Integrações

- **Brevo (Sendinblue)** - API para envio de emails transacionais
- **PHPMailer** - Biblioteca robusta para comunicação email

### Arquitetura e Padrões
- **MVC (Model-View-Controller)** - Separação clara de responsabilidades
- **DAO (Data Access Object)** - Camada de abstração de dados
- **Front Controller** - Padrão de roteamento centralizado
- **PSR-4 Autoloading** - Carregamento automático de classes

## 🔒 Segurança

### 🛡️ Medidas Implementadas

- **🔐 Hash de senhas** com algoritmos bcrypt/Argon2
- **🎫 Sessões PHP** com timeout e regeneração
- **👥 Controle de acesso** baseado em papéis (RBAC)
- **✅ Validação de entrada** e sanitização de dados
- **🛡️ Proteção CSRF** em todos os formulários
- **🚫 Bloqueio de arquivos** sensíveis via .htaccess
- **🔍 SQL Injection prevention** com prepared statements
- **📝 Auditoria completa** de logs e ações
