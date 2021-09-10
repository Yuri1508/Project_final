// ======================================================================
// EXPOSITION    EXPOSITION    EXPOSITION    EXPOSITION    EXPOSITION
// ======================================================================
// Add active class to the current button (highlight it)
var header = document.getElementById("my-active");
var btns = header.getElementsByClassName("go");
for (var i = 0; i < btns.length; i++) {
    btns[i].addEventListener("click", function () {
        var current = document.getElementsByClassName("active");
        current[0].className = current[0].className.replace(" active", "");
        this.className += " active";
    });
}
// ======================================================================
$('#title-temp').click(function () {
    var currentSlide = $('.exposition.active');
    var nextSlide = currentSlide.next();

    currentSlide.fadeOut(300).removeClass('active');
    nextSlide.fadeIn(300).addClass('active');

    if (nextSlide.length == 0) {
        $('.exposition').last().fadeIn(300).addClass('active');
    }
});
// ======================================================================
$('#title-perm').click(function () {
    var currentSlide = $('.exposition.active');
    var prevSlide = currentSlide.prev();

    currentSlide.fadeOut(300).removeClass('active');
    prevSlide.fadeIn(300).addClass('active');

    if (prevSlide.length == 0) {
        $('.exposition').first().fadeIn(300).addClass('active');
    }
});
// ======================================================================