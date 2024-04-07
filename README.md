# JuziClub Application Web

本存储库属于个人使用的小型网站申请加入公会的PHP网站

## 技术栈

- 前端：HTML, CSS, JavaScript
- 后端：PHP, MySQL


## 代码注意事项

- **数据库连接**：请注意，本项目中的数据库连接信息不是统一存储在`db.php`文件中。需要根据每个PHP文件中的具体指示进行数据库连接的配置。
- **人机验证**：本网站在表单提交处采用了H-CAPTCHA进行人机验证。你需要到[H-CAPTCHA官网](https://www.hcaptcha.com/)申请相应的密钥，并根据项目需求进行配置。
- **Hypixel验证**：本项目使用了Hypixel等级以及公会验证功能，需要你到[Hypixel官方网站](https://WWW.hypixel.net/)申请API密钥。

## 如何获取密钥

为了顺利使用本项目，你需要获取H-CAPTCHA和Hypixel的API密钥。请按照以下步骤操作：

1. 访问[H-CAPTCHA官网](https://www.hcaptcha.com/)，注册并创建一个新项目以获取你的密钥。
2. 访问[Hypixel官方网站](https://developer.hypixel.net/)，根据网站提供的指南申请API密钥。

确保将这些密钥安全地存储，并在配置项目时按照指导文档正确填写。

## 补充提交

本存储库本身属于随便写的php项目，无论是功能添加、bug修复还是文档更新。请fork项目后，提交Pull Requests进行提交。
