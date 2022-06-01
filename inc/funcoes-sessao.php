<?php

/* Aqui programaremos futuramente
os recursos de login/logout e verificação
de permissão de acesso dos usuários */

// Verificar se já existe uma sessão em funcionamento

if(!isset ($_SESSION)){ // isset - se não existir uma sessão
    session_start();
}

        //SESSION - PRECISA ser inicializado - e o PHP é quem vai fazer o START nelas.


function verificaAcesso(){
        // Se não existe uma variável de sessão
        // essa informação será buscada pelo ID - PERMISSÕES


if(!isset ($_SESSION['id'])) {
        // então significa que ele NÃO está logado, portanto apague qualquer resquício de sessão e force o usuário a ir para o login.php

    session_destroy();
    header("location:../login.php");
    die();

    }
}

// Usado na página login.php
function login(int $id, string $nome, string $email, string $tipo){
    //Criando variáveis de sessão ao logar

    $_SESSION['id'] = $id;
    $_SESSION['nome'] = $nome;
    $_SESSION['email'] = $email;
    $_SESSION['tipo'] = $tipo;
}

//usados nas páginas administrativas quando clicamos em sair

function logout(){
    session_start();
    session_destroy();
    header("location:login.php");
    die();
}