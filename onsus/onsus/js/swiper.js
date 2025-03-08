;(function($) {

    "use strict";
$('.tf-products').each(function(){
    var     $this = $(this),
            item = $this.data("column"),
            item2 = $this.data("column2"),
            item3 = $this.data("column3");
            // row = $this.data("row"),
            // row2 = $this.data("row2"),
            // row3 = $this.data("row3"),
            // spacer = Number($this.data("spacer")),
            // prev_icon = $this.data("prev_icon"),
            // next_icon = $this.data("next_icon");

    window.console&&console.log(item);
    // var loop = false;
    // if ($this.data("loop") == 'yes') {
    //     loop = true;
    // }

    // var auto = false;
    // if ($this.data("auto") == 'yes') {
    //     auto = true;
    // } 

    // var arrow = false;
    // if ($this.data("arrow") == 'yes') {
    //     arrow = true;
    // } 

    // var bullets = false;
    // if ($this.data("bullets") == 'yes') {
    //     bullets = true;
    // }

    var swiper = new Swiper('.product-test', {
        loop:false,
        slidesPerView: 4,
        slidesPerColumn: 2,
        slidesPerColumnFill: 'row',
        observer: true,
        observeParents: true,
        spaceBetween: 15,
        navigation: {
            clickable: true,
            nextEl: ".swiper-button-next",
            prevEl: ".swiper-button-prev",
        },
        breakpoints: {
            576: {
                slidesPerView: 1,
                slidesPerColumn: 2,
                spaceBetween: 15,
            },
            992: {
                slidesPerView: 2,
                slidesPerColumn: 2,
                spaceBetween: 15,
            },
    
            1200: {
                slidesPerView: 4,
                slidesPerColumn: 2,
                spaceBetween: 15,
            },
        },
    });
});
});


var swiper = new Swiper('.product-test.row2.column1', {
    loop:false,
    slidesPerColumnFill: 'row',
    slidesPerColumn: 2,
    observer: true,
    observeParents: true,
    spaceBetween: 15,
 pagination: {
        el: '.swiper-pagination',
        clickable: true,
    },
    navigation: {
        nextEl: '.swiper-button-next',
        prevEl: '.swiper-button-prev',
    },
    breakpoints: {
        576: {
            slidesPerView: 1,
            spaceBetween: 15,
        },
        992: {
            slidesPerView: 1,
            spaceBetween: 15,
        },

        1200: {
            slidesPerView: 1,
            spaceBetween: 15,
        },
    },
});

var swiper = new Swiper('.product-test.row2.column2', {
    loop:false,
    slidesPerColumnFill: 'row',
    slidesPerColumn: 2,
    observer: true,
    observeParents: true,
    spaceBetween: 15,
 pagination: {
        el: '.swiper-pagination',
        clickable: true,
    },
    navigation: {
        nextEl: '.swiper-button-next',
        prevEl: '.swiper-button-prev',
    },
    breakpoints: {
        576: {
            slidesPerView: 1,
            spaceBetween: 15,
        },
        992: {
            slidesPerView: 2,
            spaceBetween: 15,
        },

        1200: {
            slidesPerView: 2,
            spaceBetween: 15,
        },
    },
});

var swiper = new Swiper('.product-test.row2.column3', {
    loop:false,
    slidesPerColumnFill: 'row',
    slidesPerColumn: 2,
    observer: true,
    observeParents: true,
    spaceBetween: 15,
 pagination: {
        el: '.swiper-pagination',
        clickable: true,
    },
    navigation: {
        nextEl: '.swiper-button-next',
        prevEl: '.swiper-button-prev',
    },
    breakpoints: {
        576: {
            slidesPerView: 1,
            spaceBetween: 15,
        },
        992: {
            slidesPerView: 2,
            spaceBetween: 15,
        },

        1200: {
            slidesPerView: 3,
            spaceBetween: 15,
        },
    },
});

