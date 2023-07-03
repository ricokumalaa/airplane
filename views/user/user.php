<div class="container mt-4 mb-2">
    <div class="text-end mb-2">
        <button class="btn btn-primary shadow-btn" type="button" id="addUser">+ <?= Yii::t('app', 'Add User') ?></button>
    </div>
</div>

<div class="container py-3 overflow-auto">
    
    <table class="table table-bordered" id="userTable">
        <thead>
            <tr valign="middle" align="center">
                <th scope="col" class="text-nowrap text-center"><?= Yii::t('app', 'First Name') ?></th>
                <th scope="col" class="text-nowrap text-center"><?= Yii::t('app', 'Last Name') ?></th>
                <th scope="col" class="text-nowrap text-center"><?= Yii::t('app', 'Email') ?></th>
                <th scope="col" class="text-nowrap text-center"><?= Yii::t('app', 'NIK') ?></th>
                <th scope="col" class="text-nowrap text-center"><?= Yii::t('app', 'Phone') ?></th>
                <th scope="col" class="text-nowrap text-center"><?= Yii::t('app', 'Address') ?></th>
                <th scope="col"></th>
                <th scope="col"></th>
            </tr>
        </thead>
        <tbody>

        </tbody>
    </table>

    <!-- start of add user modal -->
    <form id="userForm">
        <div class="modal" tabindex="-1" id="addUserModal">
            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title"><?= Yii::t('app', 'Add User') ?></h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-2">
                            <label for=""><?= Yii::t('app', 'Email') ?><span class="text-alert text-danger">*</span></label>
                            <input type="text" class="form-control" id="inputEmail" placeholder="<?= Yii::t('app', 'Email Address') ?>">
                            <span class="text-alert text-danger" id="emailAlert"></span>
                        </div>
                        <div class="mb-2">
                            <label for=""><?= Yii::t('app', 'First Name') ?><span class="text-alert text-danger">*</span></label>
                            <input type="text" class="form-control" id="inputFirstName" placeholder="<?= Yii::t('app', 'First Name') ?>">
                            <span class="text-alert text-danger" id="firstNameAlert"></span>
                        </div>
                        <div class="mb-2">
                            <label for=""><?= Yii::t('app', 'Last Name') ?><span class="text-alert text-danger">*</span></label>
                            <input type="text" class="form-control" id="inputLastName" placeholder="<?= Yii::t('app', 'Last Name') ?>">
                            <span class="text-alert text-danger" id="lastNameAlert"></span>
                        </div>
                        <div class="mb-2">
                            <label for=""><?= Yii::t('app', 'Password') ?><span class="text-alert text-danger">*</span></label>
                            <input type="password" class="form-control" id="inputPassword" placeholder="<?= Yii::t('app', 'Password') ?>">
                            <span class="text-alert text-danger" id="passwordAlert"></span>
                        </div>
                        <div class="mb-2">
                            <label for=""><?= Yii::t('app', 'Confirm Password') ?><span class="text-alert text-danger">*</span></label>
                            <input type="password" class="form-control" id="inputConfPassword" placeholder="<?= Yii::t('app', 'Confirm Password') ?>">
                            <span class="text-alert text-danger" id="confPasswordAlert"></span>
                        </div>
                        <div class="mb-2">
                            <label for=""><?= Yii::t('app', 'NIK') ?><span class="text-alert text-danger">*</span></label>
                            <input type="number" class="form-control" id="inputNik" placeholder="<?= Yii::t('app', 'NIK') ?>">
                            <span class="text-alert text-danger" id="nikAlert"></span>
                        </div>
                        <div class="mb-2">
                            <label for=""><?= Yii::t('app', 'Phone Number') ?><span class="text-alert text-danger">*</span></label>
                            <input type="number" class="form-control" id="inputPhone" placeholder="<?= Yii::t('app', 'Phone Number') ?>">
                            <span class="text-alert text-danger" id="phoneAlert"></span>
                        </div>
                        <div class="mb-2">
                            <label for=""><?= Yii::t('app', 'Address') ?><span class="text-alert text-danger">*</span></label>
                            <input type="text" class="form-control" id="inputAddress" placeholder="<?= Yii::t('app', 'Address') ?>">
                            <span class="text-alert text-danger" id="addressAlert"></span>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><?= Yii::t('app', 'Close') ?></button>
                        <button type="button" class="btn btn-primary" id="btnAddUserConfModal"><?= Yii::t('app', 'Save') ?></button>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal" tabindex="-1" id="addUserConfModal">
            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title"><?= Yii::t('app', 'Confirmation') ?></h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" id="closeAddUserConfModal"></button>
                    </div>
                    <div class="modal-body">
                        <?= Yii::t('app', 'Are you sure you want to add user?') ?>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" id="cancelAddUserConfModal"><?= Yii::t('app', 'Cancel') ?></button>
                        <button type="submit" class="btn btn-primary"><?= Yii::t('app', 'Add') ?></button>
                    </div>
                </div>
            </div>
        </div>
    </form>
    <!-- end of add user modal -->

    <!-- start of edit modal -->
    <form id="editUserForm">
        <div class="modal" tabindex="-1" id="editUserModal">
            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title"><?= Yii::t('app', 'Edit User') ?></h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-2">
                            <label for=""><?= Yii::t('app', 'Email') ?><span class=" text-alert text-danger">*</span></label>
                            <input type="text" class="form-control" id="inputEditEmail" placeholder="<?= Yii::t('app', 'Email Address') ?>">
                            <span class=" text-alert text-danger" id="emailEditAlert"></span>
                        </div>
                        <div class="mb-2">
                            <label for=""><?= Yii::t('app', 'First Name') ?><span class=" text-alert text-danger">*</span></label>
                            <input type="text" class="form-control" id="inputEditFirstName" placeholder="<?= Yii::t('app', 'First Name') ?>">
                            <span class="text-alert text-danger" id="firstNameEditAlert"></span>
                        </div>
                        <div class="mb-2">
                            <label for=""><?= Yii::t('app', 'Last Name') ?><span class=" text-alert text-danger">*</span></label>
                            <input type="text" class="form-control" id="inputEditLastName" placeholder="<?= Yii::t('app', 'Last Name') ?>">
                            <span class="text-alert text-danger" id="lastNameEditAlert"></span>
                        </div>
                        <div class="mb-2">
                            <label for=""><?= Yii::t('app', 'NIK') ?><span class=" text-alert text-danger">*</span></label>
                            <input type="number" class="form-control" id="inputEditNik" placeholder="<?= Yii::t('app', 'NIK') ?>">
                            <span class="text-alert text-danger" id="nikEditAlert"></span>
                        </div>
                        <div class="mb-2">
                            <label for=""><?= Yii::t('app', 'Phone Number') ?><span class=" text-alert text-danger">*</span></label>
                            <input type="number" class="form-control" id="inputEditPhone" placeholder="<?= Yii::t('app', 'Phone Number') ?>">
                            <span class="text-alert text-danger" id="phoneEditAlert"></span>
                        </div>
                        <div class="mb-2">
                            <label for=""><?= Yii::t('app', 'Address') ?><span class=" text-alert text-danger">*</span></label>
                            <input type="text" class="form-control" id="inputEditAddress" placeholder="<?= Yii::t('app', 'Address') ?>">
                            <span class="text-alert text-danger" id="addressEditAlert"></span>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><?= Yii::t('app', 'Close') ?></button>
                        <button type="button" class="btn btn-primary" id="btnEditUserConfModal"><?= Yii::t('app', 'Save') ?></button>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal" tabindex="-1" id="editUserConfModal">
            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title"><?= Yii::t('app', 'Confirmation') ?></h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" id="closeEditUserConfModal"></button>
                    </div>
                    <div class="modal-body">
                        <?= Yii::t('app', 'Are you sure you want to edit user?') ?>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" id="cancelEditUserConfModal"><?= Yii::t('app', 'Cancel') ?></button>
                        <button type="submit" class="btn btn-primary"><?= Yii::t('app', 'Edit') ?></button>
                    </div>
                </div>
            </div>
        </div>
    </form>
    <!-- end of edit modal -->

    
    <!-- delete confirmation modal -->
    <div class="modal" tabindex="-1" id="DeleteUserConfModal">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"><?= Yii::t('app', 'Confirmation') ?></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" id="closeDeleteUserConfModal"></button>
                </div>
                <div class="modal-body">
                    <?= Yii::t('app', 'Are you sure you want to delete this user?') ?>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" id="cancelDeleteUserConfModal"><?= Yii::t('app', 'Cancel') ?></button>
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
        var userLists = <?= $userLists ?>;
        var sessionId = <?= $sessionId ?>;
        var sessionFirstName = <?= $sessionFirstName ?>;
        var index;
        console.log(sessionFirstName);

        if(sessionId)
        {
            $("#navbarUserNow #navbarDarkDropdownMenuLink").html(sessionFirstName);
            $("#navbarUserNow").attr("hidden", false);
            $("#navbarAdmin").attr("hidden", false);
            $("#navbarSetup").attr("hidden", false);
            $("#navbarBook").attr("hidden", false);
            $("#navbarReport").attr("hidden", false);
        }

        console.log(userLists);

        function checkLoggedUser(id, i)
        {
            var html = '';
            
            if(id == sessionId)
            {
                return '';
            }
            
            html += '<button type="button" class="btn btn-danger" id="btnDelete' + i + '" name="btnDelete" data-index="' + i + '"><?= Yii::t('app', 'Delete') ?></button>';
            return html; 
        }
        
        function printUser()
        {
            var html = '';

            for (var i = 0; i < userLists.length; i++) {
                
                html += '<tr align="center">\
                            <td>' + userLists[i].FIRST_NAME + '</td>\
                            <td>' + userLists[i].LAST_NAME + '</td>\
                            <td>' + userLists[i].EMAIL + '</td>\
                            <td>' + userLists[i].NIK + '</td>\
                            <td>' + userLists[i].PHONE_NUMBER + '</td>\
                            <td class="text-nowrap">' + userLists[i].ADDRESS + '</td>\
                            <td><button type="button" class="btn btn-warning" id="btnEdit' + i + '" name="btnEdit" data-index="' + i + '"><?= Yii::t('app', 'Edit') ?></button></td>\
                            <td>' + checkLoggedUser(userLists[i].ID, i) + '</td>\
                        </tr>';

            }

            $("#userTable tbody").html(html);

            $("#userTable").DataTable({
                "aaSorting": [],
                "paging": false,
                "info": false,
                "oLanguage": {
                    "sSearch": "<?= Yii::t('app', 'Search') ?>"
                },
                "columnDefs": [{
                                targets: [4, 5, 6, 7],
                                orderable: false
                            }],
                dom:"<'myfilter'f><'mylength'l>t",
            });

            $("#userTable button[name='btnEdit']").on("click", function()
            {
                index = $(this).data("index");
                
                printEditUserVal(index);
                $("#emailEditAlert, #firstNameEditAlert, #lastNameEditAlert, #passwordEditAlert, #confPasswordEditAlert, #nikEditAlert, #phoneEditAlert, #addressEditAlert").html("");
                $("#editUserModal").modal("show");

            });

            $("#userTable button[name='btnDelete']").on("click", function()
            {
                index = $(this).data("index");
                
                $("#DeleteUserConfModal").modal("show");
            });
        }

        function printEditUserVal(index)
        {
            $("#inputEditEmail").val(userLists[index].EMAIL);
            $("#inputEditFirstName").val(userLists[index].FIRST_NAME);
            $("#inputEditLastName").val(userLists[index].LAST_NAME);
            $("#inputEditNik").val(userLists[index].NIK);
            $("#inputEditPhone").val(userLists[index].PHONE_NUMBER);
            $("#inputEditAddress").val(userLists[index].ADDRESS);
        }

        function valEmail(email)
        {
            var regex = /^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$/;

            if(email.length == 0)
            {
                $("#emailAlert").html("<?= Yii::t('app', 'Email address cannot be empty!') ?>");
                return 1;
            }
            else if(!regex.test(email))
            {
                $("#emailAlert").html("<?= Yii::t('app', 'Email address is not valid!') ?>");
                return 1;
            }
            else if (email.length > 256)
            {
                $("#emailAlert").html("<?= Yii::t('app', 'Email address cannot be more than 256 characters!') ?>");
                return 1;
            }

            $("#emailAlert").html("");
            return 0;
        }

        function valFirstName(firstName)
        {
            if(firstName.length == 0)
            {
                $("#firstNameAlert").html("<?= Yii::t('app', 'First name cannot be empty!') ?>");
                return 1;
            }
            else if (firstName.length > 256)
            {
                $("#firstNameAlert").html("<?= Yii::t('app', 'First name cannot be more than 256 character!') ?>");
                return 1;
            }

            $("#firstNameAlert").html("");
            return 0;
        }

        function valLastName(lastName)
        {
            if(lastName.length == 0)
            {
                $("#lastNameAlert").html("<?= Yii::t('app', 'Last name cannot be empty!') ?>");
                return 1;
            }
            else if (lastName.length > 256)
            {
                $("#lastNameAlert").html("<?= Yii::t('app', 'Last name cannot be more than 256 character!') ?>");
                return 1;
            }

            $("#lastNameAlert").html("");
            return 0;
        }

        function valPassword(password)
        {
            if(password.length == 0)
            {
                $("#passwordAlert").html("<?= Yii::t('app', 'Password cannot be empty!') ?>");
                return 1;
            }
            else if (password.length > 256)
            {
                $("#passwordAlert").html("<?= Yii::t('app', 'Password cannot be more than 256 character!') ?>");
                return 1;
            }

            $("#passwordAlert").html("");
            return 0;
        }

        function valConfPassword(password, confPassword)
        {
            if(confPassword.length == 0)
            {
                $("#confPasswordAlert").html("<?= Yii::t('app', 'Confirm password cannot be empty!') ?>");
                return 1;
            }
            else if(confPassword.length > 256)
            {
                $("#confPasswordAlert").html("<?= Yii::t('app', 'Confirm password cannot be more than 256 character!') ?>");
                return 1;
            }

            if(password != confPassword)
            {
                $("#confPasswordAlert").html("<?= Yii::t('app', 'Password does not match!') ?>");
                return 1;
            }
            
            $("#confPasswordAlert").html("");
            return 0;
        }

        function valNik(nik)
        {
            if(nik.length == 0)
            {
                $("#nikAlert").html("<?= Yii::t('app', 'NIK cannot be empty!') ?>");
                return 1;
            }

            if(nik.length != 16)
            {
                $("#nikAlert").html("<?= Yii::t('app', 'NIK must be 16 digits!') ?>");
                return 1;
            }

            $("#nikAlert").html("");
            return 0;
        }

        function valPhone(phone)
        {
            if(phone.length == 0)
            {
                $("#phoneAlert").html("<?= Yii::t('app', 'Phone number cannot be empty!') ?>")
                return 1;
            }
            
            if(phone.length < 10 || phone.length > 13)
            {
                $("#phoneAlert").html("<?= Yii::t('app', 'Phone number must be between 10 and 13 digits!') ?>")
                return 1;
            }

            $("#phoneAlert").html("");
            return 0;
        }

        function valAddress(address)
        {
            if(address.length == 0)
            {
                $("#addressAlert").html("<?= Yii::t('app', 'Address cannot be empty!') ?>");
                return 1;
            }
            else if(address.length > 256)
            {
                $("#addressAlert").html("<?= Yii::t('app', 'Address cannot be more than 256 character!') ?>");
                return 1;
            }

            $("#addressAlert").html("");
            return 0;
        }

        // validate edit
        function valEditEmail(email)
        {
            var regex = /^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$/;

            if(email.length == 0)
            {
                $("#emailEditAlert").html("<?= Yii::t('app', 'Email address cannot be empty!') ?>");
                return 1;
            }
            else if(!regex.test(email))
            {
                $("#emailEditAlert").html("<?= Yii::t('app', 'Email address is not valid!') ?>");
                return 1;
            }
            else if (email.length > 256)
            {
                $("#emailEditAlert").html("<?= Yii::t('app', 'Email address cannot be more than 256 characters!') ?>");
                return 1;
            }

            $("#emailEditAlert").html("");
            return 0;
        }

        function valEditFirstName(firstName)
        {
            if(firstName.length == 0)
            {
                $("#firstNameEditAlert").html("<?= Yii::t('app', 'First name cannot be empty!') ?>");
                return 1;
            }
            else if (firstName.length > 256)
            {
                $("#firstNameEditAlert").html("<?= Yii::t('app', 'First name cannot be more than 256 character!') ?>");
                return 1;
            }

            $("#firstNameEditAlert").html("");
            return 0;
        }

        function valEditLastName(lastName)
        {
            if(lastName.length == 0)
            {
                $("#lastNameEditAlert").html("<?= Yii::t('app', 'Last name cannot be empty!') ?>");
                return 1;
            }
            else if (lastName.length > 256)
            {
                $("#lastNameAlert").html("<?= Yii::t('app', 'Last name cannot be more than 256 character!') ?>");
                return 1;
            }

            $("#lastNameEditAlert").html("");
            return 0;
        }

        function valEditNik(nik)
        {
            if(nik.length == 0)
            {
                $("#nikEditAlert").html("<?= Yii::t('app', 'NIK cannot be empty!') ?>");
                return 1;
            }

            if(nik.length != 16)
            {
                $("#nikEditAlert").html("<?= Yii::t('app', 'NIK must be 16 digits!') ?>");
                return 1;
            }

            $("#nikAlert").html("");
            return 0;
        }

        function valEditPhone(phone)
        {
            if(phone.length == 0)
            {
                $("#phoneEditAlert").html("<?= Yii::t('app', 'Phone number cannot be empty!') ?>")
                return 1;
            }
            
            if(phone.length < 10 || phone.length > 13)
            {
                $("#phoneEditAlert").html("<?= Yii::t('app', 'Phone number must be between 10 and 13 digits!') ?>")
                return 1;
            }

            $("#phoneAlert").html("");
            return 0;
        }

        function valEditAddress(address)
        {
            if(address.length == 0)
            {
                $("#addressEditAlert").html("<?= Yii::t('app', 'Address cannot be empty!') ?>");
                return 1;
            }
            else if(address.length > 256)
            {
                $("#addressAlert").html("<?= Yii::t('app', 'Address cannot be more than 256 character!') ?>");
                return 1;
            }

            $("#addressEditAlert").html("");
            return 0;
        }
        // validate edit

        printUser();

        $("#addUser").on("click", function(event)
        {
            event.preventDefault();
            
            $("#userForm").trigger("reset");
            $("#emailAlert, #firstNameAlert, #lastNameAlert, #passwordAlert, #confPasswordAlert, #nikAlert, #phoneAlert, #addressAlert").html("");
            $("#addUserModal").modal("show");
        });

        $("#inputPassword, #inputConfPassword").on("keyup", function()
        {
            if($("#inputPassword").val() != $("#inputConfPassword").val())
            {
                $("#confPasswordAlert").html("<?= Yii::t('app', 'Password does not match!') ?>").css("color", "red");
            }
            else
            {
                $("#confPasswordAlert").html("");
            }
        });

        $("#btnAddUserConfModal").on("click", function()
        {
            var flag = 0;

            flag += valEmail($("#inputEmail").val());
            flag += valFirstName($("#inputFirstName").val());
            flag += valLastName($("#inputLastName").val());
            flag += valPassword($("#inputPassword").val());
            flag += valConfPassword($("#inputPassword").val(), $("#inputConfPassword").val());
            flag += valNik($("#inputNik").val());
            flag += valPhone($("#inputPhone").val());
            flag += valAddress($("#inputAddress").val());

            if(flag == 0)
            {
                $("#addUserModal").modal("hide");
                $("#addUserConfModal").modal("show");
            }
            
        });

        $("#closeAddUserConfModal, #cancelAddUserConfModal").on("click", function()
        {
            $("#addUserModal").modal("show");
        });

        $("#inputPhone, #inputNik").on("input", function()
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

        $("#userForm").on("submit", function(event)
        {
            event.preventDefault();

            var data = {
                email: $("#inputEmail").val().toLowerCase(),
                firstName: $("#inputFirstName").val().toLowerCase(),
                lastName: $("#inputLastName").val().toLowerCase(),
                password: $("#inputPassword").val(),
                confPassword: $("#inputConfPassword").val(),
                nik: $("#inputNik").val(),
                phoneNumber: $("#inputPhone").val(),
                address: $("#inputAddress").val(),
                sessionId: sessionId
            }

            $.ajax
            ({
                type: 'POST',
                data: data,
                dataType: 'JSON',
                url: '<?= Yii::$app->getUrlManager()->createUrl('user/add') ?>',
                success: function(addUserResult)
                {
                    console.log(addUserResult);
                    if(addUserResult[0].errNum == 0)
                    {
                        userLists = addUserResult[1];
                        $('#userTable').DataTable().destroy();
                        printUser();
                        alert("<?= Yii::t('app', 'Add User Success!') ?>");
                        $("#addUserConfModal").modal("hide");
                        $("#userForm").trigger("reset");
                    }
                    else
                    {
                        alert(addUserResult[0].errStr);
                        $("#addUserConfModal").modal("hide");
                        $("#addUserModal").modal("show");
                        return;
                    }
                }
            });
        });

        $("#btnEditUserConfModal").on("click", function()
        {
            var flag = 0;

            flag += valEditEmail($("#inputEditEmail").val());
            flag += valEditFirstName($("#inputEditFirstName").val());
            flag += valEditLastName($("#inputEditLastName").val());
            flag += valEditNik($("#inputEditNik").val());
            flag += valEditPhone($("#inputEditPhone").val());
            flag += valEditAddress($("#inputEditAddress").val());

            if(flag == 0)
            {
                $("#editUserModal").modal("hide");
                $("#editUserConfModal").modal("show");
            }
            
        });

        $("#closeEditUserConfModal, #cancelEditUserConfModal").on("click", function()
        {
            $("#editUserModal").modal("show");
        });

        $("#editUserForm").on("submit", function(event)
        {
            event.preventDefault();

            var data = {
                id: userLists[index].ID,
                email: $("#inputEditEmail").val(),
                firstName: $("#inputEditFirstName").val(),
                lastName: $("#inputEditLastName").val(),
                nik: $("#inputEditNik").val(),
                phone: $("#inputEditPhone").val(),
                address: $("#inputEditAddress").val(),
                sessionId: sessionId
            }
            console.log(data);
            $.ajax
            ({
                type: 'POST',
                data: data,
                dataType: 'JSON',
                url: '<?= Yii::$app->getUrlManager()->createUrl('user/update') ?>',
                success: function(updateUserResult)
                {
                    // console.log(updateUserResult);
                    if(updateUserResult[0].errNum == 0)
                    {
                        userLists = updateUserResult[1];
                        $('#userTable').DataTable().destroy();
                        printUser();
                        alert("<?= Yii::t('app', 'Update User Success!') ?>");
                        $("#editUserConfModal").modal("hide");
                        $("#editUserForm").trigger("reset");
                    }
                    else
                    {
                        alert(updateUserResult[0].errStr);
                        $("#editUserConfModal").modal("hide");
                        $("#editUserModal").modal("show");
                        return;
                    }
                } 
            });
        });

        $("#btnDeleteConfModal").on("click", function()
        {
            var data = {
                id: userLists[index].ID,
                sessionId: sessionId
            }

            $.ajax
            ({
                type: 'POST',
                data: data,
                dataType: 'JSON',
                url: '<?= Yii::$app->getUrlManager()->createUrl('user/delete') ?>',
                success: function(deleteUserResult)
                {
                    // console.log(deleteUserResult);
                    if(deleteUserResult[0].errNum == 0)
                    {
                        userLists = deleteUserResult[1];
                        $('#userTable').DataTable().destroy();
                        printUser();
                        alert("<?= Yii::t('app', 'Delete user success!') ?>");
                        $("#DeleteUserConfModal").modal("hide");
                    }
                    else
                    {
                        alert(deleteUserResult[0].errStr);
                        return;
                    }
                }
            });
        });
    });
    
</script>