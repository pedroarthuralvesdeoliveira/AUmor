<?php
    class Animal {

        private $idAnimal;
        private $idUsuario;
        private $nome;
        private $idade;
        private $porte;
        private $sexo;
        private $comportamento;
        private $saude;
        private $tipo;
        private $imagem;
        private $motivoAdocao;
        private $dataInscricao;
        private $statusDesativar;
        private $statusAprovacao;
        private $statusAdocao;

        public function getIdAnimal() {
            return $this->idAnimal;
        }

        public function setIdAnimal($idAnimal){
            $this->idAnimal = $idAnimal;
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

        public function getIdade() {
            return $this->idade;
        }

        public function setIdade($idade){
            $this->idade = $idade;
        }

        public function getPorte() {
            return $this->porte;
        }

        public function setPorte($porte){
            $this->porte = $porte;
        }

        public function getSexo() {
            return $this->sexo;
        }

        public function setSexo($sexo){
            $this->sexo = $sexo;
        }

        public function getComportamento() {
            return $this->comportamento;
        }

        public function setComportamento($comportamento){
            $this->comportamento = $comportamento;
        }

        public function getSaude() {
            return $this->saude;
        }

        public function setSaude($saude){
            $this->saude = $saude;
        }

        public function getTipo() {
            return $this->tipo;
        }

        public function setTipo($tipo){
            $this->tipo = $tipo;
        }


        public function getImagem() {
            return $this->imagem;
        }

        public function setImagem($imagem){
            $this->imagem = $imagem;
        }

        public function getMotivoAdocao() {
            return $this->motivoAdocao;
        }

        public function setMotivoAdocao($motivoAdocao){
            $this->motivoAdocao = $motivoAdocao;
        }        

        public function getDataInscricao() {
            return $this->dataInscricao;
        }

        public function setDataInscricao($dataInscricao){
            $this->dataInscricao = $dataInscricao;
        }

        public function getStatusDesativar(){
            return $this->statusDesativar;
        }

        public function setStatusDesativar($statusDesativar){
            $this->statusDesativar = $statusDesativar;
        }

        public function getStatusAprovacao(){
            return $this->statusAprovacao;
        }

        public function setStatusAprovacao($statusAprovacao){
            $this->statusAprovacao = $statusAprovacao;
        }

        public function getStatusAdocao(){
            return $this->statusAdocao;
        }

        public function setStatusAdocao($statusAdocao){
            $this->statusAdocao = $statusAdocao;
        }
    }
?>