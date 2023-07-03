<div class="container mt-4 mb-2">
    <div class="text-end mb-2">
        <button class="btn btn-primary shadow-btn" type="button" id="addFlight">+ <?= Yii::t('app', 'Add Flight') ?></button>
    </div>
</div>

<div class="container py-3 overflow-auto">

    <table class="table table-bordered" id="flightTable">
        <thead>
            <tr valign="middle" align="center">
                <th scope="col" class="text-nowrap text-center"><?= Yii::t('app', 'Flight Origin') ?></th>
                <th scope="col" class="text-nowrap text-center"><?= Yii::t('app', 'Flight Destination') ?></th>
                <th scope="col" class="text-nowrap text-center"><?= Yii::t('app', 'Transit') ?></th>
                <th scope="col" class="text-nowrap text-center"><?= Yii::t('app', 'Departure') ?></th>
                <th scope="col" class="text-nowrap text-center"><?= Yii::t('app', 'Arrival') ?></th>
                <th scope="col" class="text-nowrap text-center"><?= Yii::t('app', 'Duration') ?></th>
                <th scope="col"></th>
                <th scope="col"></th>
                <th scope="col"></th>
                <th scope="col"></th>
            </tr>
        </thead>
        <tbody>

        </tbody>
    </table>

    <!-- start of add flight modal -->
    <form id="flightForm">
        <div class="modal" tabindex="-1" id="addFlightModal">
            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title"><?= Yii::t('app', 'Add Flight') ?></h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-2">
                            <label for=""><?= Yii::t('app', 'Airplane') ?><span class=" text-alert text-danger">*</span></label>
                            <select class="form-select" id="inputAirplane">
                                
                            </select>
                            <span class=" text-alert text-danger" id="airplaneAlert"></span>
                        </div>
                        <div class="mb-2">
                            <label for=""><?= Yii::t('app', 'Flight Origin') ?><span class=" text-alert text-danger">*</span></label>
                            <input type="text" class="form-control" id="inputOrigin" placeholder="<?= Yii::t('app', 'Origin') ?>">
                            <span class="text-alert text-danger" id="originAlert"></span>
                        </div>
                        <div class="mb-2">
                            <label for=""><?= Yii::t('app', 'Flight Destination') ?><span class=" text-alert text-danger">*</span></label>
                            <input type="text" class="form-control" id="inputDestination" placeholder="<?= Yii::t('app', 'Flight Destination') ?>">
                            <span class="text-alert text-danger" id="destinationAlert"></span>
                        </div>
                        <div class="mb-2">
                            <label for=""><?= Yii::t('app', 'Departure Date & Time') ?><span class=" text-alert text-danger">*</span></label>
                            <input type="text" class="form-control" id="inputDeparture" placeholder="<?= Yii::t('app', 'Departure Date & Time') ?>">
                            <span class="text-alert text-danger" id="departureAlert"></span>
                        </div>
                        <div class="mb-2">
                            <label for=""><?= Yii::t('app', 'Arrival Date & Time') ?><span class=" text-alert text-danger">*</span></label>
                            <input type="text" class="form-control" id="inputArrival" placeholder="<?= Yii::t('app', 'Arrival Date & Time') ?>">
                            <span class="text-alert text-danger" id="arrivalAlert"></span>
                        </div>
                        <div class="mb-2">
                            <label for=""><?= Yii::t('app', 'Available Baggage') ?><span> (KG)</span><span class=" text-alert text-danger">*</span></label>
                            <input type="number" class="form-control" id="inputBaggage" placeholder="<?= Yii::t('app', 'Available Baggage') ?>">
                            <span class="text-alert text-danger" id="baggageAlert"></span>
                        </div>
                        <div class="mb-2">
                            <label for=""><?= Yii::t('app', 'Adult Price') ?><span class=" text-alert text-danger">*</span></label>
                            <input type="number" class="form-control" id="inputAdult" placeholder="<?= Yii::t('app', 'Adult Price') ?>">
                            <span class="text-alert text-danger" id="adultAlert"></span>
                        </div>
                        <div class="mb-2">
                            <label for=""><?= Yii::t('app', 'Child Price') ?><span class=" text-alert text-danger">*</span></label>
                            <input type="number" class="form-control" id="inputChild" placeholder="<?= Yii::t('app', 'Child Price') ?>">
                            <span class="text-alert text-danger" id="childAlert"></span>
                        </div>
                        <div class="mb-2">
                            <label for=""><?= Yii::t('app', 'Baggage Price') ?><span class=" text-alert text-danger">*</span></label>
                            <input type="number" class="form-control" id="inputBaggagePrice" placeholder="<?= Yii::t('app', 'Baggage Price') ?>">
                            <span class="text-alert text-danger" id="baggagePriceAlert"></span>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><?= Yii::t('app', 'Close') ?></button>
                        <button type="button" class="btn btn-primary" id="btnAddFlightConfModal"><?= Yii::t('app', 'Save') ?></button>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal" tabindex="-1" id="addFlightConfModal">
            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title"><?= Yii::t('app', 'Confirmation') ?></h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" id="closeAddFlightConfModal"></button>
                    </div>
                    <div class="modal-body">
                        <?= Yii::t('app', 'Are you sure you want to add flight?') ?>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" id="cancelAddFlightConfModal"><?= Yii::t('app', 'Cancel') ?></button>
                        <button type="submit" class="btn btn-primary"><?= Yii::t('app', 'Add') ?></button>
                    </div>
                </div>
            </div>
        </div>
    </form>
    <!-- end of add flight modal -->

    <!-- start of edit flight modal -->
    <form id="editFlightForm">
        <div class="modal" tabindex="-1" id="editFlightModal">
            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title"><?= Yii::t('app', 'Edit Flight') ?></h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-2">
                            <label for=""><?= Yii::t('app', 'Airplane') ?><span class=" text-alert text-danger">*</span></label>
                            <select class="form-select" id="inputEditAirplane" disabled>
                                
                            </select>
                            <span class=" text-alert text-danger" id="airplaneEditAlert"></span>
                        </div>
                        <div class="mb-2">
                            <label for=""><?= Yii::t('app', 'Flight Origin') ?><span class=" text-alert text-danger">*</span></label>
                            <input type="text" class="form-control" id="inputEditOrigin" placeholder="<?= Yii::t('app', 'Origin') ?>">
                            <span class="text-alert text-danger" id="originEditAlert"></span>
                        </div>
                        <div class="mb-2">
                            <label for=""><?= Yii::t('app', 'Flight Destination') ?><span class=" text-alert text-danger">*</span></label>
                            <input type="text" class="form-control" id="inputEditDestination" placeholder="<?= Yii::t('app', 'Flight Destination') ?>">
                            <span class="text-alert text-danger" id="destinationEditAlert"></span>
                        </div>
                        <div class="mb-2">
                            <label for=""><?= Yii::t('app', 'Departure Date & Time') ?><span class=" text-alert text-danger">*</span></label>
                            <input type="text" class="form-control" id="inputEditDeparture" placeholder="<?= Yii::t('app', 'Departure Date & Time') ?>">
                            <span class="text-alert text-danger" id="departureEditAlert"></span>
                        </div>
                        <div class="mb-2">
                            <label for=""><?= Yii::t('app', 'Arrival Date & Time') ?><span class=" text-alert text-danger">*</span></label>
                            <input type="text" class="form-control" id="inputEditArrival" placeholder="<?= Yii::t('app', 'Arrival Date & Time') ?>">
                            <span class="text-alert text-danger" id="arrivalEditAlert"></span>
                        </div>
                        <div class="mb-2">
                            <label for=""><?= Yii::t('app', 'Available Baggage') ?><span> (KG)</span><span class=" text-alert text-danger">*</span></label>
                            <input type="number" class="form-control" id="inputEditBaggage" placeholder="<?= Yii::t('app', 'Available Baggage') ?>">
                            <span class="text-alert text-danger" id="baggageEditAlert"></span>
                        </div>
                        <div class="mb-2">
                            <label for=""><?= Yii::t('app', 'Adult Price') ?><span class=" text-alert text-danger">*</span></label>
                            <input type="number" class="form-control" id="inputEditAdult" placeholder="<?= Yii::t('app', 'Adult Price') ?>">
                            <span class="text-alert text-danger" id="adultEditAlert"></span>
                        </div>
                        <div class="mb-2">
                            <label for=""><?= Yii::t('app', 'Child Price') ?><span class=" text-alert text-danger">*</span></label>
                            <input type="number" class="form-control" id="inputEditChild" placeholder="<?= Yii::t('app', 'Child Price') ?>">
                            <span class="text-alert text-danger" id="childEditAlert"></span>
                        </div>
                        <div class="mb-2">
                            <label for=""><?= Yii::t('app', 'Baggage Price') ?><span class=" text-alert text-danger">*</span></label>
                            <input type="number" class="form-control" id="inputEditBaggagePrice" placeholder="<?= Yii::t('app', 'Baggage Price') ?>">
                            <span class="text-alert text-danger" id="baggagePriceEditAlert"></span>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><?= Yii::t('app', 'Close') ?></button>
                        <button type="button" class="btn btn-primary" id="btnEditFlightConfModal"><?= Yii::t('app', 'Edit') ?></button>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal" tabindex="-1" id="editFlightConfModal">
            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title"><?= Yii::t('app', 'Confirmation') ?></h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" id="closeEditFlightConfModal"></button>
                    </div>
                    <div class="modal-body">
                        <?= Yii::t('app', 'Are you sure you want to edit flight?') ?>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" id="cancelEditFlightConfModal"><?= Yii::t('app', 'Cancel') ?></button>
                        <button type="submit" class="btn btn-primary"><?= Yii::t('app', 'Edit') ?></button>
                    </div>
                </div>
            </div>
        </div>
    </form>
    <!-- end of edit flight modal -->

    <!-- start of add transit -->
    <form id="addTransitForm">
        <div class="modal" tabindex="-1" id="addTransitModal">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title"><?= Yii::t('app', 'Add Transit') ?><span class=" text-alert text-danger">*</span></h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-2">
                            <label for=""><?= Yii::t('app', 'Transit Destination') ?><span class=" text-alert text-danger">*</span></label>
                            <input type="text" class="form-control" id="inputTransDestination" placeholder="<?= Yii::t('app', 'Transit Destination') ?>">
                            <span class="text-alert text-danger" id="transDestinationAlert"></span>
                        </div>
                        <div class="mb-2">
                            <label for=""><?= Yii::t('app', 'Arrival Date & Time') ?><span class=" text-alert text-danger">*</span></label>
                            <input type="text" class="form-control" id="inputTransArrival" placeholder="<?= Yii::t('app', 'Arrival Date & Time') ?>">
                            <span class="text-alert text-danger" id="transArrivalAlert"></span>
                        </div>
                        <div class="mb-2">
                            <label for=""><?= Yii::t('app', 'Departure Date & Time') ?><span class=" text-alert text-danger">*</span></label>
                            <input type="text" class="form-control" id="inputTransDeparture" placeholder="<?= Yii::t('app', 'Departure Date & Time') ?>">
                            <span class="text-alert text-danger" id="transDepartureAlert"></span>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><?= Yii::t('app', 'Close') ?></button>
                        <button type="button" class="btn btn-primary" id="btnAddTransitConfModal"><?= Yii::t('app', 'Add') ?></button>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal" tabindex="-1" id="addTransitConfModal">
            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title"><?= Yii::t('app', 'Confirmation') ?></h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" id="closeAddTransitConfModal"></button>
                    </div>
                    <div class="modal-body">
                        <?= Yii::t('app', 'Are you sure you want to add transit?') ?>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" id="cancelAddTransitConfModal"><?= Yii::t('app', 'Cancel') ?></button>
                        <button type="submit" class="btn btn-primary"><?= Yii::t('app', 'Edit') ?></button>
                    </div>
                </div>
            </div>
        </div>
    </form>
    <!-- end of add transit -->

    <!-- delete flights modal -->
    <div class="modal" tabindex="-1" id="deleteFlightModal">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"><?= Yii::t('app', 'Confirmation') ?></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <?= Yii::t('app', 'Are you sure you want to delete flight?') ?>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><?= Yii::t('app', 'Cancel') ?></button>
                    <button type="submit" class="btn btn-primary" id="btnDeleteFlight"><?= Yii::t('app', 'Delete') ?></button>
                </div>
            </div>
        </div>
    </div>
    <!-- delete flights modal -->

    <!-- detail flights modal -->
    <div class="modal" tabindex="-1" id="detailFlightModal">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"><?= Yii::t('app', 'Detail') ?></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><?= Yii::t('app', 'Cancel') ?></button>
                </div>
            </div>
        </div>
    </div>
    <!-- detail flights modal -->

    <!-- edit transit modal -->
    <form id="editTransitForm">
        <div class="modal" tabindex="-1" id="editTransitModal">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title"><?= Yii::t('app', 'Edit Transit') ?></h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" id="closeEditTransitModal"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-2">
                            <label for=""><?= Yii::t('app', 'Transit Destination') ?><span class=" text-alert text-danger">*</span></label>
                            <input type="text" class="form-control" id="inputEditTransDestination" placeholder="<?= Yii::t('app', 'Transit Destination') ?>">
                            <span class="text-alert text-danger" id="transEditDestinationAlert"></span>
                        </div>
                        <div class="mb-2">
                            <label for=""><?= Yii::t('app', 'Arrival Date & Time') ?><span class=" text-alert text-danger">*</span></label>
                            <input type="text" class="form-control" id="inputEditTransArrival" placeholder="<?= Yii::t('app', 'Arrival Date & Time') ?>">
                            <span class="text-alert text-danger" id="transEditArrivalAlert"></span>
                        </div>
                        <div class="mb-2">
                            <label for=""><?= Yii::t('app', 'Departure Date & Time') ?><span class=" text-alert text-danger">*</span></label>
                            <input type="text" class="form-control" id="inputEditTransDeparture" placeholder="<?= Yii::t('app', 'Departure Date & Time') ?>">
                            <span class="text-alert text-danger" id="transEditDepartureAlert"></span>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" id="cancelEditTransitModal"><?= Yii::t('app', 'Cancel') ?></button>
                        <button type="button" class="btn btn-primary" id="btnEditTransitConfModal"><?= Yii::t('app', 'Edit') ?></button>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal" tabindex="-1" id="editTransitConfModal">
            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title"><?= Yii::t('app', 'Confirmation') ?></h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" id="closeEditTransitConfModal"></button>
                    </div>
                    <div class="modal-body">
                        <?= Yii::t('app', 'Are you sure you want to edit transit?') ?>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" id="cancelEditTransitConfModal"><?= Yii::t('app', 'Cancel') ?></button>
                        <button type="submit" class="btn btn-primary"><?= Yii::t('app', 'Edit') ?></button>
                    </div>
                </div>
            </div>
        </div>
    </form>
    <!-- edit transit modal -->

    <!-- delete Transits modal -->
    <div class="modal" tabindex="-1" id="deleteTransitModal">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"><?= Yii::t('app', 'Confirmation') ?></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" id="closeDeleteTransitConfModal"></button>
                </div>
                <div class="modal-body">
                    <?= Yii::t('app', 'Are you sure you want to delete transit?') ?>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" id="cancelDeleteTransitConfModal"><?= Yii::t('app', 'Cancel') ?></button>
                    <button type="submit" class="btn btn-primary" id="btnDeleteTransit"><?= Yii::t('app', 'Delete') ?></button>
                </div>
            </div>
        </div>
    </div>
    <!-- delete transit modal -->

