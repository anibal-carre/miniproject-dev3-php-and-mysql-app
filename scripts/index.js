const menuImg = document.getElementById("menu-img");
const optionsList = document.getElementById("options-list");

menuImg.addEventListener("click", function () {
  optionsList.style.display =
    optionsList.style.display === "block" ? "none" : "block";
});
