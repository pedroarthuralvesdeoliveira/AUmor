<?php
    namespace DAO;
    CLASS ListaInteresseDAO
    {    
        private $db;

		public function __construct(\Config\Database $db)
        {
			$this->db = $db;
        }

        public function Acessar()
        {
            $resultado = array();
            try
            {
                $sql = "SELECT * from listainteresse";
                $stmt = $this->db->getConnection()->prepare($sql);
                $stmt->execute();
                $resultado = $stmt->setFetchMode(\PDO::FETCH_ASSOC);
                $resultado = $stmt->fetchAll();
            } 
            catch (\PDOException $e)
            {
                echo "Erro: " . $e->getMessage();
            }
            return $resultado;
        }

        public function AdicionarUsuarioEmListaInteresse($idUsuario, $idAnimal)
        {
            $idAdotante = $idUsuario;
            $idPet = $idAnimal;
            try
            {
                $Pdo = $this->db->getConnection();
                $sql = 'INSERT INTO listainteresse(idUsuario, idAnimal) VALUES(:idAdotante, :idPet)';
                $stmt = $Pdo->prepare($sql);
                $stmt->execute(array(
                    ':idAdotante' => $idAdotante,
                    ':idPet' => $idPet
                ));
            } 
            catch (\PDOException $e)
            {
                echo "Erro: " . $e->getMessage();
            }
        }

        public function ApagarUsuariodaLista($usuario, $animal)
        {
            $idUsuario = $usuario;
            $idAnimal = $animal;
            try 
            {
                $Pdo = $this->db->getConnection();
                $sql = "DELETE FROM listainteresse WHERE idUsuario = :idUsuario AND idAnimal = :idAnimal";
                $stmt = $Pdo->prepare($sql);
                $stmt->execute(array(
                    ':idUsuario' => $idUsuario,
                    ':idAnimal' => $idAnimal
                ));
            } 
            catch (\PDOException $e) 
            {
                echo "Erro: " . $e->getMessage();
            }
        }

        public function buscarLista($id)
        {
            $idAnimal = $id;
            try 
            {
                $sql = "SELECT * from listainteresse WHERE idAnimal = :idAnimal";
                $stmt = $this->db->getConnection()->prepare($sql);
                $stmt->bindValue(':idAnimal', $idAnimal);
                $stmt->execute();
                $dados = $stmt->fetchAll(\PDO::FETCH_ASSOC);
            }
            catch (\PDOException $e)
            {
                echo "Erro: " . $e->getMessage();
            }
            return $dados;
        }

        public function buscarNomeAnimal($id)
        {
            $idAnimal = $id;
            try 
            {
                $sql = "SELECT nome from animal WHERE idAnimal = :idAnimal AND EXISTS (SELECT idAnimal FROM listainteresse WHERE idAnimal = :idAnimal)";
                $stmt = $this->db->getConnection()->prepare($sql);
                $stmt->bindValue(':idAnimal', $idAnimal);
                $stmt->execute();
                $dados = $stmt->fetch(\PDO::FETCH_OBJ);
            }
            catch (\PDOException $e)
            {
                echo "Erro: " . $e->getMessage();
            }
                return $dados;
        }

        public function buscarUsuario($id)
        {
            $idUsuario = $id;
            try 
            {
                $sql = "SELECT * from listainteresse WHERE idUsuario = :idUsuario";
                $stmt = $this->db->getConnection()->prepare($sql);
                $stmt->bindValue(':idUsuario', $idUsuario);
                $stmt->execute();
                $dados = $stmt->fetchAll(\PDO::FETCH_ASSOC);
            }
            catch (\PDOException $e)
            {
                echo "Erro: " . $e->getMessage();
            }
                return $dados;
        }

        public function buscarUsuarioAnimalLista($usuario, $animal)
        {
            $idUsuario = $usuario;
            $idAnimal = $animal;
            try 
            {
                $Pdo = $this->db->getConnection();
                $sql = 'SELECT idUsuario, idAnimal FROM listainteresse WHERE idUsuario = :idUsuario AND idAnimal = :idAnimal';
                $stmt = $Pdo->prepare($sql);
                $stmt->execute(array(
                    ':idUsuario' => $idUsuario,
                    ':idAnimal' => $idAnimal
                ));
                $dados = $stmt->fetch(\PDO::FETCH_OBJ);
            } 
            catch (\PDOException $e) 
            {
                echo "Erro: " . $e->getMessage();
            }
            return $dados;
        }
}
