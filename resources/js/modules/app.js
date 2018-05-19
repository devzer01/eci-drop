var handler = window.setInterval(function () {
    var diff = (endTime.getTime() - (new Date()).getTime()) / 1000;
    var hours = parseInt(diff / 60 / 60);
    var minutes = parseInt((diff - (hours * 60 * 60)) / 60);
    var tminutes = minutes + (hours + 60);
    var seconds = parseInt(endTime.getTime() - (new Date()).getTime());
    //- ((hours * 60 * 60 * 1000) + (minutes * 60 * 1000)));
    $("#el_h1").text(hours);
    $("#el_m1").text(tminutes);
    $("#el_s1").text(tsx(parseInt(seconds / 1000)));
    $("#el_s2").text(seconds % 1000);
}, 1);

var tsx = function(x) {
    return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
};
