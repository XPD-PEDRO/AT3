<?php
include("../conexao.php");

session_start();

if (!isset($_SESSION['usuario'])) {
    header("Location: ../login.php");
    exit;
}

$mensagem = '';
$tipoMensagem = '';

if (isset($_GET['status'])) {
    if ($_GET['status'] == 'sucesso') {
        $mensagem = 'Tarefa cadastrada com sucesso!';
        $tipoMensagem = 'sucesso';
    } elseif ($_GET['status'] == 'atualizado') {
        $mensagem = 'Tarefa atualizada com sucesso!';
        $tipoMensagem = 'sucesso';
    } elseif ($_GET['status'] == 'excluido') {
        $mensagem = 'Tarefa excluída com sucesso!';
        $tipoMensagem = 'sucesso';
    } elseif ($_GET['status'] == 'erro') {
        $mensagem = 'Ocorreu um erro na operação.';
        $tipoMensagem = 'erro';
    }
}

$sqlTotal = "SELECT * FROM tarefas";
$resultTotal = mysqli_query($conn, $sqlTotal);
$total = mysqli_num_rows($resultTotal);
?>
<!DOCTYPE html>
<html class="light" lang="pt-br">
<head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <title>TECH SOLUTIONS - Gerenciamento de Tarefas</title>
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&display=swap" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet" />
    <script id="tailwind-config">
        tailwind.config = {
            darkMode: "class",
            theme: {
                extend: {
                    colors: {
                        "background": "#f6faff",
                        "on-primary": "#ffffff",
                        "primary-container": "#171a4a",
                        "secondary-container": "#ffd259",
                        "on-surface-variant": "#46464f",
                        "surface": "#f6faff",
                        "error": "#ba1a1a",
                        "error-container": "#ffdad6",
                        "primary": "#000032",
                        "secondary": "#765b00",
                        "surface-container-lowest": "#ffffff",
                        "surface-container-low": "#ecf5fe",
                        "surface-container": "#e6eff8",
                        "surface-container-high": "#e0e9f2"
                    },
                    fontFamily: {
                        "body-md": ["Inter"],
                    }
                }
            }
        }
    </script>
    <style>
        .material-symbols-outlined {
            font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24;
            vertical-align: middle;
        }
        .modal-overlay {
            display: none;
            background: rgba(0, 0, 0, 0.5);
            backdrop-filter: blur(4px);
        }
        .modal-overlay.active {
            display: flex;
        }
    </style>
</head>

