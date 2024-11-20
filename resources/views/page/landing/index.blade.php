@extends('landing.index')

@section('content')
<section class="hero-section">
    <img class="glow-hero" src="{{asset('assets/img/landing/glow-white.png')}}" alt="">
    <header>
        <nav class="navbar navbar-expand-lg navbar-dark bg-transparent p-3">
            <div class="container-fluid">
              <a class="navbar-brand" href="#">
                <img src="{{asset('assets/img/landing/logo.png')}}" alt="logo">
              </a>
              <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
              </button>

              <div class=" collapse navbar-collapse" id="navbarNavDropdown">
                <ul class="navbar-nav ms-auto ">
                  <li class="nav-item">
                    <a class="nav-link mx-2 active" aria-current="page" href="#home">Home</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link mx-2" href="#service">Service</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link mx-2" href="#contact">Contact</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link mx-2 " href="#product">Product</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link mx-2 " href="#about">About</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link mx-2 " href="#review">Review</a>
                  </li>
                </ul>
                <ul class="navbar-nav ms-auto d-none d-lg-inline-flex">
                  <li class="nav-item mx-2">
                    <a class="nav-link text-dark h5" href="" target="blank"><i class="fab google-plus-square"></i></a>
                  </li>
                  <li class="nav-item mx-2">
                    <a class="nav-link text-dark h5" href="" target="blank"><i class=" twitter"></i></a>
                  </li>
                  <li class="nav-item mx-2">
                    <a class="nav-link text-dark h5" href="" target="blank"><i class=" facebook-square"></i></a>
                  </li>
                </ul>
              </div>
            </div>
          </nav>
    </header>

        <div class="container-fluid" id="home">
            <div class="container-sm mt-5">
                <div class="row justify-center">
                    <div class="col-lg-6 col-md-5 col-12 align-self-center">
                        <div class="text-white" >
                            <h1 data-aos="fade-right">Ingin Mobil Anda <br><span>Kinclong dan Bersinar</span>  Seperti Baru dengan Proteksi Extra?</h1>
                            <p data-aos="fade-right">Kami bangga menjadi pilihan utama bagi pemilik mobil yang menginginkan perawatan mobil terbaik. Dengan jaminan kualitas dan kepuasan pelanggan, kami memastikan mobil anda selalu tampil mengkilap dan terawat</p>
                            <button type="button" class="btn btn-outline-blue" data-aos="fade-right">Selengkapnya</button>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-7 col-6 align-self-end" data-aos="fade-left">
                        <img src="{{asset('assets/img/landing/cars-hero.png')}}" alt="" class="img-fluid">
                    </div>

                </div>
            </div>

        </div>
    </section>

    <section class="mt-5 quality__section">
      <div class="container-fluid">
          <div class="container" data-aos="fade-top">
              <h1 class="text-center"><span>KUALITAS</span> YANG TERJAMIN <img src="{{asset('assets/img/landing/shield-check.png')}}" alt=""></h1>
              <p class="text-center">Kepuasan pelanggan adalah hal yang paling diutamakan, testimoni dari</p>
              <!-- Slider -->
              <div class="quality-carousel mt-5">
                  <div class="card">
                    <video src="{{asset('assets/video/vid-1.mp4')}}" width="200px" height="300px" autoplay loop muted></video>
                  </div>
                  <div class="card">
                    <video src="{{asset('assets/video/vid-2.mp4')}}" width="200px" height="300px" autoplay loop muted></video>
                  </div>
                  <div class="card">
                    <video src="{{asset('assets/video/vid-3.mp4')}}" width="200px" height="300px" autoplay loop muted></video>
                  </div>
                  <div class="card">
                    <video src="{{asset('assets/video/vid-4.mp4')}}" width="200px" height="300px" autoplay loop muted></video>
                  </div>
                  <div class="card">
                    <video src="{{asset('assets/video/vid-5.mp4')}}" width="200px" height="300px" autoplay loop muted></video>
                  </div>  <!-- Tambahkan lebih banyak item sesuai kebutuhan -->
              </div>
              <!-- End of Slider -->
          </div>
      </div>
  </section>

    <section id="car-issues" class="text-start py-5 d-flex flex-column justify-content-center align-items-center mb-5">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12 col-md-6 text-section order-md-1 order-2">
            <h2 class="section-title">APAKAH <span>MASALAH</span> INI TERJADI DI MOBIL KALIAN?</h2>

            <ul class="mt-4" >
              <li><span class="icon">1</span>BERCAK KOTORAN MEMBANDEL</li>
              <li><span class="icon">2</span>WARNA CAT KUSAM</li>
              <li><span class="icon">3</span>GORESAN KASAR PADA BODY MOBIL</li>
              <li><span class="icon">4</span>MOBIL BERJAMUR</li>
              <li><span class="icon">5</span>NODA ASPAL</li>
              <li><span class="icon">6</span>TIDAK MENGKILAP</li>
            </ul>
          </div>
          <div class="col-12 col-md-6 order-md-2 order-1">
            <img class="image-problem" src="{{asset('assets/img/landing/problem-section.png')}}" alt="" >
          </div>
        </div>
      </div>
  </section>

  <section class="solution mt-5">
    <div class="row">
      <div class="col-12 col-md-6" >
        <img class="img-solution" src="{{asset('assets/img/landing/car-solution.png')}}" alt="">
      </div>
      <div class="col-12 col-md-6" >
        <img class="img-logo-glow" src="{{asset('assets/img/landing/logo-glow.png')}}" alt="">
        <h1>TEMUKAN SOLUSI <br> KALIAN <span>DISINI!!</span></h1>
        <p class="mt-4">Jadikan mobil anda bersinar kembali dengan layanan detailing dari Dirty2Clean! Kami percaya bahwa setiap mobil pantas mendapatkan perawatan terbaik. Dengan teknik dan produk premium, kami menjamin hasil coating yang tidak hanya memperindah tampilan, tetapi juga melindungi permukaan cat mobil Anda dari berbagai elemen.</p>
        <button class="btn btn-primary mt-4" onclick="takePromo()">AMBIL PROMO <span>!!</span> </button>
      </div>
    </div>
  </section>

  <section class="solution-2 mt-5" id="about">
    <div class="container">
      <h1 >Dirty2Clean : Solusi Terbaik untuk Perlindungan Mobil Anda!</h1>
      <p class="mt-5" >Apakah mobil anda terlihat lelah dan kotor? Saatnya memberikan perawatan terbaik dengan Dirty2Clean! Kami adalah pilihan terbaik untuk detailing mobil yang siap mengubah kendaraan anda menjadi bintang di jalan.</p>
    </div>
  </section>

  <section class="about mt-5">
    <div class="container">
      <div class="row">
        <div class="col-12 col-md-5 d-flex align-items-center">
          <h1 >Kenapa harus memilih <span>Dirty2Clean?</span></h1>
        </div>
        <div class="col-12 col-md-7">
          <div class="row py-3">
            <div class="card">
              <div class="card-body">
                <h4 class="card-title"><img src="{{asset('assets/img/landing/wafe.png')}}" alt=""> Kualitas Coating Premium</h4>
                <p class="card-text">Produk coating kami menggunakan Nano Silica Ceramic Coating terbaik dari Japan dengan kekerasan 5MOHS dan kekuatan goresan 9H+.</p>
              </div>
            </div>
          </div>
          <div class="row py-3">
            <div class="card" >
              <div class="card-body">
                <h4 class="card-title"><img src="{{asset('assets/img/landing/people.png')}}" alt=""> Staff Professional</h4>
                <p class="card-text">Tim kami Berpengalaman dan telah berdedikasi dalam dunia coating lebih dari 15 tahun dan siap memberikan layanan terbaik kepada mobil Anda.</p>
              </div>
            </div>
          </div>
          <div class="row py-3">
            <div class="card">
              <div class="card-body">
                <h4 class="card-title"><img src="{{asset('assets/img/landing/gear.png')}}" alt=""> Teknik Terdepan</h4>
                <p class="card-text">Dengan metode detailing yang mutakhir, setiap detail mobil Anda akan diperhatikan dengan seksama pada setiap sudut.</p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <div class="container py-5 custom-margin-service" id="product">
    <div class="service-section">
        <img src="{{asset('assets/img/landing/Ellipse 13.png')}}" alt="Background Ellipse" class="ellipse-img">
        <h1 class="text-center mb-4" style="font-weight: bold;">SERVICE</h1>
        <p class="text-center mb-5">Pilih perawatan terbaik untuk kendaraan kalian dan
            rasakan transformasi mobil lo dari sini!</p>
    </div>

    <div class="row g-4">
        <div class="col-md-6" >
            <div class="card bg-dark text-light border-0 shine-img">
                <img src="{{asset('assets/img/landing/Group 24.png')}}" class="card-img-top " alt="Interior Care">
                <div class="card-body">
                    <div class="container">
                        <div class="row">
                            <div class="col col-md-5 ">
                                <div class="bottom-left">INTERIOR CARE</div>
                            </div>
                            <div class="col col-md-7">
                                <div class="bottom-right de">
                                    <p>Dengan perhatian pada setiap detail, kami bikin interior mobil anda
                                        bersih, nyaman, dan terawat. Dari jok, karpet, sampai dashboard, dan
                                        interior lainnya Dirty2Clean siap membuat mobil anda tampil maksimal!
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-6" >
            <div class="card bg-dark text-light border-0 shine-img">
                <img src="{{asset('assets/img/landing/Group 25.png')}}" class="card-img-top " alt="Interior Care">
                <div class="card-body">
                    <div class="container">
                        <div class="row">
                            <div class="col col-md-5">
                                <div class="bottom-left">CAR WASH</div>
                            </div>
                            <div class="col col-md-7">
                                <div class="bottom-right de">
                                    <p>
                                        Di Dirty2Clean, kami menawarkan cuci mobil yang super profesional
                                        dengan detail yang lengkap. Dari cuci, poles, hingga perlindungan cat, kami
                                        pastikan kendaraan anda kembali bersinar dan terlindungi dengan maksimal!
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-6" >
            <div class="card bg-dark text-light border-0 shine-img">
                <img src="{{asset('assets/img/landing/Group 26.png')}}" class="card-img-top " alt="Interior Care">
                <div class="card-body">
                    <div class="container">
                        <div class="row">
                            <div class="col col-md-5">
                                <div class="bottom-left">CAR COATING</div>
                            </div>
                            <div class="col col-md-7">
                                <div class="bottom-right de">
                                    <p>Upgrade perlindungan mobilmu ke level dewa! Dengan Evo Nano Ceramic
                                        Coating, dapatkan perlindungan maksimal dari goresan dan cuaca, serta
                                        kilauan tahan lama yang bikin kendaraan Anda tampil menawan!
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-6" >
            <div class="card bg-dark text-light border-0 shine-img">
                <img src="{{asset('assets/img/landing/Group 27.png')}}" class="card-img-top " alt="Interior Care">
                <div class="card-body">
                    <div class="container">
                        <div class="row">
                            <div class="col col-md-5">
                                <div class="bottom-left">CAR DETAILING</div>
                            </div>
                            <div class="col col-md-7">
                                <div class="bottom-right de">
                                    <p>Rasakan transformasi total dengan detailing mobil pada kami! Mobil
                                        tampak seperti baru, cat terlindungi, dan interior jadi super nyaman.
                                        Upgrade mobil anda sekarang dengan layanan kami.
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>

