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

				$this->setData($results[0]);
			}

		}

		//Lista de usuários de acordo com a data de cadastro
		public static function listAll(){

			$sql = new Sql();

			return $sql->select("SELECT * FROM tb_usuarios ORDER BY data_cadastro ASC");

		}

		//Lista de úsuários com este login
		public static function listLogin($login){

			$sql = new Sql();

			return $sql->select("SELECT * FROM tb_usuarios WHERE login_usuario LIKE :SEARCH ORDER BY data_cadastro", array(
				":SEARCH"=>"%".$login."%"
			));
		}

		//Lista de dados do usuário logado
		public function login($login, $Password){

			$sql = new Sql();

			$results = $sql->select("SELECT * FROM tb_usuarios WHERE login_usuario = :LOGIN AND senha_usuario = :PASSWORD", array(
				":LOGIN"=>$login,
				":PASSWORD"=>$Password
			));

			if(count($results) > 0){

				$this->setData($results[0]);
				

			}else{

				throw new Exception("Há erro em seu acesso, revise os dados e tente novamente!");
				

			}

		}

		public function setData($data){

			$this->setIdusuario($data['id_usuario']);
			$this->setLogin($data['login_usuario']);
			$this->setSenha($data['senha_usuario']);
			$this->setDtcadastr(new DateTime($data['data_cadastro']));
		}

		public function insert(){

			$sql = new Sql();

			$results = $sql->select("CALL sp_usuarios_insert (:LOGIN, :PASSWORD)", array(

					':LOGIN'=>$this->getLogin(),
					':PASSWORD'=>$this->getSenha()

			));

			if(count($results) > 0){

				$this->setData($results[0]);

			}
			
		}

		public function update($login, $password){

			$this->setLogin($login);
			$this->setSenha($password);

			$sql = new Sql();

			$sql->query("UPDATE tb_usuarios SET login_usuario = :LOGIN, senha_usuario = :PASSWORD WHERE id_usuario = :ID", array(

				":LOGIN"=>$this->getLogin(),
				":PASSWORD"=>$this->getSenha(),
				":ID"=>$this->getIdusario()

			));

		}

		public function delete(){

			$sql = new Sql();

			$sql->query("DELETE FROM tb_usuarios WHERE id_usuario = :ID", array(
				":ID"=>$this->getIdusario()
			));

			$this->setIdusuario(null);
			$this->setLogin(null);
			$this->setSenha(null);
			$this->setDtcadastr(new DateTime());

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