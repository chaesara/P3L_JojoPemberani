<html>

<head>
    <!-- CSS only -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
</head>

<body>
    <div class="container-fluid">

        <div class="row pb-3" style="text-align: start;">
            <h3 style="text-align: center;">NOTA LUNAS
                <?php if (substr($transaction['transaction_code'], 0, 2) === 'PR') : ?>
                    PRODUK
                <?php else : ?>
                    LAYANAN
                <?php endif; ?>
            </h3>
            <p>
                No : <?= $transaction['transaction_code']; ?> <br>
                <?= $print_date; ?>
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
                <p>
                    Customer : <?= $transaction['customer_name']; ?> <br>
                    Phone : <?= $transaction['customer_phoneno']; ?> <br> <br>
                    CS : <?= $transaction['cs_name']; ?> <br>
                    Cashier : <?= $transaction['cashier_name']; ?> <br>
                </p>
            </div>
        </div>
        <div class="row">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>No</th>
                        <?php if (substr($transaction['transaction_code'], 0, 2) === 'PR') : ?>
                            <th>Product Name</th>
                        <?php else : ?>
                            <th>Service Name</th>
                        <?php endif; ?>
                        <th>Price</th>
                        <th>Qty</th>
                        <th>Total Price</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $i = 1;
                    foreach ($details as $d) : ?>
                        <tr>
                            <td><?= $i++ ?></td>
                            <?php if (substr($transaction['transaction_code'], 0, 2) === 'PR') : ?>
                                <td><?= $d['service_name'] ?></td>
                                <td><?= $d['product_price'] ?></td>
                                <td><?= $d['transaction_product_quantity'] ?></td>
                                <td><?= $d['transaction_product_subtotal'] ?></td>
                            <?php else : ?>
                                <td><?= $d['service_name'] ?></td>
                                <td><?= $d['service_price'] ?></td>
                                <td><?= $d['transaction_service_quantity'] ?></td>
                                <td><?= $d['transaction_service_subtotal'] ?></td>
                            <?php endif; ?>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
                <tfoot>
                    <tr>
                        <td colspan="4" style="text-align: center; font-weight: bold">Subtotal</td>
                        <td style="font-weight: bold;"><?= $transaction['transaction_subtotal'] ?></td>
                    </tr>
                </tfoot>
            </table>
        </div>

        <div class="row" style="text-align: end; text-align: right; font-weight: bold;">
            <p>
                Sub Total : Rp <?= $transaction['transaction_subtotal']; ?> <br>
                Discount : Rp <?= $transaction['transaction_discount']; ?> <br>
                Total : Rp <?= $transaction['transaction_total']; ?> <br>
            </p>
        </div>

    </div>


</body>

</html>