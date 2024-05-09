document.getElementById("submit-form").addEventListener("click", function() {
    var formData = new FormData(document.getElementById("update-form"));

    fetch("form.php", {
        method: "POST",
        body: formData
    })
    .then(response => {
        if (!response.ok) {
            throw new Error("Erro na requisição: " + response.statusText);
        }
        return response.json();
    })
    .then(data => {
        if (data.success) {
            updateUserInfo(data.data);
            document.getElementById("update-form").reset();
        } else {
            throw new Error("Erro ao atualizar informações: " + data.message);
        }
    })
    .catch(error => {
        alert(error.message);
    });
});

function updateUserInfo(data) {
    document.querySelector(".user-info h2").textContent = "Nome: " + data.nome;
    document.querySelectorAll(".user-info p")[0].textContent = "Idade: " + data.idade + " anos";
    document.querySelectorAll(".user-info p")[1].textContent = "Rua: " + data.rua;
    document.querySelector(".user-info p:nth-of-type(3)").textContent = "Bairro: " + data.bairro;
    document.querySelector(".user-info p:nth-of-type(4)").textContent = "Estado: " + data.estado;
    document.querySelector(".user-info p:nth-of-type(5)").textContent = "Biografia: " + data.bio;
}
