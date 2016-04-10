<?php
/*
 * This script depends on the following code in .htaccess:
 *    <IfModule mod_rewrite.c>
 *        RewriteEngine on
 *        RewriteCond %{REQUEST_FILENAME} !-f
 *        RewriteCond %{REQUEST_FILENAME} !-d
 *        RewriteRule ^ index.php [L]
 *    </IfModule>
 *
 * Place the "static" and "views" directories in the root
 * along with this script and the above .htaccess file.
 */

include('vars.php');

$lll_route = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

$item = $items[$_GET['id'] - 1];

if (file_exists("views/$lll_route.tpl")) {
	ob_start();
	require_once("views/$lll_route.tpl");
	$lllpage = ob_get_contents();
	ob_end_clean();

	echo $lllpage;

} elseif (($lll_route == "") || ($lll_route == "/")){
	ob_start();
	require_once("views/home.tpl");
	$lllpage = ob_get_contents();
	ob_end_clean();

	echo $lllpage;
} else {
	echo "\"$lll_route\" page not found";
	ob_start();
	require_once("views/home.tpl");
	$lllpage = ob_get_contents();
	ob_end_clean();

	echo $lllpage;
}

?>
