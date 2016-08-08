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

// *** Redirect if username exists
$MM_flag="MM_insert";
if (isset($_POST[$MM_flag])) {
  $MM_dupKeyRedirect="alta_emailrepetido.php";
  $loginUsername = $_POST['strEmail'];
  $LoginRS__query = sprintf("SELECT strEmail FROM tblusuario WHERE strEmail=%s", GetSQLValueString($loginUsername, "text"));
  mysql_select_db($database_conexionzapatos, $conexionzapatos);
  $LoginRS=mysql_query($LoginRS__query, $conexionzapatos) or die(mysql_error());
  $loginFoundUser = mysql_num_rows($LoginRS);

  //if there is a row in the database, the username was found - can not add the requested username
  if($loginFoundUser){
    $MM_qsChar = "?";
    //append the username to the redirect page
    if (substr_count($MM_dupKeyRedirect,"?") >=1) $MM_qsChar = "&";
    $MM_dupKeyRedirect = $MM_dupKeyRedirect . $MM_qsChar ."requsername=".$loginUsername;
    header ("Location: $MM_dupKeyRedirect");
    exit;
  }
}

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form1")) {
  $insertSQL = sprintf("INSERT INTO tblusuario (strNombre, strApellido, strEmail, intActivo, strPassword) VALUES (%s, %s, %s, %s, %s)",
                       GetSQLValueString($_POST['strNombre'], "text"),
                       GetSQLValueString($_POST['strApellido'], "text"),
                       GetSQLValueString($_POST['strEmail'], "text"),
                       GetSQLValueString($_POST['intActivo'], "int"),
                       GetSQLValueString($_POST['strPassword'], "text"));

  mysql_select_db($database_conexionzapatos, $conexionzapatos);
  $Result1 = mysql_query($insertSQL, $conexionzapatos) or die(mysql_error());

  $insertGoTo = "alta_ok.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $insertGoTo .= (strpos($insertGoTo, '?')) ? "&" : "?";
    $insertGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $insertGoTo));
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><!-- InstanceBegin template="/Templates/Principal.dwt.php" codeOutsideHTMLIsLocked="false" -->
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<!-- InstanceBeginEditable name="doctitle" -->
<title>Documento sin título</title>
<!-- InstanceEndEditable -->
<!-- InstanceBeginEditable name="head" -->
<script src="SpryAssets/SpryValidationTextField.js" type="text/javascript"></script>
<link href="SpryAssets/SpryValidationTextField.css" rel="stylesheet" type="text/css" />




<script src="http://code.jquery.com/jquery-1.11.1.min.js"></script>
       <script>
     $(function(){
        $("#btn").on("click", function(){
            var formData = $("#formulario").serialize();
            var ruta = "ajax.php";
            $.ajax({
                url: ruta,
                type: "POST",
                data: formData,
                success: function(datos)
                {
                    $("#respuesta").html(datos);
                }
            });
        });
  
  $("#actualizar_captcha").on("click", function(){
           document.location.reload();
    });
     });
    </script>






<!-- InstanceEndEditable -->
<link href="estilo/principal.css" rel="stylesheet" type="text/css" />
</head>

