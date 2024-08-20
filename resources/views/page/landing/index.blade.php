@extends('landing.index')

@section('content')
<div class="container">
    <div class="elipse">
        <img src="{{asset('assets/img/content/elipse.png')}}" alt="logo">
    </div>
    <div class="line">
        <img src="{{asset('assets/img/content/line.png')}}" alt="line">
    </div>
    <div class="car">
        <img src="{{asset('assets/img/content/car.png')}}" alt="car">
    </div>
    <div class="hero-section">
        <div class="content">
            <div class="row">
                <div class="col-lg-6">
                    <h1 class="my-4">Dirty2Clean</h1>
                    <p class="my-4">Kami bangga menjadi pilihan utama bagi pemilik mobil yang menginginkan perawatan mobil terbaik. Dengan jaminan kualitas dan kepuasan pelanggan, kami memastikan mobil Anda selalu tampil mengkilap dan terawat. Tim kami menggunakan teknologi dan produk terbaik untuk memastikan kendaraan Anda selalu dalam kondisi prima. Dapatkan hasil maksimal dengan waktu yang minimal.</p>
                    <a href="#" class="btn border-btn button--mimas"><span>Selengkapnya</span></a>
                </div>
                <div class="col-lg-6">

                </div>
            </div>
        </div>
    </div>

    <section class="focus-detail">
        <div class="container">

        </div>
    </section>

    {{-- <section class="services-section">
        <div class="container">
            <h2>Services</h2>
            <div class="services row">
                <div class="service col-md-6">
                    <img src="/path-to-service-image.jpg" alt="Service 1" class="img-fluid">
                    <h3>Interior Cleaning</h3>
                </div>
                <div class="service col-md-6">
                    <img src="/path-to-service-image.jpg" alt="Service 2" class="img-fluid">
                    <h3>Exterior Cleaning</h3>
                </div>
            </div>
        </div>
    </section>

    <section class="before-after-section">
        <div class="container">
            <h2>Before and After</h2>
            <div class="before-after-image">
                <img src="/path-to-before-after-image.jpg" alt="Before and After">
            </div>
        </div>
    </section>

    <section class="reviews-section">
        <div class="container">
            <h2>Reviews</h2>
            <div class="reviews row">
                <div class="review col-md-4">
                    <p>"Excellent service!"</p>
                    <div class="rating">★★★★☆</div>
                </div>
                <div class="review col-md-4">
                    <p>"Very professional."</p>
                    <div class="rating">★★★★★</div>
                </div>
                <div class="review col-md-4">
                    <p>"Amazing results."</p>
                    <div class="rating">★★★★☆</div>
                </div>
            </div>
        </div>
    </section>

    <footer class="contact-section">
        <div class="container">
            <h2>Contact Us</h2>
            <p>If you have any questions, feel free to reach out!</p>
            <div class="contact-info">
                <p>Email: info@dirty2clean.com</p>
                <p>Phone: 123-456-7890</p>
            </div>
        </div>
    </footer> --}}
</div>
@endsection
