<?php
require_once "../src/Database/conecta.php";

require_once "../src/Models/usuario.php";

require_once "../src/Services/UsuarioServico.php"
;
require_once "../src/Helpers/Utils.php";

require_once  "../src/Services/AutenticacaoServico.php";

AutenticacaoServico::exigirLogin();

$id = isset($_GET['id']) ? Utils::sanitizar($_GET['id'], 'inteiro') : null;
$usuarioServico = new UsuarioServico();

if (!$id) {
    Utils::redirecionarPara('usuarios.php');
}

$usuario = $usuarioServico->buscarPorId($id);

if (!$usuario) {
    Utils::redirecionarPara('usuarios.php?msg=naoencontrado');
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $acao = $_POST['acao'] ?? null;

    if ($acao === 'voltar') {
        Utils::redirecionarPara('usuarios.php');
    }

    if ($acao === 'excluir' && $id) {
        $usuarioObj = new Usuario("", "", "", "");
        $usuarioObj->setId($id);

        try {
            $usuarioServico->excluir($usuarioObj);
            Utils::redirecionarPara('usuarios.php?msg=excluido');
        } catch (Exception $e) {
            $erro = "Erro ao excluir usuário: " . $e->getMessage();
        }
    }
}

require_once "../includes/cabecalho-admin.php";
?>


<div class="row">
    <article class="col-12 bg-white rounded shadow my-1 py-4">
        <h2 class="text-center">Excluir usuário</h2>

        <p class="text-center">
            Tem certeza que deseja excluir o usuário 
            <strong><?= htmlspecialchars($usuario['nome']) ?></strong>?
        </p>

        <form method="POST" class="text-center">
            <button type="submit" name="acao" value="voltar" class="btn btn-secondary">Voltar</button>
            <button type="submit" name="acao" value="excluir" class="btn btn-danger"
                onclick="return confirm('Tem certeza que deseja excluir o usuário <?= htmlspecialchars($usuario['nome']) ?>? Esta ação não pode ser desfeita!');">
                Excluir
            </button>
        </form>
    </article>
</div>

<?php
require_once "../includes/rodape-admin.php";
?>
