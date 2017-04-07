## About Spblog

spblog 是一个简单的前后端分离项目

后端基于 Laravel 5.4 & Vue.js 

前端基于 vue.js 

后台 UI 使用 [Element-ui](https://github.com/ElemeFE/element) 

## Features

- 用户管理
- 文章管理
- 评论管理
- 分享管理
- Markdown 编辑
- more ...

## Todo

- 用户管理
- ~~文章管理~~
- 评论管理
- ~~分享管理~~
- ~~Markdown 编辑~~


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
本项目得益于以下项目,特别感谢 Laravel-China ！

- [jwalton512/admin(v2).js](https://gist.github.com/jwalton512/9f1af52981dcbd236274)
- [LaravelChina](https://laravel-china.org/)
- [Laravist](https://www.laravist.com/)
- [bailicangdu/vue2-elm](https://github.com/bailicangdu/vue2-elm)

***
