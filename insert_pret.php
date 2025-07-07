<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nouveau Prêt - BMOI</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        bmoi: {
                            primary: '#4C1D95',
                            secondary: '#7C3AED',
                            light: '#8B5CF6',
                            accent: '#A78BFA',
                            promo: '#DDD6FE'
                        }
                    }
                }
            }
        }
    </script>
</head>
<body class="bg-gray-50 font-sans">
    <!-- Header and Navigation (unchanged) -->
    <header class="bg-bmoi-primary text-white shadow-lg">
        <div class="container mx-auto px-4 py-3 flex justify-between items-center">
            <div class="flex items-center space-x-2">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-bmoi-accent" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                <span class="text-2xl font-bold">BMOI</span>
            </div>
            <nav class="hidden md:flex space-x-6">
                <a href="#" class="hover:text-bmoi-accent transition duration-200 font-medium">Tableau de bord</a>
                <a href="#" class="hover:text-bmoi-accent transition duration-200 font-medium">Déconnexion</a>
            </nav>
        </div>
    </header>
    <nav class="bg-white shadow-md">
        <div class="container mx-auto px-4">
            <div class="flex space-x-6 py-3 overflow-x-auto">
                <a href="#" class="whitespace-nowrap px-3 py-2 text-gray-600 font-medium hover:text-bmoi-primary">Clients</a>
                <a href="insert_pret.php" class="whitespace-nowrap px-3 py-2 text-bmoi-primary font-medium border-b-2 border-bmoi-primary">Prêts</a>
                <a href="#" class="whitespace-nowrap px-3 py-2 text-gray-600 font-medium hover:text-bmoi-primary">Comptes</a>
                <a href="#" class="whitespace-nowrap px-3 py-2 text-gray-600 font-medium hover:text-bmoi-primary">Transactions</a>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <main class="container mx-auto px-4 py-8">
        <div class="max-w-4xl mx-auto">
            <div class="flex justify-between items-center mb-6">
                <h1 class="text-2xl font-bold text-bmoi-primary">Nouveau Prêt</h1>
                <a href="liste_prets.php" class="text-bmoi-secondary hover:text-bmoi-primary font-medium">← Retour à la liste</a>
            </div>

            <div class="bg-white rounded-lg shadow-md p-6">
                <form id="formPret" onsubmit="event.preventDefault(); ajouterPret();">
                    <!-- Section Client -->
                    <div class="mb-8">
                        <h2 class="text-lg font-semibold text-bmoi-primary mb-4 border-b pb-2">Informations Client</h2>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label for="id_client" class="block text-sm font-medium text-gray-700 mb-1">Client*</label>
                                <select id="id_client" name="id_client" required class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-bmoi-primary focus:border-bmoi-primary">
                                    <option value="">Sélectionner un client</option>
                                    <!-- Options populated via AJAX -->
                                </select>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Informations client</label>
                                <div id="clientInfo" class="p-2 bg-gray-50 rounded-md text-sm">
                                    Sélectionnez un client pour voir ses informations
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Section Prêt -->
                    <div class="mb-8">
                        <h2 class="text-lg font-semibold text-bmoi-primary mb-4 border-b pb-2">Détails du Prêt</h2>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label for="id_type_pret" class="block text-sm font-medium text-gray-700 mb-1">Type de prêt*</label>
                                <select id="id_type_pret" name="id_type_pret" required class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-bmoi-primary focus:border-bmoi-primary">
                                    <option value="">Sélectionner un type</option>
                                    <!-- Options populated via AJAX -->
                                </select>
                            </div>
                            <div>
                                <label for="montant" class="block text-sm font-medium text-gray-700 mb-1">Montant (Ar)*</label>
                                <input type="number" id="montant" name="montant" min="100000" step="10000" required class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-bmoi-primary focus:border-bmoi-primary">
                            </div>
                            <div>
                                <label for="taux_interet" class="block text-sm font-medium text-gray-700 mb-1">Taux d'intérêt (%)*</label>
                                <input type="number" id="taux_interet" name="taux_interet" min="0" max="100" step="0.01" required class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-bmoi-primary focus:border-bmoi-primary">
                            </div>
                            <div>
                                <label for="duree_mois" class="block text-sm font-medium text-gray-700 mb-1">Durée (mois)*</label>
                                <input type="number" id="duree_mois" name="duree_mois" min="6" max="360" required class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-bmoi-primary focus:border-bmoi-primary">
                            </div>
                            <div>
                                <label for="date_debut" class="block text-sm font-medium text-gray-700 mb-1">Date de début*</label>
                                <input type="date" id="date_debut" name="date_debut" required class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-bmoi-primary focus:border-bmoi-primary">
                            </div>
                            <div>
                                <label for="date_fin" class="block text-sm font-medium text-gray-700 mb-1">Date de fin estimée</label>
                                <input type="date" id="date_fin" name="date_fin" readonly class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm bg-gray-100">
                            </div>
                        </div>
                    </div>

                    <!-- Section Statut -->
                    <div class="mb-8">
                        <h2 class="text-lg font-semibold text-bmoi-primary mb-4 border-b pb-2">Statut du Prêt</h2>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label for="statut" class="block text-sm font-medium text-gray-700 mb-1">Statut*</label>
                                <select id="statut" name="statut" required class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-bmoi-primary focus:border-bmoi-primary">
                                    <option value="EN_ATTENTE" selected>En attente</option>
                                    <option value="APPROUVE">Approuvé</option>
                                    <option value="REJETE">Rejeté</option>
                                    <option value="ACTIF">Actif</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <!-- Boutons de soumission -->
                    <div class="flex justify-end space-x-4 pt-4 border-t">
                        <button type="reset" onclick="resetForm()" class="px-4 py-2 border border-gray-300 rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-bmoi-primary">
                            Annuler
                        </button>
                        <button type="submit" class="px-4 py-2 border border-transparent rounded-md shadow-sm text-white bg-bmoi-primary hover:bg-bmoi-secondary focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-bmoi-secondary">
                            Enregistrer le prêt
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </main>

  <script>
