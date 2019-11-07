# parsian
this is parsian bank repository for laravel

composer require appsfarsi/parsian

php artisan vendor:publish





جهت صدا زدن درگاه پرداخت #
```php
\appsfarsi\parsian\ParsianBank::sendPayment($amount, $id, $site_call_back_url)

# ورودی ها
$amount = مبلغ پرداختی 
$id = آی دی یکتای پرداخت
$site_call_back_url = آدرس بازگشتی به سایت

# خروجی در حالت موفق 
 return [
          "status" => true,
          "Token" => "",
          "url" => ""
        ];
        
# خروجی در حالت خطا        

 return [
          "status" => false,
          "error" => "Message",
          "statusCode" => "statusCode"
        ];
```
 


# 
متد جهت صدا زدن بررسی صحیح بودن پرداخت   


```php
\appsfarsi\parsian\ParsianBank::confirmPayment($token)

# ورودی ها
$token = توکن کاربر 
 
# خروجی در حالت موفق 
 $out = [
           "CardNumberMasked" => "CardNumberMasked",
           "RRN" => "RRN",
           "Status" => "Status",
         ];
        
# خروجی در حالت خطا        

  $out = [
            "Message" => "پرداخت موفقیت آمیز نبود",
            "Status" => "Status"
          ];
          
          #   اگر در هنگام صدا زدن آدرس بانک خطایی بوجود آید استتوس عدد -1000 خواهد شد .  

```
 
 
        






