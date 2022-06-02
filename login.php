<?php
require "inc/cabecalho.php";
require "inc/funcoes-sessao.php";
require "inc/funcoes-usuarios.php";


/* Mensagens para os processos de erros no login */
if( isset($_GET['acesso_proibido']) ){
  $feedback = "Você deve logar primeiro!";
} elseif( isset($_GET['logout']) ) {
  $feedback = "Você saiu do sistema!";
} elseif( isset($_GET['nao_encontrado']) ) {
  $feedback = "Usuário não encontrado!";
} elseif( isset($_GET['senha_incorreta']) ) {
  $feedback = "A senha está errada!";          
} elseif( isset($_GET['campos_obrigatorios']) ) {
  $feedback = "Você deve preencher todos os campos!";
} else {
  $feedback = "";
}



// 1) [IF] verifica se o botão foi acionado - apenas isto
if( isset($_POST['email'])) {

      // 2) [IF] redireciona para login com parâmetro indicando campos obrigatórios
      if( empty ($_POST['email']) || empty($_POST['senha'])) {
        header("location:login.php?campos_obrigatorios");

      //caso contrário, pegue o email e a senha digitados
      }else{
      $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
      $senha = $_POST['senha'];
        
      //verifica no banco de dados se existe alguém com o e-mail informado
      $usuario = buscarUsuario($conexao, $email);
    
              // 3) [IF / ELSE Se usuário é diferente de nulo (ou seja, tem usuário)]
              if($usuario != null){


                        // 4) [IF / ELSE  Se as senhas forem iguais]
                        if(password_verify($senha, $usuario['senha'])){
                            //id, nome, email, tipo

                        login(
                          $usuario['id'], $usuario['nome'],
                          $usuario['email'], $usuario['tipo']
                        );

                        header("location:admin/index.php");
                        
                        }else{
                          header("location:login.php?senha_incorreta");         
                        }
                        //CASO contrário não existe usuário - é do IF 3 

              }else{
              header("location:login.php?nao_encontrado");
              }

      }

    //teste
    // var_dump($usuario);
}


?>
<div class="row">
  <article class="col-12 bg-white rounded shadow my-1 py-4">
    <h2 class="text-center">Acesso à área administrativa</h2>

    <form action="" method="post" id="form-login" name="form-login" class="mx-auto w-50" autocomplete="off">

      <p class="my-2 alert alert-warning text-center">
                <?=$feedback?>
      </p>

      <div class="form-group">
        <label for="email">E-mail:</label>
        <input autofocus class="form-control" type="email" id="email" name="email">
      </div>
      <div class="form-group">
        <label for="senha">Senha:</label>
        <input class="form-control" type="password" id="senha" name="senha">
      </div>

      <button class="btn btn-primary btn-lg" name="entrar" type="submit">Entrar</button>

    </form>
  </article>

</div>

<?php
require "inc/rodape.php";
?>