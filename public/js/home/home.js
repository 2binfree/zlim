$().ready(function() {
    $("#refreshLink").click(function() {
        $("#refreshModal").modal();
        $.get("/refresh", null, function(response) {});
    });
});