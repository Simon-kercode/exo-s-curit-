var articlesElt = document.getElementById("articles");
//Ajax Get chat.json ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
ajaxGet("src/Public/js/chat.json", function (reponse) {
    var articles = JSON.parse(reponse);
    Chat.init();
});

//Integration Chat Object +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
var Chat = {
    init : function(){
        document.getElementById("articles").innerHTML="";
        for(i=0;i<articles.length;i++) {
            //Build ++++++++++++++++++++++++++++++++++++++
            var cardElt = document.createElement("div");
            cardElt.setAttribute("class","card cardComment");
            
            //Integration ++++++++++++++++++++++++++++++++
            articlesElt.appendChild(cardElt);
        }
    }
}