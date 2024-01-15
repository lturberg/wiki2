document.addEventListener('DOMContentLoaded', function () {
    var motInput = document.getElementById('mot');
    var suggestionsContainer = document.getElementById('suggestionsContainer');

    motInput.addEventListener('input', function () {
        var inputText = motInput.value;
        if (inputText.length >= 1) {
            // Créer une requête HTTP
            var xhr = new XMLHttpRequest();
            xhr.open('POST', 'modele/suggestion.php', true);
            xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

            // Gérer la réponse de la requête
            xhr.onreadystatechange = function () {
                if (xhr.readyState == 4 && xhr.status == 200) {
                    displaySuggestions(xhr.responseText);
                }
            };

            // Envoyer la requête avec les données du formulaire
            xhr.send('mot=' + encodeURIComponent(inputText));
        } else {
            // Réinitialiser le contenu des suggestions lorsque la longueur du texte est insuffisante
            suggestionsContainer.innerHTML = '';
        }
    });

    function displaySuggestions(suggestionsText) {
        suggestionsContainer.innerHTML = '';

        try {
            // Analyser le texte JSON
            var suggestions = JSON.parse(suggestionsText);

            if (suggestions.length > 0) {
                // Afficher chaque suggestion sous la barre de recherche
                suggestions.forEach(function (suggestion) {
                    var p = document.createElement('p');
                    p.textContent = suggestion.libelle;

                    // Ajouter la classe et le style au p
                    p.classList.add('suggestion-item');
                    p.style.cursor = 'pointer'; // Ajouter le curseur pointer pour indiquer que c'est cliquable

                    // Ajouter le style au survol du p
                    p.addEventListener('mouseover', function () {
                        p.style.backgroundColor = '#00000037'; // Changer la couleur au survol
                    });

                    // Remettre la couleur initiale lorsque le survol se termine
                    p.addEventListener('mouseout', function () {
                        p.style.backgroundColor = '';
                    });

                    p.addEventListener('click', function () {
                        // Mettre la suggestion sélectionnée dans le champ de recherche
                        motInput.value = suggestion.libelle;
                        // Réinitialiser les suggestions
                        suggestionsContainer.innerHTML = '';
                    });

                    suggestionsContainer.appendChild(p);
                });
            } else {
                // Aucune suggestion trouvée
                var p = document.createElement('p');
                p.textContent = 'Aucune suggestion trouvée.';
                suggestionsContainer.appendChild(p);
            }
        } catch (error) {
            console.error('Erreur lors de l\'analyse JSON :', error);
        }
    }
});
