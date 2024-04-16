<!-- routes -->
<?php 
define("ROOTPATH","http://localhost/");

define("folder","19Feb_php/project_crud");

define("DOCUMENT_ROOT", $_SERVER['DOCUMENT_ROOT']);
define("domain2",DOCUMENT_ROOT."/".folder);

define("domain",ROOTPATH.folder);

define("upload","/asset/upload/");

// for home.php file

define("insert_form",domain."/action/user/form_action.php");
define("update_form",domain."/action/user/form_action.php");

define("HOME",domain."/home.php");
define("update",domain."/update.php");

?>