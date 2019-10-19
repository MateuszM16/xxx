<!doctype html>
    <html>
        <head>
            <meta charset="UTF-8">
            <title>Witaj</title>
            <link rel="stylesheet" href="style.css">
            <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
            <meta name="description" content="Witaj" />

            <?php session_start(); ?>

        </head>

        <body>
                   <div class="strona"> 
                    <div class="nav">
                        <div class="p">
                            Witaj na naszym portalu :)
                        </div>
                        <div class="log">
                            <div class="x"></div>
                            <div class="y">
                                <div class="y-nowy">
                                    <?php echo $_SESSION['zalogowany-user'] ?>
                                        
                                </div>
                            </div>
                        </div>
                        <div class="x"></div>
                    </div>

                    </div>

                </div>
        </body>
    </html>
