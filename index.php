<!DOCTYPE html>
<html lang="pt-br">
  <head>
    <meta charset="utf-8">
    <title>Canção e Louvor - Agendamentos</title>
    <!-- Estilo -->
    <link rel="stylesheet" href="build/css/mixins.css">
    <!-- Bootstrap 4.0.0 -->
    <link rel="stylesheet" href="bootstrap-4.0.0/dist/css/bootstrap.min.css">
    <!-- Font-Awesome 4.7.0 -->
    <link rel="stylesheet" href="font-awesome-4.7.0/css/font-awesome.min.css">
    <!-- jQuery -->
    <script type="text/javascript" src="jquery/jquery-2.2.4.min.js"></script>
    <!-- iziModal -->
    <link rel="stylesheet" href="iziModal-master/css/iziModal.min.css">
    <script type="text/javascript" src="iziModal-master/js/iziModal.min.js"></script>
    <!-- iziTOAST -->
  	<link rel="stylesheet" type="text/css" href="iziToast-master/dist/css/iziToast.css">
    <script src="iziToast-master/dist/js/iziToast.min.js" type="text/javascript"></script>
  </head>
  <body>
      <div class="container logintotal">
        <div class="row justify-content-center">
          <div class="col-md-3">
            <img class="logologin" src="img/logo_branca.png" alt="">
          </div>
        </div>
        <div class="row justify-content-center">
          <div class="col-md-5">
            <div class="boxlogin">
              <h3>Sistema de Agendamento</h3>
              <hr>
            <form action="">
              <div class="form-group">
                <input type="login" id="login" class="form-control" placeholder="Insira seu login">
                <br>
                <input type="password" id="senha" class="form-control" placeholder="Insira sua senha">
                <br>
                <input class="btn btn-success col-md-12" type="submit" value="Entrar">
              </div><!-- formgroup -->
            </form>
          </div><!-- boxlogin -->
          </div>
        </div>
      </div>
    <div class="container">
      <div class="row">
        <a href="#" class="toastcontato1 btn btn-warning" onclick="meutoast1()">Senha incorreta</a>
        <a href="#" class="toastcontato2 btn btn-success" onclick="meutoast2()">Logado com sucesso</a>
      </div><!-- row -->
    </div><!-- container -->

<!-- função para izitoast1 -->
    <script type="text/javascript">
    	function meutoast1(){
    		iziToast.show({
    			class: 'toastcontato1',
    			title: 'Usuário ou senha incorretos!',
    			message: 'Tente novamente.',
    			theme: 'dark',
    			color: '#ec5746',
    			icon: 'fa fa-exclamation-circle',
    			layout: '2',
    			position: 'bottomCenter',
    			timeout: '5000',
    			progressBarColor: 'white',
    			transitionIn: 'flipInX',
    			transitionOut: 'flipOutX'
    		});
    	};
    	</script>

      <!-- função para izitoast2 -->
          <script type="text/javascript">
          	function meutoast2(){
          		iziToast.show({
          			class: 'toastcontato2',
          			title: 'Logado com sucesso!',
          			message: 'Seja bem vindo(a).',
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
          	};
          	</script>

  </body>
</html>
