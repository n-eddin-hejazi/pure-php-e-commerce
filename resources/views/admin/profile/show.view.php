<?php 
global $pageTitle;
$pageTitle = 'Profile ' . $_SESSION['name']; 
include view_path() . 'admin/layouts/header.view.php'; ?>   

<p><?= $_SESSION['name'] ?></p>

<?php include view_path() . 'admin/layouts/footer.view.php'; ?>   