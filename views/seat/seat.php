<div class="container mt-4 mb-2">
    <div class="text-end mb-2">
        <button class="btn btn-primary shadow-btn" type="button" id="addSeat">+ <?= Yii::t('app', 'Add Seat Type') ?></button>
    </div>
</div>

<div class="container py-3 overflow-auto">

    <table class="table table-bordered" id="seatTable">
        <thead>
            <tr valign="middle" align="center">
                <th scope="col" class="text-nowrap">#</th>
                <th scope="col" class="text-nowrap"><?= Yii::t('app', 'Seat Type') ?></th>
                <th scope="col" class="text-nowrap"><?= Yii::t('app', 'Seat Color') ?></th>
                <th scope="col"></th>
                <th scope="col"></th>
            </tr>
        </thead>
        <tbody>
    
        </tbody>
    </table>

    <!-- start of add seat type -->
    <form id="seatForm">
        <div class="modal" tabindex="-1" id="addSeatModal">
            <div class="modal-dialog  modal-dialog-centered modal-dialog-scrollable">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title"><?= Yii::t('app', 'Add Seat Type') ?></h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-2">
                            <label for=""><?= Yii::t('app', 'Seat Type') ?><span class=" text-alert text-danger">*</span></label>
                            <input type="text" class="form-control" id="inputType" placeholder="<?= Yii::t('app', 'Seat Type') ?>">
                            <span class=" text-alert text-danger" id="typeAlert"></span>
                        </div>
                        <div class="mb-2">
                            <label for=""><?= Yii::t('app', 'Seat Color') ?><span class=" text-alert text-danger">*</span></label><br>
                            <input class="form-control" id="inputColor" value="" placeholder="<?= Yii::t('app', 'Seat Color') ?>">
                            <span class="text-alert text-danger" id="colorAlert"></span>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><?= Yii::t('app', 'Close') ?></button>
                        <button type="submit" class="btn btn-primary"><?= Yii::t('app', 'Add') ?></button>
                    </div>
                </div>
            </div>
        </div>
    </form>
    <!-- end of add seat type -->

    <!-- start of edit seat type -->
    <form id="editSeatForm">
        <div class="modal" tabindex="-1" id="editSeatModal">
            <div class="modal-dialog  modal-dialog-centered modal-dialog-scrollable">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title"><?= Yii::t('app', 'Edit Seat Type') ?></h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-2">
                            <label for=""><?= Yii::t('app', 'Seat Type') ?><span class=" text-alert text-danger">*</span></label>
                            <input type="text" class="form-control" id="inputEditType" placeholder="<?= Yii::t('app', 'Seat Type') ?>">
                            <span class=" text-alert text-danger" id="typeEditAlert"></span>
                        </div>
                        <div class="mb-2">
                            <label for=""><?= Yii::t('app', 'Seat Color') ?><span class=" text-alert text-danger">*</span></label><br>
                            <input class="form-control" id="inputEditColor" placeholder="<?= Yii::t('app', 'Seat Color') ?>">
                            <span class="text-alert text-danger" id="colorEditAlert"></span>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><?= Yii::t('app', 'Close') ?></button>
                        <button type="button" class="btn btn-primary" id="btnEditConfModal"><?= Yii::t('app', 'Edit') ?></button>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal" tabindex="-1" id="editConfSeatModal">
            <div class="modal-dialog  modal-dialog-centered modal-dialog-scrollable">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title"><?= Yii::t('app', 'Confirmation') ?></h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" id="btnCloseEditConfSeatModal"></button>
                    </div>
                    <div class="modal-body">
                        <?= Yii::t('app', 'Are you sure you want to edit this seat type?') ?>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" id="btnCancelEditConfSeatModal"><?= Yii::t('app', 'Cancel') ?></button>
                        <button type="submit" class="btn btn-primary"><?= Yii::t('app', 'Edit') ?></button>
                    </div>
                </div>
            </div>
        </div>
    </form>
    <!-- end of edit seat type -->

    <!-- delete conf modal -->
    <div class="modal" tabindex="-1" id="deleteConfSeatModal">
        <div class="modal-dialog  modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"><?= Yii::t('app', 'Confirmation') ?></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <?= Yii::t('app', 'Are you sure you want to delete this seat type?') ?>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><?= Yii::t('app', 'Cancel') ?></button>
                    <button type="submit" class="btn btn-primary" id="btnDeleteSeatModal"><?= Yii::t('app', 'Delete') ?></button>
                </div>
            </div>
        </div>
    </div>
    <!-- delete conf modal -->
</div>

