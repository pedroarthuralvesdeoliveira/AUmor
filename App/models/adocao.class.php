<?php
    class Adocao{
        
        private $idAdocao;
        private $idUsuario;
        private $idAnimal;
        private $dataAdocao;
        private $dataDevolucao;
        private $dataRegistro;
        private $status; 
        private $idUsuarioFinal; 

        public function getIdAdocao() {
            return $this->idAdocao;
        }

        public function setIdAdocao($idAdocao){
            $this->idAdocao = $idAdocao;
        }

        public function getIdUsuario() {
            return $this->idUsuario;
        }

        public function setIdUsuario($idUsuario){
            $this->idUsuario = $idUsuario;
        }

        public function getIdAnimal() {
            return $this->idAnimal;
        }

        public function setIdAnimal($idAnimal){
            $this->idAnimal = $idAnimal;
        }

        public function getDataAdocao() {
            return $this->dataAdocao;
        }

        public function setDataAdocao($dataAdocao){
            $this->dataAdocao = $dataAdocao;
        }

        public function getDataDevolucao() {
            return $this->dataDevolucao;
        }

        public function setDataDevolucao($dataDevolucao){
            $this->dataDevolucao = $dataDevolucao;
        }

        public function getDataRegistro(){
            return $this->dataRegistro;
        }

        public function setDataRegistro($dataRegistro){
            $this->dataRegistro = $dataRegistro;
        }

        public function getStatus(){
            return $this->status;
        }

        public function setStatus($status){
            $this->status = $status;
        }

        public function getIdUsuarioFinal(){
            return $this->idUsuarioFinal;
        }

        public function setIdUsuarioFinal($idUsuarioFinal){
            $this->idUsuarioFinal = $idUsuarioFinal;
        }

    }
?> 