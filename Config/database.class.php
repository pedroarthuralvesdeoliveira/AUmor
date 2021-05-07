<?php 

// session_start();
class Database{

	private $host = "localhost";
    private $username = "root";
    private $password = "";
    private $dbname = "bancodedados";
    private $conexao = null; 

    public function __construct()
    {          
        $this->connect();
    }

    public function getConnection()
    {
        return $this->conexao;
    }

    private function connect() 
    {
    	try{
			$str = "mysql:host=".$this->host.";dbname=".$this->dbname;
            $this->conexao = new PDO($str, $this->username, $this->password
            // , array(PDO::ATTR_PERSISTENT => true)
            );
            //qualquer coisa tirar o array do PDO::ATTR_PERSISTENT
			$this->conexao->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		}catch(PDOException $e){
			echo "Erro na conexão: " . $e->getMessage();
        }

        //$this->conexao = null;

    }
}

?>
