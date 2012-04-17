<?php

class Page
{
  function __construct()
  {
    ob_start();
    $this->layout = "main";
  }

  public function setLayout( $layout )
  {
    $this->layout = $layout;
  }

  function __destruct()
  {
    $this->content = ob_get_contents();
    ob_end_clean();

    if ( $this->layout )
    {
       require_once dirname(__FILE__) . "/../_layouts/" . $this->layout . ".inc.php";
       render( $this );
    }
    else
    {
      echo $this->content;
    }
  }
}