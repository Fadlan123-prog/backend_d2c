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
                    <a class="nav-link text-dark h5" href="" target="blank"><i class="fab fa-google-plus-square"></i></a>
                  </li>
                  <li class="nav-item mx-2">
                    <a class="nav-link text-dark h5" href="" target="blank"><i class="fab fa-twitter"></i></a>
                  </li>
                  <li class="nav-item mx-2">
                    <a class="nav-link text-dark h5" href="" target="blank"><i class="fab fa-facebook-square"></i></a>
                  </li>
                </ul>
              </div>
            </div>
          </nav>
    </header>

        <div class="container-fluid" id="home">
            <div class="container-sm mt-5">
                <div class="row">
                    <div class="col-md-5">
                        <div class="text-white">
                            <h1>Ingin Mobil Anda <br><span>Kinclong dan Bersinar</span>  Seperti Baru dengan Proteksi Extra ?</h1>
                            <p>Kami bangga menjadi pilihan utama bagi pemilik mobil yang menginginkan perawatan mobil terbaik. Dengan jaminan kualitas dan kepuasan pelanggan, kami memastikan mobil anda selalu tampil mengkilap dan terawat</p>
                            <button type="button" class="btn btn-outline-blue">Selengkapnya</button>
                        </div>
                    </div>
                    <div class="col-md-7 align-self-end">
                        <img src="{{asset('assets/img/landing/cars-hero.png')}}" alt="" class="img-fluid">
                    </div>

                </div>
            </div>

        </div>
    </section>

    <section class="mt-5 quality__section">
      <div class="container-fluid">
          <div class="container">
              <h1 class="text-center"><span>KUALITAS</span> YANG TERJAMIN <img src="{{asset('assets/img/landing/shield-check.png')}}" alt=""></h1>
              <p class="text-center">Kepuasan pelanggan adalah hal yang paling diutamakan, testimoni dari</p>

              <!-- Slider -->
              <div class="quality-carousel">
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
                  </div>

                  <!-- Tambahkan lebih banyak item sesuai kebutuhan -->
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

            <ul class="mt-4">
              <li><span class="icon">1</span>BERCAK KOTORAN MEMBANDEL</li>
              <li><span class="icon">2</span>WARNA CAT KUSAM</li>
              <li><span class="icon">3</span>GORESAN KASAR PADA BODY MOBIL</li>
              <li><span class="icon">4</span>MOBIL BERJAMUR</li>
              <li><span class="icon">5</span>NODA ASPAL</li>
              <li><span class="icon">6</span>TIDAK MENGKILAP</li>
            </ul>
          </div>
          <div class="col-12 col-md-6 order-md-2 order-1">
            <img class="image-problem" src="{{asset('assets/img/landing/problem-section.png')}}" alt="">
          </div>
        </div>

        <!-- <div class="row justify-content-center my-5">
              <h2 class="section-title">APAKAH <span>MASALAH</span> INI TERJADI DI MOBIL KALIAN?</h2>
          </div>

          <div class="row justify-content-between mb-5">
              <div class="col-auto issue-item">BERCAK KOTORAN MEMBANDEL</div>
              <div id="" class="col-auto issue-item ">WARNA CAT KUSAM</div>
              <div class="col-auto issue-item">GORESAN KASAR PADA BODY MOBIL</div>
          </div>

          <div class="row justify-content-between mt-5">
              <div class="col-auto issue-item">MOBIL BERJAMUR</div>
              <div id="" class="col-auto issue-item ">NODA ASPAL</div>
              <div class="col-auto issue-item">TIDAK MENGKILAP</div>
          </div> -->
      </div>
  </section>

  <section class="solution mt-5">
    <div class="row">
      <div class="col-12 col-md-6">
        <img class="img-solution" src="{{asset('assets/img/landing/car-solution.png')}}" alt="">
      </div>
      <div class="col-12 col-md-6">
        <img class="img-logo-glow" src="{{asset('assets/img/landing/logo-glow.png')}}" alt="">
        <h1>TEMUKAN SOLUSI <br> KALIAN <span>DISINI!!</span></h1>
        <p class="mt-4">Jadikan mobil anda bersinar kembali dengan layanan detailing dari Dirty2Clean! Kami percaya bahwa setiap mobil pantas mendapatkan perawatan terbaik. Dengan teknik dan produk premium, kami menjamin hasil coating yang tidak hanya memperindah tampilan, tetapi juga melindungi permukaan cat mobil Anda dari berbagai elemen.</p>
        <button class="btn btn-primary mt-4">AMBIL PROMO <span>!!</span> </button>
      </div>
    </div>
  </section>

  <section class="solution-2 mt-5">
    <div class="container">
      <h1>Dirty2Clean : Solusi Terbaik untuk Perlindungan Mobil Anda!</h1>
      <p class="mt-5">Apakah mobil anda terliah lelah dan kotor? Saatnya memberikan perawatan terbaik dengan Dirty2Clean! Kami adalah pilihan terbaik untuk detailing mobil yang siap mengubah kendaraan anda menjadi bintang di jalan.</p>
    </div>
  </section>

  <section class="about mt-5">
    <div class="container">
      <div class="row">
        <div class="col-12 col-md-5 d-flex align-items-center">
          <h1>Kenapa harus memilih <span>Dirty2Clean?</span></h1>
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
            <div class="card">
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

  <div class="container py-5 custom-margin-service" id="section4">
    <div class="service-section">
        <img src="{{asset('assets/img/landing/Ellipse 13.png')}}" alt="Background Ellipse" class="ellipse-img">
        <h1 class="text-center mb-4" style="font-weight: bold;">SERVICE</h1>
        <p class="text-center mb-5">Pilih perawatan terbaik untuk kendaraan kalian dan
            rasakan transformasi mobil lo dari sini!</p>
    </div>

    <div class="row g-4">
        <div class="col-md-6" data-aos="fade-right">
            <div class="card bg-dark text-light border-0 shine-img">
                <img src="{{asset('assets/img/landing/Group 24.png')}}" class="card-img-top " alt="Interior Care">
                <div class="card-body">
                    <div class="container">
                        <div class="row">
                            <div class="col py-2">
                                <div class="bottom-left">INTERIOR CARE</div>
                            </div>
                            <div class="col">
                                <div class="bottom-right de">
                                    <p>Dengan perhatian pada setiap detail, kami bikin interior mobil lo
                                        <br class="han">
                                        bersih, nyaman, dan terawat. Dari jok, karpet, sampai dashbor, dan
                                        <br class="han">
                                        interior lainnya Dirty2Clean siap membuat mobil lo tampil maksimal!
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-6" data-aos="fade-left">
            <div class="card bg-dark text-light border-0 shine-img">
                <img src="{{asset('assets/img/landing/Group 25.png')}}" class="card-img-top " alt="Interior Care">
                <div class="card-body">
                    <div class="container">
                        <div class="row">
                            <div class="col py-2">
                                <div class="bottom-left">CAR WASH</div>
                            </div>
                            <div class="col">
                                <div class="bottom-right de">
                                    <p>
                                        Di Dirty2Clean, kami menawarkan cuci mobil yang super profesional
                                        <br class="han">
                                        dengan detail yang lengkap. Dari cuci, poles, hingga perlindungan cat, kami
                                        <br class="han">
                                        pastikan kendaraan lo kembali bersinar dan terlindungi dengan maksimal!
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-6" data-aos="fade-right">
            <div class="card bg-dark text-light border-0 shine-img">
                <img src="{{asset('assets/img/landing/Group 26.png')}}" class="card-img-top " alt="Interior Care">
                <div class="card-body">
                    <div class="container">
                        <div class="row">
                            <div class="col py-2">
                                <div class="bottom-left">CAR COATING</div>
                            </div>
                            <div class="col">
                                <div class="bottom-right de">
                                    <p>Upgrade perlindungan mobilmu ke level dewa! Dengan Evo Nano Ceramic<br class="han">
                                        Coating, dapatkan perlindungan maksimal dari goresan dan cuaca, serta
                                        <br class="han">
                                        kilauan tahan lama yang bikin kendaraan lo tampil menawan!
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-6" data-aos="fade-left">
            <div class="card bg-dark text-light border-0 shine-img">
                <img src="{{asset('assets/img/landing/Group 27.png')}}" class="card-img-top " alt="Interior Care">
                <div class="card-body">
                    <div class="container">
                        <div class="row">
                            <div class="col py-2">
                                <div class="bottom-left">CAR DETAILING</div>
                            </div>
                            <div class="col">
                                <div class="bottom-right de">
                                    <p>Rasakan transformasi total dengan detailing mobil pada kami! Mobil<br class="han">
                                        tampak seperti baru, cat terlindungi, dan interior jadi super nyaman.<br class="han">
                                        Upgrade mobil lo sekarang dengan layanan kami.
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
      <div class="col-md-4">
          <div class="promo-card">
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
              <button class="btn btn-promo">Ambil Promo</button>
          </div>
      </div>
      <div class="col-md-4">
          <div class="promo-card">
              <h3>CAR PRO CQUARTZ UK 3.0</h3>
              <ul class="feature-list">
                <li>Paint Correction</li>
                <li>Three Step Detailing</li>
                <li>Interior Care</li>
                <li>Engine Cleaning</li>
                <li>Window Care & Cout</li>
                <li>Car Pro Cquartz UK 3.0 1 layer</li>
                <li>Reload Coating Protection</li>

              </ul>
              <p class="original-price">Rp 8.500.000</p>
              <p class="discount-price">Rp 5.500.000</p>
              <button class="btn btn-promo">Ambil Promo</button>
          </div>
      </div>
  </div>
  </div>
