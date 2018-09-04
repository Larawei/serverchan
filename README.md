<h1 align="center"> 🍬ServerChan </h1>

<p align="center"> Server酱的PHP扩展包.</p>
<p align="center"> 「Server酱」，英文名「ServerChan」，是一款「程序员」和「服务器」之间的通信软件。

 说人话？就是从服务器推报警和日志到手机的工具。 
 
 ---摘自Server酱官网介绍</p>


## 配置

前往 [Server酱](http://sc.ftqq.com/3.version) 申请 `sckey`

## 安装

```shell
$ composer require larawei/serverchan -vvv
```

## 使用

```php
use Larawei\Serverchan\ServerChan;

$key = 'xxxxxxxxxxxxxxxxxxxxxxxxx';

$serverChan = new ServerChan($key);
```

###  发送信息

```php
$response = $serverChan->send('系统出Bug啦~', '(╯‵□′)╯︵┻━┻');
```
示例：

```Array
Array
(
    [errno] => 0
    [errmsg] => success
    [dataset] => done
)
```

### 在 Laravel 中使用

在 Laravel 中使用也是同样的安装方式，配置写在 `config/services.php` 中：

```php
    .
    .
    .
    'serverChan' => [
        'key' => env('SERVER_CHAN_KEY'),
    ],
```

然后在 `.env` 中配置 `SERVER_CHAN_KEY` ：

```env
SERVER_CHAN_KEY=xxxxxxxxxxxxxxxxxxxxx
```

可以用两种方式来获取 `Larawei\Serverchan\ServerChan` 实例：

#### 方法参数注入

```php
    .
    .
    .
    public function notify(ServerChan $serverChan) 
    {
        $response = $serverChan->send('系统出Bug啦~', '(╯‵□′)╯︵┻━┻');
    }
    .
    .
    .
```

#### 服务名访问

```php
    .
    .
    .
    public function notify() 
    {
        $response = app('serverChan')->send('系统出Bug啦~', '(╯‵□′)╯︵┻━┻');
    }
    .
    .
    .

```

#### 通知Laravel系统异常

在`app/Exceptions/Handler.php`的`report`添加

```php
$title = '['.config('app.name').'('.config('app.env').')]时间:' . Carbon::now()->toDateTimeString() . '信息:' .$exception->getMessage(). 'url: '.request()->fullUrl();
        $content = sprintf("```
        %s
        ```", $exception->getTraceAsString());
        app('serverChan')->send($title, $content);
```

## License

MIT