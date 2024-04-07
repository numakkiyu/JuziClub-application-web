<!--
-----------
Copyright © 2024 北海的佰川 UI © 2023-2024 Juzi

版权和系统制作著作权为 北海的佰川、JCLY TEAM 所有、非法盗用将会受到法律追究！

本UI界面部分采用Materialize第三方引用库，但其他布局后台系统均为 北海的佰川 制作

网站页面最终版权所有者（组织）为 JCLY TEAM 所有
-----------
-->

<!DOCTYPE html>
<html lang="zh-CN">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>欢迎加入JuziClub</title>
    <link href="./favicon.ico" rel="icon">
	<link href="./favicon.ico" rel="apple-touch-icon">
    <!-- 引入Materialize CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.staticfile.org/font-awesome/4.7.0/css/font-awesome.css">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="./banner/style.css">
    <script src="https://unpkg.com/i18next@19.0.0/i18next.min.js"></script>
    <script src="https://js.hcaptcha.com/1/api.js" async defer></script>
    <!-- 自定义样式 -->
    <style>
        body { font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; background-color: #eef2f5; color: #333; margin: 0; padding: 0; } main { padding-top: 20px; padding-bottom: 20px; } .application-form, .status-check { padding: 20px; margin-bottom: 20px; background-color: #fff; border-radius: 8px; box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1); } footer.page-footer { border-radius: 8px; position: fixed; bottom: 0; width: 100%; background-color: #ddd; padding: 10px 0; text-align: center; } .brand-logo { margin-left: 60px; } .sidenav-trigger { display: none; } @media only screen and (max-width: 992px) { .brand-logo { margin-left: 0; } .sidenav-trigger { display: block; } } .notification { position: fixed; top: 20px; right: 20px; background-color: #4CAF50; color: white; padding: 15px; border-radius: 5px; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1); z-index: 1000; animation: slideInRight 0.5s ease forwards, fadeOut 0.5s 4.5s ease forwards; } @keyframes slideInRight { from { transform: translateX(100%); } to { transform: translateX(0); } } @keyframes fadeOut { from { opacity: 1; } to { opacity: 0; } } @media only screen and (max-width: 600px) { .notification { right: 10px; max-width: 300px; } } .error-notification { position: fixed; top: 20px; right: 20px; background-color: #FF5733; color: white; padding: 15px; border-radius: 5px; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1); z-index: 1000; animation: slideInRight 0.5s ease forwards, fadeOut 0.5s 4.5s ease forwards; } @keyframes slideInRight { from { transform: translateX(100%); } to { transform: translateX(0); } } @keyframes fadeOut { from { opacity: 1; } to { opacity: 0; } } #message { display: none; } @media only screen and (max-width: 600px) { .error-notification { right: 10px; max-width: 300px; } }
    </style>
    <style>
        .modal{display:none;position:fixed;z-index:2;left:0;top:0;width:100%;height:100%;overflow:auto;background-color:#000;background-color:rgba(0,0,0,0.4);padding-top:60px}.modal-content{background-color:#fefefe;margin:5% auto;padding:20px;border:1px solid #888;width:80%;box-shadow:10px 10px 10px rgba(0,0,0,0.2);border-radius:10px}.neumorphism{background:#e0e0e0;border-radius:10px;box-shadow:20px 20px 60px #bebebe,-20px -20px 60px #fff}
    </style>
</head>

<body>
    <nav>
        <div class="nav-wrapper blue">
            <a href="#" class="brand-logo" data-i18n="nav.brand">JuziClub</a>
            <a href="#" data-target="mobile-demo" class="sidenav-trigger"><i class="fa fa-navicon" style="font-size:24px"></i></a>
            <ul class="right hide-on-med-and-down">
                <li><a href="https://juzi.club" target="_blank" data-i18n="nav.home">官网</a></li>
                <li><a href="https://juzi.club/#resume" target="_blank" data-i18n="nav.about">关于我们</a></li>
                <li><a href="https://juzi.club/#services" target="_blank" data-i18n="nav.services">加速IP</a></li>
                <li><a href="https://status.juzily.com" target="_blank" data-i18n="nav.status">JuziClub探针</a></li>
                <li><a class="dropdown-trigger" href="#!" data-target="dropdown1" data-i18n="nav.language">语言选择</a></li>
                <ul id="dropdown1" class="dropdown-content">
                    <li><a href="#!" data-lang="zh_CN">简体中文</a></li>
                    <!--<li><a href="#!" data-lang="zh_TW">繁体中文</a></li>-->
                    <li><a href="#!" data-lang="en">English</a></li>
                    <!--<li><a href="#!" data-lang="ja">日本語</a></li>-->
                </ul>
            </ul>
        </div>
    </nav>
    <ul class="sidenav" id="mobile-demo">
        <li><a href="https://juzi.club" target="_blank" data-i18n="nav.home">官网</a></li>
        <li><a href="https://juzi.club/#resume" target="_blank" data-i18n="nav.about">关于我们</a></li>
        <li><a href="https://juzi.club/#services" target="_blank" data-i18n="nav.services">加速IP</a></li>
        <li><a href="https://status.c8a.cn/status/juzi" target="_blank" data-i18n="nav.status">JuziClub探针</a></li>
        <li><a class="dropdown-trigger" href="#!" data-target="dropdown2" data-i18n="nav.language">语言选择</a></li>
                <ul id="dropdown2" class="dropdown-content">
                    <li><a href="#!" data-lang="zh_CN">简体中文</a></li>
                    <!--<li><a href="#!" data-lang="zh_TW">繁体中文</a></li>-->
                    <li><a href="#!" data-lang="en">English</a></li>
                    <!--<li><a href="#!" data-lang="ja">日本語</a></li>-->
                </ul>
    </ul>
    
    <main>
        <div class="container">
            <div class="row">
                <div class="col s12 m6">
                    <div class="status-check">
                        <h5 class="center-align" data-i18n="main.application.title">JuziClub入会申请</h5>
                        <form id="container">
                            <div class="input-field">
                                <input type="text" id="name" name="name" class="validate" required>
                                <label for="name" data-i18n="main.application.gameId">IGN（游戏ID）</label>
                            </div>
                            <div class="input-field">
                                <input type="email" id="email" name="email" class="validate" required>
                                <label for="email" data-i18n="main.application.email">邮箱</label>
                            </div>
                            <div class="input-field">
                                <textarea id="reason" name="reason" class="materialize-textarea" required></textarea>
                                <label for="reason" data-i18n="main.application.reason">申请理由</label>
                                <span id="reason-count">0/200</span> 
                            </div>
                            <div class="input-field center-align">
                                <!-- 输入 h-captcha 秘钥-->
                                <div class="h-captcha" data-sitekey=" h-captcha key "></div>
                            </div>
                            <div class="center-align">
                                <button type="submit" class="btn waves-effect waves-light blue" data-i18n="main.application.submit">提交申请</button>
                            </div>
                        </form>
                        <p><small data-i18n="main.application.note">只能提交正版账户IGN，API获取用户数据数据时候可能有延迟</small></p>
                    </div>
                </div>
                <div class="col s12 m6">
                    <div class="application-form">
                        <h5 class="center-align" data-i18n="main.status.title">申请状态查询</h5>
                        <form id="searchForm">
                            <div class="input-field">
                                <input type="text" id="searchName" name="searchName" class="validate" required>
                                <label for="searchName" data-i18n="main.status.inputLabel">下方输入你的IGN</label>
                            </div>
                            <div class="center-align">
                                <button type="submit" class="btn waves-effect waves-light blue" data-i18n="main.status.check">查询</button>
                            </div>
                        </form>
                        <div id="result"></div>
                        <p><small data-i18n="main.status.note">1分钟之内只能查询5次</small></p>
                    </div>
                </div>
            </div>
        </div>
    </main>
        <div id="cookieConsentDiv" class="bg-gray-800 p-4 text-white fixed inset-x-0 top-0">
          <div class="max-w-screen-xl mx-auto px-4">
            <div class="flex justify-between items-center">
              <p>我们使用第三方cookie来改善您的体验</p>
              <div class="flex items-center">
                <button class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 mr-2 rounded" onclick="acceptCookies()">同意</button>
                <button class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded" onclick="declineCookies()">拒绝</button>
              </div>
            </div>
          </div>
        </div>
    <!-- 引入Materialize JavaScript -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
    <footer class="page-footer grey lighten-2 black-text">
        <div class="container">Copyright &copy; 2023-2024 <a href="https://jcly.org.cn" class="blue-text"
                target="_blank">JCLY TEAM</a>. All rights reserved
        </div>
    </footer>
    
    <div id="popupModal" class="fixed inset-0 bg-gray-500 bg-opacity-75 hidden justify-center items-center" style="z-index: 1000;">
        <div class="bg-white p-8 rounded-lg w-11/12 md:w-2/3 lg:w-1/2 xl:w-1/3 mx-auto relative flex flex-col items-center">
            <div class="text-xl font-bold mb-4">
                广而告之
            </div>
            <div class="w-full flex-grow mb-4">
                <img src="./ad/ad1.png" alt="Advertisement" class="w-full h-auto">
            </div>
            <div class="text-lg mb-4">
            </div>
            <button onclick="closePopup()" class="absolute top-0 right-0 mt-2 mr-2 text-gray-600 hover:text-gray-900">
                <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>
    </div>
    
    <script>
    function closePopup() {
        document.getElementById('popupModal').classList.add('hidden');
        localStorage.setItem('popupLastClosed', new Date().getTime());
    }
    
    function checkPopup() {
        const popupLastClosed = localStorage.getItem('popupLastClosed');
        if (popupLastClosed) {
            const now = new Date().getTime();
            const fourHours = 4 * 60 * 60 * 1000;
            if (now - popupLastClosed > fourHours) {
                document.getElementById('popupModal').classList.remove('hidden');
            }
        } else {
            document.getElementById('popupModal').classList.remove('hidden');
        }
    }
    
    document.addEventListener('DOMContentLoaded', checkPopup);
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var elemsSidenav = document.querySelectorAll('.sidenav');
            M.Sidenav.init(elemsSidenav);
        
            var elemsModal = document.querySelectorAll('.modal');
            M.Modal.init(elemsModal, {});
            
            document.querySelectorAll('.dropdown-trigger').forEach(function(elemsDropdown) {
                M.Dropdown.init(elemsDropdown, {hover: false});
            });
        });

    </script>
        <script>
          document.addEventListener("DOMContentLoaded", function() {
            const consentGiven = localStorage.getItem("cookieConsentGiven");
            if (consentGiven) {
              document.getElementById("cookieConsentDiv").style.display = "none";
              document.body.style.paddingTop = '0px';
            }
          });
        
          function acceptCookies() {
            localStorage.setItem("cookieConsentGiven", "true");
            document.getElementById("cookieConsentDiv").style.display = "none";
            document.body.style.paddingTop = '0px';
          }
        
          function declineCookies() {
            alert("如果您不使用第三方cookie则无法正常运行该页面");
            window.location.href = "about:blank"; 
          }
        </script>
        <script>
        document.getElementById("container").addEventListener("submit", function (event) {
            event.preventDefault(); 
            
            var captchaResponse = hcaptcha.getResponse();
            if (captchaResponse.length === 0) {
                displayNotification("请完成人机验证！", false);
                return; 
            }

            var formData = new FormData(this);
            var playerName = formData.get("name"); 

             verifyPlayerIGN(playerName, function (isValidIGN) {
                    if (isValidIGN) {
                        checkForDuplicateSubmission(playerName, function (hasDuplicate) {
                            if (!hasDuplicate) {
                                checkPlayerStatus(playerName, function (status) {
                                    if (status.canSubmit) {
                                        submitForm(formData);
                                    } else {
                                        displayNotification(status.message, false);
                                    }
                                });
                            } else {
                                displayNotification("该IGN已提交，请勿重复提交！", false);
                            }
                        });
                    } else {
                        displayNotification("提供的IGN无效或不是正版Minecraft账户，请确认后重新提交！", false);
                    }
                });
            });

            function checkPlayerStatus(playerName, callback) {
                var xhr = new XMLHttpRequest();
                xhr.open("GET", `hypixelapi.php?playerName=${playerName}`, true);
                xhr.onload = function () {
                    var response = JSON.parse(xhr.responseText);
                    if (response.error) {
                        callback({ canSubmit: false, message: "无法验证玩家状态，请稍后再试" });
                    } else {
                        var message = "";
                        var canSubmit = true;
                        if (response.networkLevel < 21) {
                            message = "您的等级低于21级，为了确保您的游戏安全，请您到达21级后在申请";
                            canSubmit = false;
                        } else if (response.hasGuild) {
                            message = "您已经有一个公会了，请您退出当前公会再来申请。";
                            canSubmit = false;
                        }
                        callback({ canSubmit: canSubmit, message: message });
                    }
                };
                xhr.onerror = function () {
                    callback({ canSubmit: false, message: "验证玩家状态时出现网络或其他错误，请稍后再试" });
                };
                xhr.send();
            }

        function verifyPlayerIGN(playerName, callback) {
            var xhr = new XMLHttpRequest();
            xhr.open("GET", `ign.php?ign=${playerName}`, true);
            xhr.onload = function () {
                var response = JSON.parse(xhr.responseText);
                if (response.id) {
                    callback(true); 
                } else {
                    callback(false); 
                }
            };
            xhr.onerror = function () {
                displayNotification("验证IGN时出现网络或其他错误，请稍后再试！", false);
                callback(false); 
            };
            xhr.send();
        }

        function checkForDuplicateSubmission(playerName, callback) {
            var xhr = new XMLHttpRequest();
            xhr.open("GET", `check_duplicate.php?name=${playerName}`, true);
            xhr.onload = function () {
                if (xhr.responseText === "duplicate") {
                    callback(true);
                } else {
                    callback(false);
                }
            };
            xhr.onerror = function () {
                displayNotification("检查重复提交时出现网络或其他错误，请稍后再试！", false);
            };
            xhr.send();
        }

        function submitForm(formData) {
            var xhr = new XMLHttpRequest();
            xhr.open("POST", "submit.php", true);
            xhr.onreadystatechange = function () {
                if (xhr.readyState == 4 && xhr.status == 200) {
                    var response = JSON.parse(xhr.responseText);
                    displayNotification(response.message, response.success);
                }
            };
            xhr.send(formData);
        }

        function displayNotification(message, isSuccess = true) {
            var notification = document.createElement("div");
            if (isSuccess) {
                notification.classList.add("notification");
            } else {
                notification.classList.add("error-notification");
            }
            notification.textContent = message;
            document.body.appendChild(notification);
        
            setTimeout(function() {
                document.body.removeChild(notification);
            }, 5000);
        }
        console.log('© 2023-2024 Juzi & 北海的佰川');
    </script>
    <script>
        document.getElementById("searchForm").addEventListener("submit", function (event) {
            event.preventDefault(); // 阻止表单默认提交行为

            // 获取查询姓名
            var searchName = document.getElementById("searchName").value;

            // 发送 AJAX 请求
            var xhr = new XMLHttpRequest();
            xhr.open("GET", "search.php?name=" + encodeURIComponent(searchName), true);
            xhr.onreadystatechange = function () {
                if (xhr.readyState == 4 && xhr.status == 200) {
                    var data = xhr.responseText.trim();

                    // 检查返回的数据是否符合未找到的情况
                    if (data === "未提交申请或IGN输入错误") {
                        document.getElementById("result").innerHTML = '<div class="card"><div class="card-content"><span class="card-title">查询结果</span><p>' + data + '</p></div></div>';
                        // 创建通知元素
                        var notification = document.createElement("div");
                        notification.classList.add("error-notification");
                        notification.textContent = "查询失败!";

                        // 将通知元素添加到页面中
                        document.body.appendChild(notification);

                        // 5秒后移除通知
                        setTimeout(function () {
                            document.body.removeChild(notification);
                        }, 5000);

                    } else {    // 创建通知元素
                        var notification = document.createElement("div");
                        notification.classList.add("notification");
                        notification.textContent = "查询成功!";

                        // 将通知元素添加到页面中
                        document.body.appendChild(notification);

                        // 5秒后移除通知
                        setTimeout(function () {
                            document.body.removeChild(notification);
                        }, 5000);

                        // 解析返回的字符串，构建HTML结构
                        var parts = data.split(" | ");
                        var htmlContent = '<div class="card"><div class="card-content"><span class="card-title">查询结果</span>';

                        parts.forEach(function (part) {
                            var keyValue = part.split(": ");
                            htmlContent += '<p>' + keyValue[0] + ': ' + keyValue[1] + '</p>';
                        });

                        htmlContent += '</div></div>';
                        document.getElementById("result").innerHTML = htmlContent;
                    }
                }
            };
            xhr.send();
        });
        console.log('© 2023-2024 Juzi');
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            var inputs = document.querySelectorAll("#container input, #container textarea");
            var reasonInput = document.getElementById('reason');
            var reasonCountSpan = document.getElementById('reason-count');
            var submitButton = document.querySelector("button[type='submit']");
            document.body.insertAdjacentHTML('beforeend', `
                <div id="inputAlert" class="modal">
                    <div class="modal-content red white-text">
                        <h4>警告</h4>
                        <p id="alertMsg"></p>
                    </div>
                </div>
            `);
            var modalInstance = M.Modal.init(document.getElementById('inputAlert'));
        
            // 监听所有输入框的输入事件
            inputs.forEach(input => {
                input.addEventListener('input', function () {
                    // 特定于reason输入的字符限制逻辑
                    if(input.id === 'reason') {
                        var inputLength = input.value.length;
                        reasonCountSpan.textContent = `${inputLength}/200`;
                        if (inputLength > 200) {
                            input.value = input.value.substring(0, 200); // 限制字符输入
                            reasonCountSpan.textContent = `200/200`; // 更新字符计数显示
                            displayNotification('字符数量不能超过200。');
                            submitButton.disabled = true; 
                        } else {
                            submitButton.disabled = false;
                        }
                    }
        
                    
                    if (input.value.match(/[\ud800-\udfff]/) || /[<>]/.test(input.value)) {
                        document.getElementById('alertMsg').textContent = '请不要输入表情符号、尖括号或其他潜在的XSS攻击内容。';
                        modalInstance.open();
                        submitButton.disabled = true; // 禁用按钮
                    } else {
                        
                        var allClear = Array.from(inputs).every(input => 
                            !(input.value.match(/[\ud800-\udfff]/) || /[<>]/.test(input.value) || (input.id === 'reason' && input.value.length > 200))
                        );
                        submitButton.disabled = !allClear;
                    }
                });
            });
        
            function displayNotification(message) {
                var notification = document.createElement("div");
                notification.className = "error-notification";
                notification.textContent = message;
                notification.style.position = "fixed";
                notification.style.top = "20px";
                notification.style.right = "20px";
                notification.style.zIndex = "1000";
                document.body.appendChild(notification);
                setTimeout(function() {
                    document.body.removeChild(notification);
                }, 5000); // 通知显示5秒后消失
            }
        });
    </script>
    <script>
    // 初始化i18next
    i18next.init({
        lng: 'zh_CN', // 设置默认语言为简体中文
        debug: true, // 启用调试模式，生产环境应禁用
        resources: {
            en: { // 英文资源
                translation: {
                    "nav": {
                        "brand": "JuziClub",
                        "home": "Home",
                        "about": "About Us",
                        "services": "US IP",
                        "status": "JuziClub Probe",
                        "language":"Language"
                    },
                    "main": {
                        "application": {
                            "title": "Join JuziClub",
                            "gameId": "IGN (Name ID)",
                            "email": "Email",
                            "reason": "Application Reason",
                            "submit": "Submit Application",
                            "note": "Only valid Minecraft account IGN can be submitted. Three failed submissions require waiting for one hour before resubmitting"
                        },
                        "status": {
                            "title": "Application Status Check",
                            "inputLabel": "Enter your IGN below",
                            "check": "Check",
                            "note": "Can only check 5 times within 1 minute"
                        }
                    },
                    "footer": {
                        "copyright": "Copyright &copy; 2023-2024 JCLY TEAM. All rights reserved"
                    }
                }
            },
            zh_CN: { // 简体中文资源
                translation: {
                    "nav": {
                        "brand": "JuziClub",
                        "home": "官网",
                        "about": "关于我们",
                        "services": "加速IP",
                        "status": "JuziClub探针",
                        "language":"语言选择"
                    },
                    "main": {
                        "application": {
                            "title": "JuziClub入会申请",
                            "gameId": "IGN（游戏ID）",
                            "email": "邮箱",
                            "reason": "申请理由",
                            "submit": "提交申请",
                            "note": "只能提交正版账户IGN，API获取用户数据数据时候可能有延迟"
                        },
                        "status": {
                            "title": "申请状态查询",
                            "inputLabel": "下方输入你的IGN",
                            "check": "查询",
                            "note": "1分钟之内只能查询5次"
                        }
                    },
                    "footer": {
                        "copyright": "Copyright &copy; 2023-2024 JCLY TEAM 保留所有权益"
                    }
            },
            zh_TW: { // 繁体中文资源
                translation: {
                    "nav": {
                        "brand": "JuziClub俱樂部",
                        "home": "首頁",
                        "about": "關於我們",
                        "services": "加速直通线",
                        "status": "JuziClub探針",
                        "language": "語言選擇"
                    },
                    "main": {
                        "application": {
                            "title": "加入JuziClub公會",
                            "gameId": "遊戲帳號Name",
                            "email": "信箱",
                            "reason": "申請原因",
                            "submit": "送出申請",
                            "note": "只能填写有效的麦块有效的游戏帳號Name，三次失敗需要等一個小時後再次提交"
                        },
                        "status": {
                            "title": "申請狀態查詢", // 确保这里有对应的翻译
                            "inputLabel": "輸入你的遊戲帳號Name",
                            "check": "查詢",
                            "note": "1分鐘內只能查詢5次"
                        }
                    },
                    "footer": {
                        "copyright": "Copyright © 2023-2024 JCLY TEAM "
                    }
                }
            },
            ja: { // 日文资源
                translation: {
                        "nav": {
                            "brand": "JuziClub",
                            "home": "ホーム",
                            "about": "当サイトについて",
                            "services": "IP高速",
                            "status": "JuziClubプローブ",
                            "language": "言語選択"
                        },
                        "main": {
                            "application": {
                                "title": "JuziClub入会申請",
                                "gameId": "IGN（ゲームID）",
                                "email": "メールアドレス",
                                "reason": "申請理由",
                                "submit": "申請を送信",
                                "note": "有効なMinecraftアカウントIGNのみを送信できます。3回の送信失敗後は1時間待ってから再度送信してください。"
                            },
                            "status": {
                                "title": "申請状況の確認",
                                "inputLabel": "下記にIGNを入力してください",
                                "check": "確認",
                                "note": "1分以内に最大5回しか確認できません。"
                            }
                        },
                        "footer": {
                            "copyright": "Copyright &copy; 2023-2024 JCLY TEAM。全著作権所有者が保護されています。"
                        }
                    }
                }
            }
        }
    }, function(err, t) {
        if (err) return console.error(err);
        updateContent();
    });
    
        function updateContent() {
            document.querySelectorAll('[data-i18n]').forEach(function(elem) {
                var keys = elem.getAttribute('data-i18n').split(';');
                var text = keys.map(key => i18next.t(key)).join('');
                elem.innerHTML = text;
            });
        }

        
        // 文档加载完成后，初始化下拉菜单并添加事件监听器
        document.addEventListener('DOMContentLoaded', function() {
            var elems = document.querySelectorAll('.dropdown-trigger');
            M.Dropdown.init(elems, {hover: false});
        
        // 监听第一个下拉菜单项点击事件，用于语言切换
        document.querySelectorAll('#dropdown1 a').forEach(function(elem) {
            elem.addEventListener('click', function() {
                var selectedLang = this.getAttribute('data-lang'); // 获取语言代码
                i18next.changeLanguage(selectedLang, function(err, t) {
                    if (err) return console.error(err);
                    updateContent(); // 更新内容以反映新选择的语言
                });
            });
        });
    
        // 监听第二个下拉菜单项点击事件，用于语言切换
        document.querySelectorAll('#dropdown2 a').forEach(function(elem) {
            elem.addEventListener('click', function() {
                var selectedLang = this.getAttribute('data-lang'); // 获取语言代码
                i18next.changeLanguage(selectedLang, function(err, t) {
                    if (err) return console.error(err);
                    updateContent(); // 更新内容以反映新选择的语言
                });
            });
        });
    });
    </script>
    <script>console.log(" 喝水不忘挖井人，此代码保留所有权益，此代码必须公开");</script>
</body>
</html>