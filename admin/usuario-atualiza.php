<?php 
require "../inc/funcoes-usuarios.php";
//sempre o require de funções vem antes de qualquer require.
require "../inc/cabecalho-admin.php";

verificaAcessoAdmin();

$id= filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);
$usuario = lerUmUsuario($conexao, $id);

if(isset($_POST['atualizar'])){
	$nome = filter_input(INPUT_POST, 'nome', FILTER_SANITIZE_SPECIAL_CHARS);
	$email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
	$tipo = filter_input(INPUT_POST, 'tipo', FILTER_SANITIZE_SPECIAL_CHARS);

  // Lógica para senha
  // Se o campo da senha estiver vazio, significa que o usuário NÃO mudou a senha;
  
  
      if( empty ($_POST['senha'] )){
      
      $senha = $usuario['senha']; // manter a senha do banco

      }else{

      // Caso contrário, escreveu algo ou seja digitou alguma coisa, precisaremos verifica a senha digitada.
      //função lerUMusuario

      $senha = verificaSenha($_POST['senha'], $usuario['senha']);

      }


    //TESTE DE SENHAS 
    // echo "senha no banco " .$usuario ['senha']; // ESTA está vindo do BD 
    // echo "<br>";
    // echo"formulario ".$senha; // ESTA está vindo do formulário



      atualizarUsuario( $conexao, $id, $nome, $email, $senha, $tipo);
      header("location:usuarios.php");
  
}

	// $senha = codificaSenha($_POST['senha']);
  // tudo isso antes de devolver para o BD

?>
       
<div class="row">
  <article class="col-12 bg-white rounded shadow my-1 py-4">
    <h2 class="text-center">Atualizar Usuário</h2>

    <form class="mx-auto w-75" action="" method="post" id="form-atualizar" name="form-atualizar">

      <div class="form-group">
        <label for="nome">Nome:</label>
        <input value="<?=$usuario['nome']?>" class="form-control" required type="text" id="nome" name="nome">
      </div>

      <div class="form-group">
        <label for="email">E-mail:</label>
        <input value="<?=$usuario['email']?>"class="form-control" required type="email" id="email" name="email">
      </div>

      <div class="form-group">
        <label for="nova-senha">Senha</label>
        <input class="form-control" type="password" id="senha" name="senha" placeholder="Preencha apenas se for alterar">
      </div>

      <div class="form-group">
        <label for="tipo">Tipo:</label>
        <select class="custom-select" name="tipo" id="tipo" required>


          <option value=""></option>                  
          <option 
          <?php if($usuario['tipo'] == 'editor') echo " selected "?>
          
          value="editor">Editor</option>  

          <option	
          <?php if($usuario['tipo'] == 'admin') echo " selected "?>
          value="admin">Administrador</option>
        </select>

      </div>
      
      <button class="btn btn-primary" name="atualizar">Atualizar usuário</button>
    </form>
      
  </article>
</div>

<?php
require "../inc/rodape-admin.php"; 
?>