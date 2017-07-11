<?php
// Aluno: Jorge A C Andrade. R.A.: 1619107-5
// MAPA DE PROGRAMAÇÂO III
// declaração da classe diretório
// A interface diretórioInterface foi levemente alterada para se encaixar melhor à arquitetura.
//
interface DiretorioInterface
{
    public function getFiles();
    public function removeFile($nome_arquivo);
    public function saveFile($nome_tmp, $novo_nome);
}

class Diretorio implements DiretorioInterface
{
//constroi classe, recebe url do diretório
	public function __construct($dir_name)
	{
		$this->dir = dir($dir_name);
		$this->dir_name = $dir_name."/";
	} 

//listar diretorios
	public function getFiles(){
		return preg_grep('/^([^.])/', scandir($this->dir_name)); 
	}
//excluir arquivos
	public function removeFile($file_name){
		if(file_exists($this->dir_name.$file_name)){
			unlink($this->dir_name.$file_name);
		}
		return $this->getFiles();
	}
//cadastrar aruivos
	public function saveFile($tmp_name, $new_name){
		return move_uploaded_file($tmp_name, $this->dir_name.$new_name);
	}
//arquivo existe?
    public function exists($file_name){
	    return file_exists($this->dir_name.$file_name);
    }
}
?>
