$(document).ready(function () {
    $("#animate-progress").click(function(){
        var interval = setInterval(function(){
            $("#progress-bar").addClass("active");
            var actualProgress = $("#progress-bar").attr("aria-valuenow");
            if(actualProgress == 100){
                clearInterval(interval);
                $("#progress-bar").removeClass("active");
            } else {
                $("#progress-bar").css("width", actualProgress + "%");
                $("#progress-bar").attr("aria-valuenow", ++actualProgress);
                $("#progress-bar").text(actualProgress + "%");
            }
        }, 100);
    });
});