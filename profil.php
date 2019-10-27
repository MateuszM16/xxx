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

                if((!isset($_GET['LOGIN']))&&(!isset($_SESSION['login_link'])))
                {
                    header('Location:tablica.php');
                }


            ?>

        </head>

        <body>
                <div class="strona"> 

                        <?php include "menu.php" ?>

                        <div class="log">
                            <div class="x"></div>
                            <div class=y_kontener>
                            <div class="y">

                                <?php

                                    require_once "polaczenie.php";
                                    mysqli_report(MYSQLI_REPORT_STRICT);

                                    $login = $_SESSION['zalogowany-user'];
                                    if(isset($_GET['LOGIN'])) $_SESSION['login_link'] = $_GET['LOGIN'];
                                    $login_link = $_SESSION['login_link'];

                                    $login = $_SESSION['zalogowany-user'];
                
                                    $zdj1 = "./img/".$login_link.".jpg";
                                    $zdj2 = "./img/profilowe.jpg";

                                    $zdj = file_exists($zdj1) ? $zdj1 : $zdj2; 


                                    try
                                    {
                                        $conn = new mysqli($servername, $username, $password, $dbname);
                                        if ($conn->connect_error)
                                            {
                                                throw new Exception(mysqli_connect_errno());
                                            }
                                        else
                                        {
                                            if($rezultat = $conn->query("SELECT *,TIMESTAMPDIFF(YEAR,URODZENIE,CURDATE()) AS WIEK FROM uzytkownicy WHERE ID = (SELECT ID FROM uzytkownicy WHERE LOGIN='$login_link')"))
                                            {
                                                if ($rezultat->num_rows > 0) 
                                                {
                                                        $wiersz = $rezultat->fetch_assoc();

                                                        echo "<div class='lewo'>";
                                                        echo "<img src='$zdj'  height='200' width='200'>";
                                                        echo "</div>";

                                                    
                                                        if($wiersz["PLEC"]=="K") $wiersz["PLEC"]="Kobieta";
                                                        else $wiersz["PLEC"]="Mężczyzna";

                                                        echo "<div class='prawo'>";
                                                        echo "<div class='login'> Login: ".$wiersz["LOGIN"]."</div>";
                                                        echo "<div class='opis'>".$wiersz["OPIS"]."</div>";
                                                        echo "</div>";
                                                        echo "<div class='informacje'>";
                                                        echo "<div class='naglowek'></div>";
                                                        echo "<div class='info'>";
                                                        echo "<div class='dane'> Płeć: ".$wiersz["PLEC"]."</div>";
                                                        echo "<div class='dane'> Data urodzenia: ".$wiersz["URODZENIE"]."</div>";
                                                        echo "<div class='dane'> Miejsce zamieszkania: ".$wiersz["MIEJSCOWOSC"]."</div>";
                                                        echo "<div class='dane'> Wiek: ".$wiersz["WIEK"]."</div>";
                                                        echo "<div class='dane'> Hobby: ".$wiersz["HOBBY"]."</div>";
                                                        echo "</div>";
                                                }
                                                else 
                                                {
                                                    throw new Exception($conn->connect_error);
                                                }
                                            }
                                            else
                                            {
                                                throw new Exception($conn->connect_error);
                                            }

                                            if($login!=$login_link)
                                            {

                                                if(isset($_POST['zapros_do_znajomych']))
                                                {

                                                    if($rezultat = $conn->query("SELECT * FROM znajomi WHERE ID_LOGIN_1 = (SELECT ID FROM uzytkownicy WHERE LOGIN='$login') AND ID_LOGIN_2 = (SELECT ID FROM uzytkownicy WHERE LOGIN='$login_link') OR ID_LOGIN_2 = (SELECT ID FROM uzytkownicy WHERE LOGIN='$login') AND ID_LOGIN_1 = (SELECT ID FROM uzytkownicy WHERE LOGIN='$login_link') "))
                                                        if ($rezultat->num_rows == 0) 
                                                        {
                                                            if($rezultat = $conn->query("INSERT INTO zaproszenia (ZAPRASZAJACY, PRZYJMUJACY)
                                                            VALUES ((SELECT ID FROM uzytkownicy WHERE LOGIN='$login'), (SELECT ID FROM uzytkownicy WHERE LOGIN='$login_link'))"))
                                                            {
                                                                unset($_POST['zapros_do_znajomych']);                                     
                                                            }
                                                            else 
                                                            {
                                                                throw new Exception($conn->connect_error);
                                                            }
                                                    }
                                                }

                                                if(isset($_POST['przyjmnij_do_znajomych']))
                                                {
                                                    if($rezultat = $conn->query("INSERT INTO znajomi (ID_LOGIN_1, ID_LOGIN_2)
                                                            VALUES ((SELECT ID FROM uzytkownicy WHERE LOGIN='$login'),(SELECT ID FROM uzytkownicy WHERE LOGIN='$login_link'))"))
                                                    {
                                                        if($rezultat = $conn->query("DELETE FROM zaproszenia WHERE ZAPRASZAJACY = (SELECT ID FROM uzytkownicy WHERE LOGIN='$login_link') AND PRZYJMUJACY = (SELECT ID FROM uzytkownicy WHERE LOGIN='$login') OR PRZYJMUJACY = (SELECT ID FROM uzytkownicy WHERE LOGIN='$login_link') AND ZAPRASZAJACY = (SELECT ID FROM uzytkownicy WHERE LOGIN='$login')"))
                                                        unset($_POST['przyjmnij_do_znajomych']);   
                                                    }
                                                                                        
                                                    else 
                                                    {
                                                        throw new Exception($conn->connect_error);
                                                    }
                                                }

                                                if(isset($_POST['usun_ze_znajomych']))
                                                {
                                                    if($rezultat = $conn->query("DELETE FROM znajomi WHERE ID_LOGIN_1 = (SELECT ID FROM uzytkownicy WHERE LOGIN='$login') AND ID_LOGIN_2 = (SELECT ID FROM uzytkownicy WHERE LOGIN='$login_link') OR ID_LOGIN_2 = (SELECT ID FROM uzytkownicy WHERE LOGIN='$login') AND ID_LOGIN_1 = (SELECT ID FROM uzytkownicy WHERE LOGIN='$login_link')"))
                                                    {
                                                        unset($_POST['usun_ze_znajomych']);   
                                                    }
                                                                                        
                                                    else 
                                                    {
                                                        throw new Exception($conn->connect_error);
                                                    }
                                                }

                                                if(isset($_POST['anuluj_zaproszenie']))
                                                {
                                                    if($rezultat = $conn->query("DELETE FROM zaproszenia WHERE ZAPRASZAJACY = (SELECT ID FROM uzytkownicy WHERE LOGIN='$login') AND PRZYJMUJACY = (SELECT ID FROM uzytkownicy WHERE LOGIN='$login_link')"))
                                                    {
                                                        unset($_POST['anuluj_zaproszenie']);   
                                                    }
                                                                                        
                                                    else 
                                                    {
                                                        throw new Exception($conn->connect_error);
                                                    }
                                                }

                                            

                                                    if($rezultat = $conn->query("SELECT * FROM zaproszenia WHERE PRZYJMUJACY = (SELECT ID FROM uzytkownicy WHERE LOGIN='$login') AND ZAPRASZAJACY = (SELECT ID FROM uzytkownicy WHERE LOGIN='$login_link')"))
                                                    if ($rezultat->num_rows > 0) 
                                                    {
                                                        $wiersz = $rezultat->fetch_assoc();

                                                        echo "<div class='znajomi'>";
                                                        echo "<form action='profil.php' method='post'>";
                                                        echo "<input type='submit' name='przyjmnij_do_znajomych' value='Przyjmnij do znajomych' class='zapros'>";
                                                        echo "</form>";
                                                        echo "</div>";
                                                    }  

                                                    else 
                                                    {
                                                        if($rezultat = $conn->query("SELECT * FROM zaproszenia WHERE ZAPRASZAJACY = (SELECT ID FROM uzytkownicy WHERE LOGIN='$login') AND PRZYJMUJACY = (SELECT ID FROM uzytkownicy WHERE LOGIN='$login_link')"))
                                                        {
                                                            if ($rezultat->num_rows > 0) 
                                                            {
                                                                $wiersz = $rezultat->fetch_assoc();

                                                                echo "<div class='znajomi'>";
                                                                echo "<form action='profil.php' method='post'>";
                                                                echo "<input type='submit' name='anuluj_zaproszenie' value='Anuluj zaproszenie' class='zapros'>";
                                                                echo "</form>";
                                                                echo "</div>";

                                                            }
                                                                    else 
                                                                    {
                                                                        if($rezultat = $conn->query("SELECT * FROM znajomi WHERE ID_LOGIN_1 = (SELECT ID FROM uzytkownicy WHERE LOGIN='$login') AND ID_LOGIN_2 = (SELECT ID FROM uzytkownicy WHERE LOGIN='$login_link') OR ID_LOGIN_2 = (SELECT ID FROM uzytkownicy WHERE LOGIN='$login') AND ID_LOGIN_1 = (SELECT ID FROM uzytkownicy WHERE LOGIN='$login_link') "))
                                                                            if ($rezultat->num_rows > 0) 
                                                                            {
                                                                                $wiersz = $rezultat->fetch_assoc();

                                                                                echo "<div class='znajomi'>";
                                                                                echo "<form action='profil.php' method='post'>";
                                                                                echo "<input type='submit' name='usun_ze_znajomych' value='Usuń ze znajomych' class='zapros'>";
                                                                                echo "</form>";
                                                                                echo "</div>";
                                                                            }
                                                                            else 
                                                                            {
                                                                                echo "<div class='znajomi'>";
                                                                                echo "<form action='profil.php' method='post'>";
                                                                                echo "<input type='submit' name='zapros_do_znajomych' value='Zapros do znajomych' class='zapros'>";
                                                                                echo "</form>";
                                                                                echo "</div>";
                                                                            }
                                                                    }
                                                        
                                                        }

                                                        $conn->close();
                                                    }
                                            }

                                            else
                                            {
                                                echo "<div class='znajomi'>";
                                                echo "<form action='edytuj_profil.php' method='post'>";
                                                echo "<input type='submit' name='przyjmnij_do_znajomych' value='Edytuj profil' class='zapros'>";
                                                echo "</form>";
                                                echo "</div>";
                                            }

                                    }  
                                    
                                }

                                    catch (Exception $e)
                                    {
                                        echo $e;
                                        die("<div class='server_blad'>Błąd połaczenia! Przepraszamy! Proszę spróbować za chwilę!</div>");
                                    }

                                ?>

                                
                            
                            </div>

                        </div>

                            <?php

                                 require_once "polaczenie.php";
                                 mysqli_report(MYSQLI_REPORT_STRICT);

                                 $login = $_SESSION['zalogowany-user'];

                 
                                 try
                                 {
                                     $conn = new mysqli($servername, $username, $password, $dbname);
                                     if ($conn->connect_error)
                                         {
                                             throw new Exception(mysqli_connect_errno());
                                         }
                                     else
                                     {

                                        if(isset($_POST['usun_post']))
                                        {

                                            $jaki_post = $_GET['ID'];
                                           
                                            if($rezultat = $conn->query("DELETE FROM posty WHERE ID = '$jaki_post'"))
                                            {
                                                unset($_POST['usun_post']);       
                                            }
                                            else 
                                            {
                                                throw new Exception($conn->connect_error);
                                            }
                                        }
                                        
                                        if(($login==$login_link)||($rezultat = $conn->query("SELECT * FROM znajomi WHERE ID_LOGIN_1 = (SELECT ID FROM uzytkownicy WHERE LOGIN='$login') AND ID_LOGIN_2 = (SELECT ID FROM uzytkownicy WHERE LOGIN='$login_link') OR ID_LOGIN_2 = (SELECT ID FROM uzytkownicy WHERE LOGIN='$login') AND ID_LOGIN_1 = (SELECT ID FROM uzytkownicy WHERE LOGIN='$login_link') ")))
                                        if ($rezultat->num_rows > 0) 
                                        {
                                            if($rezultat = $conn->query("SELECT TEKST,DATA,LOGIN, posty.ID FROM posty INNER JOIN uzytkownicy ON uzytkownicy.ID = posty.ID_LOGIN WHERE uzytkownicy.ID = (SELECT ID FROM uzytkownicy WHERE LOGIN='$login_link') ORDER BY DATA DESC"))
                                            {
                                                if ($rezultat->num_rows > 0) 
                                                {
                                                    while($wiersz = $rezultat->fetch_assoc())
                                                    {
                                                        echo "<div class='y'>";
                                                        echo "<div class='autor'>";
                                                        echo "<a href='profil.php?LOGIN=".$wiersz["LOGIN"]."' class='link_autor'><img class='zdj' src='$zdj'  height='30' width='30'>   ".$wiersz["LOGIN"]."</a>";
                                                        echo "<div class='data'>".$wiersz['DATA'];
                                                        echo "</div>";
                                                        if($login==$login_link) echo "<form action='profil.php?ID=".$wiersz['ID']."' method='post'> <input type='submit' name='usun_post' value='X' class='usun_post'></form>";
                                                        echo "</div>";
                                                        echo "<div class='tekst'>".$wiersz["TEKST"]."</div>";
                                                        echo "</div>";  
                                                    }
                                                }
                                                else 
                                                {
                                                        echo "<div class='y'>";
                                                        echo "<div class='autor'>";
                                                        echo "</div>";
                                                        echo "<div class='tekst'>";
                                                        echo "Brak postów do wyświetlenia";
                                                        echo "</div>";  
                                                        echo "</div>";
                                                }
                                            }
                                            else
                                            {
                                                throw new Exception($conn->connect_error);
                                            }
                
                                            $conn->close();
                                        }
                                        else
                                        {
                                            echo "<div class='y'>";
                                            echo "<div class='autor'>";
                                            echo "</div>";
                                            echo "<div class='tekst'>";
                                            if($login_link!=$login) echo "Dodaj do znajomych tego użytkownika aby móc zobaczyć jego posty";
                                            else echo "Brak postów do wyświetlenia";
                                            echo "</div>";  
                                            echo "</div>";
                                        }
                                    }
                                 }                  
              
                                catch (Exception $e)
								{
									die("<div class='server_blad'>Błąd połaczenia! Przepraszamy! Proszę spróbować za chwilę!</div>");
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
