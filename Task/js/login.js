$(document).ready(function () {
    $('form').submit(function (e) {
        e.preventDefault()

        $.ajax({
            url: 'php/login.php',
            type: 'POST',
            data: $('form').serialize(),
            beforeSend: function () {
                $('.submit').val('Loading...')
            },
            success: function (res) {
                res = JSON.parse(res)
                if (res.status) {
                    const { dbuser } = res
                    window.localStorage.setItem('user', JSON.stringify({ "username": res.username, "email": res.email, "phonenumber": dbuser.phonenumber}))
                    $('form')[0].reset()
                    window.location = 'profile.html'
                }
                else {
                    alert(res.error)
                }
            }
        })

    })
})