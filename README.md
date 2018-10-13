# Interview-2017
[TOC]
## 文档列表

- [面试系统开发文档（待完成）](README.md)
- [面试系统使用说明](HowToUse.md)
- 录取系统开发文档
- [录取系统使用说明](paris-v2.0/Usage.md)

## 文件结构

config.php - 配置文件

### 面试系统

- register

  - register.php & regcheck.php

    注册界面，仅管理员可用

  - login.php & logincheck.php

    登录

- index.php

- info.exe

  个人信息

- exe.php

  所有按钮的执行

- auto_refreshing.php -> [waiting.php]

  候场教室大屏

### 录取系统(paris-v2.0/)

- [Functions.php - 生成页面的方法集合](paris-v2.0/Function.php)
- "index"=>"网协面试录取系统", "wait"=>"可选列表", "pick"=>"捡漏队列", "already"=>"已录取名单"

### 测试(test/)

- [用Python临时写了一些简单(lou)的方法](test/test.py)

### 数据库(sql/)

- [初始化sql](sql/init.sql)

## 功能介绍（待完成）

- 状态码
  - 0 未到场
    - 签到（权限：候场教室，管理员）
  - 1 已签到
    - 安排（权限：各面试教室，管理员）
  - 2 准备出发
    - 开始面试（权限：候场教室，管理员）
  - 3 面试中
    - 收到任何一条评论（权限：各面试教室，管理员）
  - 4 面试结束

- 状态码(After interview)
  - 3+k 等待第k志愿录取(k = 1, 2, 3)
  - 7 落选
  - 8 ~ 12 分别为网络部、技术部、电脑诊所、数字媒体、组织部录取

## 数据库结构（未完成） 

## 待修复

- ~~alert之后不应该返回上一个页面，而是跳转，否则需要刷新才能看到更新（紧急）~~
- 表单验证
  - 非法字符
  - ~~评论页面表单填写的完整性~~
- 主页通过判断用户类型显示不同的按钮
- 未登录直接跳转

------

P.S. 这学年一定要出新版面试系统，代码丑陋到看不下去啦！(Defjia's Flag on 24th Sept, 2018)

