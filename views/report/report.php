<div class="container mt-4">
    <div class="col-12 col-sm-6 col-md-7 col-lg-4 d-flex justify-content-center align-items-center">
        <label for="inputDateRange" class="text-nowrap"><?= Yii::t('app', 'Search Date') ?>: </label>
        <input type="text" class="form-control ms-2" id="inputDateRange" name="inputDateRange">
    </div>
</div>

<div class="container px-2 py-3 overflow-auto">
    
    <table class="table table-bordered" id="bookReportTable">
        <thead>
            <tr>
                <th scope="col" class="text-nowrap text-center"><?= Yii::t('app', 'Booking Code') ?></th>
                <th scope="col" class="text-nowrap text-center"><?= Yii::t('app', 'Booking Date') ?></th>
                <th scope="col" class="text-nowrap text-center"><?= Yii::t('app', 'Airplane Name') ?></th>
                <th scope="col" class="text-nowrap text-center"><?= Yii::t('app', 'Route') ?></th>
                <th scope="col" class="text-nowrap text-center"><?= Yii::t('app', 'Departure Date & Time') ?></th>
                <th scope="col" class="text-nowrap text-center"><?= Yii::t('app', 'Arrival Date & Time') ?></th>
                <th scope="col" class="text-nowrap text-center"><?= Yii::t('app', 'Total Ticket') ?></th>
                <th scope="col" class="text-nowrap text-center"><?= Yii::t('app', 'Adult Passanger') ?></th>
                <th scope="col" class="text-nowrap text-center"><?= Yii::t('app', 'Child Passanger') ?></th>
                <th scope="col" class="text-nowrap text-center"><?= Yii::t('app', 'Payment Method') ?></th>
                <th scope="col" class="text-nowrap text-center"><?= Yii::t('app', 'Total Price') ?></th>
                <th scope="col" class="text-nowrap" hidden="true"></th>
                <th scope="col" class="text-nowrap"></th>
            </tr>
        </thead>
        <tbody>
            
        </tbody>
        <tfoot>
            <tr align="center">
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td class="text-nowrap"></td>
                <td></td>
            </tr>
        </tfoot>
    </table>

    <!-- ticket modal -->
    <div class="modal" tabindex="-1" id="ticketModal">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"><?= Yii::t('app', 'Ticket') ?></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="container">
                        
                    </div>
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
        var bookReportLists = <?= $bookReportLists ?>;
        var sessionId = <?= $sessionId ?>;
        var sessionFirstName = <?= $sessionFirstName ?>;
        var totalIncome;
        var ticketLists;
        var index;
        var maxDate;
        var minDate;

        if(sessionId)
        {
            $("#navbarUserNow #navbarDarkDropdownMenuLink").html(sessionFirstName);
            $("#navbarUserNow").attr("hidden", false);
            $("#navbarAdmin").attr("hidden", false);
            $("#navbarSetup").attr("hidden", false);
            $("#navbarBook").attr("hidden", false);
            $("#navbarReport").attr("hidden", false);
        }

        console.log(bookReportLists);

        function printTicket()
        {
            var html = '';

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
                                ' + bookReportLists[index].AIRPLANE_NAME + '\
                            </div>\
                            <div class="col-6">\
                                <?= Yii::t('app', 'Origin') ?> - <?= Yii::t('app', 'Destination') ?>\
                            </div>\
                            <div class="col-6">\
                                ' + bookReportLists[index].FLIGHT_ROUTE + '\
                            </div>\
                            <div class="col-6">\
                                <?= Yii::t('app', 'Departure') ?>\
                            </div>\
                            <div class="col-6">\
                                ' + bookReportLists[index].DEPARTURE_TIME + '\
                            </div>\
                            <div class="col-6">\
                                <?= Yii::t('app', 'Arrival') ?>\
                            </div>\
                            <div class="col-6">\
                                ' + bookReportLists[index].ARRIVAL_TIME + '\
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

            $("#ticketModal .container").html(html);
        }

        function printBookReport()
        {
            totalIncome = 0;
            var html = '';

            for (var i = 0; i < bookReportLists.length; i++) {
                totalIncome += parseInt(bookReportLists[i].TOTAL_PRICE);
                html += '<tr align="center">\
                            <td class="text-nowrap">' + bookReportLists[i].CODE + '</td>\
                            <td class="text-nowrap">' + bookReportLists[i].CREATE_TIME + '</td>\
                            <td class="text-nowrap">' + bookReportLists[i].AIRPLANE_NAME + '</td>\
                            <td class="text-nowrap">' + bookReportLists[i].FLIGHT_ROUTE + '</td>\
                            <td class="text-nowrap">' + bookReportLists[i].DEPARTURE_TIME + '</td>\
                            <td class="text-nowrap">' + bookReportLists[i].ARRIVAL_TIME + '</td>\
                            <td class="text-nowrap">' + bookReportLists[i].TOTAL_TICKET + '</td>\
                            <td class="text-nowrap">' + bookReportLists[i].ADULT_PASSANGER + '</td>\
                            <td class="text-nowrap">' + bookReportLists[i].CHILD_PASSANGER + '</td>\
                            <td class="text-nowrap text-capitalize">' + bookReportLists[i].PAYMENT_METHOD + '</td>\
                            <td class="text-nowrap">' + parseInt(bookReportLists[i].TOTAL_PRICE).toLocaleString('id-ID', {style:"currency", currency:"IDR"}) + '</td>\
                            <td class="text-nowrap" hidden="true">' + bookReportLists[i].TOTAL_PRICE + '</td>\
                            <td class="text-nowrap"><button type="button" class="btn btn-primary" id="btnTicket' + i + '" name="btnTicket" data-index="' + i + '"><?= Yii::t('app', 'View Ticket') ?></button></td>\
                        </tr>';                
            }

            var htmlIncome = '<h6 class="m-0 fs-6">Total Income: RP. ' + totalIncome + '</h6>';

            $("#bookReportTable tbody").html(html);
            // $("#totalIncomeWrapper").html(htmlIncome);

            $("button[name='btnTicket']").on("click", function()
            {
                index = $(this).data("index");

                $.ajax
                ({
                    type: 'POST',
                    data: {
                        bookId: bookReportLists[index].ID
                    },
                    dataType: 'JSON',
                    url: '<?= Yii::$app->getUrlManager()->createUrl('report/get-ticket') ?>',
                    success: function(getTicketResult)
                    {
                        ticketLists = getTicketResult[0];
                        console.log('hasil', ticketLists);
                        printTicket();

                        $("#ticketModal").modal("show");
                    },
                });

            });
        }

        // $.fn.dataTable.ext.search.push(
        //     function(settings, data, dataIndex) 
        //     {
        //         var date = moment(data[1], 'DD-MM-YYYY').format('DD-MM-YYYY');
        //         var price = data[10];

        //         if(( minDate == "" || maxDate == "" ) || (date >= minDate && date <= maxDate))
        //         {
        //             return true; 
        //         }

        //         return false;
        //     }
        // );

        // Apply filtering on daterangepicker change
        $('#inputDateRange').on('apply.daterangepicker', function(ev, picker) {
            $(this).val(picker.startDate.format('DD-MM-YYYY') + ' - ' + picker.endDate.format('DD-MM-YYYY'));
            minDate = moment(picker.startDate, 'DD-MM-YYYY').format('DD-MM-YYYY');
            maxDate = moment(picker.endDate, 'DD-MM-YYYY').format('DD-MM-YYYY');

            $.fn.dataTable.ext.search.push(function(settings, data, dataIndex) {
                var date = moment(data[1], 'DD-MM-YYYY').format('DD-MM-YYYY');
                return (minDate === '' || maxDate === '' || (date >= minDate && date <= maxDate));
            });

            $("#bookReportTable").DataTable().draw();
        });

        // Redraw the table when the daterangepicker is cleared
        $('#inputDateRange').on('cancel.daterangepicker', function(ev, picker) {
            $(this).val('');
            minDate = '';
            maxDate = '';
            $.fn.dataTable.ext.search.pop();
            $("#bookReportTable").DataTable().draw();
        });

        $("#inputDateRange").attr("placeholder", "DD-MM-YYYY - DD-MM-YYYY");

        $.fn.dataTable.moment( 'DD-MM-YYYY H:mm' );

        printBookReport();

        $("#bookReportTable").DataTable({
            "aaSorting": [],
            "paging": false,
            "info": false,
            "oLanguage": {
                "sSearch": "<?= Yii::t('app', 'Search') ?>"
            },
            "columnDefs": [
                            {
                                targets: [10, 12],
                                orderable: false
                            }
                        ],
            dom: "<'myfilter'f><'mylength'l>t",
            drawCallback: function() {
                var api = this.api();

                // Remove the formatting to get integer data for summation
                var intVal = function (i) {
                    return typeof i === 'string' ? i.replace(/[\$,]/g, '') * 1 : typeof i === 'number' ? i : 0;
                };

                // Total over this page
                pageTotal = api
                    .column(11, { page: 'current' })
                    .data()
                    .reduce(function (a, b) {
                        return intVal(a) + intVal(b);
                    }, 0);


                // Update footer
                $(api.column(10).footer()).html(pageTotal.toLocaleString('id-ID', {style:"currency", currency:"IDR"}));
            }
        });

        $('#inputDateRange').daterangepicker({
            autoUpdateInput: false,
            locale: {
                cancelLabel: 'Clear'
            }
        });

        $("#inputDateRange").on("input", function()
        {
            $(this).val("");
        });

    });

</script>