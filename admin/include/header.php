<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Responsive Grids &ndash; Pure</title>

<link rel="stylesheet" href="http://yui.yahooapis.com/pure/0.2.1/pure-min.css">
<link href="http://netdna.bootstrapcdn.com/font-awesome/3.2.1/css/font-awesome.css" rel="stylesheet">
<link rel="stylesheet" href="template/admin_template.css">

<script type="text/javascript" src="../<?php echo $rep_resources; ?>/js/ed.js"></script>
<script src="http://use.typekit.net/ajf8ggy.js"></script>
<script>
    try { Typekit.load(); } catch (e) {}
</script>

</head>
<body>

<div class="pure-g-r" id="layout">
    <a href="#menu" id="menuLink" class="pure-menu-link">
        <span></span>
    </a>

<div class="pure-u" id="menu">
    <div class="pure-menu pure-menu-open">
        <a class="pure-menu-heading" href="index.php">Admin</a>
        <ul>
            <li><a href="admin_pages.php"><?php echo $pages_admin; ?></a></li>
            <li><a href="admin_site_configuration.php"><?php echo $config_admin; ?></a></li>
            <li><a href="admin_theme_configuration.php"><?php echo $template_admin; ?></a></li>
        </ul>
    </div>
</div>