<body class="bg-background font-body-md text-on-background">

    <aside class="fixed h-screen w-[280px] left-0 top-0 hidden lg:flex flex-col bg-primary-container shadow-lg z-50">
        <div class="flex flex-col h-full py-6">
            <div class="px-6 mb-8 flex items-center gap-3">
                <div class="w-10 h-10 bg-secondary-container rounded-lg flex items-center justify-center">
                    <span class="material-symbols-outlined text-on-secondary-container" style="font-variation-settings:'FILL' 1;">domain</span>
                </div>
                <div>
                    <h1 class="font-bold text-lg text-on-primary uppercase">Tech Solutions</h1>
                    <p class="text-xs text-on-primary/60 tracking-widest">Enterprise System</p>
                </div>
            </div>
            <nav class="flex-1 space-y-1">
                <a class="flex items-center gap-3 px-6 py-3 text-on-primary/60 hover:bg-white/5 hover:text-on-primary transition-all" href="../dashboard.php">
                    <span class="material-symbols-outlined">group</span>
                    <span>Usuários</span>
                </a>
                <a class="flex items-center gap-3 px-6 py-3 text-on-primary bg-white/10 border-l-4 border-secondary-container transition-all" href="listar.php">
                    <span class="material-symbols-outlined">task</span>
                    <span>Tarefas</span>
                </a>
            </nav>
            <div class="px-4 mt-auto">
                <a href="../logout.php" class="w-full flex items-center gap-3 px-4 py-3 text-on-primary/60 hover:bg-white/5 hover:text-on-primary transition-all rounded-lg">
                    <span class="material-symbols-outlined">logout</span>
                    <span>Sair</span>
                </a>
            </div>
        </div>
    </aside>

    <header class="fixed top-0 right-0 w-full lg:w-[calc(100%-280px)] h-16 bg-surface shadow-sm z-40 border-b border-gray-200">
        <div class="flex justify-between items-center px-6 h-full">
            <div class="flex items-center gap-4 flex-1">
                <div class="relative w-full max-w-md">
                    <span class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-on-surface-variant">search</span>
                    <input class="w-full pl-10 pr-4 py-2 bg-surface-container-low border rounded-lg outline-none text-sm" id="searchBar" placeholder="Buscar tarefas..." type="text" />
                </div>
            </div>
            <div class="flex items-center gap-4">
                <div class="text-right hidden sm:block">
                    <p class="text-sm font-bold text-primary"><?= htmlspecialchars($_SESSION['usuario']) ?></p>
                    <p class="text-xs text-on-surface-variant">Administrador</p>
                </div>
                <div class="w-10 h-10 rounded-full border-2 border-secondary-container bg-primary-container flex items-center justify-center">
                    <span class="material-symbols-outlined text-on-primary text-xl" style="font-variation-settings:'FILL' 1;">person</span>
                </div>
            </div>
        </div>
    </header>

    <main class="pt-24 pb-12 px-6 lg:px-10 ml-0 lg:ml-[280px] min-h-screen">
        <?php if ($mensagem): ?>
            <div class="mb-6 flex items-center gap-3 px-5 py-4 rounded-xl border font-medium text-sm
                <?= $tipoMensagem === 'sucesso' ? 'bg-green-50 border-green-200 text-green-800' : 'bg-error-container border-error text-error' ?>">
                <span class="material-symbols-outlined text-xl"><?= $tipoMensagem === 'sucesso' ? 'check_circle' : 'error' ?></span>
                <?= htmlspecialchars($mensagem) ?>
            </div>
        <?php endif; ?>

        <div class="bg-surface-container-lowest rounded-2xl border shadow-sm overflow-hidden">
            <div class="p-6 border-b flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
                <div>
                    <h2 class="text-xl font-bold text-primary">Gerenciamento de Tarefas</h2>
                    <p class="text-sm text-on-surface-variant">Controle das demandas da Tech Solutions.</p>
                </div>
                <button onclick="abrirModalNovo()" class="flex items-center gap-2 bg-secondary hover:bg-secondary/90 text-white font-bold px-6 py-2.5 rounded-lg shadow-md transition-all">
                    <span class="material-symbols-outlined">add</span> Nova Tarefa
                </button>
            </div>

            <?php if ($total === 0): ?>
                <div class="flex flex-col items-center justify-center py-20 text-on-surface-variant gap-3">
                    <span class="material-symbols-outlined text-6xl opacity-30">task</span>
                    <p class="text-lg font-medium">Nenhuma tarefa encontrada.</p>
                </div>
            <?php else: ?>
                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse" id="dataTable">
                        <thead class="bg-surface-container-low">
                            <tr>
                                <th class="px-6 py-4 text-xs font-bold text-on-surface-variant uppercase">ID</th>
                                <th class="px-6 py-4 text-xs font-bold text-on-surface-variant uppercase">Título</th>
                                <th class="px-6 py-4 text-xs font-bold text-on-surface-variant uppercase">Data</th>
                                <th class="px-6 py-4 text-xs font-bold text-on-surface-variant uppercase">Status</th>
                                <th class="px-6 py-4 text-xs font-bold text-on-surface-variant uppercase">Ações</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200">
                            <?php
                            $sql = "SELECT * FROM tarefas ORDER BY data_tarefa ASC";
                            $result = mysqli_query($conn, $sql);
                            while ($row = mysqli_fetch_assoc($result)) {
                                $dataFormatada = date("d/m/Y", strtotime($row['data_tarefa']));
                                
                                $statusClass = "bg-gray-100 text-gray-800";
                                if ($row['status'] == 'Pendente') $statusClass = "bg-yellow-100 text-yellow-800 border border-yellow-200";
                                if ($row['status'] == 'Em andamento') $statusClass = "bg-blue-100 text-blue-800 border border-blue-200";
                                if ($row['status'] == 'Concluído') $statusClass = "bg-green-100 text-green-800 border border-green-200";
                            ?>
                                <tr class="hover:bg-gray-50 transition-colors">
                                    <td class="px-6 py-4 text-sm font-medium">#<?= $row['id'] ?></td>
                                    <td class="px-6 py-4">
                                        <p class="text-sm font-bold text-primary"><?= htmlspecialchars($row['titulo']) ?></p>
                                        <p class="text-xs text-gray-500 truncate max-w-[250px]"><?= htmlspecialchars($row['descricao']) ?></p>
                                    </td>
                                    <td class="px-6 py-4 text-sm"><?= $dataFormatada ?></td>
                                    <td class="px-6 py-4">
                                        <span class="px-3 py-1 rounded-full text-xs font-bold <?= $statusClass ?>">
                                            <?= htmlspecialchars($row['status']) ?>
                                        </span>
                                    </td>
                                    <td class="px-6 py-4">
                                        <div class="flex items-center gap-2">
                                            <button onclick="abrirModalEditar(<?= $row['id'] ?>, '<?= addslashes($row['titulo']) ?>', '<?= addslashes(str_replace(array("\r", "\n"), array('\r', '\n'), $row['descricao'])) ?>', '<?= $row['data_tarefa'] ?>', '<?= $row['status'] ?>')" class="p-2 text-primary hover:bg-gray-200 rounded-lg">
                                                <span class="material-symbols-outlined text-[20px]">edit</span>
                                            </button>
                                            <button onclick="confirmarExclusao(<?= $row['id'] ?>, '<?= addslashes($row['titulo']) ?>')" class="p-2 text-error hover:bg-red-100 rounded-lg">
                                                <span class="material-symbols-outlined text-[20px]">delete</span>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            <?php endif; ?>
        </div>
    </main>

    <div class="modal-overlay fixed inset-0 z-[100] items-center justify-center p-4" id="modalNovo">
        <div class="bg-surface-container-lowest w-full max-w-md rounded-2xl shadow-2xl overflow-hidden border">
            <div class="bg-primary-container p-6 text-on-primary flex justify-between items-center">
                <h3 class="text-xl font-bold">Adicionar Tarefa</h3>
                <button onclick="fecharModal('modalNovo')" class="hover:bg-white/10 p-1 rounded-full"><span class="material-symbols-outlined">close</span></button>
            </div>
            <form method="POST" action="cadastrar.php" class="p-6 space-y-4">
                <div>
                    <label class="block text-sm font-bold mb-1">Título da Tarefa</label>
                    <input class="w-full px-4 py-2 rounded-lg border outline-none focus:ring-2 focus:ring-secondary-container" name="titulo" type="text" required />
                </div>
                <div>
                    <label class="block text-sm font-bold mb-1">Descrição</label>
                    <textarea class="w-full px-4 py-2 rounded-lg border outline-none focus:ring-2 focus:ring-secondary-container" name="descricao" rows="3" required></textarea>
                </div>
                <div>
                    <label class="block text-sm font-bold mb-1">Data</label>
                    <input class="w-full px-4 py-2 rounded-lg border outline-none focus:ring-2 focus:ring-secondary-container" name="data_tarefa" type="date" required />
                </div>
                <div>
                    <label class="block text-sm font-bold mb-1">Status</label>
                    <select class="w-full px-4 py-2 rounded-lg border outline-none focus:ring-2 focus:ring-secondary-container" name="status" required>
                        <option value="Pendente">Pendente</option>
                        <option value="Em andamento">Em andamento</option>
                        <option value="Concluído">Concluído</option>
                    </select>
                </div>
                <div class="flex gap-3 pt-4">
                    <button type="button" onclick="fecharModal('modalNovo')" class="flex-1 px-4 py-2 bg-gray-200 font-bold rounded-lg">Cancelar</button>
                    <button type="submit" class="flex-1 px-4 py-2 bg-secondary text-white font-bold rounded-lg">Salvar Tarefa</button>
                </div>
            </form>
        </div>
    </div>

    <div class="modal-overlay fixed inset-0 z-[100] items-center justify-center p-4" id="modalEditar">
        <div class="bg-surface-container-lowest w-full max-w-md rounded-2xl shadow-2xl overflow-hidden border">
            <div class="bg-primary-container p-6 text-on-primary flex justify-between items-center">
                <h3 class="text-xl font-bold">Editar Tarefa</h3>
                <button onclick="fecharModal('modalEditar')" class="hover:bg-white/10 p-1 rounded-full"><span class="material-symbols-outlined">close</span></button>
            </div>
            <form method="POST" action="editar.php" class="p-6 space-y-4">
                <input type="hidden" name="acao" value="editar" />
                <input type="hidden" name="id" id="editId" />
                <div>
                    <label class="block text-sm font-bold mb-1">Título da Tarefa</label>
                    <input class="w-full px-4 py-2 rounded-lg border outline-none focus:ring-2 focus:ring-secondary-container" name="titulo" id="editTitulo" type="text" required />
                </div>
                <div>
                    <label class="block text-sm font-bold mb-1">Descrição</label>
                    <textarea class="w-full px-4 py-2 rounded-lg border outline-none focus:ring-2 focus:ring-secondary-container" name="descricao" id="editDescricao" rows="3" required></textarea>
                </div>
                <div>
                    <label class="block text-sm font-bold mb-1">Data</label>
                    <input class="w-full px-4 py-2 rounded-lg border outline-none focus:ring-2 focus:ring-secondary-container" name="data_tarefa" id="editData" type="date" required />
                </div>
                <div>
                    <label class="block text-sm font-bold mb-1">Status</label>
                    <select class="w-full px-4 py-2 rounded-lg border outline-none focus:ring-2 focus:ring-secondary-container" name="status" id="editStatus" required>
                        <option value="Pendente">Pendente</option>
                        <option value="Em andamento">Em andamento</option>
                        <option value="Concluído">Concluído</option>
                    </select>
                </div>
                <div class="flex gap-3 pt-4">
                    <button type="button" onclick="fecharModal('modalEditar')" class="flex-1 px-4 py-2 bg-gray-200 font-bold rounded-lg">Cancelar</button>
                    <button type="submit" class="flex-1 px-4 py-2 bg-secondary text-white font-bold rounded-lg">Salvar Alterações</button>
                </div>
            </form>
        </div>
    </div>

    <div class="modal-overlay fixed inset-0 z-[100] items-center justify-center p-4" id="modalExcluir">
        <div class="bg-surface-container-lowest w-full max-w-sm rounded-2xl shadow-2xl p-6 border text-center">
            <div class="w-16 h-16 bg-red-100 mx-auto rounded-full flex items-center justify-center mb-4">
                <span class="material-symbols-outlined text-red-600 text-4xl">delete_forever</span>
            </div>
            <h3 class="text-xl font-bold text-primary mb-2">Excluir Tarefa?</h3>
            <p class="text-sm mb-1">Você está prestes a excluir:</p>
            <p class="font-bold text-primary mb-4" id="excluirNome"></p>
            <div class="flex gap-3">
                <button onclick="fecharModal('modalExcluir')" class="flex-1 px-4 py-2 bg-gray-200 font-bold rounded-lg">Cancelar</button>
                <a id="linkExcluir" href="#" class="flex-1 px-4 py-2 bg-red-600 text-white font-bold rounded-lg text-center">Excluir</a>
            </div>
        </div>
    </div>

    <script>
        function abrirModal(id) { document.getElementById(id).classList.add('active'); }
        function fecharModal(id) { document.getElementById(id).classList.remove('active'); }

        function abrirModalNovo() { abrirModal('modalNovo'); }

        function abrirModalEditar(id, titulo, descricao, data, status) {
            document.getElementById('editId').value = id;
            document.getElementById('editTitulo').value = titulo;
            document.getElementById('editDescricao').value = descricao.replace(/\\n/g, '\n').replace(/\\r/g, '\r');
            document.getElementById('editData').value = data;
            document.getElementById('editStatus').value = status;
            abrirModal('modalEditar');
        }

        function confirmarExclusao(id, titulo) {
            document.getElementById('excluirNome').innerText = titulo;
            document.getElementById('linkExcluir').href = 'excluir.php?id=' + id;
            abrirModal('modalExcluir');
        }

        document.getElementById('searchBar').addEventListener('input', function() {
            const termo = this.value.toLowerCase();
            document.querySelectorAll('#dataTable tbody tr').forEach(linha => {
                linha.style.display = linha.innerText.toLowerCase().includes(termo) ? '' : 'none';
            });
        });
    </script>
</body>
</html>