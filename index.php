<?php
include_once('./libs/globals.php');

if(isset($_REQUEST['page'])) $page = $_REQUEST['page'];
else $page = '';
?>
<!DOCTYPE html>
<html lang="de">
    
    <head>
        <!-- <Charset UTF-8 (alternativ iso-8859-1)> -->
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- <Seitentitel> -->
        <title>Support - Forum</title>
        
        <!-- <Bootstrap Stylesheet> -->
        <link href="./frontend/css/bootstrap.min.css" rel="stylesheet" />

        <!-- <Bootstrap Stylesheet (Superhero)> -->
        <link href="https://maxcdn.bootstrapcdn.com/bootswatch/3.3.7/superhero/bootstrap.min.css" rel="stylesheet" />

        <!-- <Fontawesome Stylesheet> -->
        <link href="./frontend/css/font-awesome.min.css" rel="stylesheet" />

        <!-- <HTML5 Elemente für IE> -->
        <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
          <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
        
        <!-- <Self Stylesheet> -->
        <link href="./frontend/css/self.css" rel="stylesheet" />
    </head>
    
    <body>
        <!-- <Navigation> -->
        <nav class="navbar navbar-inverse navbar-fixed-top">
            <div class="container">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="index.php">Projekt Name</a>
                </div>
                <div id="navbar" class="collapse navbar-collapse">
                    <ul class="nav navbar-nav">
                        <li class="active"><a href="index.php">Startseite</a></li>
                        <li><a href="index.php?page=newCat">Kategorie</a></li>
                        <li><a href="index.php?page=newBoard">Foren</a></li>
                        <li><a href="index.php?page=newThread">Themen</a></li>
                    </ul>
                    <ul class="nav navbar-nav pull-right">
                        <li><a href="index.php#register" data-toggle="modal" data-target="#register">Registieren</a></li>
                        <li><a href="index.php#login" data-toggle="modal" data-target="#login">Einloggen</a></li>
                        <li><a href="#">Benutzername</a></li>
                        <li><a href="#">Ausloggen</a></li>
                    </ul>
                </div>
                <!--/.nav-collapse -->
            </div>
        </nav>
        
        <!-- MODAL REIGSTER -->
        <div class="modal fade" id="register" tabindex="-1" role="dialog" aria-labelledby="registerLabel">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Schließen">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        <h4 class="modal-title" id="registerLabel">Registrieren</h4>
                    </div>
                    <form class="form-horizontal" role="form" id="formRegister">
                        <div class="modal-body">
                            <div id="error"></div>
                            <div class="form-group">
                                <label for="username">Benutzername*:</label>
                                <input id="username" name="username" type="text" class="form-control input-sm" placeholder="Benutzername" />
                            </div>
                            <div class="form-group">
                                <label for="passwd1">Passwort*:</label>
                                <input id="passwd1" name="passwd1" type="password" class="form-control input-sm" placeholder="Passwort" />
                            </div>
                            <div class="form-group">
                                <label for="passwd2">Passwort wiederholen*:</label>
                                <input id="passwd2" name="passwd2" type="password" class="form-control input-sm" placeholder="Passwort wiederholen" />
                            </div>
                            <div class="form-group">
                                <label for="mailer">Email-Adresse*:</label>
                                <input id="mailer" name="mailer" type="email" class="form-control input-sm" placeholder="Email-Adresse" />
                            </div>
                        </div>
                        <div class="modal-footer">
                            <div class="pull-left">
                                <button type="submit" class="btn btn-success btn-sm" name="sendRegister" id="sendRegister" data-toggle="modal" data-target="#succRegister">
                                    <span class="glyphicon glyphicon-log-in"></span> &nbsp; Account Erstellen
                                </button>
                            </div>
                            <div class="pull-right">
                                <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-dismiss="modal" data-target="#login" id="loggedin" name="loggedin">Einloggen</button>
                                <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-dismiss="modal">Schlie&szlig;en</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div><!-- MODAL REGISTER END //-->
        
        <!-- MODAL LOGIN -->
        <div class="modal fade" id="login" tabindex="-1" role="dialog" aria-labelledby="loginLabel">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Schließen">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        <h4 class="modal-title" id="loginLabel">Einloggen</h4>
                    </div>
                    <form class="form-horizontal" role="form" id="formLogin" method="POST">
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="username">Benutzername*:</label>
                                <input id="username" name="username" type="text" class="form-control input-sm" placeholder="Benutzername" required />
                            </div>
                            <div class="form-group">
                                <label for="passwd">Passwort*:</label>
                                <input id="passwd" name="passwd" type="password" class="form-control input-sm" placeholder="Passwort" required />
                            </div>
                            <div class="checkboxes">
                                <p>Automatisch Einloggen?</p>
                                <input id="checkbox" name="autoLogin" type="checkbox" checked />
                                <label for="checkbox"></label>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <div class="pull-left">
                                <input type="submit" name="sendLogin" class="btn btn-success btn-sm" data-toggle="modal" data-target="#succLogin" id="sendLogin" value="Einloggen" />
                                <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-dismiss="modal" data-target="#forgot">Zugangsdaten?</button>
                            </div>
                            <div class="pull-right">
                                <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-dismiss="modal" data-target="#register">Registrieren</button>
                                <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal">Schlie&szlig;en</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div><!-- MODAL LOGIN END //-->

        <!-- <Content Container> -->
        <div class="container fMain">
            <h1>Support - Forum</h1>
            <p class="lead">Das ist das Support Forum</p>
        </div>
        <!-- /.container -->

        <?php
            $pages = new Page($page);
        ?>
        
        <footer>
            <div class="container">
                <div class="row">
                    <hr />
                    <div class="col-lg-12">
                        <div class="col-md-8">
                            <a href="#">Impressum</a> &middot; <a href="#">Kontakt</a> &middot; <a href="#">Datenschutz</a>
                        </div>
                        <div class="col-md-4">
                            <p class="muted pull-right">&copy; 2020 Support Forum &bull; Vivienne Rufle</p>
                        </div>
                    </div>
                </div>
            </div>
        </footer>


        <!-- <jQuery Javascript> -->
        <script src="./frontend/js/jquery-3.1.1.min.js"></script>
        <!-- <Bootstrap Javascript> -->
        <script src="./frontend/js/bootstrap.min.js"></script>
        <!-- <Browserweiche Javascript> -->
        <script src="./frontend/js/jQuery.Browserweiche.min.js"></script>
        <!-- <Form Validate Javascript> -->
        <script src="frontend/js/jquery.validate.min.js"></script>
        <!-- <Self Javascript> -->
        <script src="./frontend/js/self.js"></script>
    </body>

</html>