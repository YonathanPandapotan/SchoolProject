<?php
    $page = (isset($_GET['page']) && $_GET['page']) ? $_GET['page'] : '';
?>

<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9"> <![endif]-->
<!--[if !IE]><!--> <html lang="en"> <!--<![endif]-->

<head>
    <meta charset="utf-8" />
    <title>SMP MERUYA ILLIR l</title>

    <!-- CSS -->
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('css/jquery.dataTables.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('css/style.css') }}" rel="stylesheet" />


    <!-- Javascript for animation -->
    <script type="text/javascript" src="{{ asset('js/jquery.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/jquery.dataTables.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/bootstrap.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/expand.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/common.js') }}"></script>
</head>

<body>

<!-- MAIN WEBSITE BEGIN -->
<div id="main">

    <!-- HEADER WEBSITE BEGIN -->
    <div id="header">
        <!-- LOGO WEBSITE -->
        <div id="logo">
            <h1>SMP MERUYA ILLIR l</h1>
            <h2>We Have Better Skills for Indonesia</h2>
        </div>

        <!-- SOCIAL MEDIA -->
        <div class="social">
            <ul>
                <li><a href="http://facebook.com" target="_blank"><img src="{{ asset('images/Facebook.png') }}" alt="facebook"></a></li>
                <li><a href="http://twitter.com" target="_blank"><img src="{{ asset('images/Twitter.png') }}" alt="twitter"></a></li>
            </ul>
        </div>

        <div class="clear"></div>
    </div>
    <!-- END OF HEADER WEBSITE -->

    <!-- TOP MENU WEBSITE BEGIN -->
    <div id="top-menu-website">
        <div class="left-side" style="margin-top: 48px;"></div>
        <div class="middle-side">
            <ul>
                <li><a href="/home" <?php if (strpos($_SERVER['REQUEST_URI'], '/home') !== false) echo 'class="current"'; ?>>Home</a></li>
                <li><a href="/bukutamu" <?php if (strpos($_SERVER['REQUEST_URI'], "bukutamu") !== false) echo 'class="current"'; ?>>Bukutamu</a></li>
                <li><a href="/artikel" <?php if (strpos($_SERVER['REQUEST_URI'], "artikel") !== false) echo 'class="current"';?>>Artikel</a></li>
                <li><a href="/datasiswa" <?php if (strpos($_SERVER['REQUEST_URI'], "datasiswa") !== false) echo 'class="current"'; ?>>Data Siswa</a></li>
                <li><a href="/dataguru" <?php if (strpos($_SERVER['REQUEST_URI'], "dataguru") !== false) echo 'class="current"'; ?>>Data Guru</a></li>
                <li><a href="/dataalumni" <?php if (strpos($_SERVER['REQUEST_URI'], "dataalumni") !== false) echo 'class="current"'; ?>>Data Alumni</a></li>
                <li><a href="/tentangsekolah" <?php if (strpos($_SERVER['REQUEST_URI'], "tentangsekolah") !== false) echo 'class="current"'; ?>>Tentang Sekolah</a></li>
                <li><a href="/kontak" <?php if (strpos($_SERVER['REQUEST_URI'], "kontak") !== false) echo 'class="current"'; ?>>Kontak</a></li>
                <li><a href="/login" <?php if (strpos($_SERVER['REQUEST_URI'], "login") !== false) echo 'class="current"'; ?>>Login</a></li>
            </ul>
            <div class="clear"></div>
        </div>
        <div class="right-side"></div>
        <div class="clear"></div>
    </div>
    <!-- END OF TOP MENU WEBSITE -->

    <?php
        if($page == "" || $page == "home") {
     ?>

    <!-- SLIDER WEBSITE BEGIN -->
    <div id="slider-website">

        <div id="myCarousel" class="carousel slide" data-ride="carousel">
            <!-- Indicators -->
            <ol class="carousel-indicators">
                <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
                <li data-target="#myCarousel" data-slide-to="1"></li>
                <li data-target="#myCarousel" data-slide-to="2"></li>
            </ol>

            <!-- Wrapper for slides -->
            <div class="carousel-inner" role="listbox">
                <div class="item active">
                    <img src="{{ asset('images/banner_1.jpg') }}" alt="Sekolahku rumahku">
                </div>

                <div class="item">
                    <img src="{{ asset('images/banner_2.jpg') }}" alt="Sekolahku rumahku">
                </div>

                <div class="item">
                    <img src="{{ asset('images/banner_3.jpg') }}" alt="Sekolahku rumahku">
                </div>
            </div>

            <!-- Left and right controls -->
            <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev">
                <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
            </a>
            <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next">
                <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
            </a>
        </div>
    </div>
    <?php } ?>
    <!-- END OF SLIDER WEBSITE -->

    <!-- CONTENT WEBSITE BEGIN -->
    <div id="content">

        <!-- LEFT CONTENT WEBSITE BEGIN -->
        <div id="left-content">

            @yield('kontent')

                   </div>
        <!-- END OF LEFT CONTENT WEBSITE -->

        <!-- RIGHT CONTENT WEBSITE BEGIN -->
        <div id="right-content">

            <!-- ARTIKEL TERBARU -->
            <div class="right-panel">
                <div class="top-right-panel">Artikel Terbaru</div>
                <div class="bottom-right-panel">
                    <ul>
                        <?php
                            foreach($data['main_artikel'] as $artikel) {
                         ?>
                            <li><a href="/artikel/detail/<?php echo $artikel->id_artikel; ?>/<?php echo $artikel->judul; ?>"><?php echo $artikel->judul; ?></a></li>
                         <?php
                            }
                          ?>
                    </ul>
                </div>
            </div>

            <!-- KATEGORI ARTIKEL -->
            <div class="right-panel">
                <div class="top-right-panel">Kategori Artikel</div>
                <div class="bottom-right-panel">
                    <ul>
                        <?php
                            foreach ($data['kategori'] as $kategori) {
                         ?>
                             <li>
                                <a href="/listKategori/<?php echo Str::slug($kategori->nama_kategori); ?>">
                                    <?php echo $kategori->nama_kategori; ?>
                                    (<?php echo $kategori->total; ?>)
                                </a>
                            </li>
                         <?php } ?>
                    </ul>
                </div>
            </div>

            <!-- INFO USER -->
            <div class="right-panel">
                <div class="top-right-panel">Info User</div>
                <div class="bottom-right-panel">

                    <table class="table" style="margin-bottom: 0;">
                        <tbody>
                        <tr>
                            <td style="border-top:0;">IP User</td>
                            <td style="border-top:0;">:</td>
                            <td style="border-top:0;">
                                <b>
                                    <?php echo $_SERVER['REMOTE_ADDR']; ?>
                                </b>

                            </td>
                        </tr>
                        <tr>
                            <td>Waktu</td>
                            <td>:</td>
                            <td>
                                <b>
                                    <?php
                                        date_default_timezone_set("Asia/Jakarta");
                                        echo date('h : i : s');
                                    ?>
                                </b>
                            </td>
                        </tr>
                        <tr>
                            <td>Tanggal</td>
                            <td>:</td>
                            <td>
                                <b>
                                    <?php echo date("d F Y"); ?>
                                </b>
                            </td>
                        </tr>
                        <tr>
                            <td>Browser</td>
                            <td>:</td>
                            <td>
                                <b>
                                    <?php
                                        echo $_SERVER['HTTP_USER_AGENT'];
                                     ?>
                                </b>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
        <!-- END OF RIGHT CONTENT WEBSITE -->

        <div class="clear"></div>

    </div>
    <!-- END OF CONTENT WEBSITE -->

    <!-- FOOTER WEBSITE BEGIN -->
    <div id="footer">
        <div class="content-footer">
            <div class="left-footer"></div>
            <div class="middle-footer">
                &copy; Copyright by
            </div>
            <div class="right-footer"></div>
        </div>
        <div class="clear"></div>
    </div>
</div>
<!-- END OF MAIN WEBSITE -->


</body>
</html>