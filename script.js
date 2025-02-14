const items = document.getElementById('items');
const templateCard = document.getElementById('template-card').content;
const fragmento = document.createDocumentFragment();

document.addEventListener('DOMContentLoaded', () => {
    fetchData();
});

const fetchData = async () => {
    try {
        const res = await fetch('api.json');
        const data = await res.json();
        console.log(data);
        mostrarProductos(data);
    } catch (error) {
        console.log(error);
    }
}

const mostrarProductos = data => {
    data.forEach(producto => {
        // Clonar el template
        const clone = templateCard.cloneNode(true);

        // Actualizar el contenido del clon
        clone.querySelector('h3').textContent = `Agente ${producto.id}`;
        clone.querySelector('h4').textContent = `${producto.nombre}`;
        clone.querySelector('p').textContent = `${producto.rol}`; // Aquí puedes agregar el rol si lo tienes en el JSON
        clone.querySelector('img').setAttribute("src", producto.imgUrl);
        clone.querySelector('img').setAttribute("alt", `Agente ${producto.id}`);

        // Agregar el clon al fragmento
        fragmento.appendChild(clone);
    });

    // Agregar el fragmento al DOM
    items.appendChild(fragmento);
}