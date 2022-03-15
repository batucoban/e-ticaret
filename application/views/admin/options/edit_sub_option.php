<?php $this->load->view('admin/include/header'); ?>

<?php $this->load->view('admin/include/sidebar'); ?>

    <div class="row">
        <div class="col-md-4">
            <div class="card card-solid">
                <div class="card-body">
                    <form action="<?= base_url('admin/edit_sub_option/').$option->id ?>" method="post">
                        <div class="form-group">
                            <label>Sub Option</label>
                            <input type="text" name="option" class="form-control" value="<?= $option->name ?>" required>
                        </div>
                        <div class="form-group">
                            <button class="btn btn-block btn-flat btn-success">Edit Sub Option</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

<?php $this->load->view('admin/include/footer'); ?>