document.addEventListener('DOMContentLoaded', () => {
    loadUsers();
});

document.getElementById('user-form').addEventListener('submit', function(event) {
event.preventDefault();

const fullName = document.getElementById('full-name').value;
const login = document.getElementById('login').value;
const password = document.getElementById('password').value;
const role = document.getElementById('role').value;

fetch('/admin/users', {
    method: 'POST',
    headers: { 
        'Content-Type': 'application/json',
        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
    },
    body: JSON.stringify({ 
        full_name: fullName, 
        login: login, 
        password: password, 
        role: role 
    })
})
.then(response => response.json())
.then(data => {
    if (data.success) {
        document.getElementById('success-message').innerText = data.message;
        document.getElementById('error-message').innerText = '';
        loadUsers();
    } else {
        document.getElementById('error-message').innerText = data.message;
        document.getElementById('success-message').innerText = '';
    }
})
.catch(error => {
    document.getElementById('error-message').innerText = 'Произошла ошибка. Попробуйте еще раз.';
});
});


function loadUsers() {
    fetch('/admin/users')
    .then(response => response.json())
    .then(data => {
        const tableBody = document.getElementById('user-table').querySelector('tbody');
        tableBody.innerHTML = '';
        data.users.forEach(user => {
            const row = document.createElement('tr');
            row.innerHTML = `
                <td>${user.ФИО}</td>
                <td>${user.Логин}</td>
                <td>${user.Роль}</td>
                <td>${user.is_locked == 1 ? 'Заблокирован' : 'Активен'}</td>
                <td>
                    <div class="btn-group">
                        <button class="btn btn-danger" onclick="deleteUser(${user.ID_Пользователи})">Удалить</button>
                        <button class="btn" onclick="toggleLockUser(${user.ID_Пользователи}, ${user.is_locked})">
                            ${user.is_locked == 1 ? 'Разблокировать' : 'Заблокировать'}
                        </button>
                    </div>
                </td>
            `;
            tableBody.appendChild(row);
        });
    })
    .catch(error => {
        document.getElementById('error-message').innerText = 'Произошла ошибка при загрузке пользователей.';
    });
}


function toggleLockUser(userId, currentLockStatus) {
    fetch(`/admin/users/${userId}/toggle-lock`, {
        method: 'POST',
    headers: { 
        'Content-Type': 'application/json',
        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
    }
})
.then(response => response.json())
.then(data => {
    if (data.success) {
        document.getElementById('success-message').innerText = data.message;
        loadUsers();
    } else {
        document.getElementById('error-message').innerText = data.message;
    }
})
.catch(error => {
    document.getElementById('error-message').innerText = 'Произошла ошибка при изменении статуса пользователя.';
});
}



function deleteUser(userId) {
    fetch(`/admin/users/${userId}`, {
        method: 'DELETE'
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            loadUsers();
        } else {
            document.getElementById('error-message').innerText = data.message;
        }
    });
}

function unlockUser(userId) {
fetch(`/admin/users/${userId}/unlock`, {
    method: 'POST',
    headers: { 
        'Content-Type': 'application/json',
        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
    }
})
.then(response => response.json())
.then(data => {
    if (data.success) {
        document.getElementById('success-message').innerText = data.message;
        document.getElementById('error-message').innerText = '';
        loadUsers();
    } else {
        document.getElementById('error-message').innerText = data.message;
    }
})
.catch(error => {
    document.getElementById('error-message').innerText = 'Произошла ошибка при разблокировке пользователя.';
});
}

