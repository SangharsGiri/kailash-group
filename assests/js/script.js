
// for trip section
function myFunction(y) {
    if (y.matches) { // If media query matches
        let slider_class= document.querySelector('.slider-trip');
        slider_class.classList.add('trip');
        slider_class.classList.remove('regular-trip');
    } else {
        let slider_class= document.querySelector('.slider-trip');
        slider_class.classList.add('regular-trip');
        slider_class.classList.remove('trip');
    }
    }

    var y = window.matchMedia("(max-width: 414px)")
    myFunction(y) // Call listener function at run time
    y.addListener(myFunction) // Attach listener function on state changes

$(".regular-trip").slick({
    dots: true,
    infinite: true,
    slidesToShow: 4,
    slidesToScroll: 4,
    // autoplay:true,
    // autoplaySpeed: 3000,
    prevArrow: '<i class="fas fa-angle-left fa-3x arrowleft"></i>',
    nextArrow: '<i class="fas fa-angle-right fa-3x arrowright"></i>',

  });
  $(".trip").slick({
    dots: true,
    infinite: true,
    slidesToShow: 1,
    slidesToScroll: 1,
    // autoplay:true,
    // autoplaySpeed: 3000,
    prevArrow: '<i class="fas fa-angle-left fa-3x arrowleft back"></i>',
    nextArrow: '<i class="fas fa-angle-right fa-3x arrowright back"></i>',

  });
