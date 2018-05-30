var chatArray = [];
//Ajax Get chat.json ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++   
ajaxGet("src/Public/js/chat.json", function (reponse) {
    var articles = JSON.parse(reponse);
    // Retranscription des données ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
    articles.forEach(function (article) {
        // Mise en place d'un tableau de station
        chatArray.push(article);
    });
    
    Chat.init();
});
//Integration Chat Object +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
var Chat = {
    init : function(){
        document.getElementById("articles").innerHTML="";
        for(i=0;i<chatArray.length;i++) {
            //Build ++++++++++++++++++++++++++++++++++++++
            var cardCommentElt = document.createElement("div");
            cardCommentElt.setAttribute("id","cardComment"+i);
            cardCommentElt.setAttribute("class","card cardComment");

            var cardHeaderElt = document.createElement("div");
            cardHeaderElt.setAttribute("id","cardHeader"+i);
            cardHeaderElt.setAttribute("class","card-header");

            var navbarBrandElt = document.createElement("a");
            navbarBrandElt.setAttribute("id","navbarBrand"+i);
            navbarBrandElt.setAttribute("href","#");
            navbarBrandElt.setAttribute("class","navbar-brand");

            var imageCardElt = document.createElement("img");
            imageCardElt.setAttribute("src","src/Public/images/"+chatArray[i].Avatar);
            imageCardElt.setAttribute("width","40");
            imageCardElt.setAttribute("height","40");
            imageCardElt.setAttribute("class","d-inline-block align-top");
            imageCardElt.setAttribute("alt","avatar");            
           
            var pseudoCardElt = document.createElement("p");
            pseudoCardElt.textContent = chatArray[i].Pseudo;

            var cardBodyElt = document.createElement("div");
            cardBodyElt.setAttribute("id","cardBody"+i);
            cardBodyElt.setAttribute("class","card-body");

            var cardTitleElt = document.createElement("h5");
            cardTitleElt.setAttribute("class","card-title");
            cardTitleElt.textContent = chatArray[i].ContentChat;

            var cardFooterElt = document.createElement("div");
            cardFooterElt.setAttribute("class","card-footer text-muted");
            cardFooterElt.textContent = chatArray[i].Date;
            
            //Integration ++++++++++++++++++++++++++++++++
            var articlesElt = document.getElementById("articles");
            articlesElt.appendChild(cardCommentElt);
            
            var articlesCardCommentElt = document.getElementById("cardComment"+i);
            articlesCardCommentElt.appendChild(cardHeaderElt);
            articlesCardCommentElt.appendChild(cardBodyElt);
            articlesCardCommentElt.appendChild(cardFooterElt);

            var articlesCardHeaderElt = document.getElementById("cardHeader"+i);
            articlesCardHeaderElt.appendChild(navbarBrandElt);

            var articlesNavbarBrandElt = document.getElementById("navbarBrand"+i);
            articlesNavbarBrandElt.appendChild(imageCardElt);
            articlesNavbarBrandElt.appendChild(pseudoCardElt);

            var articlesCardBodyElt = document.getElementById("cardBody"+i);
            articlesCardBodyElt.appendChild(cardTitleElt);
        }
    }
}