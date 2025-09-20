<?php

require_once __DIR__ . '/../src/bootstrap.php';

// Importa os models que serão utilizados
use App\Models\Noticia;
use App\Models\Usuario;

// Busca todas as notícias e carrega os relacionamentos 'autor' e 'usuario' do autor.
// O método with() otimiza a consulta, evitando o problema de N+1 queries.
$noticias = Noticia::with('autor.usuario', 'categoria')->get();

// Verifica se alguma notícia foi encontrada
if ($noticias->isEmpty()) {
    echo "Nenhuma notícia encontrada no banco de dados.";
    exit;
}

// Itera sobre cada notícia e exibe as informações
echo "<h1>Resultados da Consulta</h1>";
echo "<hr>";

foreach ($noticias as $noticia) {
    echo "<div>";
    echo "<h2>Notícia: {$noticia->titulo}</h2>";

    // Acessa o autor através do relacionamento
    $autor = $noticia->autor;
    if ($autor) {
        echo "<h3>Autor: {$autor->bio}</h3>";

        // Acessa o usuário através do relacionamento do autor
        $usuario = $autor->usuario;
        if ($usuario) {
            echo "<p><strong>Nome do Usuário:</strong> {$usuario->nome}</p>";
            echo "<p><strong>Email do Usuário:</strong> {$usuario->email}</p>";
        } else {
            echo "<p>Este autor não possui um usuário associado.</p>";
        }
    } else {
        echo "<p>Esta notícia não possui um autor associado.</p>";
    }

    // Acessa a categoria
    $categoria = $noticia->categoria;
    if ($categoria) {
        echo "<p><strong>Categoria:</strong> {$categoria->nome_categoria}</p>";
    } else {
        echo "<p><strong>Categoria:</strong> Nenhuma</p>";
    }

    echo "</div>";
    echo "<hr>";
}


$idDoUsuario = 1;

// 1. Encontra o usuário no banco de dados
$usuario = Usuario::find($idDoUsuario);

if ($usuario) {
    echo "<h1>Perfil de {$usuario->nome}</h1>";

    // 2. AQUI o método autor() é utilizado para carregar o relacionamento
    $perfilDeAutor = $usuario->autor;

    // 3. Agora você pode acessar os dados do autor
    if ($perfilDeAutor) {
        echo "<h2>Biografia do Autor:</h2>";
        echo "<p>{$perfilDeAutor->bio}</p>";
    } else {
        echo "<p>Este usuário ainda não tem um perfil de autor.</p>";
    }
}

echo "<hr><br>";

$idDoUsuario = 3;

// 1. Encontra o usuário no banco de dados
$usuario = Usuario::find($idDoUsuario);

if ($usuario) {
    echo "<h1>Perfil de {$usuario->nome}</h1>";

    // 2. AQUI o método autor() é utilizado para carregar o relacionamento
    $perfilDeAutor = $usuario->autor;

    // 3. Agora você pode acessar os dados do autor
    if ($perfilDeAutor) {
        echo "<h2>Biografia do Autor:</h2>";
        echo "<p>{$perfilDeAutor->bio}</p>";
    } else {
        echo "<p>Este usuário ainda não tem um perfil de autor.</p>";
    }
}

echo "<hr><br>";

// --- EXEMPLO DE UPDATE ---
echo "<h1>Exemplo de Update</h1>";

// 1. Encontra um usuário pelo ID (ex: ID 1)
$usuarioParaAtualizar = Usuario::find(1);

if ($usuarioParaAtualizar) {
    echo "<p>Nome antigo: {$usuarioParaAtualizar->nome}</p>";

    // 2. Altera o atributo 'nome'
    $usuarioParaAtualizar->nome = 'Nome Atualizado ' . rand(1, 100);

    // 3. Salva as alterações no banco de dados
    $usuarioParaAtualizar->save();

    echo "<p>Nome novo: {$usuarioParaAtualizar->nome}</p>";
} else {
    echo "<p>Usuário com ID 1 não encontrado para atualizar.</p>";
}
echo "<hr><br>";

// Atualiza o nível de acesso de todos os usuários com ID maior que 2
Usuario::where('id', '>', 2)->update(['nivel_acesso' => 'Editor']);

echo "<hr><br>";

// --- EXEMPLO DE DELETE ---
echo "<h1>Exemplo de Delete</h1>";

// Suponha que queremos deletar a notícia com ID 5
$idDaNoticiaParaDeletar = 5;
$noticiaParaDeletar = Noticia::find($idDaNoticiaParaDeletar);

if ($noticiaParaDeletar) {
    // Deleta o registro do banco de dados
    $noticiaParaDeletar->delete();
    echo "<p>Notícia com ID {$idDaNoticiaParaDeletar} foi deletada com sucesso!</p>";
} else {
    echo "<p>Notícia com ID {$idDaNoticiaParaDeletar} não foi encontrada para deletar.</p>";
}
echo "<hr><br>";

/**
 * Alternativa (Deletar por Chave Primária): Você pode usar o método 
 * destroy() para deletar um ou mais registros diretamente pela chave
 *  primária, sem precisar encontrá-los primeiro. * 
 */
// Deleta a notícia com ID 6
Noticia::destroy(6);

// Deleta as notícias com IDs 7, 8 e 9
Noticia::destroy([7, 8, 9]);