<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="WIDTH=device-width, INITIAL-SCALE=1.0">
    <title>RELATÓRIO DE NOTAS</title>
    <link rel="stylesheet" href="notas.css">
</head>
<body>
    <div class="report-container">
        <h1>RELATÓRIO DE NOTAS</h1>
        <p>DATA: <?php echo date('d/m/Y'); ?></p>

        <?php
        IF (isset($_POST['notas']) && is_array($_POST['notas'])) {
            $NOTAS_ALUNOS = $_POST['notas'];

            echo "<table>";
            echo "<thead><tr><th>ALUNO</th>";
            IF (!empty($NOTAS_ALUNOS)) {
                $NUM_AVALIACOES = count(reset($NOTAS_ALUNOS)['Avaliacao']);
                FOR ($I = 1; $I <= $NUM_AVALIACOES; $I++) {
                    echo "<th>AVALIAÇÃO $I</th>";
                }
                echo "<th>MÉDIA</th><th>SITUAÇÃO</th></tr></thead><tbody>";

                FOREACH ($NOTAS_ALUNOS AS $ALUNO_NOTAS) {
                    echo "<tr><td>" . htmlspecialchars($ALUNO_NOTAS['Aluno']) . "</td>";
                    $TOTAL_NOTAS = 0;
                    IF (isset($ALUNO_NOTAS['Avaliacao']) && is_array($ALUNO_NOTAS['Avaliacao'])) {
                        FOREACH ($ALUNO_NOTAS['Avaliacao'] AS $NOTA) {
                            echo "<td>" . htmlspecialchars($NOTA) . "</td>";
                            $TOTAL_NOTAS += $NOTA;
                        }
                        $MEDIA = count($ALUNO_NOTAS['Avaliacao']) > 0 ? round($TOTAL_NOTAS / count($ALUNO_NOTAS['Avaliacao']), 2) : 0;
                        echo "<td>" . $MEDIA . "</td>";
                        echo "<td>" . ($MEDIA >= 70 ? '<span class="aprovado">APROVADO</span>' : '<span class="reprovado">REPROVADO</span>') . "</td>";
                    } ELSE {
                        echo "<td colspan='" . ($NUM_AVALIACOES + 2) . "'>ERRO: NOTAS NÃO ENCONTRADAS.</td>";
                    }
                    echo "</tr>";
                }

                echo "</tbody></table>";
            } ELSE {
                echo "<p>NENHUM DADO DE ALUNO RECEBIDO.</p>";
            }

            echo "<pre>";
            print_r($_POST['notas']);
            echo "</pre>";
        } ELSE {
            echo "<p>NENHUM DADO ENVIADO.</p>";
        }
        ?>
    </div>
</body>
</html>
