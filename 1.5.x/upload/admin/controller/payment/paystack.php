<?php
class ControllerPaymentPaystack extends Controller
{
    private $error = array();

    public function index() 
    {
        $this->load->language('payment/paystack');

        $this->document->setTitle($this->language->get('heading_title'));

        $this->load->model('setting/setting');

        if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validate()) {
            $this->model_setting_setting->editSetting('paystack', $this->request->post);

            $this->session->data['success'] = $this->language->get('text_success');

            $this->redirect($this->url->link('extension/payment', 'token=' . $this->session->data['token'], 'SSL'));
        }

        $this->data['heading_title'] = $this->language->get('heading_title');

        $this->data['text_enabled'] = $this->language->get('text_enabled');
        $this->data['text_disabled'] = $this->language->get('text_disabled');
        $this->data['text_all_zones'] = $this->language->get('text_all_zones');
        $this->data['text_yes'] = $this->language->get('text_yes');
        $this->data['text_no'] = $this->language->get('text_no');
        $this->data['text_pay'] = $this->language->get('text_pay');
        $this->data['text_disable_payment'] = $this->language->get('text_disable_payment');

        $this->data['entry_test_secret'] = $this->language->get('entry_test_secret');
        $this->data['entry_live_secret'] = $this->language->get('entry_live_secret');
        
        $this->data['entry_live'] = $this->language->get('entry_live');
        $this->data['entry_debug'] = $this->language->get('entry_debug');
        $this->data['entry_total'] = $this->language->get('entry_total'); 
        $this->data['entry_approved_status'] = $this->language->get('entry_approved_status');
        $this->data['entry_declined_status'] = $this->language->get('entry_declined_status');
        $this->data['entry_error_status'] = $this->language->get('entry_error_status');
        $this->data['entry_geo_zone'] = $this->language->get('entry_geo_zone');
        $this->data['entry_status'] = $this->language->get('entry_status');
        $this->data['entry_sort_order'] = $this->language->get('entry_sort_order');

        $this->data['button_save'] = $this->language->get('button_save');
        $this->data['button_cancel'] = $this->language->get('button_cancel');

        if (isset($this->error['warning'])) {
            $this->data['error_warning'] = $this->error['warning'];
        } else {
            $this->data['error_warning'] = '';
        }

        if (isset($this->error['keys'])) {
            $this->data['error_keys'] = $this->error['keys'];
        } else {
            $this->data['error_keys'] = '';
        }

        $this->data['breadcrumbs'] = array();

        $this->data['breadcrumbs'][] = array(
        'text' => $this->language->get('text_home'),
        'href' => $this->url->link('common/home', 'token=' . $this->session->data['token'], 'SSL'), 
        'separator' => false
        );

        $this->data['breadcrumbs'][] = array(
        'text' => $this->language->get('text_payment'),
        'href' => $this->url->link('extension/payment', 'token=' . $this->session->data['token'], 'SSL'),
        'separator' => ' :: '
        );

        $this->data['breadcrumbs'][] = array(
        'text' => $this->language->get('heading_title'),
        'href' => $this->url->link('payment/paystack', 'token=' . $this->session->data['token'], 'SSL'),
        'separator' => ' :: '
        );

        $this->data['action'] = $this->url->link('payment/paystack', 'token=' . $this->session->data['token'], 'SSL');

        $this->data['cancel'] = $this->url->link('extension/payment', 'token=' . $this->session->data['token'], 'SSL');

        if (isset($this->request->post['paystack_live_secret'])) {
            $this->data['paystack_live_secret'] = $this->request->post['paystack_live_secret'];
        } else {
            $this->data['paystack_live_secret'] = $this->config->get('paystack_live_secret');
        }
 
        if (isset($this->request->post['paystack_live_public'])) {
            $this->data['paystack_live_public'] = $this->request->post['paystack_live_public'];
        } else {
            $this->data['paystack_live_public'] = $this->config->get('paystack_live_public');
        }
 
        if (isset($this->request->post['paystack_test_public'])) {
            $this->data['paystack_test_secret'] = $this->request->post['paystack_test_secret'];
        } else {
            $this->data['paystack_test_secret'] = $this->config->get('paystack_test_secret');
        }
 
