<?php

function form_open(array $data = null) {
if(empty($data['action'])) { $data['action'] = null; }
if(empty($data['class'])) { $data['class'] = null; }
if(empty($data['id'])) { $data['id'] = null; }

    $html = '<form method="post" action="'.$data['action'].'" class="form '.$data['class'].'" id="form '.$data['id'].'" enctype="multipart/form-data">';
    return $html;
}


function form_close() {
    $html = '</form>';
    return $html;
}

function text_input(array $data = null) {

    if(empty($data['data-toggle'])) { $data['data-toggle'] = null; }
    if(empty($data['title'])) { $data['title'] = null; }
if(empty($data['class'])) { $data['class'] = null; }
if(empty($data['id'])) { $data['id'] = null; }
if(empty($data['value'])) { $data['value'] = null; }
if(empty($data['placeholder'])) { $data['placeholder'] = null; }
    if(empty($data['name'])) { $data['name'] = null; }

    $html = '<input type="text" data-toggle="'.$data['data-toggle'].'" title="'.$data['title'].'" value="'.$data['value'].'" placeholder="'.$data['placeholder'].'" name="'.$data['name'].'" id="'.$data['id'].'" class="form-control '.$data['class'].'" />';
    return $html;
}

function date_input(array $data = null) {


if(empty($data['class'])) { $data['class'] = null; }
if(empty($data['id'])) { $data['id'] = null; }
if(empty($data['value'])) { $data['value'] = null; }
if(empty($data['placeholder'])) { $data['placeholder'] = null; }
    if(empty($data['name'])) { $data['name'] = null; }

    $html = '<input type="date" value="'.$data['value'].'" placeholder="'.$data['placeholder'].'" name="'.$data['name'].'" id="'.$data['id'].'" class="form-control '.$data['class'].'" />';
    return $html;
}

function file_input(array $data = null) {

if(empty($data['class'])) { $data['class'] = null; }
if(empty($data['id'])) { $data['id'] = null; }
if(empty($data['value'])) { $data['value'] = null; }
    if(empty($data['name'])) { $data['name'] = null; }
if(empty($data['placeholder'])) { $data['placeholder'] = null; }

    $html = '<input type="file" value="'.$data['value'].'" placeholder="'.$data['placeholder'].'" name="'.$data['name'].'" id="'.$data['id'].'" class="form-control '.$data['class'].'" />';
    return $html;
}
function textarea_input(array $data = null) {

if(empty($data['class'])) { $data['class'] = null; }
if(empty($data['id'])) { $data['id'] = null; }
if(empty($data['data-toggle'])) { $data['data-toggle'] = null; }
if(empty($data['title'])) { $data['title'] = null; }
if(empty($data['value'])) { $data['value'] = null; }
if(empty($data['name'])) { $data['name'] = null; }
if(empty($data['placeholder'])) { $data['placeholder'] = null; }

    $html = '<textarea placeholder="'.$data['placeholder'].'" name="'.$data['name'].'" id="'.$data['id'].'" class="form-control '.$data['class'].'" >'.$data['value'].'</textarea>';
    return $html;
}
function select_input(array $data = null) {
    
if(empty($data['class'])) { $data['class'] = null; }
if(empty($data['id'])) { $data['id'] = null; }
if(empty($data['value'])) { $data['value'] = null; }
    if(empty($data['name'])) { $data['name'] = null; }
if(empty($data['placeholder'])) { $data['placeholder'] = null; }

    $html = '<select name="'.$data['name'].'" id="'.$data['id'].'" class="form-control '.$data['class'].'" >';

    $html .= '</select>';
    return $html;
}


function pr($data) {
    echo  '<pre>';
    print_r($data);
    echo '</pre>';

}



?>