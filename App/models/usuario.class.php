<?php
    namespace App\Models;
    class Usuario
    {
        private $idUsuario;
        private $nome;
        private $sobrenome;
        private $rg;
        private $dataNasc; 
        private $telefone;
        private $email;
        private $senha;
        private $imagem;
        private $dataCadastro;
        private $tipoUser;
        private $statusValidacao; 
        private $descricao;
        
        private $idEndereco;
        
        public function getIdEndereco() {
            return $this->idEndereco;
        }

        public function setIdEndereco($idEndereco){
            $this->idEndereco = $idEndereco;
        }

        public function getIdUsuario() {
            return $this->idUsuario;
        }

        public function setIdUsuario($idUsuario){
            $this->idUsuario = $idUsuario;
        }

        public function getNome() {
            return $this->nome;
        }

        public function setNome($nome){
            $this->nome = $nome;
        }

        public function getSobrenome() {
            return $this->sobrenome;
        }

        public function setSobrenome($sobrenome){
            $this->sobrenome = $sobrenome;
        }

        public function getRg() {
            return $this->rg;
        }

        public function setRg($rg){
            $this->rg = $rg;
        }

        public function getDataNasc() {
            return $this->dataNasc;
        }

        public function setDataNasc($dataNasc){
            $this->dataNasc = $dataNasc;
        }

        public function getTelefone() {
            return $this->telefone;
        }

        public function setTelefone($telefone){
            $this->telefone = $telefone;
        }

        public function getEmail() {
            return $this->email;
        }

        public function setEmail($email){
            $this->email = $email;
        }

        public function getSenha() {
            return $this->senha;
        }

        public function setSenha($senha){
            $this->senha = $senha;
        }

        public function getImagem() {
            return $this->imagem;
        }

        public function setImagem($imagem){
            $this->imagem = $imagem;
        }

        public function getDataCadastro() {
            return $this->dataCadastro;
        }

        public function setDataCadastro($dataCadastro){
            $this->dataCadastro = $dataCadastro;
        }

        public function getTipoUser() {
            return $this->tipoUser;
        }

        public function setTipoUser($tipoUser){
            $this->tipoUser = $tipoUser;
        }

        public function getStatusValidacao() {
            return $this->statusValidacao;
        }

        public function setStatusValidacao($statusValidacao){
            $this->statusValidacao = $statusValidacao;
        }

        public function getDescricao() {
            return $this->descricao;
        }

        public function setDescricao($descricao){
            $this->descricao = $descricao;
        }
    }
