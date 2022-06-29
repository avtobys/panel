<nav class="navbar navbar-expand navbar-dark bg-gradient-dark shadow sticky-top">
    <a class="navbar-brand mr-0 mr-md-2 text-uppercase" href="/">
        <?= $_BRAND ?>
    </a>
    <ul class="navbar-nav ml-auto">
        <li class="nav-item">
            <a class="nav-link" href="https://github.com/avtobys/panel"><i class="fab fa-github" aria-hidden="true"></i></a>
        </li>
        <?php if (!$user->id) : ?>
            <li class="nav-item dropdown">
                <a id="log-in" class="nav-link" href="#">Sign in</a>
                <div id="sign-menu" class="dropdown-menu dropdown-menu-right p-4">
                    <form>
                        <input type="hidden" name="form" value="0">
                        <div class="form-group">
                            <label>E-mail</label>
                            <input type="email" name="email" class="form-control" placeholder="email@example.com" required>
                        </div>
                        <div class="form-group">
                            <label>Password</label>
                            <div class="input-group">
                                <input type="password" name="password" class="form-control" placeholder="Password" required>
                                <div class="input-group-append">
                                    <span class="input-group-text px-1">
                                        <i class="fas fa-eye-slash"></i>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary btn-block">Sign in</button>
                        <div class="btn-group btn-group-sm w-100 mt-4" role="group">
                            <button data-form="1" class="btn btn-outline-primary p-1" type="button">Sign up</button>
                            <button data-form="2" class="btn btn-outline-primary p-1" type="button">Forgot?</button>
                        </div>
                    </form>
                    <form>
                        <input type="hidden" name="form" value="1">
                        <div class="form-group">
                            <label>E-mail</label>
                            <input type="email" name="email" class="form-control" placeholder="email@example.com" required>
                        </div>
                        <div class="form-group">
                            <label>Password</label>
                            <div class="input-group">
                                <input type="password" name="password" class="form-control" placeholder="Password" minlength="6" required>
                                <div class="input-group-append">
                                    <span class="input-group-text px-1">
                                        <i class="fas fa-eye-slash"></i>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="form-group position-relative">
                            <label>Password repeat</label>
                            <div class="input-group">
                                <input type="password" name="password2" class="form-control" placeholder="Password repeat" minlength="6" required>
                                <div class="input-group-append">
                                    <span class="input-group-text px-1">
                                        <i class="fas fa-eye-slash"></i>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary btn-block">Sign up</button>
                        <div class="btn-group btn-group-sm w-100 mt-4" role="group">
                            <button data-form="0" class="btn btn-outline-primary p-1" type="button">Sign in</button>
                            <button data-form="2" class="btn btn-outline-primary p-1" type="button">Forgot?</button>
                        </div>
                    </form>
                    <form>
                        <input type="hidden" name="form" value="2">
                        <div class="form-group">
                            <label>E-mail</label>
                            <input type="email" name="email" class="form-control" placeholder="email@example.com" required>
                        </div>
                        <button type="submit" class="btn btn-primary btn-block">Remind password</button>
                        <div class="btn-group btn-group-sm w-100 mt-4" role="group">
                            <button data-form="0" class="btn btn-outline-primary p-1" type="button">Sign in</button>
                            <button data-form="1" class="btn btn-outline-primary p-1" type="button">Sign up</button>
                        </div>
                    </form>
                    <i class="fas fa-sort-up"></i>
                </div>
            </li>
        <?php else : ?>
            <li class="nav-item">
                <a class="nav-link" data-modal="sign-out" href="#">Sign out</a>
            </li>
        <?php endif; ?>
    </ul>
</nav>

