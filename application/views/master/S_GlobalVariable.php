<script type="text/javascript">
    var stack_center = {
        "dir1": "down",
        "dir2": "right",
        "firstpos1": 25,
        "firstpos2": ($(window).width() / 2) - (Number(PNotify.prototype.options.width.replace(/\D/g, '')) / 2)
    };

    const messageError = (msg, msgtext, msgtype) => {
        Swal.fire(msg, msgtext, msgtype);
    }

    const message = (msg, msgtext, msgtype) => {
        Swal.fire(msg, msgtext, msgtype);
    }

    const message_topright = (type, msg) => {
        const Toast = Swal.mixin({
            toast: true,
            position: "top-end",
            showConfirmButton: false,
            timer: 3000,
            didOpen: (toast) => {
                toast.addEventListener("mouseenter", Swal.stopTimer);
                toast.addEventListener("mouseleave", Swal.resumeTimer);
            },
        });

        Toast.fire({
            icon: type,
            title: msg,
        });
    }

    window.location.back = '';

    $(document).ready(function() {
        window.history.pushState(null, "", window.location.href);

        window.onpopstate = function() {
            window.history.pushState(null, "", window.location.href);
        };

        var iserror = '<?php if (isset($_SESSION['temp_error'])) {
                            echo $_SESSION['temp_error'];
                        } ?>';

        if (iserror != '') {
            ShowPNotifyMessage('error', iserror, 'Error');

        }

        Translate();
    });

    $(window).resize(function() {
        stack_center.firstpos2 = ($(window).width() / 2) - (Number(PNotify.prototype.options.width.replace(/\D/g,
            '')) / 2);
    });

    function hexToRGB(h) {
        let r = 0,
            g = 0,
            b = 0;

        // 3 digits
        if (h.length == 4) {
            r = "0x" + h[1] + h[1];
            g = "0x" + h[2] + h[2];
            b = "0x" + h[3] + h[3];

            // 6 digits
        } else if (h.length == 7) {
            r = "0x" + h[1] + h[2];
            g = "0x" + h[3] + h[4];
            b = "0x" + h[5] + h[6];
        }

        var arrColor = [];

        r = +r;
        g = +g;
        b = +b;

        arrColor.push({
            r,
            g,
            b
        });

        return arrColor;

        //return "rgb("+ +r + "," + +g + "," + +b + ")";
    }

    function RGBToHex(c) {
        var hex = c.toString(16);
        return hex.length == 1 ? "0" + hex : hex;
    }

    function ShowPNotifyMessage(tipe, Message, Tt) {
        var msg = Message;
        var msgtype = tipe;

        //if (!window.__cfRLUnblockHandlers) return false;
        new PNotify
            ({
                title: Tt,
                text: msg,
                type: msgtype,
                styling: 'bootstrap3',
                delay: 3000,
                stack: stack_center
            });
    }

    function ShowMessage(tipe, kode, iserrorfromdb, additionalinfo = null) {
        if (iserrorfromdb == 0) {
            var msg = GetLanguageByKode(kode);
        } else if (iserrorfromdb == 1) {
            var msg = kode;
        } else {
            var msg = 'Access Violation';
            var tipe = 'error';
        }

        if (additionalinfo == 'null') {
            var msgtype = tipe + additionalinfo;
        } else {
            var msgtype = tipe;
        }

        var judul = 'Info';

        //if (!window.__cfRLUnblockHandlers) return false;
        new PNotify
            ({
                title: judul,
                text: msg,
                type: msgtype,
                styling: 'bootstrap3',
                delay: 3000,
                stack: stack_center
            });
    }

    async function Translate() {
        <?php
        $Bahasa = json_encode($_SESSION['BahasaList']);
        ?>

        var Bhs = await JSON.parse('<?= $Bahasa; ?>');

        for (i = 0; i < Bhs.length; i++) {
            var bahasa_id = Bhs[i].bahasa_id;
            var bahasa_kode = Bhs[i].bahasa_kode;
            var bahasa_nama = Bhs[i].bahasa_nama;
            var bahasa = Bhs[i].bahasa;

            $("label[name=" + bahasa_kode + "]").html(bahasa);
            $("span[name=" + bahasa_kode + "]").html(bahasa);
            $("td[name=" + bahasa_kode + "]").html(bahasa);
            $("th[name=" + bahasa_kode + "]").html(bahasa);
            $("h1[name=" + bahasa_kode + "]").html(bahasa);
            $("h2[name=" + bahasa_kode + "]").html(bahasa);
            $("h3[name=" + bahasa_kode + "]").html(bahasa);
            $("h4[name=" + bahasa_kode + "]").html(bahasa);
            $("h5[name=" + bahasa_kode + "]").html(bahasa);
            $("h6[name=" + bahasa_kode + "]").html(bahasa);
            $("h7[name=" + bahasa_kode + "]").html(bahasa);
            $("a[name=" + bahasa_kode + "]").html(bahasa);
        }
    }


    function ShowLanguage() {
        $.ajax({
            type: 'POST',
            url: "<?= base_url('Global/Language/GetLanguage') ?>",
            success: function(response) {
                ChShowLanguageMenu(response);
            }
        });
    }

    function ChShowLanguageMenu(JSONLanguage) {
        var Language = JSON.parse(JSONLanguage);

        $("#tbFlag").html('');
        for (i = 0; i < Language.LanguageMenu.length; i++) {
            var flag_kode = Language.LanguageMenu[i].flag_kode;
            var flag_nama = Language.LanguageMenu[i].flag_nama;

            var ispilihflag = '<?= $_SESSION['Bahasa']; ?>';

            var ischecked = '';
            if (ispilihflag == flag_kode) {
                ischecked = 'checked="checked"';
            }

            var str = '';

            str += '<tr>';
            str +=
                '	<td width="10%"><input type="radio" name="rbpilihbahasa" class="checkbox_form chpilihbahasa" data-bahasa="' +
                flag_kode + '" ' + ischecked + ' /></td>';
            str += '	<td width="20%"><img src="<?= base_url('assets/images/Flag'); ?>/' + flag_kode +
                '.png" class="img-responsive" /></td>';
            str += '	<td width="70%"><strong>' + flag_nama + '</strong></td>';
            str += '</tr>';

            $("#tbFlag").append(str);
        }

        $("#previewshowlanguage").modal('show');
    }

    $("#btnyespilihbahasa").click(
        function() {
            var lbahasa = $(".chpilihbahasa").length;

            var flag_kode = '';

            for (i = 0; i < lbahasa; i++) {
                if ($(".chpilihbahasa").eq(i).prop('checked') == true) {
                    flag_kode = $(".chpilihbahasa").eq(i).attr('data-bahasa');
                }
            }

            localStorage.setItem("defaultlanguage", flag_kode);

            window.location = '<?= base_url('Global/Language/SelectLanguage'); ?>/' + flag_kode;
        }
    );

    function GetLanguageByKode(bahasa_kode) {
        var BahasaList = JSON.parse('<?= $Bahasa; ?>');

        var obj = BahasaList.find(o => o.bahasa_kode === bahasa_kode);

        return obj.bahasa;
    }

    /*$('input').on('input', function()
    {
    	var c = this.selectionStart,
    		r = /[^a-z0-9 ]/gi,
    		v = $(this).val();
    	if(r.test(v)) 
    	{
    		$(this).val(v.replace(r, ''));
    	c--;
      }
      this.setSelectionRange(c, c);
    });*/



    const theme = document.querySelector('body');

    let darkMode = localStorage.getItem("dark-mode");

    const enableDarkMode = () => {
        $("*").addClass("dark-mode");

        $("button").removeClass('dark-mode');
        $("button i").removeClass('dark-mode');
        $("button label").removeClass('dark-mode');
        $("input").removeClass('dark-mode');
        $("select").removeClass('dark-mode');
        $(".select2").removeClass('dark-mode');
        $(".select2-selection").removeClass('dark-mode');
        $(".select2-selection__rendered").removeClass('dark-mode');
        $(".select2-selection__arrow").removeClass('dark-mode');
        $(".select2-selection__arrow b").removeClass('dark-mode');
        $(".select2-results__options").removeClass('dark-mode');
        $(".select2-results__option").removeClass('dark-mode');
        $("textarea").removeClass('dark-mode');
        $("td div").removeClass('dark-mode');
        $("td div strong").removeClass('dark-mode');
        $("header").removeClass('dark-mode');
        $("header div").removeClass('dark-mode');
        $("header div label").removeClass('dark-mode');
        $(".panel").removeClass('dark-mode');
        $(".panel-body").removeClass('dark-mode');
        $(".panelimg").removeClass('dark-mode');
        $(".panelimg img").removeClass('dark-mode');
        $(".tab-pane").removeClass('dark-mode');
        $(".tab-pane div").removeClass('dark-mode');
        $(".treeitem").removeClass('dark-mode');

        $("#btndarkmode").html('<i style="font-size: 14pt; color: white;" id="dark" class="fa fa-moon"></i>');
        //toggleBtn.classList.remove("dark-mode");
        localStorage.setItem("dark-mode", "enabled");
    };

    const disableDarkMode = () => {
        $("*").removeClass("dark-mode");

        $("button").removeClass('dark-mode');
        $("button i").removeClass('dark-mode');
        $("button label").removeClass('dark-mode');
        $("input").removeClass('dark-mode');
        $("select").removeClass('dark-mode');
        $(".select2").removeClass('dark-mode');
        $(".select2-selection").removeClass('dark-mode');
        $(".select2-selection__rendered").removeClass('dark-mode');
        $(".select2-selection__arrow").removeClass('dark-mode');
        $(".select2-selection__arrow b").removeClass('dark-mode');
        $(".select2-results__options").removeClass('dark-mode');
        $(".select2-results__option").removeClass('dark-mode');
        $("textarea").removeClass('dark-mode');
        $("td div").removeClass('dark-mode');
        $("td div strong").removeClass('dark-mode');
        $("header").removeClass('dark-mode');
        $("header div").removeClass('dark-mode');
        $("header div label").removeClass('dark-mode');
        $(".panel").removeClass('dark-mode');
        $(".panel-body").removeClass('dark-mode');
        $(".panelimg").removeClass('dark-mode');
        $(".panelimg img").removeClass('dark-mode');
        $(".tab-pane").removeClass('dark-mode');
        $(".tab-pane div").removeClass('dark-mode');
        $(".treeitem").removeClass('dark-mode');

        $("#btndarkmode").html('<i style="font-size: 14pt; color: #eab308;" id="dark" class="fa fa-sun"></i>');

        //toggleBtn.classList.add("dark-mode");
        localStorage.setItem("dark-mode", "disabled");
    };

    if (darkMode === "enabled") {
        enableDarkMode(); // set state of darkMode on page load
    }

    function ToggleMode(event) {
        darkMode = localStorage.getItem("dark-mode"); // update darkMode when clicked
        if (darkMode === "disabled") {
            enableDarkMode();
        } else {
            disableDarkMode();
        }

        //var list = document.querySelectorAll(".nav-md , .container.body, .right_col");
        //console.log( list );
        //list.classList.add("dark-mode");
        /*$("div").toggleClass("dark-mode");
        $("footer").toggleClass("dark-mode");
        $("strong").toggleClass("dark-mode");
        $("li").toggleClass("dark-mode");
        $("a").toggleClass("dark-mode");*/
    }

    /*toggleBtn.addEventListener("click", (e) => {
      darkMode = localStorage.getItem("dark-mode"); // update darkMode when clicked
      if (darkMode === "disabled") {
    	enableDarkMode();
      } else {
    	disableDarkMode();
      }
    });*/

    const message_global = (msg, msgtext, msgtype) => {
        Swal.fire(msg, msgtext, msgtype);
    }

    const message_topright_global = (type, msg) => {
        const Toast = Swal.mixin({
            toast: true,
            position: "top-end",
            showConfirmButton: false,
            timer: 3000,
            didOpen: (toast) => {
                toast.addEventListener("mouseenter", Swal.stopTimer);
                toast.addEventListener("mouseleave", Swal.resumeTimer);
            },
        });

        Toast.fire({
            icon: type,
            title: msg,
        });
    }

    const messageNotSameLastUpdated = (url = "") => {

        let closeInSeconds = 5,
            displayText = "#1 Detik",
            timer;
        Swal.fire({
            icon: 'warning',
            title: displayText.replace(/#1/, closeInSeconds),
            text: 'Pengguna Lain telah memperbarui data pada dokumen ini, Tekan Ok untuk memuat ulang halaman atau akan dimuat ulang secara otomatis dalam 5 detik.',
            timer: closeInSeconds * 1000,
            allowOutsideClick: false
        }).then((result) => {
            if (result.value) {
                if (url !== "") {
                    location.href = "<?= base_url() ?>" + encodeURI(url)
                } else {
                    location.reload();
                }
            }
        });

        timer = setInterval(function() {
            closeInSeconds--;
            if (closeInSeconds < 0) clearInterval(timer);
            $('.swal2-title').text(displayText.replace(/#1/, closeInSeconds));
        }, 1000);

        setTimeout(() => {
            if (url !== "") {
                location.href = "<?= base_url() ?>" + encodeURI(url)
            } else {
                location.reload();
            }
        }, 5000)
    }

    const showLoading = (condition, disabledButtonAction, params = 0) => {
        disabledButtonAction !== "" ? $(disabledButtonAction).prop("disabled", condition) : '';
        Swal.fire({
            title: '<div class="spinner-border" role="status"></div> <span>Loading ...</span>',
            timerProgressBar: false,
            showConfirmButton: false,
            allowOutsideClick: false,
            timer: params
        });
    }

    const messageBoxBeforeRequest = (textMessage, textButtonConfirm, textButtonCancel) => {
        return Swal.fire({
            title: "Apakah anda yakin?",
            text: textMessage,
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: textButtonConfirm,
            cancelButtonText: textButtonCancel
        })
    }

    const postData = async (url = '', data = {}, type, callbackSuccess, disabledButtonAction = "", multipartFormdata =
        "") => {

        showLoading(true, disabledButtonAction)

        if (type === "GET") {
            await fetch(url).then((response) => {
                if (response.ok) return response.json();
                throw new Error('Something went wrong');
            }).then((data) => {
                showLoading(false, disabledButtonAction, 10)
                callbackSuccess(data)
            }).catch((error) => {
                showLoading(false, disabledButtonAction, 10)
                message_global("Error", error, 'error')
            });
        }

        if (type === "POST") {
            if (multipartFormdata === "") {
                await fetch(url, {
                    method: type,
                    headers: {
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify(data)
                }).then((response) => {
                    if (response.ok) return response.json();
                    throw new Error(`${response.status} ${response.statusText}`);
                }).then((data) => {
                    showLoading(false, disabledButtonAction, 10)
                    callbackSuccess(data)
                }).catch((error) => {
                    showLoading(false, disabledButtonAction, 10)
                    message_global("Error", error.message, 'error')
                });
            }

            if (multipartFormdata === "multipart-formdata") {
                await fetch(url, {
                    method: type,
                    body: data.formData
                }).then((response) => {
                    if (response.ok) return response.json();
                    throw new Error(`${response.status} ${response.statusText}`);
                }).then((data) => {
                    showLoading(false, disabledButtonAction, 10)
                    callbackSuccess(data)
                }).catch((error) => {
                    showLoading(false, disabledButtonAction, 10)
                    message_global("Error", error.message, 'error')
                });
            }

            if (multipartFormdata !== "" && multipartFormdata !== "multipart-formdata") {
                message_global("Error!",
                    'If you upload file, parameter the last must be <strong>multipart-formdata</strong>',
                    'error')
                return false;
            }

        }
    }

    const requestAjax = (urlRequest, dataRequet = {}, typePost, typeOutput, callbackSuccess, disabledButtonAction = "",
        multipartFormdata = "") => {

        showLoading(false, disabledButtonAction)

        if (typePost == "GET") {
            $.ajax({
                url: urlRequest,
                type: typePost,
                dataType: typeOutput,
                beforeSend: function() {
                    showLoading(false, disabledButtonAction)
                },
                success: function(response) {
                    showLoading(false, disabledButtonAction, 10)
                    callbackSuccess(response)
                },
                error: function(xhr, error, status) {
                    showLoading(false, disabledButtonAction, 10)
                    message_global("Error!", `${status} ${error}`, 'error');
                },
            });
        }

        if (typePost == "POST") {
            if (multipartFormdata === "") {
                $.ajax({
                    url: urlRequest,
                    type: typePost,
                    data: dataRequet,
                    dataType: typeOutput,
                    beforeSend: function() {
                        showLoading(false, disabledButtonAction)
                    },
                    success: function(response) {
                        showLoading(false, disabledButtonAction, 10)
                        callbackSuccess(response)
                    },
                    error: function(xhr, error, status) {
                        showLoading(false, disabledButtonAction, 10)
                        message_global("Error!", `${status} ${error}`, 'error');
                    },
                });
            }

            if (multipartFormdata === "multipart-formdata") {
                $.ajax({
                    type: typePost,
                    url: urlRequest,
                    data: dataRequet.dataForm,
                    contentType: false,
                    processData: false,
                    dataType: typeOutput,
                    beforeSend: function() {
                        showLoading(false, disabledButtonAction)
                    },
                    success: function(response) {
                        showLoading(false, disabledButtonAction, 10)
                        callbackSuccess(response)
                    },
                    error: function(xhr, error, status) {
                        showLoading(false, disabledButtonAction, 10)
                        message_global("Error!", `${status} ${error}`, 'error');
                    },
                });
            }

            if (multipartFormdata !== "" && multipartFormdata !== "multipart-formdata") {
                message_global("Error!",
                    'If you upload file, parameter the last must be <strong>multipart-formdata</strong>', 'error')
                return false;
            }
        }


    }

    function changeFormatRupiah(input, angka) {
        input.value = formatRupiah(angka);
    }

    function formatRupiah(angka) {

        var number_string = angka.replace(/[^,\d]/g, '').toString(),
            split = number_string.split(','),
            sisa = split[0].length % 3,
            rupiah = split[0].substr(0, sisa),
            ribuan = split[0].substr(sisa).match(/\d{3}/gi);

        // tambahkan titik jika yang di input sudah menjadi angka ribuan
        if (ribuan) {
            separator = sisa ? '.' : '';
            rupiah += separator + ribuan.join('.');
        }

        const cek_minus = angka.split("-");
        if (cek_minus.length > 1) {
            rupiah = split[1] != undefined ? "-" + rupiah + ',' + split[1] : "-" + rupiah;
        } else {
            rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
        }

        return rupiah;
    }

    function formatDate(tanggal) {
        const date = new Date(tanggal);
        let yyyy = date.getFullYear();
        let mm = date.getMonth() + 1; // Months start at 0!
        let dd = date.getDate();

        if (dd < 10) dd = '0' + dd;
        if (mm < 10) mm = '0' + mm;

        return dd + '/' + mm + '/' + yyyy;
    }

    function changeFormatRupiah(input, angka) {
        input.value = formatRupiah(angka);
    }

    function changeFormatRupiahCurr(input, angka) {
        input.value = formatRupiahCurr(angka);
    }

    function formatRupiah(angka) {
        var number_string = angka.replace(/[^,\d]/g, '').toString(),
            split = number_string.split(','),
            sisa = split[0].length % 3,
            rupiah = split[0].substr(0, sisa),
            ribuan = split[0].substr(sisa).match(/\d{3}/gi);

        // tambahkan titik jika yang di input sudah menjadi angka ribuan
        if (ribuan) {
            separator = sisa ? '.' : '';
            rupiah += separator + ribuan.join('.');
        }

        const cek_minus = angka.split("-");
        if (cek_minus.length > 1) {
            rupiah = split[1] != undefined ? "-" + rupiah + ',' + split[1] : "-" + rupiah;
        } else {
            rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
        }

        return rupiah;
    }

    function formatRupiahCurr(money) {
        // console.log(parseFloat(money.toString().replaceAll(".", "").replaceAll(",", ".")));
        var angka = new Intl.NumberFormat('id-ID', {
                style: 'currency',
                currency: 'IDR',
                minimumFractionDigits: 4
            } // diletakkan dalam object
        ).format(parseFloat(money.toString().replaceAll(".", "").replaceAll(",", ".")));

        return angka.replaceAll("Rp ", "");
    }
</script>
<?php $this->load->view('master/Global/S_DiagramMenu'); ?>
<?php $this->load->view('master/Global/S_InitialMessage'); ?>
</body>

</html>

<?php
$_SESSION['temp_error'] = '';
?>