<!DOCTYPE html>
<html lang="<?= LANGUAGE_CODE ?>">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/tpl/css/bootstrap.min.css">
    <link rel="stylesheet" href="/tpl/css/fa/css/all.min.css">
    <link rel="stylesheet" href="/tpl/css/main.css?<?= filemtime(__DIR__ . '/css/main.css') ?>">
    <title>Main</title>
</head>

<body>

    <?php
    if ($user->id && file_exists(__DIR__ . '/root_' . $user->root . '/navbar.php'))
        require __DIR__ . '/root_' . $user->root . '/navbar.php';
    else
        require __DIR__ . '/navbar.php';
    ?>

    <div class="container my-4 bg-gradient-light shadow-lg">
        <div>
            <h1 class="display-4">Web panel with unlimited nesting of access rights</h1>
            <p class="lead">
            <ul>
                <li>Perpetual authorization</li>
                <li>Unlimited nesting of access levels</li>
                <li>Sign in, sign up, remind password from e-mails. hCaptcha on this important forms</li>
                <li>Automatically routed urls to php pages in users directories and API
                    <ul>
                        <li>route api url if exists php file</li>
                        <li>route authorized main page if exists file</li>
                        <li>route authorized other pages if exists file</li>
                        <li>route non authorized main page and authorized (with user navbar)</li>
                        <li>route user pages not authorized and authorized (with user navbar)</li>
                    </ul>
                </li>
                <li>Automatically routed navigation bars to existing php files for users with access</li>
                <li>Automatically active links in the navbar menu for current urls</li>
                <li>PHP stack with execution timeout for any Javascript code (toast messages or any code)</li>
                <li>Automatically modals confirmations and non confirmations Javascript actions buttons</li>
                <li>Automatically protection from CSRF attack for all POST forms</li>
                <li>Automatic creation of the user table from the configuration file</li>
                <li>Backend: PDO MySQL + PHP</li>
                <li>Frontend: Bootstrap v4.6.0 + JQuery</li>
            </ul>
            </p>
            <hr class="my-4">
            <h5>Usage actions api buttons:</h5>
            <pre>add to buttons attributes:
data-action="1" - required, is filename action in directory /api/actions
data-confirm="true" - true if confirm modal action added / false - without confirmation modal
data-header="Header modal action"
data-body="Body modal action"
data-callback="callbackFunction" - action callback function with arguments (response, data)
data-anyparam1="any param 1"
data-anyparam2="any param 2"
            </pre>
            <a class="btn btn-primary btn-lg" href="#" data-action="1" data-confirm="true" data-header="Header modal action 1" data-body="Body modal action 1" data-callback="callbackFunction" data-anyparam1="any param 1" data-anyparam2="any param 2" role="button">Action 1 (with confirm)</a>
            <a class="btn btn-primary btn-lg" href="#" data-action="2" data-callback="callbackFunction" data-anyparam1="any param 1" data-anyparam2="any param 2" role="button">Action 2 (without confirm)</a>
            <hr class="my-4">
            <h5>Usage modal api buttons:</h5>
            <pre>Api modal can be called in two ways:
1. add to button/link attribute with id modal data-modal="id-modal"
2. call to js function apiModal("id-modal");
            </pre>
            <a class="btn btn-primary btn-lg" href="#" data-modal="example-modal" role="button">Example api modal</a>
            <hr class="my-4">
            <h5>Usage toast api:</h5>
            <pre>Toast called to js function:
