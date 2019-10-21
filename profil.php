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
                                <div class="lewo">
                                    <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQYdAV2YBvffsnCsvkh6XXpkFvB_9m_jaVa5Al3tQk_IZ3lLfvP"  height="200" width="200">
                                </div>

                                <div class="prawo">

                                <?php

                                    require_once "polaczenie.php";
                                    mysqli_report(MYSQLI_REPORT_STRICT);

                                    $login = $_SESSION['zalogowany-user'];
                                    if(isset($_GET['LOGIN'])) $_SESSION['login_link'] = $_GET['LOGIN'];
                                    $login_link = $_SESSION['login_link'];

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
                                                        if($wiersz["PLEC"]=="K") $wiersz["PLEC"]="Kobieta";
                                                        else $wiersz["PLEC"]="Mężczyzna";
                                                

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

                                            $conn->close();
                                        }
                                    }                  

                                    catch (Exception $e)
                                    {
                                        die("<div class='server_blad'>Błąd połaczenia! Przepraszamy! Proszę spróbować za chwilę!</div>");
                                    }

                                ?>

                                <div class='znajomi'>
                                    <form action="profil.php" method="post">
                                        <input type="submit" name="znajomi" value="Zaproś do znajomych" class="zapros">
                                    </form>
                                </div>
 
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
                                         if($rezultat = $conn->query("SELECT TEKST,DATA,LOGIN FROM posty INNER JOIN uzytkownicy ON uzytkownicy.ID = posty.ID_LOGIN WHERE uzytkownicy.ID = (SELECT ID FROM uzytkownicy WHERE LOGIN='$login_link') ORDER BY DATA DESC"))
                                         {
                                            if ($rezultat->num_rows > 0) 
                                            {
                                                while($wiersz = $rezultat->fetch_assoc())
                                                {
                                                    echo "<div class='y'>";
                                                    echo "<div class='autor'>";
                                                    echo "<a href='profil.php?LOGIN=".$wiersz["LOGIN"]."' class='link_autor'>".$wiersz["LOGIN"]."</a>";
                                                    echo "<div class='data'>".$wiersz["DATA"]."</div>";
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
                                 }                  
              
                                catch (Exception $e)
								{
									die("<div class='server_blad'>Błąd połaczenia! Przepraszamy! Proszę spróbować za chwilę!</div>");
								}
             
                            ?>

                            <div class="x">
                            </div>
                        </div>
                    </div>

                </div>
        </body>
    </html>
