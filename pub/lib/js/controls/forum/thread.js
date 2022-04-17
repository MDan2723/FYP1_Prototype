// console.log("THREADING");

// var id = window.location.search.slice(1);
var header = document.querySelector('.header');
var queryString = window.location.search;
let urlParams = new URLSearchParams(queryString);
let id = urlParams.get('id');


// comment button toggle
let makeCommentBtn = document.querySelector("#make-comment-btn");
if(makeCommentBtn){
    let commentMaker = document.querySelector("#comment-maker");
    let commentToggle = false;

    makeCommentBtn.onclick= function(){
        let baseurl = window.location.origin;
        commentToggle = !commentToggle;
        if(commentToggle){
            commentMaker.innerHTML =
                `<div class="main">
                    <form method='POST' action='`+baseurl+`/includes/forum'>
                        <input name="thread_id" value="`+id+`" hidden/>
                        <textarea class='forum-textarea' name="desc"></textarea>
                        <input type='submit' class='forum-btn' name='submit' value='post comment'/>
                    </form>
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

function deletePost(type,id){
    let baseurl = window.location.origin;
    let rateRequest = new XMLHttpRequest();

    switch(type){
        case 'thread':
            if ( window.confirm('Are you sure you want to delete this thread?') ){
                rateRequest.open('POST',baseurl+'/includes/deletePost?type='+type+'&id='+id);
                rateRequest.send();
                window.location.href= "/forum";
            };
            break;
        case 'comment':
            if ( window.confirm('Are you sure you want to delete this comment?') ){
                rateRequest.open('POST',baseurl+'/includes/deletePost?type='+type+'&id='+id);
                rateRequest.send();
                window.location.reload()
            };
            break;
    }
    
}