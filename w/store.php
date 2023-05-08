<!DOCTYPE html>
<html lang="en">
<?php
include('./template/webloader_o.php');
?>
    <head>
        <?php
            include('./template/head.php');
        ?>
        <title>Store</title>
    </head>
    <body style="background: #2b2a33;" onload="loadPageControl(); setVariables(); loadStoreElements();">
            <?php
                include('./template/common.php');
            ?>
            <div class="col py-3">
                <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-4 row-cols-xl-5 g-4 flex-wrap" id="_storeContainer">

                </div>
            </div>
        </div>
            <?php
            include('./template/webloader_e.php');
            ?>
    </body>
</html>
