<div class="container-fluid">
    <?= $this->session->flashdata('message'); ?>
    <h1 class="h3 mb-2 text-gray-800">Add Product</h1>
    <div class="card o-hidden border-0 my-5 col-lg-12 mx-auto">
        <form method="post" class="my-3 mx-3" id="submit" enctype="multipart/form-data">
            <div class="form-group">
                <label for="name">Product Name</label>
                <input type="text" class="form-control" id="product_name" name="product_name" placeholder="Susu Murni Nasional">
                <?= form_error('product_name', '<small class="text-danger pl-3">', '</small>') ?>
            </div>
            <div class="form-group">
                <label for="inputImage">Product Image</label>
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="inputGroupFileAddon01">Upload</span>
                    </div>
                    <div class="custom-file">
                        <input type="file" class="custom-file-input" name="imgInp" id="imgInp">
                        <label class="custom-file-label" for="inputImage">Choose file</label>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <img style="height:200px;
                    width:200px;" id="image" src="#" alt="">
            </div>

            <div class="form-group">
                <label for="price">Price</label>
                <div class="input-group mb-3">
                    <span class="input-group-text" id="basic-addon1">Rp </span>
                    <input type="text" class="form-control" id="product_price" name="product_price" placeholder="how valuable is it ?">
                    <?= form_error('product_price', '<small class="text-danger pl-3">', '</small>') ?>
                </div>
            </div>
            <div class="form-group">
                <label for="quantity">Quantity</label>
                <div class="input-group mb-3">
                    <input type="text" class="form-control" id="product_quantity" name="product_quantity" placeholder="how much unit we have ?">
                    <?= form_error('product_quantity', '<small class="text-danger pl-3">', '</small>') ?>
                </div>
            </div>
            <button type="submit" class="btn btn-primary btn-user btn-block">
                Add Product
            </button>
        </form>
    </div>
</div>
<script>
    $(document).ready(function() {
        $('#submit').on('submit', function(e) {
            e.preventDefault();
            if ($('#imgInp').val() == '') {
                alert("Please Select the File");
            } else {
                $.ajax({
                    url: "<?php echo base_url(); ?>products/add_products",
                    method: "POST",
                    data: new FormData(this),
                    contentType: false,
                    cache: false,
                    processData: false,
                    success: function(data) {
                        alert("upload success");
                    }
                });
            }
        });
    });
</script>
</div>