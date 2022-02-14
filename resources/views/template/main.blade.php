<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags & Info -->
    <title>Aryo & Ayaa</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="{{ asset('assets/img/mempelai/icon.jpg') }}">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"
          integrity="sha512-SfTiTlX6kk+qitfevl/7LibUOeJWlt9rbyDn92a1DqWOw9vWG2MFoays0sgObmWazO5BQPiFucnnEAjpAB+/Sw==" crossorigin="anonymous"/>

    <!-- Animate CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.7.0/animate.min.css"/>
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">

    <!-- LightBox -->
    <link rel="stylesheet" href="{{ asset('assets/library/lightbox/css/lightbox.min.css') }}"/>

    <!-- Template CSS -->
    <link rel="stylesheet" href="{{ asset('assets/css/main.css?q='.microtime()) }}">
    <link rel="stylesheet" href="{{ asset('assets/css/mobile.css?q='.microtime()) }}">
</head>
<body>

<div id="root">
    <button class="btn-sound btn-play" @click="playAudio()"><i class="fa fa-play"></i></button>
    <button class="btn-sound btn-pause" @click="pauseAudio()"><i class="fa fa-pause"></i></button>

    @include('template.content.0_invitation')

    @include('template.content.1_banner')

    @include('template.content.2_intro')

    @include('template.content.3_person')

    @include('template.content.4_doa')

    @include('template.content.5_date')

    @include('template.content.6_banner')

    @include('template.content.7_kehadiran')

    @include('template.content.8_protokol')

    @include('template.content.9_gallery')

    @include('template.content.10_gift')

    @include('template.content.11_wish')

    @include('template.content.99_footer')

    @include('template.content.100_loading')
</div>


<!-- Bootstrap Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script>

<!-- Vue JS -->
<script src="https://cdn.jsdelivr.net/npm/vue@2.6.12"></script>

<!-- jQuery -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ=="
        crossorigin="anonymous"></script>

<!-- Lightbox -->
<script src="{{ asset('assets/library/lightbox/js/lightbox.min.js') }}"></script>

<!-- AOS -->
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>

<!-- Custom JS -->
<script>
    // Base Variable
    var baseUrl = '{{ url('/') }}';
    var token = '{{ $token }}';
    var listMusic = [
        '{{ asset('assets/music/you-are-the-reason.mp3') }}',
        '{{ asset('assets/music/main-music-1.mp3') }}',
    ];
    var listDate = [
        'February 22, 2022 13:00:00', // sesi 0
        'February 22, 2022 13:00:00', // sesi 1
        'February 22, 2022 13:00:00', // sesi 2
        'February 22, 2022 13:00:00' // sesi 3
    ];
    var person = {
        id: "{{ $id }}",
        name: "{!! $name !!}",
        location: "{{ $location }}",
        sesi: {{ ($sesi ? $sesi : 0) }},
    }
</script>

<!-- Custom JS -->
<script src="{{ asset('assets/js/main.js?q='.microtime()) }}"></script>
</body>
</html>