<body>
<div class="container">
  <div class="header">
    <div class="headerinterior"><img src="images/logotrans.png" width="283" height="64" alt="Tienda Zapatos" /></div>
  </div>
  <div class="subcontenedor">
    <div class="sidebar1">
      <?php include("includes/catalogo.php"); ?>
      <!-- end .sidebar1 -->
    </div>
    <div class="content">
      <h1><!-- InstanceBeginEditable name="Titulo" -->Sign in<!-- InstanceEndEditable --></h1>
      <!-- InstanceBeginEditable name="EditRegion4" -->
                <p>Singn in form of the app store:</p>
                <p>&nbsp;</p>
                 
                <form action="<?php echo $editFormAction; ?>" method="post" name="form1" id="form1"> <div id="respuesta"></div>
                
                  <table align="center">
                    <tr valign="baseline">
                      <td nowrap="nowrap" align="right">Name:</td>
                      <td><span id="sprytextfield1">
                      <input name="strNombre" type="text" autocomplete="off" value="" size="32" />
                      <span class="textfieldRequiredMsg">Se necesita un valor.</span>
                      <span class="textfieldMinValueMsg">The entered value is less than the minimum required.</span>
                      <span class="textfieldMinCharsMsg">Minimum number of characters not met.</span></span></td>
                    </tr>
                    <tr valign="baseline"> 
                      <td nowrap="nowrap" align="right">Last name:</td>                 
                      <td><span id="sprytextfield4">
                      <input name="strApellido" type="text" autocomplete="off" value="" size="32" />
                      <span class="textfieldRequiredMsg">Se necesita un valor.</span>
                      <span class="textfieldMinValueMsg">The entered value is less than the minimum required.</span>
                      <span class="textfieldMinCharsMsg">Minimum number of characters not met.</span></span></td>
                      
                      <td>&nbsp;</td>
                    </tr>
                    <tr valign="baseline">
                      <td nowrap="nowrap" align="right">Email:</td>
                      <td><span id="sprytextfield2">
                      <input type="text" name="strEmail" value="" size="32" />
                      <span class="textfieldRequiredMsg">Se necesita un valor.</span>
                      <span class="textfieldInvalidFormatMsg">Formato no válido.</span></span></td>
                    </tr>
                    <tr valign="baseline">
                      <td nowrap="nowrap" align="right">Contrase&ntilde;a:</td>
                      <td><span id="sprytextfield3">
                      <input name="strPassword" type="password" autocomplete="off" value="" size="32" />
                      <span class="textfieldRequiredMsg">Se necesita un valor.</span>
                       <span class="textfieldMinCharsMsg">Minimum number of characters not met.</span> 
                       <span class="textfieldMinCharsMsg">You must use at least 2 numbers and 2 uppercase characters in your password.</span>
                       <span class="textfieldMinValueMsg">The entered value is less than the minimum required.</span> </span></td>
                    </tr>
                    <tr valign="baseline">
                    
                      <td nowrap="nowrap" align="right">Captcha:</td>
                      <td><input type="text" id="captcha" name="captcha"></td>
                      <td>&nbsp;</td>
                    </tr>
                    <tr valign="baseline">
                      <td nowrap="nowrap" align="right">&nbsp;</td><td><img src="captcha.php"><button id="actualizar_captcha" type="button">Actualizar</button>
                      
                      </td></tr></td>
                      <td>&nbsp;</td>
                    </tr>
                    <tr valign="baseline">
                      <td nowrap="nowrap" align="right">&nbsp;</td>
                      <td><input type="submit" value="Darme de Alta" <button id="btn" type="button"></button>
                      
  
                     </td>
                    </tr>
                  </table>
                  <input type="hidden" name="intActivo" value="1" />
                  <input type="hidden" name="MM_insert" value="form1" />
                </form>
                <p>&nbsp;</p>
                <script type="text/javascript">
var sprytextfield1 = new Spry.Widget.ValidationTextField("sprytextfield1", "none", {minChars:2});
var sprytextfield3 = new Spry.Widget.ValidationTextField("sprytextfield4", "none", {minChars:2});
var sprytextfield2 = new Spry.Widget.ValidationTextField("sprytextfield2", "email");
var sprytextfield3 = new Spry.Widget.ValidationTextField("sprytextfield3", "none", {minChars:6,minNumbers:2,minUpperAlphaChars:2});

                </script>
                
                
                
                
                


    <!-- InstanceEndEditable -->
      <!-- end .content -->
    </div>
    <!-- end .subcontenedor -->
  </div>
  <div class="footer">
    <p>Pie de pagina</p>
    <!-- end .footer -->
  </div>
  <!-- end .container -->
</div>
<script type="text/javascript">
var gaJsHost = (("https:" == document.location.protocol) ? "https://ssl." : "http://www.");
document.write(unescape("%3Cscript src='" + gaJsHost + "google-analytics.com/ga.js' type='text/javascript'%3E%3C/script%3E"));
</script>
<script type="text/javascript">
try{
var pageTracker = _gat._getTracker("UA-xxxxxxx-x");
pageTracker._trackPageview();
} catch(err) {}</script>
</body>
<!-- InstanceEnd --></html>
