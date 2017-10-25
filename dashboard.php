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
        <a href="#" data-target="#modal" class="trigger btn btn-success">Novo Agendamento</a>
        <div id="modal">
          <p>conteúdo do modal</p>
        </div><!-- modal -->
      </div><!-- row -->
    </div><!-- container -->

<!-- script para abertura do modal -->
<script type="text/javascript">
    $("#modal").iziModal({
      title: 'Faça o login',
      subtitle: 'Aqui um subtítulo',
      headerColor: 'rgb(0,112,187)',
      icon: 'fa fa-envelope-o',
      theme: '',
      width: '1000px',
      zindex: '9999',
      radius: '0',
      fullscreen: true,
      transitionIn: 'comingIn',
      transitionOut: 'comingOut',
      overlayColor: 'rgba(0,0,0,0.7)'
    });

    $(document).on('click', '.trigger', function(event) {
      event.preventDefault();
      $('#modal').iziModal('open');
    });
  </script><!-- modal -->

  </body>
</html>
