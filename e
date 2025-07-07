<!-- <!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Application de Gestion Bancaire - BMOI</title>
<style>
    /* Reset et styles de base */
    * {
      box-sizing: border-box;
      margin: 0;
      padding: 0;
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }
    
    body {
      background-color: #f5f3ff;
      color: #333;
      line-height: 1.6;
      padding: 0;
    }
    
    h1, h2, h3 {
      color: #4C1D95;
      margin-bottom: 15px;
    }
    
    /* Header */
    header {
      background-color: #4C1D95;
      color: white;
      padding: 15px 0;
      box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
    }
    
    .header-container {
      max-width: 1200px;
      margin: 0 auto;
      padding: 0 20px;
      display: flex;
      justify-content: space-between;
      align-items: center;
    }
    
    .logo {
      display: flex;
      align-items: center;
      gap: 10px;
      font-size: 1.5rem;
      font-weight: bold;
    }
    
    .logo svg {
      color: #A78BFA;
    }
    
    /* Navigation */
    nav {
      background-color: white;
      box-shadow: 0 1px 3px 0 rgba(0, 0, 0, 0.1);
    }
    
    .nav-container {
      max-width: 1200px;
      margin: 0 auto;
      padding: 0 20px;
      display: flex;
      gap: 20px;
      overflow-x: auto;
    }
    
    .nav-link {
      padding: 12px 0;
      color: #6B7280;
      font-weight: 500;
      white-space: nowrap;
      border-bottom: 2px solid transparent;
      transition: all 0.3s;
    }
    
    .nav-link:hover {
      color: #4C1D95;
    }
    
    .nav-link.active {
      color: #4C1D95;
      border-bottom-color: #4C1D95;
    }
    
    /* Layout */
    .container {
      max-width: 1200px;
      margin: 20px auto;
      padding: 20px;
      background-color: white;
      border-radius: 8px;
      box-shadow: 0 1px 3px 0 rgba(0, 0, 0, 0.1);
    }
    
    /* Onglets */
    .tabs {
      display: flex;
      margin-bottom: 20px;
      border-bottom: 1px solid #E5E7EB;
    }
    
    .tab-btn {
      padding: 10px 20px;
      background: none;
      border: none;
      cursor: pointer;
      font-size: 16px;
      color: #6B7280;
      border-bottom: 3px solid transparent;
      transition: all 0.3s;
      font-weight: 500;
    }
    
    .tab-btn:hover {
      color: #7C3AED;
    }
    
    .tab-btn.active {
      color: #7C3AED;
      border-bottom-color: #7C3AED;
      font-weight: 600;
    }
    
    /* Sections */
    .section {
      display: none;
      padding: 20px 0;
    }
    
    .section.active {
      display: block;
    }
    
    /* Formulaires */
    .form-group {
      margin-bottom: 20px;
      display: flex;
      flex-wrap: wrap;
      gap: 15px;
      align-items: center;
    }
    
    .form-container {
      background-color: #F9FAFB;
      padding: 20px;
      border-radius: 8px;
      margin-bottom: 20px;
    }
    
    label {
      display: block;
      font-size: 14px;
      font-weight: 500;
      color: #4B5563;
      margin-bottom: 5px;
    }
    
    input, select, button {
      padding: 10px 12px;
      border: 1px solid #D1D5DB;
      border-radius: 6px;
      font-size: 14px;
      transition: all 0.2s;
    }
    
    input:focus, select:focus {
      outline: none;
      border-color: #8B5CF6;
      box-shadow: 0 0 0 3px rgba(139, 92, 246, 0.1);
    }
    
    input[type="text"],
    input[type="email"],
    input[type="password"],
    input[type="number"],
    input[type="date"],
    select {
      flex: 1;
      min-width: 200px;
      background-color: white;
    }
    
    button {
      background-color: #4C1D95;
      color: white;
      border: none;
      cursor: pointer;
      font-weight: 500;
      border-radius: 6px;
      padding: 10px 16px;
    }
    
    button:hover {
      background-color: #7C3AED;
    }
    
    button.secondary {
      background-color: #E5E7EB;
      color: #4B5563;
    }
    
    button.secondary:hover {
      background-color: #D1D5DB;
    }
    
    button.danger {
      background-color: #DC2626;
    }
    
    button.danger:hover {
      background-color: #B91C1C;
    }
    
    /* Tables */
    table {
      width: 100%;
      border-collapse: collapse;
      margin-top: 20px;
      box-shadow: 0 1px 3px 0 rgba(0, 0, 0, 0.1);
    }
    
    th, td {
      padding: 12px 15px;
      text-align: left;
      border-bottom: 1px solid #E5E7EB;
    }
    
    th {
      background-color: #F3F4F6;
      font-weight: 600;
      color: #4B5563;
    }
    
    tr:hover {
      background-color: #F9FAFB;
    }
    
    /* Modals */
    .modal {
      display: none;
      position: fixed;
      top: 50%;
      left: 50%;
      transform: translate(-50%, -50%);
      background-color: white;
      padding: 25px;
      border-radius: 8px;
      box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
      z-index: 1000;
      width: 80%;
      max-width: 500px;
    }
    
    .modal h3 {
      margin-bottom: 20px;
      color: #4C1D95;
      font-size: 1.25rem;
    }
    
    .modal-actions {
      display: flex;
      justify-content: flex-end;
      gap: 10px;
      margin-top: 20px;
    }
    
    .overlay {
      display: none;
      position: fixed;
      top: 0;
      left: 0;
      right: 0;
      bottom: 0;
      background-color: rgba(0,0,0,0.5);
      z-index: 999;
    }
    
    /* Responsive */
    @media (max-width: 768px) {
      .form-group {
        flex-direction: column;
        align-items: stretch;
      }
      
      .modal {
        width: 95%;
      }
      
      .header-container, .nav-container {
        padding: 0 15px;
      }
    }
