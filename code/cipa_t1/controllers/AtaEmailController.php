<?php
    require_once __DIR__ . "/../repositories/EleicaoDAO.php";
    require_once __DIR__ . "/../repositories/CandidatoDAO.php";
    require_once __DIR__ . "/../repositories/VotoDAO.php";
    require_once __DIR__ . "/../repositories/FuncionarioDAO.php";
    require_once __DIR__ . "/../utils/EmailServiceBrevo.php";

    class AtaEmailController {
        private $eleicaoDAO;
        private $candidatoDAO;
        private $votoDAO;
        private $funcionarioDAO;
        private $emailService;

        public function __construct() {
            if (session_status() === PHP_SESSION_NONE) {
                session_start();
            }
            $this->eleicaoDAO = new EleicaoDAO();
            $this->candidatoDAO = new CandidatoDAO();
            $this->votoDAO = new VotoDAO();
            $this->funcionarioDAO = new FuncionarioDAO();
            $this->emailService = new EmailServiceBrevo();
        }

        public function enviarAtaParaFuncionarios($requisicao) {
            // Verificar se é admin
            if (!isset($_SESSION['funcionario_logado']) || $_SESSION['funcionario_logado']['adm_funcionario'] != 1) {
                header("Location: /code/cipa_t1/login");
                exit;
            }

            if($requisicao == "POST") {
                $idEleicao = $_POST['id_eleicao'] ?? '';
                
                if(empty($idEleicao)) {
                    $_SESSION['erro_ata'] = "Eleição não especificada.";
                    header("Location: /code/cipa_t1/ata/gerar?eleicao=" . $idEleicao);
                    exit;
                }

                // Verificar se eleição terminou
                if (!$this->eleicaoDAO->eleicaoTerminou($idEleicao)) {
                    $_SESSION['erro_ata'] = "Esta eleição ainda não foi finalizada.";
                    header("Location: /code/cipa_t1/ata/gerar?eleicao=" . $idEleicao);
                    exit;
                }

                // Buscar dados da eleição
                $eleicao = $this->eleicaoDAO->buscarPorId($idEleicao);
                if (!$eleicao) {
                    $_SESSION['erro_ata'] = "Eleição não encontrada.";
                    header("Location: /code/cipa_t1/ata/gerar?eleicao=" . $idEleicao);
                    exit;
                }

                // Buscar funcionários para envio da ATA
                $funcionarios = $this->funcionarioDAO->buscarTodos();
                
                // Buscar dados para a ATA
                $candidatos = $this->candidatoDAO->buscarResultadosPorEleicao($idEleicao);
                $brancosNulos = $this->votoDAO->buscarBrancosENulos($idEleicao);
                $totalVotos = $this->votoDAO->contarTotalVotos($idEleicao);
                
                // Preparar tabela de resultados
                $tabelaResultados = "<table style='width: 100%; border-collapse: collapse; margin: 10px 0;'>";
                $tabelaResultados .= "<thead><tr style='background: #4b5c49; color: white;'>";
                $tabelaResultados .= "<th style='padding: 10px; border: 1px solid #ddd; text-align: left;'>Posição</th>";
                $tabelaResultados .= "<th style='padding: 10px; border: 1px solid #ddd; text-align: left;'>Número</th>";
                $tabelaResultados .= "<th style='padding: 10px; border: 1px solid #ddd; text-align: left;'>Candidato</th>";
                $tabelaResultados .= "<th style='padding: 10px; border: 1px solid #ddd; text-align: left;'>Votos</th>";
                $tabelaResultados .= "</tr></thead><tbody>";
                
                $posicao = 1;
                foreach ($candidatos as $candidato) {
                    $tabelaResultados .= "<tr>";
                    $tabelaResultados .= "<td style='padding: 8px; border: 1px solid #ddd; font-weight: bold;'>{$posicao}º</td>";
                    $tabelaResultados .= "<td style='padding: 8px; border: 1px solid #ddd;'>" . htmlspecialchars($candidato['numero_candidato']) . "</td>";
                    $tabelaResultados .= "<td style='padding: 8px; border: 1px solid #ddd;'>" . htmlspecialchars($candidato['nome_funcionario'] . ' ' . $candidato['sobrenome_funcionario']) . "</td>";
                    $tabelaResultados .= "<td style='padding: 8px; border: 1px solid #ddd; text-align: center; font-weight: bold;'>" . htmlspecialchars($candidato['quantidade_voto_candidato']) . "</td>";
                    $tabelaResultados .= "</tr>";
                    $posicao++;
                }
                
                $tabelaResultados .= "</tbody></table>";
                
                // Preparar dados da ATA
                $dadosAta = [
                    'titulo_documento' => $eleicao['titulo_documento'],
                    'periodo' => date('d/m/Y', strtotime($eleicao['data_inicio_eleicao'])) . ' a ' . date('d/m/Y', strtotime($eleicao['data_fim_eleicao'])),
                    'data_finalizacao' => date('d/m/Y H:i:s'),
                    'total_votantes' => $totalVotos,
                    'votos_brancos' => $brancosNulos['quantidade_branco'] ?? 0,
                    'votos_nulos' => $brancosNulos['quantidade_nulo'] ?? 0,
                    'votos_validos' => $totalVotos - ($brancosNulos['quantidade_branco'] ?? 0) - ($brancosNulos['quantidade_nulo'] ?? 0),
                    'tabela_resultados' => $tabelaResultados
                ];
                
                // Enviar ATA para todos os funcionários
                $resultadoEmail = $this->emailService->enviarAtaParaTodosFuncionarios($funcionarios, $dadosAta);
                
                if ($resultadoEmail && $resultadoEmail['enviados'] > 0) {
                    $_SESSION['sucesso_ata'] = "ATA enviada com sucesso para {$resultadoEmail['enviados']} funcionários!";
                    if ($resultadoEmail['falhas'] > 0) {
                        $_SESSION['sucesso_ata'] .= " ({$resultadoEmail['falhas']} falhas no envio)";
                    }
                } else {
                    $_SESSION['erro_ata'] = "Erro ao enviar ATA para os funcionários.";
                }
                
                header("Location: /code/cipa_t1/ata/gerar?eleicao=" . $idEleicao);
                exit;
            }
        }
    }
?>
