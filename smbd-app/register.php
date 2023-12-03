<?php
$p1 = password_hash("password", PASSWORD_DEFAULT);
echo $p1;
print('</br>');

echo password_hash("password", PASSWORD_DEFAULT);
print('</br>');

$p2 = password_hash("password", PASSWORD_BCRYPT);
echo $p2;

print('</br>');
echo password_verify("password", $p1);
