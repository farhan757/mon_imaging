$(function() //right click disabled
{
    $(this).bind('contextmenu',function()
    {
        alert("Function disabled");
        return false;
    })
});

function copyToClipboard() {
  var aux=document.createElement("input");
  aux.setAttribute("value","Function Disabled.....");
  document.body.appendChild(aux);
  aux.select();
  document.execCommand("copy");
  document.body.removeChild(aux);
  alert("Print screen disabled.");
}

function blockPrint() {
  alert("Print is not allowed...");
}

 function PreSaveAction() { 
    alert("saving..");
 }

$(function()
{
    $(this).keyup(function(e){
      if(e.keyCode==44 || e.keyCode==137 ||e.KeyCode==93 )
      //100 Save 137 SHift F10 93 RightClick 44 PrintScreen
      {
        copyToClipboard();
        return false;
      }
    })
}); 

//disable Ctrl + keys
document.onkeydown=function (e) {
    e=e || window.event;//Get event
    if (e.ctrlKey) {
        var c=e.which || e.keyCode;//Get key code
        switch (c) {
            case 83://Block Ctrl+S
            case 80 : //block Ctrl+P
            case 17 : //block Ctrl
            case 16 : //block Shift
                e.preventDefault();     
                e.stopPropagation();
                alert("key disabled");
            break;
        }
    }
};


$(window).focus(function() {
  $("body").show();
}).blur(function() {
  $("body").show();
});

function setClipBoardData(){ //override system function -make clipBoard null always
    setInterval("window.clipboardData.setData('text','')",20);
}
function blockError(){
    window.location.reload(true);
    return true;
} 