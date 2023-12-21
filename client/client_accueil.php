<?php
    session_start(); // Assurez-vous d'appeler session_start() au début de la page
    include 'db.php';
    if (!isset($_SESSION['prenom'])) {
        echo "Non connecté";
    }
?>

<!doctype html>
<html>
    <head>
        <meta charset='utf-8'>
        <meta name='viewport' content='width=device-width, initial-scale=1'>
        <title>Accueil</title>
        <link href='https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/css/bootstrap.min.css' rel='stylesheet'>
        <link href='' rel='stylesheet'>
        <style>
        
.section {
    position: relative;
    height: 100vh;
}

.section .section-center {
    position: absolute;
    top: 50%;
    left: 0;
    right: 0;
    -webkit-transform: translateY(-50%);
    transform: translateY(-50%);
}

#booking {
    font-family: 'Montserrat', sans-serif;
    background-image: url('https://i.imgur.com/ZaRYfYW.jpg');
    background-size: cover;
    background-position: center;
}

#booking::before {
    content: '';
    position: absolute;
    left: 0;
    right: 0;
    bottom: 0;
    top: 0;
    background: rgba(47, 103, 177, 0.6);
}

.booking-form {
    background-color: #fff;
    padding: 50px 20px;
    -webkit-box-shadow: 0px 5px 20px -5px rgba(0, 0, 0, 0.3);
    box-shadow: 0px 5px 20px -5px rgba(0, 0, 0, 0.3);
    border-radius: 4px;
}

.booking-form .form-group {
    position: relative;
    margin-bottom: 30px;
}

.booking-form .form-control {
    background-color: #ebecee;
    border-radius: 4px;
    border: none;
    height: 40px;
    -webkit-box-shadow: none;
    box-shadow: none;
    color: #3e485c;
    font-size: 14px;
}

.booking-form .form-control::-webkit-input-placeholder {
    color: rgba(62, 72, 92, 0.3);
}

.booking-form .form-control:-ms-input-placeholder {
    color: rgba(62, 72, 92, 0.3);
}

.booking-form .form-control::placeholder {
    color: rgba(62, 72, 92, 0.3);
}

.booking-form input[type="date"].form-control:invalid {
    color: rgba(62, 72, 92, 0.3);
}

.booking-form select.form-control {
    -webkit-appearance: none;
    -moz-appearance: none;
    appearance: none;
}

.booking-form select.form-control+.select-arrow {
    position: absolute;
    right: 0px;
    bottom: 4px;
    width: 32px;
    line-height: 32px;
    height: 32px;
    text-align: center;
    pointer-events: none;
    color: rgba(62, 72, 92, 0.3);
    font-size: 14px;
}

.booking-form select.form-control+.select-arrow:after {
    content: '\279C';
    display: block;
    -webkit-transform: rotate(90deg);
    transform: rotate(90deg);
}

.booking-form .form-label {
    display: inline-block;
    color: #3e485c;
    font-weight: 700;
    margin-bottom: 6px;
    margin-left: 7px;
}

.booking-form .submit-btn {
    display: inline-block;
    color: #fff;
    background-color: #1e62d8;
    font-weight: 700;
    padding: 14px 30px;
    border-radius: 4px;
    border: none;
    -webkit-transition: 0.2s all;
    transition: 0.2s all;
}

.booking-form .submit-btn:hover,
.booking-form .submit-btn:focus {
    opacity: 0.9;
}

.booking-cta {
    margin-top: 80px;
    margin-bottom: 30px;
}

.booking-cta h1 {
    font-size: 52px;
    text-transform: uppercase;
    color: #fff;
    font-weight: 700;
}

.booking-cta p, h3 {
    font-size: 16px;
    color: rgba(255, 255, 255, 0.8);
}</style>
                                <script type='text/javascript' src=''></script>
                                <script type='text/javascript' src='https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js'></script>
                                <script type='text/javascript' src='https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/js/bootstrap.min.js'></script>
                            </head>
                            <body oncontextmenu='return false' class='snippet-body'>
                            <div id="booking" class="section">
    <div class="section-center">
        <div class="container">
            <div class="row">
                <div class="col-md-7 col-md-push-5">
                    <div class="booking-cta">
                        <h1>HEY !</h1><h3><?php echo "Bienvenue " . $_SESSION['nom'] . ','; ?></h3>
                        <h3>Vous avez hate de decouvrir la loire,<br> 
                            creer votre propre itineraire et reservez vos<br> hebergements sur RIVER RIDE
                        </h3>
                    </div>
                </div>
                <div class="col-md-4 col-md-pull-7">
                    <div class="booking-form">
                        <form>
                            <div class="form-group">
                                <span class="form-label">Votre Point d'arret</span>
                                <input class="form-control" type="text" placeholder="Entrer une destination">
                            </div>
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <span class="form-label">Arrivee</span>
                                        <input class="form-control" type="date" required>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <span class="form-label">Depart</span>
                                        <input class="form-control" type="date" required>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <span class="form-label">Chambre</span>
                                        <select class="form-control">
                                            <option>1</option>
                                            <option>2</option>
                                            <option>3</option>
                                        </select>
                                        <span class="select-arrow"></span>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <span class="form-label">Personnes</span>
                                        <select class="form-control">
                                            <option>1</option>
                                            <option>2</option>
                                            <option>3</option>
                                        </select>
                                        <span class="select-arrow"></span>
                                    </div>
                                </div>
                            </div>
                            <div class="form-btn">
                                <button class="submit-btn">Disponibles</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
                            <script type='text/javascript'></script>
                            </body>
                        </html>