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
            ?>

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
                        <div class="log">
                            <div class="x"></div>
                            <div class="y">
                                <div class="napis">
                                    Witaj <?php echo $_SESSION['zalogowany-user']; ?>! Chcesz coś upublikować?
                                </div>

                                <div class="post">
                                    <textarea placeholder="Napisz nowy post..."  name="post" class="okno_post"></textarea>
                                </div>

                                <div class="dodaj_post">
                                    <form action="tablica.php" method="post">
                                        <input type="submit" name="dodaj" value="Dodaj post" class="zaloguj">
                                    </form>
                                </div>

                            </div>

                            <div class="y">
                                <div class="autor">
                                    <a href="#" class="link_autor">Mateusz</a>   10.11.2019 27.23
                                </div>
                                <div class="tekst">
                                    asdf asdfasfas  as fsadfasdk fsa f sadsa fasfsf fa fdsfg sd g dsg sdf g dsfg sd g sd fg dsfgsdfg sdfgsdf g sdf fgsdg
                                </div>  
                            </div>

                            <div class="y">
                            </div>

                            <div class="y">
                            </div>

                            <div class="y">
                            </div>

                            <div class="y">
                            </div>

                            <div class="y">
                            </div>

                            <div class="x">
                            </div>
                        </div>
                    </div>


                </div>
        </body>
    </html>
