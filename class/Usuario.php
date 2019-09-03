<?php

	class Usuario{


		private $idusuario;
		private $login;
		private $senha;
		private $dtcadastro;

		//GETS
		public function getIdusario(){ return $this->idusuario; }
		public function getLogin(){ return $this->login; }
		public function getSenha(){ return $this->senha; }
		public function getDtcadastro(){ return $this->dtcadastro; }

		//SETTERS
		public function setIdusuario($idusuario){$this->idusuario = $idusuario;}
		public function setLogin($login){$this->login = $login;}
		public function setSenha($senha){$this->senha = $senha;}
		public function setDtcadastr($dtcadastro){$this->dtcadastro = $dtcadastro;}

		//Localizar dados do usuário de acorodo com id
		public function localizaById($id){

			$sql = new Sql();

			$results = $sql->select("SELECT * FROM tb_usuarios WHERE id_usuario = :ID", array(
				":ID"=>$id
			));

			if(count($results) > 0){

				$row = $results[0];

				$this->setIdusuario($row['id_usuario']);
				$this->setLogin($row['login_usuario']);
				$this->setSenha($row['senha_usuario']);
				$this->setDtcadastr(new DateTime($row['data_cadastro']));

			}

		}

		//Se o programador der um echo no objeto, mostrará as informações
		public function __toString(){

			return json_encode(array(
				"id_usuario"=>$this->getIdusario(),
				"login_usuario"=>$this->getLogin(),
				"senha_usuario"=>$this->getSenha(),
				"data_cadastro"=>$this->getDtcadastro()->format("d/m/Y H:i:s")
			));

		}

	}

?>