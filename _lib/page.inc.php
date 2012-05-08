<?php

/**
 * Page
 * 
 * The constructor begins content capture, the destructor flushes everything using layout. 
 * 
 *  - Thus we can use layout around the content, not just insert its parts in every page
 *  - The pages can influence what is happening outside the main content (set the title etc.),
 *    such that what goes on top could be defined "after" it seemed to be rendered.
 *     
 */
class Page
{
  function __construct()
  {
    ob_start();
    $this->layout = "main"; // Default layout
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