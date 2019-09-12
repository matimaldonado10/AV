<?php
class customException extends Exception {
  public function errorMessage() {
    //error message
    $errorMsg = 'Error en línea '.$this->getLine().' en '.$this->getFile()
    .': <b>'.$this->getMessage();
    return $errorMsg;
  }
}