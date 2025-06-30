function displayArtistInfo() {
    let selectedYear = document.getElementById("year").value;
    let selectedGenre = document.querySelector('input[name="Genre"]:checked');
    let selectedCountry = document.getElementById("country").value;

    if (!selectedGenre) {
        alert("Выберите жанр музыки!");
        return;
    }
    selectedGenre = selectedGenre.value.trim().toLowerCase();

    let apiUrl = `http://localhost/music-site/artist_info.php?year=${encodeURIComponent(selectedYear)}&genre=${encodeURIComponent(selectedGenre)}&country=${encodeURIComponent(selectedCountry)}`;
    
    console.log("Отправляем запрос:", apiUrl);

    fetch(apiUrl)
        .then(response => response.json())
        .then(data => {
            console.log("Ответ от сервера:", data);

            if (data.error) {
                alert("❌ Музыкант не найден!");
            } else {
                let url = `artists.html?name=${encodeURIComponent(data.name)}&year=${encodeURIComponent(data.year)}&genre=${encodeURIComponent(data.genre)}&country=${encodeURIComponent(data.country)}&album=${encodeURIComponent(data.album)}&top_song=${encodeURIComponent(data.top_song)}&awards=${encodeURIComponent(data.awards)}&biography=${encodeURIComponent(data.biography)}&image=${encodeURIComponent(data.image)}`;
                console.log("Переход на страницу:", url);
                window.location.href = url;
            }
        })
        .catch(error => {
            console.error("Ошибка при запросе:", error);
            alert("❌ Ошибка соединения с сервером! Проверь XAMPP и artist_info.php.");
        });
}

// Добавляем обработчик события
document.addEventListener("DOMContentLoaded", function () {
    document.getElementById("musicForm").addEventListener("submit", function (event) {
        event.preventDefault();
        displayArtistInfo();
    });
});
