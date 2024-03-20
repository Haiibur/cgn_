<!doctype html>
<html lang="en">

<head>
    <!-- // Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Required meta tags // -->

    <meta name="description" content="Kelola agenda kegiatan dengan mudah nyaman'">
    <meta name="author" content="Bravo Solution Indonesia">
    <title>CSS Keloa : Login</title>
    <!-- // Favicon -->
    <link href="<?=base_url('assets/img/favicon.png');?>" rel="icon" width="40">
    <!-- Favicon // -->

    <!-- // Google Web Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,600&display=swap" rel="stylesheet">
    <!-- Google Web Fonts // -->

    <!-- // Font Awesome 5 Free -->
    <link href="https://use.fontawesome.com/releases/v5.15.1/css/all.css"
        integrity="sha384-vp86vTRFVJgpjF9jiIGPEEqYqlDwgyBgEF109VFjmqGmIY/Y4HV4d3Gp2irVfcrp" crossorigin="anonymous"
        rel="stylesheet">
    <!-- Font Awesome 5 Free // -->

    <!-- // Template CSS files -->
    <link href="<?=base_url('assets/login');?>/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?=base_url('assets/login');?>/css/styles.css" rel="stylesheet">
    <link href="<?=base_url();?>assets/sweetalert2/dist/sweetalert2.min.css" rel="stylesheet" />
    <!-- Template CSS files  // -->
</head>

<body>
    <!-- // Preloader -->
    <div id="nm-preloader" class="nm-aic nm-vh-md-100">
        <div class="nm-ripple">
            <div></div>
            <div></div>
        </div>
    </div>
    <!-- Preloader // -->

    <main id="page-content" class="d-flex nm-aic nm-vh-md-100" style="position: relative;">
        <div class="overlay"></div>
        <div class="nm-tm-wr">
            <div class="container">
                <form id="ngepost" class="row row-eq-height lockscreen  mt-5 mb-5">
                    <div class="nm-hr nm-up-rl-3">
                        <h2>Login</h2>
                    </div>
                    <div class="input-group nm-gp">
                        <span class="nm-gp-pp"><i class="fas fa-user"></i></span>
                        <input type="text" class="form-control" name="user" id="emailaddress" tabindex="1"
                            placeholder="Username" required>
                    </div>

                    <div class="input-group nm-gp">
                        <span class="nm-gp-pp"><i class="fas fa-lock"></i></span>
                        <input type="password" class="form-control" id="myInput" name="password" tabindex="2"
                            placeholder="Password" required>
                    </div>
                    <div class="row nm-aic nm-mb-1">
                        <div class="col-sm-6 nm-mb-1 nm-mb-sm-0">
                            <button type="submit" class="btn btn-primary nm-hvr nm-btn-2">Masuk <span
                                    id="loading"></span></button>
                        </div>

                        <div class="col-sm-6 nm-sm-tr">
                            <a class="nm-fs-1 nm-fw-bd" href="<?=base_url('reset-password');?>">Lupa Password?</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </main>

    <!-- // Vendor JS files -->
    <script src="<?=base_url('assets/login');?>/js/jquery-3.6.0.min.js"></script>
    <script src="<?=base_url('assets/login');?>/js/bootstrap.bundle.min.js"></script>
    <!-- Vendor JS files // -->
    <!-- Sweet-Alert  -->
    <script src="<?=base_url();?>assets/sweetalert2/dist/sweetalert2.all.min.js"></script>
    <!-- Template JS files // -->
    <script src="<?=base_url('assets/login');?>/js/script.js"></script>
    <!-- Template JS files // -->

    <!-- ======================================================= -->
    <!-- // Setting to allow preview of different color variants -->
    <!-- ======================================================= -->
    <div id="settings"
        style="position: fixed; top: 20%; right: 0%; width: 40px; height: 40px; background-color: #000; color: #fff; display: flex; align-items: center; justify-content: center; cursor: pointer;">
        <i class="fas fa-cog"></i>
        <div id="colors"
            style="position: absolute; top: 40px; left: 40px; width: 40px; height: 240px; background-color: #000;">
            <a id="blue" href="#" style="display: block; width: 40px; height: 40px; background-color: #007bff;"></a>
            <a id="beige" href="#" style="display: block; width: 40px; height: 40px; background-color: #eab8a9;"></a>
            <a id="burgundy" href="#" style="display: block; width: 40px; height: 40px; background-color: #af102e;"></a>
            <a id="fuchsia" href="#" style="display: block; width: 40px; height: 40px; background-color: #600da8;"></a>
            <a id="turquoise" href="#"
                style="display: block; width: 40px; height: 40px; background-color: #50c8cc;"></a>
            <a href="../../index.html"
                style="display: block; width: 40px; height: 40px; background-color: #000; color: #fff; display: flex; align-items: center; justify-content: center;"><i
                    class="fas fa-home"></i></a>
        </div>
    </div>

    <script>
    let tmpLocation = window.location.href;
    let tmpEndLocation = tmpLocation.split("/");
    let targetLocation = tmpEndLocation[tmpEndLocation.length - 1];
    targetLocation = targetLocation.replace(".html", "").replace("#", "");
    let targetLocationArray = [];

    if (targetLocation.includes("_")) {
        targetLocationArray = targetLocation.split("_");
        targetLocationArray[1] = "_" + targetLocationArray[1];
    } else {
        targetLocationArray[0] = targetLocation;
        targetLocationArray[1] = "";
    }

    let l = document.links;
    for (let i = 0; i < l.length; i++) {
        let tmp = l[i].attributes.href.nodeValue;
        l[i].attributes.href.nodeValue = tmp.replace("recover", "recover" + targetLocationArray[1]).replace("login",
            "login" + targetLocationArray[1]).replace("signup", "signup" + targetLocationArray[1]);
    }

    document.getElementById("blue").setAttribute('href', "./" + targetLocationArray[0] + ".html");
    document.getElementById("beige").setAttribute('href', "./" + targetLocationArray[0] + "_1.html");
    document.getElementById("burgundy").setAttribute('href', "./" + targetLocationArray[0] + "_2.html");
    document.getElementById("fuchsia").setAttribute('href', "./" + targetLocationArray[0] + "_3.html");
    document.getElementById("turquoise").setAttribute('href', "./" + targetLocationArray[0] + "_4.html");

    document.getElementById("colors").style.transition = 'all 0.2s';
    document.getElementById("settings").addEventListener("click", () => {
        let leftPosition = document.getElementById("colors").style.left;

        if (leftPosition == '40px') {
            document.getElementById("colors").style.left = '0px';
        } else {
            document.getElementById("colors").style.left = '40px';
        }
    });
    ////
    $("#ngepost").submit(function(e) {
        //$('#nm-preloader').html("<div class='spinner-border spinner-border-sm text-warning' role='status'><span class='sr-only'></span></div>");
        $('#nm-preloader').show();
        e.preventDefault();
        $.ajax({
            url: "<?=base_url('cek-login');?>",
            type: "POST",
            data: new FormData(this),
            contentType: false,
            cache: false,
            async: false,
            processData: false,
            success: function(data) {
                $('#loading').hide();
                if (data == 1) {
                    window.location.href = '<?= base_url('Home'); ?>';
                } else if (data == 2) {
                    Swal.fire("GAGAL!", "Username atau Password salah!", "warning");
                } else if (data == 3) {
                    Swal.fire("GAGAL!", "Akun Tidak Ditemukan", "warning");
                }
            }
        });
    });
    </script>
    <!-- ======================================================= -->
    <!-- Setting to allow preview of different color variants // -->
    <!-- ======================================================= -->
</body>

</html>