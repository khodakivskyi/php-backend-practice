<!doctype html>
<html lang="uk">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Notes App</title>
    <style>
        body { font-family: Arial, sans-serif; padding: 20px; background: #f5f5f5; }
        h1 { text-align: center; }
        .hidden { display: none; }
        input, textarea { display: block; width: 100%; margin: 5px 0; padding: 8px; box-sizing: border-box; }
        button { padding: 8px 12px; margin-top: 5px; cursor: pointer; }
        .note { background: #fff; padding: 10px; margin-bottom: 10px; border-radius: 5px; box-shadow: 0 1px 3px rgba(0,0,0,0.1); }
    </style>
    <script src="js/script.js" defer></script>
</head>
<body>
<div id="authSection">
    <h1>Вхід або Реєстрація</h1>
    <form id="loginForm">
        <input type="email" id="loginEmail" placeholder="Email" required>
        <input type="password" id="loginPassword" placeholder="Пароль" required>
        <button type="submit">Увійти</button>
    </form>
    <br>
    <form id="registerForm">
        <input type="text" id="regName" placeholder="Ім'я" required>
        <input type="email" id="regEmail" placeholder="Email" required>
        <input type="password" id="regPassword" placeholder="Пароль" required>
        <button type="submit">Зареєструватися</button>
    </form>
</div>

<div id="notesSection" class="hidden">
    <h1>Notes App</h1>
    <button id="logoutBtn">Вийти</button>

    <form id="noteForm">
        <input type="text" name="title" id="noteTitle" placeholder="Заголовок замітки" required>
        <textarea name="text" id="noteText" placeholder="Текст замітки" rows="4" required></textarea>
        <button type="submit">Зберегти замітку</button>
        <button type="button" id="cancelEdit" style="display:none;">Відмінити редагування</button>
    </form>

    <div id="notesList"></div>
</div>
</body>
</html>