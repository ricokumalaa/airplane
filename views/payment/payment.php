<div class="container mt-4 mb-2">
    <div class="text-end mb-2">
        <button class="btn btn-primary shadow-btn" type="button" id="addPayment">+ <?= Yii::t('app', 'Add Payment') ?></button>
    </div>
</div>

<div class="container py-3 overflow-auto">
    

    <table class="table table-bordered" id="paymentTable">
        <thead>
            <tr valign="middle" align="center">
                <th scope="col" class="text-nowrap">#</th>
                <th scope="col" class="text-nowrap"><?= Yii::t('app', 'Payment') ?></th>
                <th scope="col"></th>
                <th scope="col"></th>
            </tr>
        </thead>
        <tbody>
            
        </tbody>
    </table>

    <!-- add payment modal -->
    <form id="addPaymentForm">
        <div class="modal" tabindex="-1" id="addPaymentModal">
            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title"><?= Yii::t('app', 'Add Payment') ?></h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-2">
                            <label for=""><?= Yii::t('app', 'Payment') ?><span class=" text-alert text-danger">*</span></label>
                            <input type="text" class="form-control" id="inputPayment" placeholder="<?= Yii::t('app', 'Payment') ?>">
                            <span class=" text-alert text-danger" id="paymentAlert"></span>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><?= Yii::t('app', 'Close') ?></button>
                        <button type="button" class="btn btn-primary" id="btnAddPaymentConfModal"><?= Yii::t('app', 'Add') ?></button>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal" tabindex="-1" id="addPaymentConfModal">
            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title"><?= Yii::t('app', 'Confirmation') ?></h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" id="closeAddPaymentConfModal"></button>
                    </div>
                    <div class="modal-body">
                        <?= Yii::t('app', 'Are you sure you want to add payment?') ?>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" id="cancelAddPaymentConfModal"><?= Yii::t('app', 'Cancel') ?></button>
                        <button type="submit" class="btn btn-primary"><?= Yii::t('app', 'Add') ?></button>
                    </div>
                </div>
            </div>
        </div>
    </form>
    <!-- add payment modal -->

    <!-- edit payment modal -->
    <form id="editPaymentForm">
        <div class="modal" tabindex="-1" id="editPaymentModal">
            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title"><?= Yii::t('app', 'Edit Payment') ?></h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-2">
                            <label for=""><?= Yii::t('app', 'Payment') ?><span class=" text-alert text-danger">*</span></label>
                            <input type="text" class="form-control" id="inputEditPayment" placeholder="<?= Yii::t('app', 'Payment') ?>">
                            <span class=" text-alert text-danger" id="editPaymentAlert"></span>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><?= Yii::t('app', 'Close') ?></button>
                        <button type="button" class="btn btn-primary" id="btnEditPaymentConfModal"><?= Yii::t('app', 'Edit') ?></button>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal" tabindex="-1" id="editPaymentConfModal">
            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title"><?= Yii::t('app', 'Confirmation') ?></h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" id="closePaymentConfModal"></button>
                    </div>
                    <div class="modal-body">
                        <?= Yii::t('app', 'Are you sure you want to edit payment?') ?>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" id="cancelPaymentConfModal"><?= Yii::t('app', 'Cancel') ?></button>
                        <button type="submit" class="btn btn-primary"><?= Yii::t('app', 'Edit') ?></button>
                    </div>
                </div>
            </div>
        </div>
    </form>
    <!-- edit payment modal -->

    <!-- delete confirmation modal -->
    <div class="modal" tabindex="-1" id="deletePaymentConfModal">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"><?= Yii::t('app', 'Confirmation') ?></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <?= Yii::t('app', 'Are you sure you want to delete this payment?') ?>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><?= Yii::t('app', 'Cancel') ?></button>
                    <button type="button" class="btn btn-primary" id="btnDeleteConfModal"><?= Yii::t('app', 'Delete') ?></button>
                </div>
            </div>
        </div>
    </div>
    <!-- delete confirmation modal -->

</div>

