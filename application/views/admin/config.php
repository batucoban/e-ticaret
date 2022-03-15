<?php
$this->load->view('admin/include/header');
$this->load->view('admin/include/sidebar');
?>

<div class="row">
    <div class="col-md-4">
        <div class="card card-solid">
            <div class="card-body">
                <form method="post" action="<?php echo base_url('admin/configpost'); ?>" enctype="multipart/form-data">
                    <div class="form-group">
                        <label>Site Name</label>
                        <input type="text" name="title" required class="form-control" value="<?= $config->title ?>">
                        <input type="hidden" name="id" required class="form-control" value="<?= $config->id ?>">
                    </div>
                    <div class="form-group">
                        <label>Site Mail</label>
                        <input type="email" name="mail" required class="form-control" value="<?= $config->mail ?>">
                    </div>
                    <div class="form-group">
                        <label>Adress</label>
                        <textarea name="info" rows="3" class="form-control"><?= $config->info ?></textarea>
                    </div>
                    <div class="form-group">
                        <label>Site Logo</label>
                        <input type="file" name="logo" class="form-control">
                        <br><image src="<?= base_url($config->logo) ?>"></image>
                    </div>
                    <div class="form-group">
                        <label>Site Icon</label>
                        <input type="file" name="icon" class="form-control">
                        <br><image src="<?= base_url($config->icon) ?>"></image>
                    </div>
                    <div class="form-group">
                        <label>Facebook</label>
                        <input type="text" name="facebook" class="form-control" value="<?= $config->facebook ?>">
                    </div>
                    <div class="form-group">
                        <label>Twitter</label>
                        <input type="text" name="twitter" class="form-control" value="<?= $config->twitter ?>">
                    </div>
                    <div class="form-group">
                        <label>Instagram</label>
                        <input type="text" name="instagram" class="form-control" value="<?= $config->instagram ?>">
                    </div>
                    <div class="form-group">
                        <label>Youtube</label>
                        <input type="text" name="youtube" class="form-control" value="<?= $config->youtube ?>">
                    </div>
                    <div class="form-group">
                        <button class="btn btn-success btn-flat btn-block">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


<?php $this->load->view('admin/include/footer'); ?>
