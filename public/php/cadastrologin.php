<?php
    include_once 'Conexao.php';

    class Cadastro
    {
        private $id;
        private $nome;
        private $senha;
        private $conn;
        

        public function getId() {
            return $this->id;
        }

        public function setId($iid) {
            $this->id = $iid;
        }

        public function getNome() {
            return $this->nome;
        }

        public function setNome($name) {
            $this->nome = $name;
        }

        public function getEmail() {
            return $this->email;
        }

        public function setEmail($emai) {
            $this->email = $emai;
        }

        public function getSenha() {
            return $this->senha;
        }

        public function setSenha($sen) {
            $this->senha = $sen;
        }

        function salvar()
        {
            try
            {
                $this-> conn = new Conectar();
                $sql = $this->conn->prepare("insert into usuarios values (null, ?, ?, ?, null, ?)");
                @$sql-> bindParam(1, $this->getNome(), PDO::PARAM_STR);
                @$sql-> bindParam(2, $this->getEmail(), PDO::PARAM_STR);
                @$sql-> bindParam(3, $this->getSenha(), PDO::PARAM_STR);
                @$sql-> bindParam(4, date("Y-m-d h:i:sa"), PDO::PARAM_STR);
                if($sql->execute() == 1)
                {
                    return "Cadastro feito com sucesso! <a onclick='slide()' id='linklogin2'>Faça Login</a> para continuar";
                }
                $this->conn = null;
            }
            catch(PDOException $exc)
            {
                echo "Erro ao salvar o registro. " . $exc->getMessage();
            }
        }
    }
?>