var swiper = new Swiper('.product-test.row2.column4', {
    loop:false,
    slidesPerColumn: 1,
    slidesPerColumnFill: 'row',
    slidesPerColumn: 2,
    observer: true,
    observeParents: true,
    spaceBetween: 15,
 pagination: {
        el: '.swiper-pagination',
        clickable: true,
    },
    navigation: {
        nextEl: '.swiper-button-next',
        prevEl: '.swiper-button-prev',
    },
    breakpoints: {
        576: {
            slidesPerView: 1,
            spaceBetween: 15,
        },
        992: {
            slidesPerView: 2,
            spaceBetween: 15,
        },

        1200: {
            slidesPerView: 4,
            spaceBetween: 15,
        },
    },
});

var swiper = new Swiper('.product-test.row2.column5', {
    loop:false,
    slidesPerColumn: 1,
    slidesPerColumnFill: 'row',
    slidesPerColumn: 2,
    observer: true,
    observeParents: true,
    spaceBetween: 15,
 pagination: {
        el: '.swiper-pagination',
        clickable: true,
    },
    navigation: {
        nextEl: '.swiper-button-next',
        prevEl: '.swiper-button-prev',
    },
    breakpoints: {
        576: {
            slidesPerView: 1,
            spaceBetween: 15,
        },
        992: {
            slidesPerView: 2,
            spaceBetween: 15,
        },

        1200: {
            slidesPerView: 5,
            spaceBetween: 15,
        },
    },
});

var swiper = new Swiper('.product-test.row2.column6', {
    loop:false,
    slidesPerColumn: 1,
    slidesPerColumnFill: 'row',
    slidesPerColumn: 2,
    observer: true,
    observeParents: true,
    spaceBetween: 15,
 pagination: {
        el: '.swiper-pagination',
        clickable: true,
    },
    navigation: {
        nextEl: '.swiper-button-next',
        prevEl: '.swiper-button-prev',
    },
    breakpoints: {
        576: {
            slidesPerView: 1,
            spaceBetween: 15,
        },
        992: {
            slidesPerView: 2,
            spaceBetween: 15,
        },

        1200: {
            slidesPerView: 6,
            spaceBetween: 15,
        },
    },
});

var swiper = new Swiper('.product-test.row2.column7', {
    loop:false,
    slidesPerColumn: 1,
    slidesPerColumnFill: 'row',
    slidesPerColumn: 2,
    observer: true,
    observeParents: true,
    spaceBetween: 15,
 pagination: {
        el: '.swiper-pagination',
        clickable: true,
    },
    navigation: {
        nextEl: '.swiper-button-next',
        prevEl: '.swiper-button-prev',
    },
    breakpoints: {
        576: {
            slidesPerView: 1,
            spaceBetween: 15,
        },
        992: {
            slidesPerView: 2,
            spaceBetween: 15,
        },

        1200: {
            slidesPerView: 7,
            spaceBetween: 15,
        },
    },
});

var swiper = new Swiper('.product-test.row3.column1', {
    loop:false,
    slidesPerColumn: 3,
    slidesPerColumnFill: 'row',
    observer: true,
    observeParents: true,
    spaceBetween: 15,
 pagination: {
        el: '.swiper-pagination',
        clickable: true,
    },
    navigation: {
        nextEl: '.swiper-button-next',
        prevEl: '.swiper-button-prev',
    },
    breakpoints: {
        576: {
            slidesPerView: 1,
            spaceBetween: 15,
        },
        992: {
            slidesPerView: 1,
            spaceBetween: 15,
        },

        1200: {
            slidesPerView: 1,
            spaceBetween: 15,
        },
    },
});

var swiper = new Swiper('.product-test.row3.column2', {
    loop:false,
    slidesPerColumn: 3,
    slidesPerColumnFill: 'row',
    observer: true,
    observeParents: true,
    spaceBetween: 15,
 pagination: {
        el: '.swiper-pagination',
        clickable: true,
    },
    navigation: {
        nextEl: '.swiper-button-next',
        prevEl: '.swiper-button-prev',
    },
    breakpoints: {
        576: {
            slidesPerView: 1,
            spaceBetween: 15,
        },
        992: {
            slidesPerView: 2,
            spaceBetween: 15,
        },

        1200: {
            slidesPerView: 2,
            spaceBetween: 15,
        },
    },
});

