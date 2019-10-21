<?php 

                session_start();

                if(!isset($_SESSION['zalogowany-user']))
                {
                    header('Location:logowanie.php');
                }

                if(isset($_POST['wyloguj']))
                {
                    unset($_POST['wyloguj']);
                    unset($_SESSION['zalogowany-user']);
                    header('Location:logowanie.php');
                }

                if(isset($_POST['post']))
                {
                    $post = strip_tags($_POST["post"]); 
                    $login = $_SESSION['zalogowany-user'];

                    require_once "polaczenie.php";
                    mysqli_report(MYSQLI_REPORT_STRICT);
    
                    try
                    {
                        $conn = new mysqli($servername, $username, $password, $dbname);
                        if ($conn->connect_errno!=0)
                            {
                                throw new Exception(mysqli_connect_errno());
                            }
                        else
                        {
                            if($rezultat = $conn->query("INSERT INTO posty (ID_LOGIN, TEKST, DATA)
                            VALUES ((SELECT ID FROM uzytkownicy WHERE LOGIN='$login'), '$post', CURRENT_TIMESTAMP())"))
                            {
                                echo "post dodany";
                            }
                            
                            else
                            {
                                throw new Exception($conn->error);
                            }

                            $conn->close();
                        }
                    }                  
 
                    catch(Expection $e)
                    {
                        echo '<span style="color:red;"> Błąd połaczenia! Przepraszamy! Proszę spróbować za chwilę!</span>';
                    }

                }
            ?>


<!doctype html>
    <html>
        <head>
            <meta charset="UTF-8">
            <title>Witaj</title>
            <link rel="stylesheet" href="style.css">
            <link rel="stylesheet" href="tablica.css">
            <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
            <meta name="description" content="Witaj" />

            

        </head>

        <body>
                <div class="strona"> 
                    <div class="nav">
                        <div class="pasek">
                            <div class="podziel"> </div>
                            <div class="podziel"><input type="search" placeholder="Szukaj znajomego..." name="wyszukaj" class="logowanie"></div>
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
                        <div class="pasek_pole"> </div>
                        <div class="log">
                            <div class="x"></div>
                            <div class="y">
                                <div class="napis">
                                    Witaj <?php echo $_SESSION['zalogowany-user']; ?>! Chcesz coś upublikować?
                                </div>

                                <div class="post">
                                    <form action="tablica.php" method="post">
                                        <textarea placeholder="Napisz nowy post..."  name="post" class="okno_post"></textarea>
                                </div>

                                <div class="dodaj_post">
                                        <input type="submit" name="dodaj" value="Dodaj post" class="zaloguj">
                                    </form>
                                </div>

                            </div>

                            <?php

                                 require_once "polaczenie.php";
                                 mysqli_report(MYSQLI_REPORT_STRICT);
                 
                                 try
                                 {
                                     $conn = new mysqli($servername, $username, $password, $dbname);
                                     if ($conn->connect_errno!=0)
                                         {
                                             throw new Exception(mysqli_connect_errno());
                                         }
                                     else
                                     {
                                         if($rezultat = $conn->query("SELECT TEKST,DATA,LOGIN FROM posty INNER JOIN uzytkownicy ON uzytkownicy.ID = posty.ID_LOGIN ORDER BY DATA DESC"))
                                         {
                                            if ($rezultat->num_rows > 0) 
                                            {
                                                while($wiersz = $rezultat->fetch_assoc())
                                                {
                                                    echo "<div class='y'>";
                                                    echo "<div class='autor'>";
                                                    echo "<a href='#' class='link_autor'>".$wiersz["LOGIN"]."</a>";
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
                                             throw new Exception($conn->error);
                                         }
             
                                         $conn->close();
                                     }
                                 }                  
              
                                 catch(Expection $e)
                                 {
                                     echo '<span style="color:red;"> Błąd połaczenia! Przepraszamy! Proszę spróbować za chwilę!</span>';
                                 }
             

                            ?>

                            <div class="x">
                            </div>
                        </div>
                    </div>

                </div>
        </body>
    </html>
