// console.log("THREADING");

var id = window.location.search.slice(1);
var header = document.querySelector('.header');



// comment button toggle
let makeCommentBtn = document.querySelector("#make-comment-btn");
if(makeCommentBtn){
    let commentMaker = document.querySelector("#comment-maker");
    let commentToggle = false;

    makeCommentBtn.onclick= function(){
        commentToggle = !commentToggle;
        if(commentToggle){
            commentMaker.innerHTML = `<div class="main">
            <textarea class='forum-textarea' id="in_comment"></textarea>
            <button class='forum-btn' id="btn_comment">add comment</button>
            </div>`;
        }
        else{
            commentMaker.innerHTML = "";
        }
    }
}

// --------- rating ---------
function makeRating( type,id ){
    let baseurl = window.location.origin;
    let rateRequest = new XMLHttpRequest();

    rateRequest.open('POST',baseurl+'/includes/rating?type='+type+'&id='+id);
    rateRequest.send();
    window.location.reload()
}
