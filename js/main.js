function onBackHistory(){
    window.history.go(-1);
}
$(document).ready(function(){
   $(".back").on("click", onBackHistory); 
});
