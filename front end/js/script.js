const form = document.getElementById('form');
const formUpdate = document.getElementById('formUpdate');
const myHeaders = new Headers();
myHeaders.append("Content-Type", "application/json");

const modal = document.getElementById('modal');
const openModalBtn = document.getElementById('openModalBtn');
const closeModalBtn = document.getElementById('closeModalBtn');
const modalUpdate = document.getElementById('modalUpdate');
const closeModalUpdate = document.getElementById('closeModalUpdate');

openModalBtn.onclick = () => {
    modal.style.display = "block";
};

closeModalBtn.onclick = () => {
    modal.style.display = "none";
};

closeModalUpdate.onclick = () => {
    modalUpdate.style.display = "none";
};

window.onclick = (event) => {
    if (event.target === modal) {
        modal.style.display = "none";
    }
    if (event.target === modalUpdate) {
        modalUpdate.style.display = "none";
    }
};

form.addEventListener("submit", async (event) => {
    event.preventDefault();
    const formData = new FormData(form);
    const data = Object.fromEntries(formData);

    const response = await fetch("http://localhost:8000/api/createUser.php", {
        method: 'POST',
        mode: 'cors',
        body: JSON.stringify(data),
        headers: myHeaders,
    });

    getData();
    form.reset();

    modal.style.display = "none";
});

formUpdate.addEventListener("submit", async (event) => {
    event.preventDefault();
    const formData = new FormData(formUpdate);
    const data = Object.fromEntries(formData);

    const response = await fetch("http://localhost:8000/api/updateUser.php", {
        method: 'POST',
        mode: 'cors',
        body: JSON.stringify(data),
        headers: myHeaders,
    });

    getData();
    formUpdate.reset();
    console.log(data)

    modalUpdate.style.display = "none";
});

async function getData() {
    const tbody = document.getElementById('tbody');
    let tr = '';
    const url = "http://localhost:8000/api/getUsers.php";
    try {
        const response = await fetch(url);
        if (!response.ok) {
            throw new Error(`Erro: ${response.status}`);
        }

        const json = await response.json();
        if (json.empty === "empty") {
            tr = "<tr><td colspan='7'>Nenhum registro encontrado</td></tr>";
        } else {
            for (let i in json) {
                tr += `
                    <tr>
                        <td>${parseInt(i) + 1}</td>
                        <td>${json[i].name}</td>
                        <td>${json[i].age}</td>
                        <td>${json[i].email}</td>
                        <td>${json[i].phone}</td>
                        <td><button onclick="editData(${json[i].id})">Editar</button></td>
                        <td><button onclick="deleteData(${json[i].id})">Excluir</button></td>
                    </tr>`;
            }
            tbody.innerHTML = tr;
        }
    } catch (error) {
        console.log(error.message);
    }
}
getData();

const editData = async (id) => {
    modalUpdate.style.display = "block";

    const response = await fetch(`http://localhost:8000/api/getUser.php?id=${id}`, {
        method: "GET",
        headers: myHeaders
    });

    const json = await response.json();
    if (json["empty"] !== "empty") {
        for(let i in json){
        document.querySelector("#id").value = json[i].id;
        document.querySelector("#name_upd").value = json[i].name;
        document.querySelector("#age_upd").value = json[i].age;
        document.querySelector("#email_upd").value = json[i].email;
        document.querySelector("#phone_upd").value = json[i].phone;
        }
        
    }
};

const deleteData = async (id) => {
    const response = await fetch(`http://localhost:8000/api/deleteUser.php?id=${id}`, {
        method: "GET",
        headers: myHeaders
    });

    const json = await response.json();
    getData();
    console.log(json);
}
