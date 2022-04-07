let sidebar = document.querySelector(".sidebar");

let menuBtn = document.querySelector("#menu-btn");
let searchBtn = document.querySelector(".bx-search");
let userBtn = document.querySelector("#loggings");
let logoutBtn = document.querySelector("#logout-btn");

menuBtn.onclick= function(){
    sidebar.classList.toggle("active");
}
searchBtn.onclick= function(){
    sidebar.classList.toggle("active");
}
userBtn.onclick= function(){
    sidebar.classList.toggle("active");
}
if(logoutBtn){
    logoutBtn.onclick= function(){
        if ( window.confirm('Are you sure you want to logout?') ){
            window.location.href= "/user/logout";
        };
    }

}

