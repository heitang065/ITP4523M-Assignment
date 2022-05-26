$(document).ready(function(){
    $('#sidebar-btn').click(function(){
        $('#sidebar').toggleClass('active');
        $('#main').toggleClass('active');
    })

    $('#icon-btn').click(function(){
        $('#icon-menu').toggleClass('active');
    })

    // init mode
    if(localStorage.theme === 'dark'){
        $("body").css("background-color", "rgb(40,40,40)")
        $('#switch-btn').css("background-color", "rgb(66, 69, 206)")
        $('#round').css("left", "33px")
    }

    // change dark or light mode
    $('#switch-btn').click(function(){
        if(localStorage.theme === 'dark'){
            $("body").css("background-color", "white");
            $('#switch-btn').css("background-color", "#ccc")
            $('#round').css("left", "2px")
            localStorage.removeItem('theme');
        }else{
            $("body").css("background-color", "rgb(40,40,40)")
            $('#switch-btn').css("background-color", "rgb(66, 69, 206)")
            $('#round').css("left", "33px")
            localStorage.setItem('theme','dark');
        }
    })
})