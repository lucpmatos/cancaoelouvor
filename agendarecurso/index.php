<?php
/************************************************************************************************************************
 * Desenvolvido por: Rogger de Souza Oliveira;
 * Email: rogger@hostplan.com.br;
 * Data: 16/09/2016;
 * Modulo: Agenda de Recurso (0021)
 ************************************************************************************************************************/

include ("../../include/config2.php");
include ("Custom.php");
ini_set("display_errors",0);

$url="portal2.php?&menu=0021";


//VERIFICA NIVEL DE PERMISSÃO
$q4=mssql_query("SELECT B.NIVEL
    FROM $base1..PHPMENU A
    JOIN $base1..PHPPERMISSAO B ON B.CODMENU = A.CODMENU
    JOIN $base1..PHPUSUARIOPERFIL C ON C.CODPERFIL = B.CODPERFIL
    WHERE C.CODUSUARIO='$gusuario' AND A.CODIGO='0021'");
$r4=mssql_fetch_object($q4);
    
    
if($op=='' or $op=='Pesquisar'){
    
    if($datape==''){ $dtpesquisa=$hoje; } else { $dtpesquisa=$datape; } 

}
elseif($op=='Salvar'){
    
    $MMl = substr("$ghora", 3, 5);
    $MMl = intval($MMl);
    $HRl = substr("$ghora", 0, 2);
    $HRl = intval($HRl);
    $HRl=$HRl*60;
    $Hl=$MMl+$HRl;
         
    $MMi = substr("$horaini", 3, 5);
    $MMi = intval($MMi);
    $HRi = substr("$horaini", 0, 2);
    $HRi = intval($HRi);
    $HRi=$HRi*60;
    $HI=$MMi+$HRi;
    
    //echo "$HRi : $MMi";
    
    $MMf = substr("$horafim", 3, 5);
    $MMf = intval($MMf);
    $HRf = substr("$horafim", 0, 2);
    $HRf = intval($HRf);
    $HRf=$HRf*60;
    $HF=$MMf+$HRf;
    
    //echo "<br>$HRf : $MMf ";
    
    $dia = substr("$dataag", 8, 10);
    $mes = substr("$dataag", -5, -3);
    $ano = substr("$dataag", -10, -6);
  
    $datag="$ano$mes$dia";

     $datag2=$datag-1;
    
    if($datag2 == $hoje){ 
        if($Hl > $limitehorario){ echo "<script>alert(' $datag - $hoje Fora do periodo permitido! #cod1')</script><script>window.open('$url','_parent','')</script>";  
        } 
    }
    if($datag < $hoje){ echo "<script>alert(' $datag - $hoje Fora do periodo permitido! #cod2')</script><script>window.open('$url','_parent','')</script>"; }
   
    
    $q1=mssql_query("SELECT IDAGENDA FROM $base1..PHPAGENDAMENTO
        WHERE DATA='$datag' AND STATUS<>'C' AND IDPRODUTO=$idproduto
        AND (HORAINI BETWEEN '$HI' AND '$HF' OR HORAFIM BETWEEN '$HI' AND '$HF')");
    $r1=mssql_fetch_object($q1);
    
    if($r1->IDAGENDA==''){
    
   mssql_query("INSERT INTO $base1..PHPAGENDAMENTO VALUES ('$idproduto','$gcusto','$cc2','$datag','$HI','$HF','P','$datahora','','','$descricao','')");

      echo "<script>alert('Cadastro efetuado com sucesso!')</script><script>window.open('$url','_parent','')</script>";
   
    } else {
        
      echo "<script>alert('Horario não disponivel!')</script><script>window.open('$url','_parent','')</script>";
    }
        
}

if($op=='Aprovar') { 
    
    mssql_query("UPDATE $base1..PHPAGENDAMENTO SET STATUS='A' WHERE IDAGENDA=$idagenda"); 
    echo "<script>alert('Reserva Aprovada!')</script><script>window.open('$url','_parent','')</script>";
}
if($op=='Cancelar'){ 
    
    mssql_query("UPDATE $base1..PHPAGENDAMENTO SET STATUS='C' WHERE IDAGENDA=$idagenda"); 
    echo "<script>alert('Reserva Cancelada!')</script><script>window.open('$url','_parent','')</script>";
}
if($op=='Excluir'){ 
    
    mssql_query("DELETE FROM $base1..PHPAGENDAMENTO WHERE IDAGENDA=$idagenda"); 
    echo "<script>alert('Reserva Excluir!')</script><script>window.open('$url','_parent','')</script>";
}
?>
<html>
<head>
    <meta charset="UTF-8">
    <title></title>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    <link href="../../dist/css/Custom.css" rel="stylesheet" type="text/css" />
</head>
<body>
    <section class="content">
    <div class="box box">
    <section class="content-header">
        <ol class="breadcrumb">
            <li><a href="portal2.php?&menu=0021"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active"> Reservar Recurso</li>
        </ol>
    </section>
        <div class="box-body">
            <div class="btn-group">
                      <button type="button" class="btn btn-default btn-flat">Ações</button>
                      <button type="button" class="btn btn-default btn-flat dropdown-toggle" data-toggle="dropdown">
                        <span class="caret"></span>
                        <span class="sr-only">Toggle Dropdown</span>
                      </button>
                      <ul class="dropdown-menu" role="menu">
                        <li><a href="portal2.php?&menu=0023">Gerar Relatorio</a></li>
                        <li><a href="portal2.php?&menu=0025">Fechamento Dia</a></li>
                        <li><a href="portal2.php?&menu=0022">Cadastro de Recursos</a></li>
            </div>
            <div class="col-md-4">
                <h3 class="page-header">Reservar Horario</h3>
                <form role="form" action="portal2.php?&menu=0021" name="form1" method="post" id="form1">
                    <div class="form-group">
                        <label>Recurso</label>
                        <select class="form-control" name="idproduto" id="idproduto">
   <?php
   $q0=mssql_query("SELECT * FROM $base1..PHPPRODUTO");
    while ($r0=mssql_fetch_object($q0)) {
        
        echo "<option value='$r0->IDPRODUTO'>$r0->NOME</option>;";
    } 
    ?>
                        </select>
                    </div>
                    <div class="form-group">
                    <label>Data:</label>
                    <div class="input-group">
                      <div class="input-group-addon">
                        <i class="fa fa-calendar"></i>
                      </div>
                        <input type="date" name="dataag" id="dataag" class="form-control" required/>
                    </div>
                    </div>
                    <div class="form-group">
                      <div class="col-md-5">
                        <div class="input-group">
                        <div class="input-group-addon">
                          <i class="fa fa-clock-o"></i>
                        </div>
                            <input type="text" name="horaini" id="horaini" class="form-control" required data-inputmask="'alias': 'hh:mm'" data-mask/>
                        </div>
                      </div>
                      <div class="col-md-5">
                        <div class="input-group">
                        <div class="input-group-addon">
                          <i class="fa fa-clock-o"></i>
                        </div>
                            <input type="text" name="horafim" id="horafim" class="form-control" required data-inputmask="'alias': 'hh:mm'" data-mask /> 
                        </div>
                      </div>
                    </div>
                    <div class="form-group">
                    <label>Descrição:</label>
                        <input type="text" name="descricao" id="descricao" class="form-control"/>
                    </div>
                    <div class="form-group">
                       <label>Centro de Custo</label>
                       <select class="form-control" name="cc2" id="idproduto">
                       <option value='0'>--- Selecione ---</option>;";
    <?php 
    $q3=mssql_query("$sql1");
    while ($r3=mssql_fetch_object($q3)) {

         $nome3=utf8_encode($r3->NOME);

         echo "<option value='$r3->CODIGO'>$r3->CODIGO $nome3</option>;";
     } 
     ?>
                       </select>
                    </div>
                    <div class="box-body"> 
                     <button class="btn btn-info btn-flat" type="submit" name="op" value="Salvar">Salvar</button>   
                    </div>
                </form>
            </div>
                <div class="col-md-8">
                <h3 class="page-header">Calendario</h3>
                <form role="form" action="portal2.php?&menu=0021" name="form1" method="post" id="form1">
                <div class="col-md-6">
                    <div class="input-group">
                      <div class="input-group-addon">
                        <i class="fa fa-calendar"></i>
                      </div>
                      <input type="date" name="datape" id="datape" class="form-control"/>
                    </div>
                </div>
                <div class="col-md-1">
                    <button class="btn btn-info btn-flat" type="submit" name="op" value="Pesquisar"><i class="fa fa-search"></i></button>    
                </div>
                </form>
            <div class="box-body no-padding">
            <table class="table table-hover">
                 <tr>
                    <th>Data</th>
                    <th>Produto</th>
                    <th>Cc Funcionario</th>
                    <th>Hr Inicio</th>
                    <th>Hr Fim</th>
                    <th>Situação</th>
                 </tr>
<?php    
    $q1=mssql_query("SELECT CONVERT (VARCHAR, A.DATA,103) AS DATA, B.NOME, A.CODCCUSTO, A.USRAPROVACAO
 , Cast( Floor(HORAINI / 60) as varchar) + ':' +
            Right('00' + Cast( Floor((HORAINI % 60)) as varchar), 2) as INI
 , Cast( Floor(HORAFIM / 60) as varchar) + ':' +
            Right('00' + Cast( Floor((HORAFIM % 60)) as varchar), 2) as FIM
  , (CASE A.STATUS WHEN 'P' THEN 'Pendente' WHEN 'A' THEN 'Agendado' WHEN 'C' THEN 'Cancelado' WHEN 'R' THEN 'Realizado'
	END) AS STATUS
FROM $base1..PHPAGENDAMENTO A
JOIN $base1..PHPPRODUTO B ON A.IDPRODUTO = B.IDPRODUTO
    WHERE A.DATA='$dtpesquisa' AND A.STATUS<>'C'
ORDER BY HORAINI         ");
    while ($r1=mssql_fetch_object($q1)) {
    
    echo "      <tr>
                    <td class='Letra12'>$r1->DATA</td>
                    <td>$r1->NOME</td>
                    <td>$r1->CODCCUSTO</td>
                    <td>$r1->INI</td>
                    <td>$r1->FIM</td>
                    <td>$r1->STATUS</td>
                 </tr>  ";         
    }   
?>
                </table>
                </div>
                </div>
        </div>
<?php
if($r4->NIVEL==2){
    echo "<div class='box box'>
        <div class='box-body'>
            <h3 class='page-header'>Aprovação de Reserva</h3>
            <table class='table table-hover'>
                 <tr>
                    <th>Data</th>
                    <th>Produto</th>
                    <th>Cc Funcionario</th>
                    <th>Cc Consumo</th>
                    <th>Hr Inicio</th>
                    <th>Hr Fim</th>
                    <th>Descricão</th>
                    <th></th>
                    <th></th>
                    <th></th>
                 </tr>";
            
     $q2=mssql_query("SELECT CONVERT (VARCHAR, A.DATA,103) AS DATA, B.NOME, A.CODCCUSTO, A.CODCCUSTO2, A.DESCRICAO, D.NOME AS CC, A.IDAGENDA
 , Cast( Floor(HORAINI / 60) as varchar) + ':' +
            Right('00' + Cast( Floor((HORAINI % 60)) as varchar), 2) as INI
 , Cast( Floor(HORAFIM / 60) as varchar) + ':' +
            Right('00' + Cast( Floor((HORAFIM % 60)) as varchar), 2) as FIM
  , (CASE A.STATUS WHEN 'P' THEN 'Pendente' WHEN 'A' THEN 'Agendado' WHEN 'C' THEN 'Cancelado'
	END) AS STATUS
FROM $base1..PHPAGENDAMENTO A
JOIN $base1..PHPPRODUTO B ON A.IDPRODUTO = B.IDPRODUTO
JOIN $base2..GCCUSTO C ON A.CODCCUSTO2 collate database_default = C.CODCCUSTO collate database_default    
LEFT JOIN $base2..GCCUSTO D ON A.CODCCUSTO collate database_default =D.CODCCUSTO collate database_default 
    WHERE A.STATUS='P'
    GROUP BY A.DATA,B.NOME,A.CODCCUSTO,C.NOME, A.STATUS, A.HORAINI, A.HORAFIM, A.IDAGENDA, A.CODCCUSTO2, A.DESCRICAO, D.NOME
ORDER BY A.DATA , A.HORAINI");
    while ($r2=mssql_fetch_object($q2)) {

        echo "<tr>
                    <td><h5>$r2->DATA</h5></td>
                    <td><h5>$r2->NOME</h5></td>
                    <td><h5>$r2->CODCCUSTO-$r2->CC</h5></td>
                    <td><h5>$r2->CODCCUSTO2</h5></td>
                    <td><h5>$r2->INI</h5></td>
                    <td><h5>$r2->FIM</h5></td>
                    <td><h5>$r2->DESCRICAO</h5></td>
                    <td><h5><a href='portal2.php?menu=0021&op=Aprovar&idagenda=$r2->IDAGENDA' title='Aprovar'><i class='fa fa-check-circle-o'></i></a></h5></td>
                    <td><h5><a href='portal2.php?menu=0024&idagenda=$r2->IDAGENDA' title='Editar'><i class='fa fa-edit'></i></a></h5></td>
                    <td><h5><a href='portal2.php?menu=0021&op=Excluir&idagenda=$r2->IDAGENDA' title='Excluir'><i class='fa fa-trash-o'></i></a></h5></td>
               </tr>  ";      
    }
 echo "     </table>
        </div>
    </div> ";            
 }
?>
</section>

</body>
</html>
