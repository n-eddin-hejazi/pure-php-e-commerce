<?php 
global $pageTitle;
$pageTitle = 'Users';
include view_path() . 'admin/layouts/header.view.php'; ?>   
<br>

<a href="<?= admin_url() ?>/users/create">create new user</a>


<?php include view_path() . 'admin/layouts/footer.view.php'; ?>   