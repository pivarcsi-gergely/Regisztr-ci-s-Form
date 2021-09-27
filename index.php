<?php

$userHiba = false;
$userHibaUzenet = '';
$emailHiba = false;
$emailHibaUzenet = '';
$jelszoHiba = false;
$jelszoHibaUzenet = '';
$sikeresRegisztracio = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (empty($_POST['username'])) {
        $userHiba = true;
        $userHibaUzenet = 'Karakterek nélküli felhasználónév nem létezik (hacsak). Adj meg neki legalább 3 db karaktert';
        $username = '';
    }
    elseif (mb_strlen($_POST['username']) < 4) {
        $userHiba = true;
        $userHibaUzenet = 'A felhasználóneved kevesebb, mint 3 karakter hosszú. Adj meg egy hosszabbat!';
        $username = '';
    }
    elseif (strtolower($_POST['username']) === 'admin') {
        $userHiba = true;
        $userHibaUzenet = 'Nem lehet a felhasználóneved' . $_POST['username'] . '. Válassz másikat!';
        $username = $_POST['username'];
    }
    else{
        $username = $_POST['username'];
    }


    if (empty($_POST['email'])) {
            $emailHiba = true;
            $emailHibaUzenet = 'Nem adtad meg az e-mail címed. Add meg, különben nem tudsz regisztrálni!';
            $email = '';
    }
    elseif (strpos($_POST['email'], '.') === false || strpos($_POST['email'], '@') === false) {
        $emailHiba = true;
        $emailHibaUzenet = 'Hiányzik az e-mail címedből vagy egy @, vagy egy .';
        $email = $_POST['email'];
    }
    else{
        $emailHiba = false;
        $email = $_POST['email'];
    }

    if (empty($_POST['password'])) {
        $jelszoHiba = true;
        $jelszoHibaUzenet = 'Nem adtál meg jelszót. Meg kell adnod, különben nem tudsz regisztrálni';
        $password = '';
        $password2 = '';
    }
    elseif (strlen($_POST['password']) < 8) {
        $jelszoHiba = true;
        $jelszoHibaUzenet = 'Nem adtad helyesen a jelszót. Próbáld újra!';
        $password = '';
        $password2 = '';
    }
    elseif ($_POST['password'] != $_POST['password2']) {
        $jelszoHiba = true;
        $jelszoHibaUzenet = 'A két jelszó nem egyezik. Add meg mindkettőt helyesen!';
        $password = '';
        $password2 = '';
    }


    if (!$userHiba && !$emailHiba && !$jelszoHiba) {
        $sikeresRegisztracio = 'Sikeres regisztráció!';
    }
    else {
        $sikeresRegisztracio = '';
    }
}
else{
    $username = $email = $password = $password2 = '';
}

?><!DOCTYPE html>
<html>
<head>
    <meta charset='utf-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <title>Regisztráció</title>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <link rel='stylesheet' type='text/css' media='screen' href='main.css'>
</head>
<body>
    <form method="POST">
        <div>
            <label>
                Usernév:<br>
                <input type='text' name='username' <?php echo 'value="' . $username . '"'; ?>>
            </label>
            <div class='errormessage'><?php echo $userHibaUzenet; ?></div>
        </div>
        <div>
            <label>
                Email cím:<br>
                <input type='email' name='email' <?php echo 'value="' . $email . '"'; ?>>
            </label>
            <div class='errormessage'><?php echo $emailHibaUzenet; ?></div>
        </div>
        <div>
            <label>
                Jelszó:<br>
                <input type='password' name='password'>
            </label>
            <div class='errormessage'><?php echo $emailHibaUzenet; ?></div>
        </div>
        <div>
            <label>
                Jelszó még egyszer:<br>
                <input type='password' name='password2'>
            </label>
        </div>
        <div>
            <input type='submit' value='Regisztráció'>
        </div>
    </form>
    <p class='success'><?php echo $sikeresRegisztracio ?></p>
</body>
</html>