<div class="container py-5 my-5" id="before">

  <div class="row align-items-center">
      <!-- Bagian Before and After di sebelah kiri -->
      <div class="col-sm-3 text-left before-after-text">
          <span class="before-after">Before
              <br class="han">
              and After</span>
      </div>

      <!-- Bagian deskripsi di sebelah kanan -->
      <div class="col-sm-9 d-flex align-items-center justify-content-end">
          <p class="description-text mb-0">Berikut proses sebelum dan sesudah perawatan kendaraan di Dirty2Clean</p>
      </div>
  </div>

  <div class="image-comparison">
      <div class="images-container">
          <img class="before-image" src="{{asset('assets/img/landing/before.png')}}" alt=""/>
          <img class="after-image" src="{{asset('assets/img/landing/after.png')}}" alt=""/>

          <div class="slider-line"></div>
          <div class="slider-icon">
              <svg
                  xmlns="http://www.w3.org/2000/svg"
                  fill="none"
                  viewbox="0 0 24 24"
                  stroke-width="1.5"
                  stroke="currentColor"
                  class="w-6 h-6">
                  <path
                      stroke-linecap="round"
                      stroke-linejoin="round"
                      d="M8.25 15L12 18.75 15.75 15m-7.5-6L12 5.25 15.75 9"/>
              </svg>
          </div>

          <input type="range" class="slider" min="0" max="100"/>
      </div>
  </div>
