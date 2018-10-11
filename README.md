# CoolCoin  API

---
[TOC]


- Host: https://www.coolcoin.me/api/v2/

sign签名算法：

PHP示例:

```php
//sha256运算
$data = [
    "symbol"     => "eth_btc",
    "type"       => "buy",
    "amount"     => "1000",
    "price"      => "0.123",
    "access_key" => "zm3n3-srhfu-x4fqq-r37i7-kgm7s-pcvqb-pqxrc",
    "timestamp"  => time(),
];

ksort($data);
$dataStr = http_build_query($data);
//转码后的结果 symbol=ethbtc&type=buy&amount=1000&price=0.123&access_key=zm3n3-srhfu-x4fqq-r37i7-kgm7s-pcvqb-pqxrc&timestamp=137123123
$sign = hash_hmac('sha256', $dataStr, md5($data["access_key"]));

```

​		

## 功能模块



### 1. 市场行情-全部symbol的交易行情

- 请求url：   /market/tickers

- 请求方式：GET

**参数说明：**

    无

 

**返回结果(JSON)：**

```json
{
    "code": 0, 
    "msg": "", 
    "timestamp": 1535340628, 
    "data": [
        {
            "open": "0.044297", 
            "close": 0.042178, 
            "low": 0.04011, 
            "high": 0.045255, 
            "amount": 12880.851, 
            "count": 12838, 
            "vol": 563.038871574, 
            "symbol": "eth_btc"
        }, 
        {
            "open": 0.008545, 
            "close": 0.008656, 
            "low": 0.008088, 
            "high": 0.009388, 
            "amount": 88056.186, 
            "count": 16077, 
            "vol": 771.7975953754, 
            "symbol": "ltc_btc"
        }
    ]
}
```



### 2. 市场行情-单个symbol行情(Ticker)

- 请求url：   /market/ticker

- 请求方式：GET 

**参数说明：**

    参数         类型          必填      备注(说明)
    symbol      string        是        btc_usdt



**返回结果(JSON)：**

```    json
{
    "code": 0, 
    "msg": "", 
    "timestamp": 1535340628, 
    "data": {
        "timestamp": 1535340628, 
        "close": 1885, 
        "open": 1960, 
        "high": 1985, 
        "low": 1856, 
        "amount": 81486.2926, 
        "count": 42122, 
        "vol": 157052744.857082
    }
}
```



### 3. 市场行情-深度

- 请求url：   /market/depth

- 请求方式：GET 

**参数说明：**

     参数         类型         必填     备注(说明)
    symbol      string        是       btc_usdt



**返回结果(JSON)：**

```json
{
	"code": 0,
	"msg": "",
	"timestamp": 1535340628,
	"data": {
		"bids": [
			[7964, 0.0678],
			[7963, 0.9162],
			[7961, 0.1],
			[7960, 12.8898],
			[7958, 1.2],
			[7955, 2.1009],
			[7954, 0.4708],
			[7953, 0.0564],
			[7951, 2.8031],
			[7950, 13.7785],
			[7949, 0.125],
			[7948, 4],
			[7942, 0.4337],
			[7940, 6.1612],
			[7936, 0.02],
			[7935, 1.3575],
			[7933, 2.002],
			[7932, 1.3449],
			[7930, 10.2974],
			[7929, 3.2226]
		],
		"asks": [
			[7979, 0.0736],
			[7980, 1.0292],
			[7981, 5.5652],
			[7986, 0.2416],
			[7990, 1.9970],
			[7995, 0.88],
			[7996, 0.0212],
			[8000, 9.2609],
			[8002, 0.02],
			[8008, 1],
			[8010, 0.8735],
			[8011, 2.36],
			[8012, 0.02],
			[8014, 0.1067],
			[8015, 12.9118],
			[8016, 2.5206],
			[8017, 0.0166],
			[8018, 1.3218],
			[8019, 0.01],
			[8020, 13.6584]
		]
	}
}
```



### 4. 市场行情-批量获取最近的交易记录

- 请求url：   /market/historyTrade

- 请求方式：GET

**参数说明：**

     参数         类型         必填     备注(说明)
    symbol      string        是       btc_usdt
    size        integer       是       默认10，range:[1,500]



**返回结果(JSON)：**

```json
{
    "code": 0, 
    "timestamp": 1537498737, 
    "msg": "success", 
    "data": [
        {
            "id": "14", 
            "direction": "buy", 
            "price": "0.0950100000", 
            "amount": "1.00000000", 
            "created": "1530240970"
        }, 
        {
            "id": "13", 
            "direction": "sell", 
            "price": "0.0865500000", 
            "amount": "1.00000000", 
            "created": "1530240970"
        }, 
        {
            "id": "12", 
            "direction": "buy", 
            "price": "0.0950100000", 
            "amount": "1.00000000", 
            "created": "1530240970"
        }
    ]
}
```

 

