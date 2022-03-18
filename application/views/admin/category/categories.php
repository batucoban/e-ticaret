<?php $this->load->view('admin/include/header'); ?>

<?php $this->load->view('admin/include/sidebar'); ?>

    <div class="row">
        <div class="col-md-4">
            <a href="<?= base_url('admin/add_category') ?>" class="small-box-footer">
                <div class="small-box bg-info">
                    <div class="inner">
                        <h3>Creat Category</h3>
                        <p>Kategori oluşturmak için tıklayınız.</p>
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
                            <th>Category</th>
                            <th>Top Category</th>
                            <th>Process</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($categories as $category): ?>
                            <tr>
                                <td><?= $category->name ?></td>

                                <?php if ($category->top_category == '1'): ?>
                                    <td>Man</td>
                                <?php elseif ($category->top_category == '2'): ?>
                                    <td>Woman</td>
                                <?php else: ?>
                                    <td>Kid</td>
                                <?php endif; ?>
                                <td>
                                    <a href="<?= base_url('admin/edit_category/').$category->id ?>" class="btn btn-xs btn-default"><i class="fa fa-edit"></i> Edit</a>
                                    <?php delete_button('category', $category->id) ?>
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