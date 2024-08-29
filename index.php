<?php

require_once __DIR__ . '/vendor/autoload.php';

use App\App;

$date = explode('-', $_GET['month'] ?? date('Y-m'));
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
</head>

<body>
    <script>
        const currentTheme = localStorage.getItem('theme') ?? 'light';
        const html = document.querySelector('html');
        html.dataset.bsTheme = currentTheme;
    </script>

    <div class="container my-5">
        <div class="row">
            <div class="col-lg-4 col-md-6 col-12 mb-3 mb-md-0">
                <label for="theme" class="form-label">Theme</label>

                <select name="theme" id="theme" class="form-select">
                    <option value="light">Light</option>
                    <option value="dark">Dark</option>
                </select>
            </div>

            <div class="col-lg-4 col-md-6 col-12">
                <label for="month" class="form-label">Select Month</label>

                <input type="month"
                    name="month"
                    id="month"
                    value="<?= $_GET['month'] ?? date('Y-m') ?>"
                    class="form-control">
            </div>
        </div>

        <hr class="my-5">

        <div class="card">
            <div class="card-header py-3">
                <button type="button" id="downloadAll" class="btn btn-primary bg-gradient">
                    Download All
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
        </div>
    </div>

    <!-- Javascript vendor -->
    <script src="<?= App::baseUrl('/node_modules/bootstrap/dist/js/bootstrap.min.js') ?>"></script>
    <script src="<?= App::baseUrl('/node_modules/jquery/dist/jquery.min.js') ?>"></script>

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
        const regions = [{
                "id": "32",
                "name": "JABO 1"
            },
            {
                "id": "33",
                "name": "JABO 2"
            },
            {
                "id": "34",
                "name": "JABO 3"
            },
            {
                "id": "35",
                "name": "JABO 4"
            },
            {
                "id": "36",
                "name": "JABO 5"
            },
            {
                "id": "37",
                "name": "JABO 6"
            },
            {
                "id": "38",
                "name": "JABO 7"
            },
            {
                "id": "39",
                "name": "JABO 8"
            },
            {
                "id": "40",
                "name": "JABO 9"
            },
            {
                "id": "16",
                "name": "SR 1"
            },
            {
                "id": "17",
                "name": "SR 2"
            },
            {
                "id": "18",
                "name": "SR 3"
            },
            {
                "id": "29",
                "name": "SR 4"
            },
            {
                "id": "26",
                "name": "SR 5"
            },
            {
                "id": "30",
                "name": "SR 6"
            }
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