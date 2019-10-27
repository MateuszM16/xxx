<!doctype html>
    <html>
        <head>
            <meta charset="UTF-8">
            <title>Witaj</title>
            <link rel="stylesheet" href="style.css">
            <link rel="stylesheet" href="tablica.css">
            <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
            <meta name="description" content="Witaj" />
			
			<?php 
                session_start();
				
				error_reporting(0);

                if(!isset($_SESSION['zalogowany-user']))
                {
                    header('Location:logowanie.php');
                }

                if(isset($_POST['wyloguj']))
                {
                    unset($_POST['wyloguj']);
                    unset($_SESSION['zalogowany-user']);
					session_destroy();
                    header('Location:logowanie.php');
                }

                $login = $_SESSION['zalogowany-user']; 

                if(isset($_POST['text_post']))
                {
                    $post = strip_tags($_POST["text_post"]);
                    $login = $_SESSION['zalogowany-user'];

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
                            if($rezultat = $conn->query("INSERT INTO posty (ID_LOGIN, TEKST, DATA)
                            VALUES ((SELECT ID FROM uzytkownicy WHERE LOGIN='$login'), '$post', CURRENT_TIMESTAMP())"))
                            {
								unset($_POST['text_post']);
								unset($post);
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

        </head>

        <body>
                <div class="strona"> 
                    <?php include "menu.php" ?>
                        <div class="log">
                            <div class="x"></div>
                            <div class=y_kontener>
                            <div class="y">
                                <div class="napis">
                                    Witaj <?php echo $_SESSION['zalogowany-user']; ?>! Chcesz coś upublikować?
                                </div>

                                <div class="post">
                                    <form action="tablica.php" method="post">
                                        <input type="text" placeholder="Napisz nowy post..."  name="text_post" class="okno_post" autofocus required>
                                </div>

                                <div class="dodaj_post">
                                        <input type="submit" name="dodaj" value="Dodaj post" class="zaloguj">
                                    </form>
                                </div>


                            </div>

                            <?php

                                $login = $_SESSION['zalogowany-user'];

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

                                        $sql1 = "SELECT TEKST,DATA,LOGIN,uzytkownicy.ID,posty.ID FROM znajomi,posty INNER JOIN uzytkownicy ON uzytkownicy.ID = posty.ID_LOGIN WHERE (uzytkownicy.ID = ID_LOGIN_1 AND ID_LOGIN_2 = (SELECT ID FROM uzytkownicy WHERE LOGIN='$login') OR uzytkownicy.ID = ID_LOGIN_2 AND ID_LOGIN_1 = (SELECT ID FROM uzytkownicy WHERE LOGIN='$login')) UNION ALL ( SELECT TEKST,DATA,LOGIN,uzytkownicy.ID,posty.ID FROM posty INNER JOIN uzytkownicy ON uzytkownicy.ID = posty.ID_LOGIN WHERE uzytkownicy.ID = (SELECT ID FROM uzytkownicy WHERE LOGIN='$login')) ORDER BY DATA DESC";
                                        $sql2 = "SELECT TEKST,DATA,LOGIN,uzytkownicy.ID,posty.ID FROM znajomi,posty INNER JOIN uzytkownicy ON uzytkownicy.ID = posty.ID_LOGIN ORDER BY DATA DESC";

                                        if($_SESSION['admin']=="TAK")
                                        {
                                            $sql = $sql2;
                                        }
                                        else
                                        {
                                            $sql = $sql1;
                                        }

                                         if($rezultat = $conn->query($sql))
                                         {
                                            if ($rezultat->num_rows > 0) 
                                            {
                                                while($wiersz = $rezultat->fetch_assoc())
                                                {
                                                    $zdj1 = "./img/".$wiersz["LOGIN"].".jpg";
                                                    $zdj2 = "./img/profilowe.jpg";

                                                    $zdj = file_exists($zdj1) ? $zdj1 : $zdj2; 

                                                    echo "<div class='y'>";
                                                    echo "<div class='autor'>";
                                                    echo "<a href='profil.php?LOGIN=".$wiersz["LOGIN"]."' class='link_autor'><img class='zdj' src='$zdj'  height='30' width='30'>   ".$wiersz["LOGIN"]."</a>";
                                                    echo "<div class='data'>".$wiersz["DATA"];
                                                    echo "</div>";
                                                    if(($login==$wiersz["LOGIN"])||($_SESSION['admin']=="TAK")) echo "<form action='tablica.php?ID=".$wiersz['ID']."' method='post'> <input type='submit' name='usun_post' value='X' class='usun_post'></form>";
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

                            </div>

                            <div class="x">
                            </div>
                        </div>
                    </div>

                </div>
        </body>
    </html>
