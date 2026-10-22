
<?php
require_once 'config/conexao.php';

function escapar($valor) {
    return htmlspecialchars((string) $valor, ENT_QUOTES, 'UTF-8');
}

$busca = trim($_GET['busca'] ?? '');

if ($busca !== '') {
    $sql = "SELECT * FROM produtos
            WHERE nome LIKE ? OR codigo LIKE ?
            ORDER BY id DESC";

    $stmt = $pdo->prepare($sql);
    $termo = '%' . $busca . '%';
    $stmt->execute([$termo, $termo]);
} else {
    $sql = "SELECT * FROM produtos ORDER BY id DESC";
    $stmt = $pdo->query($sql);
}

$produtos = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="pt-BR">
<<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Controle de Estoque</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

    <h1>Sistema de Controle de Estoque</h1>

    <?php if (isset($_GET['sucesso'])): ?>
        <p>Produto cadastrado com sucesso!</p>
    <?php endif; ?>

    <?php if (isset($_GET['editado'])): ?>
        <p>Produto atualizado com sucesso!</p>
    <?php endif; ?>

    <?php if (isset($_GET['excluido'])): ?>
        <p>Produto excluído com sucesso!</p>
    <?php endif; ?>

    <?php if (isset($_GET['erro'])): ?>
        <p>Não foi possível realizar a operação.</p>
    <?php endif; ?>

    <p>
        <a href="cadastro.php">+ Cadastrar Produto</a>
    </p>

    <h2>Produtos cadastrados</h2>

    <form method="GET" action="index.php">
        <input
            type="text"
            name="busca"
            placeholder="Pesquisar por nome ou código..."
            value="<?= escapar($busca) ?>"
        >

        <button type="submit">Buscar</button>
        <a href="index.php">Limpar busca</a>
    </form>

    <br>

    <?php if (count($produtos) > 0): ?>

        <table border="1" cellpadding="10">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Código</th>
                    <th>Nome</th>
                    <th>Descrição</th>
                    <th>Preço</th>
                    <th>Quantidade</th>
                    <th>Ações</th>
                </tr>
            </thead>

            <tbody>
                <?php foreach ($produtos as $produto): ?>
                    <tr>
                        <td><?= escapar($produto['id']) ?></td>
                        <td><?= escapar($produto['codigo']) ?></td>
                        <td><?= escapar($produto['nome']) ?></td>
                        <td><?= escapar($produto['descricao']) ?></td>
                        <td>R$ <?= number_format((float) $produto['preco'], 2, ',', '.') ?></td>
                        <td><?= escapar($produto['quantidade']) ?></td>
                        <td>
                            <a href="editar.php?id=<?= (int) $produto['id'] ?>">Editar</a>

                            <form action="excluir.php" method="POST"
                                  style="display:inline"
                                  onsubmit="return confirm('Deseja realmente excluir este produto?');">

                                <input type="hidden" name="id"
                                       value="<?= (int) $produto['id'] ?>">

                                <button type="submit">Excluir</button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

    <?php else: ?>
        <p>
            <?= $busca !== ''
                ? 'Nenhum produto encontrado para essa pesquisa.'
                : 'Nenhum produto cadastrado.' ?>
        </p>
    <?php endif; ?>

    <p>Total de resultados: <?= count($produtos) ?></p>

</body>
</html>
