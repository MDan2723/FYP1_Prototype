// console.log(threads);
// var container = document.querySelector('ol');
// for (let thread of threads) {
//     var html = `
//     <li class="row">
//         <a href="thread.html?${thread.id}">
//             <h4 class="title">
//                 ${thread.title}
//             </h4>
//             <div class="bottom">
//                 <p class="timestamp">
//                     ${new Date(thread.date).toLocaleString()}
//                 </p>
//                 <p class="comment-count">
//                     ${thread.comments.length} comments
//                 </p>
//             </div>
//         </a>
//     </li>
//     `
//     container.insertAdjacentHTML('beforeend', html);
// }


// post-maker button toggle
let makePostBtn = document.querySelector("#make-post-btn");
if(makePostBtn){
    let postMaker = document.querySelector("#post-maker");
    let postToggle = false;

    makePostBtn.onclick= function(){
        postToggle = !postToggle;
        if(postToggle){
            postMaker.innerHTML = `<div class="main">
            <hr>
            <input type='text' id='in_title' name='title' placeholder='Insert title here'>
            <br>
            <textarea class='forum-textarea' id="in_description" name='title' placeholder='insert description here'></textarea>
            <button class='forum-btn' id="btn_comment">submit your forum post</button>
            </div>
            `;
        }
        else{
            postMaker.innerHTML = "";
        }
    }
}