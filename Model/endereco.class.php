<?php 

    class Endereco{

        private $idEndereco;
        private $cep;
        private $bairro;
        private $rua;
        private $numero;
        private $complemento;

        public function getIdEndereco() {
            return $this->idEndereco;
        }

        public function setIdEndereco($idEndereco){
            $this->idEndereco = $idEndereco;
        }

        public function getCep() {
            return $this->cep;
        }

        public function setCep($cep){
            $this->cep = $cep;
        }

        public function getBairro() {
            return $this->bairro;
        }

        public function setBairro($bairro){
            $this->bairro = $bairro;
        }

        public function getRua() {
            return $this->rua;
        }

        public function setRua($rua){
            $this->rua = $rua;
        }

        public function getNumero() {
            return $this->numero;
        }

        public function setNumero($numero){
            $this->numero = $numero;
        }

        public function getComplemento() {
            return $this->complemento;
        }

        public function setComplemento($complemento){
            $this->complemento = $complemento;
        }

    }

?> 