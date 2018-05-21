<?php
class ControllerExtensionPaymentPaystack extends Controller
{
    public function index()
    {
        $this->language->load('extension/payment/paystack');

        $data['text_testmode'] = $this->language->get('text_testmode');
        $data['button_confirm'] = $this->language->get('button_confirm');

        $data['livemode'] = $this->config->get('paystack_live');

        if ($this->config->get('paystack_live')) {
            $data['key'] = $this->config->get('paystack_live_public');
        } else {
            $data['key'] = $this->config->get('paystack_test_public');
        }

        $this->load->model('checkout/order');

        $order_info = $this->model_checkout_order->getOrder($this->session->data['order_id']);

        if ($order_info) {

            $data['ref'] = uniqid('' . $this->session->data['order_id'] . '-');
            $data['amount'] = intval($order_info['total'] * 100);
            $data['email'] = $order_info['email'];
            $data['currency'] = $order_info['currency_code'];
            $data['callback'] = $this->url->link('extension/payment/paystack/callback', 'trxref=' . rawurlencode($data['ref']), 'SSL');

            if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/payment/paystack.tpl')) {
                return $this->load->view($this->config->get('config_template') . '/template/payment/paystack.tpl', $data);
            } else {
                return $this->load->view('payment/paystack.tpl', $data);

            }
        }
    }

    private function query_api_transaction_verify($reference)
    {
        if ($this->config->get('paystack_live')) {
            $skey = $this->config->get('paystack_live_secret');
        } else {
            $skey = $this->config->get('paystack_test_secret');
        }

        $context = stream_context_create(
            array(
                'http'=>array(
                    'method'=>"GET",
                    'header'=>"Authorization: Bearer " .  $skey,
                )
            )
        );
        $url = 'https://api.paystack.co/transaction/verify/'. rawurlencode($reference);
        $request = file_get_contents($url, false, $context);
        return json_decode($request, true);
    }

    private function redir_and_die($url, $onlymeta = false)
    {
        if (!headers_sent() && !$onlymeta) {
            header('Location: ' . $url);
        }
        echo "<meta http-equiv=\"refresh\" content=\"0;url=" . addslashes($url) . "\" />";
        die();
    }

    public function callback()
    {
        if (isset($this->request->get['trxref'])) {
            $trxref = $this->request->get['trxref'];

            // order id is what comes before the first dash in trxref
            $order_id = substr($trxref, 0, strpos($trxref, '-'));
            // if no dash were in transation reference, we will have an empty order_id
            if (!$order_id) {
                $order_id = 0;
            }

            $this->load->model('checkout/order');

            $order_info = $this->model_checkout_order->getOrder($order_id);



            if ($order_info) {
                if ($this->config->get('paystack_debug')) {
                    $this->log->write('PAYSTACK :: CALLBACK DATA: ' . print_r($this->request->get, true));
                }

                // Callback paystack to get real transaction status
                $ps_api_response = $this->query_api_transaction_verify($trxref);

                $order_status_id = $this->config->get('config_order_status_id');

                if (array_key_exists('data', $ps_api_response) && array_key_exists('status', $ps_api_response['data']) && ($ps_api_response['data']['status'] === 'success')) {
                    $order_status_id = $this->config->get('paystack_approved_status_id');
                    $redir_url = $this->url->link('checkout/success');
                } else if (array_key_exists('data', $ps_api_response) && array_key_exists('status', $ps_api_response['data']) && ($ps_api_response['data']['status'] === 'failure')) {
                    $order_status_id = $this->config->get('paystack_declined_status_id');
                    $redir_url = $this->url->link('checkout/checkout', '', 'SSL');
                } else {
                    $order_status_id = $this->config->get('paystack_error_status_id');
                    $redir_url = $this->url->link('checkout/checkout', '', 'SSL');
                }

                $this->model_checkout_order->addOrderHistory($order_id, $order_status_id);
                $this->redir_and_die($redir_url);
            }

        }


    }
}
