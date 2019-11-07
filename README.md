# parsian
this is parsian bank repository for laravel


جهت صدا زدن درگاه پرداخت از متد 
\appsfarsi\parsian\ParsianBank::sendPayment($amount, $id, $site_call_back_url)
استفاده کنید . 

$amount = مبلغ پرداختی 
$id = آی دی یکتای پرداخت
$site_call_back_url = آدرس بازگشتی به سایت

خروجی در حالتی که درست باشد به شکل زیر خواهد بود : 
 return [
          "status" => true,
          "Token" => "",
          "url" => ""
        ];


خروجی در حالتی که با خطا مواجه شود : 
 return [
          "status" => false,
          "error" => "Message",
          "statusCode" => "statusCode"
        ];




متد جهت صدا زدن بررسی صحیح بودن پرداخت : 
\appsfarsi\parsian\ParsianBank::confirmPayment($token)


در صورتی که پرداخت موفقیت آمیز باشد و به درستی انجام شود خروجی این است : 

 $out = [
          "CardNumberMasked" => "CardNumberMasked",
          "RRN" => "RRN",
          "Status" => "Status",
        ];
        
        
 اگر خطا بوجود آید خروجی به این شکل خواهد بود : 
 
  $out = [
           "Message" => "پرداخت موفقیت آمیز نبود",
           "Status" => "Status"
         ];
         
  اگر در هنگام صدا زدن آدرس بانک خطایی بوجود آید استتوس عدد -1000 خواهد شد .  
        