### 5. 市场行情-支持的所有交易

- 请求url：   /market/symbols

- 请求方式：GET 

**参数说明：**

    无

  

**返回结果(JSON)：**

```json
{
    "code": 0, 
    "msg": "", 
    "timestamp": 1535340628, 
    "data": [
        {
            "base_coin": "btc", 
            "quote_coin": "usdt", 
            "symbol": "btc_usdt"
        }, 
        {
            "base_coin": "eth", 
            "quote_coin": "usdt", 
            "symbol": "etc_usdt"
        }
    ]
}
```

 

### 6. 账户信息-指定账户的余额

 - 请求url：   /account/balance
  
 - 请求方式：POST 

**参数说明：**

     参数          类型         必填     备注(说明)
    access_key    string        是      公钥
    signature     string        是      签名
    timestamp     string        是      时间戳



**返回结果(JSON)：**

```json
{
    "code": 0, 
    "timestamp": 1537256452, 
    "msg": "success", 
    "data": {
        "user_id": "1", 
        "state": "working", 
        "list": [
            {
                "currency": "btc", 
                "type": "trade", 
                "balance": "93939.9940000000"
            }, 
            {
                "currency": "btc", 
                "type": "frozen", 
                "balance": "6060.0010000000"
            }, 
            {
                "currency": "eth", 
                "type": "trade", 
                "balance": "1009.7888028299"
            }, 
            {
                "currency": "eth", 
                "type": "frozen", 
                "balance": "0.0000000000"
            }, 
            {
                "currency": "bch", 
                "type": "trade", 
                "balance": "0.0000000000"
            }, 
            {
                "currency": "bch", 
                "type": "frozen", 
                "balance": "0.0000000000"
            }, 
            {
                "currency": "ltc", 
                "type": "trade", 
                "balance": "10086.0000000000"
            }, 
            {
                "currency": "ltc", 
                "type": "frozen", 
                "balance": "0.0000000000"
            }, 
            {
                "currency": "etc", 
                "type": "trade", 
                "balance": "0.0000000000"
            }, 
            {
                "currency": "cad", 
                "type": "frozen", 
                "balance": "0.0000000000"
            }, 
            {
                "currency": "aac", 
                "type": "trade", 
                "balance": "99199.9800000000"
            }, 
            {
                "currency": "aac", 
                "type": "frozen", 
                "balance": "900.0000000000"
            }, 
            {
                "currency": "sn", 
                "type": "trade", 
                "balance": "99029.0930000000"
            }, 
            {
                "currency": "sn", 
                "type": "frozen", 
                "balance": "973.0000000000"
            }, 
            {
                "currency": "usdt", 
                "type": "trade", 
                "balance": "100000.0000000000"
            }, 
            {
                "currency": "usdt", 
                "type": "frozen", 
                "balance": "0.0000000000"
            }
        ]
    }
}
```



### 7. 交易-下单

 - 请求url：   /order/place
 - 请求方式：POST

**参数说明：**

    参数            类型         必填     备注(说明)
    access_key    string        是      	公钥
    signature     string        是      	签名
    timestamp     string        是      	时间戳
    amount        string        是      	下单数量
    price         string        是      	下单价格
    symbol        string        是      	交易对(eth_usdt)
    direction     string        是      	交易方向(buy|sell)



**返回结果(JSON):**

```json
{
    "code": 0, 
    "msg": "", 
    "timestamp": 1535340628, 
    "data": {
        "id": "59378"  //订单id
    }
}
```

   

### 8. 交易-撤销订单

- 请求url：   /order/cancel

- 请求方式：POST 

**参数说明：**

      参数            类型         必填     备注(说明)
      access_key    string        是      公钥
      signature     string        是      签名
      timestamp     string        是      时间戳
      order_id      string        是      订单id
      symbol        string        是      交易对(eth_usdt)



**返回结果(JSON)：**

```json
{
    "code": 0, 
    "msg": "", 
    "timestamp": 1535340628, 
    "data": {
        "id": "59378"  //订单id
    }
}   
```



### 9. 交易-批量撤销订单

- 请求url：  /order/batchcancel

- 请求方式：POST
  
**参数说明：**

    参数            类型         必填     备注(说明)
    access_key    string        是      公钥
    signature     string        是      签名
    timestamp     string        是      时间戳
    order_ids     string        是      订单id(1,2,3,4,5)以逗号隔开
    symbol        string        是      交易对(eth_usdt)

​ 
**返回结果(JSON)：**

```json
{
    "code": 0, 
    "msg": "", 
    "timestamp": 1535340628, 
    "data": {
        "success": [
            "1", 
            "3"
        ], 
        "failed": [
            {
                "msg": "记录无效", 
                "order_id": "2", 
                "code": 1001
            }
        ]
    }
}
```



### 10. 交易-查询某个订单详情

 - 请求url：   /order/detail
  
 - 请求方式：POST 

