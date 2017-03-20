<?
//หากมีการเรียกไฟล์นี้โดยตรง
if (preg_match("/index.php/i",$PHP_SELF)) {
    Header("Location: ../index.php");
    die();
}
?>