<?php $this->load->view('admin/include/header'); ?>

<?php $this->load->view('admin/include/sidebar'); ?>

    <div class="row">
        <div class="col-md-8">
            <div class="card card-solid">
                <div class="card-body">
                    <form action="<?= base_url('admin/add_product_stock_type/').$this->uri->segment(3) ?>" method="post">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Option 1</label>
                                    <select name="sub_category" class="form-control">
                                        <?php foreach ($options as $option): ?>
                                            <option value="<?= $option->id ?>"><?= $option->name ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Option 2 (Opsiyonel)</label>
                                    <select name="sub_category_2" class="form-control">
                                        <option value="0">Seçiniz.</option>
                                        <?php foreach ($options as $option): ?>
                                            <option value="<?= $option->id ?>"><?= $option->name ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <button class="btn btn-block btn-flat btn-success" value="1" name="step1">Next</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card card-primary card-outline">
                <div class="card-header">
                    <h5 class="card-title">STAGE 3</h5><br>
                    <div class="card-body">
                        <strong>Product Options and Stock</strong>
                    </div>
                </div>
            </div>
        </div>
    </div>

<?php $this->load->view('admin/include/footer'); ?>