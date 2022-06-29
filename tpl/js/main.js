'use strict';

function toast(header, mess) {
    let id = "toast" + Date.now();
    $("#toast").append('<div id="' + id + '" class="toast" role="alert" aria-live="assertive" aria-atomic="true" data-autohide="false" data-animation="true">\
    <div class="toast-header">\
        <strong class="mr-auto">' + header + '</strong>\
        <button type="button" class="ml-2 mb-1 close" data-dismiss="toast" aria-label="Закрыть">\
            <span aria-hidden="true">&times;</span>\
        </button>\
    </div>\
    <div class="toast-body">' + mess + '</div>\
</div>');
    $("#" + id).toast("show");
    setTimeout(function () {
        $("#" + id).toast("hide");
    }, 5000);
    $("#" + id).on("hidden.bs.toast", function () {
        $(this).remove();
    });
}

$('[data-toggle="tooltip"]').tooltip();
$('[data-toggle="popover"]').popover();

$(".navbar a").each(function (i, el) {
    if (el.href == location.href) {
        $(el).addClass("active");
    }
});

function apiModal(id, callback) {
    $("[data-modal=" + id + "]").attr("disabled", 1);
    $.get("/api/modal/" + id,
        function (data) {
            if ($("#" + id).length) {
                $("#" + id).nextAll(".modal-backdrop:first").remove();
                $("#" + id).remove();
            }
            $("body").append(data);
            callback && callback();
            $("#" + id).modal();
            $("#" + id).on("hidden.bs.modal", function () {
                $(this).next(".modal-backdrop").remove();
                $(this).remove();
                $("[data-modal=" + id + "]").removeAttr("disabled");
            });
        },
        "html"
    ).fail(function () {
        setTimeout(function () {
            apiModal(id, callback);
        }, 1000);
    }).always(function () {
        $("[data-modal=" + id + "]").removeAttr("disabled");
    });
}

$(document).on("click", "[data-modal]:not([disabled])", function (e) {
    e.preventDefault();
    let id = $(this).data("modal");
    $("[data-modal=" + id + "]").attr("disabled", 1);
    apiModal(id);
});

let interactionLock;
$(window).on("load scroll click focus touchstart mouseenter", function () {
    if (interactionLock) {
        return;
    }
    interactionLock = Date.now();
    $(document).trigger("interaction");
    setTimeout(function () {
        interactionLock = false;
    }, 500);
});

function setCsrfForms() {
    $("form").each(function () {
        if ($(this).find("input[name=csrf]").length == 0) {
            $(this).prepend("<input type=\"hidden\" name=\"csrf\" value=\"" + window.csrf_token + "\">");
        }
    });
}

$(window).on("interaction", function () {
    setCsrfForms();
});

function _action(data, callback) {
    data.csrf = window.csrf_token;
    $.ajax({
        type: "POST",
        url: "/api/actions/" + data.action,
        data: data,
        dataType: "json"
    }).done(function (response) {
        if (data.callback) {
            window[data.callback](response);
        }
    }).always(function () {
        callback && callback();
    });
}


$(document).on("click", "[data-action]:not([disabled])", function (e) {
    e.preventDefault();
    let button = $(this);
    button.attr("disabled", 1);
    let data = $(this).data();
    if (data.confirm) {
        apiModal("confirm", function () {
            $("#confirm h5").html(data.header);
            $("#confirm .modal-body").html(data.body);
            $("#confirm [data-ok]").off();
            $("#confirm [data-ok]").one("click", function () {
                _action(data);
            });
            button.removeAttr("disabled");
        });
    } else {
        _action(data, function () {
            button.removeAttr("disabled");
        });
    }
});
