<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {

    public function __construct(){
        parent::__construct();
        if (!$this->session->userdata('adminlogin') && $this->uri->segment(2) && $this->uri->segment(2) != 'login'){
            redirect('admin');
        }
    }

    public function index()
	{
        if ($this->session->userdata('adminlogin')){
            redirect('admin/panel');
        }
		$this->load->view('admin/login');
	}

    public function login(){
        $formData = array(
            'mail' => $this->input->post('email'),
            'password' => $this->input->post('password')
        );
        $exist = Management::find($formData);
        if ($exist){
            $this->session->set_userdata('adminlogin', true);
            $this->session->set_userdata('admininfo', $exist);
            redirect('admin/panel');
        }
        else{
            $error_message = "Email veya şifre hatalı";
            $this->session->set_flashdata('error', $error_message); // geçici session tek kullanımlık
            redirect('admin');
        }
    }

    public function panel(){
        $data['head'] = "Panel";
        $this->load->view('admin/panel', $data);
    }

    public function config(){
        $data['head'] = "Settings";
        $data['config'] = Settings::find(1);
        $this->load->view('admin/config', $data);
    }

    public function configpost(){
        $config = Settings::find(postvalue('id'));
        $data = array(
            'title' => postvalue('title'),
            'info' => postvalue('info'),
            'mail' => postvalue('mail'),
            'facebook' => postvalue('facebook'),
            'twitter' => postvalue('twitter'),
            'instagram' => postvalue('instagram'),
            'youtube' => postvalue('youtube')
        );
        if ($_FILES['logo']['size'] > 0){
            $data['logo'] = imageupload('logo', 'config', 'png');
            unlink($config->logo); // önceki görselleri silme
        }
        if ($_FILES['icon']['size'] > 0){
            $data['icon'] = imageupload('icon', 'config', 'jpg|ico|png');
            unlink($config->icon);
        }

        Settings::update(postvalue('id'), $data);
        flash('success', 'check', 'Ayarlar Güncellendi.');
        back();
    }

    public function logout(){
        $this->session->sess_destroy();
        redirect('admin/panel');
    }

    public function categories(){
        $data['head'] = 'Product Categories';
        $data['categories'] = Categories::select();
        $this->load->view('admin/category/categories', $data);
    }

    public function add_category(){
        if (isPost()){
            $data = array(
                'top_category' => postvalue('top_category'),
                'name' => postvalue('category'),
                'slug' => sef(postvalue('category'))
            );
            Categories::insert($data);
            flash('success', 'check', 'Kategori eklendi.');
            back();
        }
        $data['head'] = 'Add Category';
        $this->load->view('admin/category/add_category', $data);
    }

    public function edit_category($id){
        if (isPost()){
            $data = array(
                'top_category' => postvalue('top_category'),
                'name' => postvalue('category'),
                'slug' => sef(postvalue('category'))
            );
            Categories::update($id, $data);
            flash('success', 'check', 'Kategori güncellendi.');
            back();
        }

        $data['head'] = 'Edit Category';
        $isExist = Categories::find($id);
        if ($isExist){
            $data['category'] = $isExist;
            $this->load->view('admin/category/edit_category', $data);
        }
        else{
            back();
        }
    }

    public function delete_category($id){
        Categories::delete($id);
        back();
    }

    public function product_options(){
        $data['head'] = 'Product Options';
        $data['options'] = Options::select();
        $this->load->view('admin/options/options', $data);
    }

    public function add_product_option(){
        if (isPost()){
            $data = array(
                'name' => postvalue('option'),
                'slug' => sef(postvalue('option'))
            );
            Options::insert($data);
            flash('success', 'check', 'Ürün seçeneği eklendi.');
            back();
        }
        $data['head'] = 'Add Product Option';
        $this->load->view('admin/options/add_product_option', $data);
    }

    public function edit_product_option($id){
        if (isPost()){
            $data = array(
                'name' => postvalue('option'),
                'slug' => sef(postvalue('option'))
            );
            Options::update($id, $data);
            flash('success', 'check', 'Ürün seçeneği güncellendi.');
            back();
        }

        $data['head'] = 'Edit Product Option';
        $isExist = Options::find($id);
        if ($isExist){
            $data['option'] = $isExist;
            $this->load->view('admin/options/edit_product_option', $data);
        }
        else{
            back();
        }
    }

    public function delete_product_option($id){
        Options::delete($id);
        back();
    }

    public function sub_options($id){
        $option = Options::find($id);
        $data['option'] = $option;
        $data['head'] = 'Sub Options for '.$option->name;
        $data['suboptions'] = SubOptions::select(['option_id' => $id]);
        $this->load->view('admin/options/sub_options', $data);
    }

    public function add_sub_option($id){
        if (isPost()){
            $sub_option = postvalue('sub_option');
            $sc = "-";
            if (strpos($sub_option, $sc)){
                $value = explode('-', $sub_option);
                foreach ($value as $name){
                    SubOptions::insert([
                        'option_id' => $id,
                        'name' => $name
                    ]);
                }
                flash('success', 'check', 'Alt seçenekler eklendi.');
                redirect('admin/sub_options/'.$id);
            }
            else{
                SubOptions::insert([
                    'option_id' => $id,
                    'name' => $sub_option
                ]);
                flash('success', 'check', 'Alt seçenek eklendi.');
                redirect('admin/sub_options/'.$id);
            }
        }
        $data['head'] = "Add Sub Option";
        $this->load->view('admin/options/add_sub_option',$data);
    }

    public function edit_sub_option($id){
        if (isPost()){
            $data = array(
                'name' => postvalue('option')

            );
            SubOptions::update($id, $data);
            flash('success', 'check', 'Ürün alt seçeneği güncellendi.');
            back();
        }

        $data['head'] = 'Edit Sub Option';
        $isExist = SubOptions::find($id);
        if ($isExist){
            $data['option'] = $isExist;
            $this->load->view('admin/options/edit_sub_option', $data);
        }
        else{
            back();
        }
    }

    public function delete_sub_option($id){
        SubOptions::delete($id);
        back();
    }

    public function product(){
        $data['head'] = "Product";
        $data['products'] = Products::query("select * from products order by id DESC ");
        //codeprint($data,1);
        $this->load->view('admin/product/products', $data);
    }

    public function add_product(){
        $data['head'] = "Add Product";
        $data['sub_category'] = Categories::select();
        $this->load->view('admin/product/add_product', $data);
    }

    public function add_product_image($id){
        if (isPost()){
            $product = Products::find($id);
            $config['upload_path'] = "assets/upload/product/";
            $config['allowed_types'] = "jpg|png|jpeg";
            $config['file_name'] = $product->seo.'-'.$product->id;
            $this->upload->initialize($config);
            if ($this->upload->do_upload('file')){
                $image = $this->upload->data();
                $path = $config['upload_path'].$image['file_name'];
                $data = [
                    'product' => $id,
                    'path' => $path
                    ];
                Images::insert($data);
            }
        }

        $data['head'] = "Add Product Image";
        $data['sub_category'] = Categories::select();
        $this->load->view('admin/product/add_product_image', $data);
    }

    public function add_product_stock_type($id){
        if (isPost()){
            if (postvalue('sub_category') == postvalue('sub_category_2')){
                flash('warning', 'ban', 'Ürün seçenekleri aynı.');
                back();
            }
            if (StockType::count(['product' => $id]) == 1){
                flash('warning', 'ban', 'Bu ürün için stok tipi belirlenmiş.');
                back();
            }
            $data = array(
                'product' => $id,
                'options' => postvalue('sub_category')
            );
            if (postvalue('sub_category_2') != 0){
                $data['options2'] = postvalue('sub_category_2');
            }
            StockType::insert($data);
            flash('success', 'check', 'Stok başarıyla girildi.');
            redirect('admin/add_product_stock/'.$id);
        }

        $data['head'] = "Add Product Stock Type";
        $data['options'] = Options::select();
        $this->load->view('admin/product/add_product_stock_type', $data);
    }

    public function add_product_stock($id){
        if (isPost()){
            if (Stocks::find(['product' => $id, 'sub_option' => postvalue('sub_option'), 'sub_option2' => postvalue('sub_option_2')])){
                flash('warning', 'ban', 'Bu seçenekler için stok bilgisi mevcut');
                back();
            }
            $data = array(
                'product' => $id,
                'sub_option' => postvalue('sub_option'),
                'sub_option2' => postvalue('sub_option_2'),
                'stock' => postvalue('stock')
                );
            Stocks::insert($data);
            flash('success', 'check', 'Stok başarı ile girildi.');
            back();
        }
        $product = Products::find($id);
        if (!$product){
            flash('danger', 'ban', 'Ürün bulunamadı.');
            back();
        }
        $stock_type = StockType::find(['product' => $product->id]);
        $option_1 = SubOptions::select(['option_id' => $stock_type->options]);
        $option_2 = null;
        if ($stock_type->options2 != null){
            $option_2 = SubOptions::select(['option_id' => $stock_type->options2]);
        }
        $data['option_1'] = $option_1;
        $data['option_2'] = $option_2;
        $data['type'] = $stock_type;
        $data['stocks'] = Stocks::select(['product' => $id]);
        $data['head'] = "Add Product Stock";
        $this->load->view('admin/product/add_product_stock', $data);
    }

    public function edit_product_stock($id){
        if (isPost()){
            $stock = Stocks::find($id);
            $data = array(
                'product' => $stock->product,
                'sub_option' => postvalue('sub_option'),
                'sub_option2' => postvalue('sub_option_2'),
                'stock' => postvalue('stock')
            );
            Stocks::update($id, $data);
            flash('success', 'check', 'Stok başarı ile güncellendi.');
            back();
        }

        $stock = Stocks::find($id);
        $stock_type = StockType::find(['product' => $stock->product]);
        $option_1 = SubOptions::select(['option_id' => $stock_type->options]);
        $option_2 = null;
        if ($stock_type->options2 != null){
            $option_2 = SubOptions::select(['option_id' => $stock_type->options2]);
        }
        $data['option_1'] = $option_1;
        $data['option_2'] = $option_2;
        $data['type'] = $stock_type;
        $data['stock'] = $stock;
        $data['head'] = "Edit Product Stock";
        $this->load->view('admin/product/edit_product_stock', $data);
    }

    public function product_controller($id = null){
        if (isPost()){
            if (postvalue('step1')){
                $data = [
                    'category' => postvalue('category'),
                    'sub_category' => postvalue('sub_category'),
                    'title' => postvalue('title'),
                    'description' => postvalue('desc'),
                    'price' => postvalue('price'),
                    'discount' => postvalue('discount'),
                    'tag' => postvalue('tag')
                    ];
                Products::insert($data);

                $insert_id = $this->db->insert_id();
                $qr_path = 'assets/upload/qrcode/product'.$insert_id.'.png';
                $params['data'] = 'urunid = '.$insert_id;
                $params['level'] = 'H';
                $params['size'] = 5;
                $params['savename'] = FCPATH.$qr_path;
                $this->ciqrcode->generate($params);
                Products::update($insert_id, ['qrcode' => $qr_path]);
                redirect('admin/add_product_image/'.$insert_id);
            }
        }
        $product = Products::find($id);
        if ($product){
            Products::update($id, ['complete' => 1]);
            flash('success', 'check', 'Ürün başarı ile eklendi.');
            redirect('admin/product');
        }
    }

    public function edit_product($id){
        if (isPost()){
            if (postvalue('product')){
                $data = [
                    'category' => postvalue('category'),
                    'sub_category' => postvalue('sub_category'),
                    'title' => postvalue('title'),
                    'description' => postvalue('desc'),
                    'price' => postvalue('price'),
                    'discount' => postvalue('discount'),
                    'tag' => postvalue('tag')
                ];
                Products::update($id, $data);
                flash('success', 'check', 'Ürün bilgileri güncellendi.');
            }
        }

        $product = Products::find($id);
        if (!$product){
            flash('warning', 'ban', 'Böyle bir ürün yok.');
            back();
        }
        $data['product'] = $product;
        $data['images'] = Images::select(['product' => $id]);
        $data['stocks'] = Stocks::select(['product' => $id]);
        $data['type'] = StockType::find(['product' => $id]);
        $data['sub_category'] = Categories::select();
        $data['head'] = 'Edit Product';
        //codeprint($data,1);
        $this->load->view('admin/product/edit_product', $data);
    }

    public function delete_product_image($id){
        $image = Images::find($id);
        if ($image->master == 1){
            flash('warning', 'ban', 'kapak fotoğrafı silinemez.');
            back();
        }
        unlink($image->path);
        Images::delete($id);
        flash('success', 'check', 'resim silindi.');
        back();
    }

    public function product_image_cover($id){

        $image = Images::find($id);
        Images::update(['product' => $image->product], ['master' => 0]);
        $data = array('master' => 1);
        Images::update($id, $data);
        flash('success', 'check', 'resim kapağı seçildi.');
        back();
    }

    public function delete_function(){
        if ($this->session->userdata('delete_function')){
            $this->session->unset_userdata('delete_function');
        }
        else{
            $this->session->set_userdata('delete_function', true);
        }
        back();
    }

    public function delete($table, $id){
        if ($this->session->userdata('delete_function')){
            echo "NOOOOOOOOOOOOOOO!!!!!!!!!";
        }

        switch ($table){
            case "product":
                $product = Products::find($id);
                if ($product){
                    StockType::delete(['product' => $id]);
                    Stocks::delete(['product' => $id]);
                    $images = Images::select(['product' => $id]);
                    foreach ($images as $image){
                        unlink($image->path);
                        Images::delete($image->id);
                    }
                    unlink($product->qrcode);
                    Products::delete($id);
                }
                break;
            case "stock":
                Stocks::delete($id);
                break;
            case "category":
                Categories::delete($id);
                break;
            case "option":
                $option = Options::find($id);
                SubOptions::delete(['option_id' => $option->id]);
                Options::delete($id);
                break;
            case "sub_option":
                SubOptions::delete($id);
                break;
        }
        flash('success', 'check', 'Silme başarıyla gerçekleşti.');
        back();
    }
}
