<?php
// Aluno: Jorge A C Andrade. R.A.: 1619107-5
// MAPA DE PROGRAMAÇÂO III
// Script que recebe chamadas ajax para cadastrar o arquivo

include '../classes/Diretorio.php';

// criação de uma instância da classe diretório na pasta uploads;
$dir = new Diretorio('uploads');
//roteamento de chamadas
//Se a chamada for GET, retorna um json contendo o nome de todos os arquivos contidos no diretório de upload.
if($_SERVER['REQUEST_METHOD'] === 'GET'){
	header("Content-Type: application/json; charset=utf-8");
	echo json_encode($dir->getFiles());
}else if($_SERVER['REQUEST_METHOD'] === 'POST'){//	--> se a chamada for post, começa o processo de upload do arquivo.

	if(!preg_match_all("/^[\w]+$/im", $_POST['newname'])){//  --> valida o nome escolhido para garantir somente caracteres validos usando regex.
		http_response_code(400);	
		echo "Nome do arquivo é invalido";
	}else{
		$img_ext =  substr($_FILES['file']['type'], strrpos($_FILES['file']['type'], "/") + 1);
		$new_name = $_POST['newname'].".".$img_ext;
		$tmp_name = $_FILES['file']['tmp_name'];
		if($img_ext != "jpeg" && $img_ext != "jpg" && $img_ext != "png" ){// --> valida tipo do arquivo, aceita somente JPEG/JPG/PNG.
			http_response_code(415);
			echo "Tipo de arquivo não suportado ".$img_ext;
		}else if($dir->exists($new_name)){// --> garante que não existam arquivos com nomes duplicados;
			http_response_code(409);
			echo "Já existe um arquivo com este nome";

		}else {
			if($dir->saveFile($tmp_name, $new_name)){// --> salva o arquivo e retorna um json com todos os arquivos no diretório após operação.
				header("Content-Type: application/json");
				echo json_encode($dir->getFiles());
			}else {
				http_response_code(500);// --> retona erro caso não consiga salvar o arquivo.
				echo "Erro ao salvar o arquivo!";
			}
		}
	}
	
}else {//  --> Aceitar somente os métodos GET e POST;
	http_response_code(405);	
	echo "Método não permitido";
}
?>