<script>

    $(function()
    {
        var paymentLists = <?= $paymentLists ?>;
        var sessionId = <?= $sessionId ?>;
        var sessionFirstName = <?= $sessionFirstName ?>;
        var index;

        if(sessionId)
        {
            $("#navbarUserNow #navbarDarkDropdownMenuLink").html(sessionFirstName);
            $("#navbarUserNow").attr("hidden", false);
            $("#navbarAdmin").attr("hidden", false);
            $("#navbarSetup").attr("hidden", false);
            $("#navbarBook").attr("hidden", false);
            $("#navbarReport").attr("hidden", false);
        }

        function valPayment(payment)
        {
            if(!payment)
            {
                $("#paymentAlert").html("<?= Yii::t('app', 'Payment cannot be empty!') ?>");
                return 1;
            }

            $("#paymentAlert").html("");
            return 0;
        }

        function valEditPayment(payment)
        {
            if(!payment)
            {
                $("#editPaymentAlert").html("<?= Yii::t('app', 'Payment cannot be empty!') ?>");
                return 1;
            }

            $("#editPaymentAlert").html("");
            return 0;
        }

        function printPayment()
        {
            var html = '';

            for (var i = 0; i < paymentLists.length; i++) {
                html += '<tr align="center">\
                            <th>' + (i+1) + '</th>\
                            <td class="col-6 text-capitalize">' + paymentLists[i].NAME + '</td>\
                            <td><button class="btn btn-warning" id="btnEdit' + i + '" name="btnEdit" data-index="' + i + '"><?= Yii::t('app', 'Edit') ?></button></td>\
                            <td><button class="btn btn-danger" id="btnDelete' + i + '" name="btnDelete" data-index="' + i + '"><?= Yii::t('app', 'Delete') ?></button></td>\
                        </tr>';
            }

            $("#paymentTable tbody").html(html);

            $("#paymentTable button[name='btnEdit']").on("click", function()
            {
                index = $(this).data("index");

                $("#inputEditPayment").val(paymentLists[index].NAME);
                $("#editPaymentAlert").html("");
                $("#editPaymentModal").modal("show");
            });

            $("#paymentTable button[name='btnDelete']").on("click", function()
            {
                index = $(this).data("index");

                $("#deletePaymentConfModal").modal("show");
            });
        }

        printPayment();

        $("#addPayment").on("click", function(event)
        {
            event.preventDefault();

            $("#addPaymentForm").trigger("reset");
            $("#paymentAlert").html("");
            $("#addPaymentModal").modal("show");
        });

        $("#btnAddPaymentConfModal").on("click", function()
        {
            var flag = 0;;
            
            flag += valPayment($("#inputPayment").val());

            if(flag == 0)
            {
                $("#addPaymentModal").modal("hide");
                $("#addPaymentConfModal").modal("show");
            }
        });

        $("#closeAddPaymentConfModal, #cancelAddPaymentConfModal").on("click", function()
        {
            $("#addPaymentConfModal").modal("hide");
            $("#addPaymentModal").modal("show");
        });

        $("#addPaymentForm").on("submit", function(event)
        {
            event.preventDefault();

            var data = {
                payment: $("#inputPayment").val().toLowerCase(),
                sessionId: sessionId
            }

            $.ajax
            ({
                type: 'POST',
                data: data,
                dataType: 'JSON',
                url: '<?= Yii::$app->getUrlManager()->createUrl('payment/add') ?>',
                success: function(addPaymentResult)
                {
                    if(addPaymentResult[0].errNum == 0)
                    {
                        paymentLists = addPaymentResult[1];
                        printPayment();
                        alert("<?= Yii::t('app', 'Add payment success!') ?>");
                        $("#addPaymentConfModal").modal("hide");
                        $("#addPaymentForm").trigger("reset");
                    }
                    else
                    {
                        alert(addPaymentResult[0].errStr);
                        $("#addPaymentConfModal").modal("hide");
                        $("#addPaymentModal").modal("show");
                    }
                }
            });
        });

        $("#btnEditPaymentConfModal").on("click", function()
        {
            var flag = 0;

            flag += valEditPayment($("#inputEditPayment").val());

            if(flag == 0)
            {
                $("#editPaymentModal").modal("hide");
                $("#editPaymentConfModal").modal("show");
            }

        });

        $("#closePaymentConfModal, #cancelPaymentConfModal").on("click", function()
        {
            $("#editPaymentConfModal").modal("hide");
            $("#editPaymentModal").modal("show");
        }); 

        $("#editPaymentForm").on("submit", function(event)
        {
            event.preventDefault();

            var data = {
                id: paymentLists[index].ID,
                payment: $("#inputEditPayment").val().toLowerCase(),
                sessionId: sessionId
            }

            $.ajax
            ({
                type: 'POST',
                data: data,
                dataType: 'JSON',
                url: '<?= Yii::$app->getUrlManager()->createUrl('payment/update') ?>',
                success: function(updatePaymentResult)
                {
                    console.log(updatePaymentResult);
                    if(updatePaymentResult[0].errNum == 0)
                    {
                        paymentLists = updatePaymentResult[1];
                        printPayment();
                        alert("<?= Yii::t('app', 'Edit payment success!') ?>");
                        $("#editPaymentConfModal").modal("hide");
                        $("#editPaymentForm").trigger("reset");
                    }
                    else
                    {
                        alert(updatePaymentResult[0].errStr);
                        $("#editPaymentConfModal").modal("hide");
                        $("#editPaymentModal").modal("show");
                    }
                }
            });
        });

        $("#btnDeleteConfModal").on("click", function()
        {
            var data = {
                id: paymentLists[index].ID,
                sessionId: sessionId
            }

            $.ajax
            ({
                type: 'POST',
                data: data,
                dataType: 'JSON',
                url: '<?= Yii::$app->getUrlManager()->createUrl('payment/delete') ?>',
                success: function(deletePaymentResult)
                {
                    console.log(deletePaymentResult);
                    if(deletePaymentResult[0].errNum == 0)
                    {
                        paymentLists = deletePaymentResult[1];
                        printPayment();
                        alert("<?= Yii::t('app', 'Delete payment success!') ?>");
                        $("#deletePaymentConfModal").modal("hide");
                    }
                    else
                    {
                        alert(deletePaymentResult[0].errStr);
                        $("#deletePaymentConfModal").modal("hide");
                    }
                }
            });
        });
    });

</script>