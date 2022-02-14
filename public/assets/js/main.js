new Vue({
    el: '#root',
    data: {
        ajaxProcess: false,
        setting: {
            baseUrl: '',
            token: '',
            width: document.documentElement.clientWidth,
        },
        music: {
            audio: null,
            audioLoop: 0,
            list: []
        },
        messages: {
            comment: '',
            latest_id: 0,
            showLoadMore: false,
            editIndex: -1,
            data: [],
        },
        countdown: {
            date: 'February 22, 2022 13:00:00',
            timer: {
                days: '0',
                hours: '0',
                minutes: '0',
                seconds: '0',
            }
        },
        person: {
            id: '',
            name: '',
            location: '',
            sesi: '',
        }
    },
    created() {
        // setup variable
        this.setting.baseUrl = baseUrl;
        this.setting.token = token;
        this.music.list = listMusic;
        this.person = person;
        this.countdown.date = listDate[this.person.sesi];

        // countdown
        setInterval(() => {
            this.countdownRun();
        }, 1000);

        // load comment
        this.loadComment(true);

        // scroll bottom
        $(document).on('click', '.wedding-banner-button', () => {
            $([document.documentElement, document.body]).animate({
                scrollTop: $("#weddingIntro").offset().top
            }, 1);
        });

        // disabled inspect element
        document.addEventListener('contextmenu', (e) => {
            e.preventDefault();
        });
        // $(document).on('keydown', (e) => {
        //     if (e.keyCode === 123) {
        //         return false;
        //     }
        //     if (e.ctrlKey && e.shiftKey && e.keyCode === 'I'.charCodeAt(0)) {
        //         return false;
        //     }
        //     if (e.ctrlKey && e.shiftKey && e.keyCode === 'C'.charCodeAt(0)) {
        //         return false;
        //     }
        //     if (e.ctrlKey && e.shiftKey && e.keyCode === 'J'.charCodeAt(0)) {
        //         return false;
        //     }
        //     if (e.ctrlKey && e.keyCode === 'U'.charCodeAt(0)) {
        //         return false;
        //     }
        // });
    },
    methods: {
        hideInvitation() {
            // make scrolling body
            document.body.style.overflow = "scroll";

            // save new data
            if (this.person.id === '' || this.person.name === '' || this.person.location === '') {
                this.savePerson();
            }

            // open invitation
            if (this.person.id !== '') {
                $('#invitationBox').slideUp(1000);
                this.startAudio();
            }

            // animation
            AOS.init();
        },
        countdownRun() {
            let countDownDate = new Date(this.countdown.date).getTime();
            let now = new Date().getTime();
            let distance = countDownDate - now;

            // If the count down is over, write some text
            if (distance < 0) {
                this.countdown.timer = {
                    days: '0',
                    hours: '0',
                    minutes: '0',
                    seconds: '0',
                }
            } else {
                let days = Math.floor(distance / (1000 * 60 * 60 * 24));
                let hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                let minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
                let seconds = Math.floor((distance % (1000 * 60)) / 1000);

                this.countdown.timer = {
                    days: (days < 10 ? '0' + days : days),
                    hours: (hours < 10 ? '0' + hours : hours),
                    minutes: (minutes < 10 ? '0' + minutes : minutes),
                    seconds: (seconds < 10 ? '0' + seconds : seconds),
                }
            }
        },

        // AJAX activity
        savePerson() {
            if (!this.ajaxProcess) {
                if (this.person.name === '') {
                    alert('Nama tidak boleh kosong!');
                } else if (this.person.location === '') {
                    alert('Dari/Lokasi/Alamat tidak boleh kosong!');
                } else {
                    // main variable
                    let data = new FormData($('#formNewInvitation')[0]);
                    let settings = {
                        type: 'POST',
                        url: this.setting.baseUrl + '/save-invitation',
                        cache: false,
                        timeout: 300000,
                        dataType: 'json',
                        processData: false,
                        contentType: false,
                        data: data
                    };
                    this.ajaxProcess = true;
                    this.showLoading();

                    // push data
                    $.ajax(settings).done((response) => {
                        if (response.status) {
                            this.person = response.data;
                            this.setting.token = response.token;
                        }

                        $('#invitationBox').slideUp(1000);
                        this.startAudio();
                        this.ajaxProcess = false;
                        this.hideLoading();
                        console.log(response);
                    }).fail((jqXHR, textStatus, errorThrown) => {
                        this.ajaxProcess = false;
                        alert('Failed!,' + textStatus + '(' + jqXHR.status + ') ' + errorThrown);
                        this.hideLoading();
                    });
                }
            }
        },

        // music
        startAudio() {
            // showing button
            $('.btn-pause').show();

            // start playing music
            this.music.audio = new Audio(this.music.list[this.music.audioLoop]);
            this.music.audio.play();
            this.music.audio.onended = () => {
                if (this.music.audioLoop === (this.music.list.length - 1)) {
                    this.music.audioLoop = 0;
                } else {
                    this.music.audioLoop += 1;
                }

                // loop music if ended
                this.startAudio();
            };
        },
        playAudio() {
            // handling pause/play music
            this.music.audio.play();
            $('.btn-pause').show();
            $('.btn-play').hide();
        },
        pauseAudio() {
            // handling pause/play music
            this.music.audio.pause();
            $('.btn-pause').hide();
            $('.btn-play').show();
        },

        // messages
        loadComment(firstLoad = true) {
            if (!this.ajaxProcess) {
                // main variable
                let settings = {
                    type: 'GET',
                    url: this.setting.baseUrl + '/comment',
                    cache: false,
                    timeout: 300000,
                    dataType: 'json',
                    processData: true,
                    contentType: false,
                    data: {
                        latest_id: this.messages.latest_id
                    }
                };
                console.log(settings);
                if (!firstLoad) {
                    this.showLoading();
                }

                // push data
                $.ajax(settings).done((response) => {
                    // check latest id
                    let length = response.data.length;
                    let last_id;

                    // parse data
                    $.each(response.data, (i, row) => {
                        this.messages.data.push(row);
                        last_id = row.id;
                    });

                    // parse messages settings
                    this.messages.latest_id = last_id;
                    this.messages.showLoadMore = length >= 10;

                    this.hideLoading();
                    console.log(response);
                }).fail((jqXHR, textStatus, errorThrown) => {
                    this.hideLoading();
                    alert('Failed!,' + textStatus + '(' + jqXHR.status + ') ' + errorThrown);
                });
            }
        },
        saveComment() {
            if (!this.ajaxProcess) {
                // main variable
                let data = new FormData($('#formComment')[0]);
                let settings = {
                    type: 'POST',
                    url: this.setting.baseUrl + '/comment/save',
                    cache: false,
                    timeout: 300000,
                    dataType: 'json',
                    processData: false,
                    contentType: false,
                    data: data
                };
                this.showLoading();

                // push data
                $.ajax(settings).done((response) => {
                    if (response.status) {
                        this.messages.comment = "";
                        this.messages.data.unshift(response.data);
                        this.setting.token = response.token;
                    }

                    this.hideLoading();
                    console.log(response);
                }).fail((jqXHR, textStatus, errorThrown) => {
                    this.hideLoading();
                    alert('Failed!,' + textStatus + '(' + jqXHR.status + ') ' + errorThrown);
                });
            }
        },
        updateComment(i) {
            if (!this.ajaxProcess) {
                // main variable
                let settings = {
                    type: 'POST',
                    url: this.setting.baseUrl + '/comment/update/' + this.messages.data[i].id,
                    timeout: 300000,
                    data: {
                        comment: this.messages.data[i].message,
                        _token: this.setting.token
                    }
                };
                console.log(settings);
                this.showLoading();

                // push data
                $.ajax(settings).done((response) => {
                    if (response.status) {
                        this.messages.data[i] = response.data;
                        this.setting.token = response.token;
                    }

                    this.messages.editIndex = -1;
                    this.hideLoading();
                    console.log(response);
                }).fail((jqXHR, textStatus, errorThrown) => {
                    this.hideLoading();
                    alert('Failed!,' + textStatus + '(' + jqXHR.status + ') ' + errorThrown);
                });
            }
        },
        timeAgo(dateTime) {
            let time = +new Date(dateTime);
            let time_formats = [
                [60, 'seconds', 1], // 60
                [120, '1 menit yang lalu', '1 menit dari sekarang'], // 60*2
                [3600, 'menit', 60], // 60*60, 60
                [7200, '1 jam yang lalu', '1 jam dari sekarang'], // 60*60*2
                [86400, 'jam', 3600], // 60*60*24, 60*60
                [172800, 'Kemarin', 'Besok'], // 60*60*24*2
                [604800, 'hari', 86400], // 60*60*24*7, 60*60*24
                [1209600, 'Minggu yang lalu', 'Minggu Depan'], // 60*60*24*7*4*2
                [2419200, 'minggu', 604800], // 60*60*24*7*4, 60*60*24*7
                [4838400, 'Bulan yang lalu', 'Bulan Depan'], // 60*60*24*7*4*2
                [29030400, 'bulan', 2419200], // 60*60*24*7*4*12, 60*60*24*7*4
                [58060800, 'Tahun yang lalu', 'Tahun Depan'], // 60*60*24*7*4*12*2
                [2903040000, 'tahun', 29030400], // 60*60*24*7*4*12*100, 60*60*24*7*4*12
                [5806080000, 'Abad Terakhir', 'Next Selanjutnya'], // 60*60*24*7*4*12*100*2
                [58060800000, 'abad', 2903040000] // 60*60*24*7*4*12*100*20, 60*60*24*7*4*12*100
            ];
            let seconds = (+new Date() - time) / 1000,
                token = 'yang lalu',
                list_choice = 1;

            if (seconds === 0) {
                return 'Baru saja'
            }
            if (seconds < 0) {
                seconds = Math.abs(seconds);
                token = 'dari sekarang';
                list_choice = 2;
            }
            var i = 0,
                format;
            while (format = time_formats[i++])
                if (seconds < format[0]) {
                    if (typeof format[2] == 'string')
                        return format[list_choice];
                    else
                        return Math.floor(seconds / format[2]) + ' ' + format[1] + ' ' + token;
                }
            return time;
        },

        // loading
        showLoading() {
            $('#loading').show();
            this.ajaxProcess = true;
        },
        hideLoading() {
            $('#loading').hide();
            this.ajaxProcess = false;
        },

        // copy clipboard
        copyToClipboard(element) {
            // main variable & element
            let box = $(element);
            let number = box.find('.wedding-gift-target').text();
            let button = box.find('button');
            let input = box.find('input');

            // set new value
            input.val(number);

            // copy text
            input[0].select();
            input[0].setSelectionRange(0, 99999);
            document.execCommand("copy");

            // change text info
            let oldHtml = button.html();
            button.html("Berhasil disalin ke clipboard");
            setTimeout(() => {
                button.html(oldHtml);
            }, 2000);
        },
    },
});
