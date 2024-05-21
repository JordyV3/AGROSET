<?php 

class VentasModel extends Mysql{

	public function selectProductos(){
		$sql = "SELECT p.idproducto,
						p.codigo,
						p.nombre,
						p.descripcion,
						p.categoriaid,
						c.nombre as categoria,
						p.precio,
						p.stock,
						p.status 
				FROM producto p 
				INNER JOIN categoria c
				ON p.categoriaid = c.idcategoria
				WHERE p.status = 1";
				$request = $this->select_all($sql);
		return $request;
	}

	public function selectProductoPorId($idProducto){
		$sql = "SELECT p.idproducto,
						p.codigo,
						p.nombre,
						p.descripcion,
						p.categoriaid,
						c.nombre as categoria,
						p.precio,
						p.stock,
						p.status 
				FROM producto p 
				INNER JOIN categoria c
				ON p.categoriaid = c.idcategoria
				WHERE p.idproducto = $idProducto";
		$request = $this->select($sql); 
		return $request;
	}

	
	
	public function insertarVenta($idcliente, $tipo_comprobante, $total, $fecha) {
	
		$sql_venta = "INSERT INTO venta (idcliente, tipo_comprobante, total, fecha) VALUES ('$idcliente', '$tipo_comprobante', '$total', '$fecha')";
	
		$id_venta_nuevo = ejecutarConsulta_retornarID($sql_venta);
	
		if ($id_venta_nuevo != null) {
			$num_elementos = 0;
			$sw = true;
	
			while ($num_elementos < count($productid)) {
				$sql_detalle = "INSERT INTO detalle_venta (idventa, productid, cantidad, precio, total) VALUES ('$id_venta_nuevo', '$productid[$num_elementos]', '$cantidad[$num_elementos]', '$precio[$num_elementos]', '$total[$num_elementos]')";
	
				ejecutarConsulta($sql_detalle) or $sw = false;
	
				$num_elementos++;
			}
	
			return $sw;
		} else {

			return false;
		}
	}

}
 ?>