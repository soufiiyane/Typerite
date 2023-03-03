const btnLogin = document.querySelector(".login-btn");
const email = document.querySelector(".emailInput");
const password = document.querySelector(".passwordInput");
btnLogin.addEventListener("click",(c)=>{
    c.preventDefault();
    $.ajax({
        url:"ajaxCall/authentication/loginCall.php",
        type:"POST",
        data:{
            email: email.value,
            password: password.value
        },
        success: function(data,status){
            if(status){
                if(data){

                }
            }
        }
    })
})