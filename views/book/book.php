<div class="container py-3 overflow-auto">

    <table class="table table-bordered mt-3" id="availableFlightTable">
        <thead>
            <tr valign="middle" align="center">
                <th scope="col" class="text-nowrap text-center"><?= Yii::t('app', 'Origin') ?></th>
                <th scope="col" class="text-nowrap text-center"><?= Yii::t('app', 'Destination') ?></th>
                <th scope="col" class="text-nowrap text-center"><?= Yii::t('app', 'Transit') ?></th>
                <th scope="col" class="text-nowrap text-center"><?= Yii::t('app', 'Departure') ?></th>
                <th scope="col" class="text-nowrap text-center"><?= Yii::t('app', 'Arrival') ?></th>
                <th scope="col" class="text-nowrap text-center"><?= Yii::t('app', 'Duration') ?></th>
                <th scope="col" class="text-nowrap text-center"><?= Yii::t('app', 'Airplane') ?></th>
                <th scope="col" class="text-nowrap text-center"><?= Yii::t('app', 'Seat Type') ?></th>
                <th scope="col"></th>
                <th scope="col"></th>
            </tr>
        </thead>
        <tbody>
            
        </tbody>
    </table>

    <!-- add book modal -->
    <form id="addBookForm">
        <div class="modal" tabindex="-1" id="addBookModal">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title"><?= Yii::t('app', 'Add Booking') ?></h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" id="closeAddBookModal"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-2" id="bookSeatTypeWrapper">
                            <label for=""><?= Yii::t('app', 'Select Seat Type') ?><span class=" text-alert text-danger">*</span></label>
                            <select class="form-select" id="inputBookSeatType" name="inputPayment">
                            
                            </select>
                            <span class="text-alert text-danger" id="bookSeatTypeAlert"></span>
                        </div>
                        <div class="mb-1" id="seatsLeftWrapper">
                            
                        </div>
                        <div class="mb-2">
                            <label for=""><?= Yii::t('app', 'Adult') ?><span class=" text-alert text-danger">*</span></label>
                            <input type="number" class="form-control" id="inputAdult" placeholder="<?= Yii::t('app', 'Adult') ?>" value="0">
                            <span class="text-alert text-danger" id="adultAlert"></span>
                        </div>
                        <div class="mb-2" id="adultPassangerNameWrapper">
                            
                        </div>
                        <div class="mb-2">
                            <label for=""><?= Yii::t('app', 'Child') ?><span class=" text-alert text-danger">*</span></label>
                            <input type="number" class="form-control" id="inputChild" placeholder="<?= Yii::t('app', 'Child') ?>" value="0">
                            <span class="text-alert text-danger" id="childAlert"></span>
                        </div>
                        <div class="mb-2" id="childPassangerNameWrapper">
                            
                        </div>
                        <div class="mb-2">
                            <label for=""><?= Yii::t('app', 'Additional Baggage') ?> (KG)</label>
                            <input type="text" class="form-control" id="inputBaggage" placeholder="<?= Yii::t('app', 'Additional Baggage') ?>" value="0">
                            <span class="text-alert text-danger" id="baggageAlert"></span>
                        </div>
                        <div class="mb-2">
                            <label for=""><?= Yii::t('app', 'Choose Payment Method') ?><span class=" text-alert text-danger">*</span></label>
                            <select class="form-select" name="inputPayment" id="inputPayment">
                                
                            </select>
                            <span class="text-alert text-danger" id="paymentAlert"></span>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" id="cancelAddBookModal"><?= Yii::t('app', 'Cancel') ?></button>
                        <button type="button" class="btn btn-primary" id="btnAddBookConfModal"><?= Yii::t('app', 'Book') ?></button>
                    </div>
                </div>
            </div>
        </div>

        <!-- airplane map seat modal -->
        <div class="modal" tabindex="-1" id="seatMapModal">
            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"><?= Yii::t('app', 'Seat Map') ?></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" id="closeAddSeatModal"></button>
                </div>
                <div class="modal-body">
                    <div class="container">
                        <ul class="d-flex justify-content-evenly align-items-center m-2 p-0" id="seatShowCaseWrapper">
                            
                        </ul>
                        <div class="cockpit-wrapper text-center py-2">
                            <h6 class="m-0">Cockpit</h6>
                        </div>
                        <div class="container overflow-auto d-grid gap-1 mt-2" id="seatWrapper">
                            
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" id="cancelAddSeatModal"><?= Yii::t('app', 'Close') ?></button>
                    <button type="button" class="btn btn-primary" id="btnAddConfSeat"><?= Yii::t('app', 'Add') ?></button>
                </div>
                </div>
            </div>
        </div>
        <!-- airplane map seat modal -->

        <div class="modal" tabindex="-1" id="addBookConfModal">
            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title"><?= Yii::t('app', 'Confirmation') ?></h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" id="closeAddBookConfModal"></button>
                    </div>
                    <div class="modal-body">
                        <?= Yii::t('app', 'Are you sure you want to book flight?') ?>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" id="cancelAddBookConfModal"><?= Yii::t('app', 'Cancel') ?></button>
                        <button type="submit" class="btn btn-primary"><?= Yii::t('app', 'Add') ?></button>
                    </div>
                </div>
            </div>
        </div>
    </form>
    <!-- add book modal -->

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

    <!-- ticket modal -->
    <div class="modal" tabindex="-1" id="bookDetailModal">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"><?= Yii::t('app', 'Booking Detail') ?></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><?= Yii::t('app', 'Close') ?></button>
                </div>
            </div>
        </div>
    </div>
    <!-- ticket modal -->



