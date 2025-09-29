<?php
    include_once 'Conexao.php';

    class Cadastro
    {
        private $id;
        private $nome;
        private $senha;
        private $admin;
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

        public function getAdmin() {
            return $this->admin;
        }

        public function setAdmin($adm) {
            $this->admin = $adm;
        }

        function salvar()
        {
            try
            {
                $this-> conn = new Conectar();
                $sql = $this->conn->prepare("select * from usuarios where email like ?"); 
                @$sql-> bindParam(1, $this->getEmail(), PDO::PARAM_STR);
                $sql->execute();
                if ($sql->fetchAll() != null) {
                    return "Email já foi cadastrado. Tente outro email";
                } else {                   
                    $sql = $this->conn->prepare("insert into usuarios values (null, ?, ?, ?, ?, ?)");
                    @$sql-> bindParam(1, $this->getNome(), PDO::PARAM_STR);
                    @$sql-> bindParam(2, $this->getEmail(), PDO::PARAM_STR);
                    @$sql-> bindParam(3, $this->getSenha(), PDO::PARAM_STR);
                    @$sql-> bindParam(4, $this->getAdmin(), PDO::PARAM_STR);
                    @$sql-> bindParam(5, date("Y-m-d h:i:sa"), PDO::PARAM_STR);
                    if($sql->execute() == 1)
                    {
                        return "Cadastro feito com sucesso! <a onclick='slide()' id='linklogin2'>Faça Login</a> para continuar";
                    }
                    $this->conn = null;
                }               
            }
            catch(PDOException $exc)
            {
                echo "Erro ao fazer cadastro. " . $exc->getMessage();
            }
        }
        function login()
        {
            try
            {
                $this-> conn = new Conectar();
                $sql = $this->conn->prepare("select * from usuarios where email like ? && senha like ?"); 
                @$sql-> bindParam(1, $this->getEmail(), PDO::PARAM_STR);
                @$sql-> bindParam(2, $this->getSenha(), PDO::PARAM_STR);
                $sql->execute();
                if ($sql->fetchAll() != null) {
                    $_SESSION['user']=$this->getEmail();
                    return true;
                } else {                   
                    return false;
                    $this->conn = null;
                }               
            }
            catch(PDOException $exc)
            {
                echo "Erro ao fazer login. " . $exc->getMessage();
            }
        }
    }
?>