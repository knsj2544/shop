<?php require_once('../Connections/condb.php'); ?>
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

$colname_editnews = "-1";
if (isset($_GET['n_id'])) {
  $colname_editnews = $_GET['n_id'];
}
mysql_select_db($database_condb, $condb);
$query_editnews = sprintf("SELECT * FROM tbl_news WHERE n_id = %s", GetSQLValueString($colname_editnews, "int"));
$editnews = mysql_query($query_editnews, $condb) or die(mysql_error());
$row_editnews = mysql_fetch_assoc($editnews);
$totalRows_editnews = mysql_num_rows($editnews);
?>
<?php include('access.php');?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<?php include('h.php');?>
    <?php include('datatable.php');?>
    <!-- ckeditor-->
<script src="//cdn.ckeditor.com/4.6.2/standard/ckeditor.js"></script>

  </head>
  <body>
  <div class="container">
  <div class="row">
         <?php include('banner.php');?>
   </div>
  	<div class="row">
    	<div class="col-md-2">
        <b>  ADMIN : <?php include('mm.php');?> </b>
        <br>
        <?php include('menu.php');?>        	 
      </div>
      <div class="col-md-10">
        <h3 align="center"> ??????????????????????????? <?php include('edit-ok.php');?> </h3>
        
        		<form action="edit_news_db.php"  method="post" enctype="multipart/form-data" name="Add_Product" id="Add_Product" >

  
  <table width="700" border="0" align="center" cellpadding="0" cellspacing="0">
    <tr>
      <td colspan="3" align="center">&nbsp;</td>
    </tr>
    <tr>
      <td width="129" align="right" valign="middle">?????????????????? :</td>
      <td width="471" colspan="2"><label for="pro_name2"></label>
        <input name="a_title" type="text" required id="pro_name2" value="<?php echo $row_editnews['n_title']; ?>" size="80"/></td>
    </tr>
    <tr>
      <td align="right" valign="middle">&nbsp;</td>
      <td colspan="2">&nbsp;</td>
    </tr>
    <tr>
      <td align="right" valign="middle">&nbsp;</td>
      <td colspan="2">&nbsp;</td>
    </tr>
    <tr>
      <td align="right" valign="top">?????????????????????????????? :</td>
      <td colspan="2">
      <textarea name="a_detail" id="a_detail" class="ckeditor" cols="80" rows="5"><?php echo $row_editnews['n_detail']; ?></textarea>
      </td>
    </tr>
    <tr>
      <td align="right" valign="middle">&nbsp;</td>
      <td colspan="2"><input name="n_id" type="hidden" id="n_id" value="<?php echo $row_editnews['n_id']; ?>">
        <input name="img" type="hidden" id="img" value="<?php echo $row_editnews['n_img']; ?>"></td>
    </tr>
    <tr>
      <td align="right" valign="middle">?????????????????????</td>
      <td colspan="2"><label for="n_img"></label>
        <input type="file" name="n_img" id="n_img"></td>
    </tr>
    <tr>
      <td align="right" valign="middle">&nbsp;</td>
      <td colspan="2">&nbsp;</td>
    </tr>
    <tr>
      <td align="right" valign="middle">&nbsp;</td>
      <td colspan="2">?????????????????????<br>
      <img src="../nimg/<?php echo $row_editnews['n_img'];?>" width="100px"></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td colspan="2">
      
      <br><br><br>
      <button type="submit" name="button" id="button" value="??????????????????" class="btn btn-primary">??????????????????</button></td>
    </tr>
  </table> 
</form>
            
      </div>
    </div>
 </div> 
  </body>
</html>
<?php
mysql_free_result($editnews);
?>
<?php include('f.php');?>