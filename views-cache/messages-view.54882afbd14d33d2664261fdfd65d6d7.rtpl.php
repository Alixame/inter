<?php if(!class_exists('Rain\Tpl')){exit;}?><!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
    <a href="/admin/messages"><i class="fa fa-arrow-circle-left" aria-hidden="true"></i></a> Voltar
  </h1>
  <ol class="breadcrumb">
    <li><a href="/admin"><i class="fa fa-dashboard"></i> Home</a></li>
    <li><a href="/admin/messages">Mensagens</a></li>
    <li class="active">Detalhes</a></li>
  </ol>
</section>

<!-- Main content -->
<section class="content">

  <div class="row">
  	<div class="col-md-12">
  		<div class="box box-primary">
        <div class="box-header with-border">
          <h2 class="box-title text-center">Mensagem de <strong><?php echo htmlspecialchars( $messages["desname"], ENT_COMPAT, 'UTF-8', FALSE ); ?></strong></h2>
        </div>
        <!-- /.box-header -->
        <!-- form start -->
        <form role="form"  enctype="multipart/form-data">
          <div class="box-body">

            <div class="form-group">
              <label for="nrphone">Numero de Contato</label>
              <input type="text" class="form-control" id="nrphone" name="nrphone" value="<?php echo htmlspecialchars( $messages["nrphone"], ENT_COMPAT, 'UTF-8', FALSE ); ?>" readonly>
            </div>

            <div class="form-group">
              <label for="desemail">Email</label>
              <input type="text" class="form-control" id="desemail" name="desemail" value="<?php echo htmlspecialchars( $messages["desemail"], ENT_COMPAT, 'UTF-8', FALSE ); ?>" readonly>
            </div>

            <div class="form-group">
              <label for="typemessage">Tipo de Mensagem</label>
              <input type="text" class="form-control" id="typemessage" name="typemessage" value="<?php echo htmlspecialchars( $messages["typemessage"], ENT_COMPAT, 'UTF-8', FALSE ); ?>" readonly>
            </div>

            <div class="form-group">
              <label for="desmessage">Mensagem</label>
              <textarea  class="form-control" id="desmessage" name="desmessage" readonly><?php echo htmlspecialchars( $messages["desmessage"], ENT_COMPAT, 'UTF-8', FALSE ); ?></textarea>
            </div>

          </div>
          <!-- /.box-body -->
          
        </form>

        <div class="box-footer">
          <a href="/admin/messages/<?php echo htmlspecialchars( $messages["idmessage"], ENT_COMPAT, 'UTF-8', FALSE ); ?>/response"><button type="submit" class="btn btn-primary">Responder</button></a>
        </div>

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