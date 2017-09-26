<?php
class View {

  private $file;
  private $title;

  public function __construct($controller, $action) {
    $this->file = ROOT."/views/".$controller.'/' . $action . ".php";
  }

  public function render($data) {
    $content = $this->renderFile($this->file, $data);
    $view = $this->renderFile(ROOT.'/views/layouts/default.php',
      array('title' => $this->title, 'content' => $content));
    echo $view;

  }

  private function renderFile($file, $data) {
    if (file_exists($file)) {
      extract($data);
      ob_start();
      require $file;
      return ob_get_clean();
      //ob_end_flush();
    }
    else {
      throw new Exception("Fichier '$file' introuvable");
    }
  }
}