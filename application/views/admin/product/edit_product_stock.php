<?php $this->load->view('admin/include/header'); ?>

<?php $this->load->view('admin/include/sidebar'); ?>

    <div class="row">
        <div class="col-md-8">
            <div class="card card-solid">
                <div class="card-body">
                    <form action="<?= base_url('admin/edit_product_stock/').$this->uri->segment(3) ?>" method="post">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>
                                        <a href="<?= base_url('admin/edit_product/').$stock->product ?>" class="btn btn-default btn-sm"><i class="fa fa-arrow-left"></i> Ürüne geri dön</a>
                                    </label>
                                </div>
                                <div class="form-group">
                                    <label><?= Options::find($type->options)->name ?></label>
                                    <select name="sub_option" class="form-control">
                                        <?php foreach ($option_1 as $option): ?>
                                            <option value="<?= $option->id ?>" <?php if ($option->id == $stock->sub_option){echo 'selected';} ?>><?= $option->name ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                <?php if ($option_2 != null): ?>
                                    <div class="form-group">
                                        <label><?= Options::find($type->options2)->name ?></label>
                                        <select name="sub_option_2" class="form-control">
                                            <?php foreach ($option_2 as $option): ?>
                                                <option value="<?= $option->id ?>" <?php if ($option->id == $stock->sub_option2){echo 'selected';} ?>><?= $option->name ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                <?php endif; ?>
                                <div class="form-group">
                                    <label>Stock Count</label>
                                    <input type="number" name="stock" class="form-control" min="1" value="<?= $stock->stock ?>">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <button class="btn btn-block btn-flat btn-success" value="1" name="step1">Update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

<?php $this->load->view('admin/include/footer'); ?>