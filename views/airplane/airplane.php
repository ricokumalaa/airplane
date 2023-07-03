<div class="container mt-4 mb-2">
    <div class="text-end mb-2">
        <button class="btn btn-primary shadow-btn" type="button" id="addAirplane">+ <?= Yii::t('app', 'Add Airplane') ?></button>
    </div>
</div>

<div class="container py-3 overflow-auto">
    
    <table class="table table-bordered" id="airplaneTable">
        <thead>
            <tr valign="middle" align="center">
                <th scope="col" class="text-nowrap text-center"><?= Yii::t('app', 'Airplane Name') ?></th>
                <th scope="col" class="text-nowrap text-center"><?= Yii::t('app', 'Brand') ?></th>
                <th scope="col" class="text-nowrap text-center"><?= Yii::t('app', 'Model') ?></th>
                <th scope="col" class="text-nowrap text-center"><?= Yii::t('app', 'Registration No.') ?></th>
                <th scope="col" class="text-nowrap text-center"><?= Yii::t('app', 'Color') ?></th>
                <th scope="col" class="text-nowrap text-center"><?= Yii::t('app', 'Seat Type') ?></th>
                <th scope="col" class="text-nowrap text-center"><?= Yii::t('app', 'Max Seat') ?></th>
                <th scope="col"></th>
                <th scope="col"></th>
                <th scope="col"></th>
            </tr>
        </thead>
        <tbody>

        </tbody>
    </table>

    <form id="addAirplaneForm">
        <div class="modal" tabindex="-1" id="addAirplaneModal">
            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"><?= Yii::t('app', 'Add Airplane') ?></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-2">
                        <label for=""><?= Yii::t('app', 'Name') ?><span class=" text-alert text-danger">*</span></label>
                        <input type="text" class="form-control" id="inputName" placeholder="<?= Yii::t('app', 'Name') ?>">
                        <span class=" text-alert text-danger" id="nameAlert"></span>
                    </div>
                    <div class="mb-2">
                        <label for=""><?= Yii::t('app', 'Brand') ?><span class=" text-alert text-danger">*</span></label>
                        <input type="text" class="form-control" id="inputBrand" placeholder="<?= Yii::t('app', 'Brand') ?>">
                        <span class=" text-alert text-danger" id="brandAlert"></span>
                    </div>
                    <div class="mb-2">
                        <label for=""><?= Yii::t('app', 'Model') ?><span class=" text-alert text-danger">*</span></label>
                        <input type="text" class="form-control" id="inputModel" placeholder="<?= Yii::t('app', 'Model') ?>">
                        <span class=" text-alert text-danger" id="modelAlert"></span>
                    </div>
                    <div class="mb-2">
                        <label for=""><?= Yii::t('app', 'Registration No.') ?><span class=" text-alert text-danger">*</span></label>
                        <input type="text" class="form-control" id="inputRegis" placeholder="<?= Yii::t('app', 'Registration No.') ?>">
                        <span class="text-alert text-danger" id="regisAlert"></span>
                    </div>
                    <div class="mb-2">
                        <label for=""><?= Yii::t('app', 'Color') ?><span class=" text-alert text-danger">*</span></label>
                        <input type="text" class="form-control" id="inputColor" placeholder="<?= Yii::t('app', 'Color') ?>">
                        <span class="text-alert text-danger" id="colorAlert"></span>
                    </div>
                    <div class="mb-2">
                        <label for=""><?= Yii::t('app', 'Seat Type') ?><span class=" text-alert text-danger">*</span></label><br>
                        <select id="inputSeatType" multiple name="native-select" placeholder="<?= Yii::t('app', 'Seat Type') ?>" data-search="false" data-silent-initial-value-set="true">
                            
                        </select>
                        <span class="text-alert text-danger" id="seatTypeAlert"></span>
                    </div>
                    <div class="mb-2">
                        <label for=""><?= Yii::t('app', 'Max Seat Column') ?><span class=" text-alert text-danger">*</span></label>
                        <input type="number" class="form-control" id="inputColumn" placeholder="<?= Yii::t('app', 'Column') ?>">
                        <span class="text-alert text-danger" id="columnAlert"></span>
                    </div>
                    <div class="mb-2">
                        <label for=""><?= Yii::t('app', 'Max Seat Row') ?><span class=" text-alert text-danger">*</span></label>
                        <input type="number" class="form-control" id="inputRow" placeholder="<?= Yii::t('app', 'Row') ?>">
                        <span class="text-alert text-danger" id="rowAlert"></span>
                    </div>
                    <div class="mb-2">
                        <label for=""><?= Yii::t('app', 'Max Seats') ?></label>
                        <h6 id="maxSeat"></h6>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><?= Yii::t('app', 'Close') ?></button>
                    <button type="button" class="btn btn-primary" id="btnAddConfAirplane"><?= Yii::t('app', 'Add') ?></button>
                </div>
                </div>
            </div>
        </div>

        <div class="modal" tabindex="-1" id="addConfAirplaneModal">
            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"><?= Yii::t('app', 'Confirmation') ?></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" id="btnCloseAddAirplane"></button>
                </div>
                <div class="modal-body">
                    <?= Yii::t('app', 'Are you sure you want to add airplane?') ?>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" id="btnCancelAddAirplane"><?= Yii::t('app', 'Cancel') ?></button>
                    <button type="submit" class="btn btn-primary" id="btnAddConfAirplane"><?= Yii::t('app', 'Add') ?></button>
                </div>
                </div>
            </div>
        </div>
    </form>

    <form id="editAirplaneForm">
        <div class="modal" tabindex="-1" id="editAirplaneModal">
            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title"><?= Yii::t('app', 'Edit Airplane') ?><span class=" text-alert text-danger">*</span></h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                <div class="modal-body">
                    <div class="mb-2">
                        <label for=""><?= Yii::t('app', 'Name') ?><span class=" text-alert text-danger">*</span></label>
                        <input type="text" class="form-control" id="inputEditName" placeholder="<?= Yii::t('app', 'Name') ?>">
                        <span class=" text-alert text-danger" id="nameEditAlert"></span>
                    </div>
                    <div class="mb-2">
                        <label for=""><?= Yii::t('app', 'Brand') ?><span class=" text-alert text-danger">*</span></label>
                        <input type="text" class="form-control" id="inputEditBrand" placeholder="<?= Yii::t('app', 'Brand') ?>">
                        <span class=" text-alert text-danger" id="brandEditAlert"></span>
                    </div>
                    <div class="mb-2">
                        <label for=""><?= Yii::t('app', 'Model') ?><span class=" text-alert text-danger">*</span></label>
                        <input type="text" class="form-control" id="inputEditModel" placeholder="<?= Yii::t('app', 'Model') ?>">
                        <span class=" text-alert text-danger" id="modelEditAlert"></span>
                    </div>
                    <div class="mb-2">
                        <label for=""><?= Yii::t('app', 'Registration No.') ?><span class=" text-alert text-danger">*</span></label>
                        <input type="text" class="form-control" id="inputEditRegis" placeholder="<?= Yii::t('app', 'Registration No.') ?>">
                        <span class="text-alert text-danger" id="regisEditAlert"></span>
                    </div>
                    <div class="mb-2">
                        <label for=""><?= Yii::t('app', 'Color') ?><span class=" text-alert text-danger">*</span></label>
                        <input type="text" class="form-control" id="inputEditColor" placeholder="<?= Yii::t('app', 'Color') ?>">
                        <span class="text-alert text-danger" id="colorEditAlert"></span>
                    </div>
                    <div class="mb-2">
                        <label for=""><?= Yii::t('app', 'Seat Type') ?><span class=" text-alert text-danger">*</span></label><br>
                        <select id="inputEditSeatType" multiple name="native-select" placeholder="<?= Yii::t('app', 'Seat Type') ?>" data-search="false" data-silent-initial-value-set="true">
                            
                        </select>
                        <span class="text-alert text-danger" id="seatTypeEditAlert"></span>
                    </div>
                    <div class="mb-2">
                        <label for=""><?= Yii::t('app', 'Max Seat Column') ?><span class=" text-alert text-danger">*</span></label>
                        <input type="number" class="form-control" id="inputEditColumn" placeholder="<?= Yii::t('app', 'Column') ?>">
                        <span class="text-alert text-danger" id="columnEditAlert"></span>
                    </div>
                    <div class="mb-2">
                        <label for=""><?= Yii::t('app', 'Max Seat Row') ?><span class=" text-alert text-danger">*</span></label>
                        <input type="number" class="form-control" id="inputEditRow" placeholder="<?= Yii::t('app', 'Row') ?>">
                        <span class="text-alert text-danger" id="rowEditAlert"></span>
                    </div>
                    <span class="text-alert text-danger"><?= Yii::t('app', 'Changing seat column and row will reset airplane seats setting!') ?></span>
                    <div class="mb-2">
                        <label for=""><?= Yii::t('app', 'Max Seats') ?></label>
                        <h6 id="maxEditSeat"></h6>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><?= Yii::t('app', 'Close') ?></button>
                    <button type="button" class="btn btn-primary" id="btnEditConfAirplane"><?= Yii::t('app', 'Edit') ?></button>
                </div>
                </div>
            </div>
        </div>

        <div class="modal" tabindex="-1" id="editConfAirplaneModal">
            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"><?= Yii::t('app', 'Confirmation') ?></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" id="btnCloseEditAirplane"></button>
                </div>
                <div class="modal-body">
                    <?= Yii::t('app', 'Are you sure you want to edit airplane?') ?>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" id="btnCancelEditAirplane"><?= Yii::t('app', 'Cancel') ?></button>
                    <button type="submit" class="btn btn-primary" id="btnEditConfAirplane"><?= Yii::t('app', 'Edit') ?></button>
                </div>
                </div>
            </div>
        </div>
    </form>

    <!-- airplane map seat modal -->
    <div class="modal" tabindex="-1" id="seatMapModal">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"><?= Yii::t('app', 'Seat Map') ?></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="container">
                    <ul class="d-flex justify-content-evenly align-items-center m-2 p-0" id="seatShowCaseWrapper">
                        
                    </ul>
                    <div class="cockpit-wrapper text-center py-2">
                        <h6 class="m-0">Cockpit</h6>
                    </div>
                    <div class="container overflow-auto d-grid gap-1" id="seatWrapper">
                        
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><?= Yii::t('app', 'Close') ?></button>
                <button type="button" class="btn btn-danger" id="btnUnselectAllSeat"><?= Yii::t('app', 'Unselect All') ?></button>
                <button type="button" class="btn btn-primary" id="btnSelectAllSeat"><?= Yii::t('app', 'Select All') ?></button>
                <button type="button" class="btn btn-warning" hidden="true" id="btnEditSelectedSeat"><?= Yii::t('app', 'Edit') ?></button>
            </div>
            </div>
        </div>
    </div>
    <!-- airplane map seat modal -->

    <form id="setSeatForm">
        <div class="modal" tabindex="-1" id="setSeatModal">
            <div class="modal-dialog">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"><?= Yii::t('app', 'Set Seat') ?></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" id="btnCloseSetSeatModal"></button>
                </div>
                <div class="modal-body">
                <div class="mb-2">
                        <label for=""><?= Yii::t('app', 'Seat Status') ?></label><br>
                        <select id="inputSetSeatStatus" class="form-select" value="">
                            <option value="enable">Enable</option>
                            <option value="disable">Disable</option>
                        </select>
                        <span class="text-alert text-danger" id="seatStatusSetAlert"></span>
                    </div>
                    <div class="mb-2" id="inputSetSeatTypeWrapper" hidden=true>
                        <label for=""><?= Yii::t('app', 'Seat Type') ?></label><br>
                        <select id="inputSetSeatType" class="form-select" value="">
                            
                        </select>
                        <span class="text-alert text-danger" id="seatTypeSetAlert"></span>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" id="btnCancelSetSeatModal"><?= Yii::t('app', 'Cancel') ?></button>
                    <button type="submit" class="btn btn-primary"><?= Yii::t('app', 'Set') ?></button>
                </div>
                </div>
            </div>
        </div>
    </form>

    <!-- delete confirmation modal -->
    <div class="modal" tabindex="-1" id="deleteAirplaneConfModal">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"><?= Yii::t('app', 'Confirmation') ?></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" id="closeDeleteAirplaneConfModal"></button>
                </div>
                <div class="modal-body">
                    <?= Yii::t('app', 'Are you sure you want to delete this airplane?') ?>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" id="cancelDeleteAirplaneConfModal"><?= Yii::t('app', 'Cancel') ?></button>
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

        var airplaneLists = <?= $airplaneLists ?>;
        var seatLists = <?= $seatLists ?>;
        var sessionId = <?= $sessionId ?>;
        var sessionFirstName = <?= $sessionFirstName ?>;
        var seatMap = [];
        var selectedSeat = [];
        var row;
        var column;

        console.log(airplaneLists);

        function printSeatType()
        {
            var html = '';

            for (var i = 0; i < seatLists.length; i++) {
                html += '<option value="' + seatLists[i].ID + '" >' + seatLists[i].NAME + '</option>';
            }

            $("#inputSeatType").html(html);
            $("#inputEditSeatType").html(html);
        }

        function valName(name)
        {
            if(name.length == 0)
            {
                $("#nameAlert").html("<?= Yii::t('app', 'Airplane name cannot be empty!') ?>");
                return 1;
            }

            $("#nameAlert").html("");
            return 0;
        }

        function valBrand(brand)
        {
            if(brand.length == 0)
            {
                $("#brandAlert").html("<?= Yii::t('app', 'Airplane brand cannot be empty!') ?>");
                return 1;
            }

            $("#brandAlert").html("");
            return 0;
        }

        function valModel(model)
        {
            if(model.length == 0)
            {
                $("#modelAlert").html("<?= Yii::t('app', 'Airplane model cannot be empty!') ?>");
                return 1;
            }

            $("#modelAlert").html("");
            return 0;
        }

        function valRegis(registration)
        {
            if(registration.length == 0)
            {
                $("#regisAlert").html("<?= Yii::t('app', 'Registration number cannot be empty!') ?>");
                return 1;
            }

            $("#regisAlert").html("");
            return 0;
        }

        function valColor(color)
        {
            if(color.length == 0)
            {
                $("#colorAlert").html("<?= Yii::t('app', 'Airplane color cannot be empty!') ?>");
                return 1;
            }

            $("#colorAlert").html("");
            return 0;
        }

        function valSeatType(seat)
        {
            if(seat.length == 0)
            {
                $("#seatTypeAlert").html("<?= Yii::t('app', 'Airplane seat type cannot be empty!') ?>");
                return 1;
            }

            $("#seatTypeAlert").html("");
            return 0;
        }

        function valColumn(column)
        {
            if(column.length == 0)
            {
                $("#columnAlert").html("<?= Yii::t('app', 'Seat column cannot be empty!') ?>");
                return 1;
            }
            
            if(column == 0)
            {
                $("#columnAlert").html("<?= Yii::t('app', 'Seat column cannot be 0!') ?>");
                return 1;
            }

            $("#columnAlert").html("");
            return 0;
        }

        function valRow(row)
        {
            if(row.length == 0)
            {
                $("#rowAlert").html("<?= Yii::t('app', 'Seat row cannot be empty!') ?>");
                return 1;
            }

            if(row == 0)
            {
                $("#rowAlert").html("<?= Yii::t('app', 'Seat row cannot be 0!') ?>");
                return 1;
            }

            if(row > 26)
            {
                $("#rowAlert").html("<?= Yii::t('app', 'Seat row cannot be larger than 26!') ?>");
                return 1;
            }

            $("#rowAlert").html("");
            return 0;
        }

        function valEditName(name)
        {
            if(name.length == 0)
            {
                $("#nameEditAlert").html("<?= Yii::t('app', 'Airplane name cannot be empty!') ?>");
                return 1;
            }

            $("#nameEditAlert").html("");
            return 0;
        }

        function valEditBrand(brand)
        {
            if(brand.length == 0)
            {
                $("#brandEditAlert").html("<?= Yii::t('app', 'Airplane brand cannot be empty!') ?>");
                return 1;
            }

            $("#brandEditAlert").html("");
            return 0;
        }

        function valEditModel(model)
        {
            if(model.length == 0)
            {
                $("#modelEditAlert").html("<?= Yii::t('app', 'Airplane model cannot be empty!') ?>");
                return 1;
            }

            $("#modelEditAlert").html("");
            return 0;
        }

        function valEditRegis(registration)
        {
            if(registration.length == 0)
            {
                $("#regisEditAlert").html("<?= Yii::t('app', 'Registration number cannot be empty!') ?>");
                return 1;
            }

            $("#regisEditAlert").html("");
            return 0;
        }

        function valEditColor(color)
        {
            if(color.length == 0)
            {
                $("#colorEditAlert").html("<?= Yii::t('app', 'Airplane color cannot be empty!') ?>");
                return 1;
            }

            $("#colorEditAlert").html("");
            return 0;
        }

        function valEditSeatType(seat)
        {
            if(seat.length == 0)
            {
                $("#seatTypeEditAlert").html("<?= Yii::t('app', 'Airplane seat type cannot be empty!') ?>");
                return 1;
            }

            $("#seatTypeEditAlert").html("");
            return 0;
        }

        function valEditColumn(column)
        {
            if(column.length == 0)
            {
                $("#columnEditAlert").html("<?= Yii::t('app', 'Seat column cannot be empty!') ?>");
                return 1;
            }
            
            if(column == 0)
            {
                $("#columnEditAlert").html("<?= Yii::t('app', 'Seat column cannot be 0!') ?>");
                return 1;
            }

            $("#columnEditAlert").html("");
            return 0;
        }

        function valEditRow(row)
        {
            if(row.length == 0)
            {
                $("#rowEditAlert").html("<?= Yii::t('app', 'Seat row cannot be empty!') ?>");
                return 1;
            }

            if(row == 0)
            {
                $("#rowEditAlert").html("<?= Yii::t('app', 'Seat row cannot be 0!') ?>");
                return 1;
            }

            if(row > 26)
            {
                $("#rowEditAlert").html("<?= Yii::t('app', 'Seat row cannot be larger than 26!') ?>");
                return 1;
            }

            $("#rowEditAlert").html("");
            return 0;
        }

        function valSetSeatType(seat)
        {
            if(!seat)
            {
                $("#seatTypeSetAlert").html("<?= Yii::t('app', 'Seat type cannot be empty!') ?>");
                return 1;
            }

            $("#seatTypeSetAlert").html("");
            return 0;
        }

        function valSetSeatStatus(status)
        {
            if(!status)
            {
                $("#seatStatusSetAlert").html("<?= Yii::t('app', 'Seat status cannot be empty!') ?>");
                return 1;
            }

            $("#seatStatusSetAlert").html("");
            return 0;
        }

        function printSetSeatType(seatTypeName, seatTypeId)
        {
            var html = '<option disabled selected value> -- Select Seat Type -- </option>';
            for (var i = 0; i < seatTypeId.length; i++) {
                html += '<option value="' + seatTypeId[i] + '" >' + seatTypeName[i] + '</option>';
            }

            $("#inputSetSeatType").html(html);
            
        }

        function printSeatShowCase(seatTypeName, seatTypeColor)
        {
            var html = '';

            for (var i = 0; i < seatTypeName.length; i++) {
                html += '<li class="d-flex justify-content-center align-items-center">\
                            <div class="p-2 me-2" style="background-color: ' + seatTypeColor[i] + '"></div>\
                            <h6 class="fs-6 m-0">' + seatTypeName[i] + '</h6>\
                        </li>';                
            }

            html += '<li class="d-flex justify-content-center align-items-center">\
                        <div class="p-2 me-2 pick-seat"></div>\
                        <h6 class="fs-6 m-0">Selected Seat</h6>\
                    </li>';

            $("#seatShowCaseWrapper").html(html);
        }

        function printSeatMap()
        {
            var html = '';
            var seatRow = airplaneLists[index].MAX_ROW;
            var seatColumn = airplaneLists[index].MAX_COLUMN;

            for (var i = 1; i <= seatRow; i++) 
            {
                html += '<div class="seatRow d-flex justify-content-center">';

                for (var j = 0; j < seatColumn; j++) 
                {
                    var alphabet = String.fromCharCode(65 + j);
                    var isSet = seatMap.find(e => e.X == i && e.Y == (j+1));

                    if(isSet)
                    {
                        html += '<div class="seats border px-3 py-2 m-1 rounded" id="seat' + i + (j+1) + '" data-x="' + i + '" data-y="' + (j+1) + '" name="seat" style="background-color: ' + isSet.COLOR + '">' + alphabet + i + '</div>';
                    }
                    else
                    {
                        html += '<div class="seats border px-3 py-2 m-1 rounded" id="seat' + i + (j+1) + '" data-x="' + i + '" data-y="' + (j+1) + '" name="seat">' + alphabet + i + '</div>';                
                    }
                }
                
                html += '</div>';
            }

            $("#seatWrapper").html(html);

            $("div[name='seat']").on("click", function()
            {
                row = $(this).data("x");
                column = $(this).data("y");
                var isSet = seatMap.find(e => e.X == row && e.Y == column);

                if($("#seat" + row + column).hasClass("pick-seat"))
                {
                    var indexToDelete = selectedSeat.findIndex(e => e.x == row && e.y == column);
                    selectedSeat.splice(indexToDelete, 1);
                    console.log('kurang', selectedSeat);
                }
                else
                {
                    var data = {
                        x: row,
                        y: column
                    }
                    selectedSeat.push(data);
                    // console.log('nambah', selectedSeat);
                }
                

                if(selectedSeat.length == 0)
                {
                    $("#btnEditSelectedSeat").attr("hidden", true);
                }else
                {
                    $("#btnEditSelectedSeat").attr("hidden", false);
                }

                $("#seat" + row + column).toggleClass("pick-seat");
            });
        }

        function printAirplane()
        {
            var html = '';

            for (var i = 0; i < airplaneLists.length; i++) {
                html += '<tr align="center">\
                            <td>' + airplaneLists[i].NAME + '</td>\
                            <td>' + airplaneLists[i].AIRPLANE_BRAND + '</td>\
                            <td>' + airplaneLists[i].AIRPLANE_MODEL + '</td>\
                            <td>' + airplaneLists[i].REGISTRATION_NUMBER + '</td>\
                            <td>' + airplaneLists[i].COLOR + '</td>\
                            <td>' + airplaneLists[i].SEAT_TYPE_NAME + '</td>\
                            <td>' + airplaneLists[i].MAX_ROW * airplaneLists[i].MAX_COLUMN + '</td>\
                            <td><button class="btn btn-secondary text-nowrap" type="button" id="btnEditSeat' + i + '" name="btnEditSeat" data-index="' + i + '"><?= Yii::t('app', 'Edit Seat') ?></button></td>\
                            <td><button class="btn btn-warning" type="button" id="btnEdit' + i + '" name="btnEdit" data-index="' + i + '"><?= Yii::t('app', 'Edit') ?></button></td>\
                            <td><button class="btn btn-danger" type="button" id="btnDelete' + i + '" name="btnDelete" data-index="' + i + '"><?= Yii::t('app', 'Delete') ?></button></td>\
                        </tr>';
            }

            $("#airplaneTable tbody").html(html);

            $("#airplaneTable").DataTable({
                "aaSorting": [],
                "paging": false,
                "info": false,
                "oLanguage": {
                    "sSearch": "<?= Yii::t('app', 'Search') ?>"
                },
                "columnDefs": [{
                                targets: [4, 7, 8, 9],
                                orderable: false
                            }],
                dom:"<'myfilter'f><'mylength'l>t",
            });

            $("#airplaneTable button[name='btnEditSeat']").on("click", function()
            {
                index = $(this).data("index");
                $("#btnEditSelectedSeat").attr("hidden", true);
                selectedSeat = [];

                $.ajax
                ({
                    type: 'POST',
                    data: {
                        airplaneId: airplaneLists[index].ID
                    },
                    dataType: 'JSON',
                    url: '<?= Yii::$app->getUrlManager()->createUrl('airplane/get-seat') ?>',
                    success: function(seatMapResult)
                    {   
                        seatMap = seatMapResult[0];
                        // console.log(seatMapResult);
                        
                        var seatTypeName = airplaneLists[index].SEAT_TYPE_NAME.split(', ');
                        var seatTypeId = airplaneLists[index].SEAT_TYPE_ID.split(', ');
                        var seatTypeColor = airplaneLists[index].SEAT_TYPE_COLOR.split(', ');

                        printSeatShowCase(seatTypeName, seatTypeColor)
                        printSeatMap();
                        printSetSeatType(seatTypeName, seatTypeId);

                        $("#seatMapModal").modal("show");
                    }
                });
                
            });

            $("#airplaneTable button[name='btnEdit']").on("click", function()
            {
                index = $(this).data("index");
                var seatTypeName = airplaneLists[index].SEAT_TYPE_NAME.split(', ');
                var seatTypeId = airplaneLists[index].SEAT_TYPE_ID.split(', ');
                var maxSeat = airplaneLists[index].MAX_ROW * airplaneLists[index].MAX_COLUMN;

                $("#editAirplaneForm").trigger("reset");
                $('#inputEditName').attr('value', airplaneLists[index].NAME);
                $('#inputEditBrand').attr('value', airplaneLists[index].AIRPLANE_BRAND);
                $('#inputEditModel').attr('value', airplaneLists[index].AIRPLANE_MODEL);
                $('#inputEditRegis').attr('value', airplaneLists[index].REGISTRATION_NUMBER);
                $('#inputEditColor').attr('value', airplaneLists[index].COLOR);
                document.querySelector('#inputEditSeatType').setValue(seatTypeId);
                $('#inputEditColumn').attr('value', airplaneLists[index].MAX_COLUMN);
                $('#inputEditRow').attr('value', airplaneLists[index].MAX_ROW);
                $("#nameEditAlert, #brandEditAlert, #modelEditAlert, #regisEditAlert, #colorEditAlert, #seatTypeEditAlert, #rowEditAlert, #columnEditAlert, #maxEditSeat").html("");
                $("#maxEditSeat").html(maxSeat);
                $("#editAirplaneModal").modal("show");
            });

            $("#airplaneTable button[name='btnDelete']").on("click", function()
            {
                index = $(this).data("index");

                $("#deleteAirplaneConfModal").modal("show");
            });
        }

        if(sessionId)
        {
            $("#navbarUserNow #navbarDarkDropdownMenuLink").html(sessionFirstName);
            $("#navbarUserNow").attr("hidden", false);
            $("#navbarAdmin").attr("hidden", false);
            $("#navbarSetup").attr("hidden", false);
            $("#navbarBook").attr("hidden", false);
            $("#navbarReport").attr("hidden", false);
        }

        printSeatType();
        printAirplane();

        VirtualSelect.init({
            ele: '#inputSeatType'
        }); 

        VirtualSelect.init({
            ele: '#inputEditSeatType'
        }); 

        $("#addAirplane").on("click", function()
        {
            $("#addAirplaneForm").trigger("reset");
            $("#nameAlert, #brandAlert, #modelAlert, #regisAlert, #colorAlert, #seatTypeAlert, #rowAlert, #columnAlert, #maxSeat").html("");
            $("#addAirplaneModal").modal("show");
        });

        $("#btnAddConfAirplane").on("click", function()
        {
            var flag = 0;

            flag += valName($("#inputName").val());
            flag += valBrand($("#inputBrand").val());
            flag += valModel($("#inputModel").val());
            flag += valRegis($("#inputRegis").val());
            flag += valColor($("#inputColor").val());
            flag += valSeatType($("#inputSeatType").val());
            flag += valColumn($("#inputColumn").val());
            flag += valRow($("#inputRow").val());

            if(flag == 0)
            {
                $("#addAirplaneModal").modal("hide");
                $("#addConfAirplaneModal").modal("show");
            }
        });

        $("#inputRow, #inputColumn").on("input", function()
        {
            $(this).val(function(_, value) {
                return value.replace(/^\+/, '');
            });

            $(this).val(function(_, value) {
                return value.replace(/^\-/, '');
            });

            $(this).val(function(_, value) {
                return value.replace(/[eE]/g, '');
            });

            var maxSeats = $("#inputRow").val() * $("#inputColumn").val();
            
            $("#maxSeat").html(maxSeats);
        });
        
        $("#inputEditRow, #inputEditColumn").on("input", function()
        {
            $(this).val(function(_, value) {
                return value.replace(/^\+/, '');
            });

            $(this).val(function(_, value) {
                return value.replace(/^\-/, '');
            });

            $(this).val(function(_, value) {
                return value.replace(/[eE]/g, '');
            });

            var maxSeats = $("#inputEditRow").val() * $("#inputEditColumn").val();
            
            $("#maxEditSeat").html(maxSeats);
        });

        $("#btnCancelAddAirplane, #btnCloseAddAirplane").on("click", function()
        {
            $("#addConfAirplaneModal").modal("hide");
            $("#addAirplaneModal").modal("show");
        });

        $("#addAirplaneForm").on("submit", function(event)
        {
            event.preventDefault();

            var data = {
                name: $("#inputName").val().toLowerCase(),
                brand: $("#inputBrand").val(),
                model: $("#inputModel").val(),
                regis: $("#inputRegis").val().toUpperCase(),
                color: $("#inputColor").val(),
                seatType: $("#inputSeatType").val(),
                column: $("#inputColumn").val(),
                row: $("#inputRow").val(),
                sessionId: sessionId,
            }

            $.ajax
            ({
                type: 'POST',
                data: data,
                dataType: 'JSON',
                url: '<?= Yii::$app->getUrlManager()->createUrl('airplane/add') ?>',
                success: function(addAirplaneResult)
                {
                    console.log(addAirplaneResult);
                    if(addAirplaneResult[0].errNum == 0)
                    {
                        airplaneLists = addAirplaneResult[1];
                        $('#airplaneTable').DataTable().destroy();
                        printAirplane();
                        alert("<?= Yii::t('app', 'Add Airplane Success!') ?>");
                        $("#addConfAirplaneModal").modal("hide");
                        $("#airplaneForm").trigger("reset");
                    }
                    else
                    {
                        alert(addAirplaneResult[0].errStr);
                        $("#addConfAirplaneModal").modal("hide");
                        $("#addAirplaneModal").modal("show");
                        return;
                    }
                }
            });
        });

        $("#btnEditConfAirplane").on("click", function()
        {
            var flag = 0;

            flag += valEditName($("#inputEditName").val());
            flag += valEditBrand($("#inputEditBrand").val());
            flag += valEditModel($("#inputEditModel").val());
            flag += valEditRegis($("#inputEditRegis").val());
            flag += valEditColor($("#inputEditColor").val());
            flag += valEditSeatType($("#inputEditSeatType").val());
            flag += valEditColumn($("#inputEditColumn").val());
            flag += valEditRow($("#inputEditRow").val());

            if(flag == 0)
            {
                $("#editAirplaneModal").modal("hide");
                $("#editConfAirplaneModal").modal("show");
            }
            
        });

        $("#btnCancelEditAirplane, #btnCloseEditAirplane").on("click", function()
        {
            $("#editConfAirplaneModal").modal("hide");
            $("#editAirplaneModal").modal("show");
        });

        $("#editAirplaneForm").on("submit", function(event)
        {
            event.preventDefault();

            var data = {
                id: airplaneLists[index].ID,
                name: $("#inputEditName").val().toLowerCase(),
                brand: $("#inputEditBrand").val(),
                model: $("#inputEditModel").val(),
                regis: $("#inputEditRegis").val(),
                color: $("#inputEditColor").val(),
                seatType: $("#inputEditSeatType").val(),
                row: $("#inputEditRow").val(),
                column: $("#inputEditColumn").val(),
                sessionId: sessionId
            }

            $.ajax
            ({
                type: 'POST',
                data: data,
                dataType: 'JSON',
                url: '<?= Yii::$app->getUrlManager()->createUrl('airplane/update') ?>',
                success: function(updateAirplaneResult)
                {
                    console.log(updateAirplaneResult);
                    if(updateAirplaneResult[0].errNum == 0 && updateAirplaneResult[2].errNum == 0)
                    {
                        airplaneLists = updateAirplaneResult[1];
                        $('#airplaneTable').DataTable().destroy();
                        printAirplane();
                        alert("<?= Yii::t('app', 'Update Airplane Success!') ?>");
                        $("#editConfAirplaneModal").modal("hide");
                        $("#editAirplaneForm").trigger("reset");
                    }
                    else
                    {
                        alert(updateAirplaneResult[0].errStr);
                        $("#editConfAirplaneModal").modal("hide");
                        $("#editAirplaneModal").modal("show");
                        return;
                    }
                }
            });
        });

        $("#btnCancelSetSeatModal, #btnCloseSetSeatModal").on("click", function()
        {
            $("#seatMapConfModal").modal("hide");
            $("#seatMapModal").modal("show");
        });

        $("#inputSetSeatStatus").on("change", function()
        {
            var status = $("#inputSetSeatStatus").val();
            if(status == 'disable')
            {
                $("#inputSetSeatTypeWrapper").attr("hidden", true);
            }
            else
            {
                $("#inputSetSeatTypeWrapper").attr("hidden", false);
            }
            
        });

        $("#btnEditSelectedSeat").on("click", function()
        {
            $("#inputSetSeatStatus").val("disable").change();
            $("#seatMapModal").modal("hide");
            $("#setSeatModal").modal("show");
        });

        $("#setSeatForm").on("submit", function(event)
        {
            event.preventDefault();

            var flag = 0;

            flag += valSetSeatStatus($("#inputSetSeatStatus").val());
            if($("#inputSetSeatStatus").val() != 'disable')
            {
                flag += valSetSeatType($("#inputSetSeatType").val());
            }
            
            if(flag == 0)
            {

                var data = {
                    airplaneId: airplaneLists[index].ID,
                    selectedSeat: selectedSeat,
                    seatStatus: $("#inputSetSeatStatus").val(),
                    seatTypeId: $("#inputSetSeatType").val(),
                    sessionId: sessionId,
                }

                // console.log(data);

                $.ajax
                ({
                    type: 'POST',
                    data: data,
                    dataType: 'JSON',
                    url: '<?= Yii::$app->getUrlManager()->createUrl('airplane/set-seat') ?>',
                    success: function(setSeatResult)
                    {   
                        // console.log(setSeatResult[0]);
                        if(setSeatResult[0].errNum == 0)
                        {
                            seatMap = setSeatResult[2];
                            alert("<?= Yii::t('app', 'Set seat success!') ?>");
                            selectedSeat = [];
                            printSeatMap();
                            $("#setSeatModal").modal("hide");
                            $("#seatMapModal").modal("show");
                        }
                        else
                        {
                            alert(setSeatResult[0].errStr);
                            $("#setSeatModal").modal("hide");
                            $("#seatMapModal").modal("show");
                        }
                    }
                });
            }

        });

        $("#btnDeleteConfModal").on("click", function()
        {
            var data = {
                airplaneId: airplaneLists[index].ID,
                sessionId: sessionId
            }

            console.log(data);

            $.ajax
            ({
                type: 'POST',
                data: data,
                dataType: 'JSON',
                url: '<?= Yii::$app->getUrlManager()->createUrl('airplane/delete') ?>',
                success: function(deleteAirplaneResult)
                {
                    if(deleteAirplaneResult[0].errNum == 0)
                    {
                        airplaneLists = deleteAirplaneResult[1];
                        $('#airplaneTable').DataTable().destroy();
                        printAirplane();
                        alert("<?= Yii::t('app', 'Delete airplane success!') ?>");
                        $("#deleteAirplaneConfModal").modal("hide");
                    }
                    else
                    {
                        alert(deleteAirplaneResult[0].errStr);
                        $("#deleteAirplaneConfModal").modal("hide");
                    }
                },
            });
        });

        $("#btnSelectAllSeat").on("click", function()
        {
            selectedSeat = [];

            for (var i = 1; i <= airplaneLists[index].MAX_ROW; i++) {
                for (var j = 1; j <= airplaneLists[index].MAX_COLUMN; j++) {
                    var data = {
                        x: i,
                        y: j
                    }
                    selectedSeat.push(data);
                }
            }

            printSeatMap();
            $("div[name='seat']").addClass("pick-seat");
            $("#btnEditSelectedSeat").attr("hidden", false);
            console.log(selectedSeat);
        });

        $("#btnUnselectAllSeat").on("click", function()
        {
            selectedSeat = [];
            printSeatMap();
            $("#btnEditSelectedSeat").attr("hidden", true);
        });

    });

</script>