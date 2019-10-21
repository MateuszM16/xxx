<!doctype html>
    <html>
        <head>
            <meta charset="UTF-8">
            <title>Witaj</title>
            <link rel="stylesheet" href="style.css">
            <link rel="stylesheet" href="tablica.css">
            <link rel="stylesheet" href="szukaj_znajomego.css">
            <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
            <meta name="description" content="Witaj" />

            <?php 

                session_start();
				error_reporting(0);

                if(!isset($_SESSION['zalogowany-user']))
                {
                    header('Location:logowanie.php');
                }

            ?>

        </head>

        <body>
                <div class="strona"> 
                    <div class="nav">
                        <div class="pasek">
                            <div class="podziel"></div>

                            <form action="szukaj_znajomego.php" method="post">
                                <div class="podziel"><input type="search" placeholder="Szukaj znajomego..."  name="wyszukaj" incremental autofocus required class="logowanie"></div>
                            </form>

                            <div class="podziel">
                                <form action="tablica.php" method="post">
                                    <input type="submit" name="Profil" value="Profil" class="zaloguj">
                                </form>
                            </div>
                            <div class="podziel">
                                <form action="tablica.php" method="post">
                                    <input type="submit" name="wyloguj" value="Wyloguj" class="zaloguj">
                                </form>
                            </div>

                        </div>
                        <div class="pasek_pole"></div>
                        <div class="log">
                            <div class="x"></div>
                            <div class="y">

                            


                            <?php

                                if(isset($_POST['wyszukaj']))
                                {

                                    $wyszukaj = $_POST['wyszukaj'];

                                
                                    require_once "polaczenie.php";
                                    mysqli_report(MYSQLI_REPORT_STRICT);
                    
                                    try
                                    {
                                        $conn = new mysqli($servername, $username, $password, $dbname);
                                        if ($conn->connect_error)
                                            {
                                                throw new Exception(mysqli_connect_errno());
                                            }
                                        else
                                        {
                                            if($rezultat = $conn->query("SELECT LOGIN,ID FROM uzytkownicy WHERE LOGIN LIKE '%$wyszukaj%'"))
                                            {
                                                if ($rezultat->num_rows > 0) 
                                                {
                                                    while($wiersz = $rezultat->fetch_assoc())
                                                    {
                                                        
                                                    }
                                                }
                                                else 
                                                {
                                                   
                                                }
                                            }
                                            else
                                            {
                                                throw new Exception($conn->connect_error);
                                            }
                
                                            $conn->close();
                                        }
                                    }                  
                
                                    catch (Exception $e)
                                    {
                                        die("<div class='server_blad'>Błąd połaczenia! Przepraszamy! Proszę spróbować za chwilę!</div>");
                                    }
                                
                            }
             
                            ?>

                            </div>

                            <div class="x">
                            </div>
                        </div>
                    </div>

                </div>
        </body>
    </html>
