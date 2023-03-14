$(document).ready(function () {
    $('form').submit(function (e) {
        e.preventDefault()

        const password = $(".password").val()
        const cpassword = $(".cpassword").val()

        if(password == cpassword){
            $.ajax({
                url: 'php/register.php',
                type: 'POST',
                data: $('form').serialize(),
                beforeSend: function () {
                    $('.submit').val('Loading...')
                },
                success: function (res) {
                    if (res == "Registration Successfully") {
                        alert(res)
                        $('form')[0].reset()
                        window.location = 'login.html'
                    }
                    else {
                        alert(res)
                    }
                }
            })
        }
        else{
            alert("Confirm Password Not Matched")
        }
    })
})