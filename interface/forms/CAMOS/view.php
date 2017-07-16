<?php
/**
 * Generated DocBlock
 *
 * @package OpenEMR
 * @link    http://www.open-emr.org
 * @author  markleeds <markleeds>
 * @author  fndtn357 <fndtn357@gmail.com>
 * @author  cornfeed <jdough823@gmail.com>
 * @author  cfapress <cfapress>
 * @author  Wakie87 <scott@npclinics.com.au>
 * @author  Robert Down <robertdown@live.com>
 * @author  Brady Miller <brady.g.miller@gmail.com>
 * @copyright Copyright (c) 2009 markleeds <markleeds>
 * @copyright Copyright (c) 2012 fndtn357 <fndtn357@gmail.com>
 * @copyright Copyright (c) 2011 cornfeed <jdough823@gmail.com>
 * @copyright Copyright (c) 2008 cfapress <cfapress>
 * @copyright Copyright (c) 2016 Wakie87 <scott@npclinics.com.au>
 * @copyright Copyright (c) 2017 Robert Down <robertdown@live.com>
 * @copyright Copyright (c) 2016 Brady Miller <brady.g.miller@gmail.com>
 * @license https://github.com/openemr/openemr/blob/master/LICENSE GNU General Public License 3
 */
?>
<!-- view.php -->
<?php
include_once("../../globals.php");
include_once("../../../library/api.inc");
formHeader("Form: CAMOS");
$returnurl = 'encounter_top.php';
$textarea_rows = 22;
$textarea_cols = 90;
?>
<html><head>
<link rel=stylesheet href="<?php echo $css_header;?>" type="text/css">
<script type="text/javascript">
function checkall(){
  var f = document.my_form;
  var x = f.elements.length;
  var i;
  for(i=0;i<x;i++) {
    if (f.elements[i].type == 'checkbox') {
      f.elements[i].checked = true;
    }
  }
}
function uncheckall(){
  var f = document.my_form;
  var x = f.elements.length;
  var i;
  for(i=0;i<x;i++) {
    if (f.elements[i].type == 'checkbox') {
      f.elements[i].checked = false;
    }
  }
}
function content_focus() {
}
function content_blur() {
}
function show_edit(t) {
  var e = document.getElementById(t);
  if (e.style.display == 'none') {
    e.style.display = 'inline';
    return;
  }
  else {
    e.style.display = 'none';
  }
}
</script>
<?php html_header_show();?>
<link rel="stylesheet" href="<?php echo $css_header;?>" type="text/css">
</head>
<body class="body_top">
<form method=post action="<?php echo $rootdir?>/forms/CAMOS/save.php?mode=delete&id=<?php echo $_GET["id"];?>" name="my_form">
<h1> <?php xl('CAMOS', 'e'); ?> </h1>
<input type="submit" name="delete" value="<?php xl('Delete Selected Items', 'e'); ?>" />
<input type="submit" name="update" value="<?php xl('Update Selected Items', 'e'); ?>" />
<?php
echo "<a href='".$GLOBALS['webroot'] . "/interface/patient_file/encounter/$returnurl'>[" . xl('do nothing') . "]</a>";
?>
<br/><br/>
<input type='button' value='<?php xl('Select All', 'e'); ?>'
  onClick='checkall()'>
<input type='button' value='<?php xl('Unselect All', 'e'); ?>'
  onClick='uncheckall()'>
<br/><br/>
<?php
//experimental code start

$pid = $GLOBALS['pid'];
$encounter = $GLOBALS['encounter'];

$query = "select t1.id, t1.content from ".mitigateSqlTableUpperCase("form_CAMOS")." as t1 join forms as t2 " .
  "on (t1.id = t2.form_id) where t2.form_name like 'CAMOS%' " .
  "and t2.encounter like $encounter and t2.pid = $pid";

$statement = sqlStatement($query);
while ($result = sqlFetchArray($statement)) {
    print "<input type=button value='" . xl('Edit') . "' onClick='show_edit(\"id_textarea_".$result['id']."\")'>";
    print "<input type=checkbox name='ch_".$result['id']."'> ".$result['content']."<br/>";
    print "<div id=id_textarea_".$result['id']." style='display:none'>";
    print "<textarea name=textarea_".$result['id']." cols=$textarea_cols rows= $textarea_rows onFocus='content_focus()' onBlur='content_blur()' >".$result['content']."</textarea><br/>";
    print "</div>";
}


//experimental code end
?>
</form>
<?php

formFooter();
?>
