<?php headerAdmin($data); ?>
    <main class="app-content">
      <div class="app-title">
        <div>
          <h1><i class="fa fa-dashboard"></i><?= $data['page_title'] ?></h1>
        </div>
        <ul class="app-breadcrumb breadcrumb">
          <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
          <li class="breadcrumb-item"><a href="<?= base_url(); ?>/dashboard">Dashboard</a></li>
        </ul>
      </div>
      <div class="row">
        <?php if(!empty($_SESSION['permisos'][2]['r'])){ ?>
        <div class="col-md-6 col-lg-3">
          <a href="<?= base_url() ?>/usuarios" class="linkw">
            <div class="widget-small primary coloured-icon"><i class="icon fa fa-users fa-3x"></i>
              <div class="info">
                <h4>Usuarios</h4>
                <p><b><?= $data['usuarios'] ?></b></p>
              </div>
            </div>
          </a>
        </div>
        <?php } ?>
        <?php if(!empty($_SESSION['permisos'][3]['r'])){ ?>
        <div class="col-md-6 col-lg-3">
          <a href="<?= base_url() ?>/clientes" class="linkw">
            <div class="widget-small info coloured-icon"><i class="icon fa fa-user fa-3x"></i>
              <div class="info">
                <h4>Clientes</h4>
                <p><b><?= $data['clientes'] ?></b></p>
              </div>
            </div>
          </a>
        </div>
        <?php } ?>
        <?php if(!empty($_SESSION['permisos'][4]['r']) ){ ?>
        <div class="col-md-6 col-lg-3">
          <a href="<?= base_url() ?>/productos" class="linkw">
            <div class="widget-small warning coloured-icon"><i class="icon fa fa fa-archive fa-3x"></i>
              <div class="info">
                <h4>Productos</h4>
                <p><b><?= $data['productos'] ?></b></p>
              </div>
            </div>
          </a>
        </div>
        <?php } ?>
        <?php if(!empty($_SESSION['permisos'][5]['r'])){ ?>
        <div class="col-md-6 col-lg-6">
          <a href="<?= base_url() ?>/pedidos" class="linkw">
            <div class="widget-small danger coloured-icon"><i class="icon fa fa-shopping-cart fa-3x"></i>
              <div class="info">
                <h4>Pedidos</h4>
                <p><b><?= $data['pedidos'] ?></b></p>
              </div>
            </div>
          </a>
        </div>
        <?php } ?>
        <?php if(!empty($_SESSION['permisos'][5]['r'])){ ?>
        <div class="col-md-6 col-lg-6">
              <a href="<?= base_url() ?>/pedidos" class="linkw">
                  <div class="widget-small primary coloured-icon">
                      <i class="icon fa fa-shopping-cart fa-3x"></i>
                      <div class="info">
                          <h4>Gastos</h4>
                          <p><b><?= SMONEY." ".formatMoney($data['gastoPorCliente']) ?></b></p>
                      </div>
                  </div>
              </a>
          </div>
        <?php } ?>
      </div>


      <div class="row">
        <?php if(!empty($_SESSION['permisos'][5]['r'])){ ?>
        <div class="col-md-6">
          <div class="tile">
            <h3 class="tile-title">Últimos Pedidos</h3>
            <table class="table table-striped table-sm">
              <thead>
                <tr>
                  <th>#</th>
                  <!-- <th>Nombre</th>
                  <th>Apellido</th> -->
                  <th>Producto</th>
                  <th>Estado</th>
                  <th class="text-right">Monto</th>
                  <th></th>
                </tr>
              </thead>
              <tbody>
                <?php 
                    if(count($data['lastOrders1']) > 0 ){
                      foreach ($data['lastOrders1'] as $pedido) {
                 ?>
                <tr>
                  <td><?= $pedido['idpedido'] ?></td>
                  <!-- <td><?= $pedido['nombre'] ?></td>
                  <td><?= $pedido['apellido'] ?></td> -->
                  <td><?= $pedido['producto'] ?></td>
                  <td><?= $pedido['estado'] ?></td>
                  <td class="text-right"><?= SMONEY." ".formatMoney($pedido['monto']) ?></td>
                  
                  <td><a href="<?= base_url() ?>/pedidos/orden/<?= $pedido['idpedido'] ?>" target="_blank"><i class="fa fa-eye" aria-hidden="true"></i></a></td>
                </tr>
                <?php } 
                  } ?>

              </tbody>
            </table>
          </div>
        </div>
        <?php } ?>

        <!-- <div class="col-md-6">
          <div class="tile">
            <div class="container-title">
              <h3 class="tile-title">Últimos Productos</h3>
              <table class="table table-striped table-sm">
              <thead>
                <tr>
                  <th>#</th>
                  <th>Producto</th>
                  <th>Monto</th>
                  <th></th>
                </tr>
              </thead>
              <tbody>
                <?php 
                    if(count($data['productosTen']) > 0 ){
                      foreach ($data['productosTen'] as $producto) {
                 ?>
                <tr>
                  <td><?= $producto['idproducto'] ?></td>
                  <td><?= $producto['nombre'] ?></td>
                  <td><?= SMONEY. formatMoney($producto['precio']) ?></td>
                  <td><a href="<?= base_url() ?>/tienda/producto/<?= $producto['idproducto'].'/'.$producto['ruta'] ?>" target="_blank"><i class="fa fa-eye" aria-hidden="true"></i></a></td>
                </tr>
                <?php } 
                  } ?>

              </tbody>
            </table>
              
            </div>
            
          </div>
        </div> -->

        <div class="col-md-6">
          <div class="tile">
            <div class="container-title">
              <h3 class="tile-title">Productos por categoria</h3>
              <div class="dflex">
                <input class="date-picker pagoMes" name="pagoMes" placeholder="Mes y Año">
                <button type="button" class="btnTipoVentaMes btn btn-info btn-sm" onclick="fntSearchPagos()"> <i class="fas fa-search"></i> </button>
              </div>
            </div>
            <div id="categoriaProductos"></div>
          </div>
        </div>
      </div>

      <div class="row">
        <div class="col-md-12">
          <div class="tile">
            <div class="container-title">
              <h3 class="tile-title">Compras por mes</h3>
              <div class="dflex">
                <input class="date-picker ventasMes" name="ventasMes" placeholder="Mes y Año">
                <button type="button" class="btnVentasMes btn btn-info btn-sm" onclick="fntSearchVMes()"> <i class="fas fa-search"></i> </button>
              </div>
            </div>
            <div id="graficaMes"></div>
          </div>
        </div>
        
      </div>

    </main>
