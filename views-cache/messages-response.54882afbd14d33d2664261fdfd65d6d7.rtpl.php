<?php if(!class_exists('Rain\Tpl')){exit;}?><!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
    <a href="/admin/messages/<?php echo htmlspecialchars( $messages["idmessage"], ENT_COMPAT, 'UTF-8', FALSE ); ?>"><i class="fa fa-arrow-circle-left" aria-hidden="true"></i></a> Voltar
  </h1>
  <ol class="breadcrumb">
    <li><a href="/admin"><i class="fa fa-dashboard"></i> Home</a></li>
    <li><a href="/admin/messages">Mensagens</a></li>
    <li><a href="/admin/messages/<?php echo htmlspecialchars( $messages["idmessage"], ENT_COMPAT, 'UTF-8', FALSE ); ?>">Detalhes</a></li>
    <li class="active">Resposta</a></li>
  </ol>
</section>

<!-- Main content -->
<section class="content">

  <div class="row">
  	<div class="col-md-12">
  		<div class="box box-primary">
        <div class="box-header with-border">
          <h2 class="box-title text-center">Está resposta será enviada para o email <strong><?php echo htmlspecialchars( $messages["desemail"], ENT_COMPAT, 'UTF-8', FALSE ); ?></strong> do(a) cliente: <strong><?php echo htmlspecialchars( $messages["desname"], ENT_COMPAT, 'UTF-8', FALSE ); ?></strong>.</h2>
        </div>
        <!-- /.box-header -->
        <!-- form start -->
        <form role="form" action="/admin/messages/<?php echo htmlspecialchars( $messages["idmessage"], ENT_COMPAT, 'UTF-8', FALSE ); ?>/response" method="POST" enctype="multipart/form-data">
          <div class="box-body">

            <div class="form-group">
              <label for="desnameat">Nome do Atendente</label>
              <input type="text" class="form-control" id="desnameat" name="desnameat" value='<?php echo getUserName(); ?>' readonly>
            </div>

            <div class="form-group">
              <label for="desmessageat">Mensagem</label>
              <textarea  class="form-control" id="desmessageat" name="desmessageat"></textarea>
            </div>

          </div>
          <!-- /.box-body -->
          
          <div class="box-footer">
            <button type="submit" class="btn btn-primary">Enviar</button>
          </div>

        </form> 

      </div>
  	</div>
  </div>

</section>
<!-- /.content -->
</div>
<!-- /.content-wrapper -->
<script>
document.querySelector('#file').addEventListener('change', function(){
  
  var file = new FileReader();

  file.onload = function() {
    
    document.querySelector('#image-preview').src = file.result;

  }

  file.readAsDataURL(this.files[0]);

});
</script>