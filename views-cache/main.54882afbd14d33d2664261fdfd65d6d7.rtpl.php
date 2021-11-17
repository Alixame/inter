<?php if(!class_exists('Rain\Tpl')){exit;}?><div class="content-wrapper">

<section class="content-header">   
  <ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
    <li class="active">Here</li>
  </ol>
</section>

<section class="content">

  <div class="alert-size" role="alert">
    <h1><strong>Seja bem-vindo ao Painel de Administação LUMIRA Automação</strong></h1>
  </div> 

  <div class="row">
  	<div class="col-md-12">
  		<div class="box box-primary">  
            <div class="box-body text-center">
                <div>
                  <div class="row">

                    <div class="col-md-3 col-sm-6 col-xs-12">
                      <div class="info-box">

                        <span class="info-box-icon bg-aqua"><i class="fa fa-hand-pointer-o" aria-hidden="true"></i></span>
            
                        <div class="info-box-content">
                          <h2 class="info-box-text">Acessos</h2>
                          <span class="info-box-number"><!--<?php echo htmlspecialchars( $access, ENT_COMPAT, 'UTF-8', FALSE ); ?>--></span>
                        </div>
                      </div>
                    </div>

                    <div class="col-md-3 col-sm-6 col-xs-12">
                      <div class="info-box">

                        <span class="info-box-icon bg-yellow"><i class="fa fa-users" aria-hidden="true"></i></span>
            
                        <div class="info-box-content">
                          <h2 class="info-box-text">Novos Usuarios</h2>
                          <span class="info-box-number"><?php echo htmlspecialchars( $users, ENT_COMPAT, 'UTF-8', FALSE ); ?></span>
                        </div>
                      </div>
                      
                    </div>
            
                    <div class="clearfix visible-sm-block"></div>
            
                    <div class="col-md-3 col-sm-6 col-xs-12">
                      <div class="info-box">

                        <span class="info-box-icon bg-green"><i class="fa fa-shopping-cart" aria-hidden="true"></i></span>
        
                        <div class="info-box-content">
                          <h2 class="info-box-text">Vendas</h2>
                          <span class="info-box-number"><!--<?php echo htmlspecialchars( $sales, ENT_COMPAT, 'UTF-8', FALSE ); ?>--></span>
                        </div>
                      </div>
                    </div>

                    <div class="col-md-3 col-sm-6 col-xs-12">
                      <div class="info-box">

                        <span class="info-box-icon bg-red"><i class="fa fa-comments" aria-hidden="true"></i></span>
            
                        <div class="info-box-content">
                          <h2 class="info-box-text">Feedbacks</h2>
                          <span class="info-box-number"><?php echo htmlspecialchars( $contact, ENT_COMPAT, 'UTF-8', FALSE ); ?></span>
                        </div>
                      </div>
                    </div>

                  </div>

                </div>
            </div>
      </div>
  	</div>
  </div>

 
  <div class="row">
    <div class="col-md-12">
      <div class="box">
        <div class="box-header with-border">
          <h3 class="box-title">Grafico Demonstrativo</h3>

          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
            </button>
            <div class="btn-group">
              <button type="button" class="btn btn-box-tool dropdown-toggle" data-toggle="dropdown">
                <i class="fa fa-wrench"></i></button>
              <ul class="dropdown-menu" role="menu">
                <li><a href="#">Action</a></li>
                <li><a href="#">Another action</a></li>
                <li><a href="#">Something else here</a></li>
                <li class="divider"></li>
                <li><a href="#">Separated link</a></li>
              </ul>
            </div>
            <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
          </div>
        </div>
        <div class="box-body">
          <div class="row">
            <div class="col-md-8">
              <p class="text-center">
                <strong>Vendas: 1 Jan, 2014 - 30 Jul, 2014</strong>
              </p>

              <div class="chart">
                <div id="curve_chart" style="width: 100%; height: 100%"></div>
              </div>

            </div>
            <div class="col-md-4">
              <p class="text-center">
                <strong>Goal Completion</strong>
              </p>

              <div class="progress-group">
                <span class="progress-text">Add Produtos ao Carrinho</span>
                <span class="progress-number"><b>{}</b>/200</span>

                <div class="progress sm">
                  <div class="progress-bar progress-bar-aqua" style="width: 80%"></div>
                </div>
              </div>
              <div class="progress-group">
                <span class="progress-text">Completaram a Compra</span>
                <span class="progress-number"><b>310</b>/400</span>

                <div class="progress sm">
                  <div class="progress-bar progress-bar-red" style="width: 80%"></div>
                </div>
              </div>
              <div class="progress-group">
                <span class="progress-text">Visitaram o Site</span>
                <span class="progress-number"><b>480</b>/800</span>

                <div class="progress sm">
                  <div class="progress-bar progress-bar-green" style="width: 80%"></div>
                </div>
              </div>
              <div class="progress-group">
                <span class="progress-text">Enviaram Feedbacks</span>
                <span class="progress-number"><b>250</b>/500</span>

                <div class="progress sm">
                  <div class="progress-bar progress-bar-yellow" style="width: 80%"></div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="box-footer">
          <div class="row">
            <div class="col-sm-3 col-xs-6">
              <div class="description-block border-right">
                <span class="description-percentage text-green"><i class="fa fa-caret-up"></i> 17%</span>
                <h5 class="description-header">$35,210.43</h5>
                <span class="description-text">TOTAL</span>
              </div>
            </div>
            <div class="col-sm-3 col-xs-6">
              <div class="description-block border-right">
                <span class="description-percentage text-yellow"><i class="fa fa-caret-left"></i> 0%</span>
                <h5 class="description-header">$10,390.90</h5>
                <span class="description-text">TOTAL</span>
              </div>
            </div>
            <div class="col-sm-3 col-xs-6">
              <div class="description-block border-right">
                <span class="description-percentage text-green"><i class="fa fa-caret-up"></i> 20%</span>
                <h5 class="description-header">$24,813.53</h5>
                <span class="description-text">TOTAL</span>
              </div>
            </div>
            <div class="col-sm-3 col-xs-6">
              <div class="description-block">
                <span class="description-percentage text-red"><i class="fa fa-caret-down"></i> 18%</span>
                <h5 class="description-header">1200</h5>
                <span class="description-text">GOAL COMPLETIONS</span>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>


</section>
</div>

<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script type="text/javascript">
  google.charts.load('current', {'packages':['corechart']});
  google.charts.setOnLoadCallback(drawChart);

  function drawChart() {
    var data = google.visualization.arrayToDataTable([
      ['Year', 'Sales', 'Expenses', 'Acesso', 'Adicionaram ao Carrinho'],
      ['2004',  1000,      400,       100 ,             100],
      ['2005',  1170,      460,       400,              300],
      ['2006',  660,       1120,      100,              200],
      ['2007',  1030,      540,       150,              100],
      ['2008',  10,        400,        20,               50]
    ]);

    var options = {
      title: 'Company Performance',
      curveType: 'function',
      legend: { position: 'bottom' }
    };

    var chart = new google.visualization.LineChart(document.getElementById('curve_chart'));

    chart.draw(data, options);
  }
</script>