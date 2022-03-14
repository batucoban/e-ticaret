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
}
