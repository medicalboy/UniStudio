<?php

defined('BASEPATH')
OR exit('No direct script access allowed');

class Subscription_model extends CI_Model
{
    public function subscribe(
        $subscriber,
        $uploader
    ) {
        if ($subscriber === $uploader) {
            return false;
        }

        if (
            $this->is_subscribed(
                $subscriber,
                $uploader
            )
        ) {
            return true;
        }

        return $this->db->insert(
            'subscriptions',
            array(
                'subscriber_username'
                    => $subscriber,

                'uploader_username'
                    => $uploader
            )
        );
    }


    public function unsubscribe(
        $subscriber,
        $uploader
    ) {
        $this->db->where(
            'subscriber_username',
            $subscriber
        );

        $this->db->where(
            'uploader_username',
            $uploader
        );

        return $this->db
                    ->delete('subscriptions');
    }


    public function is_subscribed(
        $subscriber,
        $uploader
    ) {
        $this->db->where(
            'subscriber_username',
            $subscriber
        );

        $this->db->where(
            'uploader_username',
            $uploader
        );

        return $this->db
                    ->get('subscriptions')
                    ->num_rows() > 0;
    }


    public function count_subscribers($uploader)
    {
        $this->db->where(
            'uploader_username',
            $uploader
        );

        return $this->db
                    ->count_all_results(
                        'subscriptions'
                    );
    }
}