<?php

class coolcoinApi
{
    /**
     * 域名链接
     */
    const HOST        = 'https://www.coolcoin.com';
    const PUBLIC_KEY  = 'sa8ux-gqsrq-4svye-5qedk-m4wu8-jmp3a-b25nd';
    const PRIVATE_KEY = ',2SjT-5aQL;-x4dH;-!1hPa-;IV%b-mLmCL-kmI1M';


    private static $userAgent = 'CoolCoin_Curl_Client';

    private static $connecTimeout = 30;

    private static $timeout = 30;

    private static $httpCode;

    private static $httpInfo;

    private static $errorCode;

    private static $errorInfo;

    private static $requestUrl;

    private static $requestData = null;

    /**
     * Method  balance
     * @desc    账户余额
     *
     * @return  void
     */
    public function balance()
    {
        $url  = self::HOST . '/api/v2/account/balance';
        $data = [
        ];

        $result = $this->curl($url, $data);
        return $result;
    }


    /**
     * Method  depositRecord
     * @desc    充提记录
     * @return  void
     */
    public function depositRecord()
    {
        $url    = self::HOST . '/api/v2/account/depositWithdraw';
        $data   = [
            "currency" => "eth",
            "type"     => "in",
            "from"     => "0",
            "size"     => "10",
        ];
        $result = $this->curl($url, $data);
        return $result;
    }

    /**
     * Method  place
     * @desc   下单
     * @return  void
     */
    public function place()
    {
        $url  = self::HOST . '/api/v2/order/place';
        $data = [
            "amount"    => "0.0001",
            "price"     => "9.99",
            "symbol"    => "eth_usdt",
            "direction" => "buy",
        ];

        $result = $this->curl($url, $data);
        return $result;
    }

    /**
     * Method  cancel
     * @desc    撤单
     *
     * @return  void
     */
    public function cancel()
    {
        $url    = self::HOST . '/api/v2/order/cancel';
        $data   = [
            "symbol"   => "eth_btc",
            "order_id" => "53",
        ];
        $result = $this->curl($url, $data);
        return $result;
    }


    /**
     * Method  detail
     * @desc    订单详情
     *
     * @return  void
     */
    public function detail()
    {
        $url  = self::HOST . '/api/v2/order/detail';
        $data = [
            "symbol"   => "eth_btc",
            "order_id" => "50",
        ];

        $result = $this->curl($url, $data);
        return $result;
    }

    /**
     * Method  openorder
     * @desc    未成交订单列表
     *
     * @return  void
     */
    public function openorder()
    {
        $url    = self::HOST . '/api/v2/order/openorders';
        $data   = [
            "symbol" => "eth_btc",
            "size"   => "50",
        ];
        $result = $this->curl($url, $data);
        return $result;
    }

    /**
     * Method  orders
     * @desc    历史成交订单列表
     *
     * @return  void
     */
    public function orders()
    {
        $url  = self::HOST . '/api/v2/order/orders';
        $data = [
            "symbol" => "eth_btc",
            "size"   => "50",
        ];

        $result = $this->curl($url, $data);
        return $result;
    }

    /**
     * Method  symbols
     * @desc    支持的交易对
     *
     * @return  void
     */
    public function symbols()
    {
        $url    = self::HOST . '/api/v2/market/symbols';
        $data   = [

        ];
        $result = $this->curl($url, $data);
        return $result;
    }

    /**
     * Method  curl
     * @desc    请求
     *
     * @param $url
     * @param $data
     *
     * @return  bool|mixed
     */
    private function curl($url, $data)
    {
        $data['timestamp']  = time();
        $data['access_key'] = self::PUBLIC_KEY;
        ksort($data);
        $data['signature'] = hash_hmac('sha256', http_build_query($data, '', '&'), md5(self::PRIVATE_KEY));

        $result = self::httpPost($url, $data);

        if (empty($result) || 200 != self::getHttpCode()) {
            var_dump(self::getHttpInfo());
            return false;
        }

        $return = json_decode($result, true);
        if (empty($result) || JSON_ERROR_NONE !== json_last_error()) {
            var_dump('json_decode error', $result);
            return false;
        }
        return $return;
    }

    /**
     * Method  httpGet
     * @desc    get 请求
     * @static
     *
     * @param      $url
     * @param null $data
     * @param null $header
     *
     * @return  mixed
     */
    public static function httpGet($url, $data = null, $header = null)
    {
        return self::sendHttpRequest('GET', $url, $data, $header);
    }

    /**
     * Method  httpPost
     * @desc    post请求
     * @static
     *
     * @param      $url
     * @param null $data
     * @param null $header
     *
     * @return  mixed
     */
    public static function httpPost($url, $data = null, $header = null)
    {
        return self::sendHttpRequest('POST', $url, $data, $header);
    }

    /**
     * Method  sendHttpRequest
     * @desc    构造http请求
     * @static
     *
     * @param       $method
     * @param       $url
     * @param null  $data
     * @param array $header
     *
     * @return  mixed
     */
    private static function sendHttpRequest($method, $url, $data = null, $header = array())
    {
        $curl = curl_init();

        curl_setopt($curl, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
        curl_setopt($curl, CURLOPT_USERAGENT, self::$userAgent);
        curl_setopt($curl, CURLOPT_CONNECTTIMEOUT, self::$connecTimeout);
        curl_setopt($curl, CURLOPT_TIMEOUT, self::$timeout);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_ENCODING, '');
        curl_setopt($curl, CURLOPT_HEADER, false);
        //curl_setopt($curl, CURLOPT_HEADER, true);    //表示需要response header
        //curl_setopt($curl, CURLOPT_NOBODY, FALSE); //表示需要response body

        $method = strtoupper($method);
        if ('GET' === $method) {
            if ($data !== null) {
                if (strpos($url, '?')) {
                    $url .= '&';
                } else {
                    $url .= '?';
                }
                $url .= http_build_query($data);
            }
        } elseif ('POST' === $method) {
            curl_setopt($curl, CURLOPT_POST, true);
            if (!empty($data)) {
                if (is_string($data)) {
                    curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
                } else {
                    curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query($data));
                }
            }
        }

        $isSsl = substr($url, 0, 8) == "https://" ? true : false;
        if ($isSsl) {
            curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false); // 信任任何证书
            curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 2); // 检查证书中是否设置域名
        }

        if (null !== $header) {
            curl_setopt($curl, CURLOPT_HTTPHEADER, $header);
        }

        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLINFO_HEADER_OUT, true);

        $response          = curl_exec($curl);
        self::$httpCode    = curl_getinfo($curl, CURLINFO_HTTP_CODE);
        self::$httpInfo    = curl_getinfo($curl);
        self::$errorCode   = curl_errno($curl);
        self::$errorInfo   = curl_error($curl);
        self::$requestUrl  = $url;
        self::$requestData = $data;
        curl_close($curl);

        return $response;
    }

    public static function getHttpCode()
    {
        return self::$httpCode;
    }

    public static function getHttpInfo()
    {
        return self::$httpInfo;
    }
}
