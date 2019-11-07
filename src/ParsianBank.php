<?php

namespace appsfarsi\parsian;


class ParsianBank {


  public static function confirmPayment($token) {

    $PIN = config('Parsian.pin');
    $wsdl_url = "https://pec.shaparak.ir/NewIPGServices/Confirm/ConfirmService.asmx?WSDL";


    $params = array(
      "LoginAccount" => $PIN,
      "Token" => $token
    );

    $client = new \SoapClient($wsdl_url);

    try {
      $result = $client->ConfirmPayment(array(
        "requestData" => $params
      ));


      if ($result->ConfirmPaymentResult->Status != '0') {
        $out = [
          "Message" => "پرداخت موفقیت آمیز نبود",
          "Status" => $result->ConfirmPaymentResult->Status
        ];

      } else {
        $out = [
          "CardNumberMasked" => $result->ConfirmPaymentResult->CardNumberMasked,
          "RRN" => $result->ConfirmPaymentResult->RRN,
          "Status" => $result->ConfirmPaymentResult->Status,
        ];


      }
    } catch (\Exception $ex) {
      $out = [
        "Message" => "خطای ناشناخته ، با پشتیبانی تماس بگیرید",
        "Status" => -1000
      ];
    }


    return $out;

  }


  public static function sendPayment($amount, $id, $site_call_back_url) {

    $PIN = config('Parsian.pin');
    $wsdl_url = "https://pec.shaparak.ir/NewIPGServices/Sale/SaleService.asmx?WSDL";


    $params = array(
      "LoginAccount" => $PIN,
      "Amount" => $amount,
      "OrderId" => $id,
      "CallBackUrl" => $site_call_back_url
    );

    $client = new \SoapClient($wsdl_url);


    try {
      $result = $client->SalePaymentRequest(array(
        "requestData" => $params
      ));
      if ($result->SalePaymentRequestResult->Token && $result->SalePaymentRequestResult->Status === 0) {

        $pay = \App\Payment::where("id", "=", $id)->first();
        $pay->update(["token" => $result->SalePaymentRequestResult->Token]);
        return [
          "status" => true,
          "Token" => $result->SalePaymentRequestResult->Token,
          "url" => "https://pec.shaparak.ir/NewIPG/?Token=" . $result->SalePaymentRequestResult->Token
        ];
      } elseif ($result->SalePaymentRequestResult->Status != '0') {
        return [
          "status" => false,
          "error" => $result->SalePaymentRequestResult->Message,
          "statusCode" => $result->SalePaymentRequestResult->Status
        ];
      }
    } catch (\Exception $ex) {
      return [
        "status" => false,
        "error" => $ex->getMessage()
      ];
    }
    return [
      "status" => false,
      "error" => "undefined"
    ];
  }


}