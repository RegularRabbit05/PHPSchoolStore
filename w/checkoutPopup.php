<html lang="en">
    <head>
        <?php
        include('./template/head.php');
        ?>
        <script src="../js/json2.js"></script>
        <script src="../js/cart.js"></script>
        <script src="../js/checkout.js"></script>
        <title>
            Payment Informations
        </title>
        <style>
            .payment-form{
                padding-bottom: 50px;
                font-family: 'Montserrat', sans-serif;
            }

            .payment-form.dark{
                background-color: #2b2a33;
            }

            .payment-form .content{
                box-shadow: 0px 2px 10px rgba(0, 0, 0, 0.075);
                background-color: white;
            }

            .payment-form .block-heading{
                padding-top: 50px;
                margin-bottom: 40px;
                text-align: center;
            }

            .payment-form .block-heading p{
                text-align: center;
                max-width: 420px;
                margin: auto;
                opacity:0.7;
            }

            .payment-form.dark .block-heading p{
                opacity:0.8;
            }

            .payment-form .block-heading h1,
            .payment-form .block-heading h2,
            .payment-form .block-heading h3 {
                margin-bottom:1.2rem;
                color: #3b99e0;
            }

            .payment-form form{
                border-top: 2px solid #5ea4f3;
                box-shadow: 0px 2px 10px rgba(0, 0, 0, 0.075);
                background-color: #524e61; //ffffff;
                padding: 0;
                max-width: 600px;
                margin: auto;
            }

            .payment-form .title{
                font-size: 1em;
                border-bottom: 1px solid rgba(0,0,0,0.1);
                margin-bottom: 0.8em;
                font-weight: 600;
                padding-bottom: 8px;
            }

            .payment-form .products{
                background-color: #82808c; //#f7fbff;
                padding: 25px;
            }

            .payment-form .products .item{
                margin-bottom:1em;
            }

            .payment-form .products .item-name{
                font-weight:600;
                font-size: 0.9em;
            }

            .payment-form .products .item-description{
                font-size:0.8em;
                opacity:0.6;
            }

            .payment-form .products .item p{
                margin-bottom:0.2em;
            }

            .payment-form .products .price{
                float: right;
                font-weight: 600;
                font-size: 0.9em;
            }

            .payment-form .products .total{
                border-top: 1px solid rgba(0, 0, 0, 0.1);
                margin-top: 10px;
                padding-top: 19px;
                font-weight: 600;
                line-height: 1;
            }

            .payment-form .card-details{
                padding: 25px 25px 15px;
            }

            .payment-form .card-details label{
                font-size: 12px;
                font-weight: 600;
                margin-bottom: 15px;
                color: #79818a;
                text-transform: uppercase;
            }

            .payment-form .card-details button{
                margin-top: 0.6em;
                padding:12px 0;
                font-weight: 600;
            }

            .payment-form .date-separator{
                margin-left: 10px;
                margin-right: 10px;
                margin-top: 5px;
            }

            @media (min-width: 576px) {
                .payment-form .title {
                    font-size: 1.2em;
                }

                .payment-form .products {
                    padding: 40px;
                }

                .payment-form .products .item-name {
                    font-size: 1em;
                }

                .payment-form .products .price {
                    font-size: 1em;
                }

                .payment-form .card-details {
                    padding: 40px 40px 30px;
                }

                .payment-form .card-details button {
                    margin-top: 2em;
                }
            }
        </style>
        <script>
            function loadPageControlCheckout() {
                let usr = getCookie("user");
                let pwd = getCookie("password");
                if (pwd == null || pwd == "" || usr == null || usr == "") {
                    window.location = window.location.origin;
                    return;
                }
            }
        </script>
        <link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta charset="utf-8">
    </head>
    <body style="background: #2b2a33;" onload="loadPageControlCheckout(); checkoutPopupState(); setupCheckoutPage();">
    <main class="page payment-page">
        <section class="payment-form dark">
            <div class="container">
                <div class="block-heading">
                    <h2>Payment</h2>
                </div>
                <form>
                    <div class="products">
                        <h3 class="title">Checkout</h3>
                        <div id="checkoutListItems">
                        </div>
                        <div class="total">Total<span class="price" id="checkoutListPrice"></span></div>
                    </div>
                    <div class="card-details">
                        <h3 class="title">Credit Card Details [Locked]</h3>
                        <div class="row">
                            <div class="form-group col-sm-7">
                                <label for="card-holder">Card Holder</label>
                                <input disabled id="card-holder" type="text" class="form-control" placeholder="Card Holder" aria-label="Card Holder" aria-describedby="basic-addon1">
                            </div>
                            <div class="form-group col-sm-5">
                                <label for="">Expiration Date</label>
                                <div class="input-group expiration-date">
                                    <input disabled type="text" class="form-control" placeholder="MM" aria-label="MM" aria-describedby="basic-addon1">
                                    <span class="date-separator">/</span>
                                    <input disabled type="text" class="form-control" placeholder="YY" aria-label="YY" aria-describedby="basic-addon1">
                                </div>
                            </div>
                            <div class="form-group col-sm-8">
                                <label for="card-number">Card Number</label>
                                <input disabled id="card-number" type="text" class="form-control" placeholder="Card Number" aria-label="Card Holder" aria-describedby="basic-addon1">
                            </div>
                            <div class="form-group col-sm-4">
                                <label for="cvc">CVC</label>
                                <input disabled id="cvc" type="text" class="form-control" placeholder="CVC" aria-label="Card Holder" aria-describedby="basic-addon1">
                            </div>
                            <div class="form-group col-sm-12">
                                <button id="autoScrollBottom" onclick="checkoutPopupConfirmButton();" type="button" class="btn btn-primary btn-block px-3">Proceed</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </section>
    </main>
    </body>
</html>
