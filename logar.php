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
    $votacoes_existentes = $repo_eleitor->buscarVotosPorEleitor($retorno['id']);
    if(count($votacoes_existentes) > 0){
        header("Location: votacao_confirmacao.php");
    }else{
        header("Location: votacao.php");
    }
}else{
    $errCripto = base64_encode("10");
    header("Location: index.php?err=$errCripto");
}
exit();