<section id="weddingDate" class="wedding-date container">
    <div class="container">
        <div class="row justify-content-md-center">
            <div class="col-md-8">
                <!-- Title -->
                <p class="wedding-date-title">Countdown to Happiness</p>
                <!-- ./ Title -->

                <!-- Timer -->
                <div class="row justify-content-md-center wedding-date-timer" data-aos="fade-up" data-aos-duration="1000">
                    <div class="col-md-12">
                        <div class="row justify-content-md-center">
                            <div class="col-md-1 col wedding-date-timer-time">@{{ this.countdown.timer.days }}</div>
                            <div class="col-md-1 col wedding-date-timer-time">@{{ this.countdown.timer.hours }}</div>
                            <div class="col-md-1 col wedding-date-timer-time">@{{ this.countdown.timer.minutes }}</div>
                            <div class="col-md-1 col wedding-date-timer-time">@{{ this.countdown.timer.seconds }}</div>
                        </div>
                        <div class="row justify-content-md-center">
                            <div class="col-md-1 col wedding-date-timer-info">Hari</div>
                            <div class="col-md-1 col wedding-date-timer-info">Jam</div>
                            <div class="col-md-1 col wedding-date-timer-info">Menit</div>
                            <div class="col-md-1 col wedding-date-timer-info">Detik</div>
                        </div>
                    </div>
                </div>
                <!-- ./ Timer -->

                <!-- Save Date Button -->
                <p class="text-center">
                    <a href="https://calendar.google.com/calendar/u/0/r/eventedit?text=Wedding+Aryo+dan+Ayaa&details=Selasa,+22+Februari+2022&dates=20220605T{{ $time_session_start }}0000/20220605T{{ $time_session_end }}0000&location=DK+Sindutan+RT+02/06+,DS+Amongrogo+,Kec+Limpung+,Kab+Batang"
                       class="btn wedding-date-button" target="_blank">
                        <i class="fa fa-calendar-check-o"></i> Save The Date
                    </a>
                </p>
                <!-- ./ Save Date Button -->
            </div>
        </div>

        <div class="row justify-content-md-center">
            <div class="col-md-8">
                <div class="row justify-content-md-center">
                    <div class="col-md-6" :data-aos="(setting.width > 767 ? 'fade-right' : 'fade-up')" data-aos-duration="1000">
                        <!-- Info -->
                        <p class="wedding-date-akad-resepsi">Akad Nikah</p>
                        <!-- ./ Info -->

                        <!-- Date -->
                        <div class="row">
                            <label for="staticEmail" class="col-md-2 col-2 col-form-label wedding-date-icon"><i class="fa fa-calendar"></i></label>
                            <div class="col-md-10 col-10">
                                <p class="wedding-date-info">Selasa, 22 Februari 2022</p>
                            </div>
                        </div>
                        <!-- ./ Date -->

                        <!-- Time -->
                        <div class="row">
                            <label for="staticEmail" class="col-md-2 col-2 col-form-label wedding-date-icon"><i class="fa fa-clock-o"></i></label>
                            <div class="col-md-10 col-10">
                                <p class="wedding-date-info">Pukul 08:00 WIB - Selesai</p>
                            </div>
                        </div>
                        <!-- ./ Time -->

                        <!-- Address -->
                        <div class="mb-4 row">
                            <label for="staticEmail" class="col-md-2 col-2 col-form-label wedding-date-icon"><i class="fa fa-home"></i></label>
                            <div class="col-md-10 col-10">
                                <p class="wedding-date-info">
                                    Dk Sindutan RT 02/03, DS Amongrogo, Kec Limpung, Kab Batang
                                </p>
                            </div>
                        </div>
                        <!-- ./ Address -->

                        <!-- Location Button -->
                        <p class="text-center">
                            <a href="https://maps.google.com/?q=-7.008508,109.949966" class="btn wedding-date-button" target="_blank">
                                <i class="fa fa-map-marker"></i> Lihat Lokasi
                            </a>
                        </p>
                        <!-- ./ Location Button -->
                    </div>
                    <div class="col-md-6" :data-aos="(setting.width > 767 ? 'fade-left' : 'fade-up')" data-aos-duration="1000">
                        <!-- Info -->
                        <p class="wedding-date-akad-resepsi">Resepsi</p>
                        <!-- ./ Info -->

                        <!-- Date -->
                        <div class="row">
                            <label for="staticEmail" class="col-md-2 col-2 col-form-label wedding-date-icon"><i class="fa fa-calendar"></i></label>
                            <div class="col-md-10 col-10">
                                <p class="wedding-date-info">Selasa, 22 Februari 2022</p>
                            </div>
                        </div>
                        <!-- ./ Date -->

                        <!-- Time -->
                        <div class="row">
                            <label for="staticEmail" class="col-md-2 col-2 col-form-label wedding-date-icon"><i class="fa fa-clock-o"></i></label>
                            <div class="col-md-10 col-10">
                                <p class="wedding-date-info">Pukul 13:00 WIB - Selesai</p>
                            </div>
                        </div>
                        <!-- ./ Time -->

                        <!-- Address -->
                        <div class="mb-4 row">
                            <label for="staticEmail" class="col-md-2 col-2 col-form-label wedding-date-icon"><i class="fa fa-home"></i></label>
                            <div class="col-md-10 col-10">
                                <p class="wedding-date-info">
                                    Dk Sindutan RT 02/03, DS Amongrogo, Kec Limpung, Kab Batang
                                </p>
                            </div>
                        </div>
                        <!-- ./ Address -->

                        <!-- Location Button -->
                        <p class="text-center">
                            <a href="https://maps.google.com/?q=-7.008508,109.949966" class="btn wedding-date-button" target="_blank">
                                <i class="fa fa-map-marker"></i> Lihat Lokasi
                            </a>
                        </p>
                        <!-- ./ Location Button -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
