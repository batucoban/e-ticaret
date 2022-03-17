<?php $this->load->view('admin/include/header'); ?>

<?php $this->load->view('admin/include/sidebar'); ?>

    <div class="row">
        <div class="col-md-8">
            <div class="card card-solid">
                <div class="card-body">
                    <form action="<?= base_url('admin/add_product_stock/').$this->uri->segment(3) ?>" method="post">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label><?= Options::find($type->options)->name ?></label>
                                    <select name="sub_option" class="form-control">
                                        <?php foreach ($option_1 as $option): ?>
                                            <option value="<?= $option->id ?>"><?= $option->name ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                <?php if ($option_2 != null): ?>
                                <div class="form-group">
                                    <label><?= Options::find($type->options2)->name ?></label>
                                    <select name="sub_option_2" class="form-control">
                                        <?php foreach ($option_2 as $option): ?>
                                            <option value="<?= $option->id ?>"><?= $option->name ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                <?php endif; ?>
                                <div class="form-group">
                                    <label>Stock Count</label>
                                    <input type="number" name="stock" class="form-control" min="1" value="1">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <button class="btn btn-block btn-flat btn-success" value="1" name="step1">Add</button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="card card-primary">
                <div class="card-body">
                    <?php foreach ($stocks as $stock): ?>
                    <li><?= Options::find($type->options)->name.' : '.SubOptions::find($stock->sub_option)->name.' - '.Options::find($type->options2)->name.' : '.SubOptions::find($stock->sub_option2)->name.' - Stok Sayısı : '.$stock->stock ?></li>
                    <?php endforeach; ?>
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
            </div><a href="<?= base_url('admin/product_controller/').$this->uri->segment(3) ?>" class="btn btn-primary btn-flat btn-block"><i class="fa fa-check"></i> Save</a>
        </div>

    </div>

<?php $this->load->view('admin/include/footer'); ?>