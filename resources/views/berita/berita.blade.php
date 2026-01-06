@extends('layouts.layouts')

@section('content')
        <section id="berita" style="margin-top: 100px;">
        <div class="container py-5">
            <div class="header-berita text-center">
                <h2 class="fw-bold">Program kerja Pramuka Ambalan Milenium</h2>
            </div>

            <<div class="row">
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
        </div>
    </section>
@endsection