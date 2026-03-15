const authSection = document.getElementById('authSection');
const notesSection = document.getElementById('notesSection')

const userLogged = async (id) => {
    if (typeof id === 'number') {
        authSection.classList.add('hidden');
        notesSection.classList.remove('hidden');

        await refreshNotes();
    }
}
const login = async (data) => {
    try {
        const response = await fetch('api.php?action=login', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify(data)
        })

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
        })

        return await response.json();
    } catch (e) {
        console.error(e);
    }
}

const logout = async () => {
    try {
        const response = await fetch('api.php?action=logout');
        return await response.json();
    } catch (e) {
        console.error(e);
        return false;
    }
}

const checkSession = async () => {
    try {
        const response = await fetch('api.php?action=me');
        return await response.json();
    } catch (e) {
        console.error("Error fetching notes", e);
        return null;
    }
}

const getNotes = async () => {
    try {
        const response = await fetch('api.php?action=getNotes', {
            method: 'GET',
            headers: {
                'Content-Type': 'application/json'
            }
        });
        return await response.json();
    } catch (e) {
        console.error("Error fetching notes", e);
        return [];
    }
}

const getNote = async (id) => {
    try {
        const response = await fetch(`api.php?action=getNote&id=${id}`, {
            method: 'GET',
            headers: {
                'Content-Type': 'application/json'
            }
        });
        return await response.json();
    } catch (e) {
        console.error("Error fetching note", e);
        return null;
    }
}

const createNote = async (data) => {
    try {
        const response = await fetch('api.php?action=createNote', {
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

const updateNote = async (data) => {
    try {
        const response = await fetch('api.php?action=updateNote', {
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

const deleteNote = async (id) => {
    try {
        const response = await fetch('api.php?action=deleteNote', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({id})
        });

        return await response.json();
    } catch (e) {
        console.error(e);
    }
}

const refreshNotes = async () => {
    const notes = await getNotes();
    renderNotes(notes);
}

const renderNotes = (notes) => {
    const notesContainer = document.getElementById('notesList');
    notesContainer.innerHTML = '';
    notes.forEach(note => {
        const noteDiv = document.createElement('div');
        noteDiv.classList.add('note');
        noteDiv.innerHTML = `
            <h3>${note.title}</h3>
            <p>${note.content}</p>
            <button class="editNote" data-id="${note.id}">Edit</button>
            <button class="deleteNote" data-id="${note.id}">Delete</button>
        `;
        notesContainer.appendChild(noteDiv);
    });
}


document.addEventListener('DOMContentLoaded', async () => {
    const user = await checkSession();

    if (user && user.id) {
        authSection.classList.add('hidden');
        notesSection.classList.remove('hidden');

        await refreshNotes();
    }
})
document.body.addEventListener('submit', async (event) => {
    event.preventDefault();

    if (event.target.tagName === 'FORM') {
        let data;
        let result;
        if (event.target.id === 'loginForm') {
            data = {
                email: event.target.querySelector('#loginEmail').value,
                password: event.target.querySelector('#loginPassword').value,
            }

            result = await login(data);
            if (result && result.id) {
                await userLogged(result.id);
            } else {
                alert(result?.error || "Login failed");
            }
        } else if (event.target.id === 'registerForm') {
            data = {
                name: event.target.querySelector('#regName').value,
                email: event.target.querySelector('#regEmail').value,
                password: event.target.querySelector('#regPassword').value,
            }

            result = await register(data);

            if (result && result.id) {
                await userLogged(result.id);
            } else {
                alert(result?.error || "Registration failed");
            }
        } else if (event.target.id === 'noteForm' && event.target.dataset.id) {
            data = {
                id: event.target.dataset.id,
                title: event.target.querySelector('#noteTitle').value,
                content: event.target.querySelector('#noteText').value
            }

            const result = await updateNote(data);
            if (result) {
                await refreshNotes();
                event.target.reset();
            }
        } else if (event.target.id === 'noteForm') {
            data = {
                title: event.target.querySelector('#noteTitle').value,
                content: event.target.querySelector('#noteText').value
            }

            const result = await createNote(data);
            if (result.id) {
                await refreshNotes();
                event.target.reset();
            }
        }
    }
})
document.querySelector('#logoutBtn').addEventListener('click', async () => {
    const result = await logout();
    if (result) {
        authSection.classList.remove('hidden');
        notesSection.classList.add('hidden');
    }
})

const clearForm = (form, cancelEditBtn) => {
    form.querySelector('#noteTitle').value = '';
    form.querySelector('#noteText').value ='';
    form.dataset.id = '';
    cancelEditBtn.style.display = 'none';

}

document.getElementById('notesList').addEventListener('click', async (event) => {
    if (event.target.classList.contains('editNote')) {
        const note = await getNote(event.target.dataset.id);
        const form = document.querySelector('#noteForm');
        form.querySelector('#noteTitle').value = note.title;
        form.querySelector('#noteText').value = note.content;
        form.dataset.id = note.id;
        const cancelEditBtn = document.querySelector('#cancelEdit');
        cancelEditBtn.style.display = 'block';
        cancelEditBtn.addEventListener('click', () => clearForm(form, cancelEditBtn))
    }

    if (event.target.classList.contains('deleteNote')) {
        const result = await deleteNote(event.target.dataset.id);
        if (result) {
            await refreshNotes();
        }
    }
});