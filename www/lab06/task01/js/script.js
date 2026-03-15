const getUsersBtn = document.querySelector('#getUsers');
document.querySelector('form').addEventListener('submit', async (event) => {
    event.preventDefault();
    const data = {
        name : event.target.querySelector('input[name=name]').value,
        email : event.target.querySelector('input[name=email]').value,
        password : event.target.querySelector('input[name=password]').value,
    }

    const result = await register(data);

    if (!result.id) {
        alert(result);
    } else {
        const users = await getAllUsers();
        printUsers(users);
    }
})

getUsersBtn.addEventListener("click", async () => {
    const users = await getAllUsers();
    printUsers(users);
})

const printUsers = (users) => {
    const listDiv = document.querySelector('.users-list');
    listDiv.innerHTML = users.map(u => `<div>${u.name} (${u.email})</div>`).join('');
}

const getAllUsers = async () => {
    try {
        const response = await fetch('api.php?action=users', {
            method: 'GET',
            headers: {
                'Content-Type': 'application/json'
            },
        });

        return await response.json();
    } catch (e) {
        console.error(e);
    }
}

const register = async (data) => {
    try {
        const response = await fetch('api.php?action=register', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify(data)
        });

        return await response.json();
    } catch (e) {
        console.error(e);
    }
}