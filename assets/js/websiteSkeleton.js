//menutoggle
let toggle = document.querySelector(".toggle");
let navigation = document.querySelector(".navigation");
let main = document.querySelector(".main");
toggle.onclick = function () {
  navigation.classList.toggle("active");
  main.classList.toggle("active");
};

//add hovered class
let list = document.querySelectorAll(".navigation li");

function activelink() {
  list.forEach((item) => item.classList.remove("hovered"));
  this.classList.add("hovered");
}
list.forEach((item) => item.addEventListener("mouseover", activelink));

//for profile dropdown
let subMenu = document.getElementById("subMenu");

function toggleMenu() {
  subMenu.classList.toggle("open-menu");
  console.log("hello");
}

//for notification
let subMenu2 = document.getElementById("notifiWrap");

function testnoti() {
  subMenu2.classList.toggle("open-noti");
  console.log("hello1");
}
