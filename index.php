<?php


		require_once("config.php");

		//Seleciona todos os usuários
		/*
		$sql = new Sql();

		$usuarios = $sql->select("SELECT * FROM tb_usuarios");

		echo json_encode($usuarios);
		*/

		//Seleciona um usuário específico
		/*$user = new Usuario();

		$user->localizaById(3);

		echo $user;*/

		//Seleciona todos os usuários em lista ordenada pela data de Criação
		/*
		$listAll = Usuario::listAll();

		echo json_encode($listAll);
		*/
		//Seleciona todos os usuários que contenham esse texto no login
		/*$serch = Usuario::listLogin("jo");

		echo json_encode($serch);*/

		//Seleciona dados de Login
		/*$user = new Usuario;

		$user->login("Joaozinho", "opaskdaos");
		
		echo $user;*/

		//INSERE UM REGISTRO DE USUÁRIO E RETORNA AS INFORMAÇÕES
		/*$aluno = new Usuario();

		$aluno->setLogin("Aluno Novo");
		$aluno->setSenha("@lun0");

		$aluno->insert();

		echo $aluno;*/

		//Localiza e ediata dados de um usuário com este login
		$user = new Usuario();

		$user->localizaById(20);

		$user->update("Professor Xavier", "liSuAMente98");

		echo $user;
?>