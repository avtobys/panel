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

$(document).on("click", "[data-modal]:not([data-lock])", function (e) {
    e.preventDefault();
    $(this).attr("data-lock", 1);
    let id = $(this).data("modal");
    $.get("/api/modal/" + id,
        function (data) {
            $("#" + id).remove();
            $("body").append(data);
            $("#" + id).modal();
            $("#" + id).on("hidden.bs.modal", function () {
                $(this).remove();
                $(".modal-backdrop").remove();
                $("[data-modal=" + id + "]").removeAttr("data-lock");
            });
        },
        "html"
    );
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

function _action(action) {
    $("#confirm .btn-primary").off();
    if (action.confirm) {
        $("#confirm h5").html(action.header);
        $("#confirm .modal-body").html(action.body);
        $("#confirm").modal();
        $("#confirm .btn-primary").one("click", function () {
            action.confirm = false;
            _action(action);
        });
        return false;
    }
    if (action.callback) {
        action.params ? (action.params.csrf = window.csrf_token) : (action.params = {
            csrf: window.csrf_token
        });
        window[action.callback](action.params);
    }
}

$(document).on("click", "[data-action]", function (e) {
    e.preventDefault();
    if (e.isTrigger) {
        return false;
    }
    let action = JSON.parse($(this).data("action").replace(/'/g, '"'));
    if (action.confirm) {
        $(this).attr("data-modal", "confirm");
        $(this).trigger("click");
        $(this).removeAttr("data-modal");
        $(this).removeAttr("data-lock");
        $(document).on("show.bs.modal", "#confirm", function () {
            _action(action);
            $(document).off("show.bs.modal", "#confirm");
        });
    } else {
        _action(action);
    }
});