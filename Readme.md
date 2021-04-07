## CCTools工具类使用说明

### RSA工具类
```angular2html
//sha256 2048位算法

RsaUtil::PubKeyEncrypt(); //公钥加密
RsaUtil::PriKeyDecrypt(); //私钥解密

RsaUtil::PriKeyEncrypt(); //私钥加密
RsaUtil::PubKeyDecrypt(); //公钥解密
```

### 统一Response返回格式
```angular2html
ResponseLayout::apply(boolean,data,message);
```

### Eloquent ORM插件
```angular2html
use Datetime;  //替换Laravel7以上默认数据库时间为北京时间格式
use UUIDTrait; //使用UUID当作主键
use SnowFlakeId //使用雪花算法唯一ID当作主键
```

### ValidatorTools 验证器工具

- 多场景验证器类，参考ThinkPHP验证器

### StrUtil 工具类
```angular2html
StrUtil::RandStr($length)  //指定长度随机字符串，用于文件名，随机token等
```