<?php footerAdmin($data); ?>

<script>

  
Highcharts.chart('categoriaProductos', {
    chart: {
        plotBackgroundColor: null,
        plotBorderWidth: null,
        plotShadow: false,
        type: 'pie'
    },
    title: {
        text: 'Compras por categorías, <?= $data['selectProductosPorCategoria']['mes'].' '.$data['selectProductosPorCategoria']['anio'] ?>'
    },
    tooltip: {
        pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
    },
    accessibility: {
        point: {
            valueSuffix: '%'
        }
    },
    plotOptions: {
        pie: {
            allowPointSelect: true,
            cursor: 'pointer',
            dataLabels: {
                enabled: true,
                format: '<b>{point.name}</b>: {point.percentage:.1f} %'
            }
        }
    },
    series: [{
        name: 'Categorías',
        colorByPoint: true,
        data: [
            <?php 
                foreach ($data['selectProductosPorCategoria']['productosPorCategoria'] as $categoria) {
                    echo "{name:'".$categoria['categoria']."',y:".$categoria['cantidad']."},";
                }
            ?>
        ]
    }]
});


  Highcharts.chart('graficaMes', {
      chart: {
          type: 'line'
      },
      title: {
          text: 'Compras de <?= $data['ventasMDia']['mes'].' del año '.$data['ventasMDia']['anio'] ?>'
      },
      subtitle: {
          text: 'Total Compras <?= SMONEY.'. '.formatMoney($data['ventasMDia']['total']) ?> '
      },
      xAxis: {
          categories: [
            <?php 
                foreach ($data['ventasMDia']['ventas'] as $dia) {
                  echo $dia['dia']."," ;
                }
            ?>
          ]
      },
      yAxis: {
          title: {
              text: 'QUETZALES'
          }
      },
      plotOptions: {
          line: {
              dataLabels: {
                  enabled: true
              },
              enableMouseTracking: false
          }
      },
      series: [{
          name: 'Dato',
          data: [
            <?php 
                foreach ($data['ventasMDia']['ventas'] as $dia) {
                  echo $dia['total'].",";
                }
            ?>
          ]
      }]
  });


</script>
    