<div class="container d-flex align-items-center justify-content-center" id="loginBackground">

    <div class="login-wrapper text-align-center text-center p-3">
        <div class="logo-wrapper mx-auto mt-2 mb-3">
            <img class="h-100 w-100" src="<?= Yii::$app->request->baseUrl ?>/img/airplane.png">
        </div>
        <div class="signin-title mb-2">
            <h5><?= Yii::t('app', 'Sign In') ?></h5>
        </div>
        <div class="bg-danger mt-3 rounded" id="alertWrapper" hidden = "true">
            <h6 class="text-white py-2 mb-0"><?= Yii::t('app', 'Incorrect email or password!') ?></h6>
        </div>
        <form class="text-start p-3" id="loginForm">
            <div class="mb-3">
                <label for=""><?= Yii::t('app', 'Email') ?></label>
                <input type="text" class="form-control" id="inputEmail" placeholder="<?= Yii::t('app', 'Email Address') ?>">
                <span class="text-alert text-danger" id="emailAlert"></span>
            </div>
            <div class="mb-3">
                <label for=""><?= Yii::t('app', 'Password') ?></label>
                <input type="password" class="form-control" id="inputPassword" placeholder="<?= Yii::t('app', 'Password') ?>">
                <span class="text-alert text-danger" id="passwordAlert"></span>
            </div>
            <button type="submit" class="btn btn-primary w-100 mt-3"><?= Yii::t('app', 'Sign In') ?></button>
        </form>
    </div>

</div>

<script>

    $(function()
    {

        function valEmail(email)
        {
            if(email.length == 0)
            {
                $("#emailAlert").html("<?= Yii::t('app', 'Email address cannot be empty!') ?>");
                return 1;
            }

            $("#emailAlert").html("");
            return 0;
        }

        function valPassword(password)
        {
            if(password.length == 0)
            {
                $("#passwordAlert").html("<?= Yii::t('app', 'Password cannot be empty!') ?>");
                return 1;
            }

            $("#passwordlAlert").html("");
            return 0;
        }

        $("#loginForm").on("submit", function(event)
        {
            event.preventDefault();

            var flag = 0;

            flag += valEmail($("#inputEmail").val());
            flag += valPassword($("#inputPassword").val());

            if(flag == 0)
            {
                var data = {
                    email: $("#inputEmail").val().toLowerCase(),
                    password: $("#inputPassword").val(),
                }

                $.ajax
                ({
                    type: 'POST',
                    data: data,
                    dataType: 'JSON',
                    url: '<?= Yii::$app->getUrlManager()->createUrl('/signin/signin-user') ?>',
                    success: function(loginResult)
                    {
                        // console.log(loginResult);
                        if(loginResult.errNum == 1)
                        {
                            alert(loginResult.errStr);
                            $("#alertWrapper").attr("hidden", false);
                            return;
                        }
                    }
                });
            }

        });

    });

</script>