<?php $this->load->view('admin/include/header'); ?>

<?php $this->load->view('admin/include/sidebar'); ?>

    <div class="row">
        <div class="col-md-4">
            <a href="<?= base_url('admin/add_product') ?>" class="small-box-footer">
                <div class="small-box bg-info">
                    <div class="inner">
                        <h3>Creat Product</h3>
                        <p>Ürün oluşturmak için tıklayınız.</p>
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
            <div class="card card-solid">
                <div class="card-body">
                    <table id="category" class="table table-bordered table-striped">
                        <thead>
                        <tr>
                            <th>Product</th>
                            <th>Category</th>
                            <th>Sub Category</th>
                            <th>Price</th>
                            <th>Discount</th>
                            <th>Process</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($products as $product): ?>
                            <tr>
                                <td><?= $product->title ?></td>

                                <?php if ($product->category == '1'): ?>
                                    <td>Man</td>
                                <?php elseif ($product->category == '2'): ?>
                                    <td>Woman</td>
                                <?php else: ?>
                                    <td>Kid</td>
                                <?php endif; ?>
                                <td><?= Categories::find($product->sub_category)->name ?></td>
                                <td><?= $product->price ?></td>
                                <td><?= $product->discount ?></td>
                                <td>
                                    <a href="<?= base_url('admin/edit_product/').$product->id ?>" class="btn btn-xs btn-default"><i class="fa fa-edit"></i> Edit</a>
                                    <?php delete_button('product', $product->id) ?>
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