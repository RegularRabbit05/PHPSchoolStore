<!DOCTYPE html>
<html lang="en">
    <head>
        <?php
            include('./template/head.php');
        ?>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet">
        <script src="../js/cart.js"></script>
        <title>Cart</title>
    </head>
    <body style="background: #2b2a33;" onload="loadPageControl(); updateTotalPrice(); setVariables(); loadItems();">
                <?php
                    include('./template/webloader_o.php');
                ?>
                <?php
                    include('./template/common.php');
                ?>
                <div class="col py-3" style="font-family: 'Montserrat', sans-serif;">
                    <ul class="list-group" id="_cart">
                    </ul>
                    <br>
                    <br>
                    <br>
                    <br id="autoScrollBottom">
                    <div id="bottom" class="container fixed-bottom bg-secondary" style="border-top-left-radius: 10px; border-top-right-radius: 10px">
                        <h1>Total Price: € <null id="cartTotalPriceBar"></null></h1>
                        <div class="position-absolute top-50 end-0 translate-middle-y px-3">
                            <button type="button" class="btn btn-success" onclick="redirectCheckout();">Proceed to checkout</button>
                            <button type="button" class="btn btn-danger" onclick="askClearCart();">Clear Cart</button>
                        </div>
                    </div>
            </div>
        </div>
                <?php
                    include('./template/webloader_e.php');
                ?>
    </body>
</html>
