<?php

/**
 * @file
 * Contains \Drupal\ml_page\Controller\NylasController.
 */

namespace Drupal\ml_page\Controller;

use Drupal\Core\Controller\ControllerBase;
use Nylas\Nylas;

/**
 * Class NylasController.
 *
 * @package Drupal\ml_page\Controller
 */
class NylasController extends ControllerBase {
  /**
   * Index.
   *
   * @return string
   *   Return Hello string.
   */
  public function callback() {
    $access_code = $_GET['code'];
    $client = new Nylas('1k3tcejuvtjx6ccni9x2qgdh6', '2a19f68fcm1m6lgbo2sl95hfr');
    $_SESSION['access_token'] = $client->getAuthToken($access_code);

    return [
        '#type' => 'markup',
        '#markup' => $this->t('Implement method: index')
    ];
  }

}
