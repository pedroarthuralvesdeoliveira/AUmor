<?php
    namespace DAO;
    class EnderecoDAO
    {
        private $db;

		public function __construct(\Config\Database $db)
        {
			$this->db = $db;
        }

        public function Inserir(\App\Models\Endereco $endereco)
        {
			try
            {
                $cep = $endereco->getCep();
                $bairro = $endereco->getBairro();
                $rua = $endereco->getRua();
                $numero = $endereco->getNumero();
                $complemento = $endereco->getComplemento();
				$stmt = $this->db->getConnection()->prepare('INSERT INTO 
                endereco(cep, bairro, rua, numero, complemento) 
                VALUES (:cep, :bairro, :rua, :numero, :complemento)');

				$stmt->execute(array(
                    ':cep' => $cep,
                    ':bairro' => $bairro,
                    ':rua' => $rua,
                    ':numero' => $numero,
                    ':complemento' => $complemento
                ));
			} 
            catch(\PDOException $e)
            { 
				echo 'Error: '.$e->getMessage();
            }
        }
        
        public function Acessar()
        {
            $idEndereco = $_SESSION['idEndereco'];
            try
            { 
                $sql = "SELECT * from endereco WHERE idEndereco = :idEndereco "; 
                $stmt = $this->db->getConnection()->prepare($sql);
                $stmt->bindValue(':idEndereco', $idEndereco);
                $stmt->execute();
                $dados = $stmt->fetch(\PDO::FETCH_OBJ);
            }
            catch (\PDOException $e)
            {
                    echo "Erro: " . $e->getMessage();
            }
            return $dados;
        }
        
        public function Editar(\App\Models\Endereco $endereco)
        {
            $idEndereco = $endereco->getIdEndereco();
            $cep = $endereco->getCep();
            $bairro = $endereco->getBairro();
            $rua = $endereco->getRua();
            $numero = $endereco->getNumero();
            $complemento = $endereco->getComplemento(); 
			try 
            {
				$stmt = $this->db->getConnection()->prepare('UPDATE endereco SET cep = :cep, bairro = :bairro, rua = :rua, numero = :numero, complemento = :complemento WHERE idEndereco = :idEndereco');
				$stmt->execute(array(
                    ':idEndereco' => $idEndereco,
                    ':cep' => $cep, 
                    ':bairro' => $bairro,
                    ':rua' => $rua,
                    ':numero' => $numero,
                    ':complemento' => $complemento
				));  
			} 
            catch(\PDOException $e) 
            {
			  echo 'Error: ' . $e->getMessage();
			}	
		}
    }
?>