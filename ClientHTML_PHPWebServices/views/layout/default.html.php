<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr" lang="fr">
<head>
    <title>AmenoBook</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <!--Import Google Icon Font-->
    <link href="./public/css/font-awesome.min.css" rel="stylesheet">
    <!--Import materialize.css-->
    <link type="text/css" rel="stylesheet" href="./public/css/materialize.min.css"  media="screen,projection"/>
    <link type="text/css" href="./public/css/style.css" rel="stylesheet">

    <!--Let browser know website is optimized for mobile-->
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
</head>
<body>

<?php echo $content ?>

<script type="text/javascript" src="./public/js/jquery-2.1.1.min.js"></script>
<script type="text/javascript" src="./public/js/materialize.min.js"></script>
<script type="text/javascript">
    (function($){
        $(function(){

            $('.button-collapse').sideNav();
            $('select').material_select();
            Materialize.updateTextFields();
            $('.datepicker').pickadate({
                format: 'dd/mm/yyyy'
            })

        });
    })(jQuery);
</script>
</body>
</html>