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

$cakeDescription = 'CakePHP: the rapid development php framework';
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Material Admin</title>
    
    <!-- Vendor CSS -->
    <link href="/vendors/bower_components/animate.css/animate.min.css" rel="stylesheet">
    <link href="/vendors/bower_components/material-design-iconic-font/dist/css/material-design-iconic-font.min.css" rel="stylesheet">
    <link href="/vendors/bower_components/malihu-custom-scrollbar-plugin/jquery.mCustomScrollbar.min.css" rel="stylesheet">
    <link href="/vendors/bower_components/google-material-color/dist/palette.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="/vendors/fa/css/font-awesome.min.css" />
        
    <!-- CSS -->
    <link href="/css/app.min.1.css" rel="stylesheet">
    <link href="/css/app.min.2.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="/css/main.css">
</head>
<body data-ma-header="teal">

    <?= $this->Element('header') ?>
    <section id="main">
        <?= $this->Element('alerts') ?>
        <?= $this->Element('sidebar') ?>
        <section id="content">
            <div class="container">        
                <?= $this->fetch('content') ?>
            </div>
            <?= $this->fetch('footer') ?>
        </section>
    </section>


    <script src="/vendors/bower_components/jquery/dist/jquery.min.js"></script>
    <script src="/vendors/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
    
    <script src="/vendors/bower_components/malihu-custom-scrollbar-plugin/jquery.mCustomScrollbar.concat.min.js"></script>
    <script src="/vendors/bower_components/Waves/dist/waves.min.js"></script>
    <script src="/vendors/bootstrap-growl/bootstrap-growl.min.js"></script>

    <!-- Placeholder for IE9 -->
    <!--[if IE 9 ]>
        <script src="/vendors/bower_components/jquery-placeholder/jquery.placeholder.min.js"></script>
    <![endif]-->
    
    <!-- Page Loader -->
    <div class="page-loader palette-Teal bg">
        <div class="preloader pl-xl pls-white">
            <svg class="pl-circular" viewBox="25 25 50 50">
                <circle class="plc-path" cx="50" cy="50" r="20"/>
            </svg>
        </div>
    </div>

    <script src="/js/functions.js"></script>
    <script src="/js/actions.js"></script>
    <script src="/js/demo.js"></script>  
    <script src="/js/index.js"></script>  
    <?= $this->fetch('bottom') ?>
    <?= $this->Flash->render() ?>    
</body>
</html>
