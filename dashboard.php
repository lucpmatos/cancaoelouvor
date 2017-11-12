<?php

include_once("include/config.php");
include_once("include/xtpl.php3");

if ($op == 'Editar') {

    $x = new XTemplate("editar.html");
} else {

    $x = new XTemplate("dashboard.html");
}



//Javascript Mensagem e Modal
if ($welcome == 1) {
    $welcome = 0;
    $x->assign("SCRIPT01", "
                <script type='text/javascript'>
                    iziToast.show({
                        class: 'toastlogado',
                        title: 'Bem vindo(a)!',
                        message: 'Logado com sucesso',
                        theme: 'dark',
                        color: '#5d9084',
                        icon: 'fa fa-thumbs-o-up',
                        layout: '2',
                        position: 'bottomCenter',
                        timeout: '5000',
                        progressBarColor: 'white',
                        transitionIn: 'flipInX',
                        transitionOut: 'flipOutX'
                    });
                </script>");
}
//Pesquisa por periodo e Listagem
if ($op == '' or $op == 'Pesquisar') {

    $x->assign("Titulo", "Reservar um Horário");

    if ($datape == '') {
        $dtpesquisa = $hoje;
    } else {
        $dtpesquisa = $datape;
    }
// Edição de agenda
} elseif ($op == 'Editar') {

    $q3 = mysql_query("SELECT DATA, LOCAL, ANFITRIAO, HORAINI, HORAFIM, DESCRICAO, IDAGENDA
        FROM PHPAGENDAMENTO 
        WHERE IDAGENDA=$idagenda");
    $r3 = mysql_fetch_object($q3);

    $descricao = utf8_encode($r3->DESCRICAO);
    $horaini = gmdate("i:s", $r3->HORAINI);
    $horafim = gmdate("i:s", $r3->HORAFIM);

    $x->assign("IDAGENDA", $r3->IDAGENDA);
    $x->assign("DATA", $r3->DATA);
    $x->assign("LOCAL", $r3->LOCAL);
    $x->assign("ANFITRIAO", $r3->ANFITRIAO);
    $x->assign("HORAI", $horaini);
    $x->assign("HORAF", $horafim);
    $x->assign("STATUS", $r3->STATUS);
    $x->assign("DESCRICAO", $descricao);

//Inclusão de um novo registro na agenda    
} elseif ($op == 'Salvar') {

    $MMl = substr("$ghora", 3, 5);
    $MMl = intval($MMl);
    $HRl = substr("$ghora", 0, 2);
    $HRl = intval($HRl);
    $HRl = $HRl * 60;
    $Hl = $MMl + $HRl;

    $MMi = substr("$horaini", 3, 5);
    $MMi = intval($MMi);
    $HRi = substr("$horaini", 0, 2);
    $HRi = intval($HRi);
    $HRi = $HRi * 60;
    $HI = $MMi + $HRi;

    //echo "$HRi : $MMi";

    $MMf = substr("$horafim", 3, 5);
    $MMf = intval($MMf);
    $HRf = substr("$horafim", 0, 2);
    $HRf = intval($HRf);
    $HRf = $HRf * 60;
    $HF = $MMf + $HRf;

    //echo "<br>$HRf : $MMf ";

    $dia = substr("$dataag", 8, 10);
    $mes = substr("$dataag", -5, -3);
    $ano = substr("$dataag", -10, -6);

    $datag = "$ano$mes$dia";
//Verifica se a data do compromisso é menor que a data de hoje.
    if ($datag < $hoje) {
        echo "<script>alert('Fora do periodo permitido! #cod2')</script>"
        . "<script>window.open('dashboard.php','_parent','')</script>";
    }

//Verifica se a data do compromosso é maior ou igual a data de hoje.
    if ($datag >= $hoje) {

        $q2 = mysql_query("SELECT IDAGENDA FROM PHPAGENDAMENTO
    WHERE DATA='$datag' AND STATUS<>'C'
    AND (HORAINI BETWEEN '$HI' AND '$HF' OR HORAFIM BETWEEN '$HI' AND '$HF')");
        $r2 = mysql_fetch_object($q2);

        if ($r2->IDAGENDA == '') {

            mysql_query("INSERT INTO PHPAGENDAMENTO VALUES ('0','$local','$anfitriao','$datag','$HI','$HF','$descricao','P','')");

            echo "<script>alert('Cadastro efetuado com sucesso!')</script>";
        }
    }
//Exclusão do registro na Agenda.
} elseif ($op == 'Excluir') {

    mysql_query("DELETE FROM PHPAGENDAMENTO WHERE IDAGENDA=$idagenda");
    echo "<script>alert('Excluido com sucesso!')</script>"
    . "<script>window.open('dashboard.php','_parent','')</script>";
}


// Listagem da Agenda
$q1 = mysql_query("SELECT A.DATA, A.LOCAL, A.ANFITRIAO, HORAINI, HORAFIM, DESCRICAO, A.IDAGENDA
  , (CASE A.STATUS WHEN 'P' THEN 'Pendente' WHEN 'A' THEN 'Agendado' WHEN 'C' THEN 'Cancelado' WHEN 'R' THEN 'Realizado'
	END) AS STATUS
FROM PHPAGENDAMENTO A");
while ($r1 = mysql_fetch_object($q1)) {

    $descricao = utf8_encode($r1->DESCRICAO);
    $horaini = gmdate("i:s", $r1->HORAINI);
    $horafim = gmdate("i:s", $r1->HORAFIM);

    $x->assign("IDAGENDA", $r1->IDAGENDA);
    $x->assign("DATA", $r1->DATA);
    $x->assign("LOCAL", $r1->LOCAL);
    $x->assign("ANFITRIAO", $r1->ANFITRIAO);
    $x->assign("HORAI", $horaini);
    $x->assign("HORAF", $horafim);
    $x->assign("STATUS", $r1->STATUS);
    $x->assign("DESCRICAO", $descricao);

    $x->parse("Principal.Lista");
}
$x->parse("Principal");
$x->out("Principal");
?>
