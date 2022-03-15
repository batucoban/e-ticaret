<?php $this->load->view('admin/include/header'); ?>

<?php $this->load->view('admin/include/sidebar'); ?>

    <div class="row">
        <div class="col-md-4">
            <div class="card card-solid">
                <div class="card-body">
                    <form action="<?= base_url('admin/add_sub_option/').$this->uri->segment(3) ?>" autocomplete="off" method="post">
                        <div class="form-group">
                            <label>Sub Option</label>
                            <input type="text" name="sub_option" class="form-control" placeholder="Alt seçeneği giriniz." required>
                        </div>
                        <div class="form-group">
                            <button class="btn btn-block btn-flat btn-success">Add Option</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

<?php $this->load->view('admin/include/footer'); ?>