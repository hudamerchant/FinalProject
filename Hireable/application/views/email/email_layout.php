<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body style="width: 100%;" >
<table style="    width: 70%;margin: auto;" >
    <thead>
        <tr>
            <th><img style="width: 20%;" src="<?php echo base_url(); ?>assets/img/logo1.png" alt=""></th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td><?php include_once($view.'.php'); ?></td>
        </tr>
    </tbody>
    <tfoot>
        <tr>
            <td></td>
        </tr>
    </tfoot>
</table>

</body>
</html>