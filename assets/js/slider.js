// Inicializar el slider cuando el DOM esté completamente cargado
jQuery(document).ready(function($) {
    var rev = $('.rev_slider');

    rev.on('init', function(event, slick, currentSlide) {
        var cur = $(slick.$slides[slick.currentSlide]),
            next = cur.next(),
            next2 = cur.next().next(),
            prev = cur.prev(),
            prev2 = cur.prev().prev();

        prev.addClass('slick-sprev');
        next.addClass('slick-snext');
        prev2.addClass('slick-sprev2');
        next2.addClass('slick-snext2');

        cur.removeClass('slick-snext slick-sprev slick-snext2 slick-sprev2');
        slick.$prev = prev;
        slick.$next = next;

        // Añadir perspectiva 3D y enfoque a la imagen central
        $('.rev_slider').addClass('slider-perspective');
        cur.addClass('slick-center');
    }).on('beforeChange', function(event, slick, currentSlide, nextSlide) {
        var cur = $(slick.$slides[nextSlide]);

        slick.$prev.removeClass('slick-sprev slick-sprev2 slick-center');
        slick.$next.removeClass('slick-snext slick-snext2 slick-center');
        slick.$prev.prev().removeClass('slick-sprev2');
        slick.$next.next().removeClass('slick-snext2');

        var next = cur.next(),
            prev = cur.prev();

        prev.addClass('slick-sprev');
        next.addClass('slick-snext');
        prev.prev().addClass('slick-sprev2');
        next.next().addClass('slick-snext2');

        slick.$prev = prev;
        slick.$next = next;
        cur.removeClass('slick-snext slick-sprev slick-snext2 slick-sprev2').addClass('slick-center');
    });

    rev.slick({
        speed: 1000,
        arrows: true,
        dots: false,
        focusOnSelect: true,
        prevArrow: '<button class="slick-prev"><<</button>',
        nextArrow: '<button class="slick-next">>></button>',
        infinite: true,
        centerMode: true,
        slidesToShow: 3, // Mostrar 3 imágenes
        slidesToScroll: 1,
        centerPadding: '0',
        swipe: true,
        autoplay: true,             
        autoplaySpeed: 3000, // velocidad de autoplay       
        adaptiveHeight: true,
        customPaging: function(slider, i) {
            return '';
        }
    });
});
