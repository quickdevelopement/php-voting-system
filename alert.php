<?php
if (isset($_GET["error"])) {
    ?>
    <div id="alert" class="bg-red-500 border border-red-700  px-4 py-3 rounded absolute top-0 right-0">
        <p class="text-red-100"><?php echo $_GET["error"]; ?></p>
    </div>
    <?php
}elseif (isset($_GET["success"])) {
    ?>
    <div id="alert" class="bg-green-500 border border-green-700  px-4 py-3 rounded absolute top-0 right-0">
        <p class="text-green-100"><?php echo $_GET["success"]; ?></p>
    </div>
    <?php
}
?>