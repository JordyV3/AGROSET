<?php 
    headerAdmin($data); 
    getModal('modalVenta',$data);
?>

<main class="app-content">
    <div class="app-title">
        <div>
            <h1><i class="fas fa-user-tag"></i> <?= $data['page_title'] ?></h1>
        </div>
        <ul class="app-breadcrumb breadcrumb">
            <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
            <li class="breadcrumb-item"><a href="<?= base_url(); ?>/ventas"><?= $data['page_title'] ?></a></li>
        </ul>
    </div>

    <form name="formulario" id="formularioVenta">
        <div class="row">
            <div class="col-md-8">
                <div class="card card-primary">
                    <div class="card-header">
                        <h5 class="card-title">Venta</h5>
                    </div>
                    <div class="title mt-4 pd-2 mx-4">
                        <div class="tile-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <?php if($_SESSION['permisosMod']['w']){ ?>
                                    <button class="btn btn-primary" type="button" onclick="openModal();"><i
                                            class="fas fa-search"></i> Buscar Producto</button>
                                    <?php } ?>
                                </div>
                            </div>

                            <div class="table-container mt-4">
                                <table id="tblarticulos"
                                    class="table table-striped table-bordered table-condensed table-hover">
                                    <thead>
                                        <th>Id</th>
                                        <th>Código</th>
                                        <th>Nombre</th>
                                        <th>Precio</th>
                                        <th>Cantidad</th>
                                        <th>Subtotal</th>
                                        <th>Accionessss</th>
                                    </thead>
                                    <tbody>

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <button class="btn btn-danger" onclick="cancelarform()" type="button" id="btnCancelar"><i
                                class="fa fa-arrow-circle-left"></i> Cancelar</button>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card card-secondary">
                    <div class="card-header">
                        <h5 class="card-title">Detalle de Venta</h5>
                    </div>
                    <div class="card-body">
                        <div class="row mt-2">
                            <div class="form-group col-md-12" id="clienteForm">
                                <label for="idcliente">Cliente <span class="required">*</span></label>
                                <select name="cliente" id="idcliente" class="form-control selectpicker"
                                    data-live-search="true" required>
                                </select>
                            </div>

                        </div>
                        <div class="row mt-2">
                            <div class="form-group col-md-6" id="fechaForm">
                                <label for="fechaInput">Fecha <span class="required">*</span></label>
                                <input type="text" name="fecha" id="fechaVenta" value="<?php echo date('Y-m-d'); ?>"
                                    class="form-control" required>
                            </div>

                            <div class="form-group col-md-6" id="comprobanteForm">
                                <label for="comprobanteSelect">Comprobante <span class="required">*</span></label>
                                <select class="form-control selectpicker" id="comprobante" name="comprobante" required>
                                    <option value="Boleta">Envío</option>
                                    <option value="Factura">Factura</option>
                                </select>
                            </div>

                        </div>
                        <div class="row mt-2">
                            <div class="col-md-6">
                                <label class="control-label">Total</label>
                                <h4 id="totalVenta">Q 0</h4>
                            </div>
                        </div>

                        <div class="row mt-2">
                            <input type="text" name="idProducto" id="idProducto" class="form-control"
                                placeholder="ID del Producto">
                            <input type="number" name="cantidad" id="cantidad" class="form-control"
                                placeholder="Cantidad">
                        </div>

                        <button type="submit" class="btn btn-primary btn-block mt-4">Guardar Venta</button>
                    </div>
                </div>
            </div>

        </div>
    </form>
</main>

<?php footerAdmin($data); ?>