<?php if (!$user->id) : ?>

    <div id="captcha-modal" class="modal fade" tabindex="-1" role="dialog" data-backdrop="static" data-keyboard="false" aria-hidden="true">
        <div class="modal-dialog modal-md modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header py-2">
                    <h5 class="modal-title">Not a robot?</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body text-center">
                    <div id="hcaptcha-render"></div>
                </div>
            </div>
        </div>
    </div>

    <div id="service-modal" class="modal fade" tabindex="-1" role="dialog" data-backdrop="static" data-keyboard="false" aria-hidden="true">
        <div class="modal-dialog modal-sm modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header py-2">
                    <h5 class="modal-title"></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body text-center text-danger"></div>
            </div>
        </div>
    </div>

    <?php if ($is_remind) : ?>
        <div id="remind-modal" class="modal fade" tabindex="-1" role="dialog" data-backdrop="static" data-keyboard="false" aria-hidden="true">
            <div class="modal-dialog modal-sm modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header py-2">
                        <h5 class="modal-title">Change password</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form>
                            <input type="hidden" name="request" value="<?= htmlspecialchars($request, ENT_QUOTES) ?>">
                            <div class="form-group position-relative">
                                <label>New password</label>
                                <div class="input-group">
                                    <input type="password" name="password" class="form-control" placeholder="Password" minlength="6" required>
                                    <div class="input-group-append">
                                        <span class="input-group-text px-1">
                                            <i class="fas fa-eye-slash"></i>
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group position-relative">
                                <label>Password repeat</label>
                                <div class="input-group">
                                    <input type="password" name="password2" class="form-control" placeholder="Password repeat" minlength="6" required>
                                    <div class="input-group-append">
                                        <span class="input-group-text px-1">
                                            <i class="fas fa-eye-slash"></i>
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary btn-block">Change password</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    <?php endif; ?>


    <script>
        window.addEventListener("DOMContentLoaded", function() {
            ! function() {
                window.hcaptchaRender = function() {
                    hcaptcha.render('hcaptcha-render', {
                        sitekey: '<?= SITEKEY ?>',
                        'callback': verifyCallback
                    });
                }

                if (!$("script[src*=hcaptcha]").length) {
                    var s = document.createElement("script");
                    s.src = "//js.hcaptcha.com/1/api.js?hl=en&onload=hcaptchaRender&render=explicit";
                    document.head.appendChild(s);
                }
            }();

            $(document).on("submit", "#sign-menu form", function(e) {
                e.preventDefault();
                window.signData = $(this).serialize();
                $("#log-in").trigger("click");
                $("#captcha-modal").modal();
                hcaptcha.reset();
            });
        });


        window.addEventListener("DOMContentLoaded", function() {
            window.verifyCallback = function(token) {
                $.ajax({
                        type: "POST",
                        url: "/api/sign",
                        data: window.signData + "&h-captcha-response=" + token,
                        dataType: "json"
                    })
                    .done(response => {
                        if (response.status == "service") {
                            $("#service-modal .modal-title").html(response.title);
                            $("#service-modal .modal-body").html(response.body);
                            $("#service-modal").modal();
                        }
                        response.code && eval(response.code);
                    })
                    .always(() => {
                        $("#captcha-modal").modal("hide");
                    });
            }

            $(document).on("click", "#log-in", function(e) {
                e.preventDefault();
                $(this).toggleClass("active");
                $("#sign-menu").fadeToggle(200);
                if ($("#sign-menu").not(":visible")) {
                    $("#log-in").html($("#sign-menu [data-form=0]").html());
                    $("#sign-menu>form").hide();
                    $("#sign-menu>form:eq(0)").show();
                }
            });

            $(document).on("click", "#sign-menu form [data-form]", function() {
                $('#log-in').html(this.innerHTML.replace(/[^a-z\s]/i, ''));
                $(this).parents("form").slideUp();
                $("#sign-menu>form:eq(" + $(this).data("form") + ")").slideDown();
            });

            $(document).on("click", ".input-group .fa-eye, .input-group .fa-eye-slash", function(e) {
                if ($(this).hasClass("fa-eye")) {
                    $(this)
                        .addClass("fa-eye-slash")
                        .removeClass("fa-eye");
                    $(this).parents(".input-group").find("input[type=text]").attr("type", "password");
                } else {
                    $(this)
                        .addClass("fa-eye")
                        .removeClass("fa-eye-slash");
                    $(this).parents(".input-group").find("input[type=password]").attr("type", "text");
                }
            });

            <?php if ($is_remind) : ?>
                $("#remind-modal").modal();
                $(document).on("submit", "#remind-modal form", function(e) {
                    e.preventDefault();
                    $.ajax({
                            type: "POST",
                            url: "/api/remind",
                            data: $(this).serialize(),
                            dataType: "json"
                        })
                        .done(response => {
                            if (response.status == "service") {
                                $("#service-modal .modal-title").html(response.title);
                                $("#service-modal .modal-body").html(response.body);
                                $("#service-modal").modal();
                                setTimeout(function() {
                                    $("#service-modal").modal("hide");
                                    $("#remind-modal").modal();
                                }, 2000);
                            }
                            response.code && eval(response.code);
                        })
                        .always(() => {
                            $("#remind-modal").modal("hide");
                        });
                });
            <?php endif; ?>


        });
    </script>

<?php endif; ?>