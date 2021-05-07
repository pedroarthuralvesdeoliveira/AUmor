<?php
    CLASS ListaInteresse{
        private $idUsuario;
        private $idAnimal;
        private $dataInteresse;

        public function getIdUsuario(){
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

        public function getDataInteresse(){
            return $this->dataInteresse;
        }

        public function setDataInteresse($dataInteresse){
            $this->dataInteresse = $dataInteresse;
        }
    }
?>