<?php

class Upload {

    /**
     * Allowed extensions
     */
    private function extensoes() {
        return Array("xml");
    }

    /**
     * Extension File upload
     */
    private function fileExtensao($file) {
        return pathinfo($file["userfile"]["name"], PATHINFO_EXTENSION);
    }

    /**
     * Extension verify upload to allowed
     */
    private function verificaExtensao($file) {
        if (!in_Array($this->fileExtensao($file), $this->extensoes())) {
            return false;
        }
        return true;
    }

    /**
     * move file from temp folder to storage directory
     */
    private function moveUpload($file) {
        if($this->verificaExtensao($file) == false) {
            return $this->tipoErro()[0];
        }
        return $this->mvFile($file);
    }

    private function mvFile($file) {
        $this->createDir(__DIR__ . "/../files_upload");
        $path = __DIR__ . "/../files_upload";
        $fileName = $file["userfile"]["name"];
        if(move_uploaded_file($file["userfile"]["tmp_name"], $path . '/' . $fileName)) {
            return true;
        }
        return $this->tipoErro()[1];
    }

    public function retornaUpload($file) {
        $retorno = Array(); 
        $retorno["move"] = $this->moveUpload($file);
        return $retorno;
    }

    private function tipoErro() {
        return Array(
            0 => "extensao não permitida",
            1 => "erro ao mover arquivo"
        );
    }
    
   private function createDir($path) {
        if (!file_exists($path)) {
            mkdir($path, 0777, true);
        }
    }
}
