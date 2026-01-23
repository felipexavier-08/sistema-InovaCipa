<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="/code/cipa_t1/css/style.css">
    <link rel="stylesheet" href="/code/cipa_t1/css/dashboard.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inova CIPA - Dashboard</title>

</head>
<body>

    <div class="header">
        <div class="header-icon">✓</div>
        <div class="header-title">
            <h1>Inova CIPA</h1>
            <p>Comissão Interna de Prevenção de Acidentes e Assédio</p>
        </div>
        <div class="header-actions">
            <span style="color: rgba(255,255,255,0.9);"><?php echo htmlspecialchars($_SESSION['funcionario_logado']['nome_funcionario']); ?></span>
            <?php if (!empty($_SESSION['funcionario_logado']['cod_voto_funcionario']) && $_SESSION['funcionario_logado']['adm_funcionario'] != 1): ?>
                <span style="background-color: #28a745; color: white; padding: 4px 8px; border-radius: 4px; font-size: 0.85em; margin-right: 10px;">
                    🗳 Código: <?php echo htmlspecialchars($_SESSION['funcionario_logado']['cod_voto_funcionario']); ?>
                </span>
            <?php endif; ?>
            <a href="/code/cipa_t1/logout">Sair</a>
        </div>
    </div>

    <div class="container">
        <!-- Sistema de Alertas -->
        <?php include __DIR__ . '/../components/alerts.php'; ?>
        
        <!-- Dashboard Section -->
        <div class="dashboard-section">
            <h1>Dashboard</h1>
            
            <?php if (isset($_SESSION['dashboard_stats'])): ?>
                <?php $stats = $_SESSION['dashboard_stats']; ?>
                
                <!-- Stats Cards -->
                <div class="stats-grid">
                    <div class="stat-card">
                        <div class="stat-number"><?php echo $stats['total_funcionarios']; ?></div>
                        <div class="stat-label">Total de Funcionários</div>
                    </div>
                    
                    <?php if ($stats['eleicao_ativa']): ?>
                        <div class="stat-card">
                            <div class="stat-number"><?php echo $stats['eleicao_ativa']['total_candidatos']; ?></div>
                            <div class="stat-label">Candidatos Inscritos</div>
                        </div>
                        
                        <div class="stat-card">
                            <div class="stat-number"><?php echo $stats['total_votantes']; ?></div>
                            <div class="stat-label">Funcionários que Votaram</div>
                        </div>
                        
                        <div class="stat-card">
                            <div class="stat-number"><?php echo $stats['porcentagem_votantes']; ?>%</div>
                            <div class="stat-label">Taxa de Participação</div>
                        </div>
                    <?php endif; ?>
                </div>

                <?php if ($stats['eleicao_ativa']): ?>
                    <div class="dashboard-grid">
                        <!-- Eleição Info -->
                        <div class="dashboard-card">
                            <h3>Eleição Ativa</h3>
                            <div class="eleicao-info">
                                <p class="eleicao-titulo"><strong><?php echo htmlspecialchars($stats['eleicao_ativa']['titulo_documento']); ?></strong></p>
                                <p class="eleicao-periodo"><strong>Período:</strong> <?php echo date('d/m/Y', strtotime($stats['eleicao_ativa']['data_inicio_eleicao'])); ?> a <?php echo date('d/m/Y', strtotime($stats['eleicao_ativa']['data_fim_eleicao'])); ?></p>
                                <p class="eleicao-status"><strong>Status:</strong> <?php echo htmlspecialchars($stats['eleicao_ativa']['status_eleicao']); ?></p>
                                <p class="eleicao-candidatos"><strong>Candidatos:</strong> <?php echo $stats['eleicao_ativa']['total_candidatos']; ?></p>
                                <a href="/code/cipa_t1/eleicao/gerenciar" class="btn-manager">
                                    <button>Gerenciar Eleição</button>
                                </a>
                            </div>
                        </div>

                        <!-- Gráfico de Pizza -->
                        <div class="dashboard-card">
                            <h3>Participação na Eleição</h3>
                            
                            <div class="chart-container">
                                <canvas id="votacaoChart"></canvas>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>
            <?php endif; ?>
        </div>

        <!-- Management Section -->
        <div class="management-section">
            <h1>Gestão do Sistema</h1>
            <div class="cards-grid">
                <a href="/code/cipa_t1/funcionario/cadastrar" class="card">
                    <div class="card-icon">👤+</div>
                    <div class="card-title">Cadastrar Funcionário</div>
                    <div class="card-description">Adicione novos funcionários ao sistema</div>
                </a>

                <a href="/code/cipa_t1/funcionario/cadastrar-por-matricula" class="card">
                    <div class="card-icon">🔍</div>
                    <div class="card-title">Buscar por Funcionário</div>
                    <div class="card-description">Localize funcionário por matrícula e CPF</div>
                </a>

                <a href="/code/cipa_t1/funcionario/listar" class="card">
                    <div class="card-icon">👥</div>
                    <div class="card-title">Listar Funcionários</div>
                    <div class="card-description">Visualize todos os funcionários cadastrados</div>
                </a>

                <a href="/code/cipa_t1/documento/cadastrar" class="card">
                    <div class="card-icon">📄</div>
                    <div class="card-title">Cadastrar Documento</div>
                    <div class="card-description">Registre novos documentos no sistema</div>
                </a>

                <a href="/code/cipa_t1/documento/listar" class="card">
                    <div class="card-icon">📚</div>
                    <div class="card-title">Listar Documentos</div>
                    <div class="card-description">Acesse os documentos registrados</div>
                </a>

                <a href="/code/cipa_t1/eleicao/cadastrar" class="card">
                    <div class="card-icon">🗳️</div>
                    <div class="card-title">Cadastrar Eleição</div>
                    <div class="card-description">Configure uma nova eleição da CIPA</div>
                </a>

                <a href="/code/cipa_t1/candidato/cadastrar" class="card">
                    <div class="card-icon">🎯</div>
                    <div class="card-title">Cadastrar Candidato</div>
                    <div class="card-description">Registre candidatos para a eleição</div>
                </a>

                <a href="/code/cipa_t1/voto/listar-candidatos" class="card">
                    <div class="card-icon">📋</div>
                    <div class="card-title">Listar Candidatos</div>
                    <div class="card-description">Visualize os candidatos da eleição ativa</div>
                </a>

                <a href="/code/cipa_t1/ata/listar" class="card">
                    <div class="card-icon">📊</div>
                    <div class="card-title">Gerar ATA</div>
                    <div class="card-description">Gere ATA de eleições finalizadas</div>
                </a>
            </div>
        </div>
    </div>

    <?php if (isset($_SESSION['dashboard_stats']) && $_SESSION['dashboard_stats']['eleicao_ativa']): ?>
    <script>
        const stats = <?php echo json_encode($_SESSION['dashboard_stats']); ?>;
        
        // Dados para o gráfico de pizza
        const votantes = stats.total_votantes;
        const naoVotantes = stats.total_funcionarios - votantes;
        
        const ctx = document.getElementById('votacaoChart').getContext('2d');
        new Chart(ctx, {
            type: 'pie',
            data: {
                labels: ['Já Votaram', 'Ainda Não Votaram'],
                datasets: [{
                    data: [votantes, naoVotantes],
                    backgroundColor: [
                        '#f1c21a',  // Amarelo para quem já votou
                        '#6c757d'   // Cinza para quem não votou
                    ],
                    borderColor: [
                        '#ffffff',
                        '#ffffff'
                    ],
                    borderWidth: 2
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        position: 'bottom',
                        labels: {
                            padding: 20,
                            font: {
                                size: 14
                            }
                        }
                    },
                    tooltip: {
                        callbacks: {
                            label: function(context) {
                                const total = context.dataset.data.reduce((a, b) => a + b, 0);
                                const percentage = ((context.parsed / total) * 100).toFixed(1);
                                return context.label + ': ' + context.parsed + ' (' + percentage + '%)';
                            }
                        }
                    }
                }
            }
        });
    </script>
    <?php endif; ?>

</body>
</html>
