<div class="container">
    <div class="row py-md-5">
        <div class="col">
            <div class="text-black">
                <h2>Our <b>Products</b></h2>
                <p>We offered pet products and we paid cash up front.
Buyers entering the site of one of our USA dealers, are directed to purchase these products through them. No other online outlets would sell in this manner.</p>

            </div>
        </div>
        <div class="col d-flex align-items-center justify-content-center">
            <div class="dropdown">
                <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Sort by
                </button>
                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                    <a class="dropdown-item" href="<?= base_url('main/menu_products/fewStock') ?>">Stock : Few to Many</a>
                    <a class="dropdown-item" href="<?= base_url('main/menu_products/manyStock') ?>">Stock : Many to Few</a>
                    <a class="dropdown-item" href="<?= base_url('main/menu_products/lowPrice') ?>">Price : Lower to Higher</a>
                    <a class="dropdown-item" href="<?= base_url('main/menu_products/highPrice') ?>">Price : Higher to Lower</a>
                </div>
            </div>

        </div>
    </div>
    <div class="row mt-5 justify-content-center">
        <?php foreach ($products as $p) : ?>
            <div class="card card-custom mx-2 mb-3">
                <a href="https://www.netflix.com/fr/">
                    <img src="<?= base_url(); ?>assets/products/<?= $p['image'] ?>" alt="" class="card-img">
                </a>
                <div class="card-body">
                    <h5 class="card-title text-secondary"><?= $p['product_name'] ?></h5>
                    <h5 class="card-subtitle mb-2 text-danger font-weight-bold">Rp <?= $p['product_price'] ?></h5>
                    <span class="badge badge-info"><?= $p['product_quantity'] ?></span></h6>
                </div>
            </div>
        <?php endforeach; ?>
        <div class="card card-custom mx-2 mb-3">
            <a href="https://www.hulu.com">
                <img src="https://apprecs.com/ios-meta/app-icons/256/376510438.jpg" alt="" class="card-img">
            </a>
        </div>
        <div class="card card-custom mx-2 mb-3">
            <a href="https://www.netflix.com/fr/">
                <img src="https://cdn1.iconfinder.com/data/icons/metro-ui-dock-icon-set--icons-by-dakirby/256/Netflix.png" alt="" class="card-img">
            </a>
        </div>
        <div class="card card-custom mx-2 mb-3">
            <a href="https://www.hulu.com">
                <img src="https://apprecs.com/ios-meta/app-icons/256/376510438.jpg" alt="" class="card-img">
            </a>
        </div>
        <div class="card card-custom mx-2 mb-3">
            <a href="https://www.netflix.com/fr/">
                <img src="https://cdn1.iconfinder.com/data/icons/metro-ui-dock-icon-set--icons-by-dakirby/256/Netflix.png" alt="" class="card-img">
            </a>
        </div>
        <div class="card card-custom mx-2 mb-3">
            <a href="https://www.hulu.com">
                <img src="https://apprecs.com/ios-meta/app-icons/256/376510438.jpg" alt="" class="card-img">
            </a>
        </div>
        <div class="card card-custom mx-2 mb-3">
            <a href="https://www.netflix.com/fr/">
                <img src="https://cdn1.iconfinder.com/data/icons/metro-ui-dock-icon-set--icons-by-dakirby/256/Netflix.png" alt="" class="card-img">
            </a>
        </div>
        <div class="card card-custom mx-2 mb-3">
            <a href="https://www.hulu.com">
                <img src="https://apprecs.com/ios-meta/app-icons/256/376510438.jpg" alt="" class="card-img">
            </a>
        </div>
        <div class="card card-custom mx-2 mb-3">
            <a href="https://www.netflix.com/fr/">
                <img src="https://cdn1.iconfinder.com/data/icons/metro-ui-dock-icon-set--icons-by-dakirby/256/Netflix.png" alt="" class="card-img">
            </a>
        </div>
        <div class="card card-custom mx-2 mb-3">
            <a href="https://www.hulu.com">
                <img src="https://apprecs.com/ios-meta/app-icons/256/376510438.jpg" alt="" class="card-img">
            </a>
        </div>
        <div class="card card-custom mx-2 mb-3">
            <a href="https://www.netflix.com/fr/">
                <img src="https://cdn1.iconfinder.com/data/icons/metro-ui-dock-icon-set--icons-by-dakirby/256/Netflix.png" alt="" class="card-img">
            </a>
        </div>
        <div class="card card-custom mx-2 mb-3">
            <a href="https://www.hulu.com">
                <img src="https://apprecs.com/ios-meta/app-icons/256/376510438.jpg" alt="" class="card-img">
            </a>
        </div>
        <div class="card card-custom mx-2 mb-3">
            <a href="https://www.netflix.com/fr/">
                <img src="https://cdn1.iconfinder.com/data/icons/metro-ui-dock-icon-set--icons-by-dakirby/256/Netflix.png" alt="" class="card-img">
            </a>
        </div>
        <div class="card card-custom mx-2 mb-3">
            <a href="https://www.hulu.com">
                <img src="https://apprecs.com/ios-meta/app-icons/256/376510438.jpg" alt="" class="card-img">
            </a>
        </div>
        <div class="card card-custom mx-2 mb-3">
            <a href="https://www.netflix.com/fr/">
                <img src="https://cdn1.iconfinder.com/data/icons/metro-ui-dock-icon-set--icons-by-dakirby/256/Netflix.png" alt="" class="card-img">
            </a>
        </div>
        <div class="card card-custom mx-2 mb-3">
            <a href="https://www.hulu.com">
                <img src="https://apprecs.com/ios-meta/app-icons/256/376510438.jpg" alt="" class="card-img">
            </a>
        </div>
        <div class="card card-custom mx-2 mb-3">
            <a href="https://www.netflix.com/fr/">
                <img src="https://cdn1.iconfinder.com/data/icons/metro-ui-dock-icon-set--icons-by-dakirby/256/Netflix.png" alt="" class="card-img">
            </a>
        </div>
        <div class="card card-custom mx-2 mb-3">
            <a href="https://www.hulu.com">
                <img src="https://apprecs.com/ios-meta/app-icons/256/376510438.jpg" alt="" class="card-img">
            </a>
        </div>
    </div>



</div>