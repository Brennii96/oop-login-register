<?php
require_once 'core/init.php';

if (Input::exists()) {
    if (Token::check(Input::get('token'))) {
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
    ));

    if ($validation->passed()) {
        $user = new User();

        $salt = Hash::salt(32);

        try {
            $user->create(array(
                'username' => Input::get('username'),
                'email' => Input::get('email'),
                'password' => Hash::make(Input::get('password'), $salt),
                'salt' => $salt,
                'name' => Input::get('name'),
                'group' => 1,
                'joined' => date('Y-m-d H:i:s'),
            ));

            Session::flash('home', 'You have successfully registered.');
            Redirect::to('index.php');

        } catch (Exception $e) {
            die($e->getMessage());
        }
    } else {
        foreach ($validation->errors() as $error) {
            echo $error . ", <br>";
        }
    }
    }
}
?>
<h1>Register</h1>
<form action="" method="post" class="ui form">
    <div class="field">
        <label for="username">Username</label>
        <input type="text" name="username" id="username" value="<?php echo escape(Input::get('username')); ?>"
               autocomplete="off">
    </div>
    <div class="field">
        <label for="email">Email</label>
        <input type="email" name="email" id="email" value="<?php echo escape(Input::get('email')); ?>"
               autocomplete="off">
    </div>

    <div class="field">
        <label for="name">Name</label>
        <input type="text" name="name" id="name" value="<?php echo escape(Input::get('name')); ?>" autocomplete="off">
    </div>

    <div class="field">
        <label for="password">Choose a Password</label>
        <input type="password" name="password" id="password" value="" autocomplete="off">
    </div>

    <div class="field">
        <label for="password_again">Repeat Password</label>
        <input type="password" name="password_again" id="password_again" value="" autocomplete="off">
    </div>

    <input type="hidden" name="token" value="<?php echo Token::generate(); ?>">
    <div class="field">
        <input class="ui button right floated" type="submit" name="Register" value="Register">
    </div>
</form>