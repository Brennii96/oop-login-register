<?php
require_once 'core/init.php';

if (Input::exists()) {
    $validate = new Validate();
    $validation = $validate->check($_POST, array(
        'username' => array(
            'name' => 'Username',
            'required' => true,
            'min' => 2,
            'max' => 45,
            'unique' => 'users',
        ),
        'email' => array(
            'name' => 'Email',
            'required' => true,
            'min' => 2,
            'max' => 254,
            'unique' => 'users',
        ),
        'name' => array(
            'name' => 'Name',
            'required' => true,
            'min' => 2,
            'max' => 200
        ),
        'password' => array(
            'name' => 'Password',
            'required' => true,
            'min' => 6,
        ),
        'password_again' => array(
            'name' => 'Password Again',
            'required' => true,
            'matches' => 'password',
        ),
        'first_name' => array(
            'name' => 'First Name',
            'required' => true,
            'min' => 2,
            'max' => 45
        ),
        'last_name' => array(
            'name' => 'Last Name',
            'required' => true,
            'min' => 2,
            'max' => 45
        ),
    ));

    if ($validation->passed()) {
        echo 'Passed';
    } else {
        foreach ($validation->errors() as $error) {
            echo $error . ", <br>";
        }
    }
}
?>
<h1>Register</h1>
        <form action="" method="post" class="ui form">
            <div class="field">
                <label for="username">Username</label>
                <input type="text" name="username" id="username" value="<?php echo escape(Input::get('username')); ?>" autocomplete="off">
            </div>
            <div class="field">
                <label for="email">Email</label>
                <input type="email" name="email" id="email" value="<?php echo escape(Input::get('email')); ?>" autocomplete="off">
            </div>

            <div class="field">
                <label for="password">Choose a Password</label>
                <input type="password" name="password" id="password" value="" autocomplete="off">
            </div>

            <div class="field">
                <label for="password_again">Repeat Password</label>
                <input type="password" name="password_again" id="password_again" value="" autocomplete="off">
            </div>

            <div class="field">
                <input class="ui button right floated" type="submit" name="Register" value="Register">
            </div>
        </form>