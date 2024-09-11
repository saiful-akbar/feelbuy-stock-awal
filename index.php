<?php

require_once __DIR__ . '/vendor/autoload.php';

use App\App;

$date = (!empty($_GET['month'])) ? $_GET['month'] : date('Y-m');
$date = explode('-', $date);

$year = $date[0];
$month = $date[1];

?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="base-url" content="<?= App::baseUrl() ?>">

    <title>Stock Awal</title>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="<?= App::baseUrl('/node_modules/bootstrap/dist/css/bootstrap.min.css') ?>">

    <!-- Style -->
    <style>
        #preloader {
            position: fixed;
            width: 100%;
            height: 100%;
            top: 0;
            bottom: 0;
            left: 0;
            right: 0;
            z-index: 9999;
            display: flex;
            justify-content: center;
            align-items: center;
            opacity: 0.75;
        }
    </style>
</head>

<body>
    <script>
        const currentTheme = localStorage.getItem('theme') ?? 'light';
        const html = document.querySelector('html');
        html.dataset.bsTheme = currentTheme;
    </script>

    <div id="preloader" class="bg-dark">
        <div class="spinner-grow" style="width: 3rem; height: 3rem;" role="status">
            <span class="visually-hidden">Loading...</span>
        </div>
    </div>

    <div class="container my-5">
        <h1 class="h1">Download Stock Awal</h1>

        <hr class="my-5">

        <section class="mb-5">
            <div class="row">
                <div class="col-lg-4 col-md-6 col-12 mb-3 mb-md-0">
                    <label for="theme" class="form-label">Theme</label>

                    <select name="theme" id="theme" class="form-select">
                        <option value="light">Light</option>
                        <option value="dark">Dark</option>
                    </select>
                </div>

                <div class="col-lg-4 col-md-6 col-12">
                    <label for="month" class="form-label">Month</label>

                    <input type="month" name="month" id="month"
                        value='<?= "$year-$month" ?>' class="form-control">
                </div>
            </div>
        </section>

        <section class="card">
            <div class="card-header py-3">
                <button type="button" id="downloadAll" class="btn btn-success bg-gradient">
                    Download All
                </button>

                <button type="button" id="downloadJabo" class="btn btn-primary bg-gradient">
                    Download Jabo
                </button>

                <button type="button" id="downloadSR" class="btn btn-primary bg-gradient">
                    Download SR
                </button>
            </div>

            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped w-100">
                        <thead>
                            <tr>
                                <th>REGION</th>
                                <th>DOWNLOAD</th>
                            </tr>
                        </thead>

                        <tbody>
                            <?php foreach (App::regions() as $region) : ?>
                                <tr>
                                    <td><?= $region['name'] ?></td>
                                    <td>
                                        <a href="<?= App::jstockUrl("?year={$year}&month={$month}&sub_region={$region['id']}&store=all") ?>"
                                            class="btn btn-danger btn-sm bg-gradient">
                                            Download
                                        </a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </section>
    </div>

    <!-- Javascript vendor -->
    <script src="<?= App::baseUrl('/node_modules/bootstrap/dist/js/bootstrap.min.js') ?>"></script>
    <script src="<?= App::baseUrl('/node_modules/jquery/dist/jquery.min.js') ?>"></script>

    <!-- Hide preloader -->
    <script>
        $(document).ready(function() {
            $('#preloader').fadeOut();
        });
    </script>

    <!-- Change month -->
    <script>
        $('#month').change(function(e) {
            e.preventDefault();

            const baseUrl = $('meta[name=base-url]').attr('content');
            const value = $(this).val();

            window.location.href = `${baseUrl}?month=${value}`;
        });
    </script>

    <!-- Download all stock -->
    <script>
        const regions = [
            {id: "32", name: "JABO 1", region: "Jabo"},
            {id: "33", name: "JABO 2", region: "Jabo"},
            {id: "34", name: "JABO 3", region: "Jabo"},
            {id: "35", name: "JABO 4", region: "Jabo"},
            {id: "36", name: "JABO 5", region: "Jabo"},
            {id: "37", name: "JABO 6", region: "Jabo"},
            {id: "38", name: "JABO 7", region: "Jabo"},
            {id: "39", name: "JABO 8", region: "Jabo"},
            {id: "40", name: "JABO 9", region: "Jabo"},
            {id: "16", name: "SR 1", region: "Special Region"},
            {id: "17", name: "SR 2", region: "Special Region"},
            {id: "18", name: "SR 3", region: "Special Region"},
            {id: "29", name: "SR 4", region: "Special Region"},
            {id: "26", name: "SR 5", region: "Special Region"},
            {id: "30", name: "SR 6", region: "Special Region"},
        ];

        $('#downloadAll').click(function(e) {
            e.preventDefault();

            regions.forEach(region => {
                let url = '<?= App::jstockUrl() ?>';

                url += '?year=<?= $year ?>';
                url += '&month=<?= $month ?>';
                url += `&sub_region=${region.id}`;
                url += '&store=all';

                window.open(url, '_blank');
            });
        });

        $('#downloadJabo').click(function(e) {
            e.preventDefault();

            regions.forEach(region => {
                if (region.region === 'Jabo') {
                    let url = '<?= App::jstockUrl() ?>';

                    url += '?year=<?= $year ?>';
                    url += '&month=<?= $month ?>';
                    url += `&sub_region=${region.id}`;
                    url += '&store=all';

                    window.open(url, '_blank');
                }
            });
        });

        $('#downloadSR').click(function(e) {
            e.preventDefault();

            regions.forEach(region => {
                if (region.region === 'Special Region') {
                    let url = '<?= App::jstockUrl() ?>';

                    url += '?year=<?= $year ?>';
                    url += '&month=<?= $month ?>';
                    url += `&sub_region=${region.id}`;
                    url += '&store=all';

                    window.open(url, '_blank');
                }
            });
        });
    </script>

    <!-- Change theme -->
    <script>
        $('#theme').val(currentTheme);

        $('#theme').change(function(e) {
            e.preventDefault();

            $('html').attr('data-bs-theme', $(this).val());
            localStorage.setItem('theme', $(this).val());
        });
    </script>
</body>

</html>