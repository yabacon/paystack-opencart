<?php
class ControllerPaymentPaystack extends Controller
{
    private $error = array();

    public function index() 
    {
        $this->load->language('extension/payment/paystack');

        $this->document->setTitle($this->language->get('heading_title'));

        $this->load->model('setting/setting');

        if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validate()) {
            // echo "Didn't get here";
            // die();
            $this->model_setting_setting->editSetting('paystack', $this->request->post);

            $this->session->data['success'] = $this->language->get('text_success');

            $this->response->redirect($this->url->link('extension/extension', 'token=' . $this->session->data['token']. '&type=payment', 'SSL'));
        }

        $data['heading_title'] = $this->language->get('heading_title');
 
        $data['text_edit'] = $this->language->get('text_edit');
        $data['text_enabled'] = $this->language->get('text_enabled');
        $data['text_disabled'] = $this->language->get('text_disabled');
        $data['text_all_zones'] = $this->language->get('text_all_zones');
        $data['text_yes'] = $this->language->get('text_yes');
        $data['text_no'] = $this->language->get('text_no');
        $data['text_pay'] = $this->language->get('text_pay');
        $data['text_disable_payment'] = $this->language->get('text_disable_payment');
        
        $data['entry_live_secret'] = $this->language->get('entry_live_secret');
        $data['entry_live_public'] = $this->language->get('entry_live_public');
        $data['entry_test_secret'] = $this->language->get('entry_test_secret');
        $data['entry_test_public'] = $this->language->get('entry_test_public');
        
        $data['entry_live'] = $this->language->get('entry_live');
        $data['entry_debug'] = $this->language->get('entry_debug');
        $data['entry_total'] = $this->language->get('entry_total');
        $data['entry_approved_status'] = $this->language->get('entry_approved_status');
        $data['entry_declined_status'] = $this->language->get('entry_declined_status');
        $data['entry_error_status'] = $this->language->get('entry_error_status');
        $data['entry_geo_zone'] = $this->language->get('entry_geo_zone');
        $data['entry_status'] = $this->language->get('entry_status');
        $data['entry_sort_order'] = $this->language->get('entry_sort_order');

        $data['help_live'] = $this->language->get('help_live');
        $data['help_debug'] = $this->language->get('help_debug');
        $data['help_total'] = $this->language->get('help_total');

        $data['button_save'] = $this->language->get('button_save');
        $data['button_cancel'] = $this->language->get('button_cancel');

        $data['tab_general'] = $this->language->get('tab_general');
        $data['tab_order_status'] = $this->language->get('tab_order_status');

        if (isset($this->error['warning'])) {
            $data['error_warning'] = $this->error['warning'];
        } else {
            $data['error_warning'] = '';
        }

        if (isset($this->error['keys'])) {
            $data['error_keys'] = $this->error['keys'];
        } else {
            $data['error_keys'] = '';
        }

        $data['breadcrumbs'] = array();

        $data['breadcrumbs'][] = array(
        'text' => $this->language->get('text_home'),
        'href' => $this->url->link('common/home', 'token=' . $this->session->data['token'], 'SSL')
        );

        $data['breadcrumbs'][] = array(
        'text' => $this->language->get('text_payment'),
        'href' => $this->url->link('extension/extension', 'token=' . $this->session->data['token'].'&type=payment', 'SSL')
        );

        $data['breadcrumbs'][] = array(
        'text' => $this->language->get('heading_title'),
        'href' => $this->url->link('extension/payment/paystack', 'token=' . $this->session->data['token'], 'SSL')
        );

        $data['action'] = $this->url->link('extension/payment/paystack', 'token=' . $this->session->data['token'], 'SSL');

        $data['cancel'] = $this->url->link('extension/payment', 'token=' . $this->session->data['token'] . '&type=payment', 'SSL');

