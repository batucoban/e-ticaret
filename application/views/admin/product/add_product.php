<?php $this->load->view('admin/include/header'); ?>

<?php $this->load->view('admin/include/sidebar'); ?>

    <div class="row">
        <div class="col-md-8">
            <div class="card card-solid">
                <div class="card-body">
                    <form action="<?= base_url('admin/product_controller') ?>" method="post">
                        <div class="form-group">
                            <label>Product Name</label>
                            <input type="text" name="title" class="form-control">
                        </div>
                        <div class="form-group">
                            <label>Product Category</label>
                            <select name="category" class="form-control">
                                <option value="1">Man</option>
                                <option value="2">Woman</option>
                                <option value="3">Kid</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Product Sub Category</label>
                            <select name="sub_category" class="form-control">
                                <?php foreach ($sub_category as $category): ?>
                                    <option value="<?= $category->id ?>"><?= $category->name ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-6">
                                    <label>Price</label>
                                    <input type="text" name="price" class="form-control">
                                </div>
                                <div class="col-md-6">
                                    <label>Discount(İndirim)</label>
                                    <input type="text" name="discount" class="form-control">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Tag</label>
                            <input type="text" name="tag" class="form-control">
                        </div>
                        <div class="form-group">
                            <label>Description</label>
                            <textarea name="desc" rows="5" class="form-control"></textarea>
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
                    <h5 class="card-title">STAGE 1</h5><br>
                    <div class="card-body">
                        <strong>Product Info</strong>
                    </div>
                </div>
            </div>
        </div>
    </div>

<?php $this->load->view('admin/include/footer'); ?>