<?php
class ModelPaymentPaystack extends Model
{
    public function getMethod($address, $total)
    {
        $this->load->language('payment/paystack');

        $query = $this->db->query(
            "SELECT *
                FROM " . DB_PREFIX . "zone_to_geo_zone
                  WHERE geo_zone_id = '" . (int)$this->config->get('paystack_geo_zone_id') . "'
                    AND country_id = '" . (int)$address['country_id'] . "'
                    AND (zone_id = '" . (int)$address['zone_id'] . "'
                           OR zone_id = '0')"
        );

        if ($this->config->get('paystack_total') > $total) {
            $status = false;
        } elseif (!$this->config->get('paystack_geo_zone_id')) {
            $status = true;
        } elseif ($query->num_rows) {
            $status = true;
        } else {
            $status = false;
        }

        // Paystack Only switches NGN for now
        if ($status && (strtoupper($this->config->get('config_currency'))!=='NGN')) {
            $status = false;
        }

        $method_data = array();

        if ($status) {
            $method_data = array(
            'code' => 'paystack',
            'title' => $this->language->get('text_title'),
            'terms' => '',
            'sort_order' => $this->config->get('paystack_sort_order')
            );
        }

        return $method_data;
    }
}
