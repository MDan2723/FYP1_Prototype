let sidebar = document.querySelector(".sidebar");

let btn = document.querySelector("#btn");
let searchBtn = document.querySelector(".bx-search");
let userBtn = document.querySelector("#loggings");

btn.onclick= function(){
    sidebar.classList.toggle("active");
}
searchBtn.onclick= function(){
    sidebar.classList.toggle("active");
}
userBtn.onclick= function(){
    sidebar.classList.toggle("active");
}