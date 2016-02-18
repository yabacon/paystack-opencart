<?php
class ControllerPaymentPaystack extends Controller
{
    protected function index() 
    {
        $this->language->load('payment/paystack');

        $this->data['text_testmode'] = $this->language->get('text_testmode'); 

        $this->data['button_confirm'] = $this->language->get('button_confirm');

        $this->data['livemode'] = $this->config->get('paystack_live');
        if ($this->config->get('paystack_live')) {
            $this->data['key'] = $this->config->get('paystack_live_public');
        } else {
            $this->data['key'] = $this->config->get('paystack_test_public');
        }

        $this->load->model('checkout/order');

        $order_info = $this->model_checkout_order->getOrder($this->session->data['order_id']);

        if ($order_info) {
 
            $this->data['ref'] = uniqid('' . $this->session->data['order_id'] . '-');
            $this->data['amount'] = intval($order_info['total'] * 100);
            $this->data['email'] = $order_info['email'];
            $this->data['callback'] = $this->url->link('payment/paystack/callback', 'trxref=' . rawurlencode($data['ref']), 'SSL');
 
            if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/payment/paystack.tpl')) {
                $this->template = $this->config->get('config_template') . '/template/payment/paystack.tpl';
            } else {
                $this->template = 'default/template/payment/paystack.tpl';
            }

            $this->render();
        }
    }
    
    protected function query_api_transaction_verify($reference)
    {
        $url = 'https://api.paystack.co/transaction/verify/' . urlencode($reference);
        $data = array();
        
        if ($this->config->get('paystack_live')) {
            $skey = $this->config->get('paystack_live_secret');
        } else {
            $skey = $this->config->get('paystack_test_secret');
        }

        //open connection
        $ch = curl_init();

        //set the url, and the header
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt(
            $ch, CURLOPT_HTTPHEADER, [
            "Authorization: Bearer " . $skey]
        );

        //execute post
        $result = curl_exec($ch);

        //close connection
        curl_close($ch);

        if ($result) {
            $data = json_decode($result, true);
        }
        
        return $data;
    }

    protected function redir_and_die($url, $onlymeta = false) 
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
            if(!$order_id) {
                $order_id = 0;
            }
        
            $this->load->model('checkout/order');

            $order_info = $this->model_checkout_order->getOrder($order_id);
            
            if ($order_info) {
                if ($this->config->get('paystack_debug')) {
                    $this->log->write('PAYSTACK :: CALLBACK DATA: ' . print_r($this->request->get, true));
                }
            
                // TODO Callback paystack to get real transaction status
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
 
                if (!$order_info['order_status_id']) {
                    $this->model_checkout_order->confirm($order_id, $order_status_id);
                } else {
                    $this->model_checkout_order->update($order_id, $order_status_id);
                }
                
                $this->redir_and_die($redir_url);
            }
        }
    }
}
