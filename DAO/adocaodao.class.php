<?php
    namespace App\DAO;
    class AdocaoDAO 
    {
        private $db;

		public function __construct(\config\Database $db)
        {
			$this->db = $db;
        }

        public function Acessar()
        {
            try
            {
                $result = array();
                $stmt = $this->db->getConnection()->prepare('SELECT * FROM adocao');
                $stmt->execute();
                $result = $stmt->setFetchMode(\PDO::FETCH_ASSOC);
                $result = $stmt->fetchAll();
            }
            catch (\PDOException $e)
            {
                echo "Erro: " . $e->getMessage();
            }
                return $result;
        }

        public function buscarAdocao($idUsuario, $idAnimal)
        {
            $usuario = $idUsuario;
            $animal = $idAnimal; 
            try 
            {
                $sql = "SELECT idUsuarioFinal, idAnimal FROM adocao WHERE idUsuarioFinal = :usuario AND idAnimal = :animal AND status = 0";
                $stmt = $this->db->getConnection()->prepare($sql);
                $stmt->execute(array(
                    ':usuario' => $usuario,
                    ':animal' => $animal
                ));
                $dados = $stmt->fetch(\PDO::FETCH_OBJ);
            } 
            catch (\PDOException $e) 
            {
                echo 'Error: '.$e->getMessage();
            }
                return $dados;
        }

        public function buscarNomeAnimal($id)
        {
            $idAnimal = $id;
            try 
            {
                $sql = "SELECT nome from animal WHERE idAnimal = :idAnimal AND EXISTS (SELECT idAnimal FROM adocao WHERE idAnimal = :idAnimal)";
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
    
        public function dadosAdocao($idAnimal)
        {
            $animal = $idAnimal; 
            try 
            {
                $sql = "SELECT * FROM adocao WHERE idAnimal = :animal AND status = 0";
                $stmt = $this->db->getConnection()->prepare($sql);
                $stmt->execute(array(
                    ':animal' => $animal
                ));
                $dados = $stmt->fetch(\PDO::FETCH_OBJ);
            } 
            catch (\PDOException $e) 
            {
                echo 'Error: '.$e->getMessage();
            }
                return $dados;
        }

        public function dadosDevolucao($idAnimal)
        {
            $animal = $idAnimal; 
            try 
            {
                $sql = "SELECT a.*, b.* FROM adocao a,usuario b WHERE a.idAnimal = :animal AND a.idUsuarioFinal= b.idUsuario AND status = 1";
                $stmt = $this->db->getConnection()->prepare($sql);
                $stmt->execute(array(
                    ':animal' => $animal
                ));
                $dados = $stmt->fetchall(\PDO::FETCH_ASSOC);
            } 
            catch (\PDOException $e) 
            {
                echo 'Error: '.$e->getMessage();
            }
                return $dados;
        }

        public function devolucaoAnimal($id, $status, \App\Models\Adocao $adocao)
        {
            $idAnimal = $id;
            $status = $status;
            $dataDevolucao = $adocao->getDataDevolucao();
            try 
            {
                $sql = "UPDATE adocao SET status = :status, dataDevolucao = :dataDevolucao WHERE idAnimal = :animal";
                $stmt = $this->db->getConnection()->prepare($sql);
                $stmt->execute(array(
                    ':animal' => $idAnimal,
                    ':status' => $status,
                    ':dataDevolucao' => $dataDevolucao
                ));
            } 
            catch (\PDOException $e) 
            {
                echo 'Error: '.$e->getMessage();
            }
        }

        public function Editar(\App\Models\Adocao $result)
        {
		    $idAdocao = $result->getIdAdocao();
            $dataAdocao = $result->getDataAdocao();
            $dataDevolucao = $result->getDataDevolucao();
            $status = $result->getStatus();
			try 
            {
				$stmt = $this->db->getConnection()->prepare('UPDATE adocao SET dataAdocao = :dataAdocao, dataDevolucao = :dataDevolucao, status = :status WHERE idAdocao = :idAdocao');
				$stmt->execute(array(
					':idAdocao' => $idAdocao,
                    ':dataAdocao' => $dataAdocao,
                    ':dataDevolucao' => $dataDevolucao,
                    ':status' => $status
				));

			} 
            catch(\PDOException $e) 
            {
			  echo 'Error: ' . $e->getMessage();
            }
		}

        public function Inserir($id, $idA)
        {
            try
            {
                $idUsuario = $id;
                $idAnimal = $idA;

                $stmt = $this->db->getConnection()->prepare('INSERT INTO adocao(idUsuarioFinal, idAnimal, idUsuario)
                VALUES(:idUsuario, :idAnimal, (SELECT idUsuario FROM animal WHERE idAnimal = :idAnimal))');

                $stmt->execute(array(
                    ':idUsuario' => $idUsuario,
                    ':idAnimal' => $idAnimal,
                ));
            } 
            catch(\PDOException $e)
            {
                echo 'Error: '.$e->getMessage();
            }
        }   
    }
?>