        if (isset($this->request->post['paystack_live_secret'])) {
            $data['paystack_live_secret'] = $this->request->post['paystack_live_secret'];
        } else {
            $data['paystack_live_secret'] = $this->config->get('paystack_live_secret');
        }
 
        if (isset($this->request->post['paystack_live_public'])) {
            $data['paystack_live_public'] = $this->request->post['paystack_live_public'];
        } else {
            $data['paystack_live_public'] = $this->config->get('paystack_live_public');
        }
 
        if (isset($this->request->post['paystack_test_public'])) {
            $data['paystack_test_secret'] = $this->request->post['paystack_test_secret'];
        } else {
            $data['paystack_test_secret'] = $this->config->get('paystack_test_secret');
        }
 
        if (isset($this->request->post['paystack_test_public'])) {
            $data['paystack_test_public'] = $this->request->post['paystack_test_public'];
        } else {
            $data['paystack_test_public'] = $this->config->get('paystack_test_public');
        }
 
        if (isset($this->request->post['paystack_live'])) {
            $data['paystack_live'] = $this->request->post['paystack_live'];
        } else {
            $data['paystack_live'] = $this->config->get('paystack_live');
        }

        if (isset($this->request->post['paystack_debug'])) {
            $data['paystack_debug'] = $this->request->post['paystack_debug'];
        } else {
            $data['paystack_debug'] = $this->config->get('paystack_debug');
        }

        if (isset($this->request->post['paystack_total'])) {
            $data['paystack_total'] = $this->request->post['paystack_total'];
        } else {
            $data['paystack_total'] = $this->config->get('paystack_total');
        }

        if (isset($this->request->post['paystack_approved_status_id'])) {
            $data['paystack_approved_status_id'] = $this->request->post['paystack_approved_status_id'];
        } else {
            $data['paystack_approved_status_id'] = $this->config->get('paystack_approved_status_id');
        }

        if (isset($this->request->post['paystack_declined_status_id'])) {
            $data['paystack_declined_status_id'] = $this->request->post['paystack_declined_status_id'];
        } else {
            $data['paystack_declined_status_id'] = $this->config->get('paystack_declined_status_id');
        }

        if (isset($this->request->post['paystack_error_status_id'])) {
            $data['paystack_error_status_id'] = $this->request->post['paystack_error_status_id'];
        } else {
            $data['paystack_error_status_id'] = $this->config->get('paystack_error_status_id');
        }

        $this->load->model('localisation/order_status');

        $data['order_statuses'] = $this->model_localisation_order_status->getOrderStatuses();

        if (isset($this->request->post['paystack_geo_zone_id'])) {
            $data['paystack_geo_zone_id'] = $this->request->post['paystack_geo_zone_id'];
        } else {
            $data['paystack_geo_zone_id'] = $this->config->get('paystack_geo_zone_id');
        }

        $this->load->model('localisation/geo_zone');

        $data['geo_zones'] = $this->model_localisation_geo_zone->getGeoZones();

        if (isset($this->request->post['paystack_status'])) {
            $data['paystack_status'] = $this->request->post['paystack_status'];
        } else {
            $data['paystack_status'] = $this->config->get('paystack_status');
        }

        if (isset($this->request->post['paystack_sort_order'])) {
            $data['paystack_sort_order'] = $this->request->post['paystack_sort_order'];
        } else {
            $data['paystack_sort_order'] = $this->config->get('paystack_sort_order');
        }

        $data['header'] = $this->load->controller('common/header');
        $data['column_left'] = $this->load->controller('common/column_left');
        $data['footer'] = $this->load->controller('common/footer');

        $this->response->setOutput($this->load->view('payment/paystack.tpl', $data));
    }
    
    private function valid_key($value, $mode, $access)
    {
        return (substr_compare($value, (substr($access, 0, 1)).'k_'.$mode.'_', 0, 8, true)===0);
    }

    private function validate() 
    {
        if (!$this->user->hasPermission('modify', 'extension/payment/paystack')) {
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