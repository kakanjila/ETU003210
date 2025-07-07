

<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <title>Mensualités des clients</title>
  <style>
    body { font-family: sans-serif; padding: 20px; }
    table { border-collapse: collapse; width: 100%; margin-top: 20px; }
    th, td { border: 1px solid #ccc; padding: 8px; text-align: left; }
    th { background-color: #f2f2f2; }
    .error { color: red; margin-bottom: 10px; }
    .loading { color: blue; margin-bottom: 10px; }
    button { padding: 5px 10px; }
  </style>
</head>
<body>

  <h1>Mensualités des clients</h1>
  <div id="error-message" class="error"></div>
  <div id="loading-message" class="loading"></div>
  <button onclick="chargerMensualites()">Recharger les données</button>

  <table id="table-mensualites">
    <thead>
      <tr>
        <th>ID Client</th>
        <th>Nom Client</th>
        <th>ID Prêt</th>
        <th>Montant du Prêt (€)</th>
        <th>Taux d’intérêt (%)</th>
        <th>Durée (mois)</th>
        <th>Mensualité (€)</th>
      </tr>
    </thead>
    <tbody></tbody>
  </table>

  <script>
    const apiBase = "http://localhost/ETU003210/ws";

    function ajax(method, url, data, callback, errorCallback) {
    const xhr = new XMLHttpRequest();
    xhr.open(method, apiBase + url, true);
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    
    xhr.onreadystatechange = () => {
        if (xhr.readyState === 4) {
            if (xhr.status === 200) {
                try {
                    const response = JSON.parse(xhr.responseText);
                    callback(response);
                } catch (e) {
                    if (errorCallback) {
                        errorCallback("Erreur de parsing JSON: " + e.message);
                    }
                }
            } else {
                if (errorCallback) {
                    errorCallback("Erreur HTTP: " + xhr.status);
                }
            }
        }
    };

    xhr.onerror = () => {
        if (errorCallback) {
            errorCallback("Erreur réseau");
        }
    };

    xhr.send(data);
}

function chargerMensualites() {
    const loadingMsg = document.getElementById("loading-message");
    const errorMsg = document.getElementById("error-message");
    const tbody = document.querySelector("#table-mensualites tbody");
    
    loadingMsg.textContent = "Chargement en cours...";
    errorMsg.textContent = "";
    tbody.innerHTML = "";

    ajax(
        "GET", 
        "/clients/mensualites", 
        null,
        (data) => {
            loadingMsg.textContent = "";
            
            if (!data || !Array.isArray(data) || data.length === 0) {
                errorMsg.textContent = "Aucune donnée disponible. Vérifiez que des clients et prêts actifs existent.";
                return;
            }

            data.forEach(client => {
                if (client.mensualites && Array.isArray(client.mensualites)) {
                    client.mensualites.forEach(mensualite => {
                        const tr = document.createElement("tr");
                        tr.innerHTML = `
                            <td>${client.id_client || ''}</td>
                            <td>${client.nom_client || 'Inconnu'}</td>
                            <td>${mensualite.id_pret || ''}</td>
                            <td>${(mensualite.montant || 0).toFixed(2)}</td>
                            <td>${(mensualite.taux_interet || 0).toFixed(2)}</td>
                            <td>${mensualite.duree_mois || '0'}</td>
                            <td>${(mensualite.mensualite || 0).toFixed(2)}</td>
                        `;
                        tbody.appendChild(tr);
                    });
                }
            });
        },
        (error) => {
            loadingMsg.textContent = "";
            errorMsg.textContent = "Erreur lors du chargement des données: " + error;
        }
    );
}

    chargerMensualites();
  </script>
</body>
</html>