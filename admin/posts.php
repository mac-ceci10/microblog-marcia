<?php 
require "../inc/cabecalho-admin.php"; 
require "../inc/funcoes-posts.php";

/* Recuperando os dados do usuário que está logado na sessão */
$idUsuarioLogado = $_SESSION['id'];
$tipoUsuarioLogado = $_SESSION['tipo'];

$posts = lerPosts($conexao, $idUsuarioLogado, $tipoUsuarioLogado);
$quantidade = count($posts);
?>      
    
<div class="row">
  <article class="col-12 bg-white rounded shadow my-1 py-4">
    <h2 class="text-center">Posts 
      <span class="badge badge-primary"><?=$quantidade?></span></h2>
    <p class="lead text-right">
      <a class="btn btn-primary" href="post-insere.php">Inserir novo post</a>
    </p>
            
    <div class="table-responsive"> 

      <table class="table table-hover">
        <thead class="thead-light">
          <tr>
            <th>Título</th>
            <th>Data</th>
            <?php if($tipoUsuarioLogado == 'admin'){ ?>
            <th>Autor</th>
            <?php } ?>
            <th colspan="2" class="text-center">Operações</th>
          </tr>
        </thead>
      
        <tbody>
          <!-- Colocamos a função formata data aqui para mostrar mais legível
        primeiro a função dentro do PHP e depois a variável data vindo do banco de dados -->


<?php foreach($posts as $post) { ?>
          <tr>
            <td> <?=$post['titulo']?> </td>
            
            <td> <?=formatadata($post['data'])?> </td>
            
            <?php if($tipoUsuarioLogado == 'admin'){ ?>
            <td> <?=$post['autor']?> </td>
            <?php } ?>


          <!-- primeira coisa antes de criar a função atualizar, é colocar o link dinâmico aqui para pegar o ID
          Este é um pré-requisito -->



            <td class="text-center">
              <a class="btn btn-warning btn-sm" 
              href="post-atualiza.php?id=<?=$post['id']?>">
                  Atualizar
              </a>




            </td>
            <td class="text-center">
              <a class="btn btn-danger btn-sm excluir"
              href="post-exclui.php?id=<?=$post['id']?>">
                  Excluir
              </a>
            </td>
          </tr>


<?php } ?>





        </tbody>                
      </table>
      
    </div>
  </article>
</div>
     

<?php require "../inc/rodape-admin.php"; ?> 