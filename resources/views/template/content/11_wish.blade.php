<section id="weddingWish" class="wedding-wish container">
    <div class="container">
        <div class="row justify-content-md-center">
            <div class="col-md-8">
                <!-- Image -->
                <p class="text-center">
                    <img class="wedding-wish-img" src="{{ asset('assets/img/img-intro.png') }}" alt="Doa">
                </p>
                <!-- ./ Image -->

                <!-- Title -->
                <p class="wedding-wish-title">
                    Best Wishes
                </p>
                <!-- ./ Title -->
                <hr>

                <!-- Form Submit -->
                <form class="row" id="formComment" method="POST" enctype="multipart/form-data">
                    <div class="col-md-12">
                        <!-- Input -->
                        <textarea placeholder="Write a message" aria-label="Write a message" required="" name="comment" class="wedding-wish-input-comment" v-model="messages.comment"></textarea>
                        <!-- ./ Input -->

                        <!-- Name -->
                        <div class="input-group flex-nowrap wedding-wish-person">
                            <span class="input-group-text"><i class="fa fa-user"></i></span>
                            <input type="text" class="form-control" placeholder="Nama" aria-label="Nama" aria-describedby="addon-wrapping" v-model="person.name">
                        </div>
                        <!-- ./ Name -->

                        <!-- Submit Button -->
                        <button type="button" class="wedding-wish-submit" @click="saveComment()">Send</button>
                        <!-- ./ Submit Button -->
                    </div>
                    <input type="hidden" name="_token" v-model="setting.token">
                </form>
                <!-- Form Comment -->

                <!-- Comment List -->
                <div class="row">
                    <!-- Comment Title -->
                    <div class="col-md-12 mt-3">
                        <p class="wedding-wish-comment-title" v-if="messages.data.length > 0">Messages</p>
                    </div>
                    <!--./ Comment Title -->

                    <!-- Comment Row -->
                    <div class="col-md-12">
                        <!-- Comment Box-->
                        <div v-for="(row,i) in messages.data" class="wedding-wish-comment-box" data-aos="fade-up" data-aos-duration="1000">
                            <a v-if="row.invitation_id == person.id && messages.editIndex != i" href="javascript:void(0)" class="wedding-wish-comment-edit" @click="messages.editIndex = i">
                                <i class="fa fa-pencil"></i>
                            </a>
                            <p class="wedding-wish-comment-person">
                                <span class="wedding-wish-comment-name">@{{ row.name }}</span>
                                <span class="wedding-wish-comment-time"><i class="fa fa-clock-o"></i> @{{ timeAgo(row.created_at) }}</span>
                            </p>
                            <p v-if="messages.editIndex != i" class="wedding-wish-comment-text">@{{ row.message }}</p>
                            <textarea v-if="messages.editIndex == i" placeholder="Write a message" aria-label="Write a message" required="" name="comment" class="wedding-wish-input-edit" v-model="row.message"></textarea>

                            <div v-if="messages.editIndex == i" class="row text-right">
                                <div class="col-md-12">
                                    <button type="button" class="wedding-wish-submit" @click="updateComment(i)">Save</button>
                                    <button type="button" class="wedding-wish-submit-cancel" @click="messages.editIndex = -1">Cancel</button>
                                </div>
                            </div>
                        </div>
                        <!-- ./ Comment Box-->
                    </div>
                    <!--./ Comment Row -->

                    <div v-if="messages.showLoadMore" class="col-md-12 text-center" data-aos="fade-up" data-aos-duration="1000">
                        <button type="button" class="wedding-wish-comment-load" @click="loadComment(false)">Lihat Lainnya</button>
                    </div>
                </div>
                <!-- ./ Comment List -->
            </div>
        </div>
    </div>
</section>
