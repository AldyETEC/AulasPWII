<?php

// require_once __DIR__ . '/../vendor/autoload.php';

// use Illuminate\Database\Capsule\Manager as Capsule;

// // Initialize Eloquent ORM
// $capsule = new Capsule;

// $capsule->addConnection(require __DIR__ . '/../config/database.php');

// $capsule->setAsGlobal();
// $capsule->bootEloquent();

require_once __DIR__ . '/../src/bootstrap.php';

// Importa os models que serão utilizados
use App\Models\Noticia;

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