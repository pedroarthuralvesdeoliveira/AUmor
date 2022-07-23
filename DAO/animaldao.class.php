<?php
    namespace App\DAO;
    class AnimalDAO {
        private $db;

		public function __construct(\Config\Database $db)
        {
			$this->db = $db;
        }

        public function Acessar(\App\models\Animal $resultado)
        {
            try
            {
                $resultado = array();
                $sql = "SELECT * FROM animal";
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
        
        public function acessarAnimaisAtivos(\App\models\Animal $resultado)
        {
            try
            {
                $resultado = array();
                $sql = "SELECT * FROM animal WHERE StatusDesativar = 0 AND  StatusAprovacao = 1 AND status = 0";
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

        public function acessarAnimaisAtivosDeOutroUsuario(\App\models\Animal $resultado)
        {
            try
            {
                $resultado = array();
                $sql = "SELECT * FROM animal WHERE StatusDesativar = 0 AND  StatusAprovacao = 1 AND status = 0 AND idUsuario != ".$_SESSION['idUsuario'];
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

        public function AcessarAnimaldoUsuario()
        {
            $idUsuario = $_SESSION['idUsuario'];
            try 
            {
                $sql = "SELECT * FROM animal WHERE idUsuario = :idUsuario";
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

        public function AcessarAnimaldoUsuarioParaEditar($idUsuario, $idAnimal)
        {
            $usuario = $idUsuario;
            $animal = $idAnimal;
            try{
                $sql = "SELECT * FROM animal WHERE idUsuario = :idUsuario AND idAnimal = :idAnimal";
                $stmt = $this->db->getConnection()->prepare($sql);
                $stmt->execute(array(
                    ':idUsuario' => $usuario,
                    ':idAnimal' => $animal,
                ));
                $dados = $stmt->fetch(\PDO::FETCH_OBJ);
            }
            catch (\PDOException $e)
            {
                echo "Erro: " . $e->getMessage();
            }
            return $dados;
        }

        public function alterarPermissao($id, $statusAprovacao)
        {
            $idAnimal = $id;
            $status = $statusAprovacao;
            try 
            {
                $stmt = $this->db->getConnection()->prepare('UPDATE animal SET StatusAprovacao = :status WHERE idAnimal = :idAnimal');
                $stmt->execute(array(
                    ':idAnimal' => $idAnimal,
                    ':status' => $status
                ));
            } 
            catch(\PDOException $e) 
            {
                echo 'Error: ' . $e->getMessage();
            }
        }

        public function alterarStatusAnimal($id, $statusAnimal)
        {
            $status = $statusAnimal;
            $idAnimal = $id;
            try 
            {
                $sql = 'UPDATE animal SET status = :status WHERE idAnimal = :idAnimal';
                $stmt = $this->db->getConnection()->prepare($sql);
                $stmt->execute(array(
                    ':idAnimal' => $idAnimal,
                    ':status' => $status
                ));
            } 
            catch(\PDOException $e) 
            {
                echo 'Error: ' . $e->getMessage();
            }   
        }

        public function buscarAnimal($id)
        {
            $idAnimal = $id;
            try 
            {
                $sql = "SELECT * from animal WHERE idAnimal = :idAnimal";
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

        public function Desativar($id, $status)
        {
            $idAnimal = $id;
            $statusA = $status;
            try 
            {
                $stmt = $this->db->getConnection()->prepare('UPDATE animal SET StatusDesativar = :status WHERE idAnimal = :idAnimal');
                $stmt->execute(array(
                    ':idAnimal' => $idAnimal,
                    ':status' => $statusA
                ));
            } 
            catch(\PDOException $e) 
            {
                echo 'Error: ' . $e->getMessage();
            }
        }

        public function Editar(\App\models\Animal $result)
        {
            $idAnimal = $result->getIdAnimal();
            $idUsuario = $result->getIdUsuario();
            $nome = $result->getNome();
            $idade = $result->getIdade();
            $sexo = $result->getSexo();
            $tipo = $result->getTipo();
            $porte = $result->getPorte();
            $comportamento = $result->getComportamento();
            $saude = $result->getSaude();
            $motivoAdocao = $result->getMotivoAdocao();
			try 
            {
				$stmt = $this->db->getConnection()->prepare('UPDATE animal SET nome = :nome, idade = :idade, sexo = :sexo, tipo = :tipo, porte = :porte, comportamento = :comportamento, saude = :saude, motivoAdocao = :motivoAdocao WHERE idAnimal = :idAnimal AND idUsuario = :idUsuario');
				$stmt->execute(array(
                    ':idUsuario' => $idUsuario,
                    ':idAnimal' => $idAnimal,
                    ':nome' => $nome,
                    ':idade' => $idade,
                    ':sexo' => $sexo,
                    ':tipo' => $tipo,
                    ':porte' => $porte,
                    ':comportamento' => $comportamento,
                    ':saude' => $saude,
                    ':motivoAdocao' => $motivoAdocao
				));
			} 
            catch(\PDOException $e) 
            {
			  echo 'Error: ' . $e->getMessage();
			}
		}

        public function EditarFotoAnimal(\App\models\Animal $animal)
        {
            $idAnimal = $animal->getIdAnimal();
            $imagem = $animal->getImagem();
            try 
            {
                $stmt = $this->db->getConnection()->prepare('UPDATE animal SET imagem = :imagem WHERE idAnimal = :idAnimal');
                $stmt->execute(array(
                    ':imagem' => $imagem,
                    ':idAnimal' => $idAnimal
                ));
                $stmt->execute();
            } 
            catch(\PDOException $e) 
            {
                echo 'Error: ' . $e->getMessage();
            }

        }

        public function FiltrarAnimais($porte, $sexo, $tipo)
        {
            try{
                $resultado = array();
                $sql = "SELECT * FROM animal WHERE StatusDesativar = 0 AND  StatusAprovacao = 1";
                if ($porte){
                    $sql .= " AND porte = '" . $porte . "'";
                }
                if ($sexo){
                    $sql .= " AND sexo = '" . $sexo . "'";
                }
                if ($tipo){
                    $sql .= " AND tipo = '" . $tipo . "'";
                }
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

        public function Inserir(\App\models\Animal $animal)
        {
            try
            {
                $idUsuario = $animal->getIdUsuario();
                $nome = $animal->getNome();
                $idade = $animal->getIdade();
                $porte = $animal->getPorte();
                $sexo = $animal->getSexo();
                $comportamento = $animal->getComportamento();
                $saude = $animal->getSaude();
                $tipo = $animal->getTipo();
                $motivoAdocao = $animal->getMotivoAdocao();
                $idUsuario = $animal->getIdUsuario();
                $imagem = $animal->getImagem();
                $StatusAprovacao=  $animal->getStatusAprovacao();

                $stmt = $this->db->getConnection()->prepare('INSERT INTO animal
                (idUsuario, nome, idade, porte, sexo, comportamento, saude, tipo,
                motivoAdocao, imagem, StatusAprovacao)
                VALUES (:idUsuario, :nome, :idade,
                :porte, :sexo, :comportamento,
                :saude, :tipo, :motivoAdocao, :imagem, :StatusAprovacao)');

                $stmt->execute(array(
                    ':idUsuario' => $idUsuario,
                    ':nome' => $nome,
                    ':idade' => $idade,
                    ':porte' => $porte,
                    ':sexo' => $sexo,
                    ':comportamento' => $comportamento,
                    ':saude' => $saude,
                    ':tipo' => $tipo,
                    ':motivoAdocao' => $motivoAdocao,
                    ':imagem' => $imagem,
                    ':StatusAprovacao' => $StatusAprovacao,
                    ':idUsuario' => $idUsuario
                ));
            } 
            catch(\PDOException $e)
            {
                echo 'Error: '.$e->getMessage();
            }
        }
    }
?>
