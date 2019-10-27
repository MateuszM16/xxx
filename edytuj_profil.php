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
				error_reporting(1);

                if(!isset($_SESSION['zalogowany-user']))
                {
                    header('Location:logowanie.php');
                }

                $login = $_SESSION['zalogowany-user'];
                
                $zdj1 = "./img/".$login.".jpg";
                $zdj2 = "./img/profilowe.jpg";

                $zdj = file_exists($zdj1) ? $zdj1 : $zdj2; 

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

                                    require_once "polaczenie.php";
                                    mysqli_report(MYSQLI_REPORT_STRICT);

                                    $login = $_SESSION['zalogowany-user'];

                                    if(isset($_POST['zapisz']))
                                    {
                                        $poprawne_dane = true;

                                        $urodziny = strip_tags($_POST["urodziny"]);
                                        $plec = strip_tags($_POST["plec"]);
                                        $opis = strip_tags($_POST["opis"]);
                                        $miejscowosc = strip_tags($_POST["miejscowosc"]);
                                        $hobby = strip_tags($_POST["hobby"]);

                                        $data=date('U');
                                        $data2 = strtotime($urodziny);
                                        $mindata = strtotime('10.10.1920');
                                        if(($data2 > $data)||($data2<$mindata))
                                        {
                                            $poprawne_dane = false;
                                            $_SESSION['e_data_ur'] = "Podaj prawidłową date urodzenia";
                                        }


                                        function sprawdz_bledy()
                                        {
                                            if ($_FILES['plik']['error'] > 0)
                                            {
                                                
                                                switch ($_FILES['plik']['error'])
                                                {
                                                    case 1: {$_SESSION['e_plik'] = 'Rozmiar pliku jest zbyt duży.'; break;} 
                                                    case 2: {$_SESSION['e_plik'] = 'Rozmiar pliku jest zbyt duży.'; break;}
                                                    case 3: {$_SESSION['e_plik'] = 'Plik wysłany tylko częściowo.'; break;}
                                                    case 4: {$_SESSION['e_plik'] = 'Nie wysłano żadnego pliku.'; break;}
                                                    default: {$_SESSION['e_plik'] = 'Wystąpił błąd podczas wysyłania.';
                                                        break;}
                                                }
                                                return false;
                                            }
                                        return true;
                                        }

                                        function zapisz_plik()
                                                {
                                                $lokalizacja = "./img/".$_SESSION['zalogowany-user'].".jpg";
                                                if(is_uploaded_file($_FILES['plik']['tmp_name']))
                                                {
                                                    if(!move_uploaded_file($_FILES['plik']['tmp_name'], $lokalizacja))
                                                    {
                                                        $_SESSION['e_plik'] = 'problem: Nie udało się skopiować pliku do katalogu.';
                                                        return false;  
                                                    }
                                                }
                                                else
                                                {
                                                    $_SESSION['e_plik'] = 'problem: Możliwy atak podczas przesyłania pliku.';
                                                    $_SESSION['e_plik'] = 'Plik nie został zapisany.';
                                                    return false;
                                                }
                                                return true;
                                                }


                                                function sprawdz_typ()
                                                {
                                                    if ($_FILES['plik']['type'] != 'image/jpeg')
                                                        return false;
                                                    return true;
                                                }
                                                
                                    }

                                    
                                    try
                                    {
                                        $conn = new mysqli($servername, $username, $password, $dbname);
                                        if ($conn->connect_error)
                                            {
                                                throw new Exception(mysqli_connect_errno());
                                            }
                                        else
                                        {

                                            if((isset($_POST['zapisz']))&&($poprawne_dane==true))
                                            {
                                                if((sprawdz_bledy()==true)&&(sprawdz_typ()==true))
                                                {
                                                    zapisz_plik();
                                                }
                                                
                                                if($rezultat = $conn->query("UPDATE uzytkownicy SET PLEC = '$plec', URODZENIE = '$urodziny', OPIS = '$opis', MIEJSCOWOSC = '$miejscowosc', HOBBY = '$hobby' WHERE LOGIN = '$login'"))
                                                {
                                                    unset($_POST['zapisz']);    
                                                    header('Location:profil.php');                                
                                                }
                                                else 
                                                {
                                                    throw new Exception($conn->connect_error);
                                                }
                                            }

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

                                            if($rezultat = $conn->query("SELECT *,TIMESTAMPDIFF(YEAR,URODZENIE,CURDATE()) AS WIEK FROM uzytkownicy WHERE ID = (SELECT ID FROM uzytkownicy WHERE LOGIN='$login')"))
                                            {
                                                if ($rezultat->num_rows > 0) 
                                                {
                                                        $wiersz = $rezultat->fetch_assoc();

                                                        echo "<form enctype='multipart/form-data' action='edytuj_profil.php' method='post'>";

                                                        echo "<div class='lewo'>";
                                                        echo "<img src='$zdj' height='200' width='200'>";
                                                        echo "<br><br><input type='file' class='logowanie' name='plik'/>";
                                                        if(isset($_SESSION['e_plik']))
                                                        {
                                                            echo '<div class="error"> Problem: '.$_SESSION['e_plik'].'</div>';
                                                            unset($_SESSION['e_plik']);
                                                        }

                                                        echo "</div>";

                                                        echo "<div class='prawo'>";
                                                        echo "<div class='login'> Login: ".$wiersz["LOGIN"]."</div>";
                                                        echo "<div class='opis'><input type='text' class='okno_post' placeholder='Opisz siebie...' name='opis' autofocus value='".$wiersz["OPIS"]."'></div>";
                                                        echo "</div>";
                                                        echo "<div class='informacje'>";
                                                        echo "<div class='naglowek'></div>";
                                                        echo "<div class='info'>";
                                                        echo "<div class='dane'> Płeć: <br> <input type='radio' name='plec' value='K'";
                                                        if($wiersz['PLEC']==="K") echo "checked='checked'";
                                                        echo  "class='logowanie1'>Kobieta</br> <input type='radio' name='plec' value='M'";
                                                        if($wiersz['PLEC']==="M")  echo "checked='checked'";
                                                        echo "class='logowanie1'>Mężczyzna";
                                                        echo "<div class='dane'> <br>  Data urodzenia:<br> <input type='date' name='urodziny' class='logowanie' value='".$wiersz["URODZENIE"]."'>";
                                                        if(isset($_SESSION['e_data_ur']))
                                                        {
                                                            echo '<div class="error">'.$_SESSION['e_data_ur'].'</div>';
                                                            unset($_SESSION['e_data_ur']);
                                                        }
                                                        echo "</div>";
                                                        echo "<div class='dane'>  Miejscowość: <br> <input type='text' name='miejscowosc' class='logowanie' value='".$wiersz["MIEJSCOWOSC"]."'></div>";
                                                        echo "<div class='dane'> Wiek: <br> <input type='text' class='logowanie' disabled value='".$wiersz["WIEK"]."'></div>";
                                                        echo "<div class='dane'> Hobby: <br> <input type='text' name='hobby' class='logowanie' value='".$wiersz["HOBBY"]."'></div>";
                                                        echo "</div>";
                                                        echo "<div class='zapisz'><input type='submit' name='zapisz' value='Zapisz' class='zaloguj'></div>";
                                                        echo "</form>";
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
                                         if($rezultat = $conn->query("SELECT TEKST,DATA,LOGIN,posty.ID FROM posty INNER JOIN uzytkownicy ON uzytkownicy.ID = posty.ID_LOGIN WHERE uzytkownicy.ID = (SELECT ID FROM uzytkownicy WHERE LOGIN='$login') ORDER BY DATA DESC"))
                                         {
                                            if ($rezultat->num_rows > 0) 
                                            {
                                                while($wiersz = $rezultat->fetch_assoc())
                                                {
                                                    echo "<div class='y'>";
                                                    echo "<div class='autor'>";
                                                    echo "<a href='profil.php?LOGIN=".$wiersz["LOGIN"]."' class='link_autor'><img class='zdj' src=$zdj  height='30' width='30'>   ".$wiersz["LOGIN"]."</a>";
                                                    echo "<div class='data'>".$wiersz["DATA"];
                                                    echo "</div>";
                                                    echo "<form action='edytuj_profil.php?ID=".$wiersz['ID']."' method='post'> <input type='submit' name='usun_post' value='X' class='usun_post'></form>";
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
