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
                            $('.form-error').hide();
                            window.location = '/OfCourse(Alpha_0)/index.php?admin=home';
                        } else if(data == 'invalid login') {
                            $('.form-error').show();
                        }
                    }
                });
            });
        });
    </script>

    <form id="LoginForm" class="ModalForm" method="POST" enctype="multipart/form-data">
        <ul>
            <li class="form-field">
                <label for="email">Email</label>
                <input id="EmailInput" onkeyup="$('.form-error').hide()" type="email" name="email" maxlength="255" placeholder="Type your school email" autofocus>
            </li>
            <li class="form-field">
                <label for="password">Password</label>
                <input id="PasswordInput" onkeyup="$('.form-error').hide()" type="password" name="password" maxlength="255" placeholder="Type your password">
            </li>
            <li class="form-submit">
                <input id="LoginSubmit" type="submit" value="Log in" name="login">
            </li>
            <h4 class="form-error">Invalid username or password</h4>
        </ul>
    </form>
</div>

<div id="login-modal" class="modal">
    <div class="modal-inner">
        <a data-modal-close><img src="./media/cross.png"/></a>
        <div class="modal-content"></div>
    </div>
</div>