</div>

<section class="service mt-5" id="service">
  <div class="container">
    <h1 class="text-center">DAPATKAN PELAYANAN <span>TERBAIK</span>  KAMI</h1>
    <div class="row justify-content-center mt-5">
      <div class="col-lg-6 col-md-6 col-12">
          <div class="promo-card" >
              <h3>EVO SILICA CERAMIC COATING</h3>
              <ul class="feature-list">
                  <li>Paint Correction</li>
                  <li>Three Step Detailing</li>
                  <li>Interior Care</li>
                  <li>Engine Cleaning</li>
                  <li>Window Care</li>
                  <li>Window Cout</li>
                  <li>Dual Layer Evo 5 mohs + 9 h</li>
              </ul>
              <p class="original-price">Rp 3.500.000</p>
              <p class="discount-price">Rp 2.200.000</p>
              <button class="btn btn-promo" onclick="sendWhatsApp('EVO SILICA CERAMIC COATING')">Ambil Promo</button>
          </div>
      </div>
      <div class="col-lg-6 col-md-6 col-12">
          <div class="promo-card" >
              <h3>CAR PRO CQUARTZ UK 3.0</h3>
              <ul class="feature-list">
                <li>Paint Correction</li>
                <li>Three Step Detailing</li>
                <li>Interior Care</li>
                <li>Engine Cleaning</li>
                <li>Window Care & Cout</li>
                <li>Car Pro Cquartz UK 3.0 2 layer</li>
                <li>Reload Coating Protection</li>

              </ul>
              <p class="original-price">Rp 8.500.000</p>
              <p class="discount-price">Rp 5.500.000</p>
              <button class="btn btn-promo" onclick="sendWhatsApp('CAR PRO CQUARTZ UK 3.0')">Ambil Promo</button>
          </div>
      </div>
  </div>
  </div>
