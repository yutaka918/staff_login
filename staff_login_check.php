<?php

try
{

    $staff_code=$_POST['code'];
    $staff_pass=$_POST['pass'];

    $staff_code=htmlspecialchars($staff_code,ENT_QUOTES,'UTF-8');
    $staff_pass=htmlspecialchars($staff_pass,ENT_QUOTES,'UTF-8');

    $staff_pass=md5($staff_pass);
    //mst_productにmst_staff入れる
    $dsn = 'mysql:dbname=mst_product;host=localhost;charset=utf8';
    $user = 'root';
    $password = '';
    $dbh = new PDO($dsn,$user,$password);
    $dbh->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

    $sql = 'SELECT name FROM mst_staff WHERE code=? AND password=?';
    $stmt = $dbh->prepare($sql);
    $data[]=$staff_code;
    $data[]=$staff_pass;
    $stmt->execute($data);

    $dbh = null;

    $rec = $stmt->fetch(PDO::FETCH_AASSOC);

    if($rec==false)
    {
        print'スタッフコードがパスワードが間違っています。<br />';
        print'<a href="staff_login.html">戻る</a>';
    }
    else
    {
        header('Location:staff_top.php');
        exit();
    }

}
catch(Exception $e)
{
    print 'ただいま障害により大変ご迷惑をお掛けしております。';
    exit();
}

?>