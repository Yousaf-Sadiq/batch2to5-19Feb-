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
define("delete_form",domain."/action/user/form_action.php");


define("login_form",domain."/action/auth/form_action.php");

define("HOME",domain."/login.php");
define("SIGNUP",domain."/signup.php");
define("LOGOUT",domain."/logout.php");

define("DASHBOARD",domain."/dashboard.php");
define("update",domain."/update.php");

?>