var swiper = new Swiper('.product-test.row3.column3', {
    loop:false,
    slidesPerColumn: 3,
    slidesPerColumnFill: 'row',
    observer: true,
    observeParents: true,
    spaceBetween: 15,
 pagination: {
        el: '.swiper-pagination',
        clickable: true,
    },
    navigation: {
        nextEl: '.swiper-button-next',
        prevEl: '.swiper-button-prev',
    },
    breakpoints: {
        576: {
            slidesPerView: 1,
            spaceBetween: 15,
        },
        992: {
            slidesPerView: 2,
            spaceBetween: 15,
        },

        1200: {
            slidesPerView: 3,
            spaceBetween: 15,
        },
    },
});

var swiper = new Swiper('.product-test.row3.column4', {
    loop:false,
    slidesPerColumn: 3,
    slidesPerColumnFill: 'row',
    observer: true,
    observeParents: true,
    spaceBetween: 15,
 pagination: {
        el: '.swiper-pagination',
        clickable: true,
    },
    navigation: {
        nextEl: '.swiper-button-next',
        prevEl: '.swiper-button-prev',
    },
    breakpoints: {
        576: {
            slidesPerView: 1,
            spaceBetween: 15,
        },
        992: {
            slidesPerView: 2,
            spaceBetween: 15,
        },

        1200: {
            slidesPerView: 4,
            spaceBetween: 15,
        },
    },
});

var swiper = new Swiper('.product-test.row3.column5', {
    loop:false,
    slidesPerColumn: 3,
    slidesPerColumnFill: 'row',
    observer: true,
    observeParents: true,
    spaceBetween: 15,
 pagination: {
        el: '.swiper-pagination',
        clickable: true,
    },
    navigation: {
        nextEl: '.swiper-button-next',
        prevEl: '.swiper-button-prev',
    },
    breakpoints: {
        576: {
            slidesPerView: 1,
            spaceBetween: 15,
        },
        992: {
            slidesPerView: 2,
            spaceBetween: 15,
        },

        1200: {
            slidesPerView: 5,
            spaceBetween: 15,
        },
    },
});

var swiper = new Swiper('.product-test.row3.column6', {
    loop:false,
    slidesPerColumn: 3,
    slidesPerColumnFill: 'row',
    observer: true,
    observeParents: true,
    spaceBetween: 15,
 pagination: {
        el: '.swiper-pagination',
        clickable: true,
    },
    navigation: {
        nextEl: '.swiper-button-next',
        prevEl: '.swiper-button-prev',
    },
    breakpoints: {
        576: {
            slidesPerView: 1,
            spaceBetween: 15,
        },
        992: {
            slidesPerView: 2,
            spaceBetween: 15,
        },

        1200: {
            slidesPerView: 6,
            spaceBetween: 15,
        },
    },
});

var swiper = new Swiper('.product-test.row3.column7', {
    loop:false,
    slidesPerColumn: 3,
    slidesPerColumnFill: 'row',
    observer: true,
    observeParents: true,
    spaceBetween: 15,
 pagination: {
        el: '.swiper-pagination',
        clickable: true,
    },
    navigation: {
        nextEl: '.swiper-button-next',
        prevEl: '.swiper-button-prev',
    },
    breakpoints: {
        576: {
            slidesPerView: 1,
            spaceBetween: 15,
        },
        992: {
            slidesPerView: 2,
            spaceBetween: 15,
        },

        1200: {
            slidesPerView: 7,
            spaceBetween: 15,
        },
    },
});

var swiper = new Swiper('.product-test.row4.column1', {
    loop:false,
    slidesPerColumn: 4,
    slidesPerColumnFill: 'row',
    observer: true,
    observeParents: true,
    spaceBetween: 15,
 pagination: {
        el: '.swiper-pagination',
        clickable: true,
    },
    navigation: {
        nextEl: '.swiper-button-next',
        prevEl: '.swiper-button-prev',
    },
    breakpoints: {
        576: {
            slidesPerView: 1,
            spaceBetween: 15,
        },
        992: {
            slidesPerView: 1,
            spaceBetween: 15,
        },

        1200: {
            slidesPerView: 1,
            spaceBetween: 15,
        },
    },
});

