<?php $this->load->view('admin/include/header'); ?>

<?php $this->load->view('admin/include/sidebar'); ?>

    <div class="row">
        <div class="col-md-4">
            <div class="box box-solid">
                <div class="box-body">
                    <form action="<?= base_url('admin/edit_category/').$category->id ?>" method="post">
                        <div class="form-group">
                            <label>Category Name</label>
                            <input type="text" name="category" class="form-control" value="<?= $category->name ?>" required>
                        </div>
                        <div class="form-group">
                            <label>Top Category</label>
                            <select name="top_category" class="form-control">
                                    <option <?php if ($category->top_category == 1){echo "selected";} ?> value="1">Man</option>
                                    <option <?php if ($category->top_category == 2){echo "selected";} ?> value="2">Woman</option>
                                    <option <?php if ($category->top_category == 3){echo "selected";} ?> value="3">Kid</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <button class="btn btn-block btn-flat btn-success">Edit Category</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

<?php $this->load->view('admin/include/footer'); ?>