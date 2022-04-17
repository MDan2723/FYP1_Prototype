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
        let baseurl = window.location.origin;
        if(postToggle){
            postMaker.innerHTML = 
            `<div class="main">
                <form method='POST' action='`+baseurl+`/includes/forum'>
                    <input type='text' id='in_title' name='title' placeholder='Insert title here' required>
                    <br>
                    <textarea class='forum-textarea' id="in_description" name='desc' placeholder='insert description here' required></textarea>
                    <input type='submit' class='forum-btn' name='submit' value='post thread'/>
                </form>
            </div>
            `;
        }
        else{
            postMaker.innerHTML = "";
        }
    }
}