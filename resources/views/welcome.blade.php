@extends('layouts.layouts')

@section('content')
    <!-- navbar  -->
    <section id="hero" class="px-0">
        <div class="container text-center text-white" data-aos="zoom-in-up">
            <div class="hero-title ">
                <div class="hero-text" data-aos="fade-up" data-aos-anchor-placement="top-bottom">Selamat Datang <br> Di Pramuka
                    Ambalan Milenium</div>
                <P>Website resmi Pramuka Ambalan Milenium</P>
            </div>
        </div>
    </section>


    <section id="program" style="margin-top: -40px;">
        <div class="container col-xxl-9">
            <div class="row">
                <div class="col-lg-3 col-md-6 mb-2" data-aos="fade-up" data-aos-anchor-placement="center-bottom">
                    <div class="bg-white rounded-3 shadow justify-content-between p-3 d-flex align-items-center">
                        <div>
                            <h5>-- 19 --</h5>
                        </div>
                        <img src="{{ asset('assets/images/indo.png') }}" height="55" width="55" alt="...">
                        <div>
                            <h5>-- 45 --</h5>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 mb-2" data-aos="fade-up" data-aos-anchor-placement="center-bottom">
                    <div class="bg-white rounded-3 shadow justify-content-between p-3 d-flex align-items-center">
                        <div>
                            <h5>-- 19 --</h5>
                        </div>
                        <img src="{{ asset('assets/images/wosm.jpg') }}" height="55" width="55" alt="...">
                        <div>
                            <h5>-- 22 --</h5>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 mb-2" data-aos="fade-up" data-aos-anchor-placement="center-bottom">
                    <div class="bg-white rounded-3 shadow justify-content-between p-3 d-flex align-items-center">
                        <div>
                            <h5>-- 20 --</h5>
                        </div>
                        <img src="{{ asset('assets/images/kitri.png') }}" height="55" width="55" alt="...">
                        <div>
                            <h5>-- 17 --</h5>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 mb-2" data-aos="fade-up" data-aos-anchor-placement="center-bottom">
                    <div class="bg-white rounded-3 shadow justify-content-between p-3 d-flex align-items-center">
                        <div>
                            <h5>-- 20 --</h5>
                        </div>
                        <img src="{{ asset('assets/icons/logo-ambalan.png') }}" height="55" width="55"
                            alt="...">
                        <div>
                            <h5>-- 01 --</h5>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- Program kerja --}}
    <section id="berita" class="section-berita">
        <div class="container pt-5"> <!-- cukup padding top -->
            <div class="header-berita text-center mb-5">
                <h2 class="fw-bold mb-0">Program kerja Pramuka Ambalan Milenium</h2>
            </div>

            <div class="row">
                @foreach ($artikels as $item)
                    <div class="col-lg-4 mb-4"> <!-- gunakan margin bottom saja -->
                        <div class="card border-0 h-100">
                            <!-- Wrapper untuk efek animasi shrink -->
                            <div class="img-wrapper mb-3">
                                <img src="{{ $item->image }}" class="w-100" alt="" />
                            </div>
                            <div class="konten-berita" data-aos="fade-up" data-aos-anchor-placement="center-bottom">
                                <p class="mb-2 text-secondary">{{ $item->created_at }}</p>
                                <h4 class="fw-bold mb-2">{{ $item->judul }}</h4>
                                <p class="text-secondary mb-2">#AmbalanMilenium</p>
                                <!-- Animasi underline pada link -->
                                <a href="/detail/{{ $item->slug }}" class="underline-animate">Selengkapnya</a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="footer-berita text-center pt-3" data-aos="fade-up" data-aos-anchor-placement="center-bottom">
                <a href="/berita" class="btn btn-outline-danger">Program Lainnya</a>
            </div>
        </div>
    </section>

    {{-- Dokumentasi Foto --}}
    <section id="foto" class="section-foto">
        <div class="container pt-5"> <!-- hanya padding top -->
            <div class="header-dokumentasi text-center text-black mb-4" data-aos="fade-up"
                data-aos-anchor-placement="center-bottom">
                <h2 class="fw-bold text-dark mb-0">Dokumentasi Pramuka Ambalan Milenium</h2>
            </div>

            <div class="d-flex justify-content-between align-items-center mb-4">
                <div class="d-flex align-items-center" data-aos="fade-up" data-aos-anchor-placement="center-bottom">
                    <div class="stripe-putih me-2"></div>
                    <h5 class="fw-bold text-dark mb-0">Foto Kegiatan</h5>
                </div>
                <div data-aos="fade-up" data-aos-anchor-placement="center-bottom">
                    <a href="/foto" class="btn btn-outline-danger">Foto Lainnya</a>
                </div>
            </div>

            <!-- Infinite Slider -->
            <div class="slider" data-aos="zoom-in">
                <div class="slide-track pt-3">
                    {{-- Looping foto --}}
                    @foreach ($photos as $photo)
                        <div class="slide">
                            <a class="image-link" href="{{ $photo->image }}">
                                <img src="{{ $photo->image }}" class="rounded-4" alt="Foto Dokumentasi">
                            </a>
                        </div>
                    @endforeach

                    {{-- Duplicate untuk efek infinite --}}
                    @foreach ($photos as $photo)
                        <div class="slide">
                            <a class="image-link" href="{{ $photo->image }}">
                                <img src="{{ $photo->image }}" class="rounded-4" alt="Foto Dokumentasi">
                            </a>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>


    {{-- Struktur Organisasi
    <section class="container">
        <h2>Struktur Organisasi Putra (Versi Refined)</h2>

        <div class="tree-vertical">
            <ul>
                <!-- Pradana -->
                <li>
                    <div class="member-card">
                        <div class="avatar"><img src="https://via.placeholder.com/80"></div>
                        <div class="member-info">
                            <h6>Pradana Putra</h6>
                            <p>Muhammad Haiqal Khawarizmi</p>
                        </div>
                    </div>
                </li>

                <!-- Juru Adat -->
                <li>
                    <div class="member-card">
                        <div class="avatar"><img src="https://via.placeholder.com/80"></div>
                        <div class="member-info">
                            <h6>Juru Adat</h6>
                            <p>Admiral Febrian</p>
                        </div>
                    </div>
                </li>

                <!-- Juru Diklat + Anggota -->
                <li>
                    <div class="has-children">
                        <div class="member-card">
                            <div class="avatar"><img src="https://via.placeholder.com/80"></div>
                            <div class="member-info">
                                <h6>Juru Diklat</h6>
                                <p>Ilham Aliyusman</p>
                            </div>
                            <span class="arrow">→</span>
                        </div>

                        <ul class="side-children">
                            <li>
                                <div class="avatar" style="width:46px;height:46px;border-radius:8px;"><img
                                        src="https://via.placeholder.com/46"></div>
                                <div>
                                    <strong>Anggota</strong>
                                    <div style="font-size:12px;color:#506070;">Syawal Octariano Siswanto</div>
                                </div>
                            </li>
                        </ul>
                    </div>
                </li>

                <!-- Sekretaris -->
                <li>
                    <div class="member-card">
                        <div class="avatar"><img src="https://via.placeholder.com/80"></div>
                        <div class="member-info">
                            <h6>Sekretaris</h6>
                            <p>El Razqa Chaeruzzaman</p>
                        </div>
                    </div>
                </li>

                <!-- Krani + anggota -->
                <li>
                    <div class="has-children">
                        <div class="member-card">
                            <div class="avatar"><img src="https://via.placeholder.com/80"></div>
                            <div class="member-info">
                                <h6>Krani</h6>
                                <p>Yoga</p>
                            </div>
                            <span class="arrow">→</span>
                        </div>

                        <ul class="side-children">
                            <li>
                                <div class="avatar" style="width:46px;height:46px;border-radius:8px;"><img
                                        src="https://via.placeholder.com/46"></div>
                                <div>
                                    <strong>Anggota</strong>
                                    <div style="font-size:12px;color:#506070;">Zakiyudin Muhammad Syafiq</div>
                                </div>
                            </li>
                        </ul>
                    </div>
                </li>

                <!-- Bendahara -->
                <li>
                    <div class="member-card">
                        <div class="avatar"><img src="https://via.placeholder.com/80"></div>
                        <div class="member-info">
                            <h6>Bendahara</h6>
                            <p>Lutfy Ezar Hervavi</p>
                        </div>
                    </div>
                </li>

                <!-- Juru Uang -->
                <li>
                    <div class="member-card">
                        <div class="avatar"><img src="https://via.placeholder.com/80"></div>
                        <div class="member-info">
                            <h6>Juru Uang</h6>
                            <p>Alfin Ridwan Fairuz</p>
                        </div>
                    </div>
                </li>

                <!-- Humdokta + anggota -->
                <li>
                    <div class="has-children">
                        <div class="member-card">
                            <div class="avatar"><img src="https://via.placeholder.com/80"></div>
                            <div class="member-info">
                                <h6>Humdokta</h6>
                                <p>Rival Dwi Mayfi</p>
                            </div>
                            <span class="arrow">→</span>
                        </div>

                        <ul class="side-children">
                            <li>
                                <div class="avatar" style="width:46px;height:46px;border-radius:8px;"><img
                                        src="https://via.placeholder.com/46"></div>
                                <div>
                                    <strong>Anggota</strong>
                                    <div style="font-size:12px;color:#506070;">Satria Adi Pratama</div>
                                </div>
                            </li>
                        </ul>
                    </div>
                </li>

                <!-- Juru Rumah Tangga -->
                <li>
                    <div class="member-card">
                        <div class="avatar"><img src="https://via.placeholder.com/80"></div>
                        <div class="member-info">
                            <h6>Juru Rumah Tangga</h6>
                            <p>Bilal Habsyi Ramdani</p>
                        </div>
                    </div>
                </li>

            </ul>
        </div>
    </section> --}}


    {{-- Join Ambalan --}}
    <section id="join" class="section-join">
        <div class="container py-5 mt-5">
            <div class="header-join text-center" data-aos="fade-up" data-aos-anchor-placement="center-bottom">
                <h2 class="fw-bold">Join Bersama Pramuka Ambalan Milenium</h2>
            </div>
            <div class="row d-flex align-items-center py-3">
                <div class="col-lg-6">
                    <div class="d-flex align-items-center mb-3" data-aos="fade-up"
                        data-aos-anchor-placement="center-bottom">
                        <div class="stripe me-2"></div>
                        <h5>Join Pramuka</h5>
                    </div>
                    <h1 class="fw-bold mb-2" data-aos="fade-up" data-aos-anchor-placement="center-bottom">Gabung bersama
                        kami, mewujudkan generasi berkarakter</h1>
                    <p class="mb-3" data-aos="fade-up" data-aos-anchor-placement="center-bottom">
                        Pramuka Ambalan Milenium adalah wadah bagi generasi muda untuk belajar, berlatih, dan
                        mengembangkan diri melalui kegiatan kepramukaan yang menyenangkan dan bermanfaat.
                        Bergabunglah bersama kami untuk menjadi bagian dari komunitas yang peduli dan aktif dalam
                        membangun karakter bangsa.
                    </p>
                    <a href="https://forms.gle/X2BR1d2Gy4K5rjQ37" class="btn btn-outline-danger" target="_blank"
                        data-aos="fade-up" data-aos-anchor-placement="center-bottom">Daftar</a>
                </div>
                <div class="col-lg-6 py-3" data-aos="zoom-in">
                    <img src="{{ asset('assets/images/opreq.png') }}" class="img-fluid" alt="" height="515"
                        width="535">
                </div>
            </div>
        </div>
    </section>
@endsection
</style>
