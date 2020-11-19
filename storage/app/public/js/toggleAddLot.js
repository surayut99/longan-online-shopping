$("#addLot").click(function() {
    $("#qty").attr("disabled", !$("#addLot").prop("checked"));
    $("#toggleValue").val($("#addLot").prop("checked"));
})

window.onload = function() {
    console.log($("#toggleValue").val());
    if ($("#toggleValue").val() == "true") {
        $("#addLot").click();
        console.log("It's " + $("#toggleValue").val());
    }
}