        if (isset($this->request->post['paystack_test_public'])) {
            $this->data['paystack_test_public'] = $this->request->post['paystack_test_public'];
        } else {
            $this->data['paystack_test_public'] = $this->config->get('paystack_test_public');
        }
 
        if (isset($this->request->post['paystack_live'])) {
            $this->data['paystack_live'] = $this->request->post['paystack_live'];
        } else {
            $this->data['paystack_live'] = $this->config->get('paystack_live');
        }

        if (isset($this->request->post['paystack_debug'])) {
            $this->data['paystack_debug'] = $this->request->post['paystack_debug'];
        } else {
            $this->data['paystack_debug'] = $this->config->get('paystack_debug');
        }

        if (isset($this->request->post['paystack_total'])) {
            $this->data['paystack_total'] = $this->request->post['paystack_total'];
        } else {
            $this->data['paystack_total'] = $this->config->get('paystack_total'); 
        } 

        if (isset($this->request->post['paystack_approved_status_id'])) {
            $this->data['paystack_approved_status_id'] = $this->request->post['paystack_approved_status_id'];
        } else {
            $this->data['paystack_approved_status_id'] = $this->config->get('paystack_approved_status_id');
        }

        if (isset($this->request->post['paystack_declined_status_id'])) {
            $this->data['paystack_declined_status_id'] = $this->request->post['paystack_declined_status_id'];
        } else {
            $this->data['paystack_declined_status_id'] = $this->config->get('paystack_declined_status_id');
        } 

        if (isset($this->request->post['paystack_error_status_id'])) {
            $this->data['paystack_error_status_id'] = $this->request->post['paystack_error_status_id'];
        } else {
            $this->data['paystack_error_status_id'] = $this->config->get('paystack_error_status_id');
        }

        $this->load->model('localisation/order_status');

        $this->data['order_statuses'] = $this->model_localisation_order_status->getOrderStatuses();

        if (isset($this->request->post['paystack_geo_zone_id'])) {
            $this->data['paystack_geo_zone_id'] = $this->request->post['paystack_geo_zone_id'];
        } else {
            $this->data['paystack_geo_zone_id'] = $this->config->get('paystack_geo_zone_id');
        }

        $this->load->model('localisation/geo_zone');

        $this->data['geo_zones'] = $this->model_localisation_geo_zone->getGeoZones();

        if (isset($this->request->post['paystack_status'])) {
            $this->data['paystack_status'] = $this->request->post['paystack_status'];
        } else {
            $this->data['paystack_status'] = $this->config->get('paystack_status');
        }

        if (isset($this->request->post['paystack_sort_order'])) {
            $this->data['paystack_sort_order'] = $this->request->post['paystack_sort_order'];
        } else {
            $this->data['paystack_sort_order'] = $this->config->get('paystack_sort_order');
        }

        $this->template = 'payment/paystack.tpl';
        $this->children = array(
        'common/header',
        'common/footer'
        );

        $this->response->setOutput($this->render());
    }

    private function valid_key($value, $mode, $access)
    {
        return (substr_compare($value, (substr($access, 0, 1)).'k_'.$mode.'_', 0, 8, true)===0);
    }

    private function validate() 
    {
        if (!$this->user->hasPermission('modify', 'payment/paystack')) {
            $this->error['warning'] = $this->language->get('error_permission');
        }
        
        $live_secret = $this->request->post['paystack_live_secret'];
        $live_public = $this->request->post['paystack_live_public'];
        $test_secret = $this->request->post['paystack_test_secret'];
        $test_public = $this->request->post['paystack_test_public'];
 
        if ($this->request->post['paystack_live'] && (!$this->valid_key($live_secret, 'live', 'secret') || !$this->valid_key($live_public, 'live', 'public'))) {
            $this->error['keys'] = $this->language->get('error_live_keys');
        }

        if (!$this->request->post['paystack_live'] && (!$this->valid_key($test_secret, 'test', 'secret') || !$this->valid_key($test_public, 'test', 'public'))) {
            $this->error['keys'] = $this->language->get('error_test_keys');
        }

        return !$this->error;
    }
}
