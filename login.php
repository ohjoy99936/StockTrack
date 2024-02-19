<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Staff Login Page</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <style>
        body {
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
            margin: 0;
        }

        .container {
            width: 320px;
        }

        .card {
            border: 1px solid #ddd;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            padding: 20px;
            margin-top: 20px;
        }

        .card-header {
            text-align: center;
            background-color: #007bff;
            color: #fff;
            padding: 10px;
            font-size: 18px;
            margin-bottom: 15px;
        }

        .form-group {
            margin-bottom: 15px;
        }

        .form-group label {
            margin-bottom: 5px;
            display: block;
        }

        .form-control {
            width: 100%;
        }

        .btn-primary {
            background-color: #007bff;
            color: #fff;
            padding: 15px;
            font-size: 16px;
            display: block;
            width: 100%;
        }

        .card-footer {
            margin-top: 15px;
            text-align: right;
        }
    </style>
    <!-- 引用 Firebase JavaScript SDK -->
    <script src="https://www.gstatic.com/firebasejs/10.0.2/firebase-app.js"></script>
    <script src="https://www.gstatic.com/firebasejs/10.0.2/firebase-auth.js"></script>
    <script>
        // Your web app's Firebase configuration
        const firebaseConfig = {
            apiKey: "AIzaSyDuO9AkQqFfVS-U8rgwkdkiS1wthmGOkQU",
            authDomain: "stocktrack-327a4.firebaseapp.com",
            projectId: "stocktrack-327a4",
            storageBucket: "stocktrack-327a4.appspot.com",
            messagingSenderId: "707185415746",
            appId: "1:707185415746:web:21ad50fba1434302d5bfdb",
            measurementId: "G-0H43SEWVBF"
        };

        // Initialize Firebase
        const app = firebase.initializeApp(firebaseConfig);
        const auth = firebase.auth();

        // 添加员工的 JavaScript 函数
        function addStaff() {
            var name = document.getElementById("name").value;
            var email = document.getElementById("email").value;
            var role = document.getElementById("role").value;
            var password = document.getElementById("password").value;

            // 使用 Firebase 的认证服务创建新用户
            auth.createUserWithEmailAndPassword(email, password)
            .then((userCredential) => {
                // 添加用户信息到数据库
                db.collection("staff").add({
                    name: name,
                    email: email,
                    roleID: role,
                    password: password
                })
                .then((docRef) => {
                    console.log("Document written with ID: ", docRef.id);
                })
                .catch((error) => {
                    console.error("Error adding document: ", error);
                });
            })
            .catch((error) => {
                console.error("Error creating user: ", error);
            });
        }
    </script>
</head>
<body>
    <h1>Add Staff</h1>
    <form>
        <label for="name">Name:</label>
        <input type="text" id="name" name="name"><br><br>
        <label for="email">Email:</label>
        <input type="email" id="email" name="email"><br><br>
        <label for="role">Role:</label>
        <input type="text" id="role" name="role"><br><br>
        <label for="password">Password:</label>
        <input type="password" id="password" name="password"><br><br>
        <button type="button" onclick="addStaff()">Submit</button>
    </form>
</body>
</html>