</section>

<div class="container review-section" id="section5 review">
  <h2 style="font-weight: bold;" class="mb-5">REVIEW</h2>
  <div class="row">
      <div class="col-md-4" data-aos="fade-up">
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
      <div class="col-md-4" data-aos="fade-up">
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
      <div class="col-md-4" data-aos="fade-up">
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
      <div class="col-md-4" data-aos="fade-up">
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
                <p class="description">Layanannya luar biasa! Mobil saya terlihat seperti baru
                    lagi setelah detailing. Semua sudut dibersihkan dengan teliti, dan coating-nya
                    bikin cat mobil jadi kinclong terus.</p>
            </div>
        </div>
    </div>
  </div>
</div>

<!-- Section 6 -->
<div class="container py-5" id="section6">
  <h2 class="title">Add yours!</h2>
  <div class="rating">
      <input type="radio" name="rating" value="5" id="5">
      <label for="5">☆</label>
      <input type="radio" name="rating" value="4" id="4">
      <label for="4">☆</label>
      <input type="radio" name="rating" value="3" id="3">
      <label for="3">☆</label>
      <input type="radio" name="rating" value="2" id="2">
      <label for="2">☆</label>
      <input type="radio" name="rating" value="1" id="1">
      <label for="1">☆</label>
  </div>
  <form action="/action_page.php" class="custom-form">
      <div class="mb-3 mt-3">
          <label for="name" class="form-label">Name :</label>
          <input
              type="text"
              class="form-control"
              id="name"
              placeholder="Your Name"
              name="name">
      </div>
      <div class="mb-3">
          <label for="email" class="form-label">Email Address :</label>
          <input
              type="email"
              class="form-control"
              id="email"
              placeholder="name@example.com"
              name="email">
      </div>
      <div class="mb-3">
          <label for="message" class="form-label">Message :</label>
          <textarea
              class="form-control"
              id="message"
              placeholder="Your message..."
              rows="3"></textarea>
      </div>
      <button type="submit" class="btn btn-primary">Submit</button>
  </form>
