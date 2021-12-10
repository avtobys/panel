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

$(document).on("click", "[data-modal]", function (e) {
    e.preventDefault();
    if ($(this).attr("lock"))
        return false;
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