<?php
require_once '../../../controller/voyageC.php';
?>
<input id="searchInput" type="text" class="form-control" placeholder="Type here...">
<?php
if (isset($_POST['submit'])) {
    $search = $_POST['form-control'];
}
?>
