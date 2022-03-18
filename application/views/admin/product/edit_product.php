<?php $this->load->view('admin/include/header'); ?>

<?php $this->load->view('admin/include/sidebar'); ?>

    <div class="row">
        <div class="col-md-6">
            <div class="card card-solid">
                <div class="card-body">
                    <form action="<?= base_url('admin/edit_product/').$product->id ?>" method="post">
                        <div class="form-group">
                            <label>Product Name</label>
                            <input type="text" name="title" class="form-control" value="<?= $product->title ?>">
                        </div>
                        <div class="form-group">
                            <label>Product Category</label>
                            <select name="category" class="form-control">
                                <option <?php if ($product->category == 1){echo "selected";} ?> value="1">Man</option>
                                <option <?php if ($product->category == 2){echo "selected";} ?> value="2">Woman</option>
                                <option <?php if ($product->category == 3){echo "selected";} ?> value="3">Kid</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Product Sub Category</label>
                            <select name="sub_category" class="form-control">
                                <?php foreach ($sub_category as $category): ?>
                                    <option <?php if ($product->sub_category == $category->id){echo "selected";} ?> value="<?= $category->id ?>"><?= $category->name ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-6">
                                    <label>Price</label>
                                    <input type="text" name="price" class="form-control" value="<?= $product->price ?>">
                                </div>
                                <div class="col-md-6">
                                    <label>Discount(İndirim)</label>
                                    <input type="text" name="discount" class="form-control" value="<?= $product->discount ?>">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Tag</label>
                            <input type="text" name="tag" class="form-control" value="<?= $product->tag ?>">
                        </div>
                        <div class="form-group">
                            <label>Description</label>
                            <textarea name="desc" rows="5" class="form-control"><?= $product->description ?></textarea>
                        </div>
                        <div class="form-group">
                            <button class="btn btn-block btn-flat btn-success" value="1" name="product">Update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card card-solid">
                <div class="card-body">
                    <div class="row">
                        <?php foreach ($images as $image): ?>
                            <div class="col-sm-4">
                                <img class="img-lg" src="<?= base_url($image->path) ?>">
                                <a href="<?= base_url('admin/delete_product_image/').$image->id ?>" class="btn btn-xs btn-danger"><i class="fa fa-remove"></i> Sil</a>
                                <?php if ($image->master == 0): ?>
                                <a href="<?= base_url('admin/product_image_cover/').$image->id ?>" class="btn btn-xs btn-success"><i class="fa fa-camera"></i> Kapak yap</a>
                                <?php endif; ?>
                            </div>
                        <?php endforeach; ?>
                    </div><br>
                    <form action="<?= base_url('admin/add_product_image/'.$product->id ) ?>" class="dropzone" enctype="multipart/form-data" method="post">

                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Product Stock List</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body table-responsive p-0">

                    <table class="table table-hover text-nowrap">
                        <thead>
                        <tr>
                            <th><?= Options::find($type->options)->name ?></th>
                            <?php if (!$type->options2 == 0): ?>
                            <th><?= Options::find($type->options2)->name ?></th>
                            <?php endif; ?>
                            <th>Stok Sayısı</th>
                            <th>İşlemler</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($stocks as $stock): ?>
                        <tr>
                            <td><?= SubOptions::find($stock->sub_option)->name ?></td>
                            <?php if (!$type->options2 == 0): ?>
                            <td><?= SubOptions::find($stock->sub_option2)->name ?></td>
                            <?php endif; ?>
                            <td><?= $stock->stock ?></td>
                            <td>
                                <a href="<?= base_url('admin/edit_product_stock/').$stock->id ?>" class="btn btn-xs btn-default"><i class="fa fa-edit"></i> Edit</a>
                                <?php delete_button('stock', $stock->id) ?>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                        </tbody>
                    </table>

                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->
        </div>
    </div>

<?php $this->load->view('admin/include/footer'); ?>