<?php

namespace Muzik\EsafeSdk;

use Muzik\EsafeSdk\Handlers\WebAtm;
use Muzik\EsafeSdk\Handlers\Barcode;
use Muzik\EsafeSdk\Handlers\Paycode;
use Muzik\EsafeSdk\Contracts\Handler;
use Muzik\EsafeSdk\Handlers\Taiwanpay;
use Muzik\EsafeSdk\Handlers\CreditCard;
use Muzik\EsafeSdk\Handlers\BankTransfer;
use Muzik\EsafeSdk\Handlers\UnionpayCard;
use Muzik\EsafeSdk\Handlers\BarcodeResult;
use Muzik\EsafeSdk\Handlers\PaycodeResult;
use Muzik\EsafeSdk\Services\RefundService;
use Muzik\EsafeSdk\Handlers\CashOnDelivery;
use Psr\Http\Message\ServerRequestInterface;
use Muzik\EsafeSdk\Handlers\BankTransferResult;
use Muzik\EsafeSdk\Handlers\CashOnDeliveryResult;

class Esafe
{
    const HANDLER_CREDIT_CARD = CreditCard::class;
    const HANDLER_UNIONPAY_CARD = UnionpayCard::class;
    const HANDLER_BARCODE = Barcode::class;
    const HANDLER_BARCODE_RESULT = BarcodeResult::class;
    const HANDLER_PAYCODE = Paycode::class;
    const HANDLER_PAYCODE_RESULT = PaycodeResult::class;
    const HANDLER_WEB_ATM = WebAtm::class;
    const HANDLER_BANK_TRANSFER = BankTransfer::class;
    const HANDLER_BANK_TRANSFER_RESULT = BankTransferResult::class;
    const HANDLER_CASH_ON_DELIVERY = CashOnDelivery::class;
    const HANDLER_CASH_ON_DELIVERY_RESULT = CashOnDeliveryResult::class;
    const HANDLER_TAIWAN_PAY = Taiwanpay::class;

    protected string $apiKey;

    public function __construct(array $config)
    {
        $this->apiKey = $config['transaction_password'];
    }

    public function handle(string $handler, ServerRequestInterface $request): Handler
    {
        return new $handler($request, $this->apiKey);
    }

    public function refund(array $parameters, bool $testing): RefundService
    {
        return new RefundService($parameters, $this->apiKey, $testing);
    }
}
