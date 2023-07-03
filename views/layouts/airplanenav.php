<?php

/** @var yii\web\View $this */
/** @var string $content */

use app\assets\AppAsset;
use yii\bootstrap5\Html;
use yii\bootstrap5\Nav;
use yii\bootstrap5\NavBar;

AppAsset::register($this);
$this->registerCsrfMetaTags();
?>

<?php $this->beginPage() ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Airplane</title>
    <?php $this->head() ?>
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/spectrum-colorpicker2/dist/spectrum.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.4/css/dataTables.bootstrap5.min.css" />
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script src="//cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap5.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>
    <script src="https://cdn.datatables.net/plug-ins/1.13.4/sorting/datetime-moment.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/spectrum-colorpicker2/dist/spectrum.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>

</head>

<header>
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary px-4">
        <div class="container-fluid">
            <a class="navbar-brand" href="<?= Yii::$app->getUrlManager()->createUrl('signin/') ?>">L</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                <div class="navbar-nav w-100">
                    <a class="nav-link active" aria-current="page" href="<?= Yii::$app->getUrlManager()->createUrl('user/') ?>" id="navbarAdmin" hidden="true">User</a>
                    <ul class="navbar-nav" id="navbarSetup" hidden="true">
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle text-white" href="#" id="navbarDarkDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                Setup
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="navbarDarkDropdownMenuLink">
                                <li><a class="dropdown-item text" href="<?= Yii::$app->getUrlManager()->createUrl('seat/') ?>"><?= Yii::t('app', 'Seat Type') ?></a></li>
                                <li><a class="dropdown-item text" href="<?= Yii::$app->getUrlManager()->createUrl('airplane/') ?>"><?= Yii::t('app', 'Airplane') ?></a></li>
                                <li><a class="dropdown-item text" href="<?= Yii::$app->getUrlManager()->createUrl('flight/') ?>"><?= Yii::t('app', 'Flight') ?></a></li>
                                <li><a class="dropdown-item text" href="<?= Yii::$app->getUrlManager()->createUrl('payment/') ?>"><?= Yii::t('app', 'Payment Method') ?></a></li>
                            </ul>
                        </li>
                    </ul>
                    <a class="nav-link text-white" href="<?= Yii::$app->getUrlManager()->createUrl('book/') ?>" id="navbarBook" hidden="true">Booking</a>
                    <a class="nav-link text-white" href="<?= Yii::$app->getUrlManager()->createUrl('report/') ?>" id="navbarReport" hidden="true"><?= Yii::t('app', 'Report') ?></a>
                    <a class="nav-link ms-lg-auto text-white" href="#" id="setLanguage"><?= Yii::t('app', 'Langguage') ?></a>
                    <ul class="navbar-nav" id="navbarUserNow" hidden="true">
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle text-white" href="#" id="navbarDarkDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                User
                            </a>
                            <ul class="dropdown-menu dropdown-menu-lg-end" aria-labelledby="navbarDarkDropdownMenuLink">
                                <li><a class="dropdown-item text" href="<?= Yii::$app->getUrlManager()->createUrl('logout/') ?>">Log out</a></li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </nav>
</header>

<?php $this->beginBody() ?>

<body>
    <?= $content ?>

    <!-- language modal -->
    <div class="modal" tabindex="-1" id="languageModal">
        <form id="langForm">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title"><?= Yii::t('app', 'Preferred Language') ?></h5>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" name="_csrf" value="<?=Yii::$app->request->getCsrfToken()?>" />
                        <label for="language" class="mb-2"><?= Yii::t('app', 'Choose your preferred language:') ?></label>
                        <select id="language" name="language" class="form-select">
                            <option value="eng">English</option>
                            <option value="indo">Bahasa Indonesia</option>
                        </select>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" id="btnClose" data-bs-dismiss="modal"><?= Yii::t('app', 'Close') ?></button>
                        <button type="submit" class="btn btn-primary" id="btnConfLanguage"><?= Yii::t('app', 'Save Changes') ?></button>
                    </div>
                </div>
            </div>
        </form>
    </div>
    <!-- language modal -->
</body>

<?php $this->endBody() ?>

<footer>
</footer>

</html>

<script>

    $(function()
    {
        $("#setLanguage").on("click", function(event)
        {
            $("#languageModal").modal("show");
        });

        $("#langForm").on("submit", function(event)
        {   
            event.preventDefault();
            console.log($("#language").val());

            $.ajax
            ({
                type: 'POST',
                data: {
                    language: $("#language").val()
                },
                dataType: 'JSON',
                url: '<?= Yii::$app->getUrlManager()->createUrl('/lang') ?>',
                success: function(test)
                {
                    location.reload();
                    // $("#languageModal").modal("hide");
                }
            });
        });
    });

</script>

<?php $this->endPage() ?>