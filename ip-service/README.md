# IP Location Service

基于 ip2region 的 IP 地理位置查询服务，提供快速、准确的 IP 地址归属地查询。

## 功能特点

- 快速的 IP 地理位置查询
- 支持 API 密钥验证
- 支持 CORS 跨域访问
- IP 数据库自动更新
- 优雅的错误处理
- JSON 格式响应

## 系统要求

- PHP >= 7.2
- Composer
- 支持 file_get_contents 函数
- 足够的文件系统权限

## 安装

1. 克隆项目
```bash
git clone https://github.com/yourusername/ip-service.git
cd ip-service
```

2. 安装依赖
composer install
3. 配置项目
cp config/config.php.example config/config.php
- - 修改配置文件中的 API key 和允许的域名
- 
4. 创建必要的目录并下载数据文件
mkdir -p data
cd data
wget https://raw.githubusercontent.com/lionsoul2014/ip2region/master/data/ip2region.xdb

## 配置说明
### API 密钥
在 config/config.php 中配置：
'allowed_origins' => [
    'https://*.example.com',
    'http://*.example.com'
]
## Trae AI
使用了 2 个参考

我来帮你完善 README.md 文件：

```markdown
# IP Location Service

基于 ip2region 的 IP 地理位置查询服务，提供快速、准确的 IP 地址归属地查询。

## 功能特点

- 快速的 IP 地理位置查询
- 支持 API 密钥验证
- 支持 CORS 跨域访问
- IP 数据库自动更新
- 优雅的错误处理
- JSON 格式响应

## 系统要求

- PHP >= 7.2
- Composer
- 支持 file_get_contents 函数
- 足够的文件系统权限

## 安装

1. 克隆项目
```bash
git clone https://github.com/yourusername/ip-service.git
cd ip-service
 ```
```

2. 安装依赖
```bash
composer install
 ```

3. 配置项目
   
   - 复制配置文件模板
   ```bash
   cp config/config.php.example config/config.php
    ```
   ```
   
   - 修改配置文件中的 API key 和允许的域名
4. 创建必要的目录并下载数据文件
```bash
mkdir -p data
cd data
wget https://raw.githubusercontent.com/lionsoul2014/ip2region/master/data/ip2region.xdb
 ```
```

## 配置说明
### API 密钥
在 config/config.php 中配置：

```php
'api_key' => 'your_secret_api_key_here'
 ```

### 跨域访问
在 config/config.php 中配置允许访问的域名：

```php
'allowed_origins' => [
    'https://*.example.com',
    'http://*.example.com'
]
 ```

## API 使用说明
### 接口地址
```plaintext
https://your-domain.com/
 ```

### 请求参数
- Method: GET
- Header: X-API-KEY: your_api_key
- Query: ip=8.8.8.8
### 请求示例
```bash
# 使用 curl
curl -H "X-API-KEY: your_api_key" "https://your-domain.com/?ip=8.8.8.8"
 ```
```

```javascript
// 使用 JavaScript
fetch('https://your-domain.com/?ip=8.8.8.8', {
    headers: {
        'X-API-KEY': 'your_api_key'
    }
})
.then(response => response.json())
.then(data => console.log(data));
 ```
```

```php
// 使用 PHP
$opts = [
    'http' => [
        'header' => 'X-API-KEY: your_api_key'
    ]
];
$context = stream_context_create($opts);
$result = file_get_contents("https://your-domain.com/?ip=8.8.8.8", false, $context);
 ```
```

### 响应格式
成功响应：

```json
{
    "code": 0,
    "msg": "success",
    "data": {
        "ip": "8.8.8.8",
        "region": "美国|0|0|0|谷歌"
    }
}
 ```

错误响应：

```json
{
    "code": 401,
    "msg": "Invalid API key",
    "data": null
}
 ```

## 错误代码说明
- 200: 成功
- 400: 参数错误
- 401: API key 无效
- 500: 服务器内部错误
## 部署说明
1. 配置 Nginx：
```nginx
server {
    listen 80;
    server_name your-domain.com;
    root /path/to/ip-service/public;

    location / {
        try_files $uri $uri/ /index.php?$query_string;
    }

    location ~ \.php$ {
        fastcgi_pass unix:/tmp/php-cgi-74.sock;
        fastcgi_index index.php;
        include fastcgi.conf;
    }
}
 ```
```

2. 设置文件权限：
```bash
chown -R www:www /path/to/ip-service
chmod -R 755 /path/to/ip-service
chmod 644 /path/to/ip-service/data/ip2region.xdb
 ```
```

## 许可证
MIT License

## 鸣谢
- ip2region
