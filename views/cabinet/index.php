<?php include ROOT.'/views/layouts/header.php'  ?>

<div>
    <img id="zoom1" style="width: 300px;height: 400px;" src="<?php echo User::getUserImgById($userDate['id']); ?>" data-zoom-image="img/product/20.jpg" alt="big-1">

    <p> Привет <?php   echo  $userDate['email'] ;?> !</p>
    <p><a href="/cabinet/edit/"> Редактировать данные </a> </p>
    <?php if ($_SESSION['role']=='manager') :?>
        <p><a href="/manager/"> Кабинет менеджера </a> </p>
    <?php endif; ?>
</div>

<?php include ROOT.'/views/layouts/footer.php'?>
