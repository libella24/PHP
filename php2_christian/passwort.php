<?php
$db_passwort_md5 = "81dc9bdb52d04dc20036dbd8313ed055";
$passwort = "asdf";
$salt = "köakkäkk234";

if ( $db_passwort_md5 == md5($passwort)) {
    echo "passwort ist richtig";
    echo "<br>";
}


echo $passwort;
echo "<br>";
echo md5($passwort);
echo "<br>";
echo md5($passwort.$salt);

echo "<br>";
$db_password = password_hash($passwort, PASSWORD_DEFAULT);
echo $db_password;
echo "<br>";

if (password_verify($passwort, $db_password)) {
    echo "Passwort stimmt überein";
};
