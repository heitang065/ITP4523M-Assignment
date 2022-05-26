$(document).ready(function () {
    $(".update").click(function () {
        let number = $(this).parent("td").siblings(".airWaybillNo").text();
        let customerEmail = $(this).parent("td").siblings(".customerEmail").text();
        let locationID = $(this).parent("td").siblings(".locationID").text();

        $("#airWaybillNo").attr('value', number);
        $("#customerEmailLabel").attr('value', customerEmail);
        $("#locationIDLabel").attr('value', locationID);
    })
})