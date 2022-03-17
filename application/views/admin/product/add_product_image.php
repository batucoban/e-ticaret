<?php $this->load->view('admin/include/header'); ?>

<?php $this->load->view('admin/include/sidebar'); ?>

    <div class="row">
        <div class="col-md-8">
            <div class="card card-solid">
                <div class="card-body">
                    <form action="<?= base_url('admin/add_product_image/'.$this->uri->segment(3) ) ?>" class="dropzone" enctype="multipart/form-data" method="post">

                    </form>
                    <div class="form-group">
                        <a href="<?= base_url('admin/add_product_stock_type/').$this->uri->segment(3) ?>" class="btn btn-success btn-flat btn-block">Add Product Options and Stock Information</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card card-primary card-outline">
                <div class="card-header">
                    <h5 class="card-title">STAGE 2</h5><br>
                    <div class="card-body">
                        <strong>Product Images</strong>
                    </div>
                </div>
            </div>
        </div>
    </div>

<?php $this->load->view('admin/include/footer'); ?>