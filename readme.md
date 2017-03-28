## About Spblog

spblog 是一个简单的前后端分离项目

后端基于 Laravel 5.4 & Vue.js 

前端基于 vue.js

博主目前在找工作，偶尔有时间会继续开发...
请见谅, dev 分支提供最新代码

本项目后台 UI 使用 [Element-ui](https://github.com/ElemeFE/element) + VueRouter + Vuex ，做这个博客的原因是因为我的 UI 基友需要一个博客,让我帮他搞一个，于是就有了spblog ，哈哈～ 

嗯嗯，为了这个我让他专门去学习了 Markdown ，目前这货还没学会(真笨)

有兴趣的同学可以去 [Smalltiger](http://smalltiger.me/) & 测试地址 [Smalltiger-test](http://spblog.minist.cn/) :( 当然，目前是个半成品 因为我还在开发 (手动发出笑声)


## Features

- 用户管理
- 文章管理
- 评论管理
- 标签、标签组管理
- Markdown 编辑
- more ...

## Todo

- 用户管理
- ~~文章管理~~
- 评论管理
- 标签、标签组管理
- ~~Markdown 编辑器~~
- Swoole 加速支持
- 可选的缓存支持


## Install

### 1. Clone 项目到本地

```shell
git clone https://github.com/loktarjugg/spblog.git
```


### 2. 复制 .env 到你的项目中

```shell
cp .env.example .env
```


### 2. 安装依赖包

执行

```shell
composer install
```

安装 npm 包

```shel
npm install
```

### 3. 初始化应用程序
```shell
php artisan migrate:refresh --db:seed
```

## 感谢以下项目 & 社区：
本项目得益于以下项目,特别感谢 Laravel-China 这个社区！

- [jwalton512/admin(v2).js](https://gist.github.com/jwalton512/9f1af52981dcbd236274)
- [LaravelChina](https://laravel-china.org/)
- [Laravist](https://www.laravist.com/)
- [bailicangdu/vue2-elm](https://github.com/bailicangdu/vue2-elm)

***

最后的最后，我要吐槽一下上海的长城宽带，github 你都封是几个意思！!!
 
 在家开 VPN 都不能 push 是一个什么样的体验?