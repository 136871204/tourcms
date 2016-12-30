##这是一个类似携程网站的一个旅游项目


显示画面

内容管理前台画面：http://tour.metaphasedemo.com/

管理画面登入：http://tour.metaphasedemo.com/index.php?a=Admin&c=Login&m=login

(旅游网站超级管理员，建议使用这个账号操作)

管理画面ID:super

管理画面PW：super

(cms超级管理员)

管理画面ID:test

管理画面PW：test



##项目安装

1.自己创建数据库（使用utf8_general_ci）

2.导入tourcms.sql

3.修改程序数据库连接配置文件（\data\config\db.inc.php）里面内容应该看的懂

4.如果打开页面看不到，在index.php文件增加（开启debug模式）define('DEBUG',true);画面正常显示了在删除这行

5.自己开始尝试使用吧

