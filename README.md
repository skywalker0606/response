# 项目概述

 - 基于Hyperf2.0中的Response扩展

# 运行环境

确保操作环境满足以下要求:  

 - PHP >= 7.2
 - Swoole PHP extension >= 4.4，and Disabled `Short Name`
 - OpenSSL PHP extension
 - JSON PHP extension
 - PDO PHP extension （If you need to use MySQL Client）
 - Redis PHP extension （If you need to use Redis Client）
 - Protobuf PHP extension （If you need to use gRPC Server of Client）

# 安装

- composer.json中增加镜像配置

```json
"repositories": [
    {
      "type": "git",
      "url": "git@gitlab.heartide.com:composer/response.git",
    }
  ],
```
- 引入组件

```bash
$ compsoer require "heartide/response"
```

# 使用

- 文件

```bash
app/Controller/AbstractController.php
```

- 删除
```php
use Hyperf\HttpServer\Contract\ResponseInterface;
```

# 注入
```php
use Heartide\Response\Response;
use Psr\Container\ContainerInterface;

    /**
     * @Inject
     * @var Response
     */
    protected $response;
```

- 在任意类中extends AbstractController
```php
   class IndexController extends AbstractController
   {
       public function index()
       {
           $data = [
                'order_id' => 1234 
            ];
           return $this->response->success($data);
       }
   }
```
- 效果
```json
{
  "code": 0,
  "data": {
    "order_id": 1234
  }
}
```

