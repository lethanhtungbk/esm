<?php

namespace Frenzycode\Ems\Libraries\Upload;

class UploadOptions {

    public $script_url;
    public $upload_dir;
    public $upload_url;
    public $user_dirs = false;
    public $mkdir_mode = 0755;
    public $param_name = 'files';
    // Set the following option to 'POST', if your server does not support
    // DELETE requests. This is a parameter sent to the client:
    public $delete_type = 'DELETE';
    public $access_control_allow_origin = '*';
    public $access_control_allow_credentials = false;
    public $access_control_allow_methods = array('OPTIONS', 'HEAD', 'GET', 'POST', 'PUT', 'PATCH', 'DELETE');
    public $access_control_allow_headers = array('Content-Type', 'Content-Range', 'Content-Disposition');
    // Enable to provide file downloads via GET requests to the PHP script:
    //     1. Set to 1 to download files via readfile method through PHP
    //     2. Set to 2 to send a X-Sendfile header for lighttpd/Apache
    //     3. Set to 3 to send a X-Accel-Redirect header for nginx
    // If set to 2 or 3, adjust the upload_url option to the base path of
    // the redirect parameter, e.g. '/files/'.
    public $download_via_php = false;
    // Read files in chunks to avoid memory limits when download_via_php
    // is enabled, set to 0 to disable chunked reading of files:
    public $readfile_chunk_size = 10485760; /* 10*1024*1024 */
    // Defines which files can be displayed inline when downloaded:
    public $inline_file_types = '/\.(gif|jpe?g|png)$/i';
    // Defines which files (based on their names) are accepted for upload:
    public $accept_file_types = '/.+$/i';
    // The php.ini settings upload_max_filesize and post_max_size
    // take precedence over the following max_file_size setting:
    public $max_file_size = null;
    public $min_file_size = 1;
    // The maximum number of files for the upload directory:
    public $max_number_of_files = null;
    // Defines which files are handled as image files:
    public $image_file_types = '/\.(gif|jpe?g|png)$/i';
    // Image resolution restrictions:
    public $max_width = null;
    public $max_height = null;
    public $min_width = 1;
    public $min_height = 1;
    // Set the following option to false to enable resumable uploads:
    public $discard_aborted_uploads = true;
    // Set to 0 to use the GD library to scale and orient images,
    // set to 1 to use imagick (if installed, falls back to GD),
    // set to 2 to use the ImageMagick convert binary directly:
    public $image_library = 1;
    // Uncomment the following to define an array of resource limits
    // for imagick:
    //public $imagick_resource_limits =  array(imagick::RESOURCETYPE_MAP => 32,imagick::RESOURCETYPE_MEMORY => 32);
    // Command or path for to the ImageMagick convert binary:
    public $convert_bin = 'convert';
    // Uncomment the following to add parameters in front of each
    // ImageMagick convert call (the limit constraints seem only
    // to have an effect if put in front):
    /*
      public $convert_params' = '-limit memory 32MiB -limit map 32MiB',
     */
    // Command or path for to the ImageMagick identify binary:
    public $identify_bin = 'identify';
    public $image_versions = array(
        // The empty image version key defines options for the original image:
        '' => array(
            // Automatically rotate images based on EXIF meta data:
            'auto_orient' => true
        ),
        // Uncomment the following to create medium sized images:
        /*
          'medium' => array(
          'max_width' => 800,
          'max_height' => 600
          ),
         */
        'thumbnail' => array(
            // Uncomment the following to use a defined directory for the thumbnails
            // instead of a subdirectory based on the version identifier.
            // Make sure that this directory doesn't allow execution of files if you
            // don't pose any restrictions on the type of uploaded files, e.g. by
            // copying the .htaccess file from the files directory for Apache:
            //'upload_dir' => dirname($this->get_server_var('SCRIPT_FILENAME')).'/thumb/',
            //'upload_url' => $this->get_full_url().'/thumb/',
            // Uncomment the following to force the max
            // dimensions and e.g. create square thumbnails:
            //'crop' => true,
            'max_width' => 80,
            'max_height' => 80
        )
    );

    function __construct() {
        $this->script_url = $this->get_full_url().'/';
        $this->upload_dir = dirname($this->get_server_var('SCRIPT_FILENAME')).'/files/';
        $this->upload_url = $this->get_full_url().'/files/';
    }

    protected function get_full_url() {
        $https = !empty($_SERVER['HTTPS']) && strcasecmp($_SERVER['HTTPS'], 'on') === 0 ||
                !empty($_SERVER['HTTP_X_FORWARDED_PROTO']) &&
                strcasecmp($_SERVER['HTTP_X_FORWARDED_PROTO'], 'https') === 0;
        $url = ($https ? 'https://' : 'http://') .
                (!empty($_SERVER['REMOTE_USER']) ? $_SERVER['REMOTE_USER'] . '@' : '') .
                (isset($_SERVER['HTTP_HOST']) ? $_SERVER['HTTP_HOST'] : ($_SERVER['SERVER_NAME'] .
                        ($https && $_SERVER['SERVER_PORT'] === 443 ||
                        $_SERVER['SERVER_PORT'] === 80 ? '' : ':' . $_SERVER['SERVER_PORT']))) .
                substr($_SERVER['SCRIPT_NAME'], 0, strrpos($_SERVER['SCRIPT_NAME'], '/'));



        return $url;
    }

    protected function get_server_var($id) {
        return isset($_SERVER[$id]) ? $_SERVER[$id] : '';
    }

}