</div>

<script>

    $(function()
    {   
        var availableFlightLists = <?= $availableFlightLists ?>;
        var paymentLists = <?= $paymentLists ?>;
        var sessionId = <?= $sessionId ?>;
        var sessionFirstName = <?= $sessionFirstName ?>;
        var transitLists;
        var index;
        var seatMap = [];
        var bookSeat = [];
        var bookedSeat;
        var availableSeat;
        var totalPassanger;
        var countPassanger;

        console.log(availableFlightLists);

        if(sessionId)
        {
            $("#navbarUserNow #navbarDarkDropdownMenuLink").html(sessionFirstName);
            $("#navbarUserNow").attr("hidden", false);
            $("#navbarAdmin").attr("hidden", false);
            $("#navbarSetup").attr("hidden", false);
            $("#navbarBook").attr("hidden", false);
            $("#navbarReport").attr("hidden", false);
        }

        function valBookSeatType(seatType)
        {
            if(!seatType)
            {
                $("#bookSeatTypeAlert").html("<?= Yii::t('app', 'Seat type cannot be empty!') ?>");
                return 1;
            }

            $("#bookSeatTypeAlert").html("");
            return 0;
        }

        function valAdultAndChild(adult, child)
        {
            if(!adult && !child || adult == 0 && child == 0)
            {
                $("#adultAlert").html("<?= Yii::t('app', 'There must be at least 1 adult or children!') ?>");
                $("#childAlert").html("<?= Yii::t('app', 'There must be at least 1 adult or children!') ?>");
                return 1;
            }

            if(adult < 0){
                $("#adultAlert").html("<?= Yii::t('app', 'The number of adult cannot be less than 0!') ?>");
                return 1;
            }

            if(child < 0){
                $("#childAlert").html("<?= Yii::t('app', 'The number of children cannot be less than 0!') ?>");
                return 1;
            }

            $("#adultAlert").html("");
            $("#childAlert").html("");
            return 0;
        }

        function valBaggage(baggage)
        {
            if(baggage < 0)
            {
                $("#baggageAlert").html("<?= Yii::t('app', 'Additional baggage cannot be less than 0!') ?>");
                return 1;
            }

            $("#baggageAlert").html("");
            return 0;
        }

        function valPayment(payment)
        {
            if(!payment)
            {
                $("#paymentAlert").html("<?= Yii::t('app', 'Payment method cannot be empty!') ?>");
                return 1;
            }

            $("#paymentAlert").html("");
            return 0;
        }

        function valAdultPassangerName(adultName, index)
        {
            if(!adultName)
            {
                $("#adultNameAlert" + index).html('<?= Yii::t('app', 'Passanger name cannot be empty!') ?>');
                return 1;
            }

            $("#adultNameAlert" + index).html('');
            return 0;
        }

        function valChildPassangerName(childName, index)
        {
            if(!childName)
            {
                $("#childNameAlert" + index).html('<?= Yii::t('app', 'Passanger name cannot be empty!') ?>');
                return 1;
            }

            $("#childNameAlert" + index).html('');
            return 0;
        }

        function printSeatTypeLists()
        {
            var seatId = availableFlightLists[index].SEAT_TYPE_ID.split(", ");
            var seatName = availableFlightLists[index].SEAT_TYPE_NAME.split(", ");
            var html = '<option disabled selected value><?= Yii::t('app', 'Choose Seat Type') ?></option>';

            for (var i = 0; i < seatId.length; i++) {
                html += '<option value="' + seatId[i] + '">' + seatName[i] + '</option>';
            }

            $("#inputBookSeatType").html(html);
        }

        function printPaymentLists()
        {
            var html = '<option disabled selected value><?= Yii::t('app', 'Choose Payment Method') ?></option>';

            for (var i = 0; i < paymentLists.length; i++) {
                html += '<option value="' + paymentLists[i].ID + '">' + paymentLists[i].NAME + '</option>';
            }

            $("#inputPayment").html(html);
        }

        function printFlightTransit(departure)
        {
            var html = '';

            if(!transitLists.length)
            {
                return html;
            }

            for (var i = 0; i < transitLists.length; i++) {

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
                                ' + availableFlightLists[index].AIRPLANE_NAME + '\
                            </div>\
                        </div>\
                        <div class="row mb-2">\
                            <div class="col-6">\
                                <?= Yii::t('app', 'Origin') ?> - <?= Yii::t('app', 'Destination') ?>\
                            </div>\
                            <div class="col-6">\
                            ' + availableFlightLists[index].ORIGIN + ' - ' +  availableFlightLists[index].DESTINATION + '\
                            </div>\
                            <div class="col-6">\
                                <?= Yii::t('app', 'Departure') ?>\
                            </div>\
                            <div class="col-6">\
                            ' + availableFlightLists[index].DEPARTURE_TIME + '\
                            </div>\
                            <div class="col-6">\
                                <?= Yii::t('app', 'Arrival') ?>\
                            </div>\
                            <div class="col-6">\
                            ' + availableFlightLists[index].ARRIVAL_TIME + '\
                            </div>\
                            <div class="col-6">\
                                <?= Yii::t('app', 'Duration') ?>\
                            </div>\
                            <div class="col-6">\
                            ' + availableFlightLists[index].DURATION_TIME + '\
                            </div>\
                        </div>\
                        ' + printFlightTransit(availableFlightLists[index].DEPARTURE_TIME) + '\
                        <div class="row mb-2" id="baggageWrapper">\
                            <div class="col-6">\
                                <?= Yii::t('app', 'Available Baggage') ?>\
                            </div>\
                            <div class="col-6">\
                            ' + availableFlightLists[index].AVAILABLE_BAGGAGE + ' KG\
                            </div>\
                        </div>\
                        <div class="row mb-2" id="priceWrapper">\
                            <div class="col-6">\
                                <?= Yii::t('app', 'Adult Price') ?>\
                            </div>\
                            <div class="col-6">\
                                RP. ' + availableFlightLists[index].ADULT_PRICE + '\
                            </div>\
                            <div class="col-6">\
                                <?= Yii::t('app', 'Child Price') ?>\
                            </div>\
                            <div class="col-6">\
                                RP. ' + availableFlightLists[index].CHILD_PRICE + '\
                            </div>\
                            <div class="col-6">\
                                <?= Yii::t('app', 'Baggage Price') ?>\
                            </div>\
                            <div class="col-6">\
                                RP. ' + availableFlightLists[index].BAGGAGE_PRICE + '\
                            </div>\
                        </div>\
                    </div>';

            return html;
        }

        function printSeatShowCase()
        {
            var html = '<li class="d-flex justify-content-center align-items-center">\
                            <div class="p-2 me-2 bg-danger"></div>\
                            <h6 class="fs-6 m-0">Unavailable Seats</h6>\
                        </li>\
                        <li class="d-flex justify-content-center align-items-center">\
                            <div class="p-2 me-2 bg-danger booked"></div>\
                            <h6 class="fs-6 m-0">Booked Seats</h6>\
                        </li>\
                        <li class="d-flex justify-content-center align-items-center">\
                            <div class="p-2 me-2 pick-seat"></div>\
                            <h6 class="fs-6 m-0">Selected Seats</h6>\
                        </li>';

            $("#seatShowCaseWrapper").html(html);
        }

        function printSeatLeft()
        {
            var html = '<label>Seats Left: <h6 class="m-0" id="seatsLeft">' + availableSeat + '</h6></label>';

            $("#seatsLeftWrapper").html(html);
        }

        function printAdultNameInput(totalAdult)
        {
            var html = '';

            for (var i = 0; i < totalAdult; i++) 
            {
                html += '<label for=""><?= Yii::t('app', 'Adult Passanger Name') ?>' + (i+1) + '</label>\
                        <input type="text" class="form-control" id="inputAdult' + i + '" placeholder="<?= Yii::t('app', 'Adult Passanger Name') ?>">\
                        <span class="text-alert text-danger" id="adultNameAlert' + i + '"></span>';
            }

            $("#adultPassangerNameWrapper").html(html);
        }

        function printChildNameInput(totalChild)
        {
            var html = '';

            for (var i = 0; i < totalChild; i++) 
            {
                html += '<label for=""><?= Yii::t('app', 'Child Passanger Name') ?>' + (i+1) + '</label>\
                        <input type="text" class="form-control" id="inputChild' + i + '" placeholder="<?= Yii::t('app', 'Child Passanger Name') ?>">\
                        <span class="text-alert text-danger" id="childNameAlert' + i + '"></span>';
            }

            $("#childPassangerNameWrapper").html(html);
        }

        function printSeatMap()
        {
            var html = '';
            var seatRow = availableFlightLists[index].MAX_ROW;
            var seatColumn = availableFlightLists[index].MAX_COLUMN;
            bookSeat = [];

            for (var i = 1; i <= seatRow; i++) 
            {
                html += '<div class="seatRow d-flex justify-content-center">';

                for (var j = 0; j < seatColumn; j++) 
                {
                    var alphabet = String.fromCharCode(65 + j);
                    var isSet = seatMap.find(e => e.X == i && e.Y == (j+1));
                    var isBooked = bookedSeat.find(e => e.X == i && e.Y == (j+1))

                    if(isSet)
                    {
                        if(isBooked)
                        {
                            html += '<div class="border px-3 py-2 m-1 rounded bg-danger booked" data-x="' + i + '" data-y="' + (j+1) + '">' + alphabet + i + '</div>';
                        }
                        else
                        {
                            html += '<div class="seats border px-3 py-2 m-1 rounded" id="seat' + i + (j+1) + '" data-x="' + i + '" data-y="' + (j+1) + '" name="seat">' + alphabet + i + '</div>';
                        }
                    }
                    else
                    {
                        html += '<div class="border px-3 py-2 m-1 rounded bg-danger" data-x="' + i + '" data-y="' + (j+1) + '">--</div>';                
                    }
                }
                
                html += '</div>';
            }

            $("#seatWrapper").html(html);

            $("div[name='seat']").on("click", function()
            {
                var row = $(this).data("x");
                var column = $(this).data("y");
                var isSet = seatMap.find(e => e.X == row && e.Y == column);

                if($("#seat" + row + column).hasClass("pick-seat"))
                {
                    var indexToDelete = bookSeat.findIndex(e => e.x == row && e.y == column);
                    bookSeat.splice(indexToDelete, 1);
                    countPassanger ++;
                }
                else{
                    if(countPassanger == 0)
                    {
                        return;
                    }
                    var data = {
                        x: row,
                        y: column
                    }
                    bookSeat.push(data);
                    countPassanger--;
                }

                $("#seat" + row + column).toggleClass("pick-seat");
            });
        }

        function printBookDetail()
        {
            var html = '<div class="container">\
                            <div class="row mb-3 py-2">\
                                <div class="col-6">\
                                    <?= Yii::t('app', 'Booking Code') ?>\
                                </div>\
                                <div class="col-6">\
                                    ' + bookReport[0].CODE + '\
                                </div>\
                                <div class="col-6">\
                                    <?= Yii::t('app', 'Booking Date') ?>\
                                </div>\
                                <div class="col-6">\
                                    ' + bookReport[0].CREATE_TIME + '\
                                </div>\
                                <div class="col-6">\
                                    <?= Yii::t('app', 'Airplane Name') ?>\
                                </div>\
                                <div class="col-6">\
                                    ' + bookReport[0].AIRPLANE_NAME + '\
                                </div>\
                                <div class="col-6">\
                                    <?= Yii::t('app', 'Route') ?>\
                                </div>\
                                <div class="col-6">\
                                    ' + bookReport[0].FLIGHT_ROUTE + '\
                                </div>\
                                <div class="col-6">\
                                    <?= Yii::t('app', 'Departure Date & Time') ?>\
                                </div>\
                                <div class="col-6">\
                                    ' + bookReport[0].DEPARTURE_TIME + '\
                                </div>\
                                <div class="col-6">\
                                    <?= Yii::t('app', 'Arrival Date & Time') ?>\
                                </div>\
                                <div class="col-6">\
                                    ' + bookReport[0].ARRIVAL_TIME + '\
                                </div>\
                                <div class="col-6">\
                                    <?= Yii::t('app', 'Adult Passanger') ?>\
                                </div>\
                                <div class="col-6">\
                                    ' + bookReport[0].ADULT_PASSANGER + '\
                                </div>\
                                <div class="col-6">\
                                    <?= Yii::t('app', 'Child Passanger') ?>\
                                </div>\
                                <div class="col-6">\
                                    ' + bookReport[0].CHILD_PASSANGER + '\
                                </div>\
                                <div class="col-6">\
                                    <?= Yii::t('app', 'Total Ticket') ?>\
                                </div>\
                                <div class="col-6">\
                                    ' + bookReport[0].TOTAL_TICKET + '\
                                </div>\
                                <div class="col-6">\
                                    <?= Yii::t('app', 'Additional Baggage') ?>\
                                </div>\
                                <div class="col-6">\
                                    ' + bookReport[0].ADDITIONAL_BAGGAGE + '\
                                </div>\
                                <div class="col-6">\
                                    <?= Yii::t('app', 'Payment Method') ?>\
                                </div>\
                                <div class="col-6">\
                                    ' + bookReport[0].PAYMENT_METHOD + '\
                                </div>\
                                <div class="col-6">\
                                    <?= Yii::t('app', 'Total Price') ?>\
                                </div>\
                                <div class="col-6">\
                                    ' + parseInt(bookReport[0].TOTAL_PRICE).toLocaleString('id-ID', {style:"currency", currency:"IDR"}) + '\
                                </div>\
                            </div>\
                        </div>';

            return html;
        }

        function printTicket()
        {
            var html = '' + printBookDetail() + '';

            html += '<div class="container">';

            for (var i = 0; i < ticketLists.length; i++) {
                var alphabet = String.fromCharCode(64 + parseInt(ticketLists[i].Y));

                html += '<div class="row mb-3 py-2 border border-dark rounded">\
                            <div class="col-12 text-center mb-2">\
                                <h6 class="m-0"><?= Yii::t('app', 'Ticket') ?>' + ' ' + (i+1) + '</h6>\
                            </div>\
                            <div class="col-6">\
                                <?= Yii::t('app', 'Airplane') ?>\
                            </div>\
                            <div class="col-6">\
                                ' + bookReport[0].AIRPLANE_NAME + '\
                            </div>\
                            <div class="col-6">\
                                <?= Yii::t('app', 'Origin') ?> - <?= Yii::t('app', 'Destination') ?>\
                            </div>\
                            <div class="col-6">\
                                ' + bookReport[0].FLIGHT_ROUTE + '\
                            </div>\
                            <div class="col-6">\
                                <?= Yii::t('app', 'Departure') ?>\
                            </div>\
                            <div class="col-6">\
                                ' + bookReport[0].DEPARTURE_TIME + '\
                            </div>\
                            <div class="col-6">\
                                <?= Yii::t('app', 'Arrival') ?>\
                            </div>\
                            <div class="col-6">\
                                ' + bookReport[0].ARRIVAL_TIME + '\
                            </div>\
                            <div class="col-6">\
                                <?= Yii::t('app', 'Passanger Name') ?>\
                            </div>\
                            <div class="col-6">\
                                ' + ticketLists[i].PASSANGER_NAME + '\
                            </div>\
                            <div class="col-6">\
                                <?= Yii::t('app', 'Seat') ?>\
                            </div>\
                            <div class="col-6">\
                                ' + alphabet + ticketLists[i].X + '\
                            </div>\
                            <div class="col-6">\
                                <?= Yii::t('app', 'Seat Type') ?>\
                            </div>\
                            <div class="col-6">\
                                ' + ticketLists[i].NAME + '\
                            </div>\
                        </div>';
            }

            html += '</div>';

            $("#bookDetailModal .modal-body").html(html);
        }

        function printAvailableFlight()
        {
            var html = '';

            for (var i = 0; i < availableFlightLists.length; i++) {
                html += '<tr align="center">\
                            <td class="text-nowrap">' + availableFlightLists[i].ORIGIN + '</td>\
                            <td class="text-nowrap">' + availableFlightLists[i].DESTINATION + '</td>\
                            <td class="text-nowrap">' + availableFlightLists[i].TOTAL_TRANSIT + '</td>\
                            <td class="text-nowrap">' + availableFlightLists[i].DEPARTURE_TIME + '</td>\
                            <td class="text-nowrap">' + availableFlightLists[i].ARRIVAL_TIME + '</td>\
                            <td class="text-nowrap">' + availableFlightLists[i].DURATION_TIME + '</td>\
                            <td class="text-nowrap">' + availableFlightLists[i].AIRPLANE_NAME + '</td>\
                            <td class="text-nowrap">' + availableFlightLists[i].SEAT_TYPE_NAME + '</td>\
                            <td class="text-nowrap"><button class="btn btn-secondary" id="btnDetail' + i + '" name="btnDetail" data-index="' + i +'"><?= Yii::t('app', 'Detail') ?></button></td>\
                            <td class="text-nowrap"><button class="btn btn-primary" id="btnBook' + i + '" name="btnBook" data-index="' + i +'"><?= Yii::t('app', 'Book') ?></button></td>\
                        </tr>';
            }

            $("#availableFlightTable tbody").html(html);

            $("#availableFlightTable").DataTable({
                "aaSorting": [],
                "paging": false,
                "info": false,
                "oLanguage": {
                    "sSearch": "<?= Yii::t('app', 'Search') ?>"
                },
                "columnDefs": [{
                                targets: [8, 9],
                                orderable: false
                            }],
                dom:"<'myfilter'f><'mylength'l>t",
            });

            $("#availableFlightTable button[name='btnDetail']").on("click", function()
            {
                index = $(this).data("index");

                $.ajax
                ({
                    type: 'POST',
                    data: {
                        flightId: availableFlightLists[index].ID
                    },
                    dataType: 'JSON',
                    url: '<?= Yii::$app->getUrlManager()->createUrl('flight/get-transit') ?>',
                    success: function(getTransitResult)
                    {
                        transitLists = getTransitResult[0]; 
                        var html = printFlightDetail();

                        $("#detailFlightModal .modal-body").html(html);
                        $("#detailFlightModal").modal("show");
                    }
                });
            });

            $("#availableFlightTable button[name='btnBook']").on("click", function()
            {
                index = $(this).data("index");

                $("#addBookForm").trigger("reset");
                $("#adultPassangerNameWrapper").html("");
                $("#childPassangerNameWrapper").html("");
                $("#seatsLeftWrapper").html("");
                printSeatTypeLists();

                $("#bookSeatTypeAlert, #adultAlert, #childAlert, #baggageAlert, #paymentAlert").html("");

                $("#addBookModal").modal("show");
            });
        }

        printAvailableFlight();
        printPaymentLists();
        
        $("#inputBookSeatType").on("change", function()
        {
            $.ajax
            ({
                type: 'POST',
                data: {
                    airplaneId: availableFlightLists[index].AIRPLANE_ID,
                    flightId: availableFlightLists[index].ID,
                    seatTypeId: $("#inputBookSeatType").val()
                },
                dataType: 'JSON',
                url: '<?= Yii::$app->getUrlManager()->createUrl('book/show-available-seat') ?>',
                success: function(availableSeatResult)
                {   
                    seatMap = availableSeatResult[0];
                    bookedSeat = availableSeatResult[1];
                    availableSeat = seatMap.length - bookedSeat.length;
                    printSeatLeft();
                    console.log(bookedSeat);
                }
            });
        });

        $("#inputAdult, #inputChild, #inputBaggage").on("input", function()
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

        $("#inputAdult").on("input", function()
        {
            printAdultNameInput($(this).val());
        });

        $("#inputChild").on("input", function()
        {
            printChildNameInput($(this).val());
        });

        $("#inputAdult, #inputChild, #inputBaggage").on("change", function()
        {
            var value = $(this).val();
            if(value == "")
            {
                $(this).val("0");
            }
        });

        $("#btnAddBookConfModal").on("click", function()
        {
            var flag = 0;

            flag += valBookSeatType($("#inputBookSeatType").val());
            flag += valAdultAndChild($("#inputAdult").val(), $("#inputChild").val());
            for (var i = 0; i < $("#inputAdult").val(); i++) {
                flag += valAdultPassangerName($("#inputAdult" + i).val(), i);
            }
            for (var i = 0; i < $("#inputChild").val(); i++) {
                flag += valChildPassangerName($("#inputChild" + i).val(), i);
            }
            flag += valBaggage($("#inputBaggage").val());
            flag += valPayment($("#inputPayment").val());
            
            if(flag == 0)
            {
                totalPassanger = parseInt($("#inputAdult").val()) + parseInt($("#inputChild").val());

                if(availableSeat < totalPassanger)
                {
                    alert("<?= Yii::t('app', 'Seat for this class is not enough!') ?>");
                    return;
                }

                $.ajax
                ({
                    type: 'POST',
                    data: {
                        airplaneId: availableFlightLists[index].AIRPLANE_ID,
                        seatTypeId: $("#inputBookSeatType").val()
                    },
                    dataType: 'JSON',
                    url: '<?= Yii::$app->getUrlManager()->createUrl('book/get-seat') ?>',
                    success: function(seatMapResult)
                    {   
                        seatMap = seatMapResult[0];
                        console.log(seatMap); 

                        countPassanger = totalPassanger;
                        printSeatShowCase();
                        printSeatMap();

                        $("#addBookModal").modal("hide");
                        $("#seatMapModal").modal("show");
                    }
                });
            }
        });

        $("#addBookForm").on("submit", function(event)
        {
            event.preventDefault();
            var adultPrice = parseInt($("#inputAdult").val()) * availableFlightLists[index].ADULT_PRICE;
            var childPrice = parseInt($("#inputChild").val()) * availableFlightLists[index].CHILD_PRICE;
            var baggagePrice = parseInt($("#inputBaggage").val()) * availableFlightLists[index].BAGGAGE_PRICE;
            var totalPrice = adultPrice + childPrice + baggagePrice;
            var passangerName = [];

            for (var i = 0; i < $("#inputAdult").val(); i++) {
                passangerName.push($("#inputAdult" + i).val());
            }
            for (var i = 0; i < $("#inputChild").val(); i++) {
                passangerName.push($("#inputChild" + i).val());
            }

            var data = {
                flightId: availableFlightLists[index].ID,
                seatTypeId: $("#inputBookSeatType").val(),
                adultPassanger: $("#inputAdult").val(),
                childPassanger: $("#inputChild").val(),
                additionalBaggage: $("#inputBaggage").val(),
                totalTicket: totalPassanger,
                totalPrice: totalPrice,
                bookSeat: bookSeat,
                passangerName: passangerName,
                paymentId: $("#inputPayment").val(),
                sessionId: sessionId
            }

            console.log(data);
            $.ajax
            ({
                type: 'POST',
                data: data,
                dataType: 'JSON',
                url: '<?= Yii::$app->getUrlManager()->createUrl('book/add') ?>',
                success: function(addBookResult)
                {   
                    console.log('ini hasil', addBookResult);
                    if(addBookResult[0].errNum == 0)
                    {   
                        availableFlightLists = addBookResult[1];
                        bookReport = addBookResult[2];
                        ticketLists = addBookResult[3];
                        alert("<?= Yii::t('app', 'Booking success!') ?>");

                        $('#availableFlightTicket').DataTable().destroy();
                        printAvailableFlight();
                        printTicket();
                        $("#addBookConfModal").modal("hide");
                        $("#bookDetailModal").modal("show");
                    }
                    else
                    {
                        alert(addBookResult[0].errStr);
                        $("#addBookConfModal").modal("hide");
                        $("#addBookModal").modal("show");
                    }
                }
            });
        });

        $("#cancelAddSeatModal, #closeAddSeatModal").on("click", function()
        {
            $("#seatMapModal").modal("hide");
            $("#addBookModal").modal("show");
        });

        $("#btnAddConfSeat").on("click", function()
        {
            if(countPassanger != 0)
            {
                alert("<?= Yii::t('app', 'Please select seat for each passanger!') ?>");
                return;
            }
            $("#seatMapModal").modal("hide");
            $("#addBookConfModal").modal("show");
        });

        $("#cancelAddBookConfModal, #closeAddBookConfModal").on("click", function()
        {
            $("#addBookConfModal").modal("hide");
            $("#seatMapModal").modal("show");
        });
        
    });


</script>