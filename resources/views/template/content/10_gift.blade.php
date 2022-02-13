<section id="weddingGift" class="wedding-gift container">
    <div class="container">
        <div class="row justify-content-md-center">
            <div class="col-md-8">
                <!-- Title -->
                <p class="wedding-gift-title">Wedding Gift</p>
                <!-- ./ Title -->

                <!-- Description -->
                <p class="wedding-gift-description" data-aos="fade-up" data-aos-duration="1000">Bagi keluarga dan sahabat yang ingin mengirimkan hadiah, silahkan mengirimkannya melalui:</p>
                <!-- ./ Description -->

                <!-- Button Gift -->
                <div class="row justify-content-md-center">
                    <div class="col-md-3 text-center">
                        <button type="button" class="btn wedding-gift-button" data-bs-toggle="modal" data-bs-target="#modalTransfer" :data-aos="(setting.width > 767 ? 'fade-right' : 'fade-up')" data-aos-duration="1000">
                            <i class="fa fa-money"></i> Transfer
                        </button>
                    </div>
                    <div class="col-md-3 text-center">
                        <button type="button" class="btn wedding-gift-button" data-bs-toggle="modal" data-bs-target="#modalKirim" :data-aos="(setting.width > 767 ? 'fade-left' : 'fade-up')" data-aos-duration="1000">
                            <i class="fa fa-gift"></i> Kirim
                        </button>
                    </div>
                </div>
                <!-- ./ Button Gift -->
            </div>
        </div>
    </div>

    <!-- Modal Transfer -->
    <div class="modal fade wedding-gift-modal-transfer" id="modalTransfer" tabindex="-1" aria-labelledby="modalTransfer" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-body">
                    <!-- Close Button -->
                    <button type="button" class="btn-close wedding-gift-close-modal" data-bs-dismiss="modal" aria-label="Close"></button>
                    <!-- ./ Close Button -->

                    <div class="row justify-content-md-center">
                        <div class="col-md-8">
                            <!-- Description -->
                            <p class="wedding-gift-description">Silahkan transfer hadiah melalui nomor rekening maupun dompet digital berikut:</p>
                            <!-- ./ Description -->
                        </div>

                        <div class="col-md-12">
                            <div class="row">
                                <!-- Separator -->
                                <div class="col-md-12 text-center">
                                    <img class="wedding-gift-modal-separator" src="{{ asset('assets/img/img-separator-modal.png') }}" alt="Transfer Account" height="50">
                                </div>
                                <!-- ./ Separator -->

                                <!-- Transfer List -->
                                <div id="bankMandiri" class="col-md-4 col-md-offset-4 text-center wedding-gift-modal-list" style="margin-left: 33.3333333333%">
                                    <img src="{{ asset('assets/img/img-transfer-mandiri.png') }}" alt="Bank Mandiri" height="30">
                                    <p class="wedding-gift-no-rekening wedding-gift-target">1390019372022</p>
                                    <p class="wedding-gift-name">Aryo Pambudi</p>
                                    <button type="button" class="btn btn-dark wedding-gift-copy" @click="copyToClipboard('#bankMandiri')">
                                        <i class="fa fa-copy"></i> &nbsp;&nbsp; Copy Nomor Rekening
                                    </button>
                                    <input type="text" class="wedding-gift-copy-text" value="-">
                                </div>
                                <!-- ./ Transfer List -->

                                <!-- Separator -->
                                <div class="col-md-12 text-center">
                                    <img class="wedding-gift-modal-separator" src="{{ asset('assets/img/img-separator-modal.png') }}" alt="Transfer Account" height="50">
                                </div>
                                <!-- ./ Separator -->
                            </div>
                        </div>

                        <div class="col-md-8">
                            <!-- Description -->
                            <p class="wedding-gift-description mt-3">Sebelumnya, kami ucapkan terimakasih atas perhatian dan bentuk tanda cinta Bapak/Ibu/Saudara/i untuk kami</p>
                            <!-- ./ Description -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- ./ Modal Transfer -->

    <!-- Modal Kirim -->
    <div class="modal fade wedding-gift-modal-transfer" id="modalKirim" tabindex="-1" aria-labelledby="modalKirim" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-body">
                    <!-- Close Button -->
                    <button type="button" class="btn-close wedding-gift-close-modal" data-bs-dismiss="modal" aria-label="Close"></button>
                    <!-- ./ Close Button -->

                    <div class="row justify-content-md-center">
                        <div class="col-md-8">
                            <!-- Description -->
                            <p class="wedding-gift-description mb-0">Silahkan kirim kado ke alamat berikut :</p>
                            <!-- ./ Description -->
                        </div>

                        <div class="col-md-12">
                            <div class="row">
                                <!-- Transfer List -->
                                <div id="alamatKirim" class="col-md-12 text-center wedding-gift-modal-list">
                                    <p class="wedding-gift-no-rekening">Ari Kustian</p>
                                    <p class="wedding-gift-name wedding-gift-target">Dk Sindutan RT 02/03, DS Amongrogo, Kec Limpung, Kab Batang</p>
                                    <button type="button" class="btn btn-dark wedding-gift-copy mt-4" data-copy="123456" @click="copyToClipboard('#alamatKirim')">
                                        <i class="fa fa-copy"></i> &nbsp;&nbsp; Copy Alamat
                                    </button>
                                    <input type="text" class="wedding-gift-copy-text" value="-">
                                </div>
                                <!-- ./ Transfer List -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- ./ Modal Kirim -->
</section>
