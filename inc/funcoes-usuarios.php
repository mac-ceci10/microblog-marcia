<?php
require "conecta.php";



// Função inserirUsuario: usada em usuario-insere.php
function inserirUsuario( mysqli $conexao, string $nome, string $email, string $senha, string $tipo){
    $sql = "INSERT INTO usuarios( nome, email, senha, tipo)
    VALUES ('$nome', '$email', '$senha', '$tipo')";
    mysqli_query($conexao, $sql) or die (mysqli_error($conexao));
}
// fim inserirUsuario





// Função codificaSenha: usada em usuario-insere.php e usuario-atualiza.php
function codificaSenha(string $senha):string {
    return password_hash($senha, PASSWORD_DEFAULT);
}
// (string $senha):string - RECEBE UMA string e devolve uma string
// password_hash - colocar esta função para criptografia de senhas - password_hash 
// Professor avisou que é uma criptografia dinâmica
// hash dinâmico misturado com a senha
// fim codificaSenha




// Função lerUsuarios: usada em usuarios.php
function lerUsuarios(mysqli $conexao):array {
    $sql = "SELECT id, nome, email, tipo FROM usuarios ORDER BY nome";
    $resultado = mysqli_query($conexao, $sql) or die (mysqli_error($conexao));

    $usuarios=[]; //array grande que recebe 

    while ($usuario = mysqli_fetch_assoc($resultado)){
        array_push($usuarios, $usuario);
    }
    return $usuarios;
}
// fim lerUsuarios



// Função excluirUsuario: usada em usuario-exclui.php

// fim excluirUsuario



// Função lerUmUsuario: usada em usuario-atualiza.php
function lerUmUsuario(mysqli $conexao, int $id):array {

    $sql = "SELECT id, nome, email, tipo, senha FROM usuarios 
    WHERE id = $id";

    $resultado = mysqli_query($conexao, $sql) 
    or die(mysqli_error($conexao));

    return mysqli_fetch_assoc($resultado);

}

//pra esta função carregar só irá carregar o ID, carregamento de dados
// fim lerUmUsuario


// Função verificaSenha: usada em usuario-atualiza.php
// fim verificaSenha



// Função atualizarUsuario: usada em usuario-atualiza.php
function AtualizarUsuario( 
    mysqli $conexao, int $id, string $nome, string $email, string $senha, string $tipo):array {
    $sql = "UPDATE usuarios nome = '$nome', email = '$email', senha = '$senha', tipo = '$tipo' WHERE id = $id";
    $resultado = mysqli_query($conexao, $sql) 
    or die(mysqli_error($conexao));
    }

// function atualizarUsuario()
// fim atualizarUsuario



// Função buscarUsuario: usada em login.php
// fim buscarUsuario





