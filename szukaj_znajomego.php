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

                        <?php include "menu.php" ?>

                        <div class="log">
                            <div class="x"></div>
                            <div class="y">

                            <?php

                                if(isset($_POST['wyszukaj']))
                                {

                                    $wyszukaj = strip_tags($_POST['wyszukaj']);
                                    
                                    echo "<a href='#' class='link_login_brak'> Wyniki wyszukiwania dla '".$wyszukaj."'"."</a>";

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
                                                        echo "<a href='profil.php?LOGIN=".$wiersz["LOGIN"]."' class='link_login'> <img class='zdj' src='./img/".$wiersz["LOGIN"].".jpg'  height='100' width='100'><div class='link_obok_zdj'> ".$wiersz["LOGIN"]."</div></a>";
                                                    }
                                                }
                                                else 
                                                {
                                                    echo "<a href='#' class='link_login_brak'>Nie znaleziona użytkownika</a>";
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
