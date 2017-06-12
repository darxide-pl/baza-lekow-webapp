<?php
/**
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @since         0.10.0
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */
?>
<!DOCTYPE html>
<html>
<head>
	<title></title>
<style type="text/css">
body {
	background-color: #edecec;
	font-size: 16px;
	font-family: 'Calibri', 'Helvetica Nueue','Verdana','sans-serif';
	color: #5e5e5e;
	margin:0;
	padding: 0;
}
* {
	box-sizing: border-box;
}
.content {
	width: 500px;
	margin:30px auto;
}

.item {
	background-color: #fff;
	padding: 18px;
	box-shadow: 0 2px 5px rgba(0, 0, 0, 0.16), 0 2px 10px rgba(0, 0, 0, 0.12);
}

a {
	color: #2196f3;
	text-decoration: none !important;
}
</style>
</head>
<body>
	<div class="content">
		<?= $this->fetch('content') ?>
	</div>
</body>
</html>