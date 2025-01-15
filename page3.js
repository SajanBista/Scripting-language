const selectAgeButton = document.getElementById('select-age');
const toyDisplay = document.getElementById('toy-display');

selectAgeButton.addEventListener('click', () => {
    const selectedAge = document.querySelector('input[name="age"]:checked').value;

    // Fetch toy data based on the selected age
    fetch(`https://api.yourtoydata.com/toys/${selectedAge}`)
        .then(response => response.json())
        .then(data => {
            toyDisplay.style.display = 'block';
            toyDisplay.innerHTML = '';

            data.forEach(toy => {
                const toyCard = document.createElement('div');
                toyCard.classList.add('toy-card');

                toyCard.innerHTML = `
                    <img class="toy-image" src="${toy.image}">
                    <p class="toy-name">${toy.name}</p>
                    <p class="toy-price">$${toy.price}</p>
                    <p class="toy-rating">Rating: ${toy.rating}</p>
                    <button class="add-to-cart">Add to Cart</button>
                `;

                toyDisplay.appendChild(toyCard);
            });
        });
});