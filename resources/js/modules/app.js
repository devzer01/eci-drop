var tsx = function(x) {
    return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
};

var _deadline = function () {
    var href = decodeURIComponent(window.location.href);
    var x = href.lastIndexOf("=") + 1;
    return href.substr(x);
};


var s1 = document.getElementById("s1");
var s2 = document.getElementById("s2");

var handler = window.setInterval(function (e) {

    var deadline = new Date(_deadline());
    var seconds = deadline - Date.now();

    //- ((hours * 60 * 60 * 1000) + (minutes * 60 * 1000)));
    // !*$("#el_h1").text(hours);
    // $("#el_m1").text(tminutes);
    s1.innerText = tsx(parseInt(seconds / 1000));
    s2.innerText = (seconds % 1000);
}, 1);

