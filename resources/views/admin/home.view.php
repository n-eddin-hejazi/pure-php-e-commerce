<?php 
global $pageTitle;
$pageTitle = 'Dashboard'; 
include view_path() . 'admin/layouts/header.view.php'; ?>   

<p><?= auth()->name ?></p>

<?php include view_path() . 'admin/layouts/footer.view.php'; ?>   