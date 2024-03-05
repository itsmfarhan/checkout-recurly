<?php
/**
 * Recurly API Class.
 *
 * @package ckr-recurly
 */

if (!class_exists('CKR_Recurly_API')) {

    /**
     * Class CKR_Recurly_API.
     */
    class CKR_Recurly_API
    {

        public $api_key;

        /**
         * Set Configs.
         */
        public function __construct()
        {
            $config = get_option('ckr_recurly_config');

            $this->api_key = $config['private_api_key'];

        }

        /**
         * Push input data to recurly.
         *
         * @param  array  $info form input.
         * @param  string $subscription (Passed by reference).
         * @param  string $rmessage (Passed by reference).
         *
         * @return string
         *
         * @access public
         */
        public function create_subscription($info, &$subscription, &$rmessage)
        {
            $plan_code = $info['plan_code'];
            $currency = $info['currency'];

            $client = new \Recurly\Client($this->api_key);

            $account_code = trim(rand());
            try {
                $account_create = array(
                    'code' => $account_code,
                    'first_name' => $info['first_name'],
                    'email' => $info['email'],
                    'last_name' => $info['last_name'],
                    'shipping_addresses' => array(
                        array(
                            'first_name' => $info['first_name'],
                            'last_name' => $info['last_name'],
                            'street1' => $info['address1'],
                            'city' => $info['city'],
                            'postal_code' => $info['postal_code'],
                            'state' => $info['state'],
                            'country' => $info['country'],
                        ),
                    ),
                );

                $account = $client->createAccount($account_create);

            } catch (\Recurly\Errors\Validation $e) {
                $messages = explode(',', $e->getMessage());

                $rmessage = 'Error: ' . implode('<br>', $messages);
                return -1;
            } catch (\Recurly\RecurlyError $e) {
                $messages = explode(',', $e->getMessage());
                $rmessage = 'Error: ' . implode('<br>', $messages);
                return -1;
            }

            $ss = array(
                'token_id' => trim($info['recurly-token']),

            );

            $client->createBillingInfo('code-' . $account_create['code'], $ss);

            try {
                $sub_create = array(
                    'plan_code' => $plan_code,
                    'currency' => $currency,
                    'account' => array(
                        'code' => $account_code,
                    ),
                );

                $subscription = $client->createSubscription($sub_create);

                return $subscription;

            } catch (\Recurly\Errors\Validation $e) {
                $messages = explode(',', $e->getMessage());
                $rmessage = 'Error: ' . implode('<br>', $messages);
                return -1;

            } catch (\Recurly\RecurlyError $e) {
                $messages = explode(',', $e->getMessage());
                $rmessage = 'Error: ' . implode('<br>', $messages);
                return -1;

            }

        }
    }
}
new CKR_Recurly_API();
