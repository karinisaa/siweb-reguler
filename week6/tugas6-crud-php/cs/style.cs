* {
    box-sizing: border-box;
    margin: 0;
    padding: 0;
}

body {
    font-family: Arial, sans-serif;
    font-size: 14px;
    background-color: #f0f0f0;
    color: #333;
    display: flex;
    justify-content: center;
    align-items: flex-start;
    min-height: 100vh;
    padding: 30px 16px;
}

.container {
    background: white;
    width: 100%;
    max-width: 420px;
    border-radius: 6px;
    overflow: hidden;
    box-shadow: 0 2px 8px rgba(0,0,0,0.1);
}

.page-title {
    text-align: center;
    padding: 24px 20px 16px;
    font-size: 22px;
    font-weight: bold;
    text-decoration: underline wavy;
    text-underline-offset: 4px;
}

.form-body {
    padding: 0 20px 16px;
}

.form-group {
    margin-bottom: 12px;
}

.form-group label {
    display: block;
    font-weight: bold;
    margin-bottom: 4px;
    font-size: 14px;
}

.form-group input {
    width: 100%;
    padding: 9px 12px;
    border: 1px solid #ccc;
    border-radius: 4px;
    font-size: 14px;
    color: #333;
}

.form-group input::placeholder { color: #aaa; }
.form-group input:focus { outline: none; border-color: #3a86ff; }
.form-group input.invalid { border-color: red; }

.alert {
    margin: 0 20px 12px;
    padding: 9px 12px;
    border-radius: 4px;
    font-size: 13px;
}
.alert-success { background-color: #d4edda; border: 1px solid #c3e6cb; color: #155724; }
.alert-danger  { background-color: #f8d7da; border: 1px solid #f5c6cb; color: #721c24; }

.btn-insert {
    display: block;
    width: 100%;
    padding: 11px;
    background-color: #3a86ff;
    color: white;
    border: 2px solid #1a60d0;
    border-radius: 4px;
    font-size: 15px;
    font-weight: bold;
    cursor: pointer;
    text-align: center;
}
.btn-insert:hover { background-color: #2a76ef; }

.nav-bar {
    display: flex;
    border-top: 1px solid #ddd;
    margin-top: 14px;
}

.nav-bar a {
    flex: 1;
    text-align: center;
    padding: 13px;
    background-color: #1a1a1a;
    color: white;
    text-decoration: none;
    font-size: 14px;
    font-weight: bold;
    letter-spacing: 1px;
}
.nav-bar a + a { border-left: 1px solid #444; }
.nav-bar a:hover { background-color: #333; }

.user-list {
    padding: 10px 16px;
    display: flex;
    flex-direction: column;
    gap: 8px;
}

.user-item {
    background-color: #f5f5f5;
    border-radius: 6px;
    padding: 10px 14px;
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 10px;
}

.user-info { flex: 1; min-width: 0; }
.user-info .username { font-weight: bold; font-size: 14px; color: #222; }
.user-info .email { font-size: 12px; color: #666; font-style: italic; }

.user-actions { display: flex; gap: 6px; flex-shrink: 0; }

.btn {
    padding: 5px 12px;
    border: none;
    border-radius: 4px;
    font-size: 13px;
    font-weight: bold;
    cursor: pointer;
    text-decoration: none;
    display: inline-block;
}
.btn:hover { opacity: 0.85; }
.btn-edit   { background-color: #28a745; color: white; }
.btn-delete { background-color: #dc3545; color: white; }
.btn-secondary { background-color: #6c757d; color: white; }

.btn-update {
    display: block;
    width: 100%;
    padding: 11px;
    background-color: #28a745;
    color: white;
    border: 2px solid #1e7e34;
    border-radius: 4px;
    font-size: 15px;
    font-weight: bold;
    cursor: pointer;
    margin-bottom: 10px;
}
.btn-update:hover { background-color: #218838; }

.btn-cancel-link {
    display: block;
    width: 100%;
    padding: 10px;
    background-color: #6c757d;
    color: white;
    border: none;
    border-radius: 4px;
    font-size: 14px;
    font-weight: bold;
    text-align: center;
    text-decoration: none;
}
.btn-cancel-link:hover { background-color: #5a6268; }

.empty-text {
    text-align: center;
    padding: 24px;
    color: #888;
    font-size: 13px;
}

#toast {
    position: fixed;
    bottom: 24px;
    right: 24px;
    padding: 12px 18px;
    border-radius: 4px;
    font-size: 13px;
    color: white;
    display: none;
    z-index: 999;
    max-width: 300px;
    box-shadow: 0 2px 8px rgba(0,0,0,0.2);
}
#toast.success { background-color: #28a745; }
#toast.error   { background-color: #dc3545; }
#toast.show    { display: block; }

.modal-overlay {
    display: none;
    position: fixed;
    inset: 0;
    background: rgba(0,0,0,0.5);
    z-index: 100;
    justify-content: center;
    align-items: center;
}
.modal-overlay.open { display: flex; }
.modal {
    background: white;
    border-radius: 6px;
    padding: 24px 20px;
    width: 300px;
    text-align: center;
    box-shadow: 0 4px 20px rgba(0,0,0,0.2);
}
.modal p { margin-bottom: 20px; font-size: 14px; color: #333; }
.modal-actions { display: flex; gap: 10px; justify-content: center; }