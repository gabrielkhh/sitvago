<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->


<html>

    <head>

        <title>Sitvago's FAQ </title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <!-- Bootstrap CSS only -->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">

        <!-- Font and Icons CSS -->
        <link href='http://fonts.googleapis.com/css?family=Oswald:400,300,700' rel='stylesheet' type='text/css'>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">


        <!--jQuery-->
        <script defer src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous">
        </script>

        <!-- Bootstrap -->
        <script defer src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js" integrity="sha384-6khuMg9gaYr5AxOqhkVIODVIvm9ynTT5J4V1cfthmT+emCG6yVmEZsRHdxlotUnm" crossorigin="anonymous">
        </script>



        <style>
            .bd-placeholder-img {
                font-size: 1.125rem;
                text-anchor: middle;
                -webkit-user-select: none;
                -moz-user-select: none;
                -ms-user-select: none;
                user-select: none;
            }

            @media (min-width: 768px) {
                .bd-placeholder-img-lg {
                    font-size: 3.5rem;
                }
            }

            .jumbotron {
                background: url(../images/home_cover.jpg) no-repeat center center fixed;
                -webkit-background-size: cover;
                -moz-background-size: cover;
                background-size: cover;
                -o-background-size: cover;
            }


        </style>
        <!-- Custom styles for this template -->
        <link href="css/faq.css" rel="stylesheet">

    </head>

    <body>
        <?php
        session_start();
        if (isset($_SESSION['username'])) {
            include "navbar_User.php";
        } else if (!isset($_SESSION['username'])) {
            include "navbar_nonUser.php";
        }
        ?>
        <main>
            <div class="container">
                <div class="container p-5 my-5 border-0 text-center">
                    <h1 class=display-3>Welcome to Sitvago's FAQ</h1>
                    <p>You can find common questions regarding our website here</p>
                </div>

                <div class="" id="accordion">
                    <div class="faqHeader">General questions</div>
                    <div class="card ">
                        <div class="card-header">
                            <h4 class="card-header">
                                <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#collapseOne">How to login?</a>
                            </h4>
                        </div>
                        <div id="collapseOne" class="panel-collapse collapse in">
                            <div class="card-block">
                                First, account registration is needed. You can click on login, see top right in the navbar <strong>"Login"</strong>.
                                You will be ask to register for an account if you do not have one. It's that simple :) 
                            </div>
                        </div>
                    </div>
                    <div class="card ">
                        <div class="card-header">
                            <h4 class="card-header">
                                <a class="accordion-toggle collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseTen">How to book a hotel?</a>
                            </h4>
                        </div>
                        <div id="collapseTen" class="panel-collapse collapse">
                            <div class="card-block">
                                You must login first, then can book! 
                            </div>
                        </div>
                    </div>
                    <div class="card ">
                        <div class="card-header">
                            <h4 class="card-header">
                                <a class="accordion-toggle collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseEleven">Must I have an account to book?</a>
                            </h4>
                        </div>
                        <div id="collapseEleven" class="panel-collapse collapse">
                            <div class="card-block">
                                All prices for themes, templates and other items, including each seller's or buyer's account balance are in <strong>USD</strong>
                            </div>
                        </div>
                    </div>

                    <div class="faqHeader">What else to put?</div>
                    <div class="card ">
                        <div class="card-header">
                            <h4 class="card-header">
                                <a class="accordion-toggle collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo">Ideas ideas?</a>
                            </h4>
                        </div>
                        <div id="collapseTwo" class="panel-collapse collapse">
                            <div class="card-block">
                                Any registed user, who presents a work, which is genuine and appealing, can post it on <strong>PrepBootstrap</strong>.
                            </div>
                        </div>
                    </div>
                    <div class="card ">
                        <div class="card-header">
                            <h4 class="card-header">
                                <a class="accordion-toggle collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseThree">Hotel cheap or not?</a>
                            </h4>
                        </div>
                        <div id="collapseThree" class="panel-collapse collapse">
                            <div class="card-block">
                                The steps involved in this process are really simple. All you need to do is:
                                <ul>
                                    <li>Register an account</li>
                                    <li>Activate your account</li>
                                    <li>Go to the <strong>Themes</strong> section and upload your theme</li>
                                    <li>The next step is the approval step, which usually takes about 72 hours.</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="card ">
                        <div class="card-header">
                            <h4 class="card-header">
                                <a class="accordion-toggle collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseFive">How much do I get from each sale?</a>
                            </h4>
                        </div>
                        <div id="collapseFive" class="panel-collapse collapse">
                            <div class="card-block">
                                Here, at <strong>PrepBootstrap</strong>, we offer a great, 70% rate for each seller, regardless of any restrictions, such as volume, date of entry, etc.
                                <br />
                            </div>
                        </div>
                    </div>
                    <div class="card ">
                        <div class="card-header">
                            <h4 class="card-header">
                                <a class="accordion-toggle collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseSix">Why sell my items here?</a>
                            </h4>
                        </div>
                        <div id="collapseSix" class="panel-collapse collapse">
                            <div class="card-block">
                                There are a number of reasons why you should join us:
                                <ul>
                                    <li>A great 70% flat rate for your items.</li>
                                    <li>Fast response/approval times. Many sites take weeks to process a theme or template. And if it gets rejected, there is another iteration. We have aliminated this, and made the process very fast. It only takes up to 72 hours for a template/theme to get reviewed.</li>
                                    <li>We are not an exclusive marketplace. This means that you can sell your items on <strong>PrepBootstrap</strong>, as well as on any other marketplate, and thus increase your earning potential.</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="card ">
                        <div class="card-header">
                            <h4 class="card-header">
                                <a class="accordion-toggle collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseEight">What are the payment options?</a>
                            </h4>
                        </div>
                        <div id="collapseEight" class="panel-collapse collapse">
                            <div class="card-block">
                                The best way to transfer funds is via Paypal. This secure platform ensures timely payments and a secure environment. 
                            </div>
                        </div>
                    </div>
                    <div class="card ">
                        <div class="card-header">
                            <h4 class="card-header">
                                <a class="accordion-toggle collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseNine">When do I get paid?</a>
                            </h4>
                        </div>
                        <div id="collapseNine" class="panel-collapse collapse">
                            <div class="card-block">
                                Our standard payment plan provides for monthly payments. At the end of each month, all accumulated funds are transfered to your account. 
                                The minimum amount of your balance should be at least 70 USD. 
                            </div>
                        </div>
                    </div>

                    <div class="faqHeader">Buyers</div>
                    <div class="card ">
                        <div class="card-header">
                            <h4 class="card-header">
                                <a class="accordion-toggle collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseFour">I want to buy a theme - what are the steps?</a>
                            </h4>
                        </div>
                        <div id="collapseFour" class="panel-collapse collapse">
                            <div class="card-block">
                                Buying a theme on <strong>PrepBootstrap</strong> is really simple. Each theme has a live preview. 
                                Once you have selected a theme or template, which is to your liking, you can quickly and securely pay via Paypal.
                                <br />
                                Once the transaction is complete, you gain full access to the purchased product. 
                            </div>
                        </div>
                    </div>
                    <div class="card ">
                        <div class="card-header">
                            <h4 class="card-header">
                                <a class="accordion-toggle collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseSeven">Is this the latest version of an item</a>
                            </h4>
                        </div>
                        <div id="collapseSeven" class="panel-collapse collapse">
                            <div class="card-block">
                                Each item in <strong>PrepBootstrap</strong> is maintained to its latest version. This ensures its smooth operation.
                            </div>
                        </div>
                    </div>
                    <div class="container p-5 my-5 border-0"></div>
                </div>
            </div>
        </main>
    </body>
    <footer class="container">
        <p>&copy; Sitvago 2020</p>
    </footer>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script>window.jQuery || document.write('<script src="../assets/js/vendor/jquery.slim.min.js"><\/script>')</script><script src="../assets/dist/js/bootstrap.bundle.min.js"></script>
</html>