toast(header, mess, timeout = 5000);
            </pre>
            <a class="btn btn-primary btn-lg" href="#" onclick="toast('Header toast', 'Message toast');return false;" role="button">Example toast onclick</a>
        </div>

        <script>
            function callbackFunction(response) {
                alert(JSON.stringify(response));
            }
        </script>

        <div id="carouselId" class="carousel slide mt-5" data-ride="carousel">
            <ol class="carousel-indicators">
                <li data-target="#carouselId" data-slide-to="0" class="active"></li>
                <li data-target="#carouselId" data-slide-to="1"></li>
                <li data-target="#carouselId" data-slide-to="2"></li>
            </ol>
            <div class="carousel-inner" role="listbox">
                <div class="carousel-item active">
                    <svg class="bd-placeholder-img card-img-top" width="100%" height="425" xmlns="http://www.w3.org/2000/svg" role="img" aria-label="Placeholder: Thumbnail" preserveAspectRatio="xMidYMid slice" focusable="false">
                        <title>Placeholder</title>
                        <rect width="100%" height="100%" fill="#55595c"></rect>
                    </svg>
                    <div class="carousel-caption d-none d-md-block">
                        <h3>Title 1</h3>
                        <p>Description 1</p>
                    </div>
                </div>
                <div class="carousel-item">
                    <svg class="bd-placeholder-img card-img-top" width="100%" height="425" xmlns="http://www.w3.org/2000/svg" role="img" aria-label="Placeholder: Thumbnail" preserveAspectRatio="xMidYMid slice" focusable="false">
                        <title>Placeholder</title>
                        <rect width="100%" height="100%" fill="#55595c"></rect>
                    </svg>
                    <div class="carousel-caption d-none d-md-block">
                        <h3>Title 2</h3>
                        <p>Description 2</p>
                    </div>
                </div>
                <div class="carousel-item">
                    <svg class="bd-placeholder-img card-img-top" width="100%" height="425" xmlns="http://www.w3.org/2000/svg" role="img" aria-label="Placeholder: Thumbnail" preserveAspectRatio="xMidYMid slice" focusable="false">
                        <title>Placeholder</title>
                        <rect width="100%" height="100%" fill="#55595c"></rect>
                    </svg>
                    <div class="carousel-caption d-none d-md-block">
                        <h3>Title 3</h3>
                        <p>Description 3</p>
                    </div>
                </div>
            </div>
            <a class="carousel-control-prev" href="#carouselId" role="button" data-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
            </a>
            <a class="carousel-control-next" href="#carouselId" role="button" data-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
            </a>
        </div>
        <div class="card-deck mt-5 text-center">
            <div class="card mb-4 shadow-sm">
                <div class="card-header">
                    <h4 class="my-0 font-weight-normal">Free</h4>
                </div>
                <div class="card-body">
                    <h1 class="card-title pricing-card-title">$0 <small class="text-muted">/ mo</small></h1>
                    <ul class="list-unstyled mt-3 mb-4">
                        <li>10 users included</li>
                        <li>2 GB of storage</li>
                        <li>Email support</li>
                        <li>Help center access</li>
                    </ul>
                    <button type="button" class="btn btn-lg btn-block btn-outline-primary">Sign up for free</button>
                </div>
            </div>
            <div class="card mb-4 shadow-sm">
                <div class="card-header">
                    <h4 class="my-0 font-weight-normal">Pro</h4>
                </div>
                <div class="card-body">
                    <h1 class="card-title pricing-card-title">$15 <small class="text-muted">/ mo</small></h1>
                    <ul class="list-unstyled mt-3 mb-4">
                        <li>20 users included</li>
                        <li>10 GB of storage</li>
                        <li>Priority email support</li>
                        <li>Help center access</li>
                    </ul>
                    <button type="button" class="btn btn-lg btn-block btn-primary">Get started</button>
                </div>
            </div>
            <div class="card mb-4 shadow-sm">
                <div class="card-header">
                    <h4 class="my-0 font-weight-normal">Enterprise</h4>
                </div>
                <div class="card-body">
                    <h1 class="card-title pricing-card-title">$29 <small class="text-muted">/ mo</small></h1>
                    <ul class="list-unstyled mt-3 mb-4">
                        <li>30 users included</li>
                        <li>15 GB of storage</li>
                        <li>Phone and email support</li>
                        <li>Help center access</li>
                    </ul>
                    <button type="button" class="btn btn-lg btn-block btn-primary">Contact us</button>
                </div>
            </div>
        </div>

        <footer class="pt-4 my-md-5 pt-md-5 border-top">
            <div class="row">
                <div class="col-12 col-md">
                    <small class="d-block mb-3 text-muted">&copy; 2017-2021</small>
                </div>
                <div class="col-6 col-md">
                    <h5>Features</h5>
                    <ul class="list-unstyled text-small">
                        <li><a class="text-muted" href="#">Cool stuff</a></li>
                        <li><a class="text-muted" href="#">Random feature</a></li>
                        <li><a class="text-muted" href="#">Team feature</a></li>
                        <li><a class="text-muted" href="#">Stuff for developers</a></li>
                        <li><a class="text-muted" href="#">Another one</a></li>
                        <li><a class="text-muted" href="#">Last time</a></li>
                    </ul>
                </div>
                <div class="col-6 col-md">
                    <h5>Resources</h5>
                    <ul class="list-unstyled text-small">
                        <li><a class="text-muted" href="#">Resource</a></li>
                        <li><a class="text-muted" href="#">Resource name</a></li>
                        <li><a class="text-muted" href="#">Another resource</a></li>
                        <li><a class="text-muted" href="#">Final resource</a></li>
                    </ul>
                </div>
                <div class="col-6 col-md">
                    <h5>About</h5>
                    <ul class="list-unstyled text-small">
                        <li><a class="text-muted" href="#">Team</a></li>
                        <li><a class="text-muted" href="#">Locations</a></li>
                        <li><a class="text-muted" href="#">Privacy</a></li>
                        <li><a class="text-muted" href="#">Terms</a></li>
                    </ul>
                </div>
            </div>
        </footer>
    </div>


    <script src="/tpl/js/jquery-3.6.0.min.js"></script>
    <script src="/tpl/js/bootstrap.bundle.min.js"></script>
    <script src="/tpl/js/main.js?<?= filemtime(__DIR__ . '/js/main.js') ?>"></script>
</body>

</html>