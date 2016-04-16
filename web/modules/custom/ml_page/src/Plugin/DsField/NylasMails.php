<?php

/**
 * @file
 * Contains \Drupal\ds\Plugin\DsField\Slider.
 */

namespace Drupal\ml_page\Plugin\DsField;

use Drupal\ds\Plugin\DsField\DsFieldBase;
use Nylas\Nylas;
use Drupal\ml_page\Controller\NylasController;

/**
 * Plugin that renders the items of an Dossier.
 *
 * @DsField(
 *   id = "nylas_mails",
 *   title = @Translation("Nylas Mails"),
 *   entity_type = "node"
 * )
 */

class NylasMails extends DsFieldBase {

    /**
     * {@inheritdoc}
     */
    public function build() {
        $build = [];

        foreach ($this->entity()->field_mail_rules as $mail_rule_value) {
            $mail_rule = node_load($mail_rule_value->target_id);
            $mail_rule_owner = user_load($mail_rule->getOwnerId());
            $access_token = $mail_rule_owner->field_nylas_access_token->value;

            $client = new Nylas('1k3tcejuvtjx6ccni9x2qgdh6', '2a19f68fcm1m6lgbo2sl95hfr', $access_token);

            if ($mail_rule->field_email->value) {
                $search_criteria['any_email'] = $mail_rule->field_email->value;
            }

            if ($mail_rule->field_date_till->value) {
                $search_criteria['last_message_before'] = strtotime($mail_rule->field_date_till->value);
            }

            if ($mail_rule->field_date_from->value) {
                $search_criteria['started_before'] = strtotime($mail_rule->field_date_from->value);
            }

            $search_criteria = array(
                "in" => "inbox"
            );

            $get_threads = $client->threads()->where($search_criteria)->all(10);

            foreach($get_threads as $thread) {
                foreach($thread->messages()->items() as $message) {
                    $build[] = ['#markup' => $message->subject];
                }
            }
        }

        return $build;
    }

    /**
     * {@inheritdoc}
     */
    public function isAllowed() {
        $bundle = $this->bundle();
        if ($bundle == 'timeline') {
            return TRUE;
        }
    }
}
