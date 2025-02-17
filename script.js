const API_Button = document.getElementById('API_button');
const API_Data = document.getElementById('API_data');
const API_pokeName = document.getElementById('API_pokeName');
const API_PokeImage = document.getElementById('API_PokeImage');
const API_PokeDescription = document.createElement('p'); // Nuevo elemento para la descripción
document.body.appendChild(API_PokeDescription); // Agregar el elemento al cuerpo del HTML

const callAPI = () => {
    // Generar un ID aleatorio entre 1 y 898 (rango de Pokémon en la API)
    const randomId = Math.floor(Math.random() * 898) + 1;

    // Llamar a la API con el ID aleatorio
    fetch(`https://pokeapi.co/api/v2/pokemon/${randomId}`)
        .then(res => res.json())
        .then(data => {
            console.log(data);

            // Mostrar el ID y la experiencia base
            API_Data.innerText = `ID: ${data.id} | Experiencia base: ${data.base_experience}`;

            // Mostrar el nombre del Pokémon
            API_pokeName.innerText = `Pokémon: ${data.name}`;

            // Mostrar la imagen del Pokémon (sprite frontal por defecto)
            API_PokeImage.src = data.sprites.front_default;
            API_PokeImage.alt = `Imagen de ${data.name}`;

            // Obtener la especie del Pokémon para la descripción de la Pokédex
            return fetch(data.species.url);
        })
        .then(res => res.json())
        .then(speciesData => {
            // Buscar la descripción en inglés (puedes cambiar el idioma si lo prefieres)
            const description = speciesData.flavor_text_entries.find(
                entry => entry.language.name === 'es' // Cambia 'es' por 'en' si prefieres inglés
            );

            // Mostrar la descripción de la Pokédex
            if (description) {
                API_PokeDescription.innerText = `Descripción: ${description.flavor_text}`;
            } else {
                API_PokeDescription.innerText = 'Descripción no disponible.';
            }
        })
        .catch(e => console.error(new Error(e)));
}

// Agregar el evento al botón
API_Button.addEventListener('click', callAPI);