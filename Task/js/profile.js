$(document).ready(function () {
    const user = JSON.parse(window.localStorage.getItem("user"))
    if (!user) {
        window.location = 'login.html'
    }
    else {
        $(".username").html(`User Name: ${user.username}`);
        $(".email").html(`Email: ${user.email}`)
        $(".phonenumber").val(user.phonenumber)
       

        $(".edit").click(function () {
            $(".submit").removeClass("d-none")
            $(".form-control").removeAttr("readonly")
            $(".form-control").attr("required")
        })

        $('form').submit(function (e) {
            e.preventDefault()

            $.ajax({
                url: 'php/profile.php',
                type: 'POST',
                data: $('form').serialize() + "&username=" + user.username,
                success: function (res) {
                    alert(res)
                    localStorage.clear()
                    location = "login.html"
                }
            })
        })
    }
})