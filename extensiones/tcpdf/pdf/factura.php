<?php

require_once "../../../controladores/ventas.controlador.php";
require_once "../../../modelos/ventas.modelo.php";

require_once "../../../controladores/clientes.controlador.php";
require_once "../../../modelos/clientes.modelo.php";

require_once "../../../controladores/usuarios.controlador.php";
require_once "../../../modelos/usuarios.modelo.php";

require_once "../../../controladores/productos.controlador.php";
require_once "../../../modelos/productos.modelo.php";

class imprimirFactura{

public $codigo;

public function traerImpresionFactura(){

//TRAEMOS LA INFORMACIÓN DE LA VENTA

$itemVenta = "codigo";
$valorVenta = $this->codigo;

$respuestaVenta = ControladorVentas::ctrMostrarVentas($itemVenta, $valorVenta);

$fecha = substr($respuestaVenta["fecha"],0,-8);
$productos = json_decode($respuestaVenta["productos"], true);
$neto = number_format($respuestaVenta["neto"],2);
$impuesto = number_format($respuestaVenta["impuesto"],2);
$total = number_format($respuestaVenta["total"],2);

//TRAEMOS LA INFORMACIÓN DEL CLIENTE

$itemCliente = "id";
$valorCliente = $respuestaVenta["id_cliente"];

$respuestaCliente = ControladorClientes::ctrMostrarClientes($itemCliente, $valorCliente);

//TRAEMOS LA INFORMACIÓN DEL VENDEDOR

$itemVendedor = "id";
$valorVendedor = $respuestaVenta["id_vendedor"];

$respuestaVendedor = ControladorUsuarios::ctrMostrarUsuarios($itemVendedor, $valorVendedor);

//REQUERIMOS LA CLASE TCPDF

require_once('tcpdf_include.php');

$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

$pdf->setPrintHeader(false);
$pdf->setPrintFooter(false);

$pdf->AddPage('P', 'A7');

//---------------------------------------------------------

$bloque1 = <<<EOF

<table style="font-size:9px; text-align:center; ">

	<tr>
		
		<td style="width:160px;">

			<h3 style="font-size:7px; font-weight:bold; text-align:rigth; color:navy ">Fecha: $fecha</h3>
			<br>
			<div style="text-align:left; ">
		
				<h2 style="color:navy; text-align:center; ">Lohannes | Inventory</h2>
				
				
				<div style="text-align:right;">	NIT: 23.123.424-9
				
				<br>
				Dirección: Cr. 41d # 74-95

				<br>
				Teléfono: 3233268532
				</div>

				<h4 style="text-align:center; color:navy;">FACTURA N.$valorVenta</h4>
				

				<br><br>					
				<b>Cliente:</b> $respuestaCliente[nombre]

				<br>
				<b>Vendedor:</b> $respuestaVendedor[nombre]

				<br>

			</div>

		</td>

	</tr>


</table>

EOF;

$pdf->writeHTML($bloque1, false, false, false, false, '');

// ---------------------------------------------------------


foreach ($productos as $key => $item) {

$valorUnitario = number_format($item["precio"], 2);

$precioTotal = number_format($item["total"], 2);

$bloque2 = <<<EOF

<table style="font-size:9px; padding:5px;">

	<tr style="background-color: navy; color:white; border:1px solid navy;" >
	
		<td style="width:160px; text-align:left; font-weight:blod;border:1px solid navy;">
		$item[descripcion] 
		</td>

	</tr>
	
	<tr>
	
		<td style="width:160px; text-align:left;border:1px solid navy; border-spacing:5px;">
		<b>$</b> $valorUnitario Und * $item[cantidad]  <br> <b>$</b> $precioTotal
		
		</td>

	</tr>
	
</table>

EOF;

$pdf->writeHTML($bloque2, false, false, false, false, '');

}

// ---------------------------------------------------------

$bloque3 = <<<EOF

<table style="font-size:9px; text-align:left; border: 1px solid navy">

	<tr>
	
		<td style="width:80px;">
			<b> NETO: </b>
		</td>

		<td style="width:80px;">
			$ $neto
		</td>

	</tr>

	<tr>
	
		<td style="width:80px;">
			<b> IMPUESTO: </b>
		</td>

		<td style="width:80px;">
			$ $impuesto
		</td>

	</tr>

	<tr>
	
		<td style="width:160px;">
			 --------------------------
		</td>

	</tr>

	<tr>
	
		<td style="width:80px;">
			<b> TOTAL: </b>
		</td>

		<td style="width:80px;">
			$ $total
		</td>

	</tr>



</table>

<h4 style="font-size:10px;text-align:center; font-family:Verdana, Geneva, Tahoma, sans-serif;">Muchas gracias por su compra</h4>


EOF;

$pdf->writeHTML($bloque3, false, false, false, false, '');

// ---------------------------------------------------------
//SALIDA DEL ARCHIVO 

//$pdf->Output('factura.pdf', 'D');
$pdf->Output('factura.pdf');

}

}

$factura = new imprimirFactura();
$factura -> codigo = $_GET["codigo"];
$factura -> traerImpresionFactura();

?>