<script>

    $(function()
    {
        var seatLists = <?= $seatLists ?>;
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

        $('#inputColor, #inputEditColor').spectrum({
            type: "component",
            showPaletteOnly: true,
            showAlpha: false
        });

        function printSeat()
        {
            var html = '';

            for (var i = 0; i < seatLists.length; i++) {
                html += '<tr valign="middle" align="center">\
                            <th>' + (i+1) + '</th>\
                            <td>' + seatLists[i].NAME + '</td>\
                            <td style="background-color: ' + seatLists[i].COLOR + ';">' + seatLists[i].COLOR + '</td>\
                            <td><button class="btn btn-warning" id="btnEdit' + i + '" name="btnEdit" data-index="' + i + '"><?= Yii::t('app', 'Edit') ?></button></td>\
                            <td><button class="btn btn-danger" id="btnDelete' + i + '"  name="btnDelete" data-index="' + i + '"><?= Yii::t('app', 'Delete') ?></button></td>\
                        </tr>';
            }
            
            $("#seatTable tbody").html(html);

            $("#seatTable button[name='btnEdit']").on("click", function()
            {
                index = $(this).data("index");
                
                $("#typeEditAlert, #colorEditAlert").html("");
                $("#inputEditType").val(seatLists[index].NAME);
                $("#inputEditColor").spectrum({
                    color: seatLists[index].COLOR,
                    type: "component",
                    showPalette: false,
                    showPaletteOnly: true,
                    showAlpha: false
                });
                $("#editSeatModal").modal("show");
            });

            $("#seatTable button[name='btnDelete']").on("click",function()
            {
                index = $(this).data("index");

                $("#deleteConfSeatModal").modal("show");
            });
        }

        function valType(type)
        {
            if(type.length == 0)
            {
                $("#typeAlert").html("<?= Yii::t('app', 'Seat type  cannot be empty!') ?>");
                return 1;
            }

            $("#typeAlert").html("");
            return 0;
        }

        function valColor(color)
        {
            if(color.length == 0)
            {
                $("#colorAlert").html("<?= Yii::t('app', 'Seat color  cannot be empty!') ?>");
                return 1;
            }

            if(color == '#ffffff' || color == 'white')
            {
                $("#colorAlert").html("<?= Yii::t('app', 'Please input a different color!') ?>");
                return 1;
            }

            $("#colorAlert").html("");
            return 0;
        }

        function valEditType(type)
        {
            if(type.length == 0)
            {
                $("#typeEditAlert").html("<?= Yii::t('app', 'Seat type  cannot be empty!') ?>");
                return 1;
            }

            $("#typeEditAlert").html("");
            return 0;
        }

        function valEditColor(color)
        {
            if(color.length == 0)
            {
                $("#colorEditAlert").html("<?= Yii::t('app', 'Seat color  cannot be empty!') ?>");
                return 1;
            }

            if(color == '#ffffff' || color == 'white')
            {
                $("#colorEditAlert").html("<?= Yii::t('app', 'Please input a different color!') ?>");
                return 1;
            }

            $("#colorEditAlert").html("");
            return 0;
        }

        printSeat();

        $("#addSeat").on("click", function(event)
        {
            event.preventDefault();

            $("#seatForm").trigger("reset");
            $("#inputColor").spectrum({
                color: 'white',
                type: "component",
                showPalette: false,
                showPaletteOnly: true,
                showAlpha: false
            });
            $("#typeAlert, #colorAlert").html("");
            $("#addSeatModal").modal("show");
            
        });

        $("#seatForm").on("submit", function(event)
        {
            event.preventDefault();
            var flag = 0;

            flag += valType($("#inputType").val());
            flag += valColor($("#inputColor").val());

            if(flag == 0)
            {
                var data = {
                    type: $("#inputType").val().toLowerCase(),
                    color: $("#inputColor").val()
                }

                console.log(data);

                $.ajax
                ({
                    type: 'POST',
                    data: data,
                    dataType: 'JSON',
                    url: '<?= Yii::$app->getUrlManager()->createUrl('seat/add') ?>',
                    success: function(addSeatResult)
                    {
                        if(addSeatResult[0].errNum == 0)
                        {
                            seatLists = addSeatResult[1];
                            printSeat();
                            alert("<?= Yii::t('app', 'Add seat type success!') ?>");
                            $("#addSeatModal").modal("hide");
                        }
                        else
                        {
                            alert(addSeatResult[0].errStr);
                        }
                    }
                });
            }

        });

        $("#inputColor").on("input", function()
        {
            $("#inputColor").val("");
        });

        $("#inputEditColor").on("input", function()
        {
            $("#inputEditColor").val("");
        });

        $("#btnEditConfModal").on("click", function()
        {
            var flag = 0;

            flag += valEditType($("#inputEditType").val());
            flag += valEditColor($("#inputEditColor").val());

            if(flag == 0)
            {
                $("#editSeatModal").modal("hide");
                $("#editConfSeatModal").modal("show");
            }
            
        });

        $("#btnCloseEditConfSeatModal, #btnCancelEditConfSeatModal").on("click", function(){

            $("#editConfSeatModal").modal("hide");
            $("#editSeatModal").modal("show");
        });

        $("#editSeatForm").on("submit", function(event)
        {   
            event.preventDefault();

            var data = {
                id: seatLists[index].ID,
                type: $("#inputEditType").val().toLowerCase(),
                color: $("#inputEditColor").val()
            }

            // console.log(data);

            $.ajax
            ({
                type: 'POST',
                data: data,
                dataType: 'JSON',
                url: '<?= Yii::$app->getUrlManager()->createUrl('seat/update') ?>',
                success: function(updateSeatResult)
                {
                    if(updateSeatResult[0].errNum == 0)
                    {
                        seatLists = updateSeatResult[1];
                        printSeat();
                        alert("<?= Yii::t('app', 'Edit seat type success!') ?>");
                        $("#editConfSeatModal").modal("hide");
                    }
                    else
                    {
                        alert(updateSeatResult[0].errStr);
                        $("#editConfSeatModal").modal("hide");
                        $("#editSeatModal").modal("show");
                    }
                }
            });
        });

        $("#btnDeleteSeatModal").on("click", function()
        {
            var data = {
                id: seatLists[index].ID
            }

            $.ajax
            ({
                type: 'POST',
                data: data,
                dataType: 'JSON',
                url: '<?= Yii::$app->getUrlManager()->createUrl('seat/delete') ?>',
                success: function(deleteSeatResult)
                {
                    if(deleteSeatResult[0].errNum == 0)
                    {
                        seatLists = deleteSeatResult[1];
                        printSeat();
                        alert("<?= Yii::t('app', 'Delete seat type success!') ?>");
                        $("#deleteConfSeatModal").modal("hide");
                    }
                    else
                    {
                        alert(deleteSeatResult[0].errStr);
                        $("#deleteConfSeatModal").modal("hide");
                    }
                } 
            });
        });
    });

</script>