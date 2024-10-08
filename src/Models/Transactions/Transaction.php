<?php

namespace DigitSoft\Checkbox\Models\Transactions;

use DigitSoft\Checkbox\Models\ModelBase;

/**
 * @method static static make(string $id, string $type, string $serial, string $status, ?string $request_signed_at, ?string $request_received_at, ?string $response_status, ?string $response_error_message, string $created_at, ?string $updated_at, string $request_data = '', string $request_signature = '', string $response_id = '', ?string $response_data_signature = null, ?string $response_data = null)
 */
class Transaction extends ModelBase
{
    public string $id;
    public string $type;
    public int $serial;
    public string $status;
    public ?string $request_signed_at;
    public ?string $request_received_at;
    public ?string $response_status;
    public ?string $response_error_message;
    public string $created_at;
    public ?string $updated_at;

    public string $request_data;
    public string $request_signature;
    public ?string $response_id;
    public ?string $response_data_signature;
    public ?string $response_data;

    public function __construct(
        string $id,
        string $type,
        int $serial,
        string $status,
        ?string $request_signed_at,
        ?string $request_received_at,
        ?string $response_status,
        ?string $response_error_message,
        string $created_at,
        ?string $updated_at,
        string $request_data = '',
        string $request_signature = '',
        ?string $response_id = null,
        ?string $response_data_signature = null,
        ?string $response_data = null
    ) {
        $this->id = $id;
        $this->type = $type;
        $this->serial = $serial;
        $this->status = $status;
        $this->request_signed_at = $request_signed_at;
        $this->request_received_at = $request_received_at;
        $this->response_status = $response_status;
        $this->response_error_message = $response_error_message;
        $this->created_at = $created_at;
        $this->updated_at = $updated_at;

        $this->request_data = $request_data;
        $this->request_signature = $request_signature;
        $this->response_id = $response_id;
        $this->response_data_signature = $response_data_signature;
        $this->response_data = $response_data;
    }
}
