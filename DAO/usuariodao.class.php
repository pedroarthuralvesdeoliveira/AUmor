<?php
    require_once("../Model/usuario.class.php");
    
    class UsuarioDAO{
        private $db;


		public function __construct(Database $db){

			$this->db = $db;

        }

        public function Acessar(){
            
            $idUsuario = $_SESSION['idUsuario'];

            try{
                    $sql = "SELECT * from usuario WHERE idUsuario = :idUsuario";
                    $stmt = $this->db->getConnection()->prepare($sql);

                    $stmt->bindValue(':idUsuario', $idUsuario);
                    $stmt->execute();

                    $dados = $stmt->fetch(PDO::FETCH_OBJ);
            } catch (PDOException $e){
                    echo "Erro: " . $e->getMessage();
            }
                return $dados;
        }

        public function AcessarNome($id){

            $idUsuario = $id;

            try{
                    $sql = "SELECT nome from usuario WHERE idUsuario = :idUsuario";
                    $stmt = $this->db->getConnection()->prepare($sql);

                    $stmt->bindValue(':idUsuario', $idUsuario);
                    $stmt->execute();

                    $dados = $stmt->fetch(PDO::FETCH_ASSOC);
            }catch (PDOException $e){
                    echo "Erro: " . $e->getMessage();
            }
                return $dados;
        }

        public function buscaUsuario($id){

            $idUsuario = $id;

            try {
                    $sql = "SELECT * from usuario WHERE idUsuario = :idUsuario";
                    $stmt = $this->db->getConnection()->prepare($sql);

                    $stmt->bindValue(':idUsuario', $idUsuario);
                    $stmt->execute();

                    $dados = $stmt->fetchAll(PDO::FETCH_ASSOC);
            }catch (PDOException $e){
                    echo "Erro: " . $e->getMessage();
            }
                return $dados;
        }

        public function buscarDonoAnimal($idAnimal, $idUsuario){
            $usuario = $idUsuario;
            $animal = $idAnimal;

            try {

                $sql = "SELECT email FROM usuario WHERE idUsuario = :usuario AND :usuario IN (SELECT idUsuario FROM animal WHERE idUsuario = :usuario AND idAnimal = :animal)";
                $stmt = $this->db->getConnection()->prepare($sql);

                // $stmt->bindValue(':usuario', $usuario);
                // $stmt->bindValue(':animal', $animal);
                // $stmt->execute();
                $stmt->execute(array(
                    ':usuario' => $usuario,
                    ':animal' => $animal
                ));

                $dados = $stmt->fetch(PDO::FETCH_OBJ);

            }catch (PDOException $e){
                echo "Erro: " . $e->getMessage();
            }   
                return $dados;
        }

        public function dadosUsuarioFinal($idAnimal, $idUsuario){
            $usuario = $idUsuario;
            $animal = $idAnimal;
            try {

                $sql = "SELECT imagem, email, nome, telefone FROM usuario WHERE idUsuario = :usuario AND EXISTS (SELECT idUsuarioFinal FROM adocao WHERE idUsuarioFinal = :usuario)";
                $stmt = $this->db->getConnection()->prepare($sql);

                $stmt->execute(array(
                    ':usuario' => $usuario,
                    ':animal' => $animal
                ));

                $dados = $stmt->fetch(PDO::FETCH_OBJ);

            }catch (PDOException $e){
                echo "Erro: " . $e->getMessage();
            }   
                return $dados;
        }

        public function Desativar($id){
            $idUsuario = $id;
            $status = 0;
    			try {
                    $stmt = $this->db->getConnection()->prepare('UPDATE usuario SET StatusDesativar = :status WHERE idUsuario = :idUsuario');
                    $stmt->execute(array(
                        ':idUsuario' => $idUsuario,
                        ':status' => $status,
    				));
    			} catch(PDOException $e) {
    			    echo 'Error: ' . $e->getMessage();
    			}
        }

        public function EsqueceuSenha(Usuario $usuario){
            $email = $usuario->getEmail();
            try {
                $sql = 'SELECT senha FROM usuario WHERE email = :email';
                $stmt = $this->db->getConnection()->prepare($sql);
                $stmt->execute(array(
                    ':email' => $email
                ));

                $dados = $stmt->fetch(PDO::FETCH_OBJ);
            } catch(PDOException $e) {
                echo 'Error: ' . $e->getMessage();
            }
            return $dados;
        }

        public function Editar(Usuario $usuario){

            $idUsuario = $usuario->getIdUsuario();
            $nome = $usuario->getNome();
            $sobrenome = $usuario->getSobrenome();
            $telefone = $usuario->getTelefone();
            $descricao = $usuario->getDescricao();
            try {

                $stmt = $this->db->getConnection()->prepare('UPDATE usuario SET nome = :nome, sobrenome = :sobrenome, telefone = :telefone, descricao = :descricao WHERE idUsuario = :idUsuario');

                $stmt->execute(array(
                    ':idUsuario' => $idUsuario,
                    ':nome' => $nome,
                    ':sobrenome' => $sobrenome,
                    ':telefone' => $telefone,
                    ':descricao' => $descricao,
                ));

            } catch(PDOException $e) {
              echo 'Error: ' . $e->getMessage();
            }
        }

        public function EditarFoto(Usuario $usuario){

            $idUsuario = $usuario->getIdUsuario();
            $imagem = $usuario->getImagem();
            try {
                $stmt = $this->db->getConnection()->prepare('UPDATE usuario SET imagem = :imagem WHERE idUsuario = :idUsuario');
                $stmt->bindValue(':imagem', $imagem);
                $stmt->bindValue(':idUsuario', $idUsuario);
                $stmt->execute();
            } catch(PDOException $e) {
                echo 'Error: ' . $e->getMessage();
            }
        }

        public function Inserir(Usuario $usuario){

            try{

                $nome = $usuario->getNome();
                $sobrenome = $usuario->getSobrenome();
                $rg = $usuario->getRg();
                $dataNasc = $usuario->getDataNasc();
                $telefone = $usuario->getTelefone();
                $email = $usuario->getEmail();
                $senha = $usuario->getSenha();
                $imagem = $usuario->getImagem();
                $descricao = $usuario->getDescricao();

                $Pdo = $this->db->getConnection();
                $sql = 'INSERT INTO
                usuario (idEndereco, nome, sobrenome, rg, dataNasc, telefone, email,
                senha, imagem, descricao
                )
                VALUES ((SELECT MAX(idEndereco) as id FROM endereco), :nome, :sobrenome,
                :rg, :dataNasc, :telefone, :email, :senha, :imagem, :descricao
                )';

                $stmt = $Pdo->prepare($sql);

                $stmt->execute(array(
                    ':nome' => $nome,
                    ':sobrenome' => $sobrenome,
                    ':rg' => $rg,
                    ':dataNasc' => $dataNasc,
                    ':telefone' => $telefone,
                    ':email' => $email,
                    ':senha' => $senha,
                    ':imagem' => $imagem,
                    ':descricao' => $descricao,
                ));

                return $Pdo->lastInsertId();
                return $email;

            } catch(PDOException $e){
                echo 'Error: '.$e->getMessage();
            }
        }

        public function Login(Usuario $usuario){
            try{

                $email = $usuario->getEmail();
                $senha = $usuario->getSenha();

                $stmt = $this->db->getConnection()->prepare("SELECT * FROM usuario WHERE email = :email AND senha = :senha ");

                $stmt->execute(array(
                    ':email' => $email,
                    ':senha' => $senha
                ));
                

                $query = $stmt;

                if ($query->rowCount() > 0) {

                    $dados = $query->fetch(PDO::FETCH_OBJ);
                    session_start();
                    $_SESSION['idUsuario'] = $dados->idUsuario;
                    $_SESSION['idEndereco'] = $dados->idEndereco;
                    $_SESSION['nome'] = $dados->nome;
                    $_SESSION['sobrenome'] = $dados->sobrenome;
                    $_SESSION['telefone'] = $dados->telefone;
                    $_SESSION['imagem'] = $dados->imagem;
                    $_SESSION['email'] = $email;
                    $_SESSION['senha'] = $senha;
                    $_SESSION['descricao'] = $dados->descricao;
                    $_SESSION['tipoUser'] = $dados->tipoUser;
                    $_SESSION['statusValidacao'] = $dados->statusValidacao;

                    if ($_SESSION['tipoUser'] == 1) {
                        header('Location: ../View/perfilUsuarioAdmin.php');
                    } else {
                        header('Location: ../View/perfilUsuario.php');
                    }

                } else {
                    header('Location: ../View/login.php');
                    // session_destroy();
                    unset($_SESSION['nome']);
                    unset($_SESSION['email']);
                    unset($_SESSION['senha']);
                    unset($_SESSION['tipoUser']);
                    unset($_SESSION['statusValidacao']);
                }

            }catch (PDOException $e){
                echo "Erro: " . $e->getMessage();
            }
        }

        public function validarEmail($id, $email){

            try{

                $Pdo = $this->db->getConnection();
                $stmt = $Pdo->prepare('UPDATE 
                usuario SET statusValidacao = 1 WHERE idUsuario = :id AND email = :email');

                $stmt->execute(array(
                    ':id' => $id,
                    ':email' => $email
                ));

            } catch(PDOException $e){
                echo 'Error: '.$e->getMessage();
            }
                        
        }

        public function verificaEmail($emailUsuario){
            $email = $emailUsuario;

            try{

                $Pdo = $this->db->getConnection();
                $sql = "SELECT email FROM usuario WHERE email = :email";

                $stmt = $Pdo->prepare($sql);

                $stmt->execute(array(
                    ':email' => $email
                ));

                if ($stmt->rowCount()>0){
                    return true;
                }else{
                    return false;
                }

                // $dados = $stmt->fetch(PDO::FETCH_OBJ);

            } catch(PDOException $e){
                echo 'Error: '.$e->getMessage();
            }
            // return $dados;
        }

        public function verificaRg($rgUsuario){
            $rg = $rgUsuario;

            try{

                $Pdo = $this->db->getConnection();
                $sql = "SELECT rg FROM usuario WHERE rg = :rg";

                $stmt = $Pdo->prepare($sql);

                $stmt->execute(array(
                    ':rg' => $rg
                ));

                if ($stmt->rowCount()>0){
                    return true;
                }else{
                    return false;
                }

                // $dados = $stmt->fetch(PDO::FETCH_OBJ);

            } catch(PDOException $e){
                echo 'Error: '.$e->getMessage();
            }
            // return $dados;
        }
        
    }
?>
