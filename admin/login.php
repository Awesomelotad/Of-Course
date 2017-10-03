<div id="login-modal" style="display: none;">
    <script>
        $(function () {
            $('#LoginForm').on('submit', function (e) {
                e.preventDefault();
                var $data = {
                    email: $('#EmailInput').val(),
                    password: $('#PasswordInput').val(),
                    login: true
                }
                $.ajax({
                    type: 'POST',
                    url: './scripts/login.php',
                    data: $data,
                    success: function (data) {
                        if (data == 'success') {
                            $('#LoginError').hide();
                            window.location = '/OfCourse(Alpha_0)/index.php?admin=home';
                        } else if(data == 'invalid login') {
                            $('.FormError').show();
                        }
                    }
                });
            });
        });
    </script>

    <form id="LoginForm" class="ModalForm" method="POST" enctype="multipart/form-data">
        <ul>
            <li class="FormField">
                <label id="EmailField" for="email">Email</label>
                <input id="EmailInput" type="email" name="email" maxlength="255" placeholder="Type your school email" autofocus>
            </li>
            <li class="FormField">
                <label for="password">Password</label>
                <input id="PasswordInput" type="password" name="password" maxlength="255" placeholder="Type your password">
            </li>
            <li class="FormSubmit">
                <input id="LoginSubmit" type="submit" value="Log in" name="login">
            </li>
            <h4 class="FormError">Invalid username or password</h4>
        </ul>
    </form>
</div>

<div id="login-modal" class="modal">
    <div class="modal-inner">
        <a data-modal-close><img src="./media/cross.png"/></a>
        <div class="modal-content"></div>
    </div>
</div>
