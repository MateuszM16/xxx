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

                if(isset($_SESSION['zalogowany-user']))
                {
                    header('Location:tablica.php');
                }

                if(isset($_POST['email']))
                {

                    $poprawne_dane = true;

                    $login = strip_tags($_POST["login"]); 
                    $haslo = strip_tags($_POST["haslo"]);
                    $haslo2 = strip_tags($_POST["haslo2"]);
                    $email = strip_tags($_POST["email"]);
                    $urodziny = strip_tags($_POST["urodziny"]);
                    $plec = strip_tags($_POST["plec"]);

                    if((strlen($login)<=3)||(strlen($login)>30))
                    {
                        $poprawne_dane = false;
                        $_SESSION['e_login'] = "Login musi posiadać minimum 4 znaki";
                    }

                    if(ctype_alnum($login) == false)
                    {
                        $poprawne_dane = false;
                        $_SESSION['e_login'] = "Login może się składać tylko z liter i licz (bez polskich znaków)";
                    }

                    if(strlen($haslo)<=6)
                    {
                        $poprawne_dane = false;
                        $_SESSION['e_haslo'] = "Haslo musi posiadać minimum 6 znaków";
                    }
                    
                    if($haslo2 != $haslo)
                    {
                        $poprawne_dane = false;
                        $_SESSION['e_haslo2'] = "Hasła muszą być takie same";
                    }

                    
                    if($email=="")
                    {
                        $poprawne_dane = false;
                        $_SESSION['e_email'] = "Podaj poprawny adres e-mail";
                    }

                    $data=date('U');
                    $data2 = strtotime($urodziny);
                    $mindata = strtotime('10.10.1920');
                    if(($data2 > $data)||($data2<$mindata))
                    {
                        $poprawne_dane = false;
                        $_SESSION['e_data'] = "Podaj prawidłową date urodzenia";
                    }

                    if($plec == NULL)
                    {
                        $poprawne_dane = false;
                        $_SESSION['e_plec'] = "Podaj swoją płeć";
                    }

                    $_SESSION['z_login'] = $login;
                    $_SESSION['z_haslo'] = $haslo;
                    $_SESSION['z_haslo2'] = $haslo2;
                    $_SESSION['z_email'] = $email;
                    $_SESSION['z_urodziny'] = $urodziny;
                    $_SESSION['z_plec'] = $plec;

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
                            $rezultat = $conn->query("SELECT ID FROM uzytkownicy WHERE EMAIL='$email'");
                     
                            if (!$rezultat) throw new Exception($conn->error);
                            
                            $ile_takich_maili = $rezultat->num_rows;
                            if($ile_takich_maili>0)
                            {
                                $poprawne_dane = false;
                                $_SESSION['e_email']="Istnieje już konto przypisane do tego adresu e-mail!";
                            }  

                            $rezultat = $conn->query("SELECT ID FROM uzytkownicy WHERE LOGIN='$login'");
                 
                            if (!$rezultat) throw new Exception($conn->error);
                            
                            $ile_takich_nickow = $rezultat->num_rows;
                            if($ile_takich_nickow>0)
                            {
                                $poprawne_dane = false;
                                $_SESSION['e_login']="Istnije już taki użytkownik! Wybierz inny.";
                            }
 
                            if($poprawne_dane == true)
                            {
                                $haslo_hash = password_hash($haslo, PASSWORD_DEFAULT);

                                if($conn->query("INSERT INTO uzytkownicy (LOGIN, HASLO, EMAIL, URODZENIE, PLEC)
                                VALUES ('$login', '$haslo_hash', '$email', '$urodziny','$plec')"))
                                {
                                    unset($_POST['email']);
                                    header('Location:nowy.php');
                                }
                                else
                                {
                                    throw new Exception($conn->error);
                                }
                            
                            }

                            $conn->close();
                        }
                    }                  
 
                    catch(Expection $e)
                    {
                        echo '<span style="color:red;"> Błąd połaczenia! Przepraszamy! Proszę spróbować za chwilę!</span>';
                    }
                   
                }

                if(isset($_POST['login-l']))
                {
                    $login_l = strip_tags($_POST["login-l"]); 
                    $haslo_l = strip_tags($_POST["haslo-l"]);

                    $_SESSION['z_login-l']=$login_l;

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
                            if($rezultat = $conn->query("SELECT * FROM uzytkownicy WHERE LOGIN='$login_l'"))
                            {
                                $ile_uzytkownikow = $rezultat->num_rows;
                                if($ile_uzytkownikow>0)
                                {
                                    $wiersz = $rezultat->fetch_assoc();

                                    if(password_verify($haslo_l,$wiersz['HASLO']))
                                    {
                                        $_SESSION['zalogowany-user'] = $login_l;
                                        unset($_POST['login-l']);
                                        header('Location:tablica.php');     
                                    }
                                    else
                                    {
                                        $_SESSION['e_haslo-l']="Nie poprawne haslo";
                                    }

                                }
                                else
                                {
                                    $_SESSION['e_login-l']="Nie istnieje taki użytkownik";
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

            }

            ?>

            <script>
                
                function szukaj()
                {
                    x1 = document.getElementsByClassName("xy")[1];
                    x2 = document.getElementsByClassName("xy")[0];
                    x3 = document.getElementsByClassName("button")[0];
                    x4 = document.getElementsByClassName("button")[1];
                }

                function sprawdz()
                {
                    szukaj();

                    if(x1.style.display === "block")
                    {
                        x3.style.color = "white";
                        x4.style.color = "rgb(243, 101, 0)";
                        x4.style.background = "black";
                        x3.style.background = "gray";
                    }
                    else
                    {
                        x4.style.color = "white";
                        x3.style.color = "rgb(243, 101, 0)";
                        x3.style.background = "black";
                        x4.style.background = "gray";
                    }
                }
               
                function b1()
                {
                    szukaj();
                    x1.style.display = "block";
                    x2.style.display = "none";
                    sprawdz();
                }

                function b2()
                {
                    szukaj();
                    x1.style.display = "none";
                    x2.style.display = "block";
                    sprawdz();
                }


            </script>
    

        </head>

        <?php
             $ktore = $_POST["submit"]; 
             

             if($ktore == "Zarejestruj")
             {
                 echo "<body onload='b1()'>";
                 $_POST["submit"] = " ";
             }

             else
             {
                echo "<body onload='b2()'>";
                unset($_POST['email']);
             }

        ?>
                   <div class="strona"> 
                    <div class="nav">
                        <div class="p">
                            Witaj na naszym portalu :)
                        </div>
                        <div class="log">
                            <div class="x"></div>
                            <div class="y">
                                <div class="xx">
                                    <div class="button-zero"></div>
                                    <div class="button" onclick="b2()">Logowanie </div>
                                    <div class="button" onclick="b1()">Rejestracja </div>
                                </div>

                                <div class="xy">
                                    <form action="logowanie.php" method="post">
                                        <div class="l2">Login: </div>
                                        <div class="l1"><input type="text" name="login-l" value="<?php
                                            if(isset($_SESSION['z_login-l']))
                                            {
                                                echo $_SESSION['z_login-l'];
                                                unset($_SESSION['z_login-l']);
                                            }?>"class="logowanie"></div>
                                        <?php
                                                if(isset($_SESSION['e_login-l']))
                                                {
                                                    echo '<div class="error">'.$_SESSION['e_login-l'].'</div>';
                                                    unset($_SESSION['e_login-l']);
                                                }
                                            ?>
                                        <div class="l2">Hasło: </div>
                                        <div class="l1"><input type="password" name="haslo-l" class="logowanie"></div>
                                        <?php
                                                if(isset($_SESSION['e_haslo-l']))
                                                {
                                                    echo '<div class="error">'.$_SESSION['e_haslo-l'].'</div>';
                                                    unset($_SESSION['e_haslo-l']);
                                                }
                                            ?>
                                        <div class="x3"><input type="submit" name="submit" value="Zaloguj" class ="zaloguj"></div>
                                    </form>
                                    <br><br>
                                </div>
                                <div class="xy">
                                    <form action="logowanie.php" method="post">
                                        <div class="l2">Login: </div>
                                        <div class="l1"><input type="text" name="login" value="<?php
                                            if(isset($_SESSION['z_login']))
                                            {
                                                echo $_SESSION['z_login'];
                                                unset($_SESSION['z_login']);
                                            }
                                        ?>" class="logowanie"></div>
                                            <?php
                                                if(isset($_SESSION['e_login']))
                                                {
                                                    echo '<div class="error">'.$_SESSION['e_login'].'</div>';
                                                    unset($_SESSION['e_login']);
                                                }
                                            ?>
                                        <div class="l2">Hasło: </div>
                                        <div class="l1"><input type="password" name="haslo"  value="<?php
                                            if(isset($_SESSION['z_haslo']))
                                            {
                                                echo $_SESSION['z_haslo'];
                                                unset($_SESSION['z_haslo']);
                                            }
                                        ?>" class="logowanie"></div>
                                            <?php
                                                if(isset($_SESSION['e_haslo']))
                                                {
                                                    echo '<div class="error">'.$_SESSION['e_haslo'].'</div>';
                                                    unset($_SESSION['e_haslo']);
                                                }
                                            ?>
                                        <div class="l2">Powtórz hasło: </div>
                                        <div class="l1"><input type="password" name="haslo2"  value="<?php
                                            if(isset($_SESSION['z_haslo2']))
                                            {
                                                echo $_SESSION['z_haslo2'];
                                                unset($_SESSION['z_haslo2']);
                                            }
                                        ?>" class="logowanie"></div>
                                         <?php
                                                if(isset($_SESSION['e_haslo2']))
                                                {
                                                    echo '<div class="error">'.$_SESSION['e_haslo2'].'</div>';
                                                    unset($_SESSION['e_haslo2']);
                                                }
                                            ?>
                                        <div class="l2">E-mail: </div>
                                        <div class="l1"><input type="email" name="email"  value="<?php
                                            if(isset($_SESSION['z_email']))
                                            {
                                                echo $_SESSION['z_email'];
                                                unset($_SESSION['z_email']);
                                            }
                                        ?>" class="logowanie"></div>
                                        <?php
                                                if(isset($_SESSION['e_email']))
                                                {
                                                    echo '<div class="error">'.$_SESSION['e_email'].'</div>';
                                                    unset($_SESSION['e_email']);
                                                }
                                            ?>
                                        <div class="l2">Data urodzenia: </div>
                                        <div class="l1"><input type="date" name="urodziny"  value="<?php
                                            if(isset($_SESSION['z_urodziny']))
                                            {
                                                echo $_SESSION['z_urodziny'];
                                                unset($_SESSION['z_urodziny']);
                                            }
                                        ?>" class="logowanie"></div>
                                            <?php
                                                if(isset($_SESSION['e_data']))
                                                {
                                                    echo '<div class="error">'.$_SESSION['e_data'].'</div>';
                                                    unset($_SESSION['e_data']);
                                                }
                                            ?>
                                        <br>
                                        <div class="l2">Wybierz płeć:</div>
                                        <div class="l1"><input type="radio" name="plec" value="K" <?php if((isset($_SESSION['z_plec']))&&($_SESSION['z_plec']==="K")) echo 'checked="checked"'; ?> class="logowanie1">Kobieta</br> <input type="radio" name="plec" value="M" <?php if((isset($_SESSION['z_plec']))&&($_SESSION['z_plec']==="M")) echo 'checked="checked"'; ?> class="logowanie1">Mężczyzna</div>
                                            <?php
                                                unset($_SESSION['z_plec']);
                                                if(isset($_SESSION['e_plec']))
                                                {
                                                    echo '<div class="error">'.$_SESSION['e_plec'].'</div>';
                                                    unset($_SESSION['e_plec']);
                                                }
                                            ?>
                                        <div class="x3"><input type="submit" name="submit" value="Zarejestruj" class ="zaloguj"></div>
                                    </form>
                                    <br><br>
                                </div>
                        </div>
                        <div class="x"></div>
                    </div>

                    </div>

                </div>
        </body>
    </html>
