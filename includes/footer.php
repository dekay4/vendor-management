<div class="footer" style="padding-left: <?php echo $vechicle_swap; ?>">
    <div class="copyright">
    </div>
</div>

<script>
    function setCookie(cname, cvalue, exdays) {
        const d = new Date();
        d.setTime(d.getTime() + (exdays * 24 * 60 * 60 * 1000));
        let expires = "expires=" + d.toUTCString();
        document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";
    }

    setInterval(function() {

        var panel_api_key = getCookie('api_key');
        var expiryDate = getCookie('expiryDate');

        if (panel_api_key === "") {
            window.location.href = '../login?logout=1';
        }


        // if(expiryDate==="expired"){

        //     window.location.href = '../dashboard/';
        // }

    }, 1000);


    function getCookie(cname) {
        var name = cname + "=";
        var decodedCookie = decodeURIComponent(document.cookie);
        var ca = decodedCookie.split(';');
        for (var i = 0; i < ca.length; i++) {
            var c = ca[i];
            while (c.charAt(0) == ' ') {
                c = c.substring(1);
            }
            if (c.indexOf(name) == 0) {
                return c.substring(name.length, c.length);
            }
        }
        return "";
    }
</script>