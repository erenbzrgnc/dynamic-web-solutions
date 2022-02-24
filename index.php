<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat&family=Noto+Sans:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="resources/css/index.css">
    </link>

    <link rel="apple-touch-icon" sizes="180x180" href="/resources/favicon/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/resources/favicon/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/resources/favicon/favicon-16x16.png">
    <link rel="manifest" href="/resources/favicon/site.webmanifest">
    <link rel="mask-icon" href="/resources/favicon/safari-pinned-tab.svg" color="#5bbad5">
    <link rel="shortcut icon" href="/resources/favicon/favicon.ico">
    <meta name="msapplication-TileColor" content="#da532c">
    <meta name="msapplication-config" content="/resources/favicon/browserconfig.xml">
    <meta name="theme-color" content="#ffffff">

    <title>log in</title>
</head>

<body>


    <div class="container">
        <form action="login.php" class="login" method="post">
            <h2 class="login__title">log in to Media Management System</h2>
            <div class="login__row">
                <label class="login__label" for="lg-em">e-mail</label>
                <input class="login__input" id="lg-em" type="email" name="mail" placeholder="example@email.com" />
            </div>
            <div class="login__row">
                <label class="login__label" for="lg-ps">password</label>
                <input class="login__input" id="lg-ps" type="password" name="password" placeholder="**********" />
            </div>
            <div class="login__row">
                <button class="login__button" type="submit" name="submit">sign in</button>
            </div>

        </form>
        <form class="signup is-form-open" id="signup" action="signup.php" method="post">
            <svg class="svg-icon signup__trigger signup__trigger--fixed" viewBox="0 0 20 20">
                <path d="M14.613,10c0,0.23-0.188,0.419-0.419,0.419H10.42v3.774c0,0.23-0.189,0.42-0.42,0.42s-0.419-0.189-0.419-0.42v-3.774H5.806c-0.23,0-0.419-0.189-0.419-0.419s0.189-0.419,0.419-0.419h3.775V5.806c0-0.23,0.189-0.419,0.419-0.419s0.42,0.189,0.42,0.419v3.775h3.774C14.425,9.581,14.613,9.77,14.613,10 M17.969,10c0,4.401-3.567,7.969-7.969,7.969c-4.402,0-7.969-3.567-7.969-7.969c0-4.402,3.567-7.969,7.969-7.969C14.401,2.031,17.969,5.598,17.969,10 M17.13,10c0-3.932-3.198-7.13-7.13-7.13S2.87,6.068,2.87,10c0,3.933,3.198,7.13,7.13,7.13S17.13,13.933,17.13,10"></path>
            </svg>
            <div class="signup__wrapper is-wrapper-open" id="signup-wrapper">
                <div class="signup__row signup__row--flex">
                    <svg class="svg-icon signup__trigger" viewbox="0 0 20 20">
                        <path d="M10.185,1.417c-4.741,0-8.583,3.842-8.583,8.583c0,4.74,3.842,8.582,8.583,8.582S18.768,14.74,18.768,10C18.768,5.259,14.926,1.417,10.185,1.417 M10.185,17.68c-4.235,0-7.679-3.445-7.679-7.68c0-4.235,3.444-7.679,7.679-7.679S17.864,5.765,17.864,10C17.864,14.234,14.42,17.68,10.185,17.68 M10.824,10l2.842-2.844c0.178-0.176,0.178-0.46,0-0.637c-0.177-0.178-0.461-0.178-0.637,0l-2.844,2.841L7.341,6.52c-0.176-0.178-0.46-0.178-0.637,0c-0.178,0.176-0.178,0.461,0,0.637L9.546,10l-2.841,2.844c-0.178,0.176-0.178,0.461,0,0.637c0.178,0.178,0.459,0.178,0.637,0l2.844-2.841l2.844,2.841c0.178,0.178,0.459,0.178,0.637,0c0.178-0.176,0.178-0.461,0-0.637L10.824,10z"></path>
                    </svg>
                </div>
                <h2 class="signup__title">sign up for free, now.</h2>
                <div class="signup__row">
                    <label class="signup__label" for="su-us">name</label>
                    <input class="signup__input" id="su-us" type="text" name="name" placeholder="John" />
                </div>
                <div class="signup__row">
                    <label class="signup__label" for="su-us">surname</label>
                    <input class="signup__input" id="su-us" type="text" name="surname" placeholder="Doe" />
                </div>
                <div class="signup__row">
                    <label class="signup__label" for="su-em">E-Mail</label>
                    <input class="signup__input" id="su-em" type="email" name="mail" placeholder="example@email.com" />
                </div>
                <div class="signup__row">
                    <label class="signup__label" for="su-ps">password</label>
                    <input class="signup__input" id="su-ps" type="password" name="password1" placeholder="**********" />
                </div>
                <div class="signup__row">
                    <label class="signup__label" for="su-ps">confirm password</label>
                    <input class="signup__input" id="su-ps" type="password" name="password2" placeholder="**********" />
                </div>
                <div class="signup__row">
                    <button class="signup__button" type="submit">sign up</button>
                </div>

            </div>
        </form>
    </div>

</body>

<script src="resources/javascript/index.js"></script>

</html>








