<?php
class View {

  private $file;
  private $title;
  private $rendered = false;
  public $layout = 'default';
  public $request;

  public function __construct($controller, $action) {
    $this->file = ROOT."/views/".$controller.'/' . $action . ".php";
  }

  public function render($data) {
    $content = $this->renderFile($this->file, $data);
    $view = $this->renderFile(ROOT.'/views/layouts/'.$this->layout.'.php',
      array('title' => $this->title, 'content' => $content));
      echo $view;

  }

  private function renderFile($file, $data) {
    if (file_exists($file)) {
        extract($data);
        ob_start();
        require $file;
        $content = ob_get_clean();
        require_once ROOT.'/views/layouts/'.$this->layout.'.php';

        $this->rendered = true;
    }
    else {
      throw new Exception("Fichier '$file' introuvable");
    }
  }
}