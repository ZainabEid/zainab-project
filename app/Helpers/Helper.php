<?php


// get all models helper funcion

use Illuminate\Support\Facades\Storage;

if (!function_exists('get_models')) {
    function get_models()
    {
       $models =  ['admins', 'categories' ]  ;

        return $models;
    } //end of get_models helper
} // end of check exist

// get all crud_maps helper funcion
if (!function_exists('crud_maps')) {
    function crud_maps()
    {
       $crud_maps =  ['create', 'read' , 'update', 'delete'];  ;

        return $crud_maps;
    } //end of crud_maps helper
} // end of check exist




// save imagae helper //not used
if (!function_exists('save_image')) {
    function save_image($folder, $image)
    {
        $image->store('uploads/' . $folder . '/' ,'public');

       // image->store('uploads','public');
        return $image;
    } //end of save_image helper
    
} // end of check exist


// get image helper //not used
if (!function_exists('get_image')) {
    function get_image($folder, $image_name)
    {
       // $image_path = asset('storage/uploads/'.$folder.'/'.$image_name);

        $image_path =  url('storage/uploads/'.$folder.'/'.$image_name) ;

      // $image_path = Storage::disk('local')->get('uploads/'. $folder.'/'. $image_name);

        return $image_path;
    } //end of get_image helper
} // end of check exist

// get image helper //not used
if (!function_exists('delete_image')) {
    function delete_image($folder, $image_name)
    {

        if( $image_name != 'default.png'){
            if ( Storage::disk('local')->has('storage/uploads/'.$folder.'/'.$image_name)) {
            
                Storage::disk('local')->delete('storage/uploads/'.$folder.'/'.$image_name);
             
            }
        }
      
    } //end of get_image helper
} // end of check exist