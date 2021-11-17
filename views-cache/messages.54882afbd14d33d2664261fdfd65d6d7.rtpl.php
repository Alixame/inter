<?php if(!class_exists('Rain\Tpl')){exit;}?><!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
    <a href="/admin"><i class="fa fa-arrow-circle-left" aria-hidden="true"></i></a> Voltar
  </h1>
  <ol class="breadcrumb">
    <li><a href="/admin"><i class="fa fa-dashboard"></i> Home</a></li>
    <li class="active"><a href="/admin/messages"> Mensagens</a></li>
  </ol>
</section>

<!-- Main content -->
<section class="content">

  <div class="text-center">
    <h1>Mensagens de Clientes</h1>
  </div>

  <div class="row">
  	<div class="col-md-12">
  		<div class="box box-primary">

        <div class="box-tools " style="margin: 1rem;">
          <form action="/admin/messages">

            <div class="input-group input-group-sm">
              <input type="text" name="search" class="form-control pull-left" placeholder="Pesquisar" value="<?php echo htmlspecialchars( $search, ENT_COMPAT, 'UTF-8', FALSE ); ?>">

              <div class="input-group-btn">
                <button type="submit" class="btn btn-default"><i class="fa fa-search"></i></button>
              </div>
            </div>

          </form>
        </div>

            <div class="box-body no-padding">
              <table class="table table-striped">
                <thead>
                  <tr>
                    <th style="width: 10px">#</th>
                    <th>Nome</th>
                    <th>Numero de Contato</th>
                    <th>Email</th>
                    <th>Tipo de Mensagem</th>
                    <th>Respondida</th>
                    <th>Data de Envio</th>
                    <th style="width: 200px">&nbsp;</th>
                  </tr>
                </thead>
                <tbody>
                  <?php $counter1=-1;  if( isset($messages) && ( is_array($messages) || $messages instanceof Traversable ) && sizeof($messages) ) foreach( $messages as $key1 => $value1 ){ $counter1++; ?>

                  <tr>
                    <td><?php echo htmlspecialchars( $value1["idmessage"], ENT_COMPAT, 'UTF-8', FALSE ); ?></td>
                    <td><?php echo htmlspecialchars( $value1["desname"], ENT_COMPAT, 'UTF-8', FALSE ); ?></td>
                    <td><?php echo htmlspecialchars( $value1["nrphone"], ENT_COMPAT, 'UTF-8', FALSE ); ?></td>
                    <td><?php echo htmlspecialchars( $value1["desemail"], ENT_COMPAT, 'UTF-8', FALSE ); ?></td>
                    <td><?php echo htmlspecialchars( $value1["typemessage"], ENT_COMPAT, 'UTF-8', FALSE ); ?></td>
                    <td <?php if( $value1["responsed"] == 1 ){ ?>style="color: #77DD77;"<?php }else{ ?>style="color: #FF3300"<?php } ?>><?php if( $value1["responsed"] == 1 ){ ?>Sim<?php }else{ ?>Não<?php } ?></td>
                    <td><?php echo htmlspecialchars( $value1["dtregister"], ENT_COMPAT, 'UTF-8', FALSE ); ?></td>
                    <td>
                      <a href="/admin/messages/<?php echo htmlspecialchars( $value1["idmessage"], ENT_COMPAT, 'UTF-8', FALSE ); ?>" class="btn btn-default btn-xs"><i class="fa fa-search"></i> Detalhes</a>
                      <a href="/admin/messages/<?php echo htmlspecialchars( $value1["idmessage"], ENT_COMPAT, 'UTF-8', FALSE ); ?>/delete" onclick="return confirm('Deseja realmente excluir esta mensagem?')" class="btn btn-danger btn-xs"><i class="fa fa-trash"></i> Apagar</a>
                    </td>
                  </tr>
                  <?php }else{ ?>

                  <tr>
                      <td colspan="6">Nenhuma mensagem foi encontrada.</td>
                  </tr>
                  <?php } ?>

                </tbody>
              </table>
            </div>
            <!-- /.box-body -->
          </div>
  	</div>
  </div>

</section>
<!-- /.content -->
</div>
<!-- /.content-wrapper -->