</section>

<div class="container review-section" id="review">
  <h2 style="font-weight: bold;" class="mb-5">REVIEW</h2>
  <div class="row">
      <div class="col-lg-3 col-md-4 col-12" >
          <div class="thumbnail animated fadeInUp">
              <img src="{{asset('assets/img/landing/Group 30.png')}}" alt="" style="width:100%">
              <div class="caption">
                  <div class="rating">
                      <span class="star">&#9733;</span>
                      <span class="star">&#9733;</span>
                      <span class="star">&#9733;</span>
                      <span class="star">&#9733;</span>
                      <span class="star">&#9733;</span>
                  </div>
                  <h4 class="additional-info" style="font-weight: bold;">Beby Romeo</h4>
                  <p class="description">Puas coating disini, hasilnya bagus banget! pengerjaan
                      sangat detail dan bersih, ruang tunggunya juga bersih, AC dingin, staffnya
                      ramah2 semua</p>
              </div>
          </div>
      </div>
      <div class="col-lg-3 col-md-4 col-12" >
          <div class="thumbnail animated fadeInUp delay-1s">
              <img src="{{asset('assets/img/landing/Group 31.png')}}" alt="" style="width:100%">
              <div class="caption">
                  <div class="rating">
                      <span class="star">&#9733;</span>
                      <span class="star">&#9733;</span>
                      <span class="star">&#9733;</span>
                      <span class="star">&#9733;</span>
                      <span class="star">&#9733;</span>
                  </div>
                  <h4 class="additional-info" style="font-weight: bold;">Dinda Kirana</h4>
                  <p class="description">Kagum dengan layanan ini. 1 mobil ditangani oleh 3-4
                      orang, jadi kebersihan menjadi hal yang tidak perlu Anda khawatirkan. Akan jadi
                      langganan seperti</p>
              </div>
          </div>
      </div>
      <div class="col-lg-3 col-md-4 col-12" >
          <div class="thumbnail animated fadeInUp delay-2s">
              <img src="{{asset('assets/img/landing/Group 32.png')}}" alt="" style="width:100%">
              <div class="caption">
                  <div class="rating">
                      <span class="star">&#9733;</span>
                      <span class="star">&#9733;</span>
                      <span class="star">&#9733;</span>
                      <span class="star">&#9733;</span>
                      <span class="star">&#9733;</span>
                  </div>
                  <h4 class="additional-info" style="font-weight: bold;">Jessica Iskandar</h4>
                  <p class="description">Layanannya luar biasa! Mobil saya terlihat seperti baru
                      lagi setelah detailing. Semua sudut dibersihkan dengan teliti, dan coating-nya
                      bikin cat mobil jadi kinclong terus.</p>
              </div>
          </div>
      </div>
      <div class="col-lg-3 col-md-4 col-12" >
        <div class="thumbnail animated fadeInUp delay-2s">
            <img src="{{asset('assets/img/landing/Group 35.png')}}" alt="" style="width:100%">
            <div class="caption">
                <div class="rating">
                    <span class="star">&#9733;</span>
                    <span class="star">&#9733;</span>
                    <span class="star">&#9733;</span>
                    <span class="star">&#9733;</span>
                    <span class="star">&#9733;</span>
                </div>
                <h4 class="additional-info" style="font-weight: bold;">Adjie Pangestu</h4>
                <p class="description">Mobil saya setelah detailing dan coating terlihat kinclong banget, seperti baru keluar dari showroom. Selain hasilnya yang luar biasa, mereka benar-benar fokus pada detail kecil yang sering terlewat di tempat lain.</p>
            </div>
        </div>
    </div>
  </div>
