<?php
class fileUpload{
    
    public $tmp;
    public $filename;
    public $src;

    public function __construct($file, $path) {
 
        $this->filename = $file["name"];
        $this->tmp = $file["tmp_name"];
        $this->mkdirIfNotExist($path);
        $this->src = $path.'/' . basename($this->filename);
        return $this->uploadfile();
    }

    public function mkdirIfNotExist($path) {
        if (!is_dir($path)) {
          mkdir($path,0777, true);
        }
      }
    public function uploadfile(){
        try {
            move_uploaded_file($this->tmp, $this->src);
            return true;
        } catch (Exception $e) {
            // return $e->getMessage();
            return false;

        }
    }


}

?>