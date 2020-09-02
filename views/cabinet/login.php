<?php include ROOT.'/views/layouts/header.php'  ?>
<!-- BODY -->
    <link href='/template/style.css' rel='stylesheet' type='text/css'>

<body>
<?php if ($result) :?>
<p> Отредактировали! </p>
<?php else :?>
<form method="post">
    <input name="email" type="email" value="<?php echo $email; ?>">
    <input name="password" type="password" value="<?php echo $password; ?>">
    <input type="submit" name="submit">
</form>
<?php endif;?>
<div>
    <?php if (isset($errors)&&is_array($errors)): ?>
    <?php foreach ($errors as $error):?>
        <li><?php echo $error; ?></li>
    <?php endforeach; ?>
    <?php endif ?>
</div>

</body>
<!-- FOOTER -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <script type="text/javascript" src="/template/js/main.min.js"></script>
<?php include ROOT.'/views/layouts/footer.php'?>