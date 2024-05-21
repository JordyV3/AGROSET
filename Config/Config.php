<?php 
	const BASE_URL = "http://localhost/gefarm";
	//const BASE_URL = "https://gefarm.com/";

	//Zona horaria
	date_default_timezone_set('America/Guatemala');

	//Datos de conexión a Base de Datos
	const DB_HOST = "localhost";
	const DB_NAME = "db_tiendavirtual";
	const DB_USER = "root";
	const DB_PASSWORD = "";
	const DB_CHARSET = "utf8";

	//Para envío de correo
	const ENVIRONMENT = 0; // Local: 0, Produccón: 1;

	//Deliminadores decimal y millar Ej. 24,1989.00
	const SPD = ".";
	const SPM = ",";

	//Simbolo de moneda
	const SMONEY = "Q";
	const CURRENCY = "GTQ";

	//Api PayPal
	//SANDBOX PAYPAL
	const URLPAYPAL = "https://api-m.paypal.com";
	const IDCLIENTE = "AdWdacNal_gWFSsMivf2TBZl-2rTmRWj2MmrKvwhCI5L0jxTd50ba66A2Zbruuwd9MyHvhKfFZqLHVyN";
	const SECRET = "AdWdacNal_gWFSsMivf2TBZl-2rTmRWj2MmrKvwhCI5L0jxTd50ba66A2Zbruuwd9MyHvhKfFZqLHVyN";
	//LIVE PAYPAL
	//const URLPAYPAL = "https://api-m.paypal.com";
	//const IDCLIENTE = "";
	//const SECRET = "";

	//Datos envio de correo
	const NOMBRE_REMITENTE = "AGROSET S.A";
	const EMAIL_REMITENTE = "no-reply@abelosh.com";
	const NOMBRE_EMPESA = "AGROSET S.A";
	const WEB_EMPRESA = "www.agrosetsa.com";

	const DESCRIPCION = "Encuentra en nuestro amplio catálogo todo lo esencial y necesario para el cuidado y desarrollo óptimo de tus cultivos y ganado.";
	const SHAREDHASH = "AGROSET";

	//Datos Empresa
	const DIRECCION = "Aldea Shinshin Gualán Zacapa";
	const TELEMPRESA = "+(502)5789-5184";
	const WHATSAPP = "+502 57895184";
	const EMAIL_EMPRESA = "gefarmsa@gefarmsa.com";
	const EMAIL_PEDIDOS = "ventas@gefarmsa.com";
	const EMAIL_SUSCRIPCION = "info@gefarmsa.com";
	const EMAIL_CONTACTO = "contacto@gefarmsa.com";

	const CAT_SLIDER = "1,2,3";
	const CAT_BANNER = "4,5,6";
	const CAT_FOOTER = "1,2,3,4,5";

	//Datos para Encriptar / Desencriptar
	const KEY = 'agroset';
	const METHODENCRIPT = "AES-128-ECB";

	//Envío
	const COSTOENVIO = 35;

	//Módulos
	const MDASHBOARD = 1;
	const MUSUARIOS = 2;
	const MCLIENTES = 3;
	const MPRODUCTOS = 4;
	const MPEDIDOS = 5;
	const MCATEGORIAS = 6;
	const MSUSCRIPTORES = 7;
	const MDCONTACTOS = 8;
	const MDPAGINAS = 9;
	const MPUNTOVENTA = 10;

	//Páginas
	const PINICIO = 1;
	const PTIENDA = 2;
	const PCARRITO = 3;
	const PNOSOTROS = 4;
	const PCONTACTO = 5;
	const PPREGUNTAS = 6;
	const PTERMINOS = 7;
	const PSUCURSALES = 8;
	const PERROR = 9;

	//Roles
	const RADMINISTRADOR = 1;
	const RSUPERVISOR = 2;
	const RCLIENTES = 3;

	const STATUS = array('Completo','Aprobado','Cancelado','Reembolsado','Pendiente','Entregado');

	//Productos por página
	const CANTPORDHOME = 8;
	const PROPORPAGINA = 4;
	const PROCATEGORIA = 4;
	const PROBUSCAR = 4;

	//REDES SOCIALES
	const FACEBOOK = "https://www.facebook.com/gefarm";
	const INSTAGRAM = "https://www.instagram.com/gefarm/";
	

 ?>