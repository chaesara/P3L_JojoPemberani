<html>

<head>
    <!-- CSS only -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
</head>

<body>
    <div class="container-fluid">

        <div class="row pb-3" style="text-align: start;">
            <h5 style="text-align: center;">SURAT PEMESANAN</h5>
            <p>
                No : <?= $supply['supply_code']; ?> <br>
                <?= $supply['supply_date']; ?>
            </p>
        </div>
        <div class="row" style="text-align: right;">
            <div class="col" style="text-align: end;">
                <h1>Kouvee Pet Shop</h1>
                <p>Jl. Moses Gatotkaca No. 22 Yogyakarta 55281 <br>
                    Telp (0274) 357735 <br>
                    sayanghewan.com
                </p>
            </div>
            <div class="col">
                <p>Kepada Yth. <br>
                    <?= $supply['supplier_name']; ?> <br>
                    <?= $supply['supplier_address']; ?> <br>
                    <?= $supply['supplier_phoneno']; ?> <br>
                </p>
            </div>
        </div>
        <div class="row">
            <p >Mohon untuk disediakan produk-produk berikut ini : </p>
        </div>
        <div class="row">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Product Name</th>
                        <th>Packaging</th>
                        <th>Qty</th>
                        <th>Total</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $i = 1;
                    $subtotal = 0;
                    foreach ($details as $d) : ?>
                        <tr>
                            <td><?= $i++ ?></td>
                            <td><?= $d['product_name'] ?></td>
                            <td><?= $d['supply_detail_package'] ?></td>
                            <td><?= $d['supply_detail_quantity'] ?></td>
                            <td><?= $d['supply_detail_subtotal'] ?></td>
                            <?php $subtotal += $d['supply_detail_subtotal']; ?>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
                <tfoot>
                    <tr>
                        <td colspan="4" style="text-align: center; font-weight: bold">Subtotal</td>
                        <td style="font-weight: bold;"><?= $subtotal ?></td>
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