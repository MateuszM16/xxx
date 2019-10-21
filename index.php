<!doctype html>
    <html>
        <head>
            <meta charset="UTF-8">
            <title>Witaj</title>
            <link rel="stylesheet" href="style.css">
            <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
            <meta name="description" content="Witaj" />

            <?php 

                session_start();
				error_reporting(0);

                if(isset($_SESSION['zalogowany-user']))
                {
                    header('Location:tablica.php');
                }
                else
                {
                    header('Location:logowanie.php');
                }


            ?>

        </head>

        <body>
                   
        </body>
    </html>
