<?php require_once('Connections/conexionzapatos.php'); ?>
<?php
if (!function_exists("GetSQLValueString")) {
function GetSQLValueString($theValue, $theType, $theDefinedValue = "", $theNotDefinedValue = "") 
{
  if (PHP_VERSION < 6) {
    $theValue = get_magic_quotes_gpc() ? stripslashes($theValue) : $theValue;
  }

  $theValue = function_exists("mysql_real_escape_string") ? mysql_real_escape_string($theValue) : mysql_escape_string($theValue);

  switch ($theType) {
    case "text":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;    
    case "long":
    case "int":
      $theValue = ($theValue != "") ? intval($theValue) : "NULL";
      break;
    case "double":
      $theValue = ($theValue != "") ? doubleval($theValue) : "NULL";
      break;
    case "date":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;
    case "defined":
      $theValue = ($theValue != "") ? $theDefinedValue : $theNotDefinedValue;
      break;
  }
  return $theValue;
}
}

$currentPage = $_SERVER["PHP_SELF"];

$maxRows_DatosProductos = 9;
$pageNum_DatosProductos = 0;
if (isset($_GET['pageNum_DatosProductos'])) {
  $pageNum_DatosProductos = $_GET['pageNum_DatosProductos'];
}
$startRow_DatosProductos = $pageNum_DatosProductos * $maxRows_DatosProductos;

$varCategoria_DatosProductos = "0";
if (isset($_GET["cat"])) {
  $varCategoria_DatosProductos = $_GET["cat"];
}
mysql_select_db($database_conexionzapatos, $conexionzapatos);
$query_DatosProductos = sprintf("SELECT * FROM tblproducto WHERE tblproducto.intCategoria = %s", GetSQLValueString($varCategoria_DatosProductos, "int"));
$query_limit_DatosProductos = sprintf("%s LIMIT %d, %d", $query_DatosProductos, $startRow_DatosProductos, $maxRows_DatosProductos);
$DatosProductos = mysql_query($query_limit_DatosProductos, $conexionzapatos) or die(mysql_error());
$row_DatosProductos = mysql_fetch_assoc($DatosProductos);

if (isset($_GET['totalRows_DatosProductos'])) {
  $totalRows_DatosProductos = $_GET['totalRows_DatosProductos'];
} else {
  $all_DatosProductos = mysql_query($query_DatosProductos);
  $totalRows_DatosProductos = mysql_num_rows($all_DatosProductos);
}
$totalPages_DatosProductos = ceil($totalRows_DatosProductos/$maxRows_DatosProductos)-1;

$queryString_DatosProductos = "";
if (!empty($_SERVER['QUERY_STRING'])) {
  $params = explode("&", $_SERVER['QUERY_STRING']);
  $newParams = array();
  foreach ($params as $param) {
    if (stristr($param, "pageNum_DatosProductos") == false && 
        stristr($param, "totalRows_DatosProductos") == false) {
      array_push($newParams, $param);
    }
  }
  if (count($newParams) != 0) {
    $queryString_DatosProductos = "&" . htmlentities(implode("&", $newParams));
  }
}
$queryString_DatosProductos = sprintf("&totalRows_DatosProductos=%d%s", $totalRows_DatosProductos, $queryString_DatosProductos);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><!-- InstanceBegin template="/Templates/Principal.dwt.php" codeOutsideHTMLIsLocked="false" -->
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<!-- InstanceBeginEditable name="doctitle" -->
<title>Documento sin t�tulo</title>
<!-- InstanceEndEditable -->
<!-- InstanceBeginEditable name="head" -->
<!-- InstanceEndEditable -->
<link href="estilo/principal.css" rel="stylesheet" type="text/css" />
</head>

<body>

<div class="container">
  <div class="header"><div class="headerinterior"><img src="images/logotrans.png" width="283" height="64" alt="Tienda Zapatos" /></div></div>
  <div class="subcontenedor">
              <div class="sidebar1">
               <?php include("includes/catalogo.php"); ?>
<!-- end .sidebar1 --></div>
              <div class="content">
                <h1><!-- InstanceBeginEditable name="Titulo" -->Products ...<!-- InstanceEndEditable --></h1>
                <!-- InstanceBeginEditable name="EditRegion4" -->
                <div class="resultadoproductos">
                <?php if ($totalRows_DatosProductos > 0) { // Show if recordset not empty ?>
  <?php do { ?>
    <div class="producto"><div class="fotoproducto"><img src="documentos/productos/<?php echo $row_DatosProductos['strImagen']; ?>" width="120" height="120" /></div><div class="textoproducto"><a href="ver_producto.php?recordID=<?php echo $row_DatosProductos['idProducto']; ?>"><?php echo $row_DatosProductos['strNombre']; ?></a>. 
      Precio: <?php echo $row_DatosProductos['dblPrecio']; ?></div></div>
    <?php } while ($row_DatosProductos = mysql_fetch_assoc($DatosProductos)); ?>
                  <?php } // Show if recordset not empty ?>
            <?php if ($totalRows_DatosProductos == 0) { // Show if recordset empty ?>
                    Todavia no hay productos de esta categoria.
  <?php } // Show if recordset empty ?>
  </div>
                <table border="0">
                  <tr>
                    <td><?php if ($pageNum_DatosProductos > 0) { // Show if not first page ?>
                        <a href="<?php printf("%s?pageNum_DatosProductos=%d%s", $currentPage, 0, $queryString_DatosProductos); ?>">Primero</a>
                        <?php } // Show if not first page ?></td>
                    <td><?php if ($pageNum_DatosProductos > 0) { // Show if not first page ?>
                        <a href="<?php printf("%s?pageNum_DatosProductos=%d%s", $currentPage, max(0, $pageNum_DatosProductos - 1), $queryString_DatosProductos); ?>">Anterior</a>
                        <?php } // Show if not first page ?></td>
                    <td><?php if ($pageNum_DatosProductos < $totalPages_DatosProductos) { // Show if not last page ?>
                        <a href="<?php printf("%s?pageNum_DatosProductos=%d%s", $currentPage, min($totalPages_DatosProductos, $pageNum_DatosProductos + 1), $queryString_DatosProductos); ?>">Siguiente</a>
                        <?php } // Show if not last page ?></td>
                    <td><?php if ($pageNum_DatosProductos < $totalPages_DatosProductos) { // Show if not last page ?>
                        <a href="<?php printf("%s?pageNum_DatosProductos=%d%s", $currentPage, $totalPages_DatosProductos, $queryString_DatosProductos); ?>">&Uacute;ltimo</a>
                        <?php } // Show if not last page ?></td>
                  </tr>
                </table>
                <!-- InstanceEndEditable --><!-- end .content --></div>
    <!-- end .subcontenedor -->
    </div>
  <div class="footer">
    <p>Pie de pagina</p>
    <!-- end .footer --></div>
  <!-- end .container --></div>
  
  <script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-81499873-1', 'auto');
  ga('send', 'pageview');

</script>
  
  
  
</body>
<!-- InstanceEnd --></html>
<?php
mysql_free_result($DatosProductos);
?>
