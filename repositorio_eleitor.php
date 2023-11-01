<?php

require_once './obj.conexao.php';

interface IRepositorio_eleitor {

    public function buscarEleitor($cpf, $matricula);

    public function buscarCandidatosPorCategoria($categoria);

    
}

class repositorio_eleitor implements IRepositorio_eleitor {

    private $conexao;

    public function __construct() {

        $this->conexao = new Conexao("localhost", "30anos", "1V23!.xXMDD98LH/", "30anos");
        if ($this->conexao->conectar() == false) {
            echo "Erro na conexão com o servidor de dados";
        }
    }

    public function buscarEleitor($cpf, $matricula) {
        $cpf_escape = $this->conexao->escapeString($cpf);
        $matricula_escape = $this->conexao->escapeString($matricula);
        $sql = "SELECT * FROM eleitores "
                . "WHERE matricula = '$matricula_escape' AND cpf='$cpf_escape' LIMIT 1";
        $linha_atual = $this->conexao->QueryRegistroUnico($sql);
        if (($linha_atual > 0)) {
            $eleitor_retorno = $linha_atual;
            session_start();
            $_SESSION['auth'] = $eleitor_retorno;
        } else {
            $eleitor_retorno = FALSE;
        }
        RETURN $eleitor_retorno;
    }
    public function buscarCandidatosPorCategoria($categoria) {
        $categoria = $this->conexao->escapeString($categoria);
        
        $sql = "SELECT * FROM `eleitores` WHERE `categoria` LIKE '$categoria' ORDER BY nome;";
        $retorno = $this->conexao->executarQuery($sql);
        $listaCandidatos = array();
        while ($linha_atual = mysqli_fetch_array($retorno)) {
            array_push($listaCandidatos, $linha_atual);
        }
        return $listaCandidatos;
    }

}

$repo_eleitor = new repositorio_eleitor();
