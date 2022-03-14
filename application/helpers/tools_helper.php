<?php

function codeprint($array, $bool = false){
    echo "<pre>";
    print_r($array);
    echo "</pre>";
    if($bool)
        die;
}

function active($menu){
    $ci = get_instance();
    if ($ci->uri->segment(2) == $menu){
        echo "active";
    }
}

function postvalue($name){
    $ci = get_instance();
    return $ci->input->post($name, true);
}

function imageupload($name, $path, $type){
    //resim yükleme helper'ı
    $ci = get_instance();
    $config['upload_path'] = 'assets/upload/'.$path.'/'; // yolu
    $config['allowed_types'] = $type; // uzantı
    $ci->upload->initialize($config); // gelen bilgileri set eder
    if ($ci->upload->do_upload($name)){
        $image = $ci->upload->data();
        return $config['upload_path'].$image['file_name'];
    }
    return null;
    //codeprint($ci->upload->display_errors()); Hataları görüntüleme
}

function back(){
    return redirect($_SERVER['HTTP_REFERER']); //Sayfaya geri yükleme
}

function flash($type, $icon, $title, $message=null){
    $ci = get_instance();
    $message = '<div class="alert alert-'.$type.' alert-dismissible">
                  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                  <h5><i class="icon fas fa-'.$icon.'"></i>'.$title.'</h5>
                  '.$message.'
                 </div>';
    $ci->session->set_flashdata('flashmessage', $message);
}

function flashread(){
    $ci = get_instance();
    echo $ci->session->flashdata('flashmessage');
}

function isPost(){
    if ($_SERVER['REQUEST_METHOD'] == "POST"){
        return true;
    }
}

function sef($text) {
    $find = array('Ç', 'Ş', 'Ğ', 'Ü', 'İ', 'Ö', 'ç', 'ş', 'ğ', 'ü', 'ö', 'ı', '+', '#');
    $replace = array('c', 's', 'g', 'u', 'i', 'o', 'c', 's', 'g', 'u', 'o', 'i', 'plus', 'sharp');
    $text = strtolower(str_replace($find, $replace, $text));
    $text = preg_replace("@[^A-Za-z0-9\-_\.\+]@i", ' ', $text);
    $text = trim(preg_replace('/\s+/', ' ', $text));
    $text = str_replace(' ', '-', $text);

    return $text;
}

?>