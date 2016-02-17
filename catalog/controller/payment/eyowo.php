<?php
class ControllerPaymentEyowo extends Controller {
  private static function gen_uuid() {
    return sprintf( '%04x%04x-%04x-%04x-%04x-%04x%04x%04x',
        // 32 bits for "time_low"
        mt_rand( 0, 0xffff ), mt_rand( 0, 0xffff ),

        // 16 bits for "time_mid"
        mt_rand( 0, 0xffff ),

        // 16 bits for "time_hi_and_version",
        // four most significant bits holds version number 4
        mt_rand( 0, 0x0fff ) | 0x4000,

        // 16 bits, 8 bits for "clk_seq_hi_res",
        // 8 bits for "clk_seq_low",
        // two most significant bits holds zero and one for variant DCE1.1
        mt_rand( 0, 0x3fff ) | 0x8000,

        // 48 bits for "node"
        mt_rand( 0, 0xffff ), mt_rand( 0, 0xffff ), mt_rand( 0, 0xffff )
    );
  }



	protected function index() {
    $this->data['button_confirm'] = $this->language->get('button_confirm');
		$this->data['continue'] = $this->url->link('checkout/success');

    $this->data['action'] = "https://www.eyowo.com/gateway/pay";

    $this->load->model('checkout/order');
    $order_info = $this->model_checkout_order->getOrder($this->session->data['order_id']);

    // mark the order as pending
    // pending_status_id = 1
    $this->model_checkout_order->confirm($order_info['order_id'], 1);
		
    $this->data['eyowo_wallet_code'] = $this->config->get('eyowo_wallet_code');
    $this->data['eyowo_transaction_reference'] = $this->config->get('eyowo_wallet_code') . '_' . $order_info['order_id'] . '_' . strtoupper(substr($this::gen_uuid(), 0, 8)) ;
    $this->data['eyowo_transaction_name'] = $this->config->get('eyowo_merchant_name') . ' ' . 'Transaction';

    $this->data['eyowo_transaction_description'] = $this->config->get('eyowo_merchant_name') . ' - #' . $order_info['order_id'];
    $this->data['eyowo_transaction_total'] = $this->currency->format($order_info['total'], $order_info['currency_code'], $order_info['currency_value'], false) * 100;
    // $this->data['eyowo_wallet_code'] = "";

    $this->session->data['eyowo_transaction_reference'] = $this->data['eyowo_transaction_reference'];

		if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/payment/eyowo.tpl')) {
			$this->template = $this->config->get('config_template') . '/template/payment/eyowo.tpl';
		} else {
			$this->template = 'default/template/payment/eyowo.tpl';
		}
	 
		$this->render();
	}

  public function callback() {
    // $order_id = $this->session->data['order_id']

    if (isset($this->session->data['order_id'])) {
      $eyowo_transaction_reference = $this->session->data['eyowo_transaction_reference'];
    } else {
      $eyowo_transaction_reference = $this->request->get['transactionref'];
    }

    if (isset($this->session->data['order_id'])) {
      $order_id = $this->session->data['order_id'];
    } else {
      // redirect to home page.
      $this->redirect($this->url->link('common/home'));  
    }

    $this->load->model('checkout/order');
    $order_info = $this->model_checkout_order->getOrder($order_id);

    $eyowo_wallet_code = $this->config->get('eyowo_wallet_code');
    $eyowo_api_url = "https://www.eyowo.com/api/gettransactionstatus?format=json&walletcode="
                      .$eyowo_wallet_code."&transactionref=".$eyowo_transaction_reference;

    $response = json_decode(file_get_contents($eyowo_api_url));

    $this->data['eyowo_transaction_reference'] = $eyowo_transaction_reference;
    $this->data['eyowo_transaction_status'] = $response->STATUS;
    $this->data['eyowo_transaction_status_reason'] = $response->STATUSREASON;

    if (isset($response->TRANSACTIONDATE)) {
      $this->data['eyowo_transaction_date'] = $response->TRANSACTIONDATE;
    }
    $this->data['eyowo_transaction_amount'] = $this->currency->format($order_info['total'], $order_info['currency_code'], $order_info['currency_value'], false);

    if ($this->data['eyowo_transaction_status'] == "Approved") {
      // mark the order as completed
      // complete_status = 5

      $this->data['continue'] = $this->url->link('common/home');
      $this->data['button_continue'] = "Continue To ".$this->config->get('eyowo_merchant_name');

      $this->model_checkout_order->update($order_info['order_id'], 5);
      $this->clear();
    } else {
      // mark the order as Failed
      // Failed = 10
      $this->model_checkout_order->update($order_info['order_id'], 10);

      $this->data['continue'] = $this->url->link('checkout/checkout');
      $this->data['button_continue'] = "Try To Checkout Again";
    }

    if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/payment/eyowo_success.tpl')) {
      $this->template = $this->config->get('config_template') . '/template/payment/eyowo_success.tpl';
    } else {
      $this->template = 'default/template/payment/eyowo_callback.tpl';
    }
      
    $this->children = array(
      'common/column_left',
      'common/column_right',
      'common/content_top',
      'common/content_bottom',
      'common/footer',
      'common/header'
    );
      
    $this->response->setOutput($this->render());
  }
	
	public function confirm() {
		$this->load->model('checkout/order');
		$this->model_checkout_order->confirm($this->session->data['order_id'], $this->config->get('eyowo_order_status_id'));
	}

  private function clear() {
    if (isset($this->session->data['order_id'])) {
      $this->cart->clear();

      unset($this->session->data['shipping_method']);
      unset($this->session->data['shipping_methods']);
      unset($this->session->data['payment_method']);
      unset($this->session->data['payment_methods']);
      unset($this->session->data['guest']);
      unset($this->session->data['comment']);
      unset($this->session->data['order_id']);  
      unset($this->session->data['coupon']);
      unset($this->session->data['reward']);
      unset($this->session->data['voucher']);
      unset($this->session->data['vouchers']);
    } 
  }
}
?>