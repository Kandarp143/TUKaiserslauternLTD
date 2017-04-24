<h2>Login to Website</h2>
<form method="post" action="process/processLogin.php">
    <fieldset>
        <label for="inputEmail" class="sr-only">UserID</label>
        <input type="text" id="inputUser" name="inputUser"
               placeholder="Enter User ID"
               required=""
               autofocus="">
        <br/>
        <label for="inputPassword">Password</label>
        <input type="password" id="inputPassword" name="inputPassword"
               placeholder="Password"
               required="">
        <br/>
        <button type="submit" name="login-submit"
                id="login-submit">Sign in
        </button>
    </fieldset>
    <fieldset>
        <?php
        $err = '';
        if (isset($_GET['err'])) {
            $err = $_SESSION['err'];

        }
        ?>
        <div class="msg-err"><?php echo $err ?></div>
    </fieldset>
</form>