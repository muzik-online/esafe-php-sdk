# ESafe PHP SDK
![](https://github.com/muzik-online/esafe-php-sdk/workflows/Test/badge.svg)

Unofficial PHP SDK for [紅陽支付](https://www.esafe.com.tw/index/Index.aspx), made by [Muzik Air](https://muzikair.com).

## 注意事項

1. 紅陽支付因設計上的缺陷，故無法由 PHP 端送出交易
    - 需要另外由前端實作送出交易的功能
        - 前端若需要計算 `ChkValue` 時，請**務必**交給後端程式計算，否則將會暴露交易密碼
    - 本 SDK 著重於接受紅陽之 WebHook 功能（後台顯示名為「交易成功接收網址」、「交易失敗接收網址」與「交易回傳確認網址」）
2. 部份功能需與紅陽支付另外申請
    - Taiwanpay 支付方式
    - 電子發票（捐贈碼與統一編號功能）

## Installation

```base
composer require muzik/esafe-php-sdk
```

## Usage

### 處理交易時 Web Hook

```php
<?php

use Muzik\EsafeSdk\Esafe;
 
$sdk = new Esafe([
    // string of password when transaction, it should be set in esafe.com.tw
    // IMPORTANT: The value is **NOT** login password for esafe.com.tw!
    'transaction_password' => 'abcd5888',
]);

$sdk->handle(Esafe::HANDLER_CREDIT_CARD, \GuzzleHttp\Psr7\ServerRequest::fromGlobals());
// The following method is allowed: 
// $sdk->handle(Esafe::HANDLER_CREDIT_CARD, $_POST);
```

### 確認交易狀況

```php
<?php

use Muzik\EsafeSdk\Esafe;

$sdk = new Esafe([
    // string of password when transaction, it should be set in esafe.com.tw
    // IMPORTANT: The value is **NOT** login password for esafe.com.tw!
    'transaction_password' => 'abcd5888',
]);

$sdk->check([
    // 商家代號
    'web' => 'S1103020010',
    // 交易金額
    'MN' => '110',
    // 紅陽交易編號
    'buysafeno' => '2400009912300000019',
    // 商家訂單編號
    'Td' => 'AC9087201',
    // 備註
    'note1' => '',
    'note2' => '',
], $isTesting = false);
```

### 進行退款處理

```php
<?php

use Muzik\EsafeSdk\Esafe;

$sdk = new Esafe([
    // string of password when transaction, it should be set in esafe.com.tw
    // IMPORTANT: The value is **NOT** login password for esafe.com.tw!
    'transaction_password' => 'abcd5888',
]);

$sdk->refund([
    // 商家代號
    'web' => 'S1103020010',
    // 交易金額
    'MN' => '1000',
    // 紅陽交易編號
    'buysafeno' => '2400009912300000019',
    // 訂單編號（通常由商家自行生成）
    'Td' => 'AC9087201',
    // 退款原因
    'RefundMemo' => 'Hello World',
], $isTesting = false);
```

### Available Handlers

1. 所有支付方式都有「交易結果」
2. 對於非同步付款（見下註）的支付方式，會增加一個「付款結果」
    - 超商條碼
    - 超商代碼
    - 虛擬銀行帳號
    - 貨到付款

> 非同步付款：消費者於交易結果產生後才進行付款。
>
> 消費者購買商品 => 商店產生交易結果（內含超商條碼） => 消費者憑交易結果之超商條碼繳費 => 商店取得付款結果

- `Esafe::HANDLER_CREDIT_CARD`: 信用卡
- `Esafe::HANDLER_UNIONPAY_CARD`: 銀聯卡
- `Esafe::HANDLER_BARCODE`: 超商條碼
- `Esafe::HANDLER_BARCODE_RESULT`: 超商條碼付款結果
- `Esafe::HANDLER_PAYCODE`: 超商代碼
- `Esafe::HANDLER_PAYCODE_RESULT`: 超商代碼付款結果
- `Esafe::HANDLER_WEB_ATM`: 網路 ATM
- `Esafe::HANDLER_BANK_TRANSFER`: 虛擬銀行帳號
- `Esafe::HANDLER_BANK_TRNASFER_RESULT`: 虛擬銀行帳號付款結果
- `Esafe::HANDLER_CASH_ON_DELIVERY`: 貨到付款
- `Esafe::HANDLER_CASH_ON_DELIVERY_RESULT`: 貨到付款
- `Esafe::HANDLER_TAIWAN_PAY`: 台灣Pay

### Refund 注意事項

- `web`, `MN`, `buysafeno`, `Td` 及 `RefundMemo` 為必填，且**不可**為空字串
- 發出退款的主機 IP 需經紅陽認證，請另行申請
- 退款僅限信用卡及銀聯卡的付款
- 僅能退款 2 個月內的交易

### Check 注意事項

- `web` 為必填
- `MN`, `buysafeno`, `Td`, `note1` 及 `note2` 則一填寫，可多填但至少需要一個
- 若沒有加入 `buysafeno`，僅能查詢近七天內的交易

### 錯誤處理

本 SDK 只會拋出三種例外

- `HandlerException`, `CheckException` 及 `RefundException`
    - 如果不屬於這兩種 Exception，表示底層出現 Fatal Error
    - 這三種 Exception 都繼承 `\RuntimeException`
- 請妥善處理這兩種例外
- 使用 `check` 功能時，若無交易記錄仍然會拋出 `CheckException`，其 Message 為「無交易，請聯絡您的商家」

## License

This library is under [MIT](https://opensource.org/licenses/MIT) license.