<?php

namespace App\Controller\Main;

use System\Controller;
use System\View\ViewInterface;

class LayoutController extends Controller
{
  /**
   * Render the layout with the given view Object
   *
   * @param \System\View\ViewInterface $view
   */
  public function render(ViewInterface $view)
  {
    $data['content'] = $view;

    $sections = ['header', 'footer'];

    foreach ($sections as $section) {
      $data[$section] = $this->load->controller('Main/' . ucfirst($section))->index();
    }

    return $this->view->render('main/layout', $data);
  }

  /**
   * Set the title for page
   *
   * @param string $title
   * @return void
   */
  public function title($title)
  {
    $this->html->setTitle($title);
  }
}
