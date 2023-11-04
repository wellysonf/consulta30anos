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
            return $eleitor_retorno;
        } 
        $eleitor_retorno = FALSE;
        return $eleitor_retorno;
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

    public function buscarVotosPorEleitor($eleitor) {
        $eleitor = $this->conexao->escapeString($eleitor);        
        $sql = "SELECT v.id as id, v.eleitor as eleitor, v.categoria as categoria, v.voto as voto, e.nome as nome, e.periodo as periodo
                    FROM `votacao` v, `eleitores` e WHERE `eleitor` = '$eleitor' AND v.voto = e.matricula;";
        $retorno = $this->conexao->executarQuery($sql);
        $listaVotos = array();
        while ($linha_atual = mysqli_fetch_array($retorno)) {
            array_push($listaVotos, $linha_atual);
        }
        return $listaVotos;
    }

    public function cadastrarVoto($votos) {
        try{
            $values_insert = "";
            $eleitor = $_SESSION["auth"]["id"];
            foreach ($votos as $item){
                $categoria = $this->conexao->escapeString($item["categoria"]);
                $voto = $this->conexao->escapeString($item["voto"]);
                $values_insert .= "(NULL, $eleitor, '$categoria', '$voto', CURRENT_TIMESTAMP),";
            }
            $values_insert = substr_replace($values_insert, ";", -1);
            $sql_log = "INSERT INTO `log` (`id`, `eleitor`, `comando`, `criado_em`) 
                        VALUES (NULL, '$eleitor', '" .  $this->conexao->escapeString($values_insert) . "', CURRENT_TIMESTAMP); ";
            $sql_voto = "INSERT INTO `votacao` (`id`, `eleitor`, `categoria`, `voto`, `criado_em`) 
                        VALUES $values_insert";
            $this->limparVotos($eleitor);
            $this->conexao->queryInserir($sql_log);
            $retorno = $this->conexao->queryInserir($sql_voto);
        }catch(Exception $e){
            return FALSE;
        }
        return $retorno;
    }
    public function limparVotos($eleitor) {
        $eleitor_escape = $this->conexao->escapeString($eleitor);
        $sql = "DELETE FROM votacao WHERE eleitor = $eleitor_escape;";
        $this->conexao->executarQuery($sql);
    }
}

$repo_eleitor = new repositorio_eleitor();
