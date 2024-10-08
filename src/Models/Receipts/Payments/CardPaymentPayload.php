<?php

namespace DigitSoft\Checkbox\Models\Receipts\Payments;

/**
 * @method static static make(string $value, string $label = 'Безготівковий', int $code = 0, string $card_mask = '', string $card_name = '', string $terminal = '', string $rrn = '', string $auth_code = '', string $payment_system = '', string $receipt_no = '', string $acquirer_and_seller = '', int $commission = 0)
 */
class CardPaymentPayload extends PaymentParent
{
    public int $code;
    public string $card_mask;

    public string $terminal;
    public string $rrn;
    public string $card_name;
    public string $auth_code;
    public string $payment_system;
    public string $receipt_no;
    public string $acquirer_and_seller;
    public int $commission;

    public function __construct(
        string $value,
        string $label = 'Безготівковий',
        int $code = 0,
        string $card_mask = '',
        string $card_name = '',
        string $terminal = '',
        string $rrn = '',
        string $auth_code = '',
        string $payment_system = '',
        string $receipt_no = '',
        string $acquirer_and_seller = '',
        int $commission = 0
    ) {
        parent::__construct(parent::TYPE_CARD, $value, $label);

        $this->code = $code;
        $this->card_mask = $card_mask;
        $this->card_name = $card_name;
        $this->terminal = $terminal;
        $this->rrn = $rrn;
        $this->auth_code = $auth_code;
        $this->payment_system = $payment_system;
        $this->receipt_no = $receipt_no;
        $this->acquirer_and_seller = $acquirer_and_seller;
        $this->commission = $commission;
    }
}
