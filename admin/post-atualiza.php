<?php
require "../inc/cabecalho-admin.php";
require "../inc/funcoes-posts.php";


// 1) Primeira coisa é pegar o ID vindo da URL, 
$idPost = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);



// 2) Pegar os dados de sessão do usuário logado;
$idUsuarioLogado = $_SESSION['id'];
$idtipoUsuarioLogado = $_SESSION['tipo'];


// 3) Chamamos a função passando os parâmetros e pegamos o resltado dela
$post = lerUmPost($conexao, $idPost, $idUsuarioLogado, $idtipoUsuarioLogado);


// usuamos aqui o var_dump para ver se a busca do ARRAY de lerUmPost, estava funcionando

        // echo "<pre>";

        // var_dump($post);

        // echo "</pre>";

?>
       
<div class="row">
  <article class="col-12 bg-white rounded shadow my-1 py-4">
    <h2 class="text-center">Atualizar Post</h2>

    <form class="mx-auto w-75" action="" method="post" id="form-atualizar" name="form-atualizar"> 
        
      <div class="form-group">
        <label for="titulo">Título:</label>
        <input value="<?=$post['titulo']?>" class="form-control" type="text" id="titulo" name="titulo" required>
      </div>
      
      <div class="form-group">
        <label for="texto">Texto:</label>
        <textarea class="form-control" name="texto" id="texto" cols="50" rows="10" required> <?=$post['texto']?> </textarea>
      </div>
      
      <div class="form-group">
        <label for="resumo">Resumo (máximo de 500 caracteres):</label>
        <span id="maximo" class="badge badge-success">0</span>
        <textarea class="form-control" name="resumo" id="resumo" cols="50" rows="3" required maxlength="500">  <?=$post['resumo']?>  </textarea>
      </div>
      
      <div class="form-group">
        <label for="imagem-existente">Imagem do post:</label>
        <!-- campo somente leitura, meramente informativo -->
        <input value="<?=$post['imagem']?>" class="form-control" type="text" id="imagem-existente" name="imagem-existente" readonly>
      </div>            
          
      <div class="form-group">
        <label for="imagem" class="form-label">Caso queira mudar, selecione outra imagem:</label>
        <input class="form-control" type="file" id="imagem" name="imagem"
        accept="image/png, image/jpeg, image/gif, image/svg+xml">
      </div>
        
        <button class="btn btn-primary" name="atualizar">Atualizar post</button>
    </form>
      
  </article>
</div>

<?php
require "../inc/rodape-admin.php"; 
?>