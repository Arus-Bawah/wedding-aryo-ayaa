<section id="invitationBox" class="wedding-invitation">
    <div class="wedding-invitation-box-overlay"></div>

    <!-- Invitation Content -->
    <div class="text-center wedding-invitation-content">
        <div class="row justify-content-md-center">
            <div class="col-md-8">
                <!-- Name -->
                <h2 class="wedding-invitation-title">We Invite You to Celebrate Our Wedding</h2>
                <!-- ./ Name -->
            </div>

            <!-- Form -->
            <form v-if="this.person.id == ''" id="formNewInvitation" enctype="multipart/form-data" method="POST" class="col-md-8">
                <div class="row justify-content-md-center">
                    <div class="col-md-6">
                        <div class="input-group">
                            <input type="text" required max="10" aria-label="Nama" name="name" class="form-control" placeholder="Nama" v-model="person.name">
                        </div>
                    </div>
                </div>
                <div class="row justify-content-md-center mt-3">
                    <div class="col-md-6">
                        <div class="input-group">
                            <input type="text" required max="10" aria-label="Lokasi" name="location" class="form-control" placeholder="Dari/Lokasi/Alamat" v-model="person.location">
                        </div>
                    </div>
                </div>
                <br>
                <input type="hidden" name="_token" v-model="setting.token">
            </form>
            <!-- ./ Form -->

            <div class="col-md-8">
                <!-- Button -->
                <button id="btnInvitation" type="button" class="wedding-invitation-button" @click="hideInvitation()">Open Invitation</button>
                <!-- ./ Button -->
            </div>
        </div>
    </div>
    <!-- ./ Invitation Content -->
</section>