const apiBase = "http://localhost/ETU003210_affiche/ws";

    function ajax(method, url, data, callback) {
      const xhr = new XMLHttpRequest();
      xhr.open(method, apiBase + url, true);
      xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
      xhr.onreadystatechange = () => {
        if (xhr.readyState === 4 && xhr.status === 200) {
          callback(JSON.parse(xhr.responseText));
        }
      };
      xhr.send(data);
    }

    function chargerListesDeroulantes() {
        ajax("GET", "/clients", null, (data) => {
            const clientSelect = document.getElementById("id_client");
            clientSelect.innerHTML = '<option value="">Sélectionner un client</option>';
            data.forEach(client => {
                const option = document.createElement("option");
                option.value = client.id_client;
                option.textContent = client.nom;
                clientSelect.appendChild(option);
            });
        });

        ajax("GET", "/types_pret", null, (data) => {
            const typePretSelect = document.getElementById("id_type_pret");
            typePretSelect.innerHTML = '<option value="">Sélectionner un type</option>';
            data.forEach(type => {
                const option = document.createElement("option");
                option.value = type.id_type_pret;
                option.textContent = `${type.nom_type} (${type.taux_interet}%)`;
                option.dataset.taux = type.taux_interet;
                typePretSelect.appendChild(option);
            });
        });
    }

    function ajouterPret() {
        const id_client = document.getElementById("id_client").value;
        const id_type_pret = document.getElementById("id_type_pret").value;
        const montant = document.getElementById("montant").value;
        const taux_interet = document.getElementById("taux_interet").value;
        const duree_mois = document.getElementById("duree_mois").value;
        const date_debut = document.getElementById("date_debut").value;
        const date_fin = document.getElementById("date_fin").value;
        const statut = document.getElementById("statut").value;

        if (!id_client || !id_type_pret || !montant || !taux_interet || !duree_mois || !date_debut || !statut) {
            alert("Veuillez remplir tous les champs obligatoires.");
            return;
        }

        const data = `id_client=${encodeURIComponent(id_client)}&id_type_pret=${encodeURIComponent(id_type_pret)}&montant=${encodeURIComponent(montant)}&taux_interet=${encodeURIComponent(taux_interet)}&duree_mois=${encodeURIComponent(duree_mois)}&date_debut=${encodeURIComponent(date_debut)}&date_fin=${encodeURIComponent(date_fin)}&statut=${encodeURIComponent(statut)}`;

        ajax("POST", "/prets", data, (response) => {
            resetForm();
            alert(response.message || "Prêt créé avec succès !");
            window.location.href = "liste_prets.php";
        });
    }

    function resetForm() {
        document.getElementById("formPret").reset();
        document.getElementById("clientInfo").textContent = "Sélectionnez un client pour voir ses informations";
        document.getElementById("date_fin").value = "";
    }

    document.getElementById("date_debut").addEventListener("change", function() {
        const duree = parseInt(document.getElementById("duree_mois").value) || 0;
        if (duree > 0 && this.value) {
            const dateDebut = new Date(this.value);
            dateDebut.setMonth(dateDebut.getMonth() + duree);
            const dateFin = dateDebut.toISOString().split("T")[0];
            document.getElementById("date_fin").value = dateFin;
        }
    });

    document.getElementById("duree_mois").addEventListener("change", function() {
        const dateDebut = document.getElementById("date_debut").value;
        if (dateDebut) {
            document.getElementById("date_debut").dispatchEvent(new Event("change"));
        }
    });

    document.getElementById("id_type_pret").addEventListener("change", function() {
        const selectedOption = this.options[this.selectedIndex];
        if (selectedOption && selectedOption.dataset.taux) {
            document.getElementById("taux_interet").value = selectedOption.dataset.taux;
        }
    });

    chargerListesDeroulantes();
    document.addEventListener("DOMContentLoaded", chargerListesDeroulantes);

    document.getElementById("id_client").addEventListener("change", function() {
        if (this.value) {
            document.getElementById("clientInfo").textContent = `Chargement des informations du client ID: ${this.value}...`;
            ajax("GET", `/clients/${this.value}`, null, (client) => {
                if (client.error) {
                    document.getElementById("clientInfo").textContent = client.error;
                } else {
                    document.getElementById("clientInfo").innerHTML = `
                        <p><strong>Nom:</strong> ${client.nom}</p>
                        <p><strong>Email:</strong> ${client.email || "N/A"}</p>
                        <p><strong>Téléphone:</strong> ${client.telephone || "N/A"}</p>
                        <p><strong>Date de naissance:</strong> ${client.date_naissance || "N/A"}</p>
                    `;
                }
            });
        } else {
            document.getElementById("clientInfo").textContent = "Sélectionnez un client pour voir ses informations";
        }
    });


</script>
</body>
</html>