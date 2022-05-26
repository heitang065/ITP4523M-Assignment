$(document).ready(function(){
    $("input[name='role']").change(function(){
        if($(this).val() == 'staff'){
            $("input[name='account']").attr("placeholder", "Enter your Staff ID");
            $(".account-label").text("Staff ID");
        }else{
            $("input[name='account']").attr("placeholder", "Enter your email");
            $(".account-label").text("Email");
        }
    })
})