</div>

<script>

    $(function()
    {

        var sessionId = <?= $sessionId ?>;
        var sessionFirstName = <?= $sessionFirstName ?>;
        var flightLists = <?= $flightLists ?>;
        var availableAirplaneLists = <?= $availableAirplaneLists ?>;
        var transitLists = [];
        var index;
        var transitIndex;

        console.log(flightLists);
        console.log('airplane avb', availableAirplaneLists);

        if(sessionId)
        {
            $("#navbarUserNow #navbarDarkDropdownMenuLink").html(sessionFirstName);
            $("#navbarUserNow").attr("hidden", false);
            $("#navbarAdmin").attr("hidden", false);
            $("#navbarSetup").attr("hidden", false);
            $("#navbarBook").attr("hidden", false);
            $("#navbarReport").attr("hidden", false);
        }

        //daterangepicker setting for departure and arrival
        $('#inputArrival').daterangepicker({
            autoUpdateInput: false,
            singleDatePicker: true,
            timePicker: true,
            timePicker24Hour: true,
            minDate: moment(),
            locale: {
                format: 'DD-MM-YYYY H:mm',
                cancelLabel: 'Clear'
            }
        });

        $('#inputArrival').on('apply.daterangepicker', function(ev, picker) {
            $(this).val(picker.startDate.format('DD-MM-YYYY H:mm'));
        });

        $('#inputArrival').on('cancel.daterangepicker', function(ev, picker) {
            $(this).val('');
        });

        $('#inputDeparture').daterangepicker({
            autoUpdateInput: false,
            singleDatePicker: true,
            timePicker: true,
            timePicker24Hour: true,
            minDate: moment(),
            locale: {
                format: 'DD-MM-YYYY H:mm',
                cancelLabel: 'Clear'
            }
        });

        $('#inputDeparture').on('apply.daterangepicker', function(ev, picker) {
            $(this).val(picker.startDate.format('DD-MM-YYYY H:mm'));
            $("#inputArrival").val("");
            $('#inputArrival').daterangepicker({
                autoUpdateInput: false,
                singleDatePicker: true,
                timePicker: true,
                timePicker24Hour: true,
                minDate: moment(picker.startDate).add(30, 'minutes').format('DD-MM-YYYY H:mm'),
                locale: {
                    format: 'DD-MM-YYYY H:mm',
                    cancelLabel: 'Clear'
                }
            });

            $('#inputArrival').on('apply.daterangepicker', function(ev, picker) {
                $(this).val(picker.startDate.format('DD-MM-YYYY H:mm'));
            });

            $('#inputArrival').on('cancel.daterangepicker', function(ev, picker) {
                $(this).val('');
            });
        });

        $('#inputDeparture').on('cancel.daterangepicker', function(ev, picker) {
            $(this).val('');
        });
        //daterangepicker setting for departure and arrival

        function valAirplane(plane)
        {
            if(!plane)
            {
                $("#airplaneAlert").html("<?= Yii::t('app', 'Airplane cannot be empty!') ?>");
                return 1;
            }

            $("#airplaneAlert").html("");
            return 0;
        }

        function valOrigin(origin)
        {
            if(!origin)
            {
                $("#originAlert").html("<?= Yii::t('app', 'Flight origin cannot be empty!') ?>");
                return 1;
            }

            $("#originAlert").html("");
            return 0;
        }

        function valDestination(destination)
        {
            if(!destination)
            {
                $("#destinationAlert").html("<?= Yii::t('app', 'Destination cannot be empty!') ?>");
                return 1;
            }

            $("#destinationAlert").html("");
            return 0;
        }
        
        function valDeparture(departure)
        {
            if(!departure)
            {
                $("#departureAlert").html("<?= Yii::t('app', 'Departure date & time cannot be empty!') ?>");
                return 1;
            }

            $("#departureAlert").html("");
            return 0;
        }

        function valArrival(arrival)
        {
            if(!arrival)
            {
                $("#arrivalAlert").html("<?= Yii::t('app', 'Arrival date & time cannot be empty!') ?>");
                return 1;
            }

            if(arrival == 'Invalid date')
            {
                $("#arrivalAlert").html("<?= Yii::t('app', 'Arrival date & time is not valid!') ?>");
                return 1;
            }

            $("#arrivalAlert").html("");
            return 0;
        }

        function valBaggage(baggage)
        {
            if(!baggage)
            {
                $("#baggageAlert").html("<?= Yii::t('app', 'Availabel Baggage cannot be empty!') ?>");
                return 1;
            }

            $("#baggageAlert").html("");
            return 0;
        }

        function valAdult(adult)
        {
            if(!adult)
            {
                $("#adultAlert").html("<?= Yii::t('app', 'Adult price cannot be empty!') ?>");
                return 1;
            }

            $("#adultAlert").html("");
            return 0;
        }

        function valChild(child)
        {
            if(!child)
            {
                $("#childAlert").html("<?= Yii::t('app', 'Child price cannot be empty!') ?>");
                return 1;
            }

            $("#childAlert").html("");
            return 0;
        }

        function valBaggagePrice(baggagePrice)
        {
            if(!baggagePrice)
            {
                $("#baggagePriceAlert").html("<?= Yii::t('app', 'Baggage price cannot be empty!') ?>");
                return 1;
            }

            $("#baggagePriceAlert").html("");
            return 0;
        }

        function valEditAirplane(plane)
        {
            if(!plane)
            {
                $("#airplaneEditAlert").html("<?= Yii::t('app', 'Airplane cannot be empty!') ?>");
                return 1;
            }

            $("#airplaneEditAlert").html("");
            return 0;
        }

        function valEditOrigin(origin)
        {
            if(!origin)
            {
                $("#originEditAlert").html("<?= Yii::t('app', 'Flight origin cannot be empty!') ?>");
                return 1;
            }

            $("#originEditAlert").html("");
            return 0;
        }

        function valEditDestination(destination)
        {
            if(!destination)
            {
                $("#destinationEditAlert").html("<?= Yii::t('app', 'Destination cannot be empty!') ?>");
                return 1;
            }

            $("#destinationEditAlert").html("");
            return 0;
        }
        
        function valEditDeparture(departure)
        {
            if(!departure)
            {
                $("#departureEditAlert").html("<?= Yii::t('app', 'Departure date & time cannot be empty!') ?>");
                return 1;
            }

            $("#departureEditAlert").html("");
            return 0;
        }

        function valEditArrival(arrival)
        {
            if(!arrival)
            {
                $("#arrivalEditAlert").html("<?= Yii::t('app', 'Arrival date & time cannot be empty!') ?>");
                return 1;
            }

            if(arrival == 'Invalid date')
            {
                $("#arrivalEditAlert").html("<?= Yii::t('app', 'Arrival date & time is not valid!') ?>");
                return 1;
            }

            $("#arrivalEditAlert").html("");
            return 0;
        }

        function valEditBaggage(baggage)
        {
            if(!baggage)
            {
                $("#baggageEditAlert").html("<?= Yii::t('app', 'Availabel Baggage cannot be empty!') ?>");
                return 1;
            }

            $("#baggageEditAlert").html("");
            return 0;
        }

        function valEditAdult(adult)
        {
            if(!adult)
            {
                $("#adultEditAlert").html("<?= Yii::t('app', 'Adult price cannot be empty!') ?>");
                return 1;
            }

            $("#adultEditAlert").html("");
            return 0;
        }

        function valEditChild(child)
        {
            if(!child)
            {
                $("#childEditAlert").html("<?= Yii::t('app', 'Child price cannot be empty!') ?>");
                return 1;
            }

            $("#childEditAlert").html("");
            return 0;
        }

        function valEditBaggagePrice(baggagePrice)
        {
            if(!baggagePrice)
            {
                $("#baggagePriceEditAlert").html("<?= Yii::t('app', 'Baggage price cannot be empty!') ?>");
                return 1;
            }

            $("#baggagePriceEditAlert").html("");
            return 0;
        }

        function countDuration(startTime, endTime)
        {
            var duration = moment.duration(endTime.diff(startTime));
            var hours = parseInt(duration.asHours());
            var minutes = parseInt(duration.asMinutes()) % 60;

            return hours.toString().padStart(2, "0") + ':' + minutes.toString().padStart(2, "0");
        }

        function valTransDestination(destination)
        {
            if(!destination)
            {
                $("#transDestinationAlert").html("<?= Yii::t('app', 'Destination cannot be empty!') ?>");
                return 1;
            }

            $("#transDestinationAlert").html("");
            return 0;
        }
        
        function valTransDeparture(departure)
        {
            if(!departure)
            {
                $("#transDepartureAlert").html("<?= Yii::t('app', 'Departure date & time cannot be empty!') ?>");
                return 1;
            }

            if(departure == 'Invalid date')
            {
                $("#transDepartureAlert").html("<?= Yii::t('app', 'Departure date & time is not valid!') ?>");
                return 1;
            }

            $("#transDepartureAlert").html("");
            return 0;
        }

        function valTransArrival(arrival)
        {
            if(!arrival)
            {
                $("#transArrivalAlert").html("<?= Yii::t('app', 'Arrival date & time cannot be empty!') ?>");
                return 1;
            }

            $("#transArrivalAlert").html("");
            return 0;
        }

        function valEditTransDestination(destination)
        {
            if(!destination)
            {
                $("#transEditDestinationAlert").html("<?= Yii::t('app', 'Destination cannot be empty!') ?>");
                return 1;
            }

            $("#transEditDestinationAlert").html("");
            return 0;
        }
        
        function valEditTransDeparture(departure)
        {
            if(!departure)
            {
                $("#transEditDepartureAlert").html("<?= Yii::t('app', 'Departure date & time cannot be empty!') ?>");
                return 1;
            }

            if(departure == 'Invalid date')
            {
                $("#transEditDepartureAlert").html("<?= Yii::t('app', 'Departure date & time is not valid!') ?>");
                return 1;
            }

            $("#transEditDepartureAlert").html("");
            return 0;
        }

        function valEditTransArrival(arrival)
        {
            if(!arrival)
            {
                $("#transEditArrivalAlert").html("<?= Yii::t('app', 'Arrival date & time cannot be empty!') ?>");
                return 1;
            }

            $("#transEditArrivalAlert").html("");
            return 0;
        }

        function printAvailableAirplane()
        {
            var html = '<option value="" selected>-- Select An Airplane --</option>';

            for (var i = 0; i < availableAirplaneLists.length; i++) {
                html += '<option value="' + availableAirplaneLists[i].ID + '">' + availableAirplaneLists[i].NAME + '</option>';
            }

            $("#inputAirplane").html(html);
            $("#inputEditAirplane").html(html);
        }

        function checkFlight(departure, i)
        {
            if(moment() < moment(departure, 'DD-MM-YYYY H:mm'))
            {
                return '<td><button type="button" class="btn btn-primary text-nowrap" name="btnAddTransit" id="btnAddTransit' + i + '" data-index="' + i +'"><?= Yii::t('app', 'Add Transit') ?></button></td>\
                        <td><button type="button" class="btn btn-secondary" name="btnDetail" id="btnDetail' + i + '" data-index="' + i +'"><?= Yii::t('app', 'Detail') ?></button></td>\
                        <td><button type="button" class="btn btn-warning" name="btnEdit" id="btnEdit' + i + '" data-index="' + i +'"><?= Yii::t('app', 'Edit') ?></button></td>\
                        <td><button type="button" class="btn btn-danger" name="btnDelete" id="btnDelete' + i + '" data-index="' + i +'"><?= Yii::t('app', 'Delete') ?></button></td>';
            }

            return '<td></td>\
                    <td><button type="button" class="btn btn-secondary" name="btnDetail" id="btnDetail' + i + '" data-index="' + i +'"><?= Yii::t('app', 'Detail') ?></button></td>\
                    <td></td>\
                    <td><button type="button" class="btn btn-danger" name="btnDelete" id="btnDelete' + i + '" data-index="' + i +'"><?= Yii::t('app', 'Delete') ?></td>';
        }

        function printFlightTransit(departure)
        {
            var html = '';

            if(!transitLists.length)
            {
                return html;
            }

            for (var i = 0; i < transitLists.length; i++) {

                var button = '';

                if(moment() < moment(departure, 'DD-MM-YYYY H:mm'))
                {
                    button = '<div class="col-6 my-1">\
                                <button type="button" class="btn btn-warning" name="btnEdit" id="btnEdit' + i + '" data-index="' + i +'"><?= Yii::t('app', 'Edit') ?>\
                            </div>\
                            <div class="col-6 my-1">\
                                <button type="button" class="btn btn-danger" name="btnDelete" id="btnDelete' + i + '" data-index="' + i +'"><?= Yii::t('app', 'Delete') ?>\
                            </div>';
                }

                html += '<div class="row mb-2 border border-info rounded" id="transitWrapper' + i +'" data-index="' + i + '">\
                            <div class="col-6">\
                                Transit ' + (i+1) + '\
                            </div>\
                            <div class="col-6">\
                                ' + transitLists[i].DESTINATION + '\
                            </div>\
                            <div class="col-6">\
                                <?= Yii::t('app', 'Arrival') ?>\
                            </div>\
                            <div class="col-6">\
                                ' + transitLists[i].ARRIVAL_TIME + '\
                            </div>\
                            <div class="col-6">\
                                <?= Yii::t('app', 'Departure') ?>\
                            </div>\
                            <div class="col-6">\
                                ' + transitLists[i].DEPARTURE_TIME + '\
                            </div>\
                            ' + button + '\
                        </div>';
            }    

            return html;
        }

        function printFlightDetail()
        {
            var html = '<div class="container">\
                        <div class="row mb-1">\
                            <div class="col-6">\
                                <?= Yii::t('app', 'Airplane') ?>\
                            </div>\
                            <div class="col-6" id="airplaneNameData">\
                                ' + flightLists[index].AIRPLANE_NAME + '\
                            </div>\
                        </div>\
                        <div class="row mb-2">\
                            <div class="col-6">\
                                <?= Yii::t('app', 'Origin') ?> - <?= Yii::t('app', 'Destination') ?>\
                            </div>\
                            <div class="col-6">\
                            ' + flightLists[index].ORIGIN + ' - ' + flightLists[index].DESTINATION + '\
                            </div>\
                            <div class="col-6">\
                                <?= Yii::t('app', 'Departure') ?>\
                            </div>\
                            <div class="col-6">\
                            ' + flightLists[index].DEPARTURE_TIME + '\
                            </div>\
                            <div class="col-6">\
                                <?= Yii::t('app', 'Arrival') ?>\
                            </div>\
                            <div class="col-6">\
                            ' + flightLists[index].ARRIVAL_TIME + '\
                            </div>\
                            <div class="col-6">\
                                <?= Yii::t('app', 'Duration') ?>\
                            </div>\
                            <div class="col-6">\
                            ' + flightLists[index].DURATION_TIME + '\
                            </div>\
                        </div>\
                        ' + printFlightTransit(flightLists[index].DEPARTURE_TIME) + '\
                        <div class="row mb-2" id="baggageWrapper">\
                            <div class="col-6">\
                                <?= Yii::t('app', 'Available Baggage') ?>\
                            </div>\
                            <div class="col-6">\
                            ' + flightLists[index].AVAILABLE_BAGGAGE + ' KG\
                            </div>\
                        </div>\
                        <div class="row mb-2" id="priceWrapper">\
                            <div class="col-6">\
                                <?= Yii::t('app', 'Adult Price') ?>\
                            </div>\
                            <div class="col-6">\
                                RP. ' + flightLists[index].ADULT_PRICE + '\
                            </div>\
                            <div class="col-6">\
                                <?= Yii::t('app', 'Child Price') ?>\
                            </div>\
                            <div class="col-6">\
                                RP. ' + flightLists[index].CHILD_PRICE + '\
                            </div>\
                            <div class="col-6">\
                                <?= Yii::t('app', 'Baggage Price') ?>\
                            </div>\
                            <div class="col-6">\
                                RP. ' + flightLists[index].BAGGAGE_PRICE + '\
                            </div>\
                        </div>\
                    </div>';

            return html;
        }

        function printFlight()
        {
            $.fn.dataTable.moment( 'DD-MM-YYYY H:mm' );
            var html = '';

            for (var i = 0; i < flightLists.length; i++) {
                html += '<tr align="center">\
                            <td>' + flightLists[i].ORIGIN + '</td>\
                            <td>' + flightLists[i].DESTINATION + '</td>\
                            <td>' + flightLists[i].TOTAL_TRANSIT + '</td>\
                            <td>' + flightLists[i].DEPARTURE_TIME + '</td>\
                            <td>' + flightLists[i].ARRIVAL_TIME + '</td>\
                            <td>' + flightLists[i].DURATION_TIME + '</td>\
                            ' + checkFlight(flightLists[i].DEPARTURE_TIME, i) + '\
                        </tr>';
            }

            $("#flightTable tbody").html(html);

            $("#flightTable").DataTable({
                "aaSorting": [],
                "paging": false,
                "info": false,
                "oLanguage": {
                    "sSearch": "<?= Yii::t('app', 'Search') ?>"
                },  
                "columnDefs": [{
                                targets: [6, 7, 8, 9],
                                orderable: false
                            }],
                dom:"<'myfilter'f><'mylength'l>t",
            });

            $("#flightTable button[name='btnEdit']").on("click", function()
            {
                index = $(this).data("index");
                
                $("#editFligthForm").trigger("reset");
                $("#airplaneEditAlert, #originEditAlert, #destinationEditAlert, #departureEditAlert, #arrivalEditAlert, #baggageEditAlert, #adultEditAlert, #childEditAlert, #baggagePriceEditAlert").html("");
                printAvailableAirplane();

                // start of edit date range picker setting 
                $('#inputEditArrival').daterangepicker({
                    autoUpdateInput: false,
                    startDate: moment(flightLists[index].ARRIVAL_TIME, 'DD-MM-YYYY H:mm'),
                    singleDatePicker: true,
                    timePicker: true,
                    timePicker24Hour: true,
                    minDate: moment(flightLists[index].DEPARTURE_TIME, 'DD-MM-YYYY H:mm').add(30, 'minutes'),
                    locale: {
                        format: 'DD-MM-YYYY H:mm',
                        cancelLabel: 'Clear'
                    }
                });

                $('#inputEditArrival').on('apply.daterangepicker', function(ev, picker) {
                    $(this).val(picker.startDate.format('DD-MM-YYYY H:mm'));
                });

                $('#inputEditArrival').on('cancel.daterangepicker', function(ev, picker) {
                    $(this).val('');
                });

                $('#inputEditArrival').val(flightLists[index].ARRIVAL_TIME);
                $('#inputEditDeparture').val(flightLists[index].DEPARTURE_TIME);

                $('#inputEditDeparture').daterangepicker({
                    autoUpdateInput: false,
                    startDate: moment(flightLists[index].DEPARTURE_TIME, 'DD-MM-YYYY H:mm'),
                    singleDatePicker: true,
                    timePicker: true,
                    timePicker24Hour: true,
                    minDate: moment(),
                    locale: {
                        format: 'DD-MM-YYYY H:mm',
                        cancelLabel: 'Clear'
                    }
                });

                $('#inputEditDeparture').on('apply.daterangepicker', function(ev, picker) {
                    $(this).val(picker.startDate.format('DD-MM-YYYY H:mm'));
                    $("#inputEditArrival").val("");
                    $('#inputEditArrival').daterangepicker({
                        autoUpdateInput: false,
                        singleDatePicker: true,
                        timePicker: true,
                        timePicker24Hour: true,
                        minDate: moment(picker.startDate).add(30, 'minutes').format('DD-MM-YYYY H:mm'),
                        locale: {
                            format: 'DD-MM-YYYY H:mm',
                            cancelLabel: 'Clear'
                        }
                    });

                    $('#inputEditArrival').on('apply.daterangepicker', function(ev, picker) {
                        $(this).val(picker.startDate.format('DD-MM-YYYY H:mm'));
                    });

                    $('#inputEditArrival').on('cancel.daterangepicker', function(ev, picker) {
                        $(this).val('');
                    });
                });

                $('#inputEditDeparture').on('cancel.daterangepicker', function(ev, picker) {
                    $(this).val('');
                });
                // start of edit date range picker setting 

                $("#inputEditAirplane").val(flightLists[index].AIRPLANE_ID);
                $("#inputEditOrigin").val(flightLists[index].ORIGIN);
                $("#inputEditDestination").val(flightLists[index].DESTINATION);
                $("#inputEditBaggage").val(flightLists[index].AVAILABLE_BAGGAGE);
                $("#inputEditAdult").val(flightLists[index].ADULT_PRICE);
                $("#inputEditChild").val(flightLists[index].CHILD_PRICE);
                $("#inputEditBaggagePrice").val(flightLists[index].BAGGAGE_PRICE);

                $("#editFlightModal").modal("show");
            });

            $("#flightTable button[name='btnAddTransit']").on("click", function()
            {
                index = $(this).data("index");

                $("#addTransitForm").trigger("reset");
                $("#transDestinationAlert, #transArrivalAlert, #transDepartureAlert").html("");

                $('#inputTransArrival').daterangepicker({
                    autoUpdateInput: false,
                    singleDatePicker: true,
                    timePicker: true,
                    timePicker24Hour: true,
                    minDate: moment(flightLists[index].DEPARTURE_TIME, 'DD-MM-YYYY H:mm').add(30, 'minutes'),
                    maxDate: moment(flightLists[index].ARRIVAL_TIME, 'DD-MM-YYYY H:mm').subtract(30, 'minutes'),
                    locale: {
                        format: 'DD-MM-YYYY H:mm',
                        cancelLabel: 'Clear'
                    }
                });

                $('#inputTransArrival').on('apply.daterangepicker', function(ev, picker) {
                    $(this).val(picker.startDate.format('DD-MM-YYYY H:mm'));
                    $("#inputTransDeparture").val("");
                    $('#inputTransDeparture').daterangepicker({
                        autoUpdateInput: false,
                        singleDatePicker: true,
                        timePicker: true,
                        timePicker24Hour: true,
                        minDate: moment(picker.startDate).add(30, 'minutes').format('DD-MM-YYYY H:mm'),
                        maxDate: moment(flightLists[index].ARRIVAL_TIME, 'DD-MM-YYYY H:mm').subtract(30, 'minutes'),
                        drops: 'up',
                        locale: {
                            format: 'DD-MM-YYYY H:mm',
                            cancelLabel: 'Clear'
                        }
                    });

                    $('#inputTransDeparture').on('apply.daterangepicker', function(ev, picker) {
                        $(this).val(picker.startDate.format('DD-MM-YYYY H:mm'));
                    });

                    $('#inputTransDeparture').on('cancel.daterangepicker', function(ev, picker) {
                        $(this).val('');
                    });

                });

                $('#inputTransArrival').on('cancel.daterangepicker', function(ev, picker) {
                    $(this).val('');
                });

                $('#inputTransDeparture').daterangepicker({
                    autoUpdateInput: false,
                    singleDatePicker: true,
                    timePicker: true,
                    timePicker24Hour: true,
                    minDate: moment(flightLists[index].DEPARTURE_TIME, 'DD-MM-YYYY H:mm').add(30, 'minutes'),
                    maxDate: moment(flightLists[index].ARRIVAL_TIME, 'DD-MM-YYYY H:mm').subtract(30, 'minutes'),
                    drops: 'up',
                    locale: {
                        format: 'DD-MM-YYYY H:mm',
                        cancelLabel: 'Clear'
                    }
                });

                $('#inputTransDeparture').on('apply.daterangepicker', function(ev, picker) {
                    $(this).val(picker.startDate.format('DD-MM-YYYY H:mm'));
                });

                $('#inputTransDeparture').on('cancel.daterangepicker', function(ev, picker) {
                    $(this).val('');
                });

                $("#addTransitModal").modal("show");
            });

            $("#flightTable button[name='btnDelete']").on("click", function()
            {
                index = $(this).data("index");

                $("#deleteFlightModal").modal("show");
            });

            $("#flightTable button[name='btnDetail']").on("click", function()
            {
                index = $(this).data("index");

                $.ajax
                ({
                    type: 'POST',
                    data: {
                        flightId: flightLists[index].ID
                    },
                    dataType: 'JSON',
                    url: '<?= Yii::$app->getUrlManager()->createUrl('flight/get-transit') ?>',
                    success: function(getTransitResult)
                    {
                        transitLists = getTransitResult[0]; 
                        var html = printFlightDetail();
                        $("#detailFlightModal .modal-body").html(html);

                        $("#detailFlightModal button[name='btnEdit']").on("click", function()
                        {
                            transitIndex = $(this).data("index");
                            $("#editTransitForm").trigger("reset");
                            $("#transEditDestinationAlert, #transEditArrivalAlert, #transEditDepartureAlert").html("");

                            $("#inputEditTransDestination").val(transitLists[transitIndex].DESTINATION);
                            $("#inputEditTransArrival").val(transitLists[transitIndex].ARRIVAL_TIME);
                            $("#inputEditTransDeparture").val(transitLists[transitIndex].DEPARTURE_TIME);

                            $('#inputEditTransArrival').daterangepicker({
                                autoUpdateInput: false,
                                startDate: moment(transitLists[transitIndex].ARRIVAL_TIME, 'DD-MM-YYYY H:mm'),
                                singleDatePicker: true,
                                timePicker: true,
                                timePicker24Hour: true,
                                minDate: moment(flightLists[index].DEPARTURE_TIME, 'DD-MM-YYYY H:mm').add(30, 'minutes'),
                                maxDate: moment(flightLists[index].ARRIVAL_TIME, 'DD-MM-YYYY H:mm').subtract(30, 'minutes'),
                                locale: {
                                    format: 'DD-MM-YYYY H:mm',
                                    cancelLabel: 'Clear'
                                }
                            });

                            $('#inputEditTransArrival').on('apply.daterangepicker', function(ev, picker) {
                                $(this).val(picker.startDate.format('DD-MM-YYYY H:mm'));
                                $("#inputEditTransDeparture").val("");
                                $('#inputEditTransDeparture').daterangepicker({
                                    autoUpdateInput: false,
                                    singleDatePicker: true,
                                    timePicker: true,
                                    timePicker24Hour: true,
                                    minDate: moment(picker.startDate).add(30, 'minutes').format('DD-MM-YYYY H:mm'),
                                    maxDate: moment(flightLists[index].ARRIVAL_TIME, 'DD-MM-YYYY H:mm').subtract(30, 'minutes'),
                                    drops: 'up',
                                    locale: {
                                        format: 'DD-MM-YYYY H:mm',
                                        cancelLabel: 'Clear'
                                    }
                                });

                                $('#inputEditTransDeparture').on('apply.daterangepicker', function(ev, picker) {
                                    $(this).val(picker.startDate.format('DD-MM-YYYY H:mm'));
                                });

                                $('#inputEditTransDeparture').on('cancel.daterangepicker', function(ev, picker) {
                                    $(this).val('');
                                });

                            });

                            $('#inputEditTransArrival').on('cancel.daterangepicker', function(ev, picker) {
                                $(this).val('');
                            });

                            $('#inputEditTransDeparture').daterangepicker({
                                autoUpdateInput: false,
                                startDate: moment(transitLists[transitIndex].DEPARTURE_TIME, 'DD-MM-YYYY H:mm'),
                                singleDatePicker: true,
                                timePicker: true,
                                timePicker24Hour: true,
                                minDate: moment(flightLists[index].DEPARTURE_TIME, 'DD-MM-YYYY H:mm').add(30, 'minutes'),
                                maxDate: moment(flightLists[index].ARRIVAL_TIME, 'DD-MM-YYYY H:mm').subtract(30, 'minutes'),
                                drops: 'up',
                                locale: {
                                    format: 'DD-MM-YYYY H:mm',
                                    cancelLabel: 'Clear'
                                }
                            });

                            $('#inputEditTransDeparture').on('apply.daterangepicker', function(ev, picker) {
                                $(this).val(picker.startDate.format('DD-MM-YYYY H:mm'));
                            });

                            $('#inputEditTransDeparture').on('cancel.daterangepicker', function(ev, picker) {
                                $(this).val('');
                            });

                            $("#detailFlightModal").modal("hide");
                            $("#editTransitModal").modal("show");
                        });

                        $("#detailFlightModal button[name='btnDelete']").on("click", function()
                        {
                            transitIndex = $(this).data("index");

                            $("#detailFlightModal").modal("hide");
                            $("#deleteTransitModal").modal("show");
                        });

                        $("#detailFlightModal").modal("show");
                    }
                });

            });

        }
        
        printFlight();

        $("#addFlight").on("click", function()
        {
            $("#flightForm").trigger("reset");
            $("#airplaneAlert, #originAlert, #destinationAlert, #departureAlert, #arrivalAlert, #baggageAlert, #adultAlert, #childAlert, #baggagePriceAlert").html("");
            
            $('#inputDeparture').daterangepicker({
                autoUpdateInput: false,
                singleDatePicker: true,
                timePicker: true,
                timePicker24Hour: true,
                minDate: moment(),
                locale: {
                    format: 'DD-MM-YYYY H:mm',
                    cancelLabel: 'Clear'
                }
            });

            $('#inputDeparture').on('apply.daterangepicker', function(ev, picker) {
                $(this).val(picker.startDate.format('DD-MM-YYYY H:mm'));
                $("#inputArrival").val("");
                $('#inputArrival').daterangepicker({
                    autoUpdateInput: false,
                    singleDatePicker: true,
                    timePicker: true,
                    timePicker24Hour: true,
                    minDate: moment(picker.startDate).add(30, 'minutes').format('DD-MM-YYYY H:mm'),
                    locale: {
                        format: 'DD-MM-YYYY H:mm',
                        cancelLabel: 'Clear'
                    }
                });

                $('#inputArrival').on('apply.daterangepicker', function(ev, picker) {
                    $(this).val(picker.startDate.format('DD-MM-YYYY H:mm'));
                });

                $('#inputArrival').on('cancel.daterangepicker', function(ev, picker) {
                    $(this).val('');
                });
            });

            $('#inputDeparture').on('cancel.daterangepicker', function(ev, picker) {
                $(this).val('');
            });
            
            printAvailableAirplane();
            $("#addFlightModal").modal("show");
        });

        $('#inputDeparture, #inputArrival, #inputEditDeparture, #inputEditArrival, #inputTransArrival, #inputTransDeparture, #inputEditTransArrival, #inputEditTransDeparture').on("input", function()
        {
            $(this).val("");
        });

        $("#inputBaggage, #inputAdult, #inputChild, #inputBaggagePrice").on("input", function()
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
        });

        $("#btnAddFlightConfModal").on("click", function()
        {
            var flag = 0;

            flag += valAirplane($("#inputAirplane").val());
            flag += valOrigin($("#inputOrigin").val());
            flag += valDestination($("#inputDestination").val());
            flag += valDeparture($("#inputDeparture").val());
            flag += valArrival($("#inputArrival").val());
            flag += valBaggage($("#inputBaggage").val());
            flag += valAdult($("#inputAdult").val());
            flag += valChild($("#inputChild").val());
            flag += valBaggagePrice($("#inputBaggagePrice").val());

            if(flag == 0)
            {
                $("#addFlightModal").modal("hide");
                $("#addFlightConfModal").modal("show");
            } 
        })

        $("#cancelAddFlightConfModal, #closeAddFlightConfModal").on("click", function()
        {
            $("#addFlightConfModal").modal("hide");
            $("#addFlightModal").modal("show");
        });

        $("#flightForm").on("submit", function(event)
        {
            event.preventDefault();
            var startTime = moment($("#inputDeparture").val(), 'DD-MM-YYYY H:mm');
            var endTime = moment($("#inputArrival").val(), 'DD-MM-YYYY H:mm');

            var duration = countDuration(startTime, endTime);

            var data = {
                airplaneId: $("#inputAirplane").val(),
                origin: $("#inputOrigin").val().toUpperCase(),
                destination: $("#inputDestination").val().toUpperCase(),
                departure: $("#inputDeparture").val(),
                arrival: $("#inputArrival").val(),
                duration: duration,
                baggage: $("#inputBaggage").val(),
                adult: $("#inputAdult").val(),
                child: $("#inputChild").val(),
                baggagePrice: $("#inputBaggagePrice").val(),
                sessionId: sessionId,
            }

            $.ajax
            ({
                type: 'POST',
                data: data,
                dataType: 'JSON',
                url: '<?= Yii::$app->getUrlManager()->createUrl('flight/add') ?>',
                success: function(addFlightResult)
                {
                    console.log(addFlightResult);
                    if(addFlightResult[0].errNum == 0)
                    {
                        flightLists = addFlightResult[1];
                        $('#flightTable').DataTable().destroy();
                        printFlight();
                        alert("<?= Yii::t('app', 'Add flight success!') ?>");
                        $("#addFlightConfModal").modal("hide");
                        $("#addFlightModal").modal("hide");
                    }
                    else
                    {
                        alert(addFlightResult[0].errStr);
                        $("#addFlightConfModal").modal("hide");
                        $("#addFlightModal").modal("show");
                    }
                },
            });
        });

        $("#btnEditFlightConfModal").on("click", function()
        {
            var flag = 0;

            flag += valEditAirplane($("#inputEditAirplane").val());
            flag += valEditOrigin($("#inputEditOrigin").val());
            flag += valEditDestination($("#inputEditDestination").val());
            flag += valEditDeparture($("#inputEditDeparture").val());
            flag += valEditArrival($("#inputEditArrival").val());
            flag += valEditBaggage($("#inputEditBaggage").val());
            flag += valEditAdult($("#inputEditAdult").val());
            flag += valEditChild($("#inputEditChild").val());
            flag += valEditBaggagePrice($("#inputEditBaggagePrice").val());

            if(flag == 0)
            {
                $("#editFlightModal").modal("hide");
                $("#editFlightConfModal").modal("show");
            } 
        })

        $("#cancelEditFlightConfModal, #closeEditFlightConfModal").on("click", function()
        {
            $("#editFlightConfModal").modal("hide");
            $("#editFlightModal").modal("show");
        });

        $("#editFlightForm").on("submit", function(event)
        {
            event.preventDefault();
            var startTime = moment($("#inputEditDeparture").val(), 'DD-MM-YYYY H:mm');
            var endTime = moment($("#inputEditArrival").val(), 'DD-MM-YYYY H:mm');

            var duration = countDuration(startTime, endTime); 

            var data = {
                id: flightLists[index].ID,
                airplaneId: $("#inputEditAirplane").val(),
                origin: $("#inputEditOrigin").val().toUpperCase(),
                destination: $("#inputEditDestination").val().toUpperCase(),
                departure: $("#inputEditDeparture").val(),
                arrival: $("#inputEditArrival").val(),
                duration: duration,
                baggage: $("#inputEditBaggage").val(),
                adult: $("#inputEditAdult").val(),
                child: $("#inputEditChild").val(),
                baggagePrice: $("#inputEditBaggagePrice").val(),
                sessionId: sessionId,
            }

            console.log(data);
            $.ajax
            ({
                type: 'POST',
                data: data,
                dataType: 'JSON',
                url: '<?= Yii::$app->getUrlManager()->createUrl('flight/update') ?>',
                success: function(updateFlightResult)
                {
                    console.log(updateFlightResult);
                    if(updateFlightResult[0].errNum == 0)
                    {
                        flightLists = updateFlightResult[1];
                        $('#flightTable').DataTable().destroy();
                        printFlight();
                        alert("<?= Yii::t('app', 'Update flight success!') ?>");
                        $("#editFlightConfModal").modal("hide");
                        $("#editFlightModal").modal("hide");
                    }
                    else
                    {
                        alert(updateFlightResult[0].errStr);
                        $("#editFlightConfModal").modal("hide");
                        $("#editFlightModal").modal("show");
                    }
                },
            });
        });

        $("#btnAddTransitConfModal").on("click", function()
        {
            var flag = 0;

            flag += valTransDestination($("#inputTransDestination").val());
            flag += valTransArrival($("#inputTransArrival").val());
            flag += valTransDeparture($("#inputTransDeparture").val());

            if(flag == 0)
            {
                $("#addTransitModal").modal("hide");
                $("#addTransitConfModal").modal("show");
            }
        });

        $("#cancelAddTransitConfModal, #closeAddTransitConfModal").on("click", function()
        {
            $("#addTransitConfModal").modal("hide");
            $("#addTransitModal").modal("show");
        });

        $("#addTransitForm").on("submit", function(event)
        {
            event.preventDefault();

            var data = {
                id: flightLists[index].ID,
                destination: $("#inputTransDestination").val().toUpperCase(),
                arrival: $("#inputTransArrival").val(),
                departure: $("#inputTransDeparture").val(),
                sessionId: sessionId,
            }

            $.ajax
            ({
                type: 'POST',
                data: data,
                dataType: 'JSON',
                url: '<?= Yii::$app->getUrlManager()->createUrl('flight/add-transit') ?>',
                success: function(addTransitResult)
                {
                    console.log(addTransitResult);
                    if(addTransitResult[0].errNum == 0)
                    {
                        flightLists = addTransitResult[1];
                        $('#flightTable').DataTable().destroy();
                        printFlight();
                        alert("<?= Yii::t('app', 'Add transit success!') ?>");
                        $("#addTransitConfModal").modal("hide");
                        $("#addTransitModal").modal("hide");
                    }
                    else
                    {
                        alert(addTransitResult[0].errStr);
                        $("#addTransitConfModal").modal("hide");
                        $("#addTransitModal").modal("show");
                    }
                },
            });
        });

        $("#btnDeleteFlight").on("click", function()
        {
            var data = {
                flightId: flightLists[index].ID,
                sessionId: sessionId
            }

            $.ajax
            ({
                type: 'POST',
                data: data,
                dataType: 'JSON',
                url: '<?= Yii::$app->getUrlManager()->createUrl('flight/delete') ?>',
                success: function(deleteFlightResult)
                {
                    console.log(deleteFlightResult);
                    if(deleteFlightResult[0].errNum == 0)
                    {
                        flightLists = deleteFlightResult[1];
                        printFlight();
                        alert("<?= Yii::t('app', 'Delete flight success!') ?>");
                        $("#deleteFlightModal").modal("hide");
                    }
                    else
                    {
                        alert(deleteFlightResult[0].errStr);
                        $("#deleteFlightModal").modal("hide");
                    }
                },
            });
        });

        $("#cancelEditTransitModal, #closeEditTransitModal").on("click", function()
        {
            $("#editTransitModal").modal("hide");
            $("#detailFlightModal").modal("show");
        });

        $("#btnEditTransitConfModal").on("click", function()
        {
            var flag = 0;

            flag += valEditTransDestination($("#inputEditTransDestination").val());
            flag += valEditTransArrival($("#inputEditTransArrival").val());
            flag += valEditTransDeparture($("#inputEditTransDeparture").val());

            if(flag == 0)
            {
                $("#editTransitModal").modal("hide");
                $("#editTransitConfModal").modal("show");
            }
        });

        $("#cancelEditTransitConfModal, #closeEditTransitConfModal").on("click", function()
        {
            $("#editTransitConfModal").modal("hide");
            $("#editTransitModal").modal("show");
        });

        $("#editTransitForm").on("submit", function(event)
        {
            event.preventDefault();

            var data = {
                flightId: flightLists[index].ID,
                transitId: transitLists[transitIndex].ID,
                destination: $("#inputEditTransDestination").val().toUpperCase(),
                arrival: $("#inputEditTransArrival").val(),
                departure: $("#inputEditTransDeparture").val(),
                sessionId: sessionId
            }

            console.log(data);
            $.ajax
            ({
                type: 'POST',
                data: data,
                dataType: 'JSON',
                url: '<?= Yii::$app->getUrlManager()->createUrl('flight/update-transit') ?>',
                success: function(updateTransitResult)
                {
                    console.log(updateTransitResult);
                    if(updateTransitResult[0].errNum == 0)
                    {
                        flightLists = updateTransitResult[1];
                        $('#flightTable').DataTable().destroy();
                        printFlight();
                        alert("<?= Yii::t('app', 'Edit transit success!') ?>");
                        $("#editTransitConfModal").modal("hide");
                        $("#editTransitModal").modal("hide");
                    }
                    else
                    {
                        alert(updateTransitResult[0].errStr);
                        $("#editTransitConfModal").modal("hide");
                        $("#editTransitModal").modal("show");
                    }
                },
            });
        });

        $("#closeDeleteTransitConfModal, #cancelDeleteTransitConfModal").on("click", function()
        {
            $("#deleteTransitConfModal").modal("hide");
            $("#detailFlightModal").modal("show");
        });

        $("#btnDeleteTransit").on("click", function()
        {
            console.log(transitLists[transitIndex]);

            var data = {
                flightId: flightLists[index].ID,
                transitId: transitLists[transitIndex].ID,
                sessionId: sessionId
            }

            $.ajax
            ({
                type: 'POST',
                data: data,
                dataType: 'JSON',
                url: '<?= Yii::$app->getUrlManager()->createUrl('flight/delete-transit') ?>',
                success: function(deleteTransitResult)
                {
                    console.log(deleteTransitResult);
                    if(deleteTransitResult[0].errNum == 0)
                    {
                        flightLists = deleteTransitResult[1];
                        $('#flightTable').DataTable().destroy();
                        printFlight();

                        transitLists = deleteTransitResult[2]; 
                        var html = printFlightDetail();
                        $("#detailFlightModal .modal-body").html(html);

                        $("#detailFlightModal button[name='btnEdit']").on("click", function()
                        {
                            transitIndex = $(this).data("index");
                            $("#editTransitForm").trigger("reset");
                            $("#transEditDestinationAlert, #transEditArrivalAlert, #transEditDepartureAlert").html("");

                            $("#inputEditTransDestination").val(transitLists[transitIndex].DESTINATION);
                            $("#inputEditTransArrival").val(transitLists[transitIndex].ARRIVAL_TIME);
                            $("#inputEditTransDeparture").val(transitLists[transitIndex].DEPARTURE_TIME);

                            $('#inputEditTransArrival').daterangepicker({
                                autoUpdateInput: false,
                                startDate: moment(transitLists[transitIndex].ARRIVAL_TIME, 'DD-MM-YYYY H:mm'),
                                singleDatePicker: true,
                                timePicker: true,
                                timePicker24Hour: true,
                                minDate: moment(flightLists[index].DEPARTURE_TIME, 'DD-MM-YYYY H:mm').add(30, 'minutes'),
                                maxDate: moment(flightLists[index].ARRIVAL_TIME, 'DD-MM-YYYY H:mm').subtract(30, 'minutes'),
                                locale: {
                                    format: 'DD-MM-YYYY H:mm',
                                    cancelLabel: 'Clear'
                                }
                            });

                            $('#inputEditTransArrival').on('apply.daterangepicker', function(ev, picker) {
                                $(this).val(picker.startDate.format('DD-MM-YYYY H:mm'));
                                $("#inputEditTransDeparture").val("");
                                $('#inputEditTransDeparture').daterangepicker({
                                    autoUpdateInput: false,
                                    singleDatePicker: true,
                                    timePicker: true,
                                    timePicker24Hour: true,
                                    minDate: moment(picker.startDate).add(30, 'minutes').format('DD-MM-YYYY H:mm'),
                                    maxDate: moment(flightLists[index].ARRIVAL_TIME, 'DD-MM-YYYY H:mm').subtract(30, 'minutes'),
                                    drops: 'up',
                                    locale: {
                                        format: 'DD-MM-YYYY H:mm',
                                        cancelLabel: 'Clear'
                                    }
                                });

                                $('#inputEditTransDeparture').on('apply.daterangepicker', function(ev, picker) {
                                    $(this).val(picker.startDate.format('DD-MM-YYYY H:mm'));
                                });

                                $('#inputEditTransDeparture').on('cancel.daterangepicker', function(ev, picker) {
                                    $(this).val('');
                                });

                            });

                            $('#inputEditTransArrival').on('cancel.daterangepicker', function(ev, picker) {
                                $(this).val('');
                            });

                            $('#inputEditTransDeparture').daterangepicker({
                                autoUpdateInput: false,
                                startDate: moment(transitLists[transitIndex].DEPARTURE_TIME, 'DD-MM-YYYY H:mm'),
                                singleDatePicker: true,
                                timePicker: true,
                                timePicker24Hour: true,
                                minDate: moment(flightLists[index].DEPARTURE_TIME, 'DD-MM-YYYY H:mm').add(30, 'minutes'),
                                maxDate: moment(flightLists[index].ARRIVAL_TIME, 'DD-MM-YYYY H:mm').subtract(30, 'minutes'),
                                drops: 'up',
                                locale: {
                                    format: 'DD-MM-YYYY H:mm',
                                    cancelLabel: 'Clear'
                                }
                            });

                            $('#inputEditTransDeparture').on('apply.daterangepicker', function(ev, picker) {
                                $(this).val(picker.startDate.format('DD-MM-YYYY H:mm'));
                            });

                            $('#inputEditTransDeparture').on('cancel.daterangepicker', function(ev, picker) {
                                $(this).val('');
                            });

                            $("#detailFlightModal").modal("hide");
                            $("#editTransitModal").modal("show");
                        });

                        $("#detailFlightModal button[name='btnDelete']").on("click", function()
                        {
                            transitIndex = $(this).data("index");

                            $("#detailFlightModal").modal("hide");
                            $("#deleteTransitModal").modal("show");
                        });

                        alert("<?= Yii::t('app', 'Delete transit success!') ?>");
                        $("#deleteTransitModal").modal("hide");
                        $("#detailFlightModal").modal("show");
                        
                    }
                    else
                    {
                        alert(updateTransitResult[0].errStr);
                        $("#deleteTransitModal").modal("hide");
                        $("#detailFlightModal").modal("show");
                    }
                },
            });
        });

    });

</script>