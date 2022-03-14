<?php $this->load->view('admin/include/header'); ?>

<?php $this->load->view('admin/include/sidebar'); ?>

    <div class="row">
        <div class="col-md-4">
            <a href="<?= base_url('admin/add_sub_option/').$option->id ?>" class="small-box-footer">
                <div class="small-box bg-info">
                    <div class="inner">
                        <h3>Creat Sub Options</h3>
                        <p>Ürün <strong>alt</strong> seçeneği oluşturmak için tıklayınız.</p>
                    </div>
                    <div class="icon">
                        <i class="fa fa-plus"></i>
                    </div>
                </div>
            </a>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="box box-solid">
                <div class="box-body">
                    <table id="category" class="table table-bordered table-striped">
                        <thead>
                        <tr>
                            <th>Sub Option</th>
                            <th>Process</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($suboptions as $option): ?>
                            <tr>
                                <td><?= $option->name ?></td>
                                <td>
                                    <a href="<?= base_url('admin/edit_sub_option/').$option->id ?>" class="btn btn-xs btn-default"><i class="fa fa-edit"></i> Edit</a>
                                    <a href="<?= base_url('admin/delete_sub_option/').$option->id ?>" class="btn btn-xs btn-danger" style="margin-left: 5px;"><i class="fa fa-trash"></i> Delete</a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

<?php $this->load->view('admin/include/footer'); ?>