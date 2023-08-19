document.addEventListener("DOMContentLoaded", function () {
  // Mengambil data menggunakan fetch
  fetch("./services/read_data.php")
    .then((response) => response.json())
    .then((data) => displayCard(data))
    .catch((error) => console.error("Error fetching data:", error));
});

function displayCard(data_news) {
  const cardId = document.getElementById("cardNews");

  for (let i = 0; i < 6; i++) {
    const card = document.createElement("div");
    card.classList.add(
      "max-w-md",
      "mx-auto",
      "bg-white",
      "shadow-md",
      "rounded-md",
      "p-6",
      "card",
      "hover:scale-105",
      "ease-out",
      "duration-300",
      "my-5"
    );

    const imageCard = document.createElement("img");
    imageCard.classList.add("mb-4");
    imageCard.src = "./images/" + data_news[i].images;

    const titleNews = document.createElement("h2");
    titleNews.classList.add("text-xl", "font-semibold", "mb-2");
    titleNews.textContent = data_news[i].news_title;

    const contentNews = document.createElement("p");
    contentNews.classList.add("text-gray-600", "mb-4");
    contentNews.textContent = data_news[i].news_content;

    const datetNews = document.createElement("p");
    datetNews.classList.add("text-sm", "text-gray-500");
    datetNews.textContent = data_news[i].news_update.toString();

    const readAll = document.createElement("a");
    readAll.classList.add(
      "text-blue-500",
      "hover:underline",
      "mt-2",
      "inline-block",
      "cursor-pointer"
    );
    readAll.textContent = "Lihat Selengkpnya";

    card.appendChild(imageCard);
    card.appendChild(titleNews);
    card.appendChild(contentNews);
    card.appendChild(datetNews);
    card.appendChild(readAll);

    cardId.appendChild(card);
  }
};
