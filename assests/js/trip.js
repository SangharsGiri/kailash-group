    //   for global section
    function myFunction(x) {
        if (x.matches) { // If media query matches
            let slider_class= document.querySelector('.slider-global');
            slider_class.classList.add('global-section');
            slider_class.classList.remove('regular-global');
        } else {
            let slider_class= document.querySelector('.slider-global');
            slider_class.classList.add('regular-global');
            slider_class.classList.remove('global-section');
        }
        }
    
        var x = window.matchMedia("(max-width: 414px)")
        myFunction(x) // Call listener function at run time
        x.addListener(myFunction) // Attach listener function on state changes
    
    $(".regular-global").slick({
        dots: true,
        infinite: true,
        slidesToShow: 5,
        slidesToScroll: 5,
        // autoplay:true,
        // autoplaySpeed: 3000,
        prevArrow: '<i class="fas fa-angle-left fa-3x arrowleft"></i>',
        nextArrow: '<i class="fas fa-angle-right fa-3x arrowright"></i>',
    
      });
      $(".global-section").slick({
        dots: true,
        infinite: true,
        slidesToShow: 1,
        slidesToScroll: 1,
        // autoplay:true,
        // autoplaySpeed: 3000,
        prevArrow: '<i class="fas fa-angle-left fa-3x arrowleft back"></i>',
        nextArrow: '<i class="fas fa-angle-right fa-3x arrowright back"></i>',
    
      });