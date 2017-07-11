<?php
// Aluno: Jorge A C Andrade. R.A.: 1619107-5
// MAPA DE PROGRAMAÇÂO III
//Página principal, contém a estrutura base do layout 
//foi inserido uma caixa de mensagem informativa explicando os caracteres permitidos para o nome do arquivo
//apenas caracteres alfa-numéricos e _ são permitidos para garantir compatibilidade de SOs.
//A validação client side e o aspecto dinâmico da pagina são controlados no arquivo main.js
//Para esta atividade, escolhi seguir o pdrão de Single Page Application, amplamente utilizado atualmente.
//Para isso, a pagina idnex apresenta as informações estáticamente e o arquivo javascript main.js
//realiza chamadas assíncronas para o webserver php e atualiza os resultados dinâmicamente na página principal.
//O javascript tambem é responsável por validar o formulário e exibir feedback ao usuário.
//Foram incluidas algumas classes a alguns elementos para facilitar o controle via jquery.
?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>MAPA</title>

    <!-- Bootstrap Core CSS -->
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- MetisMenu CSS -->
    <link href="vendor/metisMenu/metisMenu.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="dist/css/sb-admin-2.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body>

    <div id="wrapper">

        <!-- Navigation -->
        <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
            <div class="navbar-header">
                <a class="navbar-brand" href="index.php">MAPA - EAD UniCesumar</a>
            </div>
            <!-- /.navbar-header -->
        </nav>

        <div id="page-wrapper" style="margin-left:0px">
            <div class="row">
                <div class="col-md-6 col-md-offset-3">
                    <h1 class="page-header">Leitura de Pasta e Envio de Arquivos</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-md-6 col-md-offset-3">
                    <div class="panel panel-default panel-file-upload">
                        <div class="panel-heading">
                            Digite o nome do arquivo e anexe o documento...
                        </div>
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-lg-12">
                                    <form role="form">
                                        <div class="form-group">
                                            <label>Nome do Arquivo</label>
					    <div class="alert alert-info">
						<strong>Atenção!</strong> Use apenas caracteres alfa-numéricos. 
Espaços não são permitidos e devem ser substituídos por _ (subtraço). Não é necessário digitar a extensão do arquivo.
					    </div>
                                            <input class="form-control" id="file-name">
                                            <p class="help-block">Digite o nome que o arquivo será salvo...</p>
                                        </div>
                                        <div class="form-group">
                                            <label>Anexar Arquivo</label>
                                            <input type="file" id="file">
                                        </div>
                                        <button type="submit" class="btn btn-active">Enviar Arquivo</button>
                                    </form>
                                </div>
                                <!-- /.col-lg-12 (nested) -->    
                            </div>
                            <!-- /.row (nested) -->
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            
            <div class="row">
                <div class="col-md-6 col-md-offset-3">
                     <div class="panel panel-default panel-file-list">
                        <div class="panel-heading">
                            Relatório de Arquivos
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Arquivo</th>
                                            <th>Excluir?</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                </table>
                            </div>
                            <!-- /.table-responsive -->
                        </div>
                        <!-- /.panel-body -->
                    </div>
                </div>
            </div>
            
        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

    <!-- jQuery -->
    <script src="vendor/jquery/jquery.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="vendor/bootstrap/js/bootstrap.min.js"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="vendor/metisMenu/metisMenu.min.js"></script>

    <!-- Custom Theme JavaScript -->
    <script src="dist/js/sb-admin-2.js"></script>

    <!-- Front-End Controller -->
    <script src="main.js"></script>

</body>

</html>
