var countdown=60; 
    function settime(val) { 
    if (countdown == 0) { 
    val.removeAttribute("disabled");    
    val.value="点击获取"; 
    countdown = 60; 
    } else { 
    val.setAttribute("disabled", true); 
    val.value="重新发送(" + countdown + ")"; 
    countdown--; 
    } 
    setTimeout(function() { 
    settime(val) 
    },1000) 
    } 