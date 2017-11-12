<?php
ob_start();
ini_set("display_errors",1);

foreach ($_REQUEST as $key=>$val) {
    ${$key}=$val;
}

if (trim($login)=='' or (trim($password)=='')){
echo "<script>alert('Os Campos Email ou Senha nao pode estar vazio! $login')</script>"
   . "<script> window.history.go(-1)</script>";
}   else
        {
    
    include_once("config.php");
        
	$q = mysql_query("SELECT IDUSUARIO, SENHA, ATIVO
            FROM PHPUSUARIO
            WHERE EMAIL='$login'");
	$r = mysql_fetch_object($q);
      
        echo "SELECT IDUSUARIO, SENHA, ATIVO
            FROM PHPUSUARIO
            WHERE EMAIL='$login'";
        
	if ($password==$r->SENHA){
            
            if($r->ATIVO==1){

                session_start();
                $_SESSION["idusuario"]=$r->IDUSUARIO;
                
                 header('location: ../dashboard.php?welcome=1');
                
		} else 
                    {
                    echo "<script>alert('Usuário bloqueado! \\n Entre em contato com a equipe de suporte!')</script>"
                       . "<script> window.history.go(-1)</script>";
                }
				
	} else
            {

        header('location: ../index.php?msg=1');
        
       }
}
?>