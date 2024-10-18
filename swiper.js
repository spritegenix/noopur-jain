const eventsSwiper = new Swiper(".eventsSwiper", {
  // Optional parameters
  direction: "horizontal",

  slidesPerView: 1,
  spaceBetween: 40,
  centeredSlides: true,

  loop: true,
  autoplay: {
    speeds: 2000,
    delay: 4000,
  },
  speed: 1000,

  // If we need pagination
  pagination: {
    el: ".swiper-pagination",
    clickable: true,
  },

  // Navigation arrows
  navigation: {
    nextEl: ".swiper-button-next",
    prevEl: ".swiper-button-prev",
  },

  // And if we need scrollbar
  // scrollbar: {
  //   el: ".swiper-scrollbar",
  // },
  breakpoints: {
    1199: {
      slidesPerView: 3,
    },
    991: {
      slidesPerView: 2,
    },
    767: {
      slidesPerView: 2,
    },
    575: {
      slidesPerView: 1,
    },
  },
});

const swiper1 = new Swiper(".swiper1", {
  direction: "horizontal",

  slidesPerView: 1,
  spaceBetween: 40,
  centeredSlides: true,

  loop: true,
  autoplay: {
    speeds: 2000,
    delay: 4000,
  },
  speed: 1000,

  // If we need pagination
  pagination: {
    el: ".swiper-pagination",
    clickable: true,
  },

  // Navigation arrows
  navigation: {
    nextEl: ".swiper-button-next",
    prevEl: ".swiper-button-prev",
  },

  // And if we need scrollbar
  // scrollbar: {
  //   el: ".swiper-scrollbar",
  // },
  breakpoints: {
    1199: {
      slidesPerView: 1,
    },
    991: {
      slidesPerView: 1,
    },
    767: {
      slidesPerView: 1,
    },
    575: {
      slidesPerView: 1,
    },
  },
});

const swiperBlog = new Swiper(".swiperBlog", {
  // Optional parameters
  direction: "horizontal",

  slidesPerView: 1,
  spaceBetween: 20,
  centeredSlides: true,

  loop: true,
  autoplay: {
    speeds: 2000,
    delay: 4000,
  },
  speed: 1000,

  // If we need pagination
  pagination: {
    el: ".swiper-pagination",
    clickable: true,
  },

  // Navigation arrows
  navigation: {
    nextEl: ".swiper-button-next",
    prevEl: ".swiper-button-prev",
  },

  // And if we need scrollbar
  // scrollbar: {
  //   el: ".swiper-scrollbar",
  // },
  breakpoints: {
    1199: {
      slidesPerView: 3,
    },
    991: {
      slidesPerView: 2,
    },
    767: {
      slidesPerView: 2,
    },
    575: {
      slidesPerView: 1,
    },
  },
});
