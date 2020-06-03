<html>

<head>
    <!-- CSS only -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
</head>

<body>
    <div class="container">

        <div class="row pb-3" style="text-align: start;">
            <h5 style="text-align: center;">MONTHLY INCOME REPORT</h5><br>
            <p>
                Year : <?= $date['year'] ?><br>
                Month : <?= $date['month'] ?>
            </p>
        </div>
        <h1>Kouvee Pet Shop</h1>
        <p>Jl. Moses Gatotkaca No. 22 Yogyakarta 55281 <br>
            Telp (0274) 357735 <br>
            sayanghewan.com
        </p>
        <div class="row">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Product Name</th>
                        <th>Price</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $i = 1;
                    $subtotal = 0;
                    foreach ($products as $d) : ?>
                        <tr>
                            <td><?= $i++ ?></td>
                            <td><?= $d['nama_layanan'] ?></td>
                            <td><?= $d['jumlah_pendapatan'] ?></td>
                            <?php $subtotal += $d['jumlah_pendapatan']; ?>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
                <tfoot>
                    <tr>
                        <td colspan="2" style="text-align: center; font-weight: bold">Total</td>
                        <td style="font-weight: bold;">Rp <?= $subtotal ?></td>
                    </tr>
                </tfoot>
            </table>
        </div>
        <div class="row">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Service Name</th>
                        <th>Price</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $i = 1;
                    $subtotal = 0;
                    foreach ($services as $d) : ?>
                        <tr>
                            <td><?= $i++ ?></td>
                            <td><?= $d['nama_layanan'] ?></td>
                            <td><?= $d['jumlah_pendapatan'] ?></td>
                            <?php $subtotal += $d['jumlah_pendapatan']; ?>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
                <tfoot>
                    <tr>
                        <td colspan="2" style="text-align: center; font-weight: bold">Total</td>
                        <td style="font-weight: bold;">Rp <?= $subtotal ?></td>
                    </tr>
                </tfoot>
            </table>
        </div>

        <div class="row" style="text-align: end; text-align: right;">
            <p>Dicetak tanggal : <?= $print_date; ?></p>
        </div>

    </div>


</body>

</html>