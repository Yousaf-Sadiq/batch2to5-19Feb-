<?php

require_once dirname(__FILE__) . "/layout/user/header.php";

if (!isset($_SESSION["user_id"]) || empty($_SESSION["user_id"])) {

 redirect_url(HOME);
}

session_destroy();
Success_MSG("LOGOUT SUCCESSFULLY");

refresh_url(2, HOME);
?>


<?php

// $a["email"]
require_once dirname(__FILE__) . "/layout/user/footer.php";
?>