</div>

<!-- Section 6 -->
<div class="container py-5" id="contact">
  <h1 class="title">BOOKING</h1>
  <form id="contactForm" class="custom-form" onsubmit="sendWhatsApp(); return false;">
    <div class="mb-3 mt-3">
        <label for="name" class="form-label">Name :</label>
        <input type="text" class="form-control" id="name" placeholder="Your Name" name="name" required>
    </div>
    <div class="mb-3">
        <label for="email" class="form-label">Email Address :</label>
        <input type="email" class="form-control" id="email" placeholder="name@example.com" name="email" required>
    </div>
    <div class="mb-3">
        <label for="message" class="form-label">Message :</label>
        <textarea class="form-control" id="message" name="message" placeholder="Your message..." rows="3" required></textarea>
    </div>
    <button type="submit" class="btn btn-primary">Book Now</button>
</form>
</div>

<!-- Section 7 -->
<section class="contact-section mt-5" id="footer contact">
  <div class="overlay">
      <img src="{{asset('assets/img/landing/Group 28.png')}}" alt="Overlay Image" class="overlay-img">
  </div>

  <div class="container h-100 d-flex align-items-center justify-content-center">
      <div class="text-overlay">
          <h1 class="display-4">CONTACT US!</h1>
          <div class="blurred-box">
              <footer class=" text-lg-start text-white" style="background-color: transparent">
                  <!-- Section: Social media -->
                  <section
                      class="d-flex justify-content-between p-4 blurred-box"
                      style="background-color: transparent">
                      <!-- Left -->
                      <div class="">
                          <span>Connect with us on social media</span>
                      </div>
                      <!-- Left -->

                      <!-- Right -->
                      <div>
                          <a href="https://wa.me/6285217310639" class="text-white me-4 text-decoration-none">
                              <i class="fa-brands fa-whatsapp"></i>
                          </a>
                          <a href="https://www.tiktok.com/@dirty2clean.indonesia" class="text-white me-4 text-decoration-none">
                              <i class="fab fa-tiktok"></i>
                          </a>
                          <a href="https://www.instagram.com/dirty2clean.official?igsh=cTIyamJ4b3A2OXJj" class="text-white me-4 text-decoration-none">
                              <i class="fab fa-instagram"></i>
                          </a>
                      </div>
                      <!-- Right -->
                  </section>
                  <!-- Section: Social media -->

                  <!-- Section: Links -->
                  <section class="">
                      <div class="container text-md-start mt-5">
                          <!-- Grid row -->
                          <div class="row mt-3 ">
                              <!-- Grid column -->
                              <div class="col-md-12 col-lg-12 col-xl-12 mx-auto mb-4">
                                  <!-- Content -->
                                  <h6 class="text-uppercase fw-bold">Address</h6>
                                  <hr
                                      class="mb-4 mt-0 d-inline-block mx-auto"
                                      style="width: 60px; background-color: #007bff; height: 2px"/>
                                  <p>
                                      Jl. Raya Tj. Barat No.2B, Lenteng Agung, Kec. Jagakarsa, Kota Jakarta Selatan,
                                      Daerah Khusus Ibukota Jakarta 12530
                                  </p>
                              </div>

                              <!-- Grid column -->
                          </div>
                          <!-- Grid row -->
                      </div>
                  </section>
                  <!-- Section: Links -->

                  <!-- Copyright -->
                  <div class=" p-3" style="background-color: rgba(0, 0, 0, 0.2)">
                      © 2024
                      <a class="text-white text-decoration-none" href="#">Dirty2Clean</a >
                  </div>
                  <!-- Copyright -->
              </footer>
          </div>
      </div>
  </div>
</section>
@endsection