var swiper = new Swiper('.product-test.row4.column2', {
    loop:false,
    slidesPerColumn: 4,
    slidesPerColumnFill: 'row',
    observer: true,
    observeParents: true,
    spaceBetween: 15,
 pagination: {
        el: '.swiper-pagination',
        clickable: true,
    },
    navigation: {
        nextEl: '.swiper-button-next',
        prevEl: '.swiper-button-prev',
    },
    breakpoints: {
        576: {
            slidesPerView: 1,
            spaceBetween: 15,
        },
        992: {
            slidesPerView: 2,
            spaceBetween: 15,
        },

        1200: {
            slidesPerView: 2,
            spaceBetween: 15,
        },
    },
});
var swiper = new Swiper('.product-test.row4.column3', {
    loop:false,
    slidesPerColumn: 4,
    slidesPerColumnFill: 'row',
    observer: true,
    observeParents: true,
    spaceBetween: 15,
 pagination: {
        el: '.swiper-pagination',
        clickable: true,
    },
    navigation: {
        nextEl: '.swiper-button-next',
        prevEl: '.swiper-button-prev',
    },
    breakpoints: {
        576: {
            slidesPerView: 1,
            spaceBetween: 15,
        },
        992: {
            slidesPerView: 2,
            spaceBetween: 15,
        },

        1200: {
            slidesPerView: 3,
            spaceBetween: 15,
        },
    },
});
var swiper = new Swiper('.product-test.row4.column4', {
    loop:false,
    slidesPerColumn: 4,
    slidesPerColumnFill: 'row',
    observer: true,
    observeParents: true,
    spaceBetween: 15,
 pagination: {
        el: '.swiper-pagination',
        clickable: true,
    },
    navigation: {
        nextEl: '.swiper-button-next',
        prevEl: '.swiper-button-prev',
    },
    breakpoints: {
        576: {
            slidesPerView: 1,
            spaceBetween: 15,
        },
        992: {
            slidesPerView: 2,
            spaceBetween: 15,
        },

        1200: {
            slidesPerView: 4,
            spaceBetween: 15,
        },
    },
});
var swiper = new Swiper('.product-test.row4.column5', {
    loop:false,
    slidesPerColumn: 4,
    slidesPerColumnFill: 'row',
    observer: true,
    observeParents: true,
    spaceBetween: 15,
 pagination: {
        el: '.swiper-pagination',
        clickable: true,
    },
    navigation: {
        nextEl: '.swiper-button-next',
        prevEl: '.swiper-button-prev',
    },
    breakpoints: {
        576: {
            slidesPerView: 1,
            spaceBetween: 15,
        },
        992: {
            slidesPerView: 2,
            spaceBetween: 15,
        },

        1200: {
            slidesPerView: 5,
            spaceBetween: 15,
        },
    },
});
var swiper = new Swiper('.product-test.row4.column6', {
    loop:false,
    slidesPerColumn: 4,
    slidesPerColumnFill: 'row',
    observer: true,
    observeParents: true,
    spaceBetween: 15,
    pagination: {
        el: '.swiper-pagination',
        clickable: true,
    },
    navigation: {
        nextEl: '.swiper-button-next',
        prevEl: '.swiper-button-prev',
    },
    breakpoints: {
        576: {
            slidesPerView: 1,
            spaceBetween: 15,
        },
        992: {
            slidesPerView: 2,
            spaceBetween: 15,
        },

        1200: {
            slidesPerView: 6,
            spaceBetween: 15,
        },
    },
});

var swiper = new Swiper('.product-test.row4.column7', {
    loop:false,
    slidesPerColumn: 4,
    slidesPerColumnFill: 'row',
    observer: true,
    observeParents: true,
    spaceBetween: 15,
 pagination: {
        el: '.swiper-pagination',
        clickable: true,
    },
    navigation: {
        nextEl: '.swiper-button-next',
        prevEl: '.swiper-button-prev',
    },
    breakpoints: {
        576: {
            slidesPerView: 1,
            spaceBetween: 15,
        },
        992: {
            slidesPerView: 2,
            spaceBetween: 15,
        },

        1200: {
            slidesPerView: 7,
            spaceBetween: 15,
        },
    },
});