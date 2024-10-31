const slider = document.querySelector(".image-comparison .slider");
const beforeImage = document.querySelector(".image-comparison .before-image");
const sliderLine = document.querySelector(".image-comparison .slider-line");
const sliderIcon = document.querySelector(".image-comparison .slider-icon");

slider.addEventListener("input", (e) => {
  let sliderValue = e.target.value + "%";

  beforeImage.style.width = sliderValue;
  sliderLine.style.left = sliderValue;
  sliderIcon.style.left = sliderValue;
});


$(document).ready(function(){
    $('.quality-carousel').slick({
        infinite: true,
        slidesToShow: 5,           // Jumlah card yang ditampilkan sekaligus
        slidesToScroll: 1,
        autoplay: true,
        autoplaySpeed: 0,          // Menghilangkan jeda antar-slide
        speed: 8000,               // Kecepatan pergerakan dalam milidetik
        cssEase: 'linear',         // Mengatur pergerakan kontinu tanpa jeda
        arrows: false,             // Menghilangkan tombol navigasi
        responsive: [
            {
                breakpoint: 1200,
                settings: {
                    slidesToShow: 4
                }
            },
            {
                breakpoint: 992,
                settings: {
                    slidesToShow: 3
                }
            },
            {
                breakpoint: 768,
                settings: {
                    slidesToShow: 2
                }
            },
            {
                breakpoint: 576,
                settings: {
                    slidesToShow: 1
                }
            }
        ]
    });
});
