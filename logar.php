<?php


include './config.php';


$hoje = date("Ymd", time());
if (($hoje > $data_insc_final) || ($hoje < $data_insc_inicial)) {
    $erro = base64_encode("529");
    header("Location: index.php?err=$erro");
    exit;
}

$matricula = $_POST['matricula'];
$cpf = $_POST['cpf'];

require './repositorio_eleitor.php';

$retorno = $repo_eleitor->buscarEleitor($cpf, $matricula);

if($retorno){
    header("Location: votacao.php");
}else{
    header("Location: index.php");
}
exit();