</style>
</head>
<body>
  <header>
    <div class="header-container">
      <div class="logo">
        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
          <circle cx="12" cy="12" r="10"></circle>
          <path d="M16 8h-6a2 2 0 1 0 0 4h4a2 2 0 1 1 0 4H8"></path>
          <path d="M12 18V6"></path>
        </svg>
        <span>BMOI</span>
      </div>
      <nav class="hidden md:flex space-x-6">
        <a href="#" class="hover:text-bmoi-accent transition duration-200 font-medium">Tableau de bord</a>
        <a href="#" class="hover:text-bmoi-accent transition duration-200 font-medium">Déconnexion</a>
      </nav>
    </div>
  </header>
  
  <nav>
    <div class="nav-container">
      <a href="#" class="nav-link">Clients</a>
      <a href="#" class="nav-link active">Prêts</a>
      <a href="#" class="nav-link">Comptes</a>
      <a href="#" class="nav-link">Transactions</a>
    </div>
  </nav>

<div class="container">
    <h1>Application de Gestion Bancaire</h1>
    
    <div class="tabs">
      <button class="tab-btn active" onclick="showSection('prets')">Prêts</button>
      <button class="tab-btn" onclick="showSection('clients')">Clients</button>
    </div>
    
    <div id="prets-section" class="section active">
      <h2>Gestion des Prêts</h2>
      
      <div class="form-container">
        <h3>Formulaire de prêt</h3>
        <div class="form-group">
          <input type="hidden" id="pret-id">
          <select id="pret-client" required>
            <option value="">Sélectionner un client</option>
          </select>
          <select id="pret-type" required>
            <option value="">Sélectionner un type</option>
          </select>
          <input type="number" id="pret-montant" placeholder="Montant" required>
          <input type="number" id="pret-duree" placeholder="Durée (mois)" required>
          <button onclick="gererPret()">Valider</button>
        </div>
        
        <div class="form-group">
          <h3>Changer statut</h3>
          <input type="hidden" id="pret-id-statut">
          <select id="pret-statut">
            <option value="EN_ATTENTE">En attente</option>
            <option value="APPROUVE">Approuvé</option>
            <option value="REJETE">Rejeté</option>
          </select>
          <button onclick="changerStatutPret()">Modifier</button>
        </div>
      </div>
      
      <table id="table-prets">
        <thead>
          <tr>
            <th>ID</th>
            <th>Client</th>
            <th>Type</th>
            <th>Montant</th>
            <th>Statut</th>
            <th>Actions</th>
          </tr>
        </thead>
        <tbody></tbody>
      </table>
    </div>
    
    <div id="clients-section" class="section">
      <h2>Gestion des Clients</h2>
      
      <div class="form-container">
        <div class="form-group">
          <input type="hidden" id="client-id">
          <input type="text" id="client-nom" placeholder="Nom" required>
          <input type="email" id="client-email" placeholder="Email" required>
          <input type="password" id="client-mdp" placeholder="Mot de passe" required>
          <input type="text" id="client-tel" placeholder="Téléphone">
          <input type="date" id="client-naissance" placeholder="Date de naissance">
          <button onclick="gererClient()">Valider</button>
        </div>
      </div>
      
      <table id="table-clients">
        <thead>
          <tr>
            <th>ID</th>
            <th>Nom</th>
            <th>Email</th>
            <th>Téléphone</th>
            <th>Actions</th>
          </tr>
        </thead>
        <tbody></tbody>
      </table>
    </div>
  </div>
  
  <div id="paiement-modal" class="modal">
    <h3>Paiement du prêt</h3>
    <input type="hidden" id="paiement-pret-id">
    <input type="hidden" id="paiement-client-id">
    <div class="form-group">
      <input type="number" id="paiement-montant" placeholder="Montant à payer" required>
    </div>
    <div class="modal-actions">
      <button class="secondary" onclick="fermerPaiementModal()">Fermer</button>
      <button onclick="effectuerPaiement()">Valider le paiement</button>
    </div>
  </div>
  <div id="paiement-overlay" class="overlay"></div>
  
  <div id="historique-modal" class="modal" style="width: 80%; max-width: 800px;">
    <h3>Historique du prêt</h3>
    <table id="table-historique">
      <thead>
        <tr>
          <th>Date</th>
          <th>Description</th>
        </tr>
      </thead>
      <tbody></tbody>
    </table>
    <div class="modal-actions">
      <button class="secondary" onclick="fermerHistoriqueModal()">Fermer</button>
    </div>
  </div>
  <div id="historique-overlay" class="overlay"></div>

  <script>
    // API Configuration
    const apiBase = "http://localhost/ETU003210/ws";
    
    function ajax(method, url, data, callback) {
      const xhr = new XMLHttpRequest();
      xhr.open(method, apiBase + url, true);
      xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
      xhr.onreadystatechange = () => {
        if (xhr.readyState === 4) {
          if (xhr.status === 200) {
            callback(JSON.parse(xhr.responseText));
          } else {
            console.error('Error:', xhr.status, xhr.statusText);
            alert('Une erreur est survenue: ' + xhr.statusText);
          }
        }
      };
      xhr.send(data);
    }
    
    function showSection(section) {
      document.querySelectorAll('.tab-btn').forEach(btn => {
        btn.classList.remove('active');
      });
      document.querySelector(`.tab-btn[onclick="showSection('${section}')"]`).classList.add('active');
      
      document.querySelectorAll('.section').forEach(sec => {
        sec.classList.remove('active');
      });
      document.getElementById(section + '-section').classList.add('active');
      
      if(section === 'prets') chargerPrets();
      if(section === 'clients') chargerClients();
    }
    
    function chargerPrets() {
      chargerSelectClients();
      chargerSelectTypesPret();
    
      ajax("GET", "/prets", null, (data) => {
        const tbody = document.querySelector("#table-prets tbody");
        tbody.innerHTML = "";
        data.forEach(p => {
          const tr = document.createElement("tr");
          tr.innerHTML = `
            <td>${p.id_pret}</td>
            <td>${p.client_nom}</td>
            <td>${p.type_pret_nom} (${p.taux_interet}%)</td>
            <td>${p.montant.toLocaleString()} €</td>
            <td>${p.statut}</td>
            <td>
              <button onclick='editerPret(${JSON.stringify(p)})'>Éditer</button>
              <button onclick='afficherPaiementPret(${p.id_pret}, ${p.id_client})'>Payer</button>
              <button onclick='afficherHistoriquePret(${p.id_pret})'>Historique</button>
            </td>
          `;
          tbody.appendChild(tr);
        });
      });
    }
    
    function chargerSelectClients() {
      ajax("GET", "/clients", null, (data) => {
        const select = document.getElementById("pret-client");
        select.innerHTML = '<option value="">Sélectionner un client</option>';
        data.forEach(c => {
          const option = document.createElement("option");
          option.value = c.id_client;
          option.textContent = `${c.nom} (${c.email})`;
          select.appendChild(option);
        });
      });
    }
    
    function chargerSelectTypesPret() {
      ajax("GET", "/types_pret", null, (data) => {
        const select = document.getElementById("pret-type");
        select.innerHTML = '<option value="">Sélectionner un type</option>';
        data.forEach(t => {
          const option = document.createElement("option");
          option.value = t.id_type_pret;
          option.textContent = `${t.nom_type} (${t.taux_interet}%)`;
          select.appendChild(option);
        });
      });
    }
    
    function gererPret() {
      const id = document.getElementById("pret-id").value;
      const data = new URLSearchParams();
      
      data.append('id_client', document.getElementById("pret-client").value);
      data.append('id_type_pret', document.getElementById("pret-type").value);
      data.append('montant', document.getElementById("pret-montant").value);
      data.append('duree_mois', document.getElementById("pret-duree").value);
    
      if (id) {
        ajax("PUT", `/prets/${id}`, data, () => {
          resetFormPret();
          chargerPrets();
        });
      } else {
        ajax("POST", "/prets", data, (response) => {
          resetFormPret();
          chargerPrets();
        });
      }
    }
    
    function changerStatutPret() {
      const id = document.getElementById("pret-id-statut").value;
      const statut = document.getElementById("pret-statut").value;
      
      if(id) {
        ajax("PUT", `/prets/${id}/status`, `statut=${statut}`, () => {
          document.getElementById("pret-id-statut").value = "";
          chargerPrets();
        });
      }
    }
    
    function editerPret(p) {
      document.getElementById("pret-id").value = p.id_pret;
      document.getElementById("pret-client").value = p.id_client;
      document.getElementById("pret-type").value = p.id_type_pret;
      document.getElementById("pret-montant").value = p.montant;
      document.getElementById("pret-duree").value = p.duree_mois;
      document.getElementById("pret-id-statut").value = p.id_pret;
      document.getElementById("pret-statut").value = p.statut;
      
      document.querySelector('.form-container').scrollIntoView({ behavior: 'smooth' });
    }
    
    function resetFormPret() {
      document.getElementById("pret-id").value = "";
      document.getElementById("pret-client").value = "";
      document.getElementById("pret-type").value = "";
      document.getElementById("pret-montant").value = "";
      document.getElementById("pret-duree").value = "";
    }
    
    function chargerClients() {
      ajax("GET", "/clients", null, (data) => {
        const tbody = document.querySelector("#table-clients tbody");
        tbody.innerHTML = "";
        data.forEach(c => {
          const tr = document.createElement("tr");
          tr.innerHTML = `
            <td>${c.id_client}</td>
            <td>${c.nom}</td>
            <td>${c.email}</td>
            <td>${c.telephone || '-'}</td>
            <td>
              <button onclick='editerClient(${JSON.stringify(c)})'>Éditer</button>
              <button class="danger" onclick='supprimerClient(${c.id_client})'>Supprimer</button>
            </td>
          `;
          tbody.appendChild(tr);
        });
      });
    }
    
    function gererClient() {
      const id = document.getElementById("client-id").value;
      const data = new URLSearchParams();
      
      data.append('nom', document.getElementById("client-nom").value);
      data.append('email', document.getElementById("client-email").value);
      data.append('mdp', document.getElementById("client-mdp").value);
      data.append('telephone', document.getElementById("client-tel").value);
      data.append('date_naissance', document.getElementById("client-naissance").value);
    
      if (id) {
        ajax("PUT", `/clients/${id}`, data, () => {
          resetFormClient();
          chargerClients();
        });
      } else {
        ajax("POST", "/clients", data, () => {
          resetFormClient();
          chargerClients();
        });
      }
    }
    
    function editerClient(c) {
      document.getElementById("client-id").value = c.id_client;
      document.getElementById("client-nom").value = c.nom;
      document.getElementById("client-email").value = c.email;
      document.getElementById("client-mdp").value = c.mdp;
      document.getElementById("client-tel").value = c.telephone;
      document.getElementById("client-naissance").value = c.date_naissance;
      
      document.querySelector('.form-container').scrollIntoView({ behavior: 'smooth' });
    }
    
    function supprimerClient(id) {
      if (confirm("Êtes-vous sûr de vouloir supprimer ce client ?")) {
        ajax("DELETE", `/clients/${id}`, null, () => {
          chargerClients();
        });
      }
    }
    
    function resetFormClient() {
      document.getElementById("client-id").value = "";
      document.getElementById("client-nom").value = "";
      document.getElementById("client-email").value = "";
      document.getElementById("client-mdp").value = "";
      document.getElementById("client-tel").value = "";
      document.getElementById("client-naissance").value = "";
    }
    
    function afficherPaiementPret(idPret, idClient) {
      document.getElementById('paiement-pret-id').value = idPret;
      document.getElementById('paiement-client-id').value = idClient;
      document.getElementById('paiement-montant').value = "";
      document.getElementById('paiement-modal').style.display = 'block';
      document.getElementById('paiement-overlay').style.display = 'block';
    }
    
    function fermerPaiementModal() {
      document.getElementById('paiement-modal').style.display = 'none';
      document.getElementById('paiement-overlay').style.display = 'none';
    }
    
    function effectuerPaiement() {
      const idPret = document.getElementById('paiement-pret-id').value;
      const idClient = document.getElementById('paiement-client-id').value;
      const montant = document.getElementById('paiement-montant').value;
      
      if (!montant || montant <= 0) {
        alert("Veuillez saisir un montant valide.");
        return;
      }
      
      const data = `montant_paye=${montant}&id_client=${idClient}`;
      ajax("POST", `/prets/${idPret}/paiements`, data, (response) => {
        alert(response.message);
        fermerPaiementModal();
        chargerPrets();
      });
    }
    
    function afficherHistoriquePret(idPret) {
      ajax("GET", `/prets/${idPret}/historique`, null, (data) => {
        const tbody = document.querySelector("#table-historique tbody");
        tbody.innerHTML = "";
        data.forEach(h => {
          const tr = document.createElement("tr");
          tr.innerHTML = `
            <td>${new Date(h.date_action).toLocaleString()}</td>
            <td>${h.description}</td>
          `;
          tbody.appendChild(tr);
        });
        document.getElementById('historique-modal').style.display = 'block';
        document.getElementById('historique-overlay').style.display = 'block';
      });
    }
    
    function fermerHistoriqueModal() {
      document.getElementById('historique-modal').style.display = 'none';
      document.getElementById('historique-overlay').style.display = 'none';
    }
    
    document.addEventListener('DOMContentLoaded', function() {
      showSection('prets');
      
      document.getElementById('paiement-overlay').addEventListener('click', fermerPaiementModal);
      document.getElementById('historique-overlay').addEventListener('click', fermerHistoriqueModal);
    });
  </script>
</body>
</html> -->