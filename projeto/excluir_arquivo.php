<?php
// Aluno: Jorge A C Andrade. R.A.: 1619107-5
// MAPA DE PROGRAMAÇÂO III
// Script que recebe chamadas ajax para exclusão de arquivos via método DELETE.
//
// criação da instância da classe diretório.
include '../classes/Diretorio.php';
$dir = new Diretorio('uploads');

//Este metodo apenas retorna o resultado da função de remoção da classe diretório.
//caso o arquivo não exista, é retornado a lista dos arquivos no diretório.
if($_SERVER['REQUEST_METHOD'] === 'DELETE'){
	if(isset($_SERVER['QUERY_STRING'])){
		header("Content-Type: application/json; charset=utf-8");
		echo json_encode($dir->removeFile($_SERVER['QUERY_STRING']));
	}
}else {// --> apenas o método DELETE é aceito.
	http_response_code(405);	
	echo "Método não permitido";
}

?>
