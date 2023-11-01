<?php

class conexao {

    private $host;
    private $usuario;
    private $senha;
    private $banco;
    private $conexao;
    protected static $_instance;

    public function __construct($host, $usuario, $senha, $banco) {
        $this->host = $host;
        $this->usuario = $usuario;
        $this->senha = $senha;
        $this->banco = $banco;
    }

    public function conectar() {
        $this->conexao = mysqli_connect(
                $this->host, $this->usuario, $this->senha, $this->banco
        );

//        if (mysqli_connect_errno($this->conexao)) {
	    if (mysqli_connect_errno()) {
            return false;
        } else {
            mysqli_query($this->conexao, "SET NAMES 'utf8';");
            return true;
        }
    }

    public function executarQuery($sql) {
        return mysqli_query($this->conexao, $sql);
    }

    public function queryInserir($sql) {
        $inseriu = mysqli_query($this->conexao, $sql);
        if (!$inseriu) {
            return mysqli_error($this->conexao);
        } else {
            return mysqli_insert_id($this->conexao);
        }
    }

    public function QueryRegistroUnico($query) {
        $linhas = $this->executarQuery($query);
        return mysqli_fetch_array($linhas);
    }

    public function escapeString($texto) {
        return mysqli_real_escape_string($this->conexao, $texto);
    }

}
