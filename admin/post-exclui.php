<?php
require "../inc/funcoes-sessao.php";
require "../inc/funcoes-posts.php";

// verificaAcesso();
// verificaAcessoAdmin();

$id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);

        excluirPost($conexao, $id);

        header("location:posts.php");