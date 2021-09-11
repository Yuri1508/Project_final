// ======================================================================
// button return up
$('<div></div>')
    .attr('id', 'scrolltotop')
    .hide()
    .css({ 'z-index': '1000', 'position': 'fixed', 'bottom': '25px', 'right': '35px', 'cursor': 'pointer', 'width': '40px', 'height': '40px', 'background': '#263677', 'border-radius': '50%' })
    .appendTo('body')
    .click(function () {
        $('html,body').animate({ scrollTop: 0 }, '3000');
    });
$('<div></div>')
    .css({ 'width': '6px', 'height': '6px', 'transform': 'rotate(-135deg)', 'border': 'solid ghostwhite', 'border-width': '0 3px 3px 0', 'padding': '3px', 'margin-top': '16px', 'margin-left': '15px' })
    .appendTo('#scrolltotop');
$(window).scroll(function () {
    if ($(window).scrollTop() < 500) {
        $('#scrolltotop').fadeOut();
    } else {
        $('#scrolltotop').fadeIn();
    }
});
// ======================================================================