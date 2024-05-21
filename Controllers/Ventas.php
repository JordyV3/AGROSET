<?php 

	class Ventas extends Controllers{
		public function __construct()
		{
			parent::__construct();
			session_start();
			if(empty($_SESSION['login']))
			{
				header('Location: '.base_url().'/login');
				die();
			}
			getPermisos(MPUNTOVENTA);
		}

		public function Ventas()
		{
			if(empty($_SESSION['permisosMod']['r'])){
				header("Location:".base_url().'/ventas');
			}
			$data['page_tag'] = "Ventas";
			$data['page_title'] = "VENTAS";
			$data['page_name'] = "ventas";
			$data['page_functions_js'] = "functions_ventas.js";
			$this->views->getView($this,"ventas",$data);
		}

		public function getProductosVenta()
		{
			if($_SESSION['permisosMod']['r']){
				$arrData = $this->model->selectProductos();
				for ($i=0; $i < count($arrData); $i++) {
					$btnAdd = '';

					if($arrData[$i]['status'] == 1)
					{
						$arrData[$i]['status'] = '<span class="badge badge-success">Activo</span>';
					}else{
						$arrData[$i]['status'] = '<span class="badge badge-danger">Inactivo</span>';
					}

					$arrData[$i]['precio'] = SMONEY.' '.formatMoney($arrData[$i]['precio']);

					if($_SESSION['permisosMod']['r']){
						$btnAdd = '<button class="btn btn-primary btn-sm" onClick="fntSelectProduct('.$arrData[$i]['idproducto'].')" title="Seleccionar Producto"><i class="fas fa-plus"></i></button>';
					}
					$arrData[$i]['options'] = '<div class="text-center">'.$btnAdd.'</div>';
				}
				echo json_encode($arrData,JSON_UNESCAPED_UNICODE);
			}
			die();
		}

		public function getProductoPorId($idProducto) {
			if ($_SESSION['permisosMod']['r']) {
				$producto = $this->model->selectProductoPorId($idProducto);
				
				if ($producto) {
					$btnEliminar ='';
					$producto['status'] = ($producto['status'] == 1) ? '<span class="badge badge-success">Activo</span>' : '<span class="badge badge-danger">Inactivo</span>';
					// $producto['precio'] = SMONEY . ' ' . formatMoney($producto['precio']);
					$btnEliminar = '<button class="btn btn-danger btn-sm" onClick="fntRemoveProduct(' . $producto['idproducto'] . ')" title="Eliminar Producto"><i class="fas fa-times"></i></button>';
					$producto['options'] = '<div class="text-center">' . $btnEliminar . '</div>';
					
					echo json_encode($producto, JSON_UNESCAPED_UNICODE);
				} else {
					echo json_encode(array());
				}
			}
    		die();
		}

		public function removeProductFromList($idProducto) {
			if ($_SESSION['permisosMod']['r']) {
				$index = -1;
				foreach ($selectedProducts as $key => $product) {
					if ($product['idproducto'] == $idProducto) {
						$index = $key;
						break;
					}
				}
				if ($index !== -1) {
					unset($selectedProducts[$index]);
				}
				echo json_encode($selectedProducts, JSON_UNESCAPED_UNICODE);
			}
			die();
		}

		public function setProducto(){
			if($_POST){
				if(empty($_POST['idcliente']) || empty($_POST['fecha']) || empty($_POST['comprobante']) || empty($_POST['total']) || empty($_POST['listStatus']))
				{
					$arrResponse = array("status" => false, "msg" => 'Datos incorrectos.');
				}else{
					
					$idcliente = intval($_POST['idcliente']);
					$fecha = strClean($_POST['fecha']);
					$comprobante = strClean($_POST['comprobante']);
					$total = strClean($_POST['total']);
					$idventa = intval($_POST['idventa']);
					$productid = strClean($_POST['productid']);
					$cantidad = intval($_POST['cantidad']);
					$precio = intval($_POST['precio']);
					$total = intval($_POST['total']);
					$intStatus = intval($_POST['listStatus']);
					$request_producto = "";

					// $ruta = strtolower(clear_cadena($strNombre));
					$ruta = str_replace(" ","-",$ruta);

					if($idcliente == 0)
					{
						$option = 1;
						if($_SESSION['permisosMod']['w']){
							$request_venta = $this->model->insertarVenta($idcliente, 
																		$fecha, 
																		$comprobante, 
																		$total,
																		$idventa, 
																		$productid, 
																		$cantidad,
																		$precio ,
																		$total,
																		$intStatus
																	);
						}
					}
					if($request_producto > 0 )
					{
						if($option == 1){
							$arrResponse = array('status' => true, 'idventa' => $request_producto, 'msg' => 'Datos guardados correctamente.');
						}else{
							$arrResponse = array('status' => true, 'idproducto' => $idProducto, 'msg' => 'Datos Actualizados correctamente.');
						}
					}else if($request_producto == 'exist'){
						$arrResponse = array('status' => false, 'msg' => '¡Atención! ya existe una venta con el Código Ingresado.');		
					}else{
						$arrResponse = array("status" => false, "msg" => 'No es posible almacenar los datos.');
					}
				}
				echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
			}
			die();
		}

	}


	// public function guardarDetalleVenta(){

	// }
		
?>