**参数说明：**

    参数            类型        必填     备注(说明)
    access_key    string        是      公钥
    signature     string        是      签名
    timestamp     string        是      时间戳
    order_id      string        是      订单id
    symbol        string        是      交易对(eth_usdt)



**返回结果(JSON)：**

``` json
{
    "code": 0, 
    "timestamp": 1537256356, 
    "msg": "success", 
    "data": {
        "id": "50", 
        "created": "1536915588", 
        "direction": "buy", 
        "price": "10.1000000000", 
        "amount_original": "100.00000000", 
        "amount_outstanding": "100.00000000", 
        "status": "1"
    }
}
```



### 11. 交易-查询用户当前未成交订单

- 请求url：   /order/openOrders

- 请求方式：POST 
  
**参数说明：**

    参数            类型        必填     备注(说明)
    access_key    string        是      公钥
    signature     string        是      签名
    timestamp     string        是      时间戳
    size          integer       是      长度[1,500]
    symbol        string        是      交易对(eth_usdt)

   

**返回结果(JSON)：**

```json
{
    "code": 0, 
    "timestamp": 1537256293, 
    "msg": "success", 
    "data": [
        {
            "id": "55", 
            "direction": "buy", 
            "symbol": "eth_btc", 
            "price": "10.0000000000", 
            "amount_original": "0.00010000", 
            "amount_outstanding": "0.00010000", 
            "address_tag": "1", 
            "created": "1537171692"
        }, 
        {
            "id": "54", 
            "direction": "buy", 
            "symbol": "eth_btc", 
            "price": "10.1000000000", 
            "amount_original": "100.00000000", 
            "amount_outstanding": "100.00000000", 
            "address_tag": "1", 
            "created": "1537171473"
        }
    ]
}
```



### 12. 交易-查询用户历史成交

- 请求url：   /order/orders

- 请求方式：POST 
  
**参数说明：**

    参数            类型        必填     备注(说明)
    access_key    string        是      公钥
    signature     string        是      签名
    timestamp     string        是      时间戳
    size          integer       是      长度[1,500]
    symbol        string        是      交易对(eth_usdt)



**返回结果(JSON)：**

```json
{
    "code": 0, 
    "timestamp": 1537256200, 
    "msg": "success", 
    "data": [
        {
            "id": "14", 
            "direction": "sell", 
            "price": "0.0950100000", 
            "amount": "1.00000000", 
            "fee": "0.0000950100", 
            "symbol": "eth_btc", 
            "created": "1530240970"
        }, 
        {
            "id": "13", 
            "direction": "buy", 
            "price": "0.0865500000", 
            "amount": "1.00000000", 
            "fee": "0.0010000000", 
            "symbol": "eth_btc", 
            "created": "1530240970"
        }
    ]
}
```



### 13. 账户-充提记录


 - 请求url：  /account/depositWithdraw

 - 请求方式：POST 

**参数说明：**

    参数           类型         必填     备注(说明)
    access_key    string        是      公钥
    signature     string        是      签名
    timestamp     string        是      时间戳
    currency	  string        是      币种
    type	      string        是      'in'|'out'
    from	      string        是      查询起始 ID
    size	      string        是      查询记录大小

  


**返回结果(JSON)：**



```json
{
    "code": 0, 
    "timestamp": 1537256163, 
    "msg": "success", 
    "data": [
        {
            "id": "1", 
            "type": "in", 
            "currency": "eth", 
            "tx_hash": "d4e53aae9c3a33fa91a104d8e39926ad", 
            "amount": "6.60000000", 
            "address": "0x1f60082aa47a166e1095be84f75c59f8061b9189", 
            "address_tag": "1", 
            "state": "6", 
            "created": "1512557825", 
            "updated": "0"
        }
    ]
}
```



## 错误码

| 错误码 | 错误描述             |
| :----- | -------------------- |
| 0      | 成功                 |
| 1000   | 缺少必填参数         |
| 1001   | 公钥格式错误         |
| 1002   | 公钥不存在           |
| 1003   | 签名错误             |
| 1004   | 没有该接口权限       |
| 1005   | timestamp参数错误    |
| 1006   | 重复提交             |
| 1007   | 币种不存在           |
| 1008   | symbol参数格式错误   |
| 2001   | 交易方向错误         |
| 2002   | 价格错误             |
| 2003   | 数量错误             |
| 2004   | 未开放交易           |
| 2005   | 交易价格范围区间错误 |
| 2006   | 指定时间开放买入     |
| 2007   | 指定时间开放卖出     |
| 2008   | 交易失败             |
| 2009   | 取消交易失败         |
| 2010   | 交易信息不存在       |
| 2011   | 超过系统最大限额     |
| 2012   | 小于最小交易金额     |
| 3001   | 类型只能为in或out    |
| 3002   | 用户不存在           |
|        |                      |
|        |                      |
|        |                      |
|        |                      |
|        |                      |



