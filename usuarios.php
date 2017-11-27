<?php

include_once("include/config.php");
include_once("include/xtpl.php3");

$url = "usuarios.php";
//Verifica qual pagina HTML exibir.
if ($op == 'New') {

    $x = new XTemplate("CadastroUsuario.html");
    $x->assign("BOTAO", 'Insert');
} elseif ($op == 'Insert') {

    if ($senha != $senha2) {

        $msg = 'As duas senhas nao correspondem.';
        echo "<script>alert('$msg');</script> <script>window.open('$url','_parent','')</script>";
    } else {

        $q = mysql_query("INSERT INTO PHPUSUARIO (IDUSUARIO, NOME, SENHA, EMAIL, ATIVO, DATACRIACAO, DATAMODIFICACAO, USUARIOCRIACAO, USUARIOMODIFICACAO)
                VALUES (NULL, '$nome', '$senha', '$email', 1, NULL, NULL, NULL, NULL)");

        $msg = 'Cadastro efetuado com sucesso!';
        echo "<script>alert('$msg');</script> <script>window.open('$url','_parent','')</script>";
    }
} elseif ($op == 'Delete') {

    mysql_query("DELETE FROM PHPUSUARIO WHERE IDUSUARIO=$usuarioid");

    $msg = 'Registro deletado com sucesso!';
    echo "<script>alert('$msg');</script> <script>window.open('$url','_parent','')</script>";
} elseif ($op == 'Update') {

    if ($senha != $senha2) {

        $msg = 'As duas senhas nao correspondem.';
        echo "<script>alert('$msg');</script> <script>window.open('$url','_parent','')</script>";
    } else {

        mysql_query("UPDATE PHPUSUARIO SET NOME='$nome', EMAIL='$email', SENHA='$senha' WHERE IDUSUARIO=$usuarioid");

        $msg = 'Cadastro atualizado com sucesso!';
        echo "<script>alert('$msg');</script> <script>window.open('$url','_parent','')</script>";
    }
} elseif ($op == 'Edit') {

    $x = new XTemplate("CadastroUsuario.html");
    $x->assign("BOTAO", 'Update');

    $q1 = mysql_query("SELECT * FROM PHPUSUARIO WHERE IDUSUARIO=$usuarioid");
    $r1 = mysql_fetch_object($q1);

    $x->assign("IDUSUARIO", $r1->IDUSUARIO);
    $x->assign("NOME", $r1->NOME);
    $x->assign("EMAIL", $r1->EMAIL);

    $x->parse("Principal.Lista");

    mysql_query("DELETE FROM PHPUSUARIO WHERE IDUSUARIO=$idusuario");
} else {
    $x = new XTemplate("usuarios.html");


// Listagem da Agenda
    $q1 = mysql_query("SELECT * FROM PHPUSUARIO");
    while ($r1 = mysql_fetch_object($q1)) {

        $x->assign("IDUSUARIO", $r1->IDUSUARIO);
        $x->assign("NOME", $r1->NOME);
        $x->assign("EMAIL", $r1->EMAIL);

        $x->parse("Principal.Lista");
    }
}



$x->parse("Principal");
$x->out("Principal");
?>
