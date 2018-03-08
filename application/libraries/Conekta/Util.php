<?php
abstract class Util
{
  public static $types = array(
    'webhook'                     => 'Webhook',
    'webhook_log'                 => 'WebhookLog',
    'billing_address'             => 'Address',
    'bank_transfer_payout_method' => 'Method',
    'payout'                      => 'Payout',
    'payee'                       => 'Payee',
    'payout_method'               => 'PayoutMethod',
    'card_payment'                => 'PaymentMethod',
    'cash_payment'                => 'PaymentMethod',
    'bank_transfer_payment'       => 'PaymentMethod',
    'card'                        => 'Card',
    'charge'                      => 'Charge',
    'customer'                    => 'Customer',
    'event'                       => 'Event',
    'plan'                        => 'Plan',
    'subscription'                => 'Subscription',
    'payment_source'              => 'PaymentSource',
    'tax_line'                    => 'TaxLine',
    'shipping_line'               => 'ShippingLine',
    'discount_line'               => 'DiscountLine',
    'conekta_list'                => 'ConektaList',
    'shipping_contact'            => 'ShippingContact',
    'lang'                        => 'Lang',
    'line_item'                   => 'LineItem',
    'order'                       => 'Order',
    'token'                       => 'Token'
    );

  public static function convertToConektaObject($resp)
  {
    $types = self::$types;
    if (is_array($resp)) {
      if (isset($resp['object']) && is_string($resp['object']) && isset($types[$resp['object']])) {
        $class = $types[$resp['object']];
        $instance = new $class();
        $instance->loadFromArray($resp);

        return $instance;
      }

      if (isset($resp['street1']) || isset($resp['street2'])) {
        $class = 'Address';
        $instance = new $class();
        $instance->loadFromArray($resp);

        return $instance;
      }

      if (current($resp)) {
        $instance = new ConektaObject();
        $instance->loadFromArray($resp);

        return $instance;
      }

      return new ConektaObject();
    }

    return $resp;
  }

  public static function shiftArray($array, $object)
  {
    unset($array[$object]);
    end($array);
    $lastKey = key($array);

    for ($i = $object; $i < $lastKey; ++$i) {
      $array[$i] = $array[$i + 1];
      unset($array[$i + 1]);
    }

    return $array;
  }
}