</div>

<!-- Section 7 -->
<section class="contact-section mt-5" id="footer contact">
  <div class="overlay">
      <img src="{{asset('group')}}" alt="Overlay Image" class="overlay-img">
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
                          <a href="" class="text-white me-4 text-decoration-none">
                              <i class="fa-brands fa-facebook-f"></i>
                          </a>
                          <a href="" class="text-white me-4 text-decoration-none">
                              <i class="fab fa-twitter"></i>
                          </a>
                          <a href="" class="text-white me-4 text-decoration-none">
                              <i class="fab fa-google"></i>
                          </a>
                          <a href="" class="text-white me-4 text-decoration-none">
                              <i class="fab fa-instagram"></i>
                          </a>
                          <a href="" class="text-white me-4 text-decoration-none">
                              <i class="fab fa-linkedin"></i>
                          </a>
                          <a href="" class="text-white me-4 text-decoration-none">
                              <i class="fab fa-github"></i>
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

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="/index.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.js"></script>

<script>
  // Function to remove or add class based on window width
  function checkScreenWidth() {
      // Handling for offset-top
      if ($(window).width() <= 578) {
          console.log('Removing "offset-top" class'); // Debugging log
          $('.offset-top').removeClass('offset-top');
      } else {
          console.log('Adding "offset-top" class back'); // Debugging log
          $('#offset-top').addClass('offset-top');
      }

      // Handling for offset-bottom
      if ($(window).width() <= 578) {
          console.log('Removing "offset-bottom" class'); // Debugging log
          $('.offset-bottom').removeClass('offset-bottom');
      } else {
          console.log('Adding "offset-bottom" class back'); // Debugging log
          $('#offset-bottom').addClass('offset-bottom');
      }

      if ($(window).width() <= 578) {
        $('.de').removeClass('de');
      } else {
        $('.de').addClass('de');
      }

  }

  // Run function when the window is resized
  $(window).resize(function() {
      checkScreenWidth();
  });

  // Run function when the page is first loaded
  $(document).ready(function() {
      checkScreenWidth();
  });
</script>

<script>
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
</script>
@endsection
