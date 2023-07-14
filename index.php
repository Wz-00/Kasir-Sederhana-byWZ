<?php
require 'template/header.php';
require 'template/navbar.php';
if (!empty($_GET['page'])) {
    include 'module/' . $_GET['page'] . '/index.php';
} else {
    include 'template/content.php';
}
include 'template/footer.php';
?>
