<!DOCTYPE html>
<html lang="pt-br">
  <head>
    <meta charset="utf-8">
    <title>Canção e Louvor - Agendamentos</title>
    <!-- Estilo -->
    <!-- ... -->
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
    <nav class=""></nav>
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          ...
        </div><!-- col -->
      </div><!-- row -->
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
    			color: '#b00000',
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
