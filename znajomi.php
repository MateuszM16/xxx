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
                            <div class="y_kontener">
                            <div class="y">

                            <?php

                                    $login = $_SESSION['zalogowany-user'];

                                    require_once "polaczenie.php";
                                    mysqli_report(MYSQLI_REPORT_STRICT);

                                    echo "<a href='#' class='link_login_brak'> LISTA ZAPROSZEŃ DO ZNAJOMYCH: </a>";
                    
                                    try
                                    {
                                        $conn = new mysqli($servername, $username, $password, $dbname);
                                        if ($conn->connect_error)
                                            {
                                                throw new Exception(mysqli_connect_errno());
                                            }
                                        else
                                        {
                                            if($rezultat = $conn->query("SELECT LOGIN FROM uzytkownicy WHERE ID = (SELECT ZAPRASZAJACY FROM zaproszenia INNER JOIN uzytkownicy ON uzytkownicy.ID = PRZYJMUJACY WHERE PRZYJMUJACY = (SELECT ID FROM uzytkownicy WHERE LOGIN='$login'))"))
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
                                                    echo "<a href='#' class='link_login_brak'>Nie masz żadnych zaproszeń do przyjęcia</a>";
                                                }
   
                                            }
                                            else
                                            {
                                                throw new Exception($conn->connect_error);
                                            }

                                            echo "</div><div class='y'>";
                                            echo "<a href='#' class='link_login_brak'> LISTA ZAPROSZONYCH OSÓB: </a>";

                                            if($rezultat = $conn->query("SELECT LOGIN FROM uzytkownicy WHERE ID = (SELECT PRZYJMUJACY FROM zaproszenia INNER JOIN uzytkownicy ON uzytkownicy.ID = ZAPRASZAJACY WHERE ZAPRASZAJACY = (SELECT ID FROM uzytkownicy WHERE LOGIN='$login'))"))
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
                                                    echo "<a href='#' class='link_login_brak'>Nie masz żadnych wysłanych zaproszeń</a>";
                                                }
   
                                            }
                                            else
                                            {
                                                throw new Exception($conn->connect_error);
                                            }
                                            
                                            echo "</div><div class='y'>";
                                            echo "<a href='#' class='link_login_brak'> LISTA ZNAJOMYCH: </a>";

                                            if($rezultat = $conn->query("SELECT LOGIN FROM znajomi INNER JOIN uzytkownicy ON uzytkownicy.ID = ID_LOGIN_1 OR uzytkownicy.ID = ID_LOGIN_2 WHERE ID_LOGIN_1 = (SELECT ID FROM uzytkownicy WHERE LOGIN='$login') OR ID_LOGIN_2 = (SELECT ID FROM uzytkownicy WHERE LOGIN='$login')"))
                                            {
                                                if ($rezultat->num_rows > 0) 
                                                {
                                                    while($wiersz = $rezultat->fetch_assoc())
                                                    {
                                                        if($wiersz["LOGIN"]!=$login)
                                                        {
                                                            echo "<a href='profil.php?LOGIN=".$wiersz["LOGIN"]."' class='link_login'> <img class='zdj' src='./img/".$wiersz["LOGIN"].".jpg'  height='100' width='100'><div class='link_obok_zdj'> ".$wiersz["LOGIN"]."</div></a>";
                                                        }
    
                                                    }
                                                }
                                                else 
                                                {
                                                    echo "<a href='#' class='link_login_brak'>Nie posiadasz żadnych znajomych</a>";
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
                                
             
                            ?>

                            </div>
                            </div>

                            <div class="x">
                            </div>
                        </div>
                    </div>

                </div>
        </body>
    </html>
