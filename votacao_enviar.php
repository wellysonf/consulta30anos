<?php

session_start();
if (!isset($_SESSION['auth'])) {
    header("Location: index.php");
}
require_once './repositorio_eleitor.php';

$votos = array();
foreach($_POST as $key => $value) {
    $voto_atual = [
        'categoria' => $key,
        'voto'  => $value
    ];
    array_push($votos, $voto_atual);
    /* echo "POST parameter '$key' has '$value'<br>"; */
}
$retorno_voto = $repo_eleitor->cadastrarVoto($votos);
if($retorno_voto){
    header("Location: votacao_confirmacao.php");
}else{
    header("Location: votacao.php?erro